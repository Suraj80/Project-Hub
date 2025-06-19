<?php
session_start();

?>

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
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.1), 0 6px 8px -3px rgba(0, 0, 0, 0.04);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
        }
        
        .btn-danger {
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            background-color: #ef4444;
            transform: scale(1.05);
        }
        
        .card-image {
            height: 140px;
            background-size: cover;
            background-position: center;
        }
        
        @media (max-width: 768px) {
            .mobile-nav {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .mobile-nav.open {
                transform: translateX(0);
            }
            
            .card-image {
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="relative flex size-full min-h-screen flex-col bg-gradient-to-br from-gray-50 to-white group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        <div class="layout-container flex h-full grow flex-col">
            <!-- Enhanced Header -->
            <?php include 'header2.php'; ?>

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

                    <!-- Optimized Wishlist Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        <!-- Project Card 1 -->
                        <div class="wishlist-card bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden animate-slide-in" style="animation-delay: 0.1s">
                            <div class="card-image bg-gradient-to-br from-purple-400 to-blue-500 relative overflow-hidden" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDXGMNcyilqs-G51NwKAcudNKLgX4Kamvsk43nwMDlpQTGKjbk1XqeVMC63qvSP4gV-uks6J_qLym9K1uECQV1EL3dbONL1aw-MqP__BTSMyDpL4Hsmpr6rVe3xKENj15NiqCttmlOnph5EDX9cJUoM0dcOnUQVRnjO-8o9BpgKy0lZNXIg2WP_OPe8QhOvk8RSFBz3DEh32keafQ4vwg4gFRm_vwkVa2Ekx4D--ab2ftaEe7V3dZp61SGkta34O3-d4ZQVI7NaYnSl");'>
                                <div class="absolute top-3 right-3">
                                    <button class="btn-danger bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-full shadow-lg" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-3 left-3">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">Advanced</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="mb-2">
                                    <h3 class="text-sm font-bold text-[#111418] leading-tight line-clamp-1">E-commerce Platform</h3>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-lg font-bold text-[#667eea]">$149</span>
                                        <div class="flex items-center gap-1 text-xs text-[#60758a]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                            </svg>
                                            2-3 weeks
                                        </div>
                                    </div>
                                </div>
                                <p class="text-[#60758a] text-xs leading-relaxed mb-3 line-clamp-2">
                                    Full-featured e-commerce platform with user authentication, product catalog, shopping cart, and payment gateway integration.
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1 text-xs text-[#60758a]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                                        </svg>
                                        234
                                    </div>
                                    <button class="btn-primary text-white px-3 py-1.5 rounded-md text-xs font-medium hover:shadow-lg transition-all">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Project Card 2 -->
                        <div class="wishlist-card bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden animate-slide-in" style="animation-delay: 0.2s">
                            <div class="card-image bg-gradient-to-br from-pink-400 to-purple-500 relative overflow-hidden" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB7aDdbdB2OAuu7R4MzXByCXtTkX1dU9eH7clRbKVZih82vA_P8a2_jmFNqb7jTXGPKkQDiDGtObDX4vopP86I8AlFBxUXKM_mDcyFcBgeaElpeT7MeM7OIMlTAoc4dNRDKubOcuw-3BI18y-n4uWpjOoU8tu7YjJSQ_bzbAw0XR6WtIuosTcgyp40iXLX30lOa2vA4uhBDeoUF1cQ_Pw1Vuekf9ABJ_v5vSl0SXoSBwm71hC_tvCgAOGn6zInqbo4jv3omNbuMDrjr");'>
                                <div class="absolute top-3 right-3">
                                    <button class="btn-danger bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-full shadow-lg" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-3 left-3">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">Intermediate</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="mb-2">
                                    <h3 class="text-sm font-bold text-[#111418] leading-tight line-clamp-1">Social Media Dashboard</h3>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-lg font-bold text-[#667eea]">$89</span>
                                        <div class="flex items-center gap-1 text-xs text-[#60758a]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                            </svg>
                                            1-2 weeks
                                        </div>
                                    </div>
                                </div>
                                <p class="text-[#60758a] text-xs leading-relaxed mb-3 line-clamp-2">
                                    Dashboard to manage multiple social media accounts, schedule posts, and analyze engagement metrics.
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1 text-xs text-[#60758a]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                                        </svg>
                                        189
                                    </div>
                                    <button class="btn-primary text-white px-3 py-1.5 rounded-md text-xs font-medium hover:shadow-lg transition-all">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Project Card 3 -->
                        <div class="wishlist-card bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden animate-slide-in" style="animation-delay: 0.3s">
                            <div class="card-image bg-gradient-to-br from-yellow-400 to-orange-500 relative overflow-hidden" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCTqK8vN9mF7Lp0nGxYQqFbOzWmH3vZiJ2K1L9A8fGhI3jKl4MnPqRs7TuVwXyZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");'>
                                <div class="absolute top-3 right-3">
                                    <button class="btn-danger bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-full shadow-lg" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-3 left-3">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">Beginner</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="mb-2">
                                    <h3 class="text-sm font-bold text-[#111418] leading-tight line-clamp-1">Task Management App</h3>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-lg font-bold text-[#667eea]">$45</span>
                                        <div class="flex items-center gap-1 text-xs text-[#60758a]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                            </svg>
                                            3-5 days
                                        </div>
                                    </div>
                                </div>
                                <p class="text-[#60758a] text-xs leading-relaxed mb-3 line-clamp-2">
                                    Simple and intuitive task management application with drag-and-drop functionality and progress tracking.
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1 text-xs text-[#60758a]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                                        </svg>
                                        156
                                    </div>
                                    <button class="btn-primary text-white px-3 py-1.5 rounded-md text-xs font-medium hover:shadow-lg transition-all">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Project Card 4 -->
                        <div class="wishlist-card bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden animate-slide-in" style="animation-delay: 0.4s">
                            <div class="card-image bg-gradient-to-br from-green-400 to-teal-500 relative overflow-hidden" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDMrQbV8tWyX3zKpLn5jI2hGfE4cA9bS8dO7mN1qPrT6uVwXyZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_project4");'>
                                <div class="absolute top-3 right-3">
                                    <button class="btn-danger bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-full shadow-lg" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-3 left-3">
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded-full">Expert</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="mb-2">
                                    <h3 class="text-sm font-bold text-[#111418] leading-tight line-clamp-1">AI Chat Bot</h3>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-lg font-bold text-[#667eea]">$199</span>
                                        <div class="flex items-center gap-1 text-xs text-[#60758a]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                            </svg>
                                            3-4 weeks
                                        </div>
                                    </div>
                                </div>
                                <p class="text-[#60758a] text-xs leading-relaxed mb-3 line-clamp-2">
                                    Advanced AI-powered chatbot with natural language processing and machine learning capabilities.
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1 text-xs text-[#60758a]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                                        </svg>
                                        312
                                    </div>
                                    <button class="btn-primary text-white px-3 py-1.5 rounded-md text-xs font-medium hover:shadow-lg transition-all">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State Message (Hidden when items exist) -->
                    <div id="emptyState" class="hidden text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64px" height="64px" fill="currentColor" viewBox="0 0 256 256" class="mx-auto text-gray-300">
                                    <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#111418] mb-2">Your wishlist is empty</h3>
                            <p class="text-[#60758a] mb-6">Start adding projects you love to see them here!</p>
                            <button class="btn-primary text-white px-6 py-2 rounded-lg font-medium">
                                Explore Projects
                            </button>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Enhanced Footer -->
            <footer class="bg-[#111418] text-white py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 lg:px-10">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div>
                            <h4 class="font-bold mb-4">Products</h4>
                            <ul class="space-y-2 text-sm text-gray-300">
                                <li><a href="#" class="hover:text-white transition-colors">Web Development</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Mobile Apps</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Desktop Software</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">API Development</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold mb-4">Resources</h4>
                            <ul class="space-y-2 text-sm text-gray-300">
                                <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Tutorials</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Community</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Support</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold mb-4">Company</h4>
                            <ul class="space-y-2 text-sm text-gray-300">
                                <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Press</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold mb-4">Follow Us</h4>
                            <div class="flex gap-3">
                                <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-300 hover:text-white transition-colors">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-300">
                        <p>&copy; 2024 CodeCraft. All rights reserved. | Privacy Policy | Terms of Service</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden" onclick="toggleMobileMenu()"></div>

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
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.1), 0 6px 8px -3px rgba(0, 0, 0, 0.04);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
        }
        
        .btn-danger {
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            background-color: #ef4444;
            transform: scale(1.05);
        }
        
        .card-image {
            height: 140px;
            background-size: cover;
            background-position: center;
        }
        
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        @media (max-width: 768px) {
            .mobile-nav {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .mobile-nav.open {
                transform: translateX(0);
            }
            
            .card-image {
                height: 120px;
            }
        }
    </style>

    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const overlay = document.getElementById('overlay');
            
            menu.classList.toggle('open');
            overlay.classList.toggle('hidden');
        }

        // Remove from Wishlist
        function removeFromWishlist(button) {
            const card = button.closest('.wishlist-card');
            const projectsGrid = document.querySelector('.grid');
            const emptyState = document.getElementById('emptyState');
            
            // Add fade out animation
            card.style.transition = 'all 0.3s ease';
            card.style.opacity = '0';
            card.style.transform = 'translateY(-10px)';
            
            setTimeout(() => {
                card.remove();
                
                // Check if no cards remain
                const remainingCards = document.querySelectorAll('.wishlist-card');
                if (remainingCards.length === 0) {
                    projectsGrid.classList.add('hidden');
                    emptyState.classList.remove('hidden');
                    // Update header count
                    const countElement = document.querySelector('.flex.items-center.gap-3 span');
                    if (countElement) {
                        countElement.textContent = '0 projects saved';
                    }
                } else {
                    // Update count
                    const countElement = document.querySelector('.flex.items-center.gap-3 span');
                    if (countElement) {
                        countElement.textContent = `${remainingCards.length} projects saved`;
                    }
                }
            }, 300);
        }

        // Add some interactive feedback
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to buttons
            const buttons = document.querySelectorAll('button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.2s ease';
                });
            });
            
            // Add search functionality
            const searchInput = document.querySelector('input[placeholder="Search projects..."]');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const cards = document.querySelectorAll('.wishlist-card');
                    
                    cards.forEach(card => {
                        const title = card.querySelector('h3').textContent.toLowerCase();
                        const description = card.querySelector('p').textContent.toLowerCase();
                        
                        if (title.includes(searchTerm) || description.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>