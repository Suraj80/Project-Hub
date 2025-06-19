<?php
// Include your database connection file here
// require_once '../config/database.php';

// Set content type to JSON
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection settings - Update these with your actual database credentials
$host = 'localhost';
$dbname = 'project_hub';
$username = 'suraj';
$password = 'Suraj@123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Only POST requests allowed']);
    exit;
}

// Get the action from POST data
$action = $_POST['action'] ?? '';

switch ($action) {
    case 'fetch_users':
        fetchUsers($pdo);
        break;
    
    case 'block_user':
        blockUser($pdo);
        break;
    
    case 'unblock_user':
        unblockUser($pdo);
        break;
    
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

function fetchUsers($pdo) {
    try {
        $sql = "SELECT 
                    id, 
                    number, 
                    email, 
                    full_name, 
                    profile_image, 
                    status, 
                    is_verified, 
                    email_verified, 
                    phone_verified, 
                    failed_login_attempts, 
                    last_failed_login, 
                    created_at, 
                    updated_at, 
                    last_login, 
                    last_activity, 
                    ip_address
                FROM users 
                ORDER BY created_at DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true, 
            'data' => $users,
            'total' => count($users)
        ]);
        
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching users: ' . $e->getMessage()]);
    }
}

function blockUser($pdo) {
    try {
        $userId = $_POST['user_id'] ?? 0;
        
        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'User ID is required']);
            return;
        }
        
        // Check if user exists
        $checkSql = "SELECT id, status FROM users WHERE id = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$userId]);
        $user = $checkStmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'User not found']);
            return;
        }
        
        if ($user['status'] === 'banned') {
            echo json_encode(['success' => false, 'message' => 'User is already blocked']);
            return;
        }
        
        // Update user status to banned
        $sql = "UPDATE users SET status = 'banned', updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'User blocked successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to block user']);
        }
        
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error blocking user: ' . $e->getMessage()]);
    }
}

function unblockUser($pdo) {
    try {
        $userId = $_POST['user_id'] ?? 0;
        
        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'User ID is required']);
            return;
        }
        
        // Check if user exists
        $checkSql = "SELECT id, status FROM users WHERE id = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$userId]);
        $user = $checkStmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'User not found']);
            return;
        }
        
        if ($user['status'] !== 'banned') {
            echo json_encode(['success' => false, 'message' => 'User is not blocked']);
            return;
        }
        
        // Update user status to active
        $sql = "UPDATE users SET status = 'active', updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'User unblocked successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to unblock user']);
        }
        
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error unblocking user: ' . $e->getMessage()]);
    }
}

// Close the database connection
$pdo = null;
?>