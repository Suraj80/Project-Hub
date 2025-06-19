<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

// Check if user is logged in and has admin privileges
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Access denied']);
    exit;
}

// Set content type to JSON
header('Content-Type: application/json');

// Get the action from POST data
$action = isset($_POST['action']) ? $_POST['action'] : '';

try {
    switch ($action) {
        case 'fetch_orders':
            fetchOrders();
            break;
        case 'get_order_details':
            getOrderDetails();
            break;
        case 'update_order_status':
            updateOrderStatus();
            break;
        case 'delete_order':
            deleteOrder();
            break;
        case 'export_orders':
            exportOrders();
            break;
        case 'bulk_update_status':
            bulkUpdateStatus();
            break;
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

function fetchOrders() {
    global $pdo;
    
    $page = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
    $limit = isset($_POST['limit']) ? max(1, min(100, intval($_POST['limit']))) : 10;
    $search = isset($_POST['search']) ? trim($_POST['search']) : '';
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';
    $purchaseType = isset($_POST['purchase_type']) ? trim($_POST['purchase_type']) : '';
    
    $offset = ($page - 1) * $limit;
    
    // Build the WHERE clause
    $whereConditions = [];
    $params = [];
    
    if (!empty($search)) {
        $whereConditions[] = "(o.id LIKE :search OR u.name LIKE :search OR u.email LIKE :search OR p.name LIKE :search)";
        $params[':search'] = "%$search%";
    }
    
    if (!empty($status)) {
        $whereConditions[] = "o.order_status = :status";
        $params[':status'] = $status;
    }
    
    if (!empty($purchaseType)) {
        $whereConditions[] = "o.purchase_type = :purchase_type";
        $params[':purchase_type'] = $purchaseType;
    }
    
    $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';
    
    // Count total records
    $countSql = "SELECT COUNT(*) as total FROM orders o 
                 LEFT JOIN users u ON o.user_id = u.id 
                 LEFT JOIN products p ON o.product_id = p.id 
                 $whereClause";
    
    $countStmt = $pdo->prepare($countSql);
    $countStmt->execute($params);
    $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Fetch orders
    $sql = "SELECT o.*, 
                   u.name as user_name, 
                   u.email as user_email, 
                   u.phone as user_phone, 
                   u.address as user_address,
                   p.name as product_name, 
                   p.price as product_price, 
                   p.description as product_description
            FROM orders o 
            LEFT JOIN users u ON o.user_id = u.id 
            LEFT JOIN products p ON o.product_id = p.id 
            $whereClause 
            ORDER BY o.order_date DESC 
            LIMIT :limit OFFSET :offset";
    
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => [
            'orders' => $orders,
            'total' => $total,
            'page' => $page,
            'limit' => $limit
        ]
    ]);
}

function getOrderDetails() {
    global $pdo;
    
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    
    if (!$orderId) {
        throw new Exception('Order ID is required');
    }
    
    $sql = "SELECT o.*, 
                   u.name as user_name, 
                   u.email as user_email, 
                   u.phone as user_phone, 
                   u.address as user_address,
                   p.name as product_name, 
                   p.price as product_price, 
                   p.description as product_description
            FROM orders o 
            LEFT JOIN users u ON o.user_id = u.id 
            LEFT JOIN products p ON o.product_id = p.id 
            WHERE o.id = :order_id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
    $stmt->execute();
    
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$order) {
        throw new Exception('Order not found');
    }
    
    echo json_encode([
        'success' => true,
        'data' => $order
    ]);
}

function updateOrderStatus() {
    global $pdo;
    
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    $newStatus = isset($_POST['new_status']) ? trim($_POST['new_status']) : '';
    $notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
    
    if (!$orderId || !$newStatus) {
        throw new Exception('Order ID and status are required');
    }
    
    // Validate status
    $validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
    if (!in_array($newStatus, $validStatuses)) {
        throw new Exception('Invalid status');
    }
    
    $pdo->beginTransaction();
    
    try {
        // Update order status
        $sql = "UPDATE orders SET order_status = :status, updated_at = NOW() WHERE id = :order_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount() === 0) {
            throw new Exception('Order not found or no changes made');
        }
        
        // Log status change
        $logSql = "INSERT INTO order_status_log (order_id, old_status, new_status, notes, changed_by, changed_at) 
                   SELECT :order_id, order_status, :new_status, :notes, :user_id, NOW() 
                   FROM orders WHERE id = :order_id2";
        $logStmt = $pdo->prepare($logSql);
        $logStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $logStmt->bindParam(':order_id2', $orderId, PDO::PARAM_INT);
        $logStmt->bindParam(':new_status', $newStatus);
        $logStmt->bindParam(':notes', $notes);
        $logStmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $logStmt->execute();
        
        $pdo->commit();
        
        echo json_encode([
            'success' => true,
            'message' => 'Order status updated successfully'
        ]);
        
    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
}

function deleteOrder() {
    global $pdo;
    
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    
    if (!$orderId) {
        throw new Exception('Order ID is required');
    }
    
    $pdo->beginTransaction();
    
    try {
        // Check if order exists
        $checkSql = "SELECT id FROM orders WHERE id = :order_id";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $checkStmt->execute();
        
        if (!$checkStmt->fetch()) {
            throw new Exception('Order not found');
        }
        
        // Delete related records first (if any)
        $deleteLogSql = "DELETE FROM order_status_log WHERE order_id = :order_id";
        $deleteLogStmt = $pdo->prepare($deleteLogSql);
        $deleteLogStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $deleteLogStmt->execute();
        
        // Delete the order
        $deleteSql = "DELETE FROM orders WHERE id = :order_id";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $deleteStmt->execute();
        
        $pdo->commit();
        
        echo json_encode([
            'success' => true,
            'message' => 'Order deleted successfully'
        ]);
        
    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
}

function exportOrders() {
    global $pdo;
    
    $search = isset($_POST['search']) ? trim($_POST['search']) : '';
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';
    $purchaseType = isset($_POST['purchase_type']) ? trim($_POST['purchase_type']) : '';
    
    // Build the WHERE clause
    $whereConditions = [];
    $params = [];
    
    if (!empty($search)) {
        $whereConditions[] = "(o.id LIKE :search OR u.name LIKE :search OR u.email LIKE :search OR p.name LIKE :search)";
        $params[':search'] = "%$search%";
    }
    
    if (!empty($status)) {
        $whereConditions[] = "o.order_status = :status";
        $params[':status'] = $status;
    }
    
    if (!empty($purchaseType)) {
        $whereConditions[] = "o.purchase_type = :purchase_type";
        $params[':purchase_type'] = $purchaseType;
    }
    
    $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';
    
    // Fetch all orders for export
    $sql = "SELECT o.id, 
                   u.name as customer_name, 
                   u.email as customer_email, 
                   u.phone as customer_phone,
                   p.name as product_name, 
                   p.price as product_price, 
                   o.quantity,
                   (p.price * o.quantity) as total_amount,
                   o.order_date,
                   o.order_status,
                   o.purchase_type
            FROM orders o 
            LEFT JOIN users u ON o.user_id = u.id 
            LEFT JOIN products p ON o.product_id = p.id 
            $whereClause 
            ORDER BY o.order_date DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Generate CSV
    $filename = 'orders_export_' . date('Y-m-d_H-i-s') . '.csv';
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    $output = fopen('php://output', 'w');
    
    // CSV headers
    fputcsv($output, [
        'Order ID',
        'Customer Name',
        'Customer Email',
        'Customer Phone',
        'Product Name',
        'Product Price',
        'Quantity',
        'Total Amount',
        'Order Date',
        'Status',
        'Purchase Type'
    ]);
    
    // CSV data
    foreach ($orders as $order) {
        fputcsv($output, [
            $order['id'],
            $order['customer_name'],
            $order['customer_email'],
            $order['customer_phone'],
            $order['product_name'],
            '$' . number_format($order['product_price'], 2),
            $order['quantity'],
            '$' . number_format($order['total_amount'], 2),
            $order['order_date'],
            ucfirst($order['order_status']),
            ucfirst($order['purchase_type'])
        ]);
    }
    
    fclose($output);
    exit;
}

function bulkUpdateStatus() {
    global $pdo;
    
    $orderIds = isset($_POST['order_ids']) ? $_POST['order_ids'] : '';
    $newStatus = isset($_POST['new_status']) ? trim($_POST['new_status']) : '';
    $notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
    
    if (!$orderIds || !$newStatus) {
        throw new Exception('Order IDs and status are required');
    }
    
    // Validate status
    $validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
    if (!in_array($newStatus, $validStatuses)) {
        throw new Exception('Invalid status');
    }
    
    $orderIdsArray = explode(',', $orderIds);
    $orderIdsArray = array_map('intval', $orderIdsArray);
    $orderIdsArray = array_filter($orderIdsArray);
    
    if (empty($orderIdsArray)) {
        throw new Exception('No valid order IDs provided');
    }
    
    $pdo->beginTransaction();
    
    try {
        $placeholders = str_repeat('?,', count($orderIdsArray) - 1) . '?';
        
        // Update orders
        $sql = "UPDATE orders SET order_status = ?, updated_at = NOW() WHERE id IN ($placeholders)";
        $stmt = $pdo->prepare($sql);
        $params = array_merge([$newStatus], $orderIdsArray);
        $stmt->execute($params);
        
        $updatedCount = $stmt->rowCount();
        
        // Log status changes
        foreach ($orderIdsArray as $orderId) {
            $logSql = "INSERT INTO order_status_log (order_id, old_status, new_status, notes, changed_by, changed_at) 
                       SELECT ?, order_status, ?, ?, ?, NOW() 
                       FROM orders WHERE id = ?";
            $logStmt = $pdo->prepare($logSql);
            $logStmt->execute([$orderId, $newStatus, $notes, $_SESSION['user_id'], $orderId]);
        }
        
        $pdo->commit();
        
        echo json_encode([
            'success' => true,
            'message' => "Successfully updated $updatedCount orders"
        ]);
        
    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
}

// Helper function to sanitize output
function sanitizeOutput($data) {
    if (is_array($data)) {
        return array_map('sanitizeOutput', $data);
    }
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>