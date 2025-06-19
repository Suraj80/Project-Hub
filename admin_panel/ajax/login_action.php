<?php
session_start();
header('Content-Type: application/json');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit();
}

// Check if required fields are present
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Username and password are required'
    ]);
    exit();
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Validate input
if (empty($username) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all fields'
    ]);
    exit();
}

// Check credentials (hardcoded for admin - replace with database check in production)
if ($username === 'Admin' && $password === '123') {
    // Set session
    $_SESSION['admin_id'] = '1';
    $_SESSION['admin_username'] = $username;
    $_SESSION['login_time'] = time();
    
    // Regenerate session ID for security
    session_regenerate_id(true);
    
    echo json_encode([
        'success' => true,
        'message' => 'Login successful! Redirecting...',
        'redirect_url' => 'admin_dashboard.php'
    ]);
} else {
    // Add a small delay to prevent brute force attacks
    usleep(500000); // 0.5 second delay
    
    echo json_encode([
        'success' => false,
        'message' => 'Invalid username or password!' 
    ]);
}
exit();
?>