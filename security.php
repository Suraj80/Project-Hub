<?php
// security.php - Security middleware and utilities

require_once 'config.php';

class SecurityManager {
    
    /**
     * Initialize security settings for the application
     */
    public static function init() {
        self::setSecurityHeaders();
        self::initSecureSession();
        self::cleanOldSessions();
    }
    
    /**
     * Set security headers
     */
    private static function setSecurityHeaders() {
        setSecurityHeaders(); // From config.php
    }
    
    /**
     * Initialize secure session
     */
    private static function initSecureSession() {
        initSecureSession(); // From config.php
    }
    
    /**
     * Clean old sessions
     */
    private static function cleanOldSessions() {
        cleanOldSessions(); // From config.php
    }
    
    /**
     * Validate CSRF token
     */
    public static function validateCSRFToken($token) {
        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }
        
        return hash_equals($_SESSION['csrf_token'], $token);
    }
    
    /**
     * Generate new CSRF token
     */
    public static function generateCSRFToken() {
        $_SESSION['csrf_token'] = generateSecureToken();
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Check if user is rate limited
     */
    public static function isRateLimited($identifier, $max_attempts = 5, $time_window = 300) {
        return !checkRateLimit($identifier, $max_attempts, $time_window);
    }
    
    /**
     * Record an attempt for rate limiting
     */
    public static function recordAttempt($identifier) {
        recordAttempt($identifier);
    }
    
    /**
     * Log security event to database
     */
    public static function logSecurityEvent($event_type, $description, $user_id = null, $additional_data = null) {
        try {
            $pdo = getDatabaseConnection();
            
            $stmt = $pdo->prepare("
                INSERT INTO security_logs (user_id, event_type, event_description, ip_address, user_agent, additional_data, created_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW())
            ");
            
            $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
            $additional_data_json = $additional_data ? json_encode($additional_data) : null;
            
            $stmt->execute([
                $user_id,
                $event_type,
                $description,
                $ip,
                $user_agent,
                $additional_data_json
            ]);
            
        } catch (Exception $e) {
            error_log("Failed to log security event: " . $e->getMessage());
        }
    }
    
    /**
     * Record login attempt in database
     */
    public static function recordLoginAttempt($identifier, $type, $success = false) {
        try {
            $pdo = getDatabaseConnection();
            
            $stmt = $pdo->prepare("
                INSERT INTO login_attempts (identifier, attempt_type, success, ip_address, user_agent, attempted_at)
                VALUES (?, ?, ?, ?, ?, NOW())
            ");
            
            $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
            
            $stmt->execute([
                $identifier,
                $type,
                $success ? 1 : 0,
                $ip,
                $user_agent
            ]);
            
        } catch (Exception $e) {
            error_log("Failed to record login attempt: " . $e->getMessage());
        }
    }
    
    /**
     * Check if account is locked
     */
    public static function isAccountLocked($user_id) {
        try {
            $pdo = getDatabaseConnection();
            
            $stmt = $pdo->prepare("
                SELECT account_locked_until 
                FROM users 
                WHERE id = ? AND account_locked_until > NOW()
            ");
            $stmt->execute([$user_id]);
            
            return $stmt->rowCount() > 0;
            
        } catch (Exception $e) {
            error_log("Failed to check account lock status: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Lock account after too many failed attempts
     */
    public static function lockAccount($user_id, $lockout_duration = 900) { // 15 minutes default
        try {
            $pdo = getDatabaseConnection();
            
            $stmt = $pdo->prepare("
                UPDATE users 
                SET account_locked_until = DATE_ADD(NOW(), INTERVAL ? SECOND),
                    failed_login_attempts = failed_login_attempts + 1,
                    last_failed_login = NOW()
                WHERE id = ?
            ");
            
            $stmt->execute([$lockout_duration, $user_id]);
            
            self::logSecurityEvent(
                'account_locked',
                "Account locked due to too many failed login attempts",
                $user_id,
                ['lockout_duration' => $lockout_duration]
            );
            
        } catch (Exception $e) {
            error_log("Failed to lock account: " . $e->getMessage());
        }
    }
    
    /**
     * Check for suspicious activity patterns
     */
    public static function checkSuspiciousActivity($identifier) {
        try {
            $pdo = getDatabaseConnection();
            
            // Check for too many failed attempts from same IP/identifier in last hour
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as attempts
                FROM login_attempts 
                WHERE (identifier = ? OR ip_address = ?) 
                AND success = 0 
                AND attempted_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)
            ");
            
            $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $stmt->execute([$identifier, $ip]);
            $result = $stmt->fetch();
            
            if ($result['attempts'] > 10) {
                self::logSecurityEvent(
                    'suspicious_activity',
                    "Multiple failed attempts detected",
                    null,
                    ['identifier' => $identifier, 'attempts' => $result['attempts']]
                );
                return true;
            }
            
            return false;
            
        } catch (Exception $e) {
            error_log("Failed to check suspicious activity: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Sanitize file upload
     */
    public static function sanitizeFileUpload($file) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB
        
        if (!in_array($file['type'], $allowed_types)) {
            throw new Exception("File type not allowed");
        }
        
        if ($file['size'] > $max_size) {
            throw new Exception("File too large");
        }
        
        // Additional checks for image files
        if (strpos($file['type'], 'image/') === 0) {
            $image_info = getimagesize($file['tmp_name']);
            if (!$image_info) {
                throw new Exception("Invalid image file");
            }
        }
        
        return true;
    }
    
    /**
     * Generate secure filename
     */
    public static function generateSecureFilename($original_filename) {
        $extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $secure_name = generateSecureToken(16) . '.' . $extension;
        return $secure_name;
    }
    
    /**
     * Validate email address
     */
    public static function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        // Additional checks for suspicious patterns
        $suspicious_patterns = [
            '/\+.*\+/', // Multiple + signs
            '/\.{2,}/', // Multiple consecutive dots
            '/[<>]/',   // HTML-like characters
        ];
        
        foreach ($suspicious_patterns as $pattern) {
            if (preg_match($pattern, $email)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Check if request is coming from suspicious source
     */
    public static function isSuspiciousRequest() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $suspicious_agents = [
            'bot', 'crawler', 'spider', 'scraper', 'curl', 'wget'
        ];
        
        foreach ($suspicious_agents as $agent) {
            if (stripos($user_agent, $agent) !== false) {
                return true;
            }
        }
        
        // Check for missing common headers
        $required_headers = ['HTTP_USER_AGENT', 'HTTP_ACCEPT'];
        foreach ($required_headers as $header) {
            if (!isset($_SERVER[$header])) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Validate honeypot field (add hidden field to forms)
     */
    public static function validateHoneypot($honeypot_value) {
        return empty($honeypot_value);
    }
}

// Autoload security manager on every page
SecurityManager::init();

?>