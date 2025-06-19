<?php
// Secure session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);
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

// CSRF Token Generation
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Rate limiting (simple implementation)
$max_attempts = 5;
$time_window = 300; // 5 minutes
$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

if (!isset($_SESSION['signup_attempts'])) {
    $_SESSION['signup_attempts'] = [];
}

// Clean old attempts
$_SESSION['signup_attempts'] = array_filter(
    $_SESSION['signup_attempts'],
    function($timestamp) use ($time_window) {
        return (time() - $timestamp) < $time_window;
    }
);

// Check for success message from redirect
if (isset($_SESSION['signup_success'])) {
    $success_message = $_SESSION['signup_success'];
    unset($_SESSION['signup_success']);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF Token Validation
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $errors[] = "Invalid request. Please try again.";
    } else {
        // Rate limiting check
        if (count($_SESSION['signup_attempts']) >= $max_attempts) {
            $errors[] = "Too many signup attempts. Please try again later.";
        } else {
            // Add current attempt
            $_SESSION['signup_attempts'][] = time();
            
            // Get form data and sanitize
            $mobile = trim($_POST['mobile'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $terms_agreed = isset($_POST['terms_agreed']);

            // Enhanced Validation
            if (empty($mobile)) {
                $errors[] = "Mobile number is required.";
            } elseif (!preg_match('/^[6-9][0-9]{9}$/', $mobile)) {
                $errors[] = "Please enter a valid Indian mobile number.";
            }

            if (empty($password)) {
                $errors[] = "Password is required.";
            } elseif (strlen($password) < 8) {
                $errors[] = "Password must be at least 8 characters long.";
            } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/', $password)) {
                $errors[] = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
            }

            if ($password !== $confirm_password) {
                $errors[] = "Passwords do not match.";
            }

            if (!$terms_agreed) {
                $errors[] = "You must agree to the Terms & Conditions.";
            }

            // If no errors, proceed with database insertion
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

                    // Check if mobile already exists
                    $stmt = $pdo->prepare("SELECT id FROM users WHERE number = ? LIMIT 1");
                    $stmt->execute([$mobile]);
                    
                    if ($stmt->rowCount() > 0) {
                        $errors[] = "An account with this mobile number already exists.";
                    } else {
                        // Hash the password with stronger algorithm
                        $hashed_password = password_hash($password, PASSWORD_ARGON2ID, [
                            'memory_cost' => 65536, // 64 MB
                            'time_cost' => 4,       // 4 iterations
                            'threads' => 3,         // 3 threads
                        ]);
                        
                        // Insert user into database with additional security fields
                        $stmt = $pdo->prepare("
                            INSERT INTO users (number, password, created_at, ip_address, user_agent, is_verified, status) 
                            VALUES (?, ?, NOW(), ?, ?, 0, 'active')
                        ");
                        $stmt->execute([$mobile, $hashed_password, $client_ip, $user_agent]);
                        
                        // Clear password from memory
                        $password = null;
                        $confirm_password = null;
                        
                        // Log successful registration (without sensitive data)
                        error_log("Successful registration for mobile: " . substr($mobile, 0, 3) . "XXXXX" . substr($mobile, -2));
                        
                        // Reset rate limiting after successful registration
                        $_SESSION['signup_attempts'] = [];
                        
                        // Store success message in session
                        $_SESSION['signup_success'] = "Account created successfully! Please verify your mobile number to login.";
                        
                        // Regenerate CSRF token
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                        
                        // SOLUTION: Redirect to prevent form resubmission and show success page
                        // Option 1: Redirect to login page with success message
                        header("Location: login.php?signup=success");
                        exit();
                        
                        // Option 2: Redirect to same page to show success message (uncomment if preferred)
                        // header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                        // exit();
                        
                        // Option 3: Redirect to a verification page (uncomment if you have one)
                        // header("Location: verify.php?mobile=" . urlencode($mobile));
                        // exit();
                    }
                } catch (PDOException $e) {
                    // Log detailed error for developers (not shown to users)
                    error_log("Database error in signup: " . $e->getMessage());
                    $errors[] = "Registration failed. Please try again later.";
                }
            }
        }
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
    <title>CodeCraft - Sign Up</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Correct order -->
    <link rel="stylesheet" href="includes/style.css">

    
  
       
</head>
<body>
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <div class="relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden"
         style='--checkbox-tick-svg: url(&apos;data:image/svg+xml,%3csvg viewBox=%270 0 16 16%27 fill=%27rgb(18,20,22)%27 xmlns=%27http://www.w3.org/2000/svg%27%3e%3cpath d=%27M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z%27/%3e%3c/svg%3e&apos;); font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        
        <div class="layout-container flex h-full grow flex-col">
            <?php include 'header.php'; ?>
            
            <!-- Main Content -->
            <div class="px-4 md:px-20 flex flex-1 justify-center py-2">
                <div class="layout-content-container flex flex-col w-full max-w-[420px] py-2 flex-1">
                    <h2 class="text-[#121416] tracking-light text-[24px] font-bold leading-tight text-center compact-header">Create your account</h2>
                    
                    <!-- Success Message (if redirected back) -->
                    <?php if ($success_message): ?>
                        <div class="success-message">
                            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">✅</div>
                            <?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8'); ?>
                            <br><br>
                            <a href="login.php" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                                Go to Login
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Error Messages -->
                    <?php if (!empty($errors)): ?>
                        <div class="error-message">
                            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">❌</div>
                            <ul class="list-disc list-inside text-sm">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Signup Form (hide if success) -->
                    <?php if (!$success_message): ?>
                    <form method="POST" action="" class="form-container compact-form" novalidate id="signup-form">
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
                                    placeholder="Enter a strong password"
                                    class="form-input compact-input flex w-full resize-none overflow-hidden rounded-lg text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white placeholder:text-[#6a7581] text-sm font-normal leading-normal"
                                    minlength="8"
                                    maxlength="128"
                                    required
                                    autocomplete="new-password"
                                    id="password"
                                />
                                <div id="password-strength" class="password-strength"></div>
                            </label>
                        </div>
                        
                        <!-- Confirm Password Field -->
                        <div class="compact-field px-2">
                            <label class="flex flex-col">
                                <p class="text-[#121416] compact-label">Confirm Password *</p>
                                <input
                                    name="confirm_password"
                                    type="password"
                                    placeholder="Confirm your password"
                                    class="form-input compact-input flex w-full resize-none overflow-hidden rounded-lg text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white placeholder:text-[#6a7581] text-sm font-normal leading-normal"
                                    required
                                    autocomplete="new-password"
                                    id="confirm-password"
                                />
                            </label>
                        </div>
                        
                        <!-- Terms Checkbox -->
                        <div class="px-2 compact-field">
                            <label class="flex gap-x-3 items-start">
                                <input
                                    name="terms_agreed"
                                    type="checkbox"
                                    class="h-4 w-4 mt-0.5 rounded border-[#dde0e3] border-2 bg-transparent text-[#dce7f3] checked:bg-[#dce7f3] checked:border-[#dce7f3] checked:bg-[image:--checkbox-tick-svg] focus:ring-0 focus:ring-offset-0 focus:border-[#dde0e3] focus:outline-none"
                                    required
                                />
                                <p class="text-[#121416] text-sm font-normal leading-normal">I agree to the <a style="color:blue;" href="term.html" target="_blank" rel="noopener noreferrer">Terms & Conditions</a></p>
                            </label>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="px-2 py-2">
                            <button
                                type="submit"
                                class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#dce7f3] text-[#121416] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#c8ddf0] transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                id="submit-btn"
                            >
                                <span class="truncate">Sign Up</span>
                            </button>
                        </div>
                    </form>
                    <?php endif; ?>
                    
                    <p class="text-[#6a7581] text-sm font-normal leading-normal px-2 text-center mt-2">
                        Already have an account? <a href="login.php" class="text-[#3b82f6] hover:underline">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced form validation and security
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('signup-form');
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirm-password');
            const strengthIndicator = document.getElementById('password-strength');
            const submitBtn = document.getElementById('submit-btn');
            const mobileField = document.querySelector('input[name="mobile"]');
            const loadingOverlay = document.getElementById('loading-overlay');

            // Exit if form doesn't exist (success page)
            if (!form) return;

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

            // Password strength checker
            function checkPasswordStrength(password) {
                let strength = 0;
                let feedback = [];

                if (password.length >= 8) strength++;
                else feedback.push('At least 8 characters');

                if (/[a-z]/.test(password)) strength++;
                else feedback.push('One lowercase letter');

                if (/[A-Z]/.test(password)) strength++;
                else feedback.push('One uppercase letter');

                if (/\d/.test(password)) strength++;
                else feedback.push('One number');

                if (/[@$!%*?&]/.test(password)) strength++;
                else feedback.push('One special character');

                return { strength, feedback };
            }

            passwordField.addEventListener('input', function() {
                const password = this.value;
                const result = checkPasswordStrength(password);
                
                let strengthText = '';
                let strengthClass = '';

                if (password.length === 0) {
                    strengthText = '';
                } else if (result.strength < 3) {
                    strengthText = 'Weak - Missing: ' + result.feedback.join(', ');
                    strengthClass = 'strength-weak';
                } else if (result.strength < 5) {
                    strengthText = 'Medium - Missing: ' + result.feedback.join(', ');
                    strengthClass = 'strength-medium';
                } else {
                    strengthText = 'Strong password!';
                    strengthClass = 'strength-strong';
                }

                strengthIndicator.textContent = strengthText;
                strengthIndicator.className = 'password-strength ' + strengthClass;
            });

            // Real-time password matching
            function checkPasswordMatch() {
                const password = passwordField.value;
                const confirmPassword = confirmPasswordField.value;
                
                if (confirmPassword && password !== confirmPassword) {
                    confirmPasswordField.setCustomValidity('Passwords do not match');
                } else {
                    confirmPasswordField.setCustomValidity('');
                }
            }

            passwordField.addEventListener('input', checkPasswordMatch);
            confirmPasswordField.addEventListener('input', checkPasswordMatch);

            // Enhanced form validation
            form.addEventListener('submit', function(e) {
                const password = passwordField.value;
                const confirmPassword = confirmPasswordField.value;
                const mobile = mobileField.value;

                // Show loading overlay
                loadingOverlay.style.display = 'flex';

                // Disable submit button to prevent double submission
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="truncate">Creating Account...</span>';

                // Mobile validation
                if (!/^[6-9][0-9]{9}$/.test(mobile)) {
                    e.preventDefault();
                    alert('Please enter a valid Indian mobile number starting with 6, 7, 8, or 9');
                    resetSubmitButton();
                    return false;
                }

                // Password validation
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                    resetSubmitButton();
                    return false;
                }

                if (password.length < 8) {
                    e.preventDefault();
                    alert('Password must be at least 8 characters long!');
                    resetSubmitButton();
                    return false;
                }

                const strengthResult = checkPasswordStrength(password);
                if (strengthResult.strength < 4) {
                    e.preventDefault();
                    alert('Please use a stronger password. Missing: ' + strengthResult.feedback.join(', '));
                    resetSubmitButton();
                    return false;
                }

                // If validation passes, form will be submitted and page will redirect
            });

            function resetSubmitButton() {
                loadingOverlay.style.display = 'none';
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span class="truncate">Sign Up</span>';
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