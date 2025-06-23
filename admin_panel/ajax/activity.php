<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$host = 'localhost';
$dbname = 'project_hub';
$username = 'suraj';
$password = 'Suraj@123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {  
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Get the action
$action = $_POST['action'] ?? '';

header('Content-Type: application/json');

switch ($action) {
    case 'get_activity_logs':
        getActivityLogs();
        break;
    
    case 'export_activity_logs':
        exportActivityLogs();
        break;
    
    case 'test_connection':
        testConnection();
        break;
    
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

function testConnection() {
    global $pdo;
    try {
        // FIXED: Changed from 'admins' to 'admin' to match your table structure
        $stmt = $pdo->query("SELECT COUNT(*) FROM admin");
        $count = $stmt->fetchColumn();
        echo json_encode(['success' => true, 'message' => "Connection OK, $count records found"]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Connection error: ' . $e->getMessage()]);
    }
}

function getActivityLogs() {
    global $pdo;
    
    try {
        $page = max(1, intval($_POST['page'] ?? 1));
        $limit = max(1, min(100, intval($_POST['limit'] ?? 10)));
        $offset = ($page - 1) * $limit;
        
        $search = trim($_POST['search'] ?? '');
        $role = trim($_POST['role'] ?? '');
        $dateFrom = $_POST['date_from'] ?? '';
        $dateTo = $_POST['date_to'] ?? '';
        
        // Build WHERE clause
        $whereConditions = [];
        $params = [];
        
        if (!empty($search)) {
            $whereConditions[] = "(username LIKE :search OR email LIKE :search OR full_name LIKE :search)";
            $params[':search'] = "%$search%";
        }
        
        if (!empty($role)) {
            $whereConditions[] = "role = :role";
            $params[':role'] = $role;
        }
        
        if (!empty($dateFrom)) {
            $whereConditions[] = "DATE(last_login) >= :date_from";
            $params[':date_from'] = $dateFrom;
        }
        
        if (!empty($dateTo)) {
            $whereConditions[] = "DATE(last_login) <= :date_to";
            $params[':date_to'] = $dateTo;
        }
        
        $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';
        
        // FIXED: Changed from 'admins' to 'admin' to match your table structure
        $countSql = "SELECT COUNT(*) as total FROM admin $whereClause";
        $countStmt = $pdo->prepare($countSql);
        $countStmt->execute($params);
        $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        // Get paginated results - FIXED: Changed from 'admins' to 'admin'
        $sql = "SELECT id, username, email, full_name, role, status, profile_image, 
                    last_login, login_ip, created_at, updated_at 
                FROM admin 
                $whereClause 
                ORDER BY last_login DESC, id DESC 
                LIMIT :limit OFFSET :offset";
        
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Process results
        foreach ($results as &$admin) {
            // Sanitize sensitive data
            $admin['profile_image'] = !empty($admin['profile_image']) ? 
                htmlspecialchars($admin['profile_image']) : null;
            $admin['username'] = htmlspecialchars($admin['username']);
            $admin['email'] = htmlspecialchars($admin['email'] ?? '');
            $admin['full_name'] = htmlspecialchars($admin['full_name'] ?? '');
            
            // Format dates
            $admin['last_login'] = $admin['last_login'] ? 
                date('Y-m-d H:i:s', strtotime($admin['last_login'])) : null;
            $admin['created_at'] = date('Y-m-d H:i:s', strtotime($admin['created_at']));
            $admin['updated_at'] = date('Y-m-d H:i:s', strtotime($admin['updated_at']));
        }
        
        echo json_encode([
            'success' => true,
            'data' => $results,
            'total' => $totalCount,
            'page' => $page,
            'limit' => $limit,
            'total_pages' => ceil($totalCount / $limit)
        ]);
        
    } catch (PDOException $e) {
        error_log("Database error in getActivityLogs: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage() // Show actual error for debugging
        ]);
    } catch (Exception $e) {
        error_log("Error in getActivityLogs: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => 'An error occurred: ' . $e->getMessage() // Show actual error for debugging
        ]);
    }
}

function exportActivityLogs() {
    global $pdo;
    
    try {
        $search = trim($_POST['search'] ?? '');
        $role = trim($_POST['role'] ?? '');
        $dateFrom = $_POST['date_from'] ?? '';
        $dateTo = $_POST['date_to'] ?? '';
        
        // Build WHERE clause (same as get_activity_logs)
        $whereConditions = [];
        $params = [];
        
        if (!empty($search)) {
            $whereConditions[] = "(username LIKE :search OR email LIKE :search OR full_name LIKE :search)";
            $params[':search'] = "%$search%";
        }
        
        if (!empty($role)) {
            $whereConditions[] = "role = :role";
            $params[':role'] = $role;
        }
        
        if (!empty($dateFrom)) {
            $whereConditions[] = "DATE(last_login) >= :date_from";
            $params[':date_from'] = $dateFrom;
        }
        
        if (!empty($dateTo)) {
            $whereConditions[] = "DATE(last_login) <= :date_to";
            $params[':date_to'] = $dateTo;
        }
        
        $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';
        
        // FIXED: Changed from 'admins' to 'admin' to match your table structure
        $sql = "SELECT id, username, email, full_name, role, status, 
                    last_login, login_ip, created_at, updated_at 
                FROM admin 
                $whereClause 
                ORDER BY last_login DESC, id DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Generate CSV
        $filename = 'activity_logs_' . date('Y-m-d_H-i-s') . '.csv';
        
        // Set headers for file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        
        // Create file pointer
        $output = fopen('php://output', 'w');
        
        // Add CSV headers
        fputcsv($output, [
            'ID',
            'Username',
            'Email',
            'Full Name', 
            'Role',
            'Status',
            'Last Login',
            'Login IP',
            'Created At',
            'Updated At'
        ]);
        
        // Add data rows
        foreach ($results as $admin) {
            $status = $admin['status'] == 1 ? 'Active' : 'Inactive';
            $role = ucfirst($admin['role']);
            
            fputcsv($output, [
                $admin['id'],
                $admin['username'],
                $admin['email'] ?? '',
                $admin['full_name'] ?? '',
                $role,
                $status,
                $admin['last_login'] ? date('Y-m-d H:i:s', strtotime($admin['last_login'])) : 'Never',
                $admin['login_ip'] ?? 'N/A',
                date('Y-m-d H:i:s', strtotime($admin['created_at'])),
                date('Y-m-d H:i:s', strtotime($admin['updated_at']))
            ]);
        }
        
        fclose($output);
        exit;
        
    } catch (PDOException $e) {
        error_log("Database error in exportActivityLogs: " . $e->getMessage());
        
        // Reset headers and return error
        header_remove();
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Database error occurred during export: ' . $e->getMessage()
        ]);
    } catch (Exception $e) {
        error_log("Error in exportActivityLogs: " . $e->getMessage());
        
        // Reset headers and return error
        header_remove();
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'An error occurred during export: ' . $e->getMessage()
        ]);
    }
}

// Helper function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

// Helper function to check admin permissions
function hasPermission($requiredRole = 'super') {
    if (!isLoggedIn()) {
        return false;
    }
    
    $userRole = $_SESSION['admin_role'] ?? 'super';
    
    $roleHierarchy = [
        'super' => 1,
        'editor' => 2,
        'viewer' => 3
    ];
    
    $userLevel = $roleHierarchy[$userRole] ?? 0;
    $requiredLevel = $roleHierarchy[$requiredRole] ?? 0;
    
    return $userLevel >= $requiredLevel;
}

// Log activity function
function logActivity($action, $details = null) {
    global $pdo;
    
    if (!isLoggedIn()) {
        return false;
    }
    
    try {
        $sql = "INSERT INTO activity_logs (admin_id, action, details, ip_address, created_at) 
                VALUES (:admin_id, :action, :details, :ip_address, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':admin_id' => $_SESSION['admin_id'],
            ':action' => $action,
            ':details' => $details ? json_encode($details) : null,
            ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null
        ]);
        
        return true;
        
    } catch (PDOException $e) {
        error_log("Error logging activity: " . $e->getMessage());
        return false;
    }
}

// Update last login time
function updateLastLogin($adminId) {
    global $pdo;
    
    try {
        // FIXED: Changed from 'admins' to 'admin'
        $sql = "UPDATE admin SET last_login = NOW(), login_ip = :ip WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ip' => $_SERVER['REMOTE_ADDR'] ?? null,
            ':id' => $adminId
        ]);
        
        return true;
        
    } catch (PDOException $e) {
        error_log("Error updating last login: " . $e->getMessage());
        return false;
    }
}
?>