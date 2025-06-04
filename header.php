<?php
// header.php - Reusable Mobile Responsive Navbar Component
// Usage: <?php include 'header.php'; ?>

<style>
    /* Mobile Responsive Navbar Styles */
    @media (max-width: 768px) {
        .header-nav {
            display: none;
        }
        
        .mobile-menu-button {
            display: block;
        }
        
        .mobile-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #f1f2f4;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            z-index: 50;
            transform: translateY(-100%);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
        }
        
        .mobile-menu.show {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
    }
    
    @media (min-width: 769px) {
        .mobile-menu-button {
            display: none;
        }
        
        .mobile-menu {
            display: none;
        }
    }

    /* Hamburger Animation Styles */
    .hamburger {
        cursor: pointer;
        width: 24px;
        height: 24px;
        position: relative;
        transition: all 0.3s ease;
    }

    .hamburger span {
        display: block;
        position: absolute;
        height: 2px;
        width: 100%;
        background: #121416;
        border-radius: 1px;
        opacity: 1;
        left: 0;
        transform: rotate(0deg);
        transition: all 0.3s ease;
    }

    .hamburger span:nth-child(1) {
        top: 0px;
    }

    .hamburger span:nth-child(2) {
        top: 8px;
    }

    .hamburger span:nth-child(3) {
        top: 16px;
    }

    .hamburger.active span:nth-child(1) {
        top: 8px;
        transform: rotate(135deg);
    }

    .hamburger.active span:nth-child(2) {
        opacity: 0;
        left: -60px;
    }

    .hamburger.active span:nth-child(3) {
        top: 8px;
        transform: rotate(-135deg);
    }

    /* Hover Effects */
    .nav-link:hover {
        color: #3b82f6;
        transition: color 0.3s ease;
    }

    .login-btn:hover {
        background-color: #dde0e3;
        transition: background-color 0.3s ease;
    }

    .mobile-nav-link:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }
</style>

<!-- Header Navigation -->
<header class="relative flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f1f2f4] px-4 md:px-10 py-3">
    <!-- Logo Section -->
    <div class="flex items-center gap-3 text-[#121416]">
        <div class="size-4">
            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor"></path>
            </svg>
        </div>
        <h2 class="text-[#121416] text-lg font-bold leading-tight tracking-[-0.015em]">
            <a href="index.php" class="text-decoration-none">CodeCraft</a>
        </h2>
    </div>
    
    <!-- Desktop Navigation -->
    <div class="header-nav flex flex-1 justify-end gap-6">
        <div class="flex items-center gap-6">
            <a class="nav-link text-[#121416] text-sm font-medium leading-normal" href="index.php">Home</a>
            <a class="nav-link text-[#121416] text-sm font-medium leading-normal" href="products.php">Projects</a>
            <a class="nav-link text-[#121416] text-sm font-medium leading-normal" href="about.php">About Us</a>
            <a class="nav-link text-[#121416] text-sm font-medium leading-normal" href="contact.php">Contact</a>
        </div>
        <button class="login-btn flex min-w-[70px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-3 bg-[#f1f2f4] text-[#121416] text-sm font-bold leading-normal tracking-[0.015em]">
            <a href="login.php" class="text-decoration-none text-[#121416]">
                <span class="truncate">Login</span>
            </a>
        </button>
    </div>
    
    <!-- Mobile Menu Button -->
    <div class="mobile-menu-button">
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobile-menu">
        <nav class="flex flex-col py-4">
            <a class="mobile-nav-link text-[#121416] text-sm font-medium leading-normal px-6 py-3" href="index.php">Home</a>
            <a class="mobile-nav-link text-[#121416] text-sm font-medium leading-normal px-6 py-3" href="projects.php">Projects</a>
            <a class="mobile-nav-link text-[#121416] text-sm font-medium leading-normal px-6 py-3" href="about.php">About Us</a>
            <a class="mobile-nav-link text-[#121416] text-sm font-medium leading-normal px-6 py-3" href="contact.php">Contact</a>
            <div class="px-6 py-3">
                <button class="login-btn flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#f1f2f4] text-[#121416] text-sm font-bold leading-normal tracking-[0.015em]">
                    <a href="login.php" class="text-decoration-none text-[#121416]">
                        <span class="truncate">Login</span>
                    </a>
                </button>
            </div>
        </nav>
    </div>
</header>

<script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');

        if (hamburger && mobileMenu) {
            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('active');
                mobileMenu.classList.toggle('show');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideNav = hamburger.contains(event.target) || mobileMenu.contains(event.target);
                
                if (!isClickInsideNav && mobileMenu.classList.contains('show')) {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('show');
                }
            });

            // Close mobile menu when clicking on a link
            const mobileMenuLinks = mobileMenu.querySelectorAll('a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('show');
                });
            });

            // Close mobile menu on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('show');
                }
            });
        }
    });
</script>