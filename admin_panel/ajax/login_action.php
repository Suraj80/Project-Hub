<?php
session_start();



// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'project_hub');
define('DB_USER', 'suraj');
define('DB_PASS', 'Suraj@123');
define('DB_CHARSET', 'utf8mb4');

// Database connection function
function getDBConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
        throw new Exception("Database connection failed");
    }
}

// Function to get client IP address
function getClientIP() {
    $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    
    foreach ($ipKeys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}


// require_once 'config/database.php';

// Set JSON content type
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

try {
    // Get database connection
    $pdo = getDBConnection();
    
    // Prepare statement to fetch user by username
    $stmt = $pdo->prepare("
        SELECT id, username, password, email, full_name, role, status 
        FROM admin 
        WHERE username = ? AND status = 1
    ");
    
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if (!$user) {
        // Add delay to prevent brute force attacks
        usleep(500000); // 0.5 second delay
        
        echo json_encode([
            'success' => false,
            'message' => 'Invalid username or password!'
        ]);
        exit();
    }
    
    // Verify password
    if (!password_verify($password, $user['password'])) {
        // Add delay to prevent brute force attacks
        usleep(500000); // 0.5 second delay
        
        echo json_encode([
            'success' => false,
            'message' => 'Invalid username or password!'
        ]);
        exit();
    }
    
    // Login successful - update last_login and login_ip
    $clientIP = getClientIP();
    $updateStmt = $pdo->prepare("
        UPDATE admin 
        SET last_login = NOW(), login_ip = ? 
        WHERE id = ?
    ");
    $updateStmt->execute([$clientIP, $user['id']]);
    
    // Set session variables
    $_SESSION['admin_id'] = $user['id'];
    $_SESSION['admin_username'] = $user['username'];
    $_SESSION['admin_role'] = $user['role'];
    $_SESSION['admin_email'] = $user['email'];
    $_SESSION['admin_full_name'] = $user['full_name'];
    $_SESSION['login_time'] = time();
    $_SESSION['login_ip'] = $clientIP;
    
    // Regenerate session ID for security
    session_regenerate_id(true);
    
    // FIXED: Updated role-based redirects to match your database schema
    $redirectUrl = 'dashboard1.php'; // Default dashboard
    
    switch ($user['role']) {
        case 'super':
            $redirectUrl = 'dashboard1.php';
            break;
        case 'editor':
            $redirectUrl = 'editor_dashboard.php';
            break;
        case 'viewer':
            $redirectUrl = 'viewer_dashboard.php';
            break;
        default:
            $redirectUrl = 'dashboard1.php';
            break;
    }
    
    // Log successful login
    logActivity($user['id'], 'login', 'User logged in successfully', $clientIP);
    
    // FIXED: Use 'redirect' instead of 'redirect_url' to match JavaScript
    echo json_encode([
        'success' => true,
        'message' => 'Login successful!',
        'redirect' => $redirectUrl,
        'user' => [
            'id' => $user['id'],
            'username' => $user['username'],
            'full_name' => $user['full_name'],
            'role' => $user['role'],
            'email' => $user['email']
        ]
    ]);
    
} catch (PDOException $e) {
    // Log database error
    error_log("Database error in login: " . $e->getMessage());
    
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed. Please try again later.'
    ]);
    
} catch (Exception $e) {
    // Log general error
    error_log("General error in login: " . $e->getMessage());
    
    echo json_encode([
        'success' => false,
        'message' => 'An unexpected error occurred. Please try again.'
    ]);
}

// Helper function to get client IP address
// function getClientIP() {
//     $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    
//     foreach ($ipKeys as $key) {
//         if (array_key_exists($key, $_SERVER) === true) {
//             foreach (explode(',', $_SERVER[$key]) as $ip) {
//                 $ip = trim($ip);
                
//                 if (filter_var($ip, FILTER_VALIDATE_IP, 
//                     FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
//                     return $ip;
//                 }
//             }
//         }
//     }
    
//     return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
// }

// Helper function to log user activities
function logActivity($userId, $action, $description, $ipAddress = null) {
    try {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("
            INSERT INTO activity_logs (user_id, action, description, ip_address, created_at) 
            VALUES (?, ?, ?, ?, NOW())
        ");
        
        $stmt->execute([
            $userId,
            $action,
            $description,
            $ipAddress ?? getClientIP()
        ]);
        
    } catch (Exception $e) {
        error_log("Failed to log activity: " . $e->getMessage());
    }
}
?>