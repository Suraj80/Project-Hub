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
$step = $_SESSION['forgot_step'] ?? 1; // Step 1: Phone number, Step 2: OTP verification

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

if (!isset($_SESSION['forgot_attempts'])) {
    $_SESSION['forgot_attempts'] = [];
}

// Clean old attempts
$_SESSION['forgot_attempts'] = array_filter(
    $_SESSION['forgot_attempts'],
    function($timestamp) use ($time_window) {
        return (time() - $timestamp) < $time_window;
    }
);

// Function to generate OTP
function generateOTP() {
    return sprintf("%06d", mt_rand(0, 999999));
}

// Function to send OTP (placeholder - integrate with your SMS service)
function sendOTP($mobile, $otp) {
    // TODO: Integrate with SMS service like Twilio, TextLocal, etc.
    // For now, we'll just log it (remove in production)
    error_log("OTP for mobile $mobile: $otp");
    
    // Return true for success, false for failure
    return true;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF Token Validation
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $errors[] = "Invalid request. Please try again.";
    } else {
        // Rate limiting check
        if (count($_SESSION['forgot_attempts']) >= $max_attempts) {
            $errors[] = "Too many attempts. Please try again later.";
        } else {
            // Add current attempt
            $_SESSION['forgot_attempts'][] = time();
            
            if ($_POST['action'] === 'send_otp') {
                // Step 1: Process mobile number and send OTP
                $mobile = trim($_POST['mobile'] ?? '');
                
                // Enhanced Validation
                if (empty($mobile)) {
                    $errors[] = "Mobile number is required.";
                } elseif (!preg_match('/^[6-9][0-9]{9}$/', $mobile)) {
                    $errors[] = "Please enter a valid Indian mobile number.";
                }
                
                // If no errors, check if user exists and send OTP
                if (empty($errors)) {
                    try {
                        // Create PDO connection with secure settings
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

                        // Check if user exists
                        $stmt = $pdo->prepare("SELECT id FROM users WHERE number = ? LIMIT 1");
                        $stmt->execute([$mobile]);
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($user) {
                            // Generate and store OTP
                            $otp = generateOTP();
                            $otp_expires = date('Y-m-d H:i:s', time() + 600); // 10 minutes expiry
                            
                            // Store OTP in database (hashed for security)
                            $hashed_otp = password_hash($otp, PASSWORD_DEFAULT);
                            $stmt = $pdo->prepare("UPDATE users SET verification_token = ?, verification_expires = ? WHERE number = ?");
                            $stmt->execute([$hashed_otp, $otp_expires, $mobile]);
                            
                            // Send OTP via SMS
                            if (sendOTP($mobile, $otp)) {
                                $_SESSION['forgot_mobile'] = $mobile;
                                $_SESSION['forgot_step'] = 2;
                                $_SESSION['otp_sent_time'] = time();
                                $step = 2;
                                $success_message = "OTP has been sent to your mobile number. Please check your SMS.";
                                
                                // Reset rate limiting after successful OTP send
                                $_SESSION['forgot_attempts'] = [];
                                
                                // Log OTP send (without sensitive data)
                                error_log("OTP sent for password reset to mobile: " . substr($mobile, 0, 3) . "XXXXX" . substr($mobile, -2));
                            } else {
                                $errors[] = "Failed to send OTP. Please try again later.";
                            }
                        } else {
                            $errors[] = "No account found with this mobile number.";
                        }
                    } catch (PDOException $e) {
                        error_log("Database error in forgot password: " . $e->getMessage());
                        $errors[] = "Something went wrong. Please try again later.";
                    }
                }
                
            } elseif ($_POST['action'] === 'verify_otp') {
                // Step 2: Verify OTP
                $otp = trim($_POST['otp'] ?? '');
                $mobile = $_SESSION['forgot_mobile'] ?? '';
                
                if (empty($otp)) {
                    $errors[] = "OTP is required.";
                } elseif (!preg_match('/^[0-9]{6}$/', $otp)) {
                    $errors[] = "Please enter a valid 6-digit OTP.";
                }
                
                if (empty($mobile)) {
                    $errors[] = "Session expired. Please start again.";
                    $_SESSION['forgot_step'] = 1;
                    $step = 1;
                }
                
                // If no errors, verify OTP
                if (empty($errors)) {
                    try {
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

                        // Get user's OTP data
                        $stmt = $pdo->prepare("SELECT id, verification_token, verification_expires FROM users WHERE number = ? LIMIT 1");
                        $stmt->execute([$mobile]);
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($user && $user['verification_token'] && $user['verification_expires']) {
                            // Check if OTP is not expired
                            if (strtotime($user['verification_expires']) > time()) {
                                // Verify OTP
                                if (password_verify($otp, $user['reset_otp'])) {
                                    // OTP verified successfully
                                    // Clear OTP from database
                                    $stmt = $pdo->prepare("UPDATE users SET verification_token = NULL, verification_expires = NULL WHERE id = ?");
                                    $stmt->execute([$user['id']]);
                                    
                                    // Generate password reset token
                                    $reset_token = bin2hex(random_bytes(32));
                                    $reset_expires = date('Y-m-d H:i:s', time() + 1800); // 30 minutes
                                    
                                    $stmt = $pdo->prepare("UPDATE users SET verification_token = ?, verification_expires = ? WHERE id = ?");
                                    $stmt->execute([$reset_token, $reset_expires, $user['id']]);
                                    
                                    // Clear session data
                                    unset($_SESSION['forgot_mobile']);
                                    unset($_SESSION['forgot_step']);
                                    unset($_SESSION['otp_sent_time']);
                                    $_SESSION['forgot_attempts'] = [];
                                    
                                    // Log successful OTP verification
                                    error_log("OTP verified successfully for mobile: " . substr($mobile, 0, 3) . "XXXXX" . substr($mobile, -2));
                                    
                                    // Redirect to reset password page
                                    header("Location: reset_password.php?token=" . $reset_token);
                                    exit();
                                } else {
                                    $errors[] = "Invalid OTP. Please try again.";
                                }
                            } else {
                                $errors[] = "OTP has expired. Please request a new one.";
                                $_SESSION['forgot_step'] = 1;
                                $step = 1;
                                unset($_SESSION['forgot_mobile']);
                            }
                        } else {
                            $errors[] = "Invalid request. Please start again.";
                            $_SESSION['forgot_step'] = 1;
                            $step = 1;
                            unset($_SESSION['forgot_mobile']);
                        }
                    } catch (PDOException $e) {
                        error_log("Database error in OTP verification: " . $e->getMessage());
                        $errors[] = "Something went wrong. Please try again later.";
                    }
                }
            }
        }
    }
}

// Handle resend OTP
if (isset($_GET['resend']) && $_GET['resend'] === '1' && $step === 2) {
    $mobile = $_SESSION['forgot_mobile'] ?? '';
    
    // Check if enough time has passed since last OTP (prevent spam)
    $last_otp_time = $_SESSION['otp_sent_time'] ?? 0;
    $time_since_last_otp = time() - $last_otp_time;
    
    if ($time_since_last_otp < 60) { // 1 minute cooldown
        $errors[] = "Please wait " . (60 - $time_since_last_otp) . " seconds before requesting a new OTP.";
    } elseif (empty($mobile)) {
        $errors[] = "Session expired. Please start again.";
        $_SESSION['forgot_step'] = 1;
        $step = 1;
    } else {
        // Generate and send new OTP
        try {
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

            $otp = generateOTP();
            $otp_expires = date('Y-m-d H:i:s', time() + 600); // 10 minutes expiry
            
            $hashed_otp = password_hash($otp, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET verification_token = ?, verification_expires = ? WHERE number = ?");
            $stmt->execute([$hashed_otp, $otp_expires, $mobile]);
            
            if (sendOTP($mobile, $otp)) {
                $_SESSION['otp_sent_time'] = time();
                $success_message = "New OTP has been sent to your mobile number.";
            } else {
                $errors[] = "Failed to send OTP. Please try again later.";
            }
        } catch (PDOException $e) {
            error_log("Database error in resend OTP: " . $e->getMessage());
            $errors[] = "Something went wrong. Please try again later.";
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
    <title>CodeCraft - Forgot Password</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <style>
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
        
        .otp-input {
            text-align: center;
            letter-spacing: 0.5rem;
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .resend-link {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.875rem;
        }
        
        .resend-link:hover {
            text-decoration: underline;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .step-circle {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
            margin: 0 0.5rem;
        }
        
        .step-circle.active {
            background-color: #dce7f3;
            color: #121416;
        }
        
        .step-circle.inactive {
            background-color: #f3f4f6;
            color: #6a7581;
        }
        
        .step-line {
            width: 2rem;
            height: 2px;
            background-color: #e5e7eb;
        }
        
        .step-line.active {
            background-color: #dce7f3;
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
                    
                    <!-- Step Indicator -->
                    <div class="step-indicator">
                        <div class="step-circle <?php echo $step === 1 ? 'active' : 'inactive'; ?>">1</div>
                        <div class="step-line <?php echo $step === 2 ? 'active' : ''; ?>"></div>
                        <div class="step-circle <?php echo $step === 2 ? 'active' : 'inactive'; ?>">2</div>
                    </div>
                    
                    <?php if ($step === 1): ?>
                        <!-- Step 1: Enter Mobile Number -->
                        <h2 class="text-[#121416] tracking-light text-[24px] font-bold leading-tight text-center compact-header">Forgot Password</h2>
                        <p class="welcome-text">Enter your mobile number to receive an OTP</p>
                        
                    <?php else: ?>
                        <!-- Step 2: Enter OTP -->
                        <h2 class="text-[#121416] tracking-light text-[24px] font-bold leading-tight text-center compact-header">Verify OTP</h2>
                        <p class="welcome-text">Enter the 6-digit OTP sent to <?php echo htmlspecialchars(substr($_SESSION['forgot_mobile'], 0, 3) . 'XXXXX' . substr($_SESSION['forgot_mobile'], -2), ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                    
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
                    
                    <!-- Forms -->
                    <?php if ($step === 1): ?>
                        <!-- Step 1 Form: Mobile Number -->
                        <form method="POST" action="" class="form-container compact-form" novalidate>
                            <!-- CSRF Token -->
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                            <input type="hidden" name="action" value="send_otp">
                            
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
                            
                            <!-- Submit Button -->
                            <div class="px-2 py-2">
                                <button
                                    type="submit"
                                    class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#dce7f3] text-[#121416] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#c8ddf0] transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="submit-btn"
                                >
                                    <span class="truncate">Send OTP</span>
                                </button>
                            </div>
                        </form>
                        
                    <?php else: ?>
                        <!-- Step 2 Form: OTP Verification -->
                        <form method="POST" action="" class="form-container compact-form" novalidate>
                            <!-- CSRF Token -->
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                            <input type="hidden" name="action" value="verify_otp">
                            
                            <!-- OTP Field -->
                            <div class="compact-field px-2">
                                <label class="flex flex-col">
                                    <p class="text-[#121416] compact-label">Enter OTP *</p>
                                    <input
                                        name="otp"
                                        type="text"
                                        placeholder="000000"
                                        class="form-input compact-input otp-input flex w-full resize-none overflow-hidden rounded-lg text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white placeholder:text-[#6a7581] font-normal leading-normal"
                                        pattern="[0-9]{6}"
                                        title="Please enter a 6-digit OTP"
                                        maxlength="6"
                                        required
                                        autocomplete="one-time-code"
                                    />
                                </label>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="px-2 py-2">
                                <button
                                    type="submit"
                                    class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#dce7f3] text-[#121416] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#c8ddf0] transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="submit-btn"
                                >
                                    <span class="truncate">Verify OTP</span>
                                </button>
                            </div>
                        </form>
                        
                        <!-- Resend OTP Link -->
                        <div class="px-2 text-center mb-2">
                            <p class="text-[#6a7581] text-sm mb-2">Didn't receive the OTP?</p>
                            <a href="?resend=1" class="resend-link">Resend OTP</a>
                        </div>
                        
                        <!-- Change Mobile Number -->
                        <div class="px-2 text-center mb-2">
                            <a href="forgot_password.php" class="text-[#6a7581] text-sm hover:underline">Change mobile number</a>
                        </div>
                    <?php endif; ?>
                    
                    <p class="text-[#6a7581] text-sm font-normal leading-normal px-2 text-center mt-2">
                        Remember your password? <a href="login.php" class="text-[#3b82f6] hover:underline">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submit-btn');
            
            <?php if ($step === 1): ?>
                // Step 1: Mobile number validation
                const mobileField = document.querySelector('input[name="mobile"]');
                
                if (mobileField) {
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
                    
                    // Auto-focus on mobile field
                    if (!mobileField.value) {
                        mobileField.focus();
                    }
                }
                
                // Form validation for step 1
                form.addEventListener('submit', function(e) {
                    const mobile = mobileField.value;
                    
                    // Disable submit button to prevent double submission
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="truncate">Sending OTP...</span>';
                    
                    // Mobile validation
                    if (!/^[6-9][0-9]{9}$/.test(mobile)) {
                        e.preventDefault();
                        alert('Please enter a valid Indian mobile number starting with 6, 7, 8, or 9');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<span class="truncate">Send OTP</span>';
                        return false;
                    }
                    
                    // Re-enable button if form submission fails for other reasons
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<span class="truncate">Send OTP</span>';
                    }, 5000);
                });
                
            <?php else: ?>
                // Step 2: OTP validation
                const otpField = document.querySelector('input[name="otp"]');
                
                if (otpField) {
                    // OTP input formatting
                    otpField.addEventListener('input', function(e) {
                        // Remove non-digits
                        let value = e.target.value.replace(/\D/g, '');
                        // Limit to 6 digits
                        if (value.length > 6) {
                            value = value.substring(0, 6);
                        }
                        e.target.value = value;
                    });
                    
                    // Auto-focus on OTP field
                    otpField.focus();
                }
                
                // Form validation for step 2
                form.addEventListener('submit', function(e) {
                    const otp = otpField.value;
                    
                    // Disable submit button to prevent double submission
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="truncate">Verifying...</span>';

                    // OTP validation
                    if (!/^[0-9]{6}$/.test(otp)) {
                        e.preventDefault();
                        alert('Please enter a valid 6-digit OTP');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<span class="truncate">Verify OTP</span>';
                        return false;
                    }
                    
                    // Re-enable button if form submission fails for other reasons
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<span class="truncate">Verify OTP</span>';
                    }, 5000);
                });
                
                // Auto-submit when 6 digits are entered
                otpField.addEventListener('input', function(e) {
                    if (e.target.value.length === 6) {
                        // Small delay to ensure user sees the complete OTP
                        setTimeout(() => {
                            if (document.querySelector('input[name="otp"]').value.length === 6) {
                                form.submit();
                            }
                        }, 500);
                    }
                });
            <?php endif; ?>
            
            // Prevent multiple form submissions
            let formSubmitted = false;
            form.addEventListener('submit', function(e) {
                if (formSubmitted) {
                    e.preventDefault();
                    return false;
                }
                formSubmitted = true;
                
                // Reset after 10 seconds in case of errors
                setTimeout(() => {
                    formSubmitted = false;
                }, 10000);
            });
            
            // Auto-clear error messages after 10 seconds
            const errorMessages = document.querySelectorAll('.error-message');
            if (errorMessages.length > 0) {
                setTimeout(() => {
                    errorMessages.forEach(msg => {
                        if (msg) {
                            msg.style.transition = 'opacity 0.5s ease-out';
                            msg.style.opacity = '0';
                            setTimeout(() => {
                                if (msg.parentNode) {
                                    msg.parentNode.removeChild(msg);
                                }
                            }, 500);
                        }
                    });
                }, 10000);
            }
            
            // Auto-clear success messages after 5 seconds
            const successMessages = document.querySelectorAll('.success-message');
            if (successMessages.length > 0) {
                setTimeout(() => {
                    successMessages.forEach(msg => {
                        if (msg) {
                            msg.style.transition = 'opacity 0.5s ease-out';
                            msg.style.opacity = '0';
                            setTimeout(() => {
                                if (msg.parentNode) {
                                    msg.parentNode.removeChild(msg);
                                }
                            }, 500);
                        }
                    });
                }, 5000);
            }
            
            // Add loading state for resend OTP link
            const resendLink = document.querySelector('.resend-link');
            if (resendLink) {
                resendLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Add loading state
                    const originalText = this.textContent;
                    this.textContent = 'Sending...';
                    this.style.pointerEvents = 'none';
                    this.style.opacity = '0.6';
                    
                    // Navigate to resend URL
                    window.location.href = this.href;
                });
            }
            
            // Session timeout warning (25 minutes)
            <?php if ($step === 2): ?>
                let sessionWarningShown = false;
                setTimeout(() => {
                    if (!sessionWarningShown) {
                        sessionWarningShown = true;
                        if (confirm('Your session will expire soon. Click OK to stay on this page or Cancel to start over.')) {
                            // User wants to stay - refresh the page to extend session
                            window.location.reload();
                        } else {
                            // User wants to start over
                            window.location.href = 'forgot_password.php';
                        }
                    }
                }, 25 * 60 * 1000); // 25 minutes
            <?php endif; ?>
            
            // Add keyboard navigation support
            document.addEventListener('keydown', function(e) {
                // Enter key should submit the form
                if (e.key === 'Enter' && !e.shiftKey && !e.ctrlKey && !e.altKey) {
                    const activeElement = document.activeElement;
                    if (activeElement && (activeElement.name === 'mobile' || activeElement.name === 'otp')) {
                        e.preventDefault();
                        form.submit();
                    }
                }
                
                // Escape key should clear current input
                if (e.key === 'Escape') {
                    const activeElement = document.activeElement;
                    if (activeElement && (activeElement.name === 'mobile' || activeElement.name === 'otp')) {
                        activeElement.value = '';
                        activeElement.focus();
                    }
                }
            });
            
            // Add paste support for OTP field
            <?php if ($step === 2): ?>
                const otpField = document.querySelector('input[name="otp"]');
                if (otpField) {
                    otpField.addEventListener('paste', function(e) {
                        e.preventDefault();
                        
                        // Get pasted text
                        const pastedText = (e.clipboardData || window.clipboardData).getData('text');
                        
                        // Extract only digits and limit to 6
                        const digits = pastedText.replace(/\D/g, '').substring(0, 6);
                        
                        if (digits.length > 0) {
                            this.value = digits;
                            
                            // Auto-submit if 6 digits
                            if (digits.length === 6) {
                                setTimeout(() => {
                                    form.submit();
                                }, 500);
                            }
                        }
                    });
                }
            <?php endif; ?>
            
            // Add visual feedback for form interactions
            const inputs = document.querySelectorAll('input[type="tel"], input[type="text"]');
            inputs.forEach(input => {
                // Add focus styling
                input.addEventListener('focus', function() {
                    this.parentNode.style.transform = 'scale(1.02)';
                    this.parentNode.style.transition = 'transform 0.2s ease';
                });
                
                input.addEventListener('blur', function() {
                    this.parentNode.style.transform = 'scale(1)';
                });
                
                // Add validation styling
                input.addEventListener('input', function() {
                    const isValid = this.checkValidity() && this.value.length > 0;
                    
                    if (isValid) {
                        this.style.borderColor = '#10b981';
                        this.style.backgroundColor = '#f0fdf4';
                    } else if (this.value.length > 0) {
                        this.style.borderColor = '#ef4444';
                        this.style.backgroundColor = '#fef2f2';
                    } else {
                        this.style.borderColor = '#dde0e3';
                        this.style.backgroundColor = '#ffffff';
                    }
                });
            });
            
            // Add button hover effects
            const buttons = document.querySelectorAll('button[type="submit"]');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    if (!this.disabled) {
                        this.style.transform = 'translateY(-1px)';
                        this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
                        this.style.transition = 'all 0.2s ease';
                    }
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });
        });
        
        // Add error handling for network issues
        window.addEventListener('online', function() {
            const errorMessages = document.querySelectorAll('.error-message');
            let hasNetworkError = false;
            
            errorMessages.forEach(msg => {
                if (msg.textContent.includes('network') || msg.textContent.includes('connection')) {
                    hasNetworkError = true;
                }
            });
            
            if (hasNetworkError) {
                location.reload();
            }
        });
        
        window.addEventListener('offline', function() {
            const submitBtn = document.getElementById('submit-btn');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="truncate">No Internet Connection</span>';
            }
        });
        
        // Add form data persistence (in case of page refresh)
        <?php if ($step === 1): ?>
            const mobileField = document.querySelector('input[name="mobile"]');
            if (mobileField) {
                // Save to sessionStorage on input
                mobileField.addEventListener('input', function() {
                    if (typeof(Storage) !== "undefined") {
                        sessionStorage.setItem('forgot_mobile_temp', this.value);
                    }
                });
                
                // Restore from sessionStorage on page load
                if (typeof(Storage) !== "undefined" && !mobileField.value) {
                    const savedMobile = sessionStorage.getItem('forgot_mobile_temp');
                    if (savedMobile) {
                        mobileField.value = savedMobile;
                    }
                }
            }
        <?php endif; ?>
        
        // Clear temporary data when process completes
        <?php if ($step === 2): ?>
            if (typeof(Storage) !== "undefined") {
                sessionStorage.removeItem('forgot_mobile_temp');
            }
        <?php endif; ?>
    </script>
</body>
</html>