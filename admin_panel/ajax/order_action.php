<?php
session_start();

// Database configuration
$host = 'localhost';
$dbname = 'project_hub';
$username = 'suraj';
$password = 'Suraj@123';

// Initialize PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Database connection failed: ' . $e->getMessage()
    ]);
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
        $whereConditions[] = "(o.id LIKE :search OR u.full_name LIKE :search OR u.email LIKE :search OR p.name LIKE :search)";
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
    
    try {
        // Count total records
        $countSql = "SELECT COUNT(*) as total FROM orders o 
                     LEFT JOIN users u ON o.user_id = u.id 
                     LEFT JOIN products p ON o.product_id = p.id 
                     $whereClause";
        
        $countStmt = $pdo->prepare($countSql);
        $countStmt->execute($params);
        $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        // Fetch orders with updated column names based on your schema
        $sql = "SELECT o.id,
                       o.user_id,
                       o.product_id,
                       o.quantity,
                       o.order_date,
                       o.order_status,
                       o.purchase_type,
                       u.full_name as user_name, 
                       u.email as user_email, 
                       u.number as user_phone, 
                       '' as user_address,
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
                'total' => intval($total),
                'page' => $page,
                'limit' => $limit
            ]
        ]);
        
    } catch (PDOException $e) {
        throw new Exception('Database error: ' . $e->getMessage());
    }
}

function getOrderDetails() {
    global $pdo;
    
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    
    if (!$orderId) {
        throw new Exception('Order ID is required');
    }
    
    try {
        $sql = "SELECT o.id,
                       o.user_id,
                       o.product_id,
                       o.quantity,
                       o.order_date,
                       o.order_status,
                       o.purchase_type,
                       u.full_name as user_name, 
                       u.email as user_email, 
                       u.number as user_phone, 
                       '' as user_address,
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
        
    } catch (PDOException $e) {
        throw new Exception('Database error: ' . $e->getMessage());
    }
}

function updateOrderStatus() {
    global $pdo;
    
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    $newStatus = isset($_POST['new_status']) ? trim($_POST['new_status']) : '';
    $notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
    
    if (!$orderId || !$newStatus) {
        throw new Exception('Order ID and status are required');
    }
    
    // Validate status based on your schema
    $validStatuses = ['placed', 'processing', 'pending', 'shipped', 'completed', 'delivered', 'cancelled'];
    if (!in_array($newStatus, $validStatuses)) {
        throw new Exception('Invalid status');
    }
    
    try {
        $pdo->beginTransaction();
        
        // Update order status
        $sql = "UPDATE orders SET order_status = :status WHERE id = :order_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount() === 0) {
            throw new Exception('Order not found or no changes made');
        }
        
        // Log the status change if you have a log table
        // For now, we'll skip logging since the table structure isn't clear
        
        $pdo->commit();
        
        echo json_encode([
            'success' => true,
            'message' => 'Order status updated successfully'
        ]);
        
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw new Exception('Database error: ' . $e->getMessage());
    }
}

function deleteOrder() {
    global $pdo;
    
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    
    if (!$orderId) {
        throw new Exception('Order ID is required');
    }
    
    try {
        $pdo->beginTransaction();
        
        // Check if order exists
        $checkSql = "SELECT id FROM orders WHERE id = :order_id";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $checkStmt->execute();
        
        if (!$checkStmt->fetch()) {
            throw new Exception('Order not found');
        }
        
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
        
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw new Exception('Database error: ' . $e->getMessage());
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
        $whereConditions[] = "(o.id LIKE :search OR u.full_name LIKE :search OR u.email LIKE :search OR p.name LIKE :search)";
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
    
    try {
        // Fetch all orders for export
        $sql = "SELECT o.id, 
                       u.full_name as customer_name, 
                       u.email as customer_email, 
                       u.number as customer_phone,
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
        
    } catch (PDOException $e) {
        throw new Exception('Database error: ' . $e->getMessage());
    }
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
    $validStatuses = ['placed', 'processing', 'pending', 'shipped', 'completed', 'delivered', 'cancelled'];
    if (!in_array($newStatus, $validStatuses)) {
        throw new Exception('Invalid status');
    }
    
    $orderIdsArray = explode(',', $orderIds);
    $orderIdsArray = array_map('intval', $orderIdsArray);
    $orderIdsArray = array_filter($orderIdsArray);
    
    if (empty($orderIdsArray)) {
        throw new Exception('No valid order IDs provided');
    }
    
    try {
        $pdo->beginTransaction();
        
        $placeholders = str_repeat('?,', count($orderIdsArray) - 1) . '?';
        
        // Update orders
        $sql = "UPDATE orders SET order_status = ? WHERE id IN ($placeholders)";
        $stmt = $pdo->prepare($sql);
        $params = array_merge([$newStatus], $orderIdsArray);
        $stmt->execute($params);
        
        $updatedCount = $stmt->rowCount();
        
        $pdo->commit();
        
        echo json_encode([
            'success' => true,
            'message' => "Successfully updated $updatedCount orders"
        ]);
        
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw new Exception('Database error: ' . $e->getMessage());
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