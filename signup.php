<?php
// Database configuration
$host = 'localhost';
$dbname = 'root';
$username = 'root';
$password = '3435';
=======


// Initialize variables
$errors = [];
$success_message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $terms_agreed = isset($_POST['terms_agreed']);

    // Validation
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($mobile)) {
        $errors[] = "Mobile number is required.";
    } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $errors[] = "Please enter a valid 10-digit mobile number.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
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
            // Create PDO connection
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $errors[] = "An account with this email already exists.";
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert user into database
                $stmt = $pdo->prepare("INSERT INTO users (name, email, mobile, password, created_at) VALUES (?, ?, ?, ?, NOW())");
                $stmt->execute([$name, $email, $mobile, $hashed_password]);
                
                $success_message = "Account created successfully! You can now login.";
                
                // Optional: Redirect to login page after 2 seconds
                // header("refresh:2;url=login.php");
            }
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
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
    <title>Stitch Design - Sign Up</title>
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
            
            .mobile-menu {
                display: block;
            }
            
            .form-container {
                padding: 1rem;
            }
            
            .text-\[28px\] {
                font-size: 24px;
            }
        }
        
        @media (min-width: 769px) {
            .mobile-menu {
                display: none;
            }
        }
        
        /* Error and success message styles */
        .error-message {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .success-message {
            background-color: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        
        /* Form input focus improvements */
        .form-input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
</head>
<body>
    <div class="relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden"
         style='--checkbox-tick-svg: url(&apos;data:image/svg+xml,%3csvg viewBox=%270 0 16 16%27 fill=%27rgb(18,20,22)%27 xmlns=%27http://www.w3.org/2000/svg%27%3e%3cpath d=%27M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z%27/%3e%3c/svg%3e&apos;); font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        
        <div class="layout-container flex h-full grow flex-col">
            <!-- Header -->
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f1f2f4] px-4 md:px-10 py-3">
                <div class="flex items-center gap-4 text-[#121416]">
                    <div class="size-4">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <h2 class="text-[#121416] text-lg font-bold leading-tight tracking-[-0.015em]">CodeCraft</h2>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="header-nav flex flex-1 justify-end gap-8">
                    <div class="flex items-center gap-9">
                        <a class="text-[#121416] text-sm font-medium leading-normal" href="#">Home</a>
                        <a class="text-[#121416] text-sm font-medium leading-normal" href="#">Projects</a>
                        <a class="text-[#121416] text-sm font-medium leading-normal" href="#">About Us</a>
                        <a class="text-[#121416] text-sm font-medium leading-normal" href="#">Contact</a>
                    </div>
                    <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#f1f2f4] text-[#121416] text-sm font-bold leading-normal tracking-[0.015em]">
                        <span class="truncate">Login</span>
                    </button>
                </div>
                
                <!-- Mobile Menu Button -->
                <div class="mobile-menu">
                    <button class="text-[#121416] p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Main Content -->
            <div class="px-4 md:px-40 flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col w-full max-w-[512px] py-5 flex-1">
                    <h2 class="text-[#121416] tracking-light text-[28px] font-bold leading-tight px-4 text-center pb-3 pt-5">Create your account</h2>
                    
                    <!-- Error Messages -->
                    <?php if (!empty($errors)): ?>
                        <div class="error-message mx-4">
                            <ul class="list-disc list-inside">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Success Message -->
                    <?php if ($success_message): ?>
                        <div class="success-message mx-4">
                            <?php echo htmlspecialchars($success_message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Signup Form -->
                    <form method="POST" action="" class="form-container">
                        <!-- Name Field -->
<<<<<<< HEAD
                        <div class="flex max-w-full flex-wrap items-end gap-4 px-4 py-3">
=======
                        <!-- <div class="flex max-w-full flex-wrap items-end gap-4 px-4 py-3">
>>>>>>> a50bbbf (changed html to php and created header and made cart and about code proper)
                            <label class="flex flex-col min-w-40 flex-1">
                                <p class="text-[#121416] text-base font-medium leading-normal pb-2">Name *</p>
                                <input
                                    name="name"
                                    type="text"
                                    placeholder="Enter your name"
                                    value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white h-14 placeholder:text-[#6a7581] p-[15px] text-base font-normal leading-normal"
                                    required
                                />
                            </label>
<<<<<<< HEAD
                        </div>
                        
                        <!-- Email Field -->
                        <div class="flex max-w-full flex-wrap items-end gap-4 px-4 py-3">
=======
                        </div> -->
                        
                        <!-- Email Field -->
                        <!-- <div class="flex max-w-full flex-wrap items-end gap-4 px-4 py-3">
>>>>>>> a50bbbf (changed html to php and created header and made cart and about code proper)
                            <label class="flex flex-col min-w-40 flex-1">
                                <p class="text-[#121416] text-base font-medium leading-normal pb-2">Email *</p>
                                <input
                                    name="email"
                                    type="email"
                                    placeholder="Enter your email"
                                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white h-14 placeholder:text-[#6a7581] p-[15px] text-base font-normal leading-normal"
                                    required
                                />
                            </label>
<<<<<<< HEAD
                        </div>
=======
                        </div> -->
>>>>>>> a50bbbf (changed html to php and created header and made cart and about code proper)
                        
                        <!-- Mobile Field -->
                        <div class="flex max-w-full flex-wrap items-end gap-4 px-4 py-3">
                            <label class="flex flex-col min-w-40 flex-1">
                                <p class="text-[#121416] text-base font-medium leading-normal pb-2">Mobile Number *</p>
                                <input
                                    name="mobile"
                                    type="tel"
                                    placeholder="Enter your mobile number"
                                    value="<?php echo htmlspecialchars($_POST['mobile'] ?? ''); ?>"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white h-14 placeholder:text-[#6a7581] p-[15px] text-base font-normal leading-normal"
                                    pattern="[0-9]{10}"
                                    title="Please enter a valid 10-digit mobile number"
                                    required
                                />
                            </label>
                        </div>
                        
                        <!-- Password Field -->
                        <div class="flex max-w-full flex-wrap items-end gap-4 px-4 py-3">
                            <label class="flex flex-col min-w-40 flex-1">
                                <p class="text-[#121416] text-base font-medium leading-normal pb-2">Password *</p>
                                <input
                                    name="password"
                                    type="password"
                                    placeholder="Enter your password"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white h-14 placeholder:text-[#6a7581] p-[15px] text-base font-normal leading-normal"
                                    minlength="6"
                                    required
                                />
                            </label>
                        </div>
                        
                        <!-- Confirm Password Field -->
                        <div class="flex max-w-full flex-wrap items-end gap-4 px-4 py-3">
                            <label class="flex flex-col min-w-40 flex-1">
                                <p class="text-[#121416] text-base font-medium leading-normal pb-2">Confirm Password *</p>
                                <input
                                    name="confirm_password"
                                    type="password"
                                    placeholder="Confirm your password"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#121416] focus:outline-0 focus:ring-0 border border-[#dde0e3] bg-white h-14 placeholder:text-[#6a7581] p-[15px] text-base font-normal leading-normal"
                                    required
                                />
                            </label>
                        </div>
                        
                        <!-- Terms Checkbox -->
                        <div class="px-4">
                            <label class="flex gap-x-3 py-3 flex-row">
                                <input
                                    name="terms_agreed"
                                    type="checkbox"
                                    class="h-5 w-5 rounded border-[#dde0e3] border-2 bg-transparent text-[#dce7f3] checked:bg-[#dce7f3] checked:border-[#dce7f3] checked:bg-[image:--checkbox-tick-svg] focus:ring-0 focus:ring-offset-0 focus:border-[#dde0e3] focus:outline-none"
                                    required
                                />
                                <p class="text-[#121416] text-base font-normal leading-normal">I agree to the Terms & Conditions *</p>
                            </label>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex px-4 py-3">
                            <button
                                type="submit"
                                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 flex-1 bg-[#dce7f3] text-[#121416] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#c8ddf0] transition-colors"
                            >
                                <span class="truncate">Sign Up</span>
                            </button>
                        </div>
                    </form>
                    
                    <p class="text-[#6a7581] text-sm font-normal leading-normal pb-3 pt-1 px-4 text-center">
                        Already have an account? <a href="login.php" class="text-[#3b82f6] hover:underline">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Basic form validation on client side
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long!');
                return false;
            }
        });
    </script>
</body>
</html>