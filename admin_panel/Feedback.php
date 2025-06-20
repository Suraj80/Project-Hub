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

    <link rel="stylesheet" href="assets/css/feedback.css">
    
    <style>
        /* Custom Styles for Feedback Management */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-new { 
            background-color: #fff3cd; 
            color: #856404; 
        }

        .status-read { 
            background-color: #d4edda; 
            color: #155724; 
        }

        .status-replied { 
            background-color: #d1ecf1; 
            color: #0c5460; 
        }

        .btn-action {
            margin-right: 0.25rem;
            margin-bottom: 0.25rem;
        }

        .table-responsive {
            border-radius: 0.35rem;
        }

        .feedback-table th {
            border-top: none;
            background-color: #f8f9fc;
            font-weight: 600;
            color: #5a5c69;
        }

        .feedback-row:hover {
            background-color: #f8f9fc;
        }

        .search-filter-section {
            background-color: #f8f9fc;
            padding: 1.5rem;
            border-radius: 0.35rem;
            margin-bottom: 1.5rem;
        }

        .pagination-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding: 1rem 0;
        }

        .pagination-info {
            color: #5a5c69;
            font-size: 0.875rem;
        }

        .subject-preview {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .loading-row {
            text-align: center;
            padding: 2rem;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 1rem;
            border-radius: 0.25rem;
            margin: 1rem 0;
        }

        /* Enhanced Modal Styles */
        .modal-body #viewFeedbackMessage {
            background-color: #f8f9fc;
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            padding: 1rem;
            max-height: 300px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-family: inherit;
            line-height: 1.5;
            color: #5a5c69;
        }

        .modal-body .form-control-plaintext {
            word-wrap: break-word;
            white-space: pre-wrap;
        }

        .modal-footer .btn {
            margin-left: 0.5rem;
        }

        .modal-footer .btn:first-child {
            margin-left: 0;
        }

        /* Fixed Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 14rem;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-brand {
            color: white;
            text-decoration: none;
            padding: 1rem;
        }

        .sidebar-brand:hover {
            color: white;
            text-decoration: none;
        }

        .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
        }

        .nav-item .nav-link:hover {
            color: white;
        }

        .nav-item.active .nav-link {
            color: white;
        }

        .sidebar-divider {
            border-color: rgba(255, 255, 255, 0.15);
        }

        .sidebar-heading {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            padding: 1.5rem 1rem 0.5rem;
        }

        /* Fixed Main content wrapper */
        #content-wrapper {
            margin-left: 14rem;
            width: calc(100% - 14rem);
        }

        .topbar {
            background-color: white;
            border-bottom: 1px solid #e3e6f0;
        }

        .container-fluid {
            padding: 2rem;
        }

        /* Sidebar toggled state */
        body.sidebar-toggled .sidebar {
            width: 6.5rem;
        }

        body.sidebar-toggled #content-wrapper {
            margin-left: 6.5rem;
            width: calc(100% - 6.5rem);
        }

        body.sidebar-toggled .sidebar .sidebar-brand-text,
        body.sidebar-toggled .sidebar .nav-link span {
            display: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 14rem;
                margin-left: -14rem;
                transition: margin-left 0.3s ease;
            }
            
            .sidebar.toggled {
                margin-left: 0;
            }
            
            #content-wrapper {
                margin-left: 0;
                width: 100%;
            }
            
            body.sidebar-toggled .sidebar {
                margin-left: 0;
                width: 14rem;
            }
            
            body.sidebar-toggled #content-wrapper {
                margin-left: 0;
                width: 100%;
            }
            
            .search-filter-section {
                padding: 1rem;
            }
            
            .pagination-section {
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn-action {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
            
            .subject-preview {
                max-width: 150px;
            }
        }
    </style>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard- 1</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard - 2 </span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
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
                                        <!-- Sample data will be loaded here -->
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination Section -->
                            <div class="pagination-section">
                                <div class="pagination-info">
                                    Showing <span id="showingStart">0</span> to <span id="showingEnd">0</span> of <span id="totalFeedback">0</span> feedback entries
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
                    <button class="btn btn-success btn-sm" type="button" onclick="markAsRead()">
                        <i class="fas fa-check mr-1"></i>Mark as Read
                    </button>
                    <button class="btn btn-primary btn-sm" type="button" onclick="markAsReplied()">
                        <i class="fas fa-reply mr-1"></i>Reply
                    </button>
                    <button class="btn btn-danger btn-sm" type="button" onclick="deleteFeedback()">
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

    <!-- Custom scripts for all pages-->
    <script>
        // Sample feedback data
        const feedbackData = [
            {
                id: 1,
                name: "John Doe",
                email: "john.doe@example.com",
                subject: "Website Navigation Issue",
                message: "I'm having trouble navigating through the website. The menu seems to be broken on mobile devices. Could you please look into this issue? It's making it difficult for me to access important information.",
                status: "new",
                createdAt: "2024-01-15 10:30:00"
            },
            {
                id: 2,
                name: "Sarah Johnson",
                email: "sarah.johnson@example.com",
                subject: "Great Customer Service",
                message: "I wanted to thank your team for the excellent customer service I received yesterday. The representative was very helpful and solved my problem quickly. Keep up the great work!",
                status: "read",
                createdAt: "2024-01-14 14:22:00"
            },
            {
                id: 3,
                name: "Mike Wilson",
                email: "mike.wilson@example.com",
                subject: "Feature Request",
                message: "It would be great if you could add a dark mode option to your application. Many users prefer dark themes, especially when working late hours. This would be a valuable addition to your platform.",
                status: "replied",
                createdAt: "2024-01-13 09:15:00"
            },
            {
                id: 4,
                name: "Emily Davis",
                email: "emily.davis@example.com",
                subject: "Billing Question",
                message: "I have a question about my recent billing statement. There seems to be a charge that I don't recognize. Could someone from your billing department contact me to clarify this?",
                status: "new",
                createdAt: "2024-01-12 16:45:00"
            },
            {
                id: 5,
                name: "David Brown",
                email: "david.brown@example.com",
                subject: "Product Suggestion",
                message: "I've been using your service for a while now and I have some suggestions for new features that could improve the user experience. Would you be interested in hearing my ideas?",
                status: "read",
                createdAt: "2024-01-11 11:30:00"
            },
            {
                id: 6,
                name: "Lisa Anderson",
                email: "lisa.anderson@example.com",
                subject: "Login Problems",
                message: "I'm unable to log into my account. I've tried resetting my password multiple times but I'm still getting an error message. Please help me resolve this issue as soon as possible.",
                status: "new",
                createdAt: "2024-01-10 13:20:00"
            },
            {
                id: 7,
                name: "Robert Taylor",
                email: "robert.taylor@example.com",
                subject: "Positive Feedback",
                message: "Just wanted to say that your latest update is fantastic! The new interface is much more intuitive and the performance improvements are noticeable. Great job to the development team!",
                status: "replied",
                createdAt: "2024-01-09 08:55:00"
            },
            {
                id: 8,
                name: "Jennifer White",
                email: "jennifer.white@example.com",
                subject: "Technical Support Needed",
                message: "I'm experiencing technical difficulties with the file upload feature. Every time I try to upload a document, I get an error message. This is affecting my work productivity. Please provide a solution.",
                status: "new",
                createdAt: "2024-01-08 15:10:00"
            }
        ];

        // Pagination variables
        let currentPage = 1;
        let itemsPerPage = 5;
        let filteredData = [...feedbackData];
        let currentFeedbackId = null;

        // Initialize the page
        $(document).ready(function() {
            loadFeedbackData();
            setupEventListeners();
        });

        // Setup event listeners
        function setupEventListeners() {
            // Search functionality
            $('#searchInput').on('input', function() {
                applyFilters();
            });

            // Status filter
            $('#statusFilter').on('change', function() {
                applyFilters();
            });

            // Sidebar toggle
            $('#sidebarToggle, #sidebarToggleTop').on('click', function() {
                $('body').toggleClass('sidebar-toggled');
                $('.sidebar').toggleClass('toggled');
            });
        }

        // Apply search and filter
        function applyFilters() {
            const searchTerm = $('#searchInput').val().toLowerCase();
            const statusFilter = $('#statusFilter').val();

            filteredData = feedbackData.filter(feedback => {
                const matchesSearch = !searchTerm || 
                    feedback.id.toString().includes(searchTerm) ||
                    feedback.name.toLowerCase().includes(searchTerm) ||
                    feedback.email.toLowerCase().includes(searchTerm) ||
                    feedback.subject.toLowerCase().includes(searchTerm);

                const matchesStatus = !statusFilter || feedback.status === statusFilter;

                return matchesSearch && matchesStatus;
            });

            currentPage = 1;
            loadFeedbackData();
        }

        // Load feedback data into table
        function loadFeedbackData() {
            const tableBody = $('#feedbackTableBody');
            tableBody.empty();

            if (filteredData.length === 0) {
                tableBody.append(`
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No feedback found</p>
                        </td>
                    </tr>
                `);
                updatePaginationInfo(0, 0, 0);
                return;
            }

            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedData = filteredData.slice(startIndex, endIndex);

            paginatedData.forEach(feedback => {
                const statusBadge = getStatusBadge(feedback.status);
                const subjectPreview = feedback.subject.length > 30 ? 
                    feedback.subject.substring(0, 30) + '...' : feedback.subject;

                tableBody.append(`
                    <tr class="feedback-row">
                        <td>${feedback.id}</td>
                        <td>${feedback.name}</td>
                        <td>${feedback.email}</td>
                        <td class="subject-preview" title="${feedback.subject}">${subjectPreview}</td>
                        <td>${statusBadge}</td>
                        <td>${formatDate(feedback.createdAt)}</td>
                        <td>
                            <button class="btn btn-info btn-sm btn-action" onclick="viewFeedback(${feedback.id})" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-success btn-sm btn-action" onclick="markAsRead(${feedback.id})" title="Mark as Read" ${feedback.status === 'read' || feedback.status === 'replied' ? 'disabled' : ''}>
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn btn-primary btn-sm btn-action" onclick="markAsReplied(${feedback.id})" title="Reply" ${feedback.status === 'replied' ? 'disabled' : ''}>
                                <i class="fas fa-reply"></i>
                            </button>
                            <button class="btn btn-danger btn-sm btn-action" onclick="deleteFeedback(${feedback.id})" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `);
            });

            updatePaginationInfo(startIndex + 1, Math.min(endIndex, filteredData.length), filteredData.length);
            updatePaginationButtons();
        }

        // Get status badge HTML
        function getStatusBadge(status) {
            const badges = {
                'new': '<span class="status-badge status-new">New</span>',
                'read': '<span class="status-badge status-read">Read</span>',
                'replied': '<span class="status-badge status-replied">Replied</span>'
            };
            return badges[status] || status;
        }

        // Format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        }

        // View feedback details
        function viewFeedback(feedbackId) {
            const feedback = feedbackData.find(f => f.id === feedbackId);
            if (!feedback) return;

            currentFeedbackId = feedbackId;

            $('#viewFeedbackId').text(feedback.id);
            $('#viewFeedbackName').text(feedback.name);
            $('#viewFeedbackEmail').text(feedback.email);
            $('#viewFeedbackSubject').text(feedback.subject);
            $('#viewFeedbackStatus').html(getStatusBadge(feedback.status));
            $('#viewFeedbackCreatedAt').text(formatDate(feedback.createdAt));
            $('#viewFeedbackMessage').text(feedback.message);

            $('#viewFeedbackModal').modal('show');
        }

        // Mark feedback as read
        function markAsRead(feedbackId = null) {
            const id = feedbackId || currentFeedbackId;
            if (!id) return;

            const feedbackIndex = feedbackData.findIndex(f => f.id === id);
            if (feedbackIndex !== -1 && feedbackData[feedbackIndex].status === 'new') {
                feedbackData[feedbackIndex].status = 'read';
                applyFilters();
                
                // Update modal if it's open
                if (currentFeedbackId === id) {
                    $('#viewFeedbackStatus').html(getStatusBadge('read'));
                }

                showAlert('Feedback marked as read successfully!', 'success');
            }
        }

       // Mark feedback as replied
function markAsReplied(feedbackId = null) {
    const id = feedbackId || currentFeedbackId;
    if (!id) return;

    const feedbackIndex = feedbackData.findIndex(f => f.id === id);
    if (feedbackIndex !== -1 && feedbackData[feedbackIndex].status !== 'replied') {
        feedbackData[feedbackIndex].status = 'replied';
        applyFilters();
        
        // Update modal if it's open
        if (currentFeedbackId === id) {
            $('#viewFeedbackStatus').html(getStatusBadge('replied'));
        }

        showAlert('Feedback marked as replied successfully!', 'success');
    }
}

       
        // Delete feedback
        function deleteFeedback(feedbackId = null) {
            const id = feedbackId || currentFeedbackId;
            if (!id) return;

            if (confirm('Are you sure you want to delete this feedback? This action cannot be undone.')) {
                const feedbackIndex = feedbackData.findIndex(f => f.id === id);
                if (feedbackIndex !== -1) {
                    feedbackData.splice(feedbackIndex, 1);
                    applyFilters();
                    $('#viewFeedbackModal').modal('hide');
                    showAlert('Feedback deleted successfully!', 'success');
                }
            }
        }

        // Pagination functions
        function changePage(direction) {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            const newPage = currentPage + direction;

            if (newPage >= 1 && newPage <= totalPages) {
                currentPage = newPage;
                loadFeedbackData();
            }
        }

        function updatePaginationInfo(start, end, total) {
            $('#showingStart').text(start);
            $('#showingEnd').text(end);
            $('#totalFeedback').text(total);
        }

        function updatePaginationButtons() {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            
            $('#prevPageBtn').prop('disabled', currentPage <= 1);
            $('#nextPageBtn').prop('disabled', currentPage >= totalPages);
            $('#currentPageSpan').text(currentPage);
        }

        // Show alert messages
        function showAlert(message, type) {
            const alertClass = type === 'success' ? 'alert-success' : type === 'warning' ? 'alert-warning' : 'alert-danger';
            const alertHtml = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            `;
            
            $('.container-fluid').prepend(alertHtml);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                $('.alert').fadeOut();
            }, 3000);
        }

        // Initialize tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</body>
</html>