<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings - Update these with your actual database credentials
$host = 'localhost';
$dbname = 'project_hub';
$username = 'suraj';
$password = 'Suraj@123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Set JSON response header
header('Content-Type: application/json');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

$admin_id = $_SESSION['admin_id'];
$action = $_POST['action'] ?? '';

try {
    switch ($action) {
        case 'fetch_profile':
            fetchAdminProfile($pdo, $admin_id);
            break;
            
        case 'update_profile':
            updateAdminProfile($pdo, $admin_id);
            break;
            
        case 'change_password':
            changeAdminPassword($pdo, $admin_id);
            break;
            
        case 'delete_profile_image':
            deleteProfileImage($pdo, $admin_id);
            break;
            
        case 'logout':
            logout();
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
            break;
    }
} catch (Exception $e) {
    error_log("Profile Action Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function fetchAdminProfile($pdo, $admin_id) {
    try {
        // Fetch admin data
        $stmt = $pdo->prepare("
            SELECT id, full_name, email, role, profile_image, 
                   created_at, last_login, login_ip, status
            FROM admin 
            WHERE id = ?
        ");
        $stmt->execute([$admin_id]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$admin) {
            echo json_encode(['success' => false, 'message' => 'Admin not found']);
            return;
        }
        
        // Fetch user statistics
        $stats = getUserStats($pdo);
        
        echo json_encode([
            'success' => true,
            'data' => $admin,
            'stats' => $stats
        ]);
        
    } catch (Exception $e) {
        error_log("Fetch Profile Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function updateAdminProfile($pdo, $admin_id) {
    try {
        $full_name = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        
        // Validation
        if (empty($full_name)) {
            echo json_encode(['success' => false, 'message' => 'Full name is required']);
            return;
        }
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Valid email is required']);
            return;
        }
        
        // Check if email already exists for another admin
        $stmt = $pdo->prepare("SELECT id FROM admin WHERE email = ? AND id != ?");
        $stmt->execute([$email, $admin_id]);
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Email already exists']);
            return;
        }
        
        // Start transaction
        $pdo->beginTransaction();
        
        $updateFields = ['full_name = ?', 'email = ?', 'phone = ?'];
        $updateValues = [$full_name, $email, $phone];
        
        // Handle password change
        if (!empty($new_password)) {
            if (empty($current_password)) {
                $pdo->rollBack();
                echo json_encode(['success' => false, 'message' => 'Current password is required']);
                return;
            }
            
            // Verify current password
            $stmt = $pdo->prepare("SELECT password FROM admin WHERE id = ?");
            $stmt->execute([$admin_id]);
            $admin = $stmt->fetch();
            
            if (!$admin || !password_verify($current_password, $admin['password'])) {
                $pdo->rollBack();
                echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
                return;
            }
            
            if (strlen($new_password) < 6) {
                $pdo->rollBack();
                echo json_encode(['success' => false, 'message' => 'New password must be at least 6 characters']);
                return;
            }
            
            $updateFields[] = 'password = ?';
            $updateValues[] = password_hash($new_password, PASSWORD_DEFAULT);
        }
        
        // Handle profile image upload
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $upload_result = handleImageUpload($_FILES['profile_image'], $admin_id);
            if ($upload_result['success']) {
                $updateFields[] = 'profile_image = ?';
                $updateValues[] = $upload_result['file_path'];
            } else {
                $pdo->rollBack();
                echo json_encode(['success' => false, 'message' => $upload_result['message']]);
                return;
            }
        }
        
        // Update admin record
        $updateValues[] = $admin_id;
        $sql = "UPDATE admin SET " . implode(', ', $updateFields) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($updateValues);
        
        $pdo->commit();
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
        
    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Update Profile Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error updating profile']);
    }
}

function changeAdminPassword($pdo, $admin_id) {
    try {
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        
        if (empty($current_password) || empty($new_password)) {
            echo json_encode(['success' => false, 'message' => 'All password fields are required']);
            return;
        }
        
        if (strlen($new_password) < 6) {
            echo json_encode(['success' => false, 'message' => 'New password must be at least 6 characters']);
            return;
        }
        
        // Verify current password
        $stmt = $pdo->prepare("SELECT password FROM admin WHERE id = ?");
        $stmt->execute([$admin_id]);
        $admin = $stmt->fetch();
        
        if (!$admin || !password_verify($current_password, $admin['password'])) {
            echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
            return;
        }
        
        // Update password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE admin SET password = ? WHERE id = ?");
        $stmt->execute([$hashed_password, $admin_id]);
        
        echo json_encode(['success' => true, 'message' => 'Password changed successfully']);
        
    } catch (Exception $e) {
        error_log("Change Password Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error changing password']);
    }
}

function deleteProfileImage($pdo, $admin_id) {
    try {
        // Get current profile image
        $stmt = $pdo->prepare("SELECT profile_image FROM admin WHERE id = ?");
        $stmt->execute([$admin_id]);
        $admin = $stmt->fetch();
        
        if (!$admin) {
            echo json_encode(['success' => false, 'message' => 'Admin not found']);
            return;
        }
        
        // Delete file if exists
        if (!empty($admin['profile_image']) && file_exists('../' . $admin['profile_image'])) {
            unlink('../' . $admin['profile_image']);
        }
        
        // Update database
        $stmt = $pdo->prepare("UPDATE admin SET profile_image = NULL WHERE id = ?");
        $stmt->execute([$admin_id]);
        
        echo json_encode(['success' => true, 'message' => 'Profile image deleted successfully']);
        
    } catch (Exception $e) {
        error_log("Delete Profile Image Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error deleting profile image']);
    }
}

function handleImageUpload($file, $admin_id) {
    try {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB
        
        // Validate file type
        if (!in_array($file['type'], $allowed_types)) {
            return ['success' => false, 'message' => 'Invalid file type. Only JPEG, PNG, and GIF are allowed.'];
        }
        
        // Validate file size
        if ($file['size'] > $max_size) {
            return ['success' => false, 'message' => 'File size too large. Maximum 5MB allowed.'];
        }
        
        // Create upload directory if it doesn't exist
        $upload_dir = '../uploads/profiles/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        // Generate unique filename
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'admin_' . $admin_id . '_' . time() . '.' . $file_extension;
        $file_path = $upload_dir . $filename;
        $relative_path = 'uploads/profiles/' . $filename;
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            return ['success' => true, 'file_path' => $relative_path];
        } else {
            return ['success' => false, 'message' => 'Failed to upload file'];
        }
        
    } catch (Exception $e) {
        error_log("Image Upload Error: " . $e->getMessage());
        return ['success' => false, 'message' => 'Error uploading image'];
    }
}

function getUserStats($pdo) {
    try {
        $stats = [];
        
        // Check if users table exists
        $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
        if (!$stmt->fetch()) {
            // Return default stats if users table doesn't exist
            return [
                'total_users' => 0,
                'active_users' => 0,
                'pending_users' => 0,
                'banned_users' => 0,
                'today_registrations' => 0,
                'month_registrations' => 0
            ];
        }
        
        // Total users
        $stmt = $pdo->query("SELECT COUNT(*) FROM users");
        $stats['total_users'] = $stmt->fetchColumn() ?: 0;
        
        // Active users
        $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE status = 'active'");
        $stats['active_users'] = $stmt->fetchColumn() ?: 0;
        
        // Pending users
        $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE status = 'pending'");
        $stats['pending_users'] = $stmt->fetchColumn() ?: 0;
        
        // Banned users
        $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE status = 'banned'");
        $stats['banned_users'] = $stmt->fetchColumn() ?: 0;
        
        // Users registered today
        $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE DATE(created_at) = CURDATE()");
        $stats['today_registrations'] = $stmt->fetchColumn() ?: 0;
        
        // Users registered this month
        $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())");
        $stats['month_registrations'] = $stmt->fetchColumn() ?: 0;
        
        return $stats;
        
    } catch (Exception $e) {
        error_log("Get User Stats Error: " . $e->getMessage());
        return [
            'total_users' => 0,
            'active_users' => 0,
            'pending_users' => 0,
            'banned_users' => 0,
            'today_registrations' => 0,
            'month_registrations' => 0
        ];
    }
}

function logout() {
    try {
        // Destroy session
        session_destroy();
        
        // Clear session cookie
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        
        echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
        
    } catch (Exception $e) {
        error_log("Logout Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error during logout']);
    }
}
?>