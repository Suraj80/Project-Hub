<?php
/**
 * Database Configuration File
 * This file contains database connection settings and PDO initialization
 */

// Database configuration constants
define('DB_HOST', 'localhost');        // Database host
define('DB_NAME', 'project_hub'); // Database name
define('DB_USER', 'suraj');             // Database username
define('DB_PASS', 'Suraj@123');                 // Database password
define('DB_CHARSET', 'utf8mb4');       // Character set

// Database connection options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
];

// Create PDO connection
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    
    // Set timezone (optional)
    $pdo->exec("SET time_zone = '+00:00'");
    
} catch (PDOException $e) {
    // Log error (in production, don't show database errors to users)
    error_log("Database Connection Error: " . $e->getMessage());
    
    // Show user-friendly error message
    die("Database connection failed. Please try again later.");
}

/**
 * Test database connection function
 * @return boolean
 */
function testDatabaseConnection() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT 1");
        return $stmt !== false;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Get database connection
 * @return PDO
 */
function getDbConnection() {
    global $pdo;
    return $pdo;
}

/**
 * Close database connection
 */
function closeDatabaseConnection() {
    global $pdo;
    $pdo = null;
}

// Optional: Test connection on include
if (defined('TEST_DB_CONNECTION') && TEST_DB_CONNECTION === true) {
    if (testDatabaseConnection()) {
        echo "Database connection successful!";
    } else {
        echo "Database connection failed!";
    }
}
?>