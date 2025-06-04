<?php
session_start();

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

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize
    $mobile = trim($_POST['mobile'] ?? '');
    $user_password = $_POST['password'] ?? '';
    $remember_me = isset($_POST['remember_me']);

    // Validation
    if (empty($mobile)) {
        $errors[] = "Mobile number is required.";
    } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $errors[] = "Please enter a valid 10-digit mobile number.";
    }

    if (empty($user_password)) {
        $errors[] = "Password is required.";
    }

    // If no errors, proceed with authentication
    if (empty($errors)) {
        try {
            // Create PDO connection - use correct variable name
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if user exists and get password hash
            $stmt = $pdo->prepare("SELECT id, password FROM users WHERE number = ?");
            $stmt->execute([$mobile]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($user_password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_mobile'] = $mobile;
                
                // Update last login time (uncommented)
                $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                $stmt->execute([$user['id']]);
                
                // Set remember me cookie if checked
                if ($remember_me) {
                    $cookie_value = base64_encode($user['id'] . ':' . hash('sha256', $user['password']));
                    setcookie('remember_user', $cookie_value, time() + (30 * 24 * 60 * 60), '/', '', false, true); // Added httpOnly flag for security
                }
                
                // Redirect to index page
                header("Location: index.php");
                exit();
            } else {
                $errors[] = "Invalid mobile number or password.";
            }
        } catch (PDOException $e) {
            $errors[] = "Database connection failed. Please try again later.";
            // Log the actual error for debugging (don't show to user)
            error_log("Database error: " . $e->getMessage());
        }
    }
}

// Check for remember me cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
    try {
        $cookie_data = base64_decode($_COOKIE['remember_user']);
        $parts = explode(':', $cookie_data);
        
        if (count($parts) === 2) {
            $user_id = $parts[0];
            $password_hash = $parts[1];
            
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $pdo->prepare("SELECT id, number, password FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && hash('sha256', $user['password']) === $password_hash) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_mobile'] = $user['number'];
                header("Location: index.php");
                exit();
            } else {
                // Invalid cookie, remove it
                setcookie('remember_user', '', time() - 3600, '/', '', false, true);
            }
        }
    } catch (Exception $e) {
        // Invalid cookie, remove it
        setcookie('remember_user', '', time() - 3600, '/', '', false, true);
        error_log("Cookie validation error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        /* Custom responsive styles */
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
            
            .mobile-menu {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                border-top: 1px solid #f1f2f4;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                z-index: 50;
                transform: translateY(-100%);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease-in-out;
            }
            
            .mobile-menu.show {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
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
            
            .mobile-menu {
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
        
        /* Error and success message styles */
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
        
        /* Form input focus improvements */
        .form-input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        }
        
        /* Compact form styling */
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

        /* Hamburger animation */
        .hamburger {
            cursor: pointer;
            width: 24px;
            height: 24px;
            position: relative;
            transition: all 0.3s ease;
        }

        .hamburger span {
            display: block;
            position: absolute;
            height: 2px;
            width: 100%;
            background: #121416;
            border-radius: 1px;
            opacity: 1;
            left: 0;
            transform: rotate(0deg);
            transition: all 0.3s ease;
        }

        .hamburger span:nth-child(1) {
            top: 0px;
        }

        .hamburger span:nth-child(2) {
            top: 8px;
        }

        .hamburger span:nth-child(3) {
            top: 16px;
        }

        .hamburger.active span:nth-child(1) {
            top: 8px;
            transform: rotate(135deg);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
            left: -60px;
        }

        .hamburger.active span:nth-child(3) {
            top: 8px;
            transform: rotate(-135deg);
        }

        /* Welcome back text styling */
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
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Success Message -->
                    <?php if ($success_message): ?>
                        <div class="success-message">
                            <?php echo htmlspecialchars($success_message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Login Form -->
                    <form method="POST" action="" class="form-container compact-form">
                        <!-- Mobile Field -->
                        <div class="compact-field px-2">
                            <label class="flex flex-col">
                                <p class="text-[#121416] compact-label">Mobile Number *</p>
                                <input
                                    name="mobile"
                                    type="tel"
                                    placeholder="Enter your mobile number"
                                    class="form-input compact-input flex w-full resize-none overflow-hidden rounded-lg text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white placeholder:text-[#6a7581] text-sm font-normal leading-normal"
                                    pattern="[0-9]{10}"
                                    title="Please enter a valid 10-digit mobile number"
                                    value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : ''; ?>"
                                    required
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
                                class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#dce7f3] text-[#121416] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#c8ddf0] transition-colors"
                            >
                                <span class="truncate">Sign In</span>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Forgot Password Link -->
                    <div class="px-2 text-center mb-2">
                        <a href="#" class="text-[#3b82f6] text-sm hover:underline">Forgot your password?</a>
                    </div>
                    
                    <p class="text-[#6a7581] text-sm font-normal leading-normal px-2 text-center mt-2">
                        Don't have an account? <a href="signup.php" class="text-[#3b82f6] hover:underline">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const hamburger = document.getElementById('hamburger');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (hamburger && mobileMenu) {
                const isClickInsideNav = hamburger.contains(event.target) || mobileMenu.contains(event.target);
                
                if (!isClickInsideNav && mobileMenu.classList.contains('show')) {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('show');
                }
            }
        });

        // Close mobile menu when clicking on a link
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu) {
            const mobileMenuLinks = mobileMenu.querySelectorAll('a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const hamburger = document.getElementById('hamburger');
                    if (hamburger) {
                        hamburger.classList.remove('active');
                        mobileMenu.classList.remove('show');
                    }
                });
            });
        }

        // Close mobile menu on window resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const hamburger = document.getElementById('hamburger');
                const mobileMenu = document.getElementById('mobile-menu');
                if (hamburger && mobileMenu) {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('show');
                }
            }
        });

        // Basic form validation on client side
        document.querySelector('form').addEventListener('submit', function(e) {
            const mobile = document.querySelector('input[name="mobile"]').value;
            const password = document.querySelector('input[name="password"]').value;
            
            if (mobile.length !== 10 || !/^[0-9]+$/.test(mobile)) {
                e.preventDefault();
                alert('Please enter a valid 10-digit mobile number!');
                return false;
            }
            
            if (password.length === 0) {
                e.preventDefault();
                alert('Password is required!');
                return false;
            }
        });

        // Auto-focus on mobile field when page loads
        window.addEventListener('load', function() {
            const mobileInput = document.querySelector('input[name="mobile"]');
            if (mobileInput && !mobileInput.value) {
                mobileInput.focus();
            }
        });
    </script>
</body>
</html>