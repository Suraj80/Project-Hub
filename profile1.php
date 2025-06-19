<?php
session_start();



// Example: After verifying the user login
$user = [
    'id' => 1
    // other user details...
];

// Set session variable
$_SESSION['user_id'] = $user['id'];




// Database configuration
class Database {
    private $host = 'localhost';
    private $dbname = 'project_hub';
    private $username = 'suraj';
    private $password = 'Suraj@123';
    private $pdo;
    
    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection failed");
        }
    }
    
    public function getConnection() {
        return $this->pdo;
    }
}

// Security helper class
class Security {
    
    // Generate CSRF token
    public static function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    // Validate CSRF token
    public static function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    // Sanitize input
    public static function sanitizeInput($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    
    // Validate email
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    // Validate phone number
    public static function validatePhone($phone) {
        // Remove all non-numeric characters
        $cleaned = preg_replace('/[^0-9]/', '', $phone);
        // Check if it's 10 digits for the number field
        return strlen($cleaned) === 10;
    }
    
    // Check if user is authenticated
    public static function isAuthenticated() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    
    // Rate limiting for profile updates
    public static function checkRateLimit($userId, $maxAttempts = 5, $timeWindow = 300) {
        $key = "profile_update_" . $userId;
        
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = ['count' => 0, 'first_attempt' => time()];
        }
        
        $attempts = &$_SESSION[$key];
        
        // Reset counter if time window has passed
        if (time() - $attempts['first_attempt'] > $timeWindow) {
            $attempts = ['count' => 0, 'first_attempt' => time()];
        }
        
        if ($attempts['count'] >= $maxAttempts) {
            return false;
        }
        
        $attempts['count']++;
        return true;
    }
}

// File upload handler
class FileUpload {
    private $uploadDir = 'uploads/';
    private $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    private $maxFileSize = 5 * 1024 * 1024; // 5MB
    
    public function __construct() {
        // Create upload directory if it doesn't exist
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }
    
    public function uploadProfileImage($file, $userId) {
        try {
            // Check if file was uploaded
            if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('File upload error');
            }
            
            // Validate file size
            if ($file['size'] > $this->maxFileSize) {
                throw new Exception('File size too large. Maximum 5MB allowed.');
            }
            
            // Validate file type
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            
            if (!in_array($mimeType, $this->allowedTypes)) {
                throw new Exception('Invalid file type. Only JPG, JPEG, and PNG files are allowed.');
            }
            
            // Generate unique filename
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = 'profile_' . $userId . '_' . uniqid() . '.' . strtolower($extension);
            $filepath = $this->uploadDir . $filename;
            
            // Move uploaded file
            if (!move_uploaded_file($file['tmp_name'], $filepath)) {
                throw new Exception('Failed to save uploaded file');
            }
            
            // Set proper permissions
            chmod($filepath, 0644);
            
            return $filename;
            
        } catch (Exception $e) {
            error_log("File upload error: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function deleteOldImage($filename) {
        if ($filename && file_exists($this->uploadDir . $filename)) {
            unlink($this->uploadDir . $filename);
        }
    }
}

// Profile manager class
class ProfileManager {
    private $db;
    
    public function __construct($database) {
        $this->db = $database->getConnection();
    }
    
    public function getUserProfile($userId) {
        $stmt = $this->db->prepare("
            SELECT id, number, email, full_name, profile_image, 
                   created_at, last_login, status 
            FROM users 
            WHERE id = ? AND status = 'active'
        ");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }
    
    public function updateProfile($userId, $data) {
        try {
            $this->db->beginTransaction();
            
            // Update basic profile information
            $stmt = $this->db->prepare("
                UPDATE users 
                SET full_name = ?, email = ?, updated_at = CURRENT_TIMESTAMP,
                    last_activity = CURRENT_TIMESTAMP
                WHERE id = ? AND status = 'active'
            ");
            
            $result = $stmt->execute([
                $data['full_name'],
                $data['email'],
                $userId
            ]);
            
            if (!$result || $stmt->rowCount() === 0) {
                throw new Exception('Failed to update profile or user not found');
            }
            
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            $this->db->rollback();
            error_log("Profile update error: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function updateProfileImage($userId, $imageName) {
        try {
            $stmt = $this->db->prepare("
                UPDATE users 
                SET profile_image = ?, updated_at = CURRENT_TIMESTAMP 
                WHERE id = ? AND status = 'active'
            ");
            
            return $stmt->execute([$imageName, $userId]);
            
        } catch (Exception $e) {
            error_log("Profile image update error: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function updatePassword($userId, $newPassword) {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID, [
                'memory_cost' => 65536,
                'time_cost' => 4,
                'threads' => 3
            ]);
            
            $stmt = $this->db->prepare("
                UPDATE users 
                SET password = ?, updated_at = CURRENT_TIMESTAMP 
                WHERE id = ? AND status = 'active'
            ");
            
            return $stmt->execute([$hashedPassword, $userId]);
            
        } catch (Exception $e) {
            error_log("Password update error: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function verifyCurrentPassword($userId, $password) {
        $stmt = $this->db->prepare("
            SELECT password FROM users 
            WHERE id = ? AND status = 'active'
        ");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        
        return $user && password_verify($password, $user['password']);
    }
}

// Initialize classes
$database = new Database();
$profileManager = new ProfileManager($database);
$fileUpload = new FileUpload();

// Check authentication
// if (!Security::isAuthenticated()) {
//     http_response_code(401);
//     header('Location: login.php');
//     exit;
// }

$userId = $_SESSION['user_id'];
$response = ['success' => false, 'message' => '', 'errors' => []];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Check rate limiting
    if (!Security::checkRateLimit($userId)) {
        $response['message'] = 'Too many update attempts. Please try again later.';
        http_response_code(429);
        echo json_encode($response);
        exit;
    }
    
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !Security::validateCSRFToken($_POST['csrf_token'])) {
        $response['message'] = 'Invalid security token. Please refresh the page.';
        http_response_code(403);
        echo json_encode($response);
        exit;
    }
    
    try {
        $updateType = $_POST['update_type'] ?? 'profile';
        
        switch ($updateType) {
            case 'profile':
                // Validate and sanitize input
                $fullName = Security::sanitizeInput($_POST['full_name'] ?? '');
                $email = Security::sanitizeInput($_POST['email'] ?? '');
                
                // Validation
                if (empty($fullName)) {
                    $response['errors']['full_name'] = 'Full name is required';
                }
                
                if (empty($email)) {
                    $response['errors']['email'] = 'Email is required';
                } elseif (!Security::validateEmail($email)) {
                    $response['errors']['email'] = 'Invalid email format';
                }
                
                // Check if email is already taken by another user
                $stmt = $database->getConnection()->prepare("
                    SELECT id FROM users WHERE email = ? AND id != ?
                ");
                $stmt->execute([$email, $userId]);
                if ($stmt->fetch()) {
                    $response['errors']['email'] = 'Email is already in use';
                }
                
                if (empty($response['errors'])) {
                    $profileManager->updateProfile($userId, [
                        'full_name' => $fullName,
                        'email' => $email
                    ]);
                    
                    $response['success'] = true;
                    $response['message'] = 'Profile updated successfully';
                }
                break;
                
            case 'password':
                $currentPassword = $_POST['current_password'] ?? '';
                $newPassword = $_POST['new_password'] ?? '';
                $confirmPassword = $_POST['confirm_password'] ?? '';
                
                // Validation
                if (empty($currentPassword)) {
                    $response['errors']['current_password'] = 'Current password is required';
                } elseif (!$profileManager->verifyCurrentPassword($userId, $currentPassword)) {
                    $response['errors']['current_password'] = 'Current password is incorrect';
                }
                
                if (empty($newPassword)) {
                    $response['errors']['new_password'] = 'New password is required';
                } elseif (strlen($newPassword) < 8) {
                    $response['errors']['new_password'] = 'Password must be at least 8 characters long';
                } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/', $newPassword)) {
                    $response['errors']['new_password'] = 'Password must contain uppercase, lowercase, number and special character';
                }
                
                if ($newPassword !== $confirmPassword) {
                    $response['errors']['confirm_password'] = 'Passwords do not match';
                }
                
                if (empty($response['errors'])) {
                    $profileManager->updatePassword($userId, $newPassword);
                    $response['success'] = true;
                    $response['message'] = 'Password updated successfully';
                }
                break;
                
            case 'photo':
                if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                    // Get current profile image to delete later
                    $currentUser = $profileManager->getUserProfile($userId);
                    $oldImage = $currentUser['profile_image'] ?? null;
                    
                    // Upload new image
                    $newImageName = $fileUpload->uploadProfileImage($_FILES['profile_image'], $userId);
                    
                    // Update database
                    if ($profileManager->updateProfileImage($userId, $newImageName)) {
                        // Delete old image if exists
                        if ($oldImage) {
                            $fileUpload->deleteOldImage($oldImage);
                        }
                        
                        $response['success'] = true;
                        $response['message'] = 'Profile image updated successfully';
                        $response['image_url'] = 'uploads/' . $newImageName;
                    } else {
                        // Clean up uploaded file if database update failed
                        $fileUpload->deleteOldImage($newImageName);
                        throw new Exception('Failed to update profile image in database');
                    }
                } else {
                    $response['message'] = 'No file uploaded or upload error occurred';
                }
                break;
                
            case 'remove_photo':
                $currentUser = $profileManager->getUserProfile($userId);
                $currentImage = $currentUser['profile_image'] ?? null;
                
                if ($currentImage) {
                    if ($profileManager->updateProfileImage($userId, null)) {
                        $fileUpload->deleteOldImage($currentImage);
                        $response['success'] = true;
                        $response['message'] = 'Profile image removed successfully';
                    } else {
                        throw new Exception('Failed to remove profile image');
                    }
                } else {
                    $response['message'] = 'No profile image to remove';
                }
                break;
                
            default:
                $response['message'] = 'Invalid update type';
        }
        
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
        error_log("Profile update error for user $userId: " . $e->getMessage());
    }
    
    // Return JSON response for AJAX requests
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    
    // For regular form submissions, set flash message and redirect
    $_SESSION['flash_message'] = $response;
    header('Location: profile.php');
    exit;
}

// Get user profile data for display
// try {
    $userProfile = $profileManager->getUserProfile($userId);
    if (!$userProfile) {
        throw new Exception('User profile not found');
    }
// } catch (Exception $e) {
//     error_log("Error fetching user profile: " . $e->getMessage());
//     header('Location: login.php');
//     exit;
// }

// Get flash message if exists
$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);

// Generate CSRF token
$csrfToken = Security::generateCSRFToken();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Innovate CS</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #0b80ee 0%, #49749c 100%);
        }
        .profile-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(11, 128, 238, 0.25);
        }
        .hover-lift:hover {
            transform: translateY(-2px);
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .success-message {
            color: #10b981;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="relative flex size-full min-h-screen flex-col bg-gradient-to-br from-slate-50 to-blue-50" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        <div class="layout-container flex h-full grow flex-col">
            
            <!-- Enhanced Header -->
            <header class="glass-card sticky top-0 z-50 flex items-center justify-between px-4 md:px-6 lg:px-10 py-4 shadow-sm">
                <div class="flex items-center gap-3 text-[#0d151c]">
                    <div class="size-8 md:size-10 gradient-bg rounded-lg flex items-center justify-center">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-5 md:size-6 text-white">
                            <path d="M4 42.4379C4 42.4379 14.0962 36.0744 24 41.1692C35.0664 46.8624 44 42.2078 44 42.2078L44 7.01134C44 7.01134 35.068 11.6577 24.0031 5.96913C14.0971 0.876274 4 7.27094 4 7.27094L4 42.4379Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <h2 class="text-[#0d151c] text-lg md:text-xl font-bold leading-tight tracking-[-0.015em]">Innovate CS</h2>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="logout.php" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-[#e7edf4] text-[#0d151c] text-sm font-bold leading-normal tracking-[0.015em] hover-lift transition-all duration-200">
                        <span class="truncate">Logout</span>
                    </a>
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 ring-2 ring-[#0b80ee] ring-offset-2"
                         style='background-image: url("<?php echo $userProfile['profile_image'] ? 'uploads/' . htmlspecialchars($userProfile['profile_image']) : 'https://via.placeholder.com/40'; ?>");'>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            <?php if ($flashMessage): ?>
            <div class="mx-4 md:mx-6 lg:mx-10 mt-4">
                <div class="max-w-4xl mx-auto">
                    <div class="<?php echo $flashMessage['success'] ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700'; ?> px-4 py-3 rounded border">
                        <?php echo htmlspecialchars($flashMessage['message']); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Main Content -->
            <div class="flex-1 px-4 md:px-6 lg:px-8 xl:px-12 py-6 md:py-8">
                <div class="max-w-4xl mx-auto">
                    
                    <!-- Profile Header -->
                    <div class="glass-card rounded-2xl p-6 md:p-8 mb-6 md:mb-8 profile-shadow">
                        <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-8">
                            <!-- Profile Image -->
                            <div class="relative group" id="profileImageContainer">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-24 h-24 md:w-32 md:h-32 ring-4 ring-white shadow-lg group-hover:scale-105 transition-transform duration-300"
                                     style='background-image: url("<?php echo $userProfile['profile_image'] ? 'uploads/' . htmlspecialchars($userProfile['profile_image']) : 'https://via.placeholder.com/128'; ?>");'
                                     id="profileImage">
                                </div>
                                <div class="absolute inset-0 rounded-full bg-black bg-opacity-0 group-hover:bg-opacity-20 flex items-center justify-center transition-all duration-300">
                                    <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Profile Info -->
                            <div class="flex-1 text-center md:text-left">
                                <h1 class="text-2xl md:text-3xl font-bold text-[#0d151c] mb-2"><?php echo htmlspecialchars($userProfile['full_name'] ?: 'User'); ?></h1>
                                <p class="text-[#49749c] text-base md:text-lg mb-4"><?php echo htmlspecialchars($userProfile['email'] ?: 'No email set'); ?></p>
                                <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                                    <form id="uploadForm" class="inline-block" enctype="multipart/form-data">
                                        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                                        <input type="hidden" name="update_type" value="photo">
                                        <input type="file" name="profile_image" id="profileImageInput" accept="image/*" class="hidden">
                                        <button type="button" onclick="document.getElementById('profileImageInput').click()" 
                                                class="flex items-center justify-center gap-2 px-4 py-2 bg-[#0b80ee] text-white rounded-lg hover-lift transition-all duration-200 text-sm font-medium">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                            </svg>
                                            Upload Photo
                                        </button>
                                    </form>
                                    
                                    <form id="removePhotoForm" class="inline-block">
                                        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                                        <input type="hidden" name="update_type" value="remove_photo">
                                        <button type="submit" class="flex items-center justify-center gap-2 px-4 py-2 bg-[#e7edf4] text-[#0d151c] rounded-lg hover-lift transition-all duration-200 text-sm font-medium">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Form -->
                    <div class="glass-card rounded-2xl p-6 md:p-8 profile-shadow mb-6">
                        <div class="flex items-center gap-3 mb-6 md:mb-8">
                            <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl md:text-2xl font-bold text-[#0d151c]">Personal Information</h2>
                        </div>

                        <form id="profileForm" class="space-y-6">
                            <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                            <input type="hidden" name="update_type" value="profile">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name Field -->
                                <div class="space-y-2">
                                    <label class="block text-[#0d151c] text-sm font-semibold">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="full_name" id="full_name" 
                                           value="<?php echo htmlspecialchars($userProfile['full_name'] ?: ''); ?>"
                                           class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                                           placeholder="Enter your full name" required>
                                    <div class="error-message" id="full_name_error"></div>
                                </div>

                                <!-- Email Field -->
                                <div class="space-y-2">
                                    <label class="block text-[#0d151c] text-sm font-semibold">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" id="email"
                                           value="<?php echo htmlspecialchars($userProfile['email'] ?: ''); ?>"
                                           class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                                           placeholder="Enter your email address" required>
                                    <div class="error-message" id="email_error"></div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6">
                <button type="button" onclick="resetForm()"
                        class="px-6 py-3 bg-[#e7edf4] text-[#0d151c] rounded-lg hover-lift transition-all duration-200 font-semibold order-2 sm:order-1">
                    Cancel
                </button>
                <button type="submit" id="saveProfileBtn"
                        class="px-6 py-3 bg-[#0b80ee] text-white rounded-lg hover-lift transition-all duration-200 font-semibold order-1 sm:order-2">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Changes
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- Password Change Section -->
    <div class="glass-card rounded-2xl p-6 md:p-8 profile-shadow">
        <div class="flex items-center gap-3 mb-6 md:mb-8">
            <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-xl md:text-2xl font-bold text-[#0d151c]">Change Password</h2>
        </div>

        <form id="passwordForm" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
            <input type="hidden" name="update_type" value="password">
            
            <!-- Current Password -->
            <div class="space-y-2">
                <label class="block text-[#0d151c] text-sm font-semibold">
                    Current Password <span class="text-red-500">*</span>
                </label>
                <input type="password" name="current_password" id="current_password"
                       class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                       placeholder="Enter your current password">
                <div class="error-message" id="current_password_error"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- New Password -->
                <div class="space-y-2">
                    <label class="block text-[#0d151c] text-sm font-semibold">
                        New Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="new_password" id="new_password"
                           class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                           placeholder="Enter new password">
                    <div class="error-message" id="new_password_error"></div>
                    <div class="text-xs text-[#49749c] mt-1">
                        Password must be at least 8 characters with uppercase, lowercase, number and special character
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label class="block text-[#0d151c] text-sm font-semibold">
                        Confirm New Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="confirm_password" id="confirm_password"
                           class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                           placeholder="Confirm new password">
                    <div class="error-message" id="confirm_password_error"></div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6">
                <button type="button" onclick="resetPasswordForm()"
                        class="px-6 py-3 bg-[#e7edf4] text-[#0d151c] rounded-lg hover-lift transition-all duration-200 font-semibold order-2 sm:order-1">
                    Cancel
                </button>
                <button type="submit" id="savePasswordBtn"
                        class="px-6 py-3 bg-[#0b80ee] text-white rounded-lg hover-lift transition-all duration-200 font-semibold order-1 sm:order-2">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Update Password
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<!-- Footer -->
<footer class="glass-card mt-auto px-4 md:px-6 lg:px-10 py-6 border-t border-[#cedce8]">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-[#49749c] text-sm">
                © 2024 Innovate CS. All rights reserved.
            </div>
            <div class="flex items-center gap-4 text-sm text-[#49749c]">
                <span>Member since: <?php echo date('M Y', strtotime($userProfile['created_at'])); ?></span>
                <span>•</span>
                <span>Last login: <?php echo $userProfile['last_login'] ? date('M j, Y', strtotime($userProfile['last_login'])) : 'Never'; ?></span>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="glass-card rounded-2xl p-8 max-w-sm mx-4">
        <div class="flex items-center justify-center mb-4">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#0b80ee]"></div>
        </div>
        <p class="text-[#0d151c] text-center font-semibold">Processing...</p>
    </div>
</div>

<!-- Success/Error Modal -->
<div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="glass-card rounded-2xl p-8 max-w-sm mx-4">
        <div class="flex items-center justify-center mb-4">
            <div id="modalIcon" class="w-12 h-12 rounded-full flex items-center justify-center">
                <!-- Icon will be inserted here -->
            </div>
        </div>
        <h3 id="modalTitle" class="text-lg font-semibold text-center mb-2"></h3>
        <p id="modalMessage" class="text-[#49749c] text-center mb-6"></p>
        <button onclick="closeModal()" class="w-full px-4 py-2 bg-[#0b80ee] text-white rounded-lg hover-lift transition-all duration-200 font-semibold">
            OK
        </button>
    </div>
</div>

<script>
// Global variables
let isUploading = false;

// Form submission handlers
document.addEventListener('DOMContentLoaded', function() {
    // Profile form submission
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        submitForm(this, 'profile');
    });

    // Password form submission
    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        submitForm(this, 'password');
    });

    // Profile image upload
    document.getElementById('profileImageInput').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            uploadProfileImage(this.files[0]);
        }
    });

    // Upload form submission
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
    });

    // Remove photo form submission
    document.getElementById('removePhotoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        removeProfilePhoto();
    });

    // Real-time password validation
    document.getElementById('new_password').addEventListener('input', validatePassword);
    document.getElementById('confirm_password').addEventListener('input', validatePasswordMatch);
});

function submitForm(form, type) {
    if (isUploading) return;

    clearErrors();
    showLoading(true);

    const formData = new FormData(form);
    
    fetch(window.location.href, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        showLoading(false);
        
        if (data.success) {
            showModal('success', 'Success!', data.message);
            if (type === 'password') {
                resetPasswordForm();
            }
        } else {
            if (data.errors) {
                displayErrors(data.errors);
            }
            if (data.message) {
                showModal('error', 'Error', data.message);
            }
        }
    })
    .catch(error => {
        showLoading(false);
        console.error('Error:', error);
        showModal('error', 'Error', 'An unexpected error occurred. Please try again.');
    });
}

function uploadProfileImage(file) {
    if (isUploading) return;
    
    // Validate file
    if (!file.type.match(/^image\/(jpeg|jpg|png)$/)) {
        showModal('error', 'Invalid File', 'Please select a valid image file (JPG, JPEG, or PNG).');
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        showModal('error', 'File Too Large', 'Please select an image smaller than 5MB.');
        return;
    }

    isUploading = true;
    showLoading(true);

    const formData = new FormData();
    formData.append('profile_image', file);
    formData.append('csrf_token', document.querySelector('input[name="csrf_token"]').value);
    formData.append('update_type', 'photo');

    fetch(window.location.href, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        isUploading = false;
        showLoading(false);
        
        if (data.success) {
            // Update profile images
            const imageUrl = data.image_url + '?t=' + Date.now();
            document.getElementById('profileImage').style.backgroundImage = `url("${imageUrl}")`;
            document.querySelector('header .bg-cover').style.backgroundImage = `url("${imageUrl}")`;
            
            showModal('success', 'Success!', data.message);
        } else {
            showModal('error', 'Upload Failed', data.message);
        }
    })
    .catch(error => {
        isUploading = false;
        showLoading(false);
        console.error('Error:', error);
        showModal('error', 'Upload Failed', 'An error occurred while uploading the image.');
    });
}

function removeProfilePhoto() {
    if (isUploading) return;
    
    if (!confirm('Are you sure you want to remove your profile photo?')) {
        return;
    }

    isUploading = true;
    showLoading(true);

    const formData = new FormData();
    formData.append('csrf_token', document.querySelector('input[name="csrf_token"]').value);
    formData.append('update_type', 'remove_photo');

    fetch(window.location.href, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        isUploading = false;
        showLoading(false);
        
        if (data.success) {
            // Update profile images to default
            const defaultImage = 'https://via.placeholder.com/128';
            document.getElementById('profileImage').style.backgroundImage = `url("${defaultImage}")`;
            document.querySelector('header .bg-cover').style.backgroundImage = `url("${defaultImage}")`;
            
            showModal('success', 'Success!', data.message);
        } else {
            showModal('error', 'Error', data.message);
        }
    })
    .catch(error => {
        isUploading = false;
        showLoading(false);
        console.error('Error:', error);
        showModal('error', 'Error', 'An error occurred while removing the photo.');
    });
}

function validatePassword() {
    const password = document.getElementById('new_password').value;
    const errorDiv = document.getElementById('new_password_error');
    
    if (password.length === 0) {
        errorDiv.textContent = '';
        return;
    }
    
    if (password.length < 8) {
        errorDiv.textContent = 'Password must be at least 8 characters long';
        return;
    }
    
    if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/.test(password)) {
        errorDiv.textContent = 'Password must contain uppercase, lowercase, number and special character';
        return;
    }
    
    errorDiv.textContent = '';
    validatePasswordMatch(); // Also check confirm password when new password changes
}

function validatePasswordMatch() {
    const password = document.getElementById('new_password').value;
    const confirm = document.getElementById('confirm_password').value;
    const errorDiv = document.getElementById('confirm_password_error');
    
    if (confirm.length === 0) {
        errorDiv.textContent = '';
        return;
    }
    
    if (password !== confirm) {
        errorDiv.textContent = 'Passwords do not match';
    } else {
        errorDiv.textContent = '';
    }
}

function displayErrors(errors) {
    for (const [field, message] of Object.entries(errors)) {
        const errorDiv = document.getElementById(field + '_error');
        if (errorDiv) {
            errorDiv.textContent = message;
        }
    }
}

function clearErrors() {
    const errorDivs = document.querySelectorAll('.error-message');
    errorDivs.forEach(div => {
        div.textContent = '';
    });
}

function resetForm() {
    document.getElementById('profileForm').reset();
    // Restore original values
    document.getElementById('full_name').value = '<?php echo addslashes($userProfile['full_name'] ?: ''); ?>';
    document.getElementById('email').value = '<?php echo addslashes($userProfile['email'] ?: ''); ?>';
    clearErrors();
}

function resetPasswordForm() {
    document.getElementById('passwordForm').reset();
    clearErrors();
}

function showLoading(show) {
    const overlay = document.getElementById('loadingOverlay');
    if (show) {
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    } else {
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }
}

function showModal(type, title, message) {
    const modal = document.getElementById('messageModal');
    const modalIcon = document.getElementById('modalIcon');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    
    // Set icon and colors based on type
    if (type === 'success') {
        modalIcon.innerHTML = `
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        `;
        modalIcon.className = 'w-12 h-12 rounded-full flex items-center justify-center bg-green-500';
    } else {
        modalIcon.innerHTML = `
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        `;
        modalIcon.className = 'w-12 h-12 rounded-full flex items-center justify-center bg-red-500';
    }
    
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('messageModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

// Close modal when clicking outside
document.getElementById('messageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Prevent form submission on Enter key in password fields
document.querySelectorAll('input[type="password"]').forEach(input => {
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
});
</script>

</body>
</html>