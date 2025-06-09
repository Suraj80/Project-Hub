<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Space+Grotesk%3Awght%40400%3B500%3B700"
    />
    <title>Orders - CodeCraft</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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

            <!-- Main Content -->
            <main class="flex-1 px-4 lg:px-8 xl:px-12 py-6 lg:py-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Page Header -->
                    <div class="mb-8 fade-in-up">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                            <div>
                                <h1 class="text-3xl lg:text-4xl font-bold text-[#101518] mb-2">Your Orders</h1>
                                <p class="text-[#5c748a] text-lg">Track and manage your development projects</p>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <select class="px-4 py-2 rounded-lg border border-[#eaedf1] text-[#101518] bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                    <option>All Orders</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Pending</option>
                                </select>
                                <button class="px-6 py-2 bg-[#101518] text-white rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium">
                                    New Order
                                </button>
                            </div>
                        </div>
                        
                        <!-- Stats Cards -->
                        <!-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                            <div class="bg-white rounded-xl p-6 shadow-sm border border-[#eaedf1]">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-[#5c748a] text-sm font-medium">Total Orders</p>
                                        <p class="text-2xl font-bold text-[#101518] mt-1">12</p>
                                    </div>
                                    <div class="p-3 bg-blue-100 rounded-lg">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white rounded-xl p-6 shadow-sm border border-[#eaedf1]">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-[#5c748a] text-sm font-medium">In Progress</p>
                                        <p class="text-2xl font-bold text-[#101518] mt-1">3</p>
                                    </div>
                                    <div class="p-3 bg-yellow-100 rounded-lg">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white rounded-xl p-6 shadow-sm border border-[#eaedf1]">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-[#5c748a] text-sm font-medium">Completed</p>
                                        <p class="text-2xl font-bold text-[#101518] mt-1">8</p>
                                    </div>
                                    <div class="p-3 bg-green-100 rounded-lg">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white rounded-xl p-6 shadow-sm border border-[#eaedf1]">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-[#5c748a] text-sm font-medium">Total Value</p>
                                        <p class="text-2xl font-bold text-[#101518] mt-1">$24.5K</p>
                                    </div>
                                    <div class="p-3 bg-purple-100 rounded-lg">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- Orders List -->
                    <div class="space-y-6">
                        <!-- Order 1 -->
                        <div class="order-card bg-white rounded-2xl shadow-sm border border-[#eaedf1] overflow-hidden fade-in-up">
                            <div class="p-6 lg:p-8">
                                <div class="flex flex-col lg:flex-row gap-6">
                                    <div class="flex-1 space-y-4">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                            <div class="flex items-center gap-3">
                                                <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    ✓ Completed
                                                </span>
                                                <span class="text-[#5c748a] text-sm">July 12, 2024</span>
                                            </div>
                                            <p class="text-[#5c748a] text-sm font-mono">#1234567890</p>
                                        </div>
                                        
                                        <div>
                                            <h3 class="text-xl lg:text-2xl font-bold text-[#101518] mb-2">Data Analysis Tool</h3>
                                            <p class="text-[#5c748a] leading-relaxed">Advanced analytics dashboard with real-time data visualization, custom reporting features, and machine learning integration for predictive insights.</p>
                                        </div>
                                        
                                        <div class="flex flex-wrap items-center gap-4 pt-2">
                                            <div class="flex items-center gap-2 text-sm text-[#5c748a]">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>6 weeks delivery</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-sm text-[#5c748a]">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                </svg>
                                                <span class="font-semibold">$8,500</span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                                            <button class="flex-1 sm:flex-none px-6 py-3 bg-[#101518] text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                                                View Details
                                            </button>
                                            <button class="flex-1 sm:flex-none px-6 py-3 bg-[#eaedf1] text-[#101518] rounded-xl hover:bg-gray-200 transition-colors font-medium">
                                                Download Files
                                            </button>
                                            <button class="flex-1 sm:flex-none px-6 py-3 border border-[#eaedf1] text-[#5c748a] rounded-xl hover:bg-gray-50 transition-colors font-medium">
                                                Contact Support
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="lg:w-80 xl:w-96">
                                        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl shadow-md" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAymfMbKA0tazF2PKrr3QijP3-IF2y1-vNRxmcAhmy3E5JVailIznsjfVotEPECJ7cqb-vjzy32mL7uv-_UsmiWNz9JlZxoc5fFHJEtXzIrfwYTugIVfNsMyNi9BIRah0JOZ_WvLPuEZfsGWPgz4HvwttWElSdLvifLQAIQ0xOx1X-DOWqfk5O8nl7xGCk8D5RnaXUZ30MMdinD6brDSTfqEB2xA48gYvGsr3AvF9GFTBLJ13mw8LCVqDLYegh_imOFaJjsWcry6kQ");'></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order 2 -->
                        <div class="order-card bg-white rounded-2xl shadow-sm border border-[#eaedf1] overflow-hidden fade-in-up">
                            <div class="p-6 lg:p-8">
                                <div class="flex flex-col lg:flex-row gap-6">
                                    <div class="flex-1 space-y-4">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                            <div class="flex items-center gap-3">
                                                <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    ⏳ In Progress
                                                </span>
                                                <span class="text-[#5c748a] text-sm">June 20, 2024</span>
                                            </div>
                                            <p class="text-[#5c748a] text-sm font-mono">#9876543210</p>
                                        </div>
                                        
                                        <div>
                                            <h3 class="text-xl lg:text-2xl font-bold text-[#101518] mb-2">E-commerce Website</h3>
                                            <p class="text-[#5c748a] leading-relaxed">Modern, responsive e-commerce platform with integrated payment processing, inventory management, and customer analytics dashboard.</p>
                                        </div>
                                        
                                        <div class="flex flex-wrap items-center gap-4 pt-2">
                                            <div class="flex items-center gap-2 text-sm text-[#5c748a]">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>8 weeks delivery</span>
                                            </div>
                                            <div class="flex items-center gap-2 text-sm text-[#5c748a]">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                </svg>
                                                <span class="font-semibold">$12,000</span>
                                            </div>
                                        </div>

                                        <!-- Progress Bar -->
                                        <div class="pt-2">
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="text-sm text-[#5c748a]">Progress</span>
                                                <span class="text-sm font-medium text-[#101518]">65%</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-blue-600 h-2 rounded-full" style="width: 65%"></div>
                                            </div>
                                        </div>
                                       
                        
                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                            <button class="flex-1 sm:flex-none px-6 py-3 bg-[#101518] text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                                View Progress
                            </button>
                            <button class="flex-1 sm:flex-none px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-medium">
                                Message Developer
                            </button>
                            <button class="flex-1 sm:flex-none px-6 py-3 border border-[#eaedf1] text-[#5c748a] rounded-xl hover:bg-gray-50 transition-colors font-medium">
                                Request Update
                            </button>
                        </div>
                    </div>
                    
                    <div class="lg:w-80 xl:w-96">
                        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl shadow-md" style='background-image: url("https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80");'></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order 3 -->
        <div class="order-card bg-white rounded-2xl shadow-sm border border-[#eaedf1] overflow-hidden fade-in-up">
            <div class="p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row gap-6">
                    <div class="flex-1 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    🔄 In Review
                                </span>
                                <span class="text-[#5c748a] text-sm">May 15, 2024</span>
                            </div>
                            <p class="text-[#5c748a] text-sm font-mono">#5555444333</p>
                        </div>
                        
                        <div>
                            <h3 class="text-xl lg:text-2xl font-bold text-[#101518] mb-2">Mobile App Development</h3>
                            <p class="text-[#5c748a] leading-relaxed">Cross-platform mobile application with offline capabilities, push notifications, and seamless cloud synchronization for enhanced user experience.</p>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <div class="flex items-center gap-2 text-sm text-[#5c748a]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>12 weeks delivery</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-[#5c748a]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="font-semibold">$15,500</span>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="pt-2">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-[#5c748a]">Progress</span>
                                <span class="text-sm font-medium text-[#101518]">90%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 90%"></div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                            <button class="flex-1 sm:flex-none px-6 py-3 bg-[#101518] text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                                Review Build
                            </button>
                            <button class="flex-1 sm:flex-none px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-colors font-medium">
                                Approve Changes
                            </button>
                            <button class="flex-1 sm:flex-none px-6 py-3 border border-[#eaedf1] text-[#5c748a] rounded-xl hover:bg-gray-50 transition-colors font-medium">
                                Request Revisions
                            </button>
                        </div>
                    </div>
                    
                    <div class="lg:w-80 xl:w-96">
                        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl shadow-md" style='background-image: url("https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80");'></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order 4 -->
        <div class="order-card bg-white rounded-2xl shadow-sm border border-[#eaedf1] overflow-hidden fade-in-up">
            <div class="p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row gap-6">
                    <div class="flex-1 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    ⏸️ On Hold
                                </span>
                                <span class="text-[#5c748a] text-sm">April 8, 2024</span>
                            </div>
                            <p class="text-[#5c748a] text-sm font-mono">#2222111000</p>
                        </div>
                        
                        <div>
                            <h3 class="text-xl lg:text-2xl font-bold text-[#101518] mb-2">AI Chatbot Integration</h3>
                            <p class="text-[#5c748a] leading-relaxed">Intelligent conversational AI system with natural language processing, multi-language support, and seamless integration with existing customer service workflows.</p>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <div class="flex items-center gap-2 text-sm text-[#5c748a]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>4 weeks delivery</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-[#5c748a]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="font-semibold">$6,800</span>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="pt-2">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-[#5c748a]">Progress</span>
                                <span class="text-sm font-medium text-[#101518]">25%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: 25%"></div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                            <button class="flex-1 sm:flex-none px-6 py-3 bg-[#101518] text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                                Resume Project
                            </button>
                            <button class="flex-1 sm:flex-none px-6 py-3 bg-orange-600 text-white rounded-xl hover:bg-orange-700 transition-colors font-medium">
                                Discuss Issues
                            </button>
                            <button class="flex-1 sm:flex-none px-6 py-3 border border-[#eaedf1] text-[#5c748a] rounded-xl hover:bg-gray-50 transition-colors font-medium">
                                Cancel Order
                            </button>
                        </div>
                    </div>
                    
                    <div class="lg:w-80 xl:w-96">
                        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl shadow-md" style='background-image: url("https://images.unsplash.com/photo-1677442136019-21780ecad995?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80");'></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order 5 -->
        <div class="order-card bg-white rounded-2xl shadow-sm border border-[#eaedf1] overflow-hidden fade-in-up">
            <div class="p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row gap-6">
                    <div class="flex-1 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="status-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    ✓ Completed
                                </span>
                                <span class="text-[#5c748a] text-sm">March 2, 2024</span>
                            </div>
                            <p class="text-[#5c748a] text-sm font-mono">#7777888999</p>
                        </div>
                        
                        <div>
                            <h3 class="text-xl lg:text-2xl font-bold text-[#101518] mb-2">Website Redesign</h3>
                            <p class="text-[#5c748a] leading-relaxed">Complete website overhaul with modern UI/UX design, improved performance optimization, SEO enhancements, and responsive mobile-first approach.</p>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <div class="flex items-center gap-2 text-sm text-[#5c748a]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>3 weeks delivery</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-[#5c748a]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="font-semibold">$4,200</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                            <button class="flex-1 sm:flex-none px-6 py-3 bg-[#101518] text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                                View Live Site
                            </button>
                            <button class="flex-1 sm:flex-none px-6 py-3 bg-[#eaedf1] text-[#101518] rounded-xl hover:bg-gray-200 transition-colors font-medium">
                                Download Assets
                            </button>
                            <button class="flex-1 sm:flex-none px-6 py-3 border border-[#eaedf1] text-[#5c748a] rounded-xl hover:bg-gray-50 transition-colors font-medium">
                                Leave Review
                            </button>
                        </div>
                    </div>
                    
                    <div class="lg:w-80 xl:w-96">
                        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl shadow-md" style='background-image: url("https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80");'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load More Button -->
    <div class="mt-12 text-center fade-in-up">
        <button class="px-8 py-3 bg-white border-2 border-[#eaedf1] text-[#101518] rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all font-medium">
            Load More Orders
        </button>
    </div>
</main>

<!-- Footer -->
<footer class="bg-white border-t border-[#eaedf1] px-4 lg:px-8 py-8 mt-12">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-4">
                <div class="size-8">
                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-[#101518] font-bold text-lg">CodeCraft</h3>
                    <p class="text-[#5c748a] text-sm">Building the future, one project at a time</p>
                </div>
            </div>
            <div class="flex items-center gap-6 text-sm text-[#5c748a]">
                <a href="#" class="hover:text-[#101518] transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-[#101518] transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-[#101518] transition-colors">Support</a>
                <span>© 2024 CodeCraft. All rights reserved.</span>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

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
</script>
</body>
</html>