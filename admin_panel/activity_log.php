<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

include 'components/header.php';     // <head> with Bootstrap CSS
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

    <title>SB Admin 2 - Activity Log</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- Custom styles for activity log page -->
    <link href="assets/css/activity.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-history text-primary mr-2"></i>Admin Activity Log
            </h1>
            <div class="d-sm-flex">
                <button class="btn btn-primary btn-sm mr-2" onclick="refreshActivityLog()">
                    <i class="fas fa-sync-alt mr-1"></i>Refresh
                </button>
                <button class="btn btn-success btn-sm" onclick="exportActivityLog()">
                    <i class="fas fa-download mr-1"></i>Export
                </button>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="searchInput" class="font-weight-bold">Search Activity</label>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search by Username, Email, or IP...">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="roleFilter" class="font-weight-bold">Filter by Role</label>
                        <select class="form-control" id="roleFilter">
                            <option value="">All Roles</option>
                            <option value="super">Super Admin</option>
                            <option value="editor">Editor</option>
                            <option value="viewer">Viewer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-3">
                        <label for="dateFrom" class="font-weight-bold">From Date</label>
                        <input type="date" class="form-control" id="dateFrom">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-3">
                        <label for="dateTo" class="font-weight-bold">To Date</label>
                        <input type="date" class="form-control" id="dateTo">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">&nbsp;</label>
                        <button class="btn btn-outline-primary btn-block" onclick="applyFilters()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Log Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list mr-2"></i>Admin Login History
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered activity-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Admin Profile</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Login IP</th>
                                <th>Last Login</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="activityTableBody">
                            <!-- Activity logs will be populated here by JavaScript -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Loading indicator -->
                <div id="loadingIndicator" class="text-center py-4" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-2">Loading activity logs...</p>
                </div>

                <!-- No data message -->
                <div id="noDataMessage" class="text-center py-4" style="display: none;">
                    <div class="text-muted">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <p>No activity logs found matching your criteria.</p>
                    </div>
                </div>
                
                <!-- Pagination Section -->
                <div class="pagination-section">
                    <div class="pagination-info">
                        Showing <span id="showingStart">0</span> to <span id="showingEnd">0</span> of <span id="totalLogs">0</span> activity logs
                    </div>
                    <div class="ml-auto">
                        <button class="btn btn-outline-primary btn-sm" id="prevPageBtn" onclick="changePage(-1)" disabled>
                            <i class="fas fa-chevron-left"></i> Previous
                        </button>
                        <span class="mx-2">Page <span id="currentPageSpan">1</span></span>
                        <button class="btn btn-outline-primary btn-sm" id="nextPageBtn" onclick="changePage(1)" disabled>
                            Next <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- View Admin Details Modal -->
    <div class="modal fade" id="viewAdminModal" tabindex="-1" role="dialog" aria-labelledby="viewAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewAdminModalLabel">
                        <i class="fas fa-user-shield mr-2"></i>Admin Details
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div id="viewAdminProfileImage"></div>
                            <h5 id="viewAdminUsername">Username</h5>
                            <p class="text-muted" id="viewAdminFullName">Full Name</p>
                            <span class="role-badge" id="viewAdminRole">Role</span>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="font-weight-bold">Admin ID:</label>
                                <p class="form-control-plaintext" id="viewAdminId">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Username:</label>
                                <p class="form-control-plaintext" id="viewAdminUsernameDetail">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Full Name:</label>
                                <p class="form-control-plaintext" id="viewAdminFullNameDetail">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email Address:</label>
                                <p class="form-control-plaintext" id="viewAdminEmail">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Role:</label>
                                <p class="form-control-plaintext" id="viewAdminRoleDetail">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Status:</label>
                                <p class="form-control-plaintext" id="viewAdminStatus">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Last Login:</label>
                                <p class="form-control-plaintext" id="viewAdminLastLogin">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Login IP Address:</label>
                                <p class="form-control-plaintext" id="viewAdminLoginIP">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Account Created:</label>
                                <p class="form-control-plaintext" id="viewAdminCreatedAt">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Last Updated:</label>
                                <p class="form-control-plaintext" id="viewAdminUpdatedAt">-</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for activity log page -->
    <script src="assets/js/activity.js"></script>
</body>
</html>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>


<?php include 'components/footer.php'; ?> <!-- Footer with scripts -->