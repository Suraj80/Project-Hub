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
    <title>My Wishlist - CodeCraft</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
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
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }
        
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }
        
        .wishlist-card {
            transition: all 0.3s ease;
        }
        
        .wishlist-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-danger {
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            background-color: #ef4444;
            transform: scale(1.05);
        }
        
        @media (max-width: 768px) {
            .mobile-nav {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .mobile-nav.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="relative flex size-full min-h-screen flex-col bg-gradient-to-br from-gray-50 to-white group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        <div class="layout-container flex h-full grow flex-col">
            <!-- Enhanced Header -->
            <header class="glass-effect sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f2f5] px-4 lg:px-10 py-4 shadow-sm">
                <div class="flex items-center gap-4 lg:gap-8">
                    <div class="flex items-center gap-4 text-[#111418]">
                        <div class="size-4 lg:size-6">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z"
                                    fill="currentColor"
                                ></path>
                            </svg>
                        </div>
                        <h2 class="text-[#111418] text-lg lg:text-xl font-bold leading-tight tracking-[-0.015em]">CodeCraft</h2>
                    </div>
                    
                    <!-- Desktop Navigation -->
                    <div class="hidden lg:flex items-center gap-9">
                        <a class="text-[#111418] text-sm font-medium leading-normal hover:text-gray-600 transition-colors" href="#">Home</a>
                        <a class="text-[#111418] text-sm font-medium leading-normal hover:text-gray-600 transition-colors" href="#">Projects</a>
                        <a class="text-[#111418] text-sm font-medium leading-normal hover:text-gray-600 transition-colors" href="#">About</a>
                        <a class="text-[#111418] text-sm font-medium leading-normal hover:text-gray-600 transition-colors" href="#">Contact</a>
                    </div>
                </div>
                
                <div class="flex flex-1 justify-end gap-4">
                    <!-- Search Bar - Hidden on mobile -->
                    <div class="hidden md:block">
                        <label class="flex flex-col min-w-40 !h-10 max-w-64">
                            <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                                <div class="text-[#60758a] flex border-none bg-[#f0f2f5] items-center justify-center pl-4 rounded-l-xl border-r-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                                    </svg>
                                </div>
                                <input
                                    placeholder="Search projects..."
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111418] focus:outline-0 focus:ring-0 border-none bg-[#f0f2f5] focus:border-none h-full placeholder:text-[#60758a] px-4 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal"
                                />
                            </div>
                        </label>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <button class="flex items-center justify-center rounded-full h-10 w-10 bg-[#f0f2f5] text-[#111418] hover:bg-gray-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                            </svg>
                        </button>
                        
                        <button class="md:hidden flex items-center justify-center rounded-full h-10 w-10 bg-[#f0f2f5] text-[#111418] hover:bg-gray-200 transition-colors" onclick="toggleMobileMenu()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"></path>
                            </svg>
                        </button>
                        
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBE3IaRDksNwbaNKqrh56-Q9WefC9GboHd029cOA3sWX93X_66pYQGn_quhcEcxNpa7xYI5sGey-6g6uZGrFxfOsY6JzNzOmczIJFv-uomMrKnKD2SiI6Jp_14-1Qg9_BmBh4Vc3gdTBpmUFqjjqhUGmujZg0X6Co60fJ29ov-skhO6b7GlwcrNfAA2bi8nIfNeyLVbh0wsODt4LlQmPjaTC0FQ1lu6s5jGunSzY8o4qozP7Ms6FithGmNIo28YUin-l8GugCtOtlAa");'></div>
                    </div>
                </div>
            </header>

            <!-- Mobile Navigation Menu -->
            <div id="mobileMenu" class="mobile-nav fixed top-0 left-0 h-full w-64 bg-white shadow-lg z-40 md:hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-lg font-bold text-[#111418]">Menu</h3>
                        <button onclick="toggleMobileMenu()" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path>
                            </svg>
                        </button>
                    </div>
                    <nav class="space-y-4">
                        <a href="#" class="block text-[#111418] text-sm font-medium py-2 hover:text-gray-600 transition-colors">Home</a>
                        <a href="#" class="block text-[#111418] text-sm font-medium py-2 hover:text-gray-600 transition-colors">Projects</a>
                        <a href="#" class="block text-[#111418] text-sm font-medium py-2 hover:text-gray-600 transition-colors">About</a>
                        <a href="#" class="block text-[#111418] text-sm font-medium py-2 hover:text-gray-600 transition-colors">Contact</a>
                    </nav>
                    
                    <!-- Mobile Search -->
                    <div class="mt-6">
                        <input
                            placeholder="Search projects..."
                            class="w-full px-4 py-2 rounded-lg bg-[#f0f2f5] text-[#111418] placeholder:text-[#60758a] border-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-1 px-4 lg:px-10 py-6 lg:py-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Page Header -->
                    <div class="mb-8 animate-fade-in-up">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h1 class="text-2xl lg:text-3xl font-bold text-[#111418] tracking-tight">My Wishlist</h1>
                                <p class="text-[#60758a] text-sm lg:text-base mt-1">Discover and save your favorite coding projects</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-[#60758a]">4 projects saved</span>
                                <button class="btn-primary text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path>
                                    </svg>
                                    Add Project
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Project Card 1 -->
                        <div class="wishlist-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-in" style="animation-delay: 0.1s">
                            <div class="aspect-video bg-gradient-to-br from-purple-400 to-blue-500 relative overflow-hidden">
                                <div class="absolute inset-0 bg-center bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDXGMNcyilqs-G51NwKAcudNKLgX4Kamvsk43nwMDlpQTGKjbk1XqeVMC63qvSP4gV-uks6J_qLym9K1uECQV1EL3dbONL1aw-MqP__BTSMyDpL4Hsmpr6rVe3xKENj15NiqCttmlOnph5EDX9cJUoM0dcOnUQVRnjO-8o9BpgKy0lZNXIg2WP_OPe8QhOvk8RSFBz3DEh32keafQ4vwg4gFRm_vwkVa2Ekx4D--ab2ftaEe7V3dZp61SGkta34O3-d4ZQVI7NaYnSl");'></div>
                                <div class="absolute top-4 right-4">
                                    <button class="btn-danger bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-lg" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-lg font-bold text-[#111418] leading-tight">E-commerce Platform</h3>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">Advanced</span>
                                </div>
                                <p class="text-[#60758a] text-sm leading-relaxed mb-4">
                                    A full-featured e-commerce platform with user authentication, product catalog, shopping cart, and payment gateway integration.
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-xs text-[#60758a]">
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                            </svg>
                                            2-3 weeks
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                                            </svg>
                                            234 likes
                                        </span>
                                    </div>
                                    <button class="btn-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:shadow-lg transition-all">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Project Card 2 -->
                        <div class="wishlist-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-in" style="animation-delay: 0.2s">
                            <div class="aspect-video bg-gradient-to-br from-pink-400 to-purple-500 relative overflow-hidden">
                                <div class="absolute inset-0 bg-center bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB7aDdbdB2OAuu7R4MzXByCXtTkX1dU9eH7clRbKVZih82vA_P8a2_jmFNqb7jTXGPKkQDiDGtObDX4vopP86I8AlFBxUXKM_mDcyFcBgeaElpeT7MeM7OIMlTAoc4dNRDKubOcuw-3BI18y-n4uWpjOoU8tu7YjJSQ_bzbAw0XR6WtIuosTcgyp40iXLX30lOa2vA4uhBDeoUF1cQ_Pw1Vuekf9ABJ_v5vSl0SXoSBwm71hC_tvCgAOGn6zInqbo4jv3omNbuMDrjr");'></div>
                                <div class="absolute top-4 right-4">
                                    <button class="btn-danger bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-lg" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-lg font-bold text-[#111418] leading-tight">Social Media Dashboard</h3>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">Intermediate</span>
                                </div>
                                <p class="text-[#60758a] text-sm leading-relaxed mb-4">
                                    A dashboard to manage multiple social media accounts, schedule posts, and analyze engagement metrics.
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-xs text-[#60758a]">
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                            </svg>
                                            1-2 weeks
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                                            </svg>
                                            189 likes
                                        </span>
                                    </div>
                                    <button class="btn-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:shadow-lg transition-all">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Project Card 3 -->
                        <div class="wishlist-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-in" style="animation-delay: 0.3s">
                            <div class="aspect-video bg-gradient-to-br from-yellow-400 to-orange-500 relative overflow-hidden">
                                <div class="absolute inset-0 bg-center bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD1zeh2rV_vANXeEXPk9VrnAZVu3fTqHa0LpkpscnbC0S3HrkPye92qTojQaBYFSnZTqSa3MvaIjYRLKyrbENemKjpgsdZYH322q_6YY-dvzTPZ5ChtwSZq51Jf5yTHC9wR8vFxH8Tk2X6cXJpLAl4pL7j4UuO_1LdQfTJcE6HvqVTEKVzjXrXLjQ");'></div>
                                <div class="absolute top-4 right-4">
                                    <button class="btn-danger bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-lg" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-lg font-bold text-[#111418] leading-tight">Task Management App</h3>
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">Beginner</span>
                                </div>
                                <p class="text-[#60758a] text-sm leading-relaxed mb-4">
                                    A simple yet powerful task management application with drag-and-drop functionality, deadlines, and team collaboration features.
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-xs text-[#60758a]">
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                            </svg>
                                            3-5 days
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                                            </svg>
                                            156 likes
                                        </span>
                                    </div>
                                    <button class="btn-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:shadow-lg transition-all">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Project Card 4 -->
                        <div class="wishlist-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-in" style="animation-delay: 0.4s">
                            <div class="aspect-video bg-gradient-to-br from-green-400 to-teal-500 relative overflow-hidden">
                                <div class="absolute inset-0 bg-center bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCjH8xn9sZO3X-1vNW4zI-h0wVOC6F2kNJvQ1bJgPq7uVrKzJ-MlYcR8TpF5xWqAeD3gBhC9LmRvEsGtP4kJiNfOpXzY1wUaS2dCeGvH7Mn6KzQ0bRtL3jVpI9xE8oF");'></div>
                                <div class="absolute top-4 right-4">
                                    <button class="btn-danger bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-lg" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-lg font-bold text-[#111418] leading-tight">Weather Forecast App</h3>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">Beginner</span>
                                </div>
                                <p class="text-[#60758a] text-sm leading-relaxed mb-4">
                                    A beautiful weather application with real-time data, 7-day forecasts, and location-based weather updates.
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 text-xs text-[#60758a]">
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                            </svg>
                                            1-2 days
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                                            </svg>
                                            92 likes
                                        </span>
                                    </div>
                                    <button class="btn-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:shadow-lg transition-all">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State (Hidden when projects exist) -->
                    <div id="emptyState" class="hidden text-center py-12">
                        <div class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64px" height="64px" fill="currentColor" viewBox="0 0 256 256" class="mx-auto text-gray-300">
                                <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-[#111418] mb-2">Your wishlist is empty</h3>
                        <p class="text-[#60758a] mb-4">Start adding projects you'd like to work on!</p>
                        <button class="btn-primary text-white px-6 py-3 rounded-lg text-sm font-medium">
                            Browse Projects
                        </button>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-100 mt-12">
                <div class="max-w-7xl mx-auto px-4 lg:px-10 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="size-6">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z"
                                            fill="currentColor"
                                        ></path>
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z"
                                            fill="currentColor"
                                        ></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-[#111418]">CodeCraft</h3>
                            </div>
                            <p class="text-[#60758a] text-sm leading-relaxed max-w-md">
                                Discover, save, and build amazing coding projects. From beginner to advanced, find your next challenge.
                            </p>
                        </div>
                        
                        <div>
                            <h4 class="font-medium text-[#111418] mb-3">Platform</h4>
                            <div class="space-y-2">
                                <a href="#" class="block text-sm text-[#60758a] hover:text-[#111418] transition-colors">Browse Projects</a>
                                <a href="#" class="block text-sm text-[#60758a] hover:text-[#111418] transition-colors">Submit Project</a>
                                <a href="#" class="block text-sm text-[#60758a] hover:text-[#111418] transition-colors">Community</a>
                                <a href="#" class="block text-sm text-[#60758a] hover:text-[#111418] transition-colors">Blog</a>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="font-medium text-[#111418] mb-3">Support</h4>
                            <div class="space-y-2">
                                <a href="#" class="block text-sm text-[#60758a] hover:text-[#111418] transition-colors">Help Center</a>
                                <a href="#" class="block text-sm text-[#60758a] hover:text-[#111418] transition-colors">Contact Us</a>
                                <a href="#" class="block text-sm text-[#60758a] hover:text-[#111418] transition-colors">Privacy Policy</a>
                                <a href="#" class="block text-sm text-[#60758a] hover:text-[#111418] transition-colors">Terms of Service</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-100 mt-8 pt-6 flex flex-col sm:flex-row justify-between items-center">
                        <p class="text-sm text-[#60758a]">© 2024 CodeCraft. All rights reserved.</p>
                        <div class="flex items-center gap-4 mt-4 sm:mt-0">
                            <a href="#" class="text-[#60758a] hover:text-[#111418] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160ZM176,24H80A56.06,56.06,0,0,0,24,80v96a56.06,56.06,0,0,0,56,56h96a56.06,56.06,0,0,0,56-56V80A56.06,56.06,0,0,0,176,24Zm40,152a40,40,0,0,1-40,40H80a40,40,0,0,1-40-40V80A40,40,0,0,1,80,40h96a40,40,0,0,1,40,40ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-[#60758a] hover:text-[#111418] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M245.66,77.66l-29.9,29.9C209.72,177.58,150.67,232,80,232c-14.52,0-26.49-2.3-35.58-6.84-7.33-3.67-10.33-7.6-11.08-8.72a8,8,0,0,1,3.85-11.93c.26-.1,24.24-9.31,39.47-26.84a110.93,110.93,0,0,1-21.88-24.2c-12.4-18.41-26.28-50.39-22-98.18a8,8,0,0,1,13.65-4.92c.35.35,33.28,33.1,73.54,43.72V88a47.87,47.87,0,0,1,14.36-34.3A46.87,46.87,0,0,1,168.1,40a48.66,48.66,0,0,1,41.47,24H240a8,8,0,0,1,5.66,13.66Z"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-[#60758a] hover:text-[#111418] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM96,176a8,8,0,0,1-16,0V112a8,8,0,0,1,16,0ZM88,96a12,12,0,1,1,12-12A12,12,0,0,1,88,96Zm96,80a8,8,0,0,1-16,0V140a20,20,0,0,0-40,0v36a8,8,0,0,1-16,0V112a8,8,0,0,1,15.79-1.78A36,36,0,0,1,184,140Z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden" onclick="toggleMobileMenu()"></div>

    <script>
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

        // Add smooth scrolling for better UX
        document.addEventListener('DOMContentLoaded', function() {
            // Add entrance animations
            const cards = document.querySelectorAll('.wishlist-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${(index + 1) * 0.1}s`;
            });
        });

        // Add loading states for buttons
        document.addEventListener('click', function(e) {
            if (e.target.matches('.btn-primary')) {
                const button = e.target;
                const originalText = button.textContent;
                
                button.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading...
                `;
                
                setTimeout(() => {
                    button.textContent = originalText;
                }, 1500);
            }
        });
    </script>
</body>
</html>