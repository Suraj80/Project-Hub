<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Space+Grotesk%3Awght%40400%3B500%3B700"
    />

    <title>Shopping Cart - Project Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
      .quantity-input {
        -moz-appearance: textfield;
      }
      .quantity-input::-webkit-outer-spin-button,
      .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
      .fade-in {
        animation: fadeIn 0.3s ease-in-out;
      }
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
      }
    </style>
  </head>
  <body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <!-- Logo and Navigation -->
          <div class="flex items-center space-x-8">
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 text-[#101518]">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_6_319)">
                    <path
                      d="M8.57829 8.57829C5.52816 11.6284 3.451 15.5145 2.60947 19.7452C1.76794 23.9758 2.19984 28.361 3.85056 32.3462C5.50128 36.3314 8.29667 39.7376 11.8832 42.134C15.4698 44.5305 19.6865 45.8096 24 45.8096C28.3135 45.8096 32.5302 44.5305 36.1168 42.134C39.7033 39.7375 42.4987 36.3314 44.1494 32.3462C45.8002 28.361 46.2321 23.9758 45.3905 19.7452C44.549 15.5145 42.4718 11.6284 39.4217 8.57829L24 24L8.57829 8.57829Z"
                      fill="currentColor"
                    ></path>
                  </g>
                  <defs>
                    <clipPath id="clip0_6_319"><rect width="48" height="48" fill="white"></rect></clipPath>
                  </defs>
                </svg>
              </div>
              <h1 class="text-xl font-bold text-[#101518] tracking-tight">CodeCraft</h1>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8">
              <a href="#" class="text-[#101518] hover:text-[#007bff] transition-colors text-sm font-medium">Home</a>
              <a href="#" class="text-[#101518] hover:text-[#007bff] transition-colors text-sm font-medium">Projects</a>
              <a href="#" class="text-[#101518] hover:text-[#007bff] transition-colors text-sm font-medium">About Us</a>
              <a href="#" class="text-[#101518] hover:text-[#007bff] transition-colors text-sm font-medium">Contact</a>
            </nav>
          </div>
          
          <!-- Right Side -->
          <div class="flex items-center space-x-4">
            <!-- Search - Hidden on mobile -->
            <div class="hidden sm:block">
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-[#5c748a]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </div>
                <input type="text" placeholder="Search projects..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-[#5c748a] focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#007bff] focus:border-[#007bff] text-sm">
              </div>
            </div>
            
            <!-- Cart Button -->
            <button class="relative bg-[#007bff] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#0056b3] transition-colors">
              <span class="hidden sm:inline">Cart</span>
              <span class="sm:hidden">🛒</span>
              <span class="ml-1">(3)</span>
            </button>
            
            <!-- Profile -->
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#007bff] to-[#0056b3] flex items-center justify-center text-white font-semibold text-sm">
              U
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Breadcrumb -->
      <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="#" class="text-[#5c748a] hover:text-[#007bff] text-sm">Home</a>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="w-4 h-4 text-[#5c748a] mx-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
              </svg>
              <span class="text-[#101518] text-sm font-medium">Shopping Cart</span>
            </div>
          </li>
        </ol>
      </nav>

      <!-- Page Title -->
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-[#101518] tracking-tight">Shopping Cart</h2>
        <span class="text-[#5c748a] text-sm">3 items</span>
      </div>

      <div class="lg:grid lg:grid-cols-12 lg:gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-8">
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8 lg:mb-0">
            <!-- Desktop Table Header -->
            <div class="hidden md:grid md:grid-cols-12 gap-4 p-6 bg-gray-50 border-b border-gray-200 text-sm font-semibold text-[#5c748a] uppercase tracking-wide">
              <div class="col-span-6">Project</div>
              <div class="col-span-2 text-center">Quantity</div>
              <div class="col-span-2 text-center">Price</div>
              <div class="col-span-2 text-center">Actions</div>
            </div>
            
            <!-- Cart Items -->
            <div class="divide-y divide-gray-200">
              <!-- Item 1 -->
              <div class="p-6 fade-in">
                <!-- Mobile Layout -->
                <div class="md:hidden space-y-4">
                  <div class="flex justify-between items-start">
                    <div class="flex-1">
                      <h3 class="text-lg font-semibold text-[#101518] mb-2">E-commerce Website</h3>
                      <p class="text-[#5c748a] text-sm mb-3">Full-stack web development with modern design</p>
                      <div class="flex items-center space-x-4">
                        <div class="flex items-center border border-gray-300 rounded-lg">
                          <button class="p-2 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                          </button>
                          <input type="number" value="1" min="1" class="w-16 text-center border-0 focus:ring-0 quantity-input text-sm">
                          <button class="p-2 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                          </button>
                        </div>
                        <span class="text-xl font-bold text-[#101518]">$150</span>
                      </div>
                    </div>
                    <button class="ml-4 p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Desktop Layout -->
                <div class="hidden md:grid md:grid-cols-12 gap-4 items-center">
                  <div class="col-span-6">
                    <div class="flex items-center space-x-4">
                      <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#007bff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                      </div>
                      <div>
                        <h3 class="text-lg font-semibold text-[#101518]">E-commerce Website</h3>
                        <p class="text-[#5c748a] text-sm">Full-stack web development</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-2 text-center">
                    <div class="flex items-center justify-center">
                      <div class="flex items-center border border-gray-300 rounded-lg">
                        <button class="p-2 hover:bg-gray-50 transition-colors">
                          <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                          </svg>
                        </button>
                        <input type="number" value="1" min="1" class="w-16 text-center border-0 focus:ring-0 quantity-input text-sm">
                        <button class="p-2 hover:bg-gray-50 transition-colors">
                          <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-2 text-center">
                    <span class="text-xl font-bold text-[#101518]">$150</span>
                  </div>
                  <div class="col-span-2 text-center">
                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                      Remove
                    </button>
                  </div>
                </div>
              </div>

              <!-- Item 2 -->
              <div class="p-6 fade-in">
                <!-- Mobile Layout -->
                <div class="md:hidden space-y-4">
                  <div class="flex justify-between items-start">
                    <div class="flex-1">
                      <h3 class="text-lg font-semibold text-[#101518] mb-2">Data Analysis Tool</h3>
                      <p class="text-[#5c748a] text-sm mb-3">Python-based analytics dashboard</p>
                      <div class="flex items-center space-x-4">
                        <div class="flex items-center border border-gray-300 rounded-lg">
                          <button class="p-2 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                          </button>
                          <input type="number" value="2" min="1" class="w-16 text-center border-0 focus:ring-0 quantity-input text-sm">
                          <button class="p-2 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                          </button>
                        </div>
                        <span class="text-xl font-bold text-[#101518]">$400</span>
                      </div>
                    </div>
                    <button class="ml-4 p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Desktop Layout -->
                <div class="hidden md:grid md:grid-cols-12 gap-4 items-center">
                  <div class="col-span-6">
                    <div class="flex items-center space-x-4">
                      <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                      </div>
                      <div>
                        <h3 class="text-lg font-semibold text-[#101518]">Data Analysis Tool</h3>
                        <p class="text-[#5c748a] text-sm">Python-based analytics dashboard</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-2 text-center">
                    <div class="flex items-center justify-center">
                      <div class="flex items-center border border-gray-300 rounded-lg">
                        <button class="p-2 hover:bg-gray-50 transition-colors">
                          <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                          </svg>
                        </button>
                        <input type="number" value="2" min="1" class="w-16 text-center border-0 focus:ring-0 quantity-input text-sm">
                        <button class="p-2 hover:bg-gray-50 transition-colors">
                          <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-2 text-center">
                    <span class="text-xl font-bold text-[#101518]">$400</span>
                    <div class="text-xs text-[#5c748a]">$200 each</div>
                  </div>
                  <div class="col-span-2 text-center">
                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                      Remove
                    </button>
                  </div>
                </div>
              </div>

              <!-- Item 3 -->
              <div class="p-6 fade-in">
                <!-- Mobile Layout -->
                <div class="md:hidden space-y-4">
                  <div class="flex justify-between items-start">
                    <div class="flex-1">
                      <h3 class="text-lg font-semibold text-[#101518] mb-2">Mobile App for Task Management</h3>
                      <p class="text-[#5c748a] text-sm mb-3">React Native cross-platform app</p>
                      <div class="flex items-center space-x-4">
                        <div class="flex items-center border border-gray-300 rounded-lg">
                          <button class="p-2 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                          </button>
                          <input type="number" value="1" min="1" class="w-16 text-center border-0 focus:ring-0 quantity-input text-sm">
                          <button class="p-2 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                          </button>
                        </div>
                        <span class="text-xl font-bold text-[#101518]">$250</span>
                      </div>
                    </div>
                    <button class="ml-4 p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Desktop Layout -->
                <div class="hidden md:grid md:grid-cols-12 gap-4 items-center">
                  <div class="col-span-6">
                    <div class="flex items-center space-x-4">
                      <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                      </div>
                      <div>
                        <h3 class="text-lg font-semibold text-[#101518]">Mobile App for Task Management</h3>
                        <p class="text-[#5c748a] text-sm">React Native cross-platform app</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-2 text-center">
                    <div class="flex items-center justify-center">
                      <div class="flex items-center border border-gray-300 rounded-lg">
                        <button class="p-2 hover:bg-gray-50 transition-colors">
                          <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                          </svg>
                        </button>
                        <input type="number" value="1" min="1" class="w-16 text-center border-0 focus:ring-0 quantity-input text-sm">
                        <button class="p-2 hover:bg-gray-50 transition-colors">
                          <svg class="w-4 h-4 text-[#5c748a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-2 text-center">
                    <span class="text-xl font-bold text-[#101518]">$250</span>
                  </div>
                  <div class="col-span-2 text-center">
                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                      Remove
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-4">
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24">
            <h3 class="text-xl font-bold text-[#101518] mb-6">Order Summary</h3>
            
            <div class="space-y-4">
              <div class="flex justify-between items-center py-2">
                <span class="text-[#5c748a]">Subtotal (4 items)</span>
                <span class="text-[#101518] font-semibold">$800</span>
              </div>
              
              <div class="flex justify-between items-center py-2">
                <span class="text-[#5c748a]">Shipping</span>
                <span class="text-green-600 font-semibold">Free</span>
              </div>
              
              <div class="flex justify-between items-center py-2">
                <span class="text-[#5c748a]">Tax</span>
                <span class="text-[#101518] font-semibold">$64.00</span>
              </div>
              
              <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between items-center">
                  <span class="text-lg font-bold text-[#101518]">Total</span>
                  <span class="text-2xl font-bold text-[#101518]">$864.00</span>
                </div>
              </div>
            </div>
            
            <!-- Promo Code -->
            <div class="mt-6 pt-6 border-t border-gray-200">
              <div class="flex space-x-2">
                <input type="text" placeholder="Promo code" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-[#007bff] focus:border-[#007bff]">
                <button class="px-4 py-2 bg-gray-100 text-[#5c748a] rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
                  Apply
                </button>
              </div>
            </div>
            
            <!-- Checkout Button -->
            <button class="w-full mt-6 bg-[#007bff] text-white py-3 px-4 rounded-lg font-semibold hover:bg-[#0056b3] transition-colors text-center">
              Proceed to Checkout
            </button>
            
            <!-- Continue Shopping -->
            <div class="mt-4 text-center">
              <a href="#" class="text-[#007bff] hover:text-[#0056b3] text-sm font-medium">
                ← Continue Shopping
              </a>
            </div>
            
            <!-- Security Notice -->
            <div class="mt-6 pt-6 border-t border-gray-200">
              <div class="flex items-center space-x-2 text-sm text-[#5c748a]">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <span>Secure checkout with SSL encryption</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recommended Products -->
      <div class="mt-12">
        <h3 class="text-2xl font-bold text-[#101518] mb-6">You might also like</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Recommended Item 1 -->
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
            <div class="p-6">
              <div class="w-12 h-12 bg-gradient-to-br from-orange-100 to-orange-200 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
              </div>
              <h4 class="text-lg font-semibold text-[#101518] mb-2">AI Chatbot Integration</h4>
              <p class="text-[#5c748a] text-sm mb-4">Smart customer service automation</p>
              <div class="flex items-center justify-between">
                <span class="text-xl font-bold text-[#101518]">$180</span>
                <button class="bg-[#007bff] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#0056b3] transition-colors">
                  Add to Cart
                </button>
              </div>
            </div>
          </div>

          <!-- Recommended Item 2 -->
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
            <div class="p-6">
              <div class="w-12 h-12 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <h4 class="text-lg font-semibold text-[#101518] mb-2">Performance Optimization</h4>
              <p class="text-[#5c748a] text-sm mb-4">Speed up your existing applications</p>
              <div class="flex items-center justify-between">
                <span class="text-xl font-bold text-[#101518]">$120</span>
                <button class="bg-[#007bff] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#0056b3] transition-colors">
                  Add to Cart
                </button>
              </div>
            </div>
          </div>

          <!-- Recommended Item 3 -->
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
            <div class="p-6">
              <div class="w-12 h-12 bg-gradient-to-br from-teal-100 to-teal-200 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
              </div>
              <h4 class="text-lg font-semibold text-[#101518] mb-2">Security Audit</h4>
              <p class="text-[#5c748a] text-sm mb-4">Comprehensive security assessment</p>
              <div class="flex items-center justify-between">
                <span class="text-xl font-bold text-[#101518]">$300</span>
                <button class="bg-[#007bff] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#0056b3] transition-colors">
                  Add to Cart
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#101518] text-white mt-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div class="md:col-span-2">
            <div class="flex items-center space-x-3 mb-4">
              <div class="w-6 h-6 text-white">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_6_319)">
                    <path
                      d="M8.57829 8.57829C5.52816 11.6284 3.451 15.5145 2.60947 19.7452C1.76794 23.9758 2.19984 28.361 3.85056 32.3462C5.50128 36.3314 8.29667 39.7376 11.8832 42.134C15.4698 44.5305 19.6865 45.8096 24 45.8096C28.3135 45.8096 32.5302 44.5305 36.1168 42.134C39.7033 39.7375 42.4987 36.3314 44.1494 32.3462C45.8002 28.361 46.2321 23.9758 45.3905 19.7452C44.549 15.5145 42.4718 11.6284 39.4217 8.57829L24 24L8.57829 8.57829Z"
                      fill="currentColor"
                    ></path>
                  </g>
                  <defs>
                    <clipPath id="clip0_6_319"><rect width="48" height="48" fill="white"></rect></clipPath>
                  </defs>
                </svg>
              </div>
              <h2 class="text-xl font-bold">CodeCraft</h2>
            </div>
            <p class="text-gray-400 mb-4">Building innovative solutions for the digital world. Quality code, modern design, and exceptional user experiences.</p>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.026.394 2.127.889 2.726a.36.36 0 01.083.343c-.091.378-.293 1.169-.334 1.334-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z" clip-rule="evenodd"/>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </a>
            </div>
          </div>
          
          <div>
            <h3 class="text-lg font-semibold mb-4">Services</h3>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white transition-colors">Web Development</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Mobile Apps</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Data Analysis</a></li>
              <li><a href="#" class="hover:text-white transition-colors">AI Solutions</a></li>
            </ul>
          </div>
          
          <div>
            <h3 class="text-lg font-semibold mb-4">Support</h3>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
            </ul>
          </div>
        </div>
        
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
          <p>&copy; 2024 CodeCraft. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <script>
      // Quantity controls
      document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        
        quantityInputs.forEach(input => {
          const minusBtn = input.previousElementSibling;
          const plusBtn = input.nextElementSibling;
          
          minusBtn.addEventListener('click', function() {
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
              input.value = currentValue - 1;
              updateTotals();
            }
          });
          
          plusBtn.addEventListener('click', function() {
            const currentValue = parseInt(input.value);
            input.value = currentValue + 1;
            updateTotals();
          });
          
          input.addEventListener('change', function() {
            if (parseInt(input.value) < 1) {
              input.value = 1;
            }
            updateTotals();
          });
        });
        
        // Remove item functionality
        const removeButtons = document.querySelectorAll('button[class*="text-red"]');
        removeButtons.forEach(button => {
          button.addEventListener('click', function() {
            const item = button.closest('.p-6');
            item.style.opacity = '0';
            item.style.transform = 'translateX(-100%)';
            setTimeout(() => {
              item.remove();
              updateTotals();
            }, 300);
          });
        });
        
        function updateTotals() {
          // This would typically calculate totals based on current quantities
          console.log('Updating totals...');
        }
      });
    </script>
  </body>
</html>