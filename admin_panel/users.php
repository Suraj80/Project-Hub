<?php
  include 'config.php';
  include 'includes/db.php';
  include 'components/header.php';     // <head> with Bootstrap CSS
    include 'components/sidebar.php';
  include 'components/navbar.php';     // Top navbar
    // Side menu
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - User Management</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- Custom styles for users page -->
    <link href="assets/css/users.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User Management</h1>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group mb-3">
                        <label for="searchInput" class="font-weight-bold">Search Users</label>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search by ID, Name, Number, or Email...">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="statusFilter" class="font-weight-bold">Filter by Status</label>
                        <select class="form-control" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                            <option value="banned">Banned</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered user-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Profile</th>
                                <th>Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <!-- Users will be populated here by JavaScript -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Loading indicator -->
                <div id="loadingIndicator" class="text-center py-4" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-2">Loading users...</p>
                </div>
                
                <!-- Pagination Section -->
                <div class="pagination-section">
                    <div class="pagination-info">
                        Showing <span id="showingStart">0</span> to <span id="showingEnd">0</span> of <span id="totalUsers">0</span> users
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

    <!-- View User Modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserModalLabel">
                        <i class="fas fa-user-circle mr-2"></i>User Details
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div id="viewUserProfileImage"></div>
                            <h5 id="viewUserName">User Name</h5>
                            <p class="text-muted" id="viewUserNumber">Number</p>
                            <span class="status-badge" id="viewUserStatus">Status</span>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="font-weight-bold">User ID:</label>
                                <p class="form-control-plaintext" id="viewUserId">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Number:</label>
                                <p class="form-control-plaintext" id="viewUserNumberDetail">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Full Name:</label>
                                <p class="form-control-plaintext" id="viewUserFullName">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email Address:</label>
                                <p class="form-control-plaintext" id="viewUserEmail">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Phone Verified:</label>
                                <p class="form-control-plaintext" id="viewUserPhoneVerified">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email Verified:</label>
                                <p class="form-control-plaintext" id="viewUserEmailVerified">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Last Login:</label>
                                <p class="form-control-plaintext" id="viewUserLastLogin">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Created At:</label>
                                <p class="form-control-plaintext" id="viewUserCreatedAt">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">IP Address:</label>
                                <p class="form-control-plaintext" id="viewUserIpAddress">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Failed Login Attempts:</label>
                                <p class="form-control-plaintext" id="viewUserFailedAttempts">-</p>
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

    <!-- Custom JavaScript for users page -->
    <script src="assets/js/users.js"></script>
</body>
</html>
 <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
<?php include 'components/footer.php'; ?> <!-- Footer with scripts -->
