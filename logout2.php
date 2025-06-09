<?php
// 1. Add this function to handle logout and cleanup remember tokens
function logout_user($pdo, $user_id) {
    // Clear remember token from database
    $stmt = $pdo->prepare("UPDATE users SET remember_token = NULL, remember_expires = NULL WHERE id = ?");
    $stmt->execute([$user_id]);
    
    // Clear remember cookie
    setcookie('remember_user', '', time() - 3600, '/', '', isset($_SERVER['HTTPS']), true);
    
    // Destroy session
    session_destroy();
}

// 2. Enhanced remember token validation (replace existing cookie check section)
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
    try {
        $cookie_data = base64_decode($_COOKIE['remember_user']);
        $parts = explode(':', $cookie_data);
        
        if (count($parts) === 2) {
            $user_id = filter_var($parts[0], FILTER_VALIDATE_INT);
            $remember_token = $parts[1];
            
            // Validate user_id is actually an integer
            if ($user_id === false) {
                throw new Exception("Invalid user ID in cookie");
            }
            
            $hashed_token = hash('sha256', $remember_token);
            
            // Create PDO connection
            $db_password = $db_pass;
            $pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4", 
                $username, 
                $db_password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
            
            // Enhanced validation with additional security checks
            $stmt = $pdo->prepare("
                SELECT id, number, remember_token, remember_expires, status, is_verified 
                FROM users 
                WHERE id = ? 
                AND remember_token = ? 
                AND remember_expires > NOW() 
                AND status = 'active' 
                AND is_verified = 1 
                LIMIT 1
            ");
            $stmt->execute([$user_id, $hashed_token]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                // Valid token - log user in
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_mobile'] = $user['number'];
                $_SESSION['login_time'] = time();
                
                // Update last login
                $stmt = $pdo->prepare("UPDATE users SET last_login = NOW(), ip_address = ? WHERE id = ?");
                $stmt->execute([$client_ip, $user['id']]);
                
                // Optional: Regenerate remember token for enhanced security (token rotation)
                $new_remember_token = bin2hex(random_bytes(32));
                $new_hashed_token = hash('sha256', $new_remember_token);
                
                $stmt = $pdo->prepare("UPDATE users SET remember_token = ?, remember_expires = DATE_ADD(NOW(), INTERVAL 30 DAY) WHERE id = ?");
                $stmt->execute([$new_hashed_token, $user['id']]);
                
                // Update cookie with new token
                $new_cookie_value = base64_encode($user['id'] . ':' . $new_remember_token);
                setcookie('remember_user', $new_cookie_value, time() + (30 * 24 * 60 * 60), '/', '', isset($_SERVER['HTTPS']), true);
                
                // Log successful auto-login
                error_log("Successful auto-login via remember token for user ID: " . $user['id']);
                
                header("Location: index.php");
                exit();
            } else {
                // Invalid or expired cookie, remove it
                setcookie('remember_user', '', time() - 3600, '/', '', isset($_SERVER['HTTPS']), true);
                error_log("Invalid remember token attempt from IP: " . $client_ip);
            }
        }
    } catch (Exception $e) {
        // Invalid cookie, remove it
        setcookie('remember_user', '', time() - 3600, '/', '', isset($_SERVER['HTTPS']), true);
        error_log("Remember token validation error: " . $e->getMessage());
    }
}

// 3. Add cleanup for expired tokens (add this as a separate file or include it in a cron job)
// cleanup_expired_tokens.php
function cleanup_expired_remember_tokens($pdo) {
    $stmt = $pdo->prepare("UPDATE users SET remember_token = NULL, remember_expires = NULL WHERE remember_expires < NOW()");
    $stmt->execute();
    
    $affected_rows = $stmt->rowCount();
    if ($affected_rows > 0) {
        error_log("Cleaned up $affected_rows expired remember tokens");
    }
}

// 4. Enhanced cookie setting with better HTTPS detection
function set_remember_cookie($user_id, $token, $expires_in_days = 30) {
    $cookie_value = base64_encode($user_id . ':' . $token);
    $is_secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    
    return setcookie(
        'remember_user', 
        $cookie_value, 
        time() + ($expires_in_days * 24 * 60 * 60), 
        '/', 
        '', 
        $is_secure,  // Secure flag
        true         // HttpOnly flag
    );
}
?>