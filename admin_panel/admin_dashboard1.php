<?php
session_start();

// Check if user is not logged in
if(!isset($_SESSION['admin_id'])){
    header('location: login.php');
    exit();
}

$admin_username = $_SESSION['admin_username'] ?? 'Admin';
$login_time = $_SESSION['login_time'] ?? time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
        }
        
        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f1f1f1;
        }
        
        .welcome {
            color: #2b37e8;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #2b37e8;
        }
        
        .stat-title {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .stat-value {
            color: #1f2937;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .content {
            background: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .success-message {
            background: #10b981;
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="header">
            <h1 class="welcome">Welcome, <?php echo htmlspecialchars($admin_username); ?>!</h1>
            <a href="logout.php" class="logout-btn">
                <i class='bx bx-log-out'></i>
                Logout
            </a>
        </div>
        
        <div class="success-message">
            <i class='bx bx-check-circle'></i>
            <span>Login successful! You are now logged in via AJAX authentication.</span>
        </div>
        
        <div class="stats">
            <div class="stat-card">
                <div class="stat-title">Session ID</div>
                <div class="stat-value"><?php echo session_id(); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Login Time</div>
                <div class="stat-value"><?php echo date('H:i:s', $login_time); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Status</div>
                <div class="stat-value">Active</div>
            </div>
        </div>
        
        <div class="content">
            <h2>Dashboard Content</h2>
            <p>This is your admin dashboard. The login was processed using AJAX without page reload!</p>
            <p><strong>Authentication Method:</strong> AJAX POST Request</p>
            <p><strong>Session Management:</strong> PHP Sessions</p>
            <p><strong>Security Features:</strong> Session regeneration, input validation, CSRF protection ready</p>
        </div>
    </div>
</body>
</html>