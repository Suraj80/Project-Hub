<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
include 'components/navbar.php';
include 'components/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Feedback Management</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Feedback specific CSS -->
    <link rel="stylesheet" href="assets/css/feedback.css">


</head>

<body id="page-top">

 
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Search and Filter Section -->
                    <div class="search-filter-section">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="searchInput" class="font-weight-bold">Search Feedback</label>
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search by ID or Name...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="statusFilter" class="font-weight-bold">Filter by Status</label>
                                    <select class="form-control" id="statusFilter">
                                        <option value="">All Status</option>
                                        <option value="new">New</option>
                                        <option value="read">Read</option>
                                        <option value="replied">Replied</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Feedback Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Feedback List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered feedback-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="feedbackTableBody">
                                        <!-- Data will be loaded here via AJAX -->
                                        <tr class="loading-row">
                                            <td colspan="7" class="text-center py-4">
                                                <i class="fas fa-spinner fa-spin fa-2x text-muted mb-2"></i>
                                                <p class="text-muted">Loading feedback...</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination Section -->
                            <div class="pagination-section">
                                <div class="pagination-info">
                                    Showing <span id="showingStart">0</span> to <span id="showingEnd">0</span> of <span id="totalFeedback">0</span> feedback entries
                                </div>
                                <div class="ml-auto">
                                    <button class="btn btn-outline-primary btn-sm" id="prevPageBtn" disabled>
                                        <i class="fas fa-chevron-left"></i> Previous
                                    </button>
                                    <span class="mx-2">Page <span id="currentPageSpan">1</span></span>
                                    <button class="btn btn-outline-primary btn-sm" id="nextPageBtn" disabled>
                                        Next <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- View Feedback Modal -->
    <div class="modal fade" id="viewFeedbackModal" tabindex="-1" role="dialog" aria-labelledby="viewFeedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewFeedbackModalLabel">
                        <i class="fas fa-comments mr-2"></i>Feedback Details
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">ID:</label>
                                <p class="form-control-plaintext" id="viewFeedbackId">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Name:</label>
                                <p class="form-control-plaintext" id="viewFeedbackName">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email:</label>
                                <p class="form-control-plaintext" id="viewFeedbackEmail">-</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Subject:</label>
                                <p class="form-control-plaintext" id="viewFeedbackSubject">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Status:</label>
                                <p class="form-control-plaintext" id="viewFeedbackStatus">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Created At:</label>
                                <p class="form-control-plaintext" id="viewFeedbackCreatedAt">-</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Message:</label>
                        <div id="viewFeedbackMessage" class="p-3 bg-light border rounded">
                            Loading message...
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-sm" type="button" id="markAsReadBtn">
                        <i class="fas fa-check mr-1"></i>Mark as Read
                    </button>
                    <button class="btn btn-primary btn-sm" type="button" id="markAsRepliedBtn">
                        <i class="fas fa-reply mr-1"></i>Mark as Replied
                    </button>
                    <button class="btn btn-danger btn-sm" type="button" id="deleteFeedbackBtn">
                        <i class="fas fa-trash mr-1"></i>Delete
                    </button>
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for feedback management-->
    <script src="assets/js/feedback.js"></script>

</body>
</html>