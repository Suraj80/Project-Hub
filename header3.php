<style>
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
<body>
    <div class="relative flex size-full min-h-screen flex-col bg-gray-50 group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        <!-- Mobile Menu Overlay -->
        <div id="menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu fixed left-0 top-0 h-full w-64 bg-white z-50 lg:hidden shadow-xl">
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
                    <a href="#" class="block text-[#101518] text-lg font-medium py-3 px-4 rounded-lg hover:bg-gray-100 transition-colors">Projects</a>
                    <a href="#" class="block text-[#101518] text-lg font-medium py-3 px-4 rounded-lg hover:bg-gray-100 transition-colors">Services</a>
                    <a href="#" class="block text-[#101518] text-lg font-medium py-3 px-4 rounded-lg hover:bg-gray-100 transition-colors">Resources</a>
                    <a href="#" class="block text-[#101518] text-lg font-medium py-3 px-4 rounded-lg hover:bg-gray-100 transition-colors">About</a>
                </nav>
            </div>
        </div>

        <div class="layout-container flex h-full grow flex-col">
            <!-- Header -->
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
                    
                    <!-- Desktop Navigation -->
                    <div class="hidden lg:flex items-center gap-9">
                        <a class="text-[#101518] text-sm font-medium leading-normal hover:text-blue-600 transition-colors" href="#">Projects</a>
                        <a class="text-[#101518] text-sm font-medium leading-normal hover:text-blue-600 transition-colors" href="#">Services</a>
                        <a class="text-[#101518] text-sm font-medium leading-normal hover:text-blue-600 transition-colors" href="#">Resources</a>
                        <a class="text-[#101518] text-sm font-medium leading-normal hover:text-blue-600 transition-colors" href="#">About</a>
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
                      <button class="flex items-center justify-center rounded-full h-10 w-10 bg-[#f0f2f5] text-[#111418] hover:bg-gray-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                            </svg>
                        </button>
                    
                    <!-- Cart Button -->
                    <button class="flex cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 w-10 bg-[#eaedf1] text-[#101518] hover:bg-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M222.14,58.87A8,8,0,0,0,216,56H54.68L49.79,29.14A16,16,0,0,0,34.05,16H16a8,8,0,0,0,0,16h18L59.56,172.29a24,24,0,0,0,5.33,11.27,28,28,0,1,0,44.4,8.44h45.42A27.75,27.75,0,0,0,152,204a28,28,0,1,0,28-28H83.17a8,8,0,0,1-7.87-6.57L72.13,152h116a24,24,0,0,0,23.61-19.71l12.16-66.86A8,8,0,0,0,222.14,58.87ZM96,204a12,12,0,1,1-12-12A12,12,0,0,1,96,204Zm96,0a12,12,0,1,1-12-12A12,12,0,0,1,192,204Zm4-74.57A8,8,0,0,1,188.1,136H69.22L57.59,72H206.41Z"></path>
                        </svg>
                    </button>
                    
                    <!-- Profile Picture -->
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 ring-2 ring-gray-200 hover:ring-blue-300 transition-all cursor-pointer" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB9qS9Y5ERmIU9XoICgjEdmhzj373wGCdwkCTJCUEIPDFVgxDUDaR1Ab0hfpI8M79zWOL-13w4A_36pgvr_t2JjD1CfTpgTW42a4zBzU86NEKkyE5fiVO4feO2C3l7gCixZaeb2_YqpCYx_2M6vqbdFT973vkKN8SqW6xFCBfR90cT-BOaMwUCnNfTU6cxyL-vqjWiIjMbBht1rGpbHBDdp5lPdPWNyLbvdFq5Aq5B5klQXAwVD_MWu6T02LY_lO4T71AIzbAoZTM8");'>
                        
                    </div>
                </div>
            </header>

            <script>
    // Mobile menu functionality
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOverlay = document.getElementById('menu-overlay');
    const closeMenu = document.getElementById('close-menu');

    function openMobileMenu() {
        mobileMenu.classList.add('open');
        menuOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        mobileMenu.classList.remove('open');
        menuOverlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    menuToggle.addEventListener('click', openMobileMenu);
    closeMenu.addEventListener('click', closeMobileMenu);
    menuOverlay.addEventListener('click', closeMobileMenu);

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
            if (!this.classList.contains('loading')) {
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
     
        // Mobile menu toggle functionality
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const overlay = document.getElementById('mobileOverlay');
            
            mobileMenu.classList.toggle('open');
            overlay.classList.toggle('hidden');
        }

        // Remove from wishlist functionality
        function removeFromWishlist(button) {
            const card = button.closest('.wishlist-card');
            
            // Add removal animation
            card.style.transform = 'scale(0.8)';
            card.style.opacity = '0';
            card.style.transition = 'all 0.3s ease';
            
            setTimeout(() => {
                card.remove();
                updateWishlistCount();
                checkEmptyState();
            }, 300);
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
            
            if (cards.length === 0) {
                grid.classList.add('hidden');
                emptyState.classList.remove('hidden');
            }
        }
</>