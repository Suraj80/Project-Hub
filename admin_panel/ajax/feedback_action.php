<?php
// ajax/feedback_action.php - Backend handler for feedback AJAX requests


// Set content type to JSON
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration - Update these with your actual database credentials
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

// Check if action is provided
if (!isset($_POST['action'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No action specified'
    ]);
    exit;
}

$action = $_POST['action'];

try {
    switch ($action) {
        case 'get_feedback':
            getFeedback($pdo);
            break;
            
        case 'update_status':
            updateFeedbackStatus($pdo);
            break;
            
        default:
            echo json_encode([
                'success' => false,
                'message' => 'Invalid action'
            ]);
            break;
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}

/**
 * Get all feedback entries
 */
function getFeedback($pdo) {
    try {
        $stmt = $pdo->prepare("
            SELECT 
                id,
                name,
                email,
                subject,
                message,
                status,
                created_at
            FROM feedback 
            ORDER BY created_at DESC
        ");
        
        $stmt->execute();
        $feedback = $stmt->fetchAll();
        
        echo json_encode([
            'success' => true,
            'data' => $feedback,
            'count' => count($feedback)
        ]);
        
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to fetch feedback: ' . $e->getMessage()
        ]);
    }
}

/**
 * Update feedback status
 */
function updateFeedbackStatus($pdo) {
    // Validate required parameters
    if (!isset($_POST['feedback_id']) || !isset($_POST['status'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Missing required parameters'
        ]);
        return;
    }
    
    $feedbackId = (int)$_POST['feedback_id'];
    $status = $_POST['status'];
    
    // Validate status
    $allowedStatuses = ['new', 'read', 'replied'];
    if (!in_array($status, $allowedStatuses)) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid status value'
        ]);
        return;
    }
    
    try {
        // Check if feedback exists
        $checkStmt = $pdo->prepare("SELECT id FROM feedback WHERE id = ?");
        $checkStmt->execute([$feedbackId]);
        
        if (!$checkStmt->fetch()) {
            echo json_encode([
                'success' => false,
                'message' => 'Feedback not found'
            ]);
            return;
        }
        
        // Update the status
        $updateStmt = $pdo->prepare("
            UPDATE feedback 
            SET status = ? 
            WHERE id = ?
        ");
        
        $updateStmt->execute([$status, $feedbackId]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Feedback status updated successfully'
        ]);
        
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update feedback status: ' . $e->getMessage()
        ]);
    }
}
?>