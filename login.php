<?php
// Secure session configuration
// ini_set('session.cookie_httponly', 1);
// ini_set('session.cookie_secure', 1);
// ini_set('session.use_strict_mode', 1);
session_start();

// Regenerate session ID to prevent session fixation
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// Database configuration
include 'config.php';

// Initialize variables
$errors = [];
$success_message = '';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// CSRF Token Generation
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Rate limiting (simple implementation)
$max_attempts = 5;
$time_window = 300; // 5 minutes
$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = [];
}

// Clean old attempts
$_SESSION['login_attempts'] = array_filter(
    $_SESSION['login_attempts'],
    function($timestamp) use ($time_window) {
        return (time() - $timestamp) < $time_window;
    }
);

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF Token Validation
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $errors[] = "Invalid request. Please try again.";
    } else {
        // Rate limiting check
        if (count($_SESSION['login_attempts']) >= $max_attempts) {
            $errors[] = "Too many login attempts. Please try again later.";
        } else {
            // Add current attempt
            $_SESSION['login_attempts'][] = time();
            
            // Get form data and sanitize
            $mobile = trim($_POST['mobile'] ?? '');
            $user_password = $_POST['password'] ?? '';
            $remember_me = isset($_POST['remember_me']);

            // Enhanced Validation
            if (empty($mobile)) {
                $errors[] = "Mobile number is required.";
            } elseif (!preg_match('/^[6-9][0-9]{9}$/', $mobile)) {
                $errors[] = "Please enter a valid Indian mobile number.";
            }

            if (empty($user_password)) {
                $errors[] = "Password is required.";
            }

            // If no errors, proceed with authentication
            if (empty($errors)) {
                try {
                    // Create PDO connection with secure settings
                    $db_password = $db_pass; // Use different variable name to avoid conflict
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

                    // Check if user exists and get user data
                    $stmt = $pdo->prepare("SELECT id, password, is_verified, status FROM users WHERE number = ? LIMIT 1");
                    $stmt->execute([$mobile]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($user && password_verify($user_password, $user['password'])) {
                        // Check if account is active and verified
                        if ($user['status'] !== 'active') {
                            $errors[] = "Your account has been deactivated. Please contact support.";
                        } elseif ($user['is_verified'] == 0) {
                            $errors[] = "Please verify your mobile number before logging in.";
                        } else {
                            // Login successful
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['user_mobile'] = $mobile;
                            $_SESSION['login_time'] = time();
                            
                            // Update last login time
                            $stmt = $pdo->prepare("UPDATE users SET last_login = NOW(), ip_address = ? WHERE id = ?");
                            $stmt->execute([$client_ip, $user['id']]);
                            
                            // Set secure remember me cookie if checked
                            if ($remember_me) {
                                // Generate secure token
                                $remember_token = bin2hex(random_bytes(32));
                                $hashed_token = hash('sha256', $remember_token);
                                
                                // Store hashed token in database
                                $stmt = $pdo->prepare("UPDATE users SET remember_token = ?, remember_expires = DATE_ADD(NOW(), INTERVAL 30 DAY) WHERE id = ?");
                                $stmt->execute([$hashed_token, $user['id']]);
                                
                                // Set secure cookie
                                $cookie_value = base64_encode($user['id'] . ':' . $remember_token);
                                setcookie('remember_user', $cookie_value, time() + (30 * 24 * 60 * 60), '/', '', true, true);
                            }
                            
                            // Log successful login (without sensitive data)
                            error_log("Successful login for mobile: " . substr($mobile, 0, 3) . "XXXXX" . substr($mobile, -2));
                            
                            // Reset rate limiting after successful login
                            $_SESSION['login_attempts'] = [];
                            
                            // Regenerate CSRF token
                            // $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                            
                            // Redirect to index page
                            header("Location: index.php");
                            exit();
                        }
                    } else {
                        $errors[] = "Invalid mobile number or password.";
                        
                        // Log failed login attempt
                        error_log("Failed login attempt for mobile: " . substr($mobile, 0, 3) . "XXXXX" . substr($mobile, -2) . " from IP: " . $client_ip);
                    }
                } catch (PDOException $e) {
                    // Log detailed error for developers (not shown to users)
                    error_log("Database error in login: " . $e->getMessage());
                    $errors[] = "Login failed. Please try again later.";
                }
            }
        }
    }
}

// Check for remember me cookie on page load
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
    try {
        $cookie_data = base64_decode($_COOKIE['remember_user']);
        $parts = explode(':', $cookie_data);
        
        if (count($parts) === 2) {
            $user_id = $parts[0];
            $remember_token = $parts[1];
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
            
            $stmt = $pdo->prepare("SELECT id, number, remember_token, remember_expires FROM users WHERE id = ? AND remember_token = ? AND remember_expires > NOW() LIMIT 1");
            $stmt->execute([$user_id, $hashed_token]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_mobile'] = $user['number'];
                $_SESSION['login_time'] = time();
                
                // Update last login
                $stmt = $pdo->prepare("UPDATE users SET last_login = NOW(), ip_address = ? WHERE id = ?");
                $stmt->execute([$client_ip, $user['id']]);
                
                header("Location: index.php");
                exit();
            } else {
                // Invalid or expired cookie, remove it
                setcookie('remember_user', '', time() - 3600, '/', '', true, true);
            }
        }
    } catch (Exception $e) {
        // Invalid cookie, remove it
        setcookie('remember_user', '', time() - 3600, '/', '', true, true);
        error_log("Cookie validation error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Security Headers -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta http-equiv="Referrer-Policy" content="strict-origin-when-cross-origin">
    
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Space+Grotesk%3Awght%40400%3B500%3B700"
    />
    <title>CodeCraft - Login</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <style>
        /* Your existing CSS styles remain the same */
        @media (max-width: 768px) {
            .layout-container {
                padding: 0 1rem;
            }
            
            .px-40 {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .w-\[512px\] {
                width: 100%;
            }
            
            .max-w-\[480px\] {
                max-width: 100%;
            }
            
            .header-nav {
                display: none;
            }
            
            .mobile-menu-button {
                display: block;
            }
            
            .form-container {
                padding: 0.5rem;
            }
            
            .text-\[24px\] {
                font-size: 20px;
            }
            
            .compact-input {
                height: 2.75rem !important;
                padding: 0.5rem !important;
            }
            
            .compact-spacing {
                padding-top: 0.375rem;
                padding-bottom: 0.375rem;
            }
        }
        
        @media (min-width: 769px) {
            .mobile-menu-button {
                display: none;
            }
            
            .compact-input {
                height: 3rem;
                padding: 0.75rem;
            }
            
            .compact-spacing {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }
        }
        
        .error-message {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 0.5rem;
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
        }
        
        .success-message {
            background-color: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 0.5rem;
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
        }
        
        .form-input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        }
        
        .compact-form {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }
        
        .compact-label {
            margin-bottom: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .compact-field {
            margin-bottom: 0.75rem;
        }
        
        .compact-header {
            margin-bottom: 1rem;
            margin-top: 0.5rem;
        }

        .welcome-text {
            color: #6a7581;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden"
         style='--checkbox-tick-svg: url(&apos;data:image/svg+xml,%3csvg viewBox=%270 0 16 16%27 fill=%27rgb(18,20,22)%27 xmlns=%27http://www.w3.org/2000/svg%27%3e%3cpath d=%27M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z%27/%3e%3c/svg%3e&apos;); font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        
        <div class="layout-container flex h-full grow flex-col">
            <?php include 'header.php'; ?>
            
            <!-- Main Content -->
            <div class="px-4 md:px-20 flex flex-1 justify-center py-2">
                <div class="layout-content-container flex flex-col w-full max-w-[420px] py-2 flex-1">
                    <h2 class="text-[#121416] tracking-light text-[24px] font-bold leading-tight text-center compact-header">Welcome back</h2>
                    <p class="welcome-text">Sign in to your CodeCraft account</p>
                    
                    <!-- Error Messages -->
                    <?php if (!empty($errors)): ?>
                        <div class="error-message">
                            <ul class="list-disc list-inside text-sm">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Success Message -->
                    <?php if ($success_message): ?>
                        <div class="success-message">
                            <?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Login Form -->
                    <form method="POST" action="" class="form-container compact-form" novalidate>
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                        
                        <!-- Mobile Field -->
                        <div class="compact-field px-2">
                            <label class="flex flex-col">
                                <p class="text-[#121416] compact-label">Mobile Number *</p>
                                <input
                                    name="mobile"
                                    type="tel"
                                    placeholder="Enter your 10-digit mobile number"
                                    class="form-input compact-input flex w-full resize-none overflow-hidden rounded-lg text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white placeholder:text-[#6a7581] text-sm font-normal leading-normal"
                                    pattern="[6-9][0-9]{9}"
                                    title="Please enter a valid Indian mobile number starting with 6, 7, 8, or 9"
                                    maxlength="10"
                                    value="<?php echo htmlspecialchars($_POST['mobile'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    required
                                    autocomplete="tel"
                                />
                            </label>
                        </div>
                        
                        <!-- Password Field -->
                        <div class="compact-field px-2">
                            <label class="flex flex-col">
                                <p class="text-[#121416] compact-label">Password *</p>
                                <input
                                    name="password"
                                    type="password"
                                    placeholder="Enter your password"
                                    class="form-input compact-input flex w-full resize-none overflow-hidden rounded-lg text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white placeholder:text-[#6a7581] text-sm font-normal leading-normal"
                                    required
                                    autocomplete="current-password"
                                />
                            </label>
                        </div>
                        
                        <!-- Remember Me Checkbox -->
                        <div class="px-2 compact-field">
                            <label class="flex gap-x-3 items-start">
                                <input
                                    name="remember_me"
                                    type="checkbox"
                                    class="h-4 w-4 mt-0.5 rounded border-[#dde0e3] border-2 bg-transparent text-[#dce7f3] checked:bg-[#dce7f3] checked:border-[#dce7f3] checked:bg-[image:--checkbox-tick-svg] focus:ring-0 focus:ring-offset-0 focus:border-[#dde0e3] focus:outline-none"
                                />
                                <p class="text-[#121416] text-sm font-normal leading-normal">Remember me for 30 days</p>
                            </label>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="px-2 py-2">
                            <button
                                type="submit"
                                class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#dce7f3] text-[#121416] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#c8ddf0] transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                id="submit-btn"
                            >
                                <span class="truncate">Sign In</span>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Forgot Password Link -->
                    <div class="px-2 text-center mb-2">
                        <a href="forgot-password.php" class="text-[#3b82f6] text-sm hover:underline">Forgot your password?</a>
                    </div>
                    
                    <p class="text-[#6a7581] text-sm font-normal leading-normal px-2 text-center mt-2">
                        Don't have an account? <a href="signup.php" class="text-[#3b82f6] hover:underline">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced form validation and security
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submit-btn');
            const mobileField = document.querySelector('input[name="mobile"]');
            const passwordField = document.querySelector('input[name="password"]');

            // Mobile number formatting and validation
            mobileField.addEventListener('input', function(e) {
                // Remove non-digits
                let value = e.target.value.replace(/\D/g, '');
                // Limit to 10 digits
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }
                e.target.value = value;
            });

            // Enhanced form validation
            form.addEventListener('submit', function(e) {
                const mobile = mobileField.value;
                const password = passwordField.value;

                // Disable submit button to prevent double submission
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="truncate">Signing In...</span>';

                // Mobile validation
                if (!/^[6-9][0-9]{9}$/.test(mobile)) {
                    e.preventDefault();
                    alert('Please enter a valid Indian mobile number starting with 6, 7, 8, or 9');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span class="truncate">Sign In</span>';
                    return false;
                }

                // Password validation
                if (password.length === 0) {
                    e.preventDefault();
                    alert('Password is required!');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span class="truncate">Sign In</span>';
                    return false;
                }

                // Re-enable button if form submission fails for other reasons
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span class="truncate">Sign In</span>';
                }, 5000);
            });

            // Auto-focus on mobile field when page loads
            if (mobileField && !mobileField.value) {
                mobileField.focus();
            }

            // Prevent form resubmission on page refresh
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        });

        // Security: Clear sensitive data from memory on page unload
        window.addEventListener('beforeunload', function() {
            const passwordInputs = document.querySelectorAll('input[type="password"]');
            passwordInputs.forEach(input => {
                input.value = '';
            });
        });
    </script>
</body>
</html>