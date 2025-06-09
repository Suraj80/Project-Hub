<!-- <?php
$host = 'localhost';
$dbname = 'project_hub';
$username = 'suraj';
$password = 'Suraj@123';
?> -->
<?php
// Secure database configuration

// Environment-based configuration
$environment = $_ENV['APP_ENV'] ?? 'production';

// Database credentials (use environment variables in production)
$host = $_ENV['DB_HOST'] ?? 'localhost';
$dbname = $_ENV['DB_NAME'] ?? 'project_hub';
$username = $_ENV['DB_USER'] ?? 'suraj';
$db_pass = $_ENV['DB_PASS'] ?? 'Suraj@123'; // Different variable name to avoid conflicts

// Security configurations
define('BCRYPT_COST', 12);
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOCKOUT_TIME', 900); // 15 minutes
define('SESSION_LIFETIME', 1800); // 30 minutes

// Secure error reporting
if ($environment === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', '/var/log/php_errors.log');
}

// Security headers function
function setSecurityHeaders() {
    // Prevent MIME type sniffing
    header('X-Content-Type-Options: nosniff');
    
    // Prevent clickjacking
    header('X-Frame-Options: DENY');
    
    // XSS protection
    header('X-XSS-Protection: 1; mode=block');
    
    // Referrer policy
    header('Referrer-Policy: strict-origin-when-cross-origin');
    
    // Content Security Policy
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; connect-src 'self'");
    
    // HTTPS enforcement (if using HTTPS)
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
    }
}

// Input sanitization function
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Safe redirect function
function safeRedirect($url) {
    // Whitelist of allowed redirect URLs
    $allowed_redirects = [
        'login.php',
        'dashboard.php',
        'profile.php',
        'index.php'
    ];
    
    $parsed_url = parse_url($url);
    $path = $parsed_url['path'] ?? '';
    $filename = basename($path);
    
    if (in_array($filename, $allowed_redirects)) {
        header("Location: $url");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}

// Database connection with security settings
function getDatabaseConnection() {
    global $host, $dbname, $username, $db_pass;
    
    try {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
        ];
        
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4", 
            $username, 
            $db_pass,
            $options
        );
        
        return $pdo;
    } catch (PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
        die("Database connection failed. Please try again later.");
    }
}

// Rate limiting function
function checkRateLimit($identifier, $max_attempts = 5, $time_window = 300) {
    if (!isset($_SESSION['rate_limits'])) {
        $_SESSION['rate_limits'] = [];
    }
    
    if (!isset($_SESSION['rate_limits'][$identifier])) {
        $_SESSION['rate_limits'][$identifier] = [];
    }
    
    // Clean old attempts
    $_SESSION['rate_limits'][$identifier] = array_filter(
        $_SESSION['rate_limits'][$identifier],
        function($timestamp) use ($time_window) {
            return (time() - $timestamp) < $time_window;
        }
    );
    
    return count($_SESSION['rate_limits'][$identifier]) < $max_attempts;
}

function recordAttempt($identifier) {
    if (!isset($_SESSION['rate_limits'][$identifier])) {
        $_SESSION['rate_limits'][$identifier] = [];
    }
    $_SESSION['rate_limits'][$identifier][] = time();
}

// Log security events
function logSecurityEvent($event, $details = []) {
    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'event' => $event,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        'details' => $details
    ];
    
    error_log("Security Event: " . json_encode($log_entry));
}

