<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Responsive Navbar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Custom styles for better navbar appearance */
        .navbar {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 0.5rem 1rem;
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
        
        /* Mobile Navigation Toggle Button */
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2833, 37, 41, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        /* Mobile Responsive Styles */
        @media (max-width: 991.98px) {
            /* Hide sidebar toggle on mobile since we'll use navbar toggler */
            #sidebarToggleTop {
                display: none !important;
            }
            
            /* Adjust navbar brand for mobile */
            .navbar-brand {
                font-size: 1rem;
                flex-grow: 1;
            }
            
            /* Make navbar collapse properly */
            .navbar-collapse {
                margin-top: 1rem;
                border-top: 1px solid #e3e6f0;
                padding-top: 1rem;
            }
            
            /* Stack navigation items vertically on mobile */
            .navbar-nav {
                width: 100%;
            }
            
            .navbar-nav .nav-link {
                padding: 0.75rem 0 !important;
                margin: 0.125rem 0;
                border-radius: 0.375rem;
                display: block;
            }
            
            /* Adjust user profile section for mobile */
            .navbar-nav.ml-auto {
                margin-top: 1rem;
                padding-top: 1rem;
                border-top: 1px solid #e3e6f0;
            }
            
            /* Hide topbar divider on mobile */
            .topbar-divider {
                display: none !important;
            }
            
            /* Adjust profile dropdown for mobile */
            .nav-item.dropdown .nav-link {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            
            /* Make dropdown menu full width on mobile */
            .dropdown-menu {
                width: 100%;
                margin-top: 0.5rem;
                position: static !important;
                transform: none !important;
                box-shadow: none;
                border: 1px solid #e3e6f0;
                border-radius: 0.375rem;
            }
            
            /* Adjust user name display */
            .d-none.d-lg-inline {
                display: inline !important;
            }
        }
        
        @media (max-width: 767.98px) {
            /* Further adjustments for very small screens */
            .navbar {
                padding: 0.5rem;
            }
            
            .navbar-brand {
                font-size: 0.9rem;
            }
            
            .navbar-brand i {
                display: none;
            }
            
            .img-profile {
                height: 1.75rem;
                width: 1.75rem;
            }
            
            .navbar-nav .nav-link {
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 575.98px) {
            /* Extra small screens */
            .navbar-brand span {
                font-size: 0.85rem;
            }
            
            .navbar-nav .nav-link {
                font-size: 0.85rem;
                padding: 0.65rem 0 !important;
            }
            
            .dropdown-item {
                padding: 0.65rem 1rem;
                font-size: 0.85rem;
            }
        }
        
        /* Smooth transitions for responsive changes */
        .navbar-nav, .navbar-collapse, .navbar-brand {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <!-- Content Wrapper -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) - Only visible on medium+ screens -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Admin Text -->
            <div class="navbar-brand">
                <i class="fas fa-user-shield text-primary mr-2"></i>
                <span class="font-weight-bold text-primary">Admin</span>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Navigation Items -->
                <ul class="navbar-nav mr-auto ml-lg-4">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard1.php">Dashboard 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard2.php">Dashboard 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>
                    <li class="nav-item">
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
                    <div class="topbar-divider d-none d-lg-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-sm-inline text-gray-600 small">Suraj</span>
                            <img class="img-profile rounded-circle"
                                src="https://via.placeholder.com/40x40/007bff/ffffff?text=S" alt="Profile" width="40" height="40">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
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
            </div>
        </nav>
        <!-- End of Topbar -->
     

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
                
                // Close mobile menu when nav item is clicked
                if ($(window).width() < 992) {
                    $('.navbar-collapse').collapse('hide');
                }
            });
            
            // Sidebar toggle functionality
            $('#sidebarToggleTop').on('click', function() {
                // Add your sidebar toggle logic here
                console.log('Sidebar toggle clicked');
            });
            
            // Close mobile menu when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.navbar').length) {
                    $('.navbar-collapse').collapse('hide');
                }
            });
        });
    </script>
</body>
</html>