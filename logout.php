<?php
session_start();

// Database configuration (for updating last logout timestamp)
$host = 'localhost';
$dbname = 'project_hub';
$username = 'suraj';
$password = 'Suraj@123';

// Initialize variables
$logout_message = '';
$redirect_delay = 3; // seconds before redirect

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Get user ID before destroying session
$user_id = $_SESSION['user_id'];
$user_mobile = $_SESSION['user_mobile'] ?? 'Unknown';

// Update last logout timestamp in database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Update last logout time
    $stmt = $pdo->prepare("UPDATE users SET last_logout = NOW() WHERE id = ?");
    $stmt->execute([$user_id]);
    
    $logout_message = "You have been successfully logged out.";
} catch (PDOException $e) {
    // Even if database update fails, we should still log out the user
    error_log("Database error during logout: " . $e->getMessage());
    $logout_message = "You have been logged out.";
}

// Remove remember me cookie if it exists
if (isset($_COOKIE['remember_user'])) {
    setcookie('remember_user', '', time() - 3600, '/', '', false, true);
}

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Log the logout action (optional - for security audit)
error_log("User logout: ID=$user_id, Mobile=$user_mobile, IP=" . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . ", Time=" . date('Y-m-d H:i:s'));

// Check if it's an AJAX request
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Return JSON response for AJAX requests
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => $logout_message,
        'redirect' => 'login.php'
    ]);
    exit();
}

// Check if instant redirect is requested
if (isset($_GET['redirect']) && $_GET['redirect'] === 'now') {
    header("Location: index.php");
    exit();
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
    <title>CodeCraft - Logout</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <style>
        /* Custom styles for logout page */
        .logout-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: "Space Grotesk", "Noto Sans", sans-serif;
        }
        
        .logout-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            padding: 2rem;
            text-align: center;
            max-width: 400px;
            width: 90%;
            margin: 1rem;
        }
        
        .logout-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            background: #dcfce7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .success-checkmark {
            width: 32px;
            height: 32px;
            stroke: #16a34a;
            stroke-width: 2;
            fill: none;
        }
        
        .logout-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #121416;
            margin-bottom: 0.5rem;
        }
        
        .logout-message {
            color: #6a7581;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        
        .countdown-text {
            color: #3b82f6;
            font-weight: 500;
            margin-bottom: 1rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-primary {
            background: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            transition: background-color 0.2s;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            background: #2563eb;
        }
        
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            transition: background-color 0.2s;
            border: none;
            cursor: pointer;
        }
        
        .btn-secondary:hover {
            background: #e5e7eb;
        }
        
        @media (max-width: 480px) {
            .logout-card {
                padding: 1.5rem;
                margin: 0.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-primary, .btn-secondary {
                width: 100%;
                text-align: center;
            }
        }
        
        /* Loading animation */
        .loading-dots {
            display: inline-block;
        }
        
        .loading-dots::after {
            content: '';
            animation: dots 1.5s steps(5, end) infinite;
        }
        
        @keyframes dots {
            0%, 20% { content: ''; }
            40% { content: '.'; }
            60% { content: '..'; }
            80%, 100% { content: '...'; }
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-card">
            <!-- Success Icon -->
            <div class="logout-icon">
                <svg class="success-checkmark" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <!-- Logout Title -->
            <h1 class="logout-title">Logout Successful</h1>
            
            <!-- Logout Message -->
            <p class="logout-message">
                <?php echo htmlspecialchars($logout_message); ?>
                <br>
                Thank you for using CodeCraft!
            </p>
            
            <!-- Countdown Timer -->
            <p class="countdown-text">
                Redirecting to Main Page in <span id="countdown"><?php echo $redirect_delay; ?></span> seconds<span class="loading-dots"></span>
            </p>
            <p class="countdown-text">
                If you are not redirected automatically, please click the buttons below.
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="login.php" class="btn-primary">Login Again</a>
                <a href="index.php" class="btn-secondary">Go to Home</a>
            </div>
        </div>
    </div>

    <script>
        // Countdown timer
        let countdownElement = document.getElementById('countdown');
        let timeLeft = <?php echo $redirect_delay; ?>;
        
        function updateCountdown() {
            if (timeLeft > 0) {
                countdownElement.textContent = timeLeft;
                timeLeft--;
                setTimeout(updateCountdown, 1000);
            } else {
                // Redirect to login page
                window.location.href = 'login.php';
            }
        }
        
        // Start countdown
        updateCountdown();
        
        // Allow user to cancel redirect by interacting with the page
        let redirectCancelled = false;
        
        function cancelRedirect() {
            if (!redirectCancelled) {
                redirectCancelled = true;
                countdownElement.parentElement.innerHTML = 'Automatic redirect cancelled. You can manually navigate using the buttons above.';
            }
        }
        
        // Cancel redirect on any user interaction
        document.addEventListener('click', cancelRedirect);
        document.addEventListener('keydown', cancelRedirect);
        document.addEventListener('scroll', cancelRedirect);
        
        // Prevent back button from accessing protected pages
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
        
        // Clear any stored form data
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        
        // Optional: Show confirmation dialog if user tries to close/refresh
        window.addEventListener('beforeunload', function (e) {
            // Most browsers will show their own message
            e.preventDefault();
            e.returnValue = '';
        });
        
        // Log successful logout (client-side tracking)
        console.log('User successfully logged out at:', new Date().toISOString());
    </script>
</body>
</html>