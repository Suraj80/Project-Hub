    
    <style>
        /* Custom styles for better navbar appearance */
        .navbar {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        /* Improved navbar item colors */
        .navbar-nav .nav-link {
            color: #5a5c69 !important;
            font-weight: 500;
            padding: 0.75rem 1rem !important;
            transition: all 0.3s ease;
            border-radius: 0.375rem;
            margin: 0 0.125rem;
        }
        
        .navbar-nav .nav-link:hover {
            color: #3d5af1 !important;
            background-color: rgba(61, 90, 241, 0.1);
            transform: translateY(-1px);
        }
        
        .navbar-nav .nav-link:focus {
            color: #3d5af1 !important;
            background-color: rgba(61, 90, 241, 0.15);
        }
        
        /* Active state for nav items */
        .navbar-nav .nav-item.active .nav-link {
            color: #3d5af1 !important;
            background-color: rgba(61, 90, 241, 0.1);
            font-weight: 600;
        }
        
        /* Profile dropdown improvements */
        .dropdown-toggle::after {
            display: none;
        }
        
        .img-profile {
            height: 2rem;
            width: 2rem;
            border: 2px solid #e3e6f0;
            transition: border-color 0.3s ease;
        }
        
        .nav-item.dropdown:hover .img-profile {
            border-color: #3d5af1;
        }
        
        /* Dropdown menu styling */
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 0.5rem;
            min-width: 200px;
        }
        
        .dropdown-item {
            padding: 0.75rem 1.25rem;
            color: #5a5c69;
            font-weight: 400;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fc;
            color: #3d5af1;
            transform: translateX(5px);
        }
        
        .dropdown-item i {
            width: 16px;
            text-align: center;
        }
        
        .dropdown-divider {
            margin: 0.5rem 0;
            border-color: #e3e6f0;
        }
        
        /* User name styling */
        .text-gray-600 {
            color: #6c757d !important;
            font-weight: 500;
        }
        
        /* Topbar divider */
        .topbar-divider {
            width: 0;
            border-right: 1px solid #e3e6f0;
            height: calc(4.375rem / 2);
            margin: auto 1rem;
        }
        
        /* Admin brand styling */
        .navbar-brand {
            color: #5a5c69;
            font-size: 1.1rem;
        }
        
        .text-primary {
            color: #3d5af1 !important;
        }
        
        /* Sidebar toggle button */
        #sidebarToggleTop {
            background: none;
            border: none;
            color: #5a5c69;
            font-size: 1.25rem;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        #sidebarToggleTop:hover {
            background-color: rgba(61, 90, 241, 0.1);
            color: #3d5af1;
        }
        
        /* Animation for dropdown */
        .dropdown-menu.show {
            animation: fadeInUp 0.3s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive improvements */
        @media (max-width: 768px) {
            .navbar-nav .nav-link {
                padding: 0.5rem 0.75rem !important;
            }
            
            .d-none.d-lg-inline {
                display: none !important;
            }
        }
    </style>

    <!-- Content Wrapper -->
    <!-- <div id="content-wrapper" class="d-flex flex-column"> -->
        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Admin Text -->
                <div class="navbar-brand">
                    <i class="fas fa-user-shield text-primary mr-2"></i>
                    <span class="font-weight-bold text-primary">Admin</span>
                </div>

                <!-- Navigation Items -->
                <ul class="navbar-nav mr-auto ml-4">
                    <li class="nav-item ">
                        <a class="nav-link" href="dashboard1.php">Dashboard 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard2.php">Dashboard 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="feedback.php">Feedback</a>
                    </li>
                </ul>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Suraj</span>
                            <img class="img-profile rounded-circle"
                                src="assets/images/profile.jpg" alt="Profile">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <!-- <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a> -->
                            <a class="dropdown-item" href="activity_log.php">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
            
            <!-- Demo content to show the navbar in context -->
            

        </div>
        <!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Select "Logout" below if you are ready to end your current session.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Ensure dropdown works properly
        $(document).ready(function() {
            // Handle dropdown toggle
            $('.dropdown-toggle').dropdown();
            
            $('.navbar-nav .nav-link').on('click', function() {
              $('.navbar-nav .nav-item').removeClass('active');
              $(this).parent().addClass('active');
            });

            
            // Sidebar toggle functionality
            $('#sidebarToggleTop').on('click', function() {
                // Add your sidebar toggle logic here
                console.log('Sidebar toggle clicked');
            });
        });
    </script>
<