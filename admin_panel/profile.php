<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

include 'components/navbar.php';     // Top navbar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Admin Profile</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- Custom styles for profile page -->
    <link href="assets/css/profile.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Admin Profile</h1>
            <div>
                <button class="btn btn-primary" id="editProfileBtn">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
                <button class="btn btn-secondary ml-2" id="refreshProfile">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="row">
            <!-- Profile Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                    </div>
                    <div class="card-body text-center">
                        <div class="profile-image-container mb-3">
                            <div id="adminProfileImage" class="admin-profile-image">
                                <!-- Profile image will be loaded here -->
                            </div>
                            <div class="profile-image-overlay" id="profileImageOverlay">
                                <i class="fas fa-camera"></i>
                                <span>Change Photo</span>
                            </div>
                        </div>
                        <h4 id="adminName" class="text-dark mb-1">Loading...</h4>
                        <p id="adminRole" class="text-muted mb-3">Administrator</p>
                        <div class="profile-stats">
                            <div class="stat-item">
                                <div class="stat-value" id="totalUsers">0</div>
                                <div class="stat-label">Total Users</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value" id="activeUsers">0</div>
                                <div class="stat-label">Active Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="col-lg-8 col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Account Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="profile-detail-item">
                                    <label class="profile-label">
                                        <i class="fas fa-id-card text-primary"></i>
                                        Admin ID
                                    </label>
                                    <p class="profile-value" id="adminId">-</p>
                                </div>
                                <div class="profile-detail-item">
                                    <label class="profile-label">
                                        <i class="fas fa-user text-primary"></i>
                                        Full Name
                                    </label>
                                    <p class="profile-value" id="adminFullName">-</p>
                                </div>
                                <div class="profile-detail-item">
                                    <label class="profile-label">
                                        <i class="fas fa-envelope text-primary"></i>
                                        Email Address
                                    </label>
                                    <p class="profile-value" id="adminEmail">-</p>
                                </div>
                                <div class="profile-detail-item">
                                    <label class="profile-label">
                                        <i class="fas fa-phone text-primary"></i>
                                        Phone Number
                                    </label>
                                    <p class="profile-value" id="adminPhone">-</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-detail-item">
                                    <label class="profile-label">
                                        <i class="fas fa-user-shield text-primary"></i>
                                        Role
                                    </label>
                                    <p class="profile-value" id="adminRoleDetail">Administrator</p>
                                </div>
                                <div class="profile-detail-item">
                                    <label class="profile-label">
                                        <i class="fas fa-calendar-alt text-primary"></i>
                                        Account Created
                                    </label>
                                    <p class="profile-value" id="adminCreatedAt">-</p>
                                </div>
                                <div class="profile-detail-item">
                                    <label class="profile-label">
                                        <i class="fas fa-clock text-primary"></i>
                                        Last Login
                                    </label>
                                    <p class="profile-value" id="adminLastLogin">-</p>
                                </div>
                                <div class="profile-detail-item">
                                    <label class="profile-label">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                        Last IP Address
                                    </label>
                                    <p class="profile-value" id="adminIpAddress">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Overview -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Activity Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="activity-stat">
                                    <div class="activity-icon bg-primary">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="activity-info">
                                        <div class="activity-value" id="managedUsers">0</div>
                                        <div class="activity-label">Users Managed</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="activity-stat">
                                    <div class="activity-icon bg-success">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="activity-info">
                                        <div class="activity-value" id="approvedUsers">0</div>
                                        <div class="activity-label">Approved Users</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="activity-stat">
                                    <div class="activity-icon bg-warning">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="activity-info">
                                        <div class="activity-value" id="pendingUsers">0</div>
                                        <div class="activity-label">Pending Users</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="activity-stat">
                                    <div class="activity-icon bg-danger">
                                        <i class="fas fa-ban"></i>
                                    </div>
                                    <div class="activity-info">
                                        <div class="activity-value" id="blockedUsers">0</div>
                                        <div class="activity-label">Blocked Users</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">
                        <i class="fas fa-user-edit mr-2"></i>Edit Profile
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="editProfileForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editFullName">
                                        <i class="fas fa-user text-primary"></i>
                                        Full Name *
                                    </label>
                                    <input type="text" class="form-control" id="editFullName" name="full_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="editEmail">
                                        <i class="fas fa-envelope text-primary"></i>
                                        Email Address *
                                    </label>
                                    <input type="email" class="form-control" id="editEmail" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="editPhone">
                                        <i class="fas fa-phone text-primary"></i>
                                        Phone Number
                                    </label>
                                    <input type="text" class="form-control" id="editPhone" name="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editCurrentPassword">
                                        <i class="fas fa-lock text-primary"></i>
                                        Current Password (to confirm changes)
                                    </label>
                                    <input type="password" class="form-control" id="editCurrentPassword" name="current_password">
                                </div>
                                <div class="form-group">
                                    <label for="editNewPassword">
                                        <i class="fas fa-key text-primary"></i>
                                        New Password (leave blank to keep current)
                                    </label>
                                    <input type="password" class="form-control" id="editNewPassword" name="new_password">
                                </div>
                                <div class="form-group">
                                    <label for="editConfirmPassword">
                                        <i class="fas fa-key text-primary"></i>
                                        Confirm New Password
                                    </label>
                                    <input type="password" class="form-control" id="editConfirmPassword" name="confirm_password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editProfileImage">
                                <i class="fas fa-camera text-primary"></i>
                                Profile Image
                            </label>
                            <input type="file" class="form-control-file" id="editProfileImage" name="profile_image" accept="image/*">
                            <small class="form-text text-muted">Upload a new profile image (JPG, PNG, GIF - Max 5MB)</small>
                            <div id="imagePreview" style="display: none; margin-top: 10px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" id="saveProfileBtn">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">
                        <i class="fas fa-key mr-2"></i>Change Password
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="changePasswordForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="changeCurrentPassword">
                                <i class="fas fa-lock text-primary"></i>
                                Current Password *
                            </label>
                            <input type="password" class="form-control" id="changeCurrentPassword" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label for="changeNewPassword">
                                <i class="fas fa-key text-primary"></i>
                                New Password *
                            </label>
                            <input type="password" class="form-control" id="changeNewPassword" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label for="changeConfirmPassword">
                                <i class="fas fa-key text-primary"></i>
                                Confirm New Password *
                            </label>
                            <input type="password" class="form-control" id="changeConfirmPassword" name="confirm_password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Hidden file input for profile image change -->
    <input type="file" id="hiddenProfileImageInput" accept="image/*" style="display: none;">

    <!-- Loading indicator -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loading-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-2">Loading profile...</p>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    
    <!-- Custom JavaScript for profile page -->
    <script src="assets/js/profile.js"></script>
</body>
</html>

<?php include 'components/footer.php'; ?>