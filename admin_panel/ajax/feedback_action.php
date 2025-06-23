<?php
// ajax/feedback_action.php - Backend handler for feedback AJAX requests

// Start session
session_start();

// Set content type to JSON
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = 'localhost';
$dbname = 'project_hub';
$username = 'suraj';
$password = 'Suraj@123';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $e->getMessage()
    ]);
    exit;
}

// Get the action from POST data
$action = $_POST['action'] ?? '';

// Initialize response
$response = [
    'success' => false,
    'message' => 'Invalid action',
    'data' => null
];

try {
    switch ($action) {
        case 'get_feedback':
            $response = getFeedbackData($pdo);
            break;
            
        case 'update_status':
            $response = updateFeedbackStatus($pdo);
            break;
            
        case 'delete_feedback':
            $response = deleteFeedback($pdo);
            break;
            
        case 'get_stats':
            $response = getFeedbackStats($pdo);
            break;
            
        default:
            $response['message'] = 'Unknown action: ' . $action;
            break;
    }
} catch (Exception $e) {
    error_log('Feedback Action Error: ' . $e->getMessage());
    $response = [
        'success' => false,
        'message' => 'An error occurred while processing your request: ' . $e->getMessage()
    ];
}

// Output JSON response
echo json_encode($response);
exit;

/**
 * Get all feedback data
 */
function getFeedbackData($pdo) {
    try {
        // Updated query to match your table structure
        $sql = "SELECT 
                    id,
                    name,
                    email,
                    subject,
                    message,
                    status,
                    created_at
                FROM feedback 
                ORDER BY created_at DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $feedback = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return [
            'success' => true,
            'message' => 'Feedback retrieved successfully',
            'data' => $feedback,
            'count' => count($feedback)
        ];
        
    } catch (PDOException $e) {
        error_log('Database Error in getFeedbackData: ' . $e->getMessage());
        return [
            'success' => false,
            'message' => 'Failed to retrieve feedback data: ' . $e->getMessage()
        ];
    }
}

/**
 * Update feedback status
 */
function updateFeedbackStatus($pdo) {
    $feedback_id = $_POST['feedback_id'] ?? null;
    $status = $_POST['status'] ?? null;
    
    // Validate input
    if (!$feedback_id || !$status) {
        return [
            'success' => false,
            'message' => 'Missing required parameters'
        ];
    }
    
    // Validate status values
    $valid_statuses = ['new', 'read', 'replied'];
    if (!in_array($status, $valid_statuses)) {
        return [
            'success' => false,
            'message' => 'Invalid status value'
        ];
    }
    
    try {
        // Check if feedback exists
        $checkSql = "SELECT id FROM feedback WHERE id = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$feedback_id]);
        
        if (!$checkStmt->fetch()) {
            return [
                'success' => false,
                'message' => 'Feedback not found'
            ];
        }
        
        // Update the status
        $sql = "UPDATE feedback 
                SET status = ? 
                WHERE id = ?";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$status, $feedback_id]);
        
        if ($result) {
            return [
                'success' => true,
                'message' => 'Status updated successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to update status'
            ];
        }
        
    } catch (PDOException $e) {
        error_log('Database Error in updateFeedbackStatus: ' . $e->getMessage());
        return [
            'success' => false,
            'message' => 'Database error occurred: ' . $e->getMessage()
        ];
    }
}

/**
 * Delete feedback
 */
function deleteFeedback($pdo) {
    $feedback_id = $_POST['feedback_id'] ?? null;
    
    if (!$feedback_id) {
        return [
            'success' => false,
            'message' => 'Missing feedback ID'
        ];
    }
    
    try {
        // Check if feedback exists
        $checkSql = "SELECT id, name, email, subject FROM feedback WHERE id = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$feedback_id]);
        $feedback = $checkStmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$feedback) {
            return [
                'success' => false,
                'message' => 'Feedback not found'
            ];
        }
        
        // Delete the feedback
        $sql = "DELETE FROM feedback WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$feedback_id]);
        
        if ($result) {
            return [
                'success' => true,
                'message' => 'Feedback deleted successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to delete feedback'
            ];
        }
        
    } catch (PDOException $e) {
        error_log('Database Error in deleteFeedback: ' . $e->getMessage());
        return [
            'success' => false,
            'message' => 'Database error occurred: ' . $e->getMessage()
        ];
    }
}

/**
 * Get feedback statistics
 */
function getFeedbackStats($pdo) {
    try {
        $sql = "SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new_count,
                    SUM(CASE WHEN status = 'read' THEN 1 ELSE 0 END) as read_count,
                    SUM(CASE WHEN status = 'replied' THEN 1 ELSE 0 END) as replied_count,
                    COUNT(CASE WHEN DATE(created_at) = CURDATE() THEN 1 END) as today_count,
                    COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) THEN 1 END) as week_count,
                    COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN 1 END) as month_count
                FROM feedback";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return [
            'success' => true,
            'message' => 'Statistics retrieved successfully',
            'data' => $stats
        ];
        
    } catch (PDOException $e) {
        error_log('Database Error in getFeedbackStats: ' . $e->getMessage());
        return [
            'success' => false,
            'message' => 'Failed to retrieve statistics: ' . $e->getMessage()
        ];
    }
}
?>