<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Space+Grotesk%3Awght%40400%3B500%3B700"
    />

    <title>Project Hub - Enhanced</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
      /* Enhanced animations and transitions */
      .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }
      
      .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      }
      
      .profile-dropdown {
        transform: translateY(-10px);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }
      
      .profile-container:hover .profile-dropdown {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
      }
      
      .wishlist-btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }
      
      .wishlist-btn:hover {
        transform: scale(1.1);
      }
      
      .wishlist-btn.active {
        color: #ef4444;
      }
      
      .wishlist-btn:not(.active) {
        color: #9ca3af;
      }
      
      .wishlist-btn:hover svg {
        animation: heartBeat 0.6s ease-in-out;
      }
      
      @keyframes heartBeat {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.2); }
        50% { transform: scale(1.05); }
        75% { transform: scale(1.15); }
      }
      
      @keyframes slideInUp {
        from {
          opacity: 0;
          transform: translateY(30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }
      
      @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
      }
      
      .animate-slide-in {
        animation: slideInUp 0.5s ease-out forwards;
      }
      
      .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
      }
      
      .loading-skeleton {
        animation: pulse 2s infinite;
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
      }
      
      @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
      }
      
      .price-slider {
        position: relative;
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        margin: 20px 0;
      }
      
      .price-slider-track {
        height: 6px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        border-radius: 3px;
        position: absolute;
      }
      
      .price-slider-thumb {
        width: 20px;
        height: 20px;
        background: #6366f1;
        border: 3px solid white;
        border-radius: 50%;
        position: absolute;
        top: -7px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
      }
      
      .price-slider-thumb:hover {
        transform: scale(1.2);
        box-shadow: 0 4px 16px rgba(99, 102, 241, 0.4);
      }
      
      .difficulty-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
      }
      
      .difficulty-beginner {
        background-color: #dcfce7;
        color: #166534;
      }
      
      .difficulty-intermediate {
        background-color: #fef3c7;
        color: #92400e;
      }
      
      .difficulty-advanced {
        background-color: #fee2e2;
        color: #991b1b;
      }
      
      .tech-tag {
        display: inline-flex;
        align-items: center;
        padding: 0.125rem 0.375rem;
        background-color: #f3f4f6;
        color: #374151;
        border-radius: 0.25rem;
        font-size: 0.625rem;
        font-weight: 500;
      }
      
      .rating-stars {
        display: flex;
        gap: 0.125rem;
      }
      
      .star-filled {
        color: #fbbf24;
      }
      
      .star-empty {
        color: #d1d5db;
      }
      
      .add-to-cart-btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
      }
      
      .add-to-cart-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(40, 132, 239, 0.3);
      }
      
      .add-to-cart-btn.success {
        background: linear-gradient(135deg, #10b981, #059669);
      }
      
      .filter-section {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.2);
      }
      
      .no-results {
        animation: fadeIn 0.5s ease-out;
      }
      
      /* Focus styles for accessibility */
      .focus-visible:focus {
        outline: 2px solid #6366f1;
        outline-offset: 2px;
      }
      
      /* Mobile responsive improvements */
      @media (max-width: 768px) {
        .card-hover:hover {
          transform: none;
          box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .mobile-grid {
          grid-template-columns: 1fr;
        }
        
        .mobile-hidden {
          display: none;
        }
        
        .mobile-stack {
          flex-direction: column;
          gap: 0.5rem;
        }
      }
      
      /* High contrast mode support */
      @media (prefers-contrast: high) {
        .card-hover {
          border: 2px solid #000;
        }
        
        .difficulty-badge {
          border: 1px solid currentColor;
        }
      }
      
      /* Reduced motion support */
      @media (prefers-reduced-motion: reduce) {
        * {
          animation-duration: 0.01ms !important;
          animation-iteration-count: 1 !important;
          transition-duration: 0.01ms !important;
        }
      }
    </style>
  </head>
  <body>
    <div
      class="relative flex size-full min-h-screen flex-col bg-gradient-to-br from-gray-50 to-gray-100 group/design-root overflow-x-hidden"
      style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'
    >
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#eaedf1] px-6 md:px-10 py-4 bg-white/80 backdrop-blur-md sticky top-0 z-50">
          <div class="flex items-center gap-4 md:gap-8">
            <div class="flex items-center gap-4 text-[#101518]">
              <div class="size-8 md:size-10">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-indigo-600">
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
              <h1 class="text-[#101518] text-lg md:text-xl font-bold leading-tight tracking-[-0.015em]">Project Hub</h1>
            </div>
            <nav class="hidden md:flex items-center gap-6 lg:gap-9" role="navigation" aria-label="Main navigation">
              <a class="text-[#101518] text-sm font-medium leading-normal hover:text-indigo-600 transition-colors focus-visible:focus" href="#" tabindex="0">Home</a>
              <a class="text-[#101518] text-sm font-medium leading-normal hover:text-indigo-600 transition-colors focus-visible:focus" href="#" tabindex="0">Projects</a>
              <a class="text-[#101518] text-sm font-medium leading-normal hover:text-indigo-600 transition-colors focus-visible:focus" href="#" tabindex="0">About</a>
              <a class="text-[#101518] text-sm font-medium leading-normal hover:text-indigo-600 transition-colors focus-visible:focus" href="#" tabindex="0">Contact</a>
            </nav>
          </div>
          <div class="flex flex-1 justify-end gap-3 md:gap-6">
            <div class="flex min-w-32 md:min-w-40 max-w-64">
              <div class="flex w-full flex-1 items-stretch rounded-xl h-10">
                <button
                  class="text-[#5c748a] flex border-none bg-[#eaedf1] items-center justify-center pl-3 md:pl-4 rounded-l-xl border-r-0 cursor-pointer hover:bg-[#d4dce2] transition-colors focus-visible:focus"
                  onclick="performSearch()"
                  aria-label="Search projects"
                  type="button"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                  </svg>
                </button>
                <input
                  id="searchInput"
                  placeholder="Search projects..."
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#101518] focus:outline-0 focus:ring-2 focus:ring-indigo-500 border-none bg-[#eaedf1] h-full placeholder:text-[#5c748a] px-3 md:px-4 rounded-l-none border-l-0 pl-2 text-sm md:text-base font-normal leading-normal"
                  value=""
                  onkeypress="handleSearchKeypress(event)"
                  aria-label="Search for projects"
                />
              </div>
            </div>
            <button
              class="flex min-w-[70px] md:min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-3 md:px-4 bg-[#eaedf1] text-[#101518] text-xs md:text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#d4dce2] transition-colors focus-visible:focus"
              aria-label="Shopping cart"
              type="button"
            >
              <span class="truncate">Cart (<span id="cartCount">3</span>)</span>
            </button>
            <button
              class="flex min-w-[70px] md:min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-3 md:px-4 bg-[#eaedf1] text-[#101518] text-xs md:text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#d4dce2] transition-colors focus-visible:focus"
              onclick="toggleWishlistView()"
              aria-label="Wishlist"
              type="button"
            >
              <span class="truncate">Wishlist (<span id="wishlistCount">0</span>)</span>
            </button>
            <div class="relative profile-container">
              <button
                class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 cursor-pointer hover:ring-2 hover:ring-indigo-300 transition-all focus-visible:focus"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAg9-aOcXsbMnrMbI3Xp94a9vQE2OZBNVf__4BKAkbLgeycgAPBf6ZondpInLxEWAdmQezLZS66LaYWjJo43CBfxs4jSXtJ4RGkoy77lf_cny2suGQu9UZmA5tor5TqnC42fxSWnNbemr7Kw7iP4h2hEaQr6v9dpCVKWOTCcH-PtQSsLY0Dzr18O9VREHxVZOWPUm0p35rQs1tOpqN3qNTg2TCgAl_N_OHQLJOfmo0nlzUdRgbW6Z_izzfYB_lIZeHtTqZn9X4Agq0");'
                aria-label="User profile menu"
                type="button"
              ></button>
              <div class="profile-dropdown absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-lg border border-[#eaedf1] py-2 z-50" role="menu">
                <a href="#" class="block px-4 py-3 text-sm text-[#101518] hover:bg-[#f8f9fa] transition-colors focus-visible:focus" role="menuitem" tabindex="0">👤 Profile</a>
                <a href="#" class="block px-4 py-3 text-sm text-[#101518] hover:bg-[#f8f9fa] transition-colors focus-visible:focus" role="menuitem" tabindex="0">📦 Orders</a>
                <hr class="my-1 border-[#eaedf1]">
                <a href="#" class="block px-4 py-3 text-sm text-[#101518] hover:bg-[#f8f9fa] transition-colors focus-visible:focus" role="menuitem" tabindex="0">🚪 Logout</a>
              </div>
            </div>
          </div>
        </header>
        
        <main class="flex flex-1 gap-6 px-4 md:px-6 py-6">
          <aside class="w-full md:w-80 lg:w-96 flex-shrink-0" role="complementary" aria-label="Filters">
            <div class="filter-section sticky top-24 rounded-2xl p-6 shadow-lg">
              <h2 class="text-[#101518] text-xl md:text-2xl font-bold leading-tight tracking-[-0.015em] pb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256" class="text-indigo-600">
                  <path d="M230,208a8,8,0,0,1-8,8H34a8,8,0,0,1-6.66-12.44L76,128V88a8,8,0,0,1,16,0v40a8,8,0,0,1-1.34,4.44L48,192H208l-42.66-59.56A8,8,0,0,1,164,128V88a8,8,0,0,1,16,0v40l48.66,68A8,8,0,0,1,230,208Z"/>
                </svg>
                Filters
              </h2>
              
              <div class="space-y-6">
                <div>
                  <label for="categoryFilter" class="block text-[#101518] text-base font-semibold leading-normal pb-3">
                    📂 Category
                  </label>
                  <select
                    id="categoryFilter"
                    class="form-input w-full rounded-xl text-[#101518] focus:outline-0 focus:ring-2 focus:ring-indigo-500 border border-[#d4dce2] bg-white h-12 px-4 text-base font-normal leading-normal transition-all hover:border-indigo-300"
                    onchange="filterProducts()"
                    aria-label="Filter by category"
                  >
                    <option value="">All Categories</option>
                    <option value="Web Development">Web Development</option>
                    <option value="AI/ML">AI/ML</option>
                    <option value="Database">Database</option>
                    <option value="Networking">Networking</option>
                    <option value="Mobile Development">Mobile Development</option>
                    <option value="Data Science">Data Science</option>
                    <option value="Cloud Computing">Cloud Computing</option>
                    <option value="Cybersecurity">Cybersecurity</option>
                  </select>
                </div>

                <div>
                  <label class="block text-[#101518] text-base font-semibold leading-normal pb-3">
                    💰 Price Range
                  </label>
                  <div class="price-slider" id="priceSlider" role="slider" aria-label="Price range">
                    <div class="price-slider-track" id="priceTrack"></div>
                    <div class="price-slider-thumb" id="minThumb" tabindex="0" role="slider" aria-label="Minimum price" aria-valuemin="0" aria-valuemax="500"></div>
                    <div class="price-slider-thumb" id="maxThumb" tabindex="0" role="slider" aria-label="Maximum price" aria-valuemin="0" aria-valuemax="500"></div>
                  </div>
                  <div class="flex justify-between mt-3">
                    <span class="text-[#101518] text-sm font-semibold bg-gray-100 px-3 py-1 rounded-full">$<span id="minPrice">0</span></span>
                    <span class="text-[#101518] text-sm font-semibold bg-gray-100 px-3 py-1 rounded-full">$<span id="maxPrice">500</span></span>
                  </div>
                </div>

                <div>
                  <label for="difficultyFilter" class="block text-[#101518] text-base font-semibold leading-normal pb-3">
                    🎯 Difficulty Level
                  </label>
                  <select
                    id="difficultyFilter"
                    class="form-input w-full rounded-xl text-[#101518] focus:outline-0 focus:ring-2 focus:ring-indigo-500 border border-[#d4dce2] bg-white h-12 px-4 text-base font-normal leading-normal transition-all hover:border-indigo-300"
                    onchange="filterProducts()"
                    aria-label="Filter by difficulty"
                  >
                    <option value="">All Levels</option>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                  </select>
                </div>

                <div>
                  <label for="typeFilter" class="block text-[#101518] text-base font-semibold leading-normal pb-3">
                    🔧 Project Type
                  </label>
                  <select
                    id="typeFilter"
                    class="form-input w-full rounded-xl text-[#101518] focus:outline-0 focus:ring-2 focus:ring-indigo-500 border border-[#d4dce2] bg-white h-12 px-4 text-base font-normal leading-normal transition-all hover:border-indigo-300"
                    onchange="filterProducts()"
                    aria-label="Filter by project type"
                  >
                    <option value="">All Types</option>
                    <option value="Development">Development</option>
                    <option value="Security">Security</option>
                    <option value="Analytics">Analytics</option>
                  </select>
                </div>

                <button
                  onclick="clearAllFilters()"
                  class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-xl transition-colors focus-visible:focus"
                  type="button"
                  aria-label="Clear all filters"
                >
                  🗑️ Clear All Filters
                </button>
              </div>
            </div>
          </aside>
          
          <section class="flex-1 min-w-0" role="main" aria-label="Project listings">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
              <h2 class="text-[#101518] text-2xl md:text-3xl font-bold leading-tight tracking-[-0.015em]" id="pageTitle">
                Available Projects
              </h2>
              <div class="flex items-center gap-4">
                <p class="text-[#5c748a] text-sm font-medium bg-white px-4 py-2 rounded-full shadow-sm">
                  Showing <span id="resultCount" class="font-bold text-indigo-600">8</span> results
                </p>
                <div id="loadingIndicator" class="hidden">
                  <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-indigo-600"></div>
                </div>
              </div>
            </div>
            
            <div id="productsContainer" class="space-y-6">
              <!-- Products will be dynamically populated here -->
            </div>
            
            <nav aria-label="Pagination" class="flex items-center justify-center gap-2 mt-12">
              <button class="flex size-10 items-center justify-center rounded-full hover:bg-gray-100 transition-colors focus-visible:focus" aria-label="Previous page" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" fill="currentColor" viewBox="0 0 256 256">
                  <path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"></path>
                </svg>
              </button>
              <button class="flex size-10 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-sm focus-visible:focus" aria-label="Page 1, current page" type="button">1</button>
              <button class="flex size-10 items-center justify-center rounded-full hover:bg-gray-100 transition-colors text-sm font-medium focus-visible:focus" aria-label="Page 2" type="button">2</button>
              <button class="flex size-10 items-center justify-center rounded-full hover:bg-gray-100 transition-colors text-sm font-medium focus-visible:focus" aria-label="Page 3" type="button">3</button>
              <span class="flex size-10 items-center justify-center text-sm font-medium text-gray-400">...</span>
              <button class="flex size-10 items-center justify-center rounded-full hover:bg-gray-100 transition-colors text-sm font-medium focus-visible:focus" aria-label="Page 10" type="button">10</button>
              <button class="flex size-10 items-center justify-center rounded-full hover:bg-gray-100 transition-colors focus-visible:focus" aria-label="Next page" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" fill="currentColor" viewBox="0 0 256 256">
                  <path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path>
                </svg>
              </button>
            </nav>
          </section>
        </main>
      </div>
    </div>

    <script>
      // Enhanced products data with rich information
      const products = [
        {
          id: 1,
          name: "E-commerce Website with React",
          category: "Web Development",
          price: 150,
          difficulty: "Intermediate",
          rating: 4.8,
          duration: "6 weeks",
          students: 1247,
          technologies: ["React", "Node.js", "MongoDB", "Stripe"],
          description: "Build a full-stack e-commerce platform with modern React, payment integration, and user authentication.",
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuDEO6_xxp2Kty0-_T30BFVhc3Lf88QY1anmUwSwq20vyRHOdao3-AEd9yFO1_ZGIvGWoUtirbzBI3czgaEWrK7fo9Lfkk4VVIYIiEE3ZGYvVTwHa1-i4l3Ecr_DWxFQ3sUGMfuNn6bIT43IakJwXtHTqj8YL_FRxuXacLrS5VjnsuORPdoQCG6R6-QHad2dOezYYOtF_W3Sef4EmTf3BagqUrfbiSmCXr5qKoyi4uFnY06XvBqti5Allm5vagWcGUk0J_wJAOmdcXU"
        },
        {
          id: 2,
          name: "Machine Learning Model for Image Recognition",
          category: "AI/ML",
          price: 200,
          difficulty: "Advanced",
          rating: 4.9,
          duration: "8 weeks",
          students: 892,
          technologies: ["Python", "TensorFlow", "OpenCV", "Keras"],
          description: "Develop sophisticated image recognition models using deep learning techniques and neural networks.", 
        image: "https://lh3.googleusercontent.com/aida-public/AB6AXuAqqRb2C91bYX_37iElk8MGondPY0iO6cRvcEtlW-pxlP-wDfFbonTEA48RWanTg9Q7Z1F63pd39t9z5ELwZBgvdTWs58MWXUK2tF3oxBBT3uLwPbmxKmtR13lsbKcjTN-ar04I5-2BrQBGOW7O0_image.jpg"
        },
        {
          id: 3,
          name: "RESTful API with Authentication",
          category: "Web Development",
          price: 120,
          difficulty: "Intermediate",
          rating: 4.7,
          duration: "4 weeks",
          students: 1563,
          technologies: ["Node.js", "Express", "JWT", "PostgreSQL"],
          description: "Create secure RESTful APIs with JWT authentication, input validation, and comprehensive documentation.",
          image: "https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400&h=300&fit=crop"
        },
        {
          id: 4,
          name: "Database Design & Optimization",
          category: "Database",
          price: 100,
          difficulty: "Advanced",
          rating: 4.6,
          duration: "5 weeks",
          students: 734,
          technologies: ["MySQL", "PostgreSQL", "Redis", "MongoDB"],
          description: "Master advanced database concepts including indexing, query optimization, and database architecture.",
          image: "https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=400&h=300&fit=crop"
        },
        {
          id: 5,
          name: "Network Security Implementation",
          category: "Cybersecurity",
          price: 180,
          difficulty: "Advanced",
          rating: 4.9,
          duration: "7 weeks",
          students: 456,
          technologies: ["Python", "Wireshark", "Nmap", "OpenSSL"],
          description: "Implement comprehensive network security measures including firewall configuration and intrusion detection.",
          image: "https://images.unsplash.com/photo-1563206767-5b18f218e8de?w=400&h=300&fit=crop"
        },
        {
          id: 6,
          name: "React Native Mobile App",
          category: "Mobile Development",
          price: 160,
          difficulty: "Intermediate",
          rating: 4.5,
          duration: "6 weeks",
          students: 891,
          technologies: ["React Native", "Expo", "Firebase", "Redux"],
          description: "Build cross-platform mobile applications with React Native, including push notifications and offline storage.",
          image: "https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&h=300&fit=crop"
        },
        {
          id: 7,
          name: "Data Visualization Dashboard",
          category: "Data Science",
          price: 140,
          difficulty: "Intermediate",
          rating: 4.8,
          duration: "5 weeks",
          students: 1123,
          technologies: ["Python", "Plotly", "Pandas", "Streamlit"],
          description: "Create interactive data visualization dashboards with real-time analytics and dynamic chart updates.",
          image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=300&fit=crop"
        },
        {
          id: 8,
          name: "Cloud Infrastructure Setup",
          category: "Cloud Computing",
          price: 220,
          difficulty: "Advanced",
          rating: 4.7,
          duration: "8 weeks",
          students: 567,
          technologies: ["AWS", "Docker", "Kubernetes", "Terraform"],
          description: "Deploy and manage scalable cloud infrastructure with containerization and infrastructure as code.",
          image: "https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=400&h=300&fit=crop"
        }
      ];

      // State management
      let filteredProducts = [...products];
      let wishlist = [];
      let cart = [];
      let currentView = 'products'; // 'products' or 'wishlist'
      let priceRange = { min: 0, max: 500 };

      // DOM elements
      const productsContainer = document.getElementById('productsContainer');
      const resultCount = document.getElementById('resultCount');
      const wishlistCount = document.getElementById('wishlistCount');
      const cartCount = document.getElementById('cartCount');
      const pageTitle = document.getElementById('pageTitle');
      const loadingIndicator = document.getElementById('loadingIndicator');

      // Initialize the application
      function init() {
        initializePriceSlider();
        renderProducts();
        updateCounts();
      }

      // Price slider functionality
      function initializePriceSlider() {
        const slider = document.getElementById('priceSlider');
        const track = document.getElementById('priceTrack');
        const minThumb = document.getElementById('minThumb');
        const maxThumb = document.getElementById('maxThumb');
        const minPrice = document.getElementById('minPrice');
        const maxPrice = document.getElementById('maxPrice');

        let isDragging = false;
        let currentThumb = null;

        function updateSlider() {
          const minPercent = (priceRange.min / 500) * 100;
          const maxPercent = (priceRange.max / 500) * 100;
          
          track.style.left = minPercent + '%';
          track.style.width = (maxPercent - minPercent) + '%';
          
          minThumb.style.left = minPercent + '%';
          maxThumb.style.left = maxPercent + '%';
          
          minPrice.textContent = priceRange.min;
          maxPrice.textContent = priceRange.max;
          
          minThumb.setAttribute('aria-valuenow', priceRange.min);
          maxThumb.setAttribute('aria-valuenow', priceRange.max);
        }

        function handleMouseDown(e, thumb) {
          isDragging = true;
          currentThumb = thumb;
          e.preventDefault();
        }

        function handleMouseMove(e) {
          if (!isDragging || !currentThumb) return;
          
          const rect = slider.getBoundingClientRect();
          const percent = Math.max(0, Math.min(100, ((e.clientX - rect.left) / rect.width) * 100));
          const value = Math.round((percent / 100) * 500);
          
          if (currentThumb === minThumb) {
            priceRange.min = Math.min(value, priceRange.max - 10);
          } else {
            priceRange.max = Math.max(value, priceRange.min + 10);
          }
          
          updateSlider();
          filterProducts();
        }

        function handleMouseUp() {
          isDragging = false;
          currentThumb = null;
        }

        minThumb.addEventListener('mousedown', (e) => handleMouseDown(e, minThumb));
        maxThumb.addEventListener('mousedown', (e) => handleMouseDown(e, maxThumb));
        document.addEventListener('mousemove', handleMouseMove);
        document.addEventListener('mouseup', handleMouseUp);

        // Keyboard support
        [minThumb, maxThumb].forEach(thumb => {
          thumb.addEventListener('keydown', (e) => {
            const step = e.shiftKey ? 50 : 10;
            const isMin = thumb === minThumb;
            
            switch(e.key) {
              case 'ArrowLeft':
              case 'ArrowDown':
                if (isMin) {
                  priceRange.min = Math.max(0, priceRange.min - step);
                } else {
                  priceRange.max = Math.max(priceRange.min + 10, priceRange.max - step);
                }
                break;
              case 'ArrowRight':
              case 'ArrowUp':
                if (isMin) {
                  priceRange.min = Math.min(priceRange.max - 10, priceRange.min + step);
                } else {
                  priceRange.max = Math.min(500, priceRange.max + step);
                }
                break;
            }
            updateSlider();
            filterProducts();
            e.preventDefault();
          });
        });

        updateSlider();
      }

      // Render products
      function renderProducts() {
        showLoading(true);
        
        setTimeout(() => {
          const productsToShow = currentView === 'wishlist' ? 
            products.filter(p => wishlist.includes(p.id)) : 
            filteredProducts;

          if (productsToShow.length === 0) {
            productsContainer.innerHTML = `
              <div class="no-results text-center py-16">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">No projects found</h3>
                <p class="text-gray-500 mb-6">Try adjusting your filters or search terms</p>
                <button onclick="clearAllFilters()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-xl transition-colors">
                  Clear All Filters
                </button>
              </div>
            `;
          } else {
            productsContainer.innerHTML = productsToShow.map(product => createProductCard(product)).join('');
          }

          resultCount.textContent = productsToShow.length;
          pageTitle.textContent = currentView === 'wishlist' ? 'Your Wishlist' : 'Available Projects';
          showLoading(false);
        }, 300);
      }

      // Create product card HTML
      function createProductCard(product) {
        const isInWishlist = wishlist.includes(product.id);
        const isInCart = cart.includes(product.id);
        const stars = generateStars(product.rating);
        const difficultyClass = `difficulty-${product.difficulty.toLowerCase()}`;
        
        return `
          <div class="card-hover bg-white rounded-2xl shadow-lg p-6 animate-slide-in border border-gray-100">
            <div class="flex flex-col lg:flex-row gap-6">
              <div class="lg:w-1/3 flex-shrink-0">
                <img 
                  src="${product.image}" 
                  alt="${product.name}"
                  class="w-full h-48 lg:h-full object-cover rounded-xl bg-gray-100"
                  loading="lazy"
                />
              </div>
              
              <div class="lg:w-2/3 flex flex-col justify-between">
                <div>
                  <div class="flex flex-wrap items-start justify-between gap-3 mb-4">
                    <div class="flex-1 min-w-0">
                      <h3 class="text-xl lg:text-2xl font-bold text-[#101518] mb-2 leading-tight">
                        ${product.name}
                      </h3>
                      <p class="text-gray-600 mb-3 line-clamp-2">
                        ${product.description}
                      </p>
                    </div>
                    
                    <button 
                      onclick="toggleWishlist(${product.id})" 
                      class="wishlist-btn p-2 rounded-full hover:bg-gray-100 ${isInWishlist ? 'active' : ''}"
                      aria-label="${isInWishlist ? 'Remove from wishlist' : 'Add to wishlist'}"
                      type="button"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.69,146.26,196.16,128,206.8Z"/>
                      </svg>
                    </button>
                  </div>
                  
                  <div class="flex flex-wrap items-center gap-4 mb-4">
                    <span class="difficulty-badge ${difficultyClass}">
                      ${product.difficulty}
                    </span>
                    <span class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                      📂 ${product.category}
                    </span>
                    <span class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                      ⏱️ ${product.duration}
                    </span>
                  </div>
                  
                  <div class="flex flex-wrap gap-2 mb-4">
                    ${product.technologies.map(tech => 
                      `<span class="tech-tag">${tech}</span>`
                    ).join('')}
                  </div>
                  
                  <div class="flex items-center gap-4 mb-4">
                    <div class="rating-stars" aria-label="Rating: ${product.rating} out of 5 stars">
                      ${stars}
                    </div>
                    <span class="text-sm font-medium text-gray-700">${product.rating}</span>
                    <span class="text-sm text-gray-500">(${product.students.toLocaleString()} students)</span>
                  </div>
                </div>
                
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-4 border-t border-gray-100">
                  <div class="flex items-center gap-2">
                    <span class="text-3xl font-bold text-indigo-600">$${product.price}</span>
                    <span class="text-sm text-gray-500">one-time</span>
                  </div>
                  
                  <div class="flex gap-3 w-full sm:w-auto">
                    <button 
                      onclick="toggleCart(${product.id})"
                      class="add-to-cart-btn flex-1 sm:flex-none px-6 py-3 rounded-xl font-semibold text-white transition-all ${isInCart ? 'success' : 'bg-indigo-600 hover:bg-indigo-700'}"
                      type="button"
                    >
                      ${isInCart ? '✓ Added to Cart' : '🛒 Add to Cart'}
                    </button>
                    <button 
                      onclick="viewProjectDetails(${product.id})"
                      class="px-6 py-3 border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-50 rounded-xl font-semibold transition-colors"
                      type="button"
                    >
                      View Details
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `;
      }

      // Generate star rating HTML
      function generateStars(rating) {
        const fullStars = Math.floor(rating);
        const hasHalfStar = rating % 1 !== 0;
        const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
        
        let starsHTML = '';
        
        for (let i = 0; i < fullStars; i++) {
          starsHTML += '<svg class="star-filled w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
        }
        
        if (hasHalfStar) {
          starsHTML += '<svg class="star-filled w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><defs><linearGradient id="half-star"><stop offset="50%" stop-color="currentColor"/><stop offset="50%" stop-color="#d1d5db"/></linearGradient></defs><path fill="url(#half-star)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
        }
        
        for (let i = 0; i < emptyStars; i++) {
          starsHTML += '<svg class="star-empty w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
        }
        
        return starsHTML;
      }

      // Filter products
      function filterProducts() {
        const categoryFilter = document.getElementById('categoryFilter').value;
        const difficultyFilter = document.getElementById('difficultyFilter').value;
        const typeFilter = document.getElementById('typeFilter').value;
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();

        filteredProducts = products.filter(product => {
          const matchesCategory = !categoryFilter || product.category === categoryFilter;
          const matchesDifficulty = !difficultyFilter || product.difficulty === difficultyFilter;
          const matchesPrice = product.price >= priceRange.min && product.price <= priceRange.max;
          const matchesSearch = !searchTerm || 
            product.name.toLowerCase().includes(searchTerm) ||
            product.description.toLowerCase().includes(searchTerm) ||
            product.technologies.some(tech => tech.toLowerCase().includes(searchTerm));
          
          return matchesCategory && matchesDifficulty && matchesPrice && matchesSearch;
        });

        if (currentView === 'products') {
          renderProducts();
        }
      }

      // Search functionality
      function performSearch() {
        currentView = 'products';
        filterProducts();
      }

      function handleSearchKeypress(event) {
        if (event.key === 'Enter') {
          performSearch();
        }
      }

      // Wishlist functionality
      function toggleWishlist(productId) {
        const index = wishlist.indexOf(productId);
        if (index > -1) {
          wishlist.splice(index, 1);
        } else {
          wishlist.push(productId);
        }
        updateCounts();
        renderProducts();
      }

      function toggleWishlistView() {
        currentView = currentView === 'wishlist' ? 'products' : 'wishlist';
        renderProducts();
      }

      // Cart functionality
      function toggleCart(productId) {
        const index = cart.indexOf(productId);
        if (index > -1) {
          cart.splice(index, 1);
        } else {
          cart.push(productId);
        }
        updateCounts();
        renderProducts();
      }

      // Update counts
      function updateCounts() {
        wishlistCount.textContent = wishlist.length;
        cartCount.textContent = cart.length;
      }

      // Clear all filters
      function clearAllFilters() {
        document.getElementById('categoryFilter').value = '';
        document.getElementById('difficultyFilter').value = '';
        document.getElementById('typeFilter').value = '';
        document.getElementById('searchInput').value = '';
        priceRange = { min: 0, max: 500 };
        
        // Update price slider display
        const minPrice = document.getElementById('minPrice');
        const maxPrice = document.getElementById('maxPrice');
        const track = document.getElementById('priceTrack');
        const minThumb = document.getElementById('minThumb');
        const maxThumb = document.getElementById('maxThumb');
        
        minPrice.textContent = '0';
        maxPrice.textContent = '500';
        track.style.left = '0%';
        track.style.width = '100%';
        minThumb.style.left = '0%';
        maxThumb.style.left = '100%';
        
        currentView = 'products';
        filterProducts();
      }

      // Show/hide loading indicator
      function showLoading(show) {
        if (show) {
          loadingIndicator.classList.remove('hidden');
        } else {
          loadingIndicator.classList.add('hidden');
        }
      }

      // View project details (placeholder)
      function viewProjectDetails(productId) {
        const product = products.find(p => p.id === productId);
        alert(`Viewing details for: ${product.name}\n\nThis would typically open a detailed project page with more information, curriculum, reviews, and enrollment options.`);
      }

      // Initialize the app when DOM is loaded
      document.addEventListener('DOMContentLoaded', init);

      // Add some responsive keyboard navigation
      document.addEventListener('keydown', (e) => {
        if (e.key === '/' && !e.target.matches('input')) {
          e.preventDefault();
          document.getElementById('searchInput').focus();
        }
      });
    </script>
  </body>
</html>