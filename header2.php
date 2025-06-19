<?php
// header.php - Dynamic navigation header based on user authentication
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



// Manually set session values for testing
//$_SESSION['user_id'] = 1;           // Example user ID
//$_SESSION['user_name'] = 'Suraj';     // Optional: username
// $_SESSION['user_email'] = 'suraj@example.com'; // Optional: email

// echo "Session set for testing!";

// Check if user is logged in
// $isLoggedIn = isset($_SESSION['user']) && !empty($_SESSION['user']);
// Alternative check methods you can use:
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
// $isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeCraft</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Space Grotesk", "Noto Sans", sans-serif;
        }
        .order-card {
            transition: all 0.3s ease;
        }
        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(16, 21, 24, 0.1);
        }
        .status-badge {
            animation: pulse 2s infinite;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-menu.open {
            transform: translateX(0);
        }
    </style>
</head>
<body class="bg-slate-50">
    <div class="relative flex size-full min-h-screen flex-col bg-slate-50 group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        
        <?php if (!$isLoggedIn): ?>
        <!-- Header for NON-LOGGED IN users -->
        <!-- Fixed Header with backdrop blur for better visibility -->
        <header class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e7edf4] px-4 sm:px-6 lg:px-10 py-3 bg-white/95 backdrop-blur-sm shadow-sm">
            <div class="flex items-center gap-4 text-[#0d141c]">
                <div class="size-4">
                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor"></path>
                    </svg>
                </div>
                <h2 class="text-[#0d141c] text-lg font-bold leading-tight tracking-[-0.015em]">CodeCraft</h2>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden lg:flex flex-1 justify-end gap-8">
                <div class="flex items-center gap-9">
                    <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors" href="index.php">Home</a>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors" href="products.php">Projects</a>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors" href="about.php">About</a>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors" href="contact.php">Contact</a>
                </div>
                <div class="flex gap-2">
                    <a href="login.php" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] transition-colors">
                        <span class="truncate">Login</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden flex items-center justify-center w-10 h-10 rounded-lg bg-[#e7edf4] text-[#0d141c] hover:bg-[#d1dce7] transition-colors" id="mobile-menu-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"></path>
                </svg>
            </button>
        </header>

        <!-- Mobile Navigation Menu for NON-LOGGED IN users -->
        <div class="lg:hidden hidden fixed top-[73px] left-0 right-0 z-40 bg-white/95 backdrop-blur-sm border-b border-[#e7edf4] px-4 py-4 shadow-sm" id="mobile-menu">
            <div class="flex flex-col gap-4">
                <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors py-2" href="index.php">Home</a>
                <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors py-2" href="products.php">Projects</a>
                <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors py-2" href="about.php">About</a>
                <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors py-2" href="contact.php">Contact</a>
                <div class="flex flex-col gap-2 pt-4 border-t border-[#e7edf4]">
                    <a href="login.php" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] transition-colors">
                        <span class="truncate">Login</span>
                    </a>
                </div>
            </div>
        </div>

        <?php else: ?>
        <!-- Header for LOGGED IN users -->
        <!-- Mobile Menu Overlay -->
        <div id="menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>
        
        <!-- Mobile Menu for LOGGED IN users -->
        <div id="mobile-menu-logged" class="mobile-menu fixed left-0 top-0 h-full w-64 bg-white z-50 lg:hidden shadow-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div class="size-8">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <h2 class="text-[#101518] text-xl font-bold">CodeCraft</h2>
                    </div>
                    <button id="close-menu" class="p-2 -mr-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <nav class="space-y-4">
                    <a href="dashboard.php" class="block text-[#101518] text-lg font-medium py-3 px-4 rounded-lg hover:bg-gray-100 transition-colors">Dashboard</a>
                    <a href="products.php" class="block text-[#101518] text-lg font-medium py-3 px-4 rounded-lg hover:bg-gray-100 transition-colors">Projects</a>
                    <a href="services.php" class="block text-[#101518] text-lg font-medium py-3 px-4 rounded-lg hover:bg-gray-100 transition-colors">Services</a>
                    <a href="profile.php" class="block text-[#101518] text-lg font-medium py-3 px-4 rounded-lg hover:bg-gray-100 transition-colors">Profile</a>
                    <a href="logout.php" class="block text-red-600 text-lg font-medium py-3 px-4 rounded-lg hover:bg-red-50 transition-colors">Logout</a>
                </nav>
            </div>
        </div>

        <div class="layout-container flex h-full grow flex-col">
            <!-- Header for LOGGED IN users -->
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#eaedf1] px-4 lg:px-10 py-4 bg-white shadow-sm">
                <div class="flex items-center gap-8">
                    <!-- Mobile Menu Button -->
                    <button id="menu-toggle" class="lg:hidden p-2 -ml-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <div class="flex items-center gap-4 text-[#101518]">
                        <div class="size-4">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <h2 class="text-[#101518] text-lg font-bold leading-tight tracking-[-0.015em]">CodeCraft</h2>
                    </div>
                    
                    <!-- Desktop Navigation for LOGGED IN users -->
                    <div class="hidden lg:flex items-center gap-9">
                        <a class="text-[#101518] text-sm font-medium leading-normal hover:text-blue-600 transition-colors" href="dashboard.php">Dashboard</a>
                        <a class="text-[#101518] text-sm font-medium leading-normal hover:text-blue-600 transition-colors" href="products.php">Projects</a>
                        <a class="text-[#101518] text-sm font-medium leading-normal hover:text-blue-600 transition-colors" href="services.php">Services</a>
                        <a class="text-[#101518] text-sm font-medium leading-normal hover:text-blue-600 transition-colors" href="profile.php">Profile</a>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 lg:gap-8">
                    <!-- Search Bar - Hidden on mobile, visible on tablet+ -->
                    <div class="hidden md:block">
                        <label class="flex flex-col min-w-40 !h-10 max-w-64">
                            <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                                <div class="text-[#5c748a] flex border-none bg-[#eaedf1] items-center justify-center pl-4 rounded-l-xl border-r-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                                    </svg>
                                </div>
                                <input placeholder="Search orders..." class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#101518] focus:outline-0 focus:ring-0 border-none bg-[#eaedf1] focus:border-none h-full placeholder:text-[#5c748a] px-4 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal" value="" />
                            </div>
                        </label>
                    </div>
                    
                    <!-- Wishlist Button -->
                    <a href="wishlist.php" class="flex items-center justify-center rounded-full h-10 w-10 bg-[#f0f2f5] text-[#111418] hover:bg-gray-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                        </svg>
                    </a>

                    
                    <!-- Cart Button -->
                    <a href="cart.php" aria-label="Go to Cart"
                        class="flex cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 w-10 bg-[#eaedf1] text-[#101518] hover:bg-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M222.14,58.87A8,8,0,0,0,216,56H54.68L49.79,29.14A16,16,0,0,0,34.05,16H16a8,8,0,0,0,0,16h18L59.56,172.29a24,24,0,0,0,5.33,11.27,28,28,0,1,0,44.4,8.44h45.42A27.75,27.75,0,0,0,152,204a28,28,0,1,0,28-28H83.17a8,8,0,0,1-7.87-6.57L72.13,152h116a24,24,0,0,0,23.61-19.71l12.16-66.86A8,8,0,0,0,222.14,58.87ZM96,204a12,12,0,1,1-12-12A12,12,0,0,1,96,204Zm96,0a12,12,0,1,1-12-12A12,12,0,0,1,192,204Zm4-74.57A8,8,0,0,1,188.1,136H69.22L57.59,72H206.41Z"></path>
                        </svg>
                    </a>

                    
                    <!-- Profile Picture with Dropdown -->
                    <div class="relative">
                        <button id="profile-button" class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 ring-2 ring-gray-200 hover:ring-blue-300 transition-all cursor-pointer" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB9qS9Y5ERmIU9XoICgjEdmhzj373wGCdwkCTJCUEIPDFVgxDUDaR1Ab0hfpI8M79zWOL-13w4A_36pgvr_t2JjD1CfTpgTW42a4zBzU86NEKkyE5fiVO4feO2C3l7gCixZaeb2_YqpCYx_2M6vqbdFT973vkKN8SqW6xFCBfR90cT-BOaMwUCnNfTU6cxyL-vqjWiIjMbBht1rGpbHBDdp5lPdPWNyLbvdFq5Aq5B5klQXAwVD_MWu6T02LY_lO4T71AIzbAoZTM8");'>
                        </button>
                        <!-- Profile Dropdown -->
                        <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                            <div class="py-2">
                                <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="orders.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Orders</a>
                                <div class="border-t border-gray-100"></div>
                                <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <?php endif; ?>

        <script>
            <?php if (!$isLoggedIn): ?>
            // Scripts for NON-LOGGED IN users
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });

                // Close mobile menu when clicking on links
                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                    });
                });
            }

            <?php else: ?>
            // Scripts for LOGGED IN users
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenuLogged = document.getElementById('mobile-menu-logged');
            const menuOverlay = document.getElementById('menu-overlay');
            const closeMenu = document.getElementById('close-menu');
            const profileButton = document.getElementById('profile-button');
            const profileDropdown = document.getElementById('profile-dropdown');

            function openMobileMenu() {
                if (mobileMenuLogged && menuOverlay) {
                    mobileMenuLogged.classList.add('open');
                    menuOverlay.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeMobileMenu() {
                if (mobileMenuLogged && menuOverlay) {
                    mobileMenuLogged.classList.remove('open');
                    menuOverlay.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            }

            if (menuToggle) menuToggle.addEventListener('click', openMobileMenu);
            if (closeMenu) closeMenu.addEventListener('click', closeMobileMenu);
            if (menuOverlay) menuOverlay.addEventListener('click', closeMobileMenu);

            // Profile dropdown functionality
            if (profileButton && profileDropdown) {
                profileButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                        profileDropdown.classList.add('hidden');
                    }
                });
            }

            // Remove from wishlist functionality
            function removeFromWishlist(button) {
                const card = button.closest('.wishlist-card');
                if (card) {
                    card.style.transform = 'scale(0.8)';
                    card.style.opacity = '0';
                    card.style.transition = 'all 0.3s ease';
                    
                    setTimeout(() => {
                        card.remove();
                        updateWishlistCount();
                        checkEmptyState();
                    }, 300);
                }
            }

            // Update wishlist count
            function updateWishlistCount() {
                const cards = document.querySelectorAll('.wishlist-card');
                const countElement = document.querySelector('.text-sm.text-\\[\\#60758a\\]');
                if (countElement) {
                    countElement.textContent = `${cards.length} projects saved`;
                }
            }

            // Check if wishlist is empty and show empty state
            function checkEmptyState() {
                const cards = document.querySelectorAll('.wishlist-card');
                const emptyState = document.getElementById('emptyState');
                const grid = document.querySelector('.grid.grid-cols-1.lg\\:grid-cols-2');
                
                if (cards.length === 0 && emptyState && grid) {
                    grid.classList.add('hidden');
                    emptyState.classList.remove('hidden');
                }
            }
            <?php endif; ?>

            // Common scripts for both states
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const headerHeight = <?php echo $isLoggedIn ? '80' : '73'; ?>; // Adjust based on header height
                        const targetPosition = target.offsetTop - headerHeight;
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Add staggered animation delay to order cards
            document.addEventListener('DOMContentLoaded', function() {
                const orderCards = document.querySelectorAll('.fade-in-up');
                orderCards.forEach((card, index) => {
                    card.style.animationDelay = `${index * 0.1}s`;
                });
            });

            // Smooth scroll behavior for better UX
            document.documentElement.style.scrollBehavior = 'smooth';

            // Add loading state simulation for buttons
            document.querySelectorAll('button').forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!this.classList.contains('loading') && !this.id.includes('menu') && !this.id.includes('profile')) {
                        const originalText = this.textContent;
                        this.classList.add('loading');
                        this.textContent = 'Loading...';
                        this.style.pointerEvents = 'none';
                        
                        setTimeout(() => {
                            this.textContent = originalText;
                            this.classList.remove('loading');
                            this.style.pointerEvents = '';
                        }, 1500);
                    }
                });
            });
        </script>