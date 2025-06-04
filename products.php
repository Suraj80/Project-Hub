<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Space+Grotesk%3Awght%40400%3B500%3B700"
    />

    <title>Stitch Design</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
      .profile-dropdown {
        transform: translateY(-10px);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
      }
      .profile-container:hover .profile-dropdown {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
      }
      .price-slider {
        position: relative;
        height: 4px;
        background: #d4dce2;
        border-radius: 2px;
        margin: 20px 0;
      }
      .price-slider-track {
        height: 4px;
        background: #dce8f3;
        border-radius: 2px;
        position: absolute;
      }
      .price-slider-thumb {
        width: 16px;
        height: 16px;
        background: #dce8f3;
        border-radius: 50%;
        position: absolute;
        top: -6px;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .price-slider-thumb:hover {
        transform: scale(1.2);
      }
    </style>
  </head>
  <body>
    <div
      class="relative flex size-full min-h-screen flex-col bg-gray-50 group/design-root overflow-x-hidden"
      style='--select-button-svg: url(&apos;data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2724px%27 height=%2724px%27 fill=%27rgb(92,116,138)%27 viewBox=%270 0 256 256%27%3e%3cpath d=%27M181.66,170.34a8,8,0,0,1,0,11.32l-48,48a8,8,0,0,1-11.32,0l-48-48a8,8,0,0,1,11.32-11.32L128,212.69l42.34-42.35A8,8,0,0,1,181.66,170.34Zm-96-84.68L128,43.31l42.34,42.35a8,8,0,0,0,11.32-11.32l-48-48a8,8,0,0,0-11.32,0l-48,48A8,8,0,0,0,85.66,85.66Z%27%3e%3c/path%3e%3c/svg%3e&apos;); font-family: "Space Grotesk", "Noto Sans", sans-serif;'
    >
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#eaedf1] px-10 py-3">
          <div class="flex items-center gap-8">
            <div class="flex items-center gap-4 text-[#101518]">
              <div class="size-4">
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
              <h2 class="text-[#101518] text-lg font-bold leading-tight tracking-[-0.015em]">Project Hub</h2>
            </div>
            <div class="flex items-center gap-9">
              <a class="text-[#101518] text-sm font-medium leading-normal" href="#">Home</a>
              <a class="text-[#101518] text-sm font-medium leading-normal" href="#">Projects</a>
              <a class="text-[#101518] text-sm font-medium leading-normal" href="#">About</a>
              <a class="text-[#101518] text-sm font-medium leading-normal" href="#">Contact</a>
            </div>
          </div>
          <div class="flex flex-1 justify-end gap-8">
            <label class="flex flex-col min-w-40 !h-10 max-w-64">
              <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                <div
                  class="text-[#5c748a] flex border-none bg-[#eaedf1] items-center justify-center pl-4 rounded-l-xl border-r-0 cursor-pointer"
                  data-icon="MagnifyingGlass"
                  data-size="24px"
                  data-weight="regular"
                  onclick="performSearch()"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"
                    ></path>
                  </svg>
                </div>
                <input
                  id="searchInput"
                  placeholder="Search"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#101518] focus:outline-0 focus:ring-0 border-none bg-[#eaedf1] focus:border-none h-full placeholder:text-[#5c748a] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal"
                  value=""
                  onkeypress="handleSearchKeypress(event)"
                />
              </div>
            </label>
            <button
              class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-[#eaedf1] text-[#101518] text-sm font-bold leading-normal tracking-[0.015em]"
            >
              <span class="truncate">Cart (<span id="cartCount">3</span>)</span>
            </button>
            <div class="relative profile-container">
              <div
                class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 cursor-pointer"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAg9-aOcXsbMnrMbI3Xp94a9vQE2OZBNVf__4BKAkbLgeycgAPBf6ZondpInLxEWAdmQezLZS66LaYWjJo43CBfxs4jSXtJ4RGkoy77lf_cny2suGQu9UZmA5tor5TqnC42fxSWnNbemr7Kw7iP4h2hEaQr6v9dpCVKWOTCcH-PtQSsLY0Dzr18O9VREHxVZOWPUm0p35rQs1tOpqN3qNTg2TCgAl_N_OHQLJOfmo0nlzUdRgbW6Z_izzfYB_lIZeHtTqZn9X4Agq0");'
              ></div>
              <div class="profile-dropdown absolute right-0 top-full mt-2 w-40 bg-white rounded-lg shadow-lg border border-[#eaedf1] py-2 z-50">
                <a href="#" class="block px-4 py-2 text-sm text-[#101518] hover:bg-[#f8f9fa] transition-colors">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-[#101518] hover:bg-[#f8f9fa] transition-colors">Orders</a>
                <a href="#" class="block px-4 py-2 text-sm text-[#101518] hover:bg-[#f8f9fa] transition-colors">Logout</a>
              </div>
            </div>
          </div>
        </header>
        <div class="gap-1 px-6 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col w-80">
            <h2 class="text-[#101518] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Filters</h2>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <p class="text-[#101518] text-base font-medium leading-normal pb-2">Category</p>
                <select
                  id="categoryFilter"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#101518] focus:outline-0 focus:ring-0 border border-[#d4dce2] bg-gray-50 focus:border-[#d4dce2] h-14 bg-[image:--select-button-svg] placeholder:text-[#5c748a] p-[15px] text-base font-normal leading-normal"
                  onchange="filterProducts()"
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
              </label>
            </div>
            <div class="@container">
              <div class="relative flex w-full flex-col items-start justify-between gap-3 p-4 @[480px]:flex-row">
                <p class="text-[#101518] text-base font-medium leading-normal w-full shrink-[3]">Price Range</p>
                <div class="flex flex-col w-full">
                  <div class="price-slider" id="priceSlider">
                    <div class="price-slider-track" id="priceTrack"></div>
                    <div class="price-slider-thumb" id="minThumb"></div>
                    <div class="price-slider-thumb" id="maxThumb"></div>
                  </div>
                  <div class="flex justify-between mt-2">
                    <span class="text-[#101518] text-sm font-normal">$<span id="minPrice">0</span></span>
                    <span class="text-[#101518] text-sm font-normal">$<span id="maxPrice">500</span></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <p class="text-[#101518] text-base font-medium leading-normal pb-2">Project Type</p>
                <select
                  id="typeFilter"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#101518] focus:outline-0 focus:ring-0 border border-[#d4dce2] bg-gray-50 focus:border-[#d4dce2] h-14 bg-[image:--select-button-svg] placeholder:text-[#5c748a] p-[15px] text-base font-normal leading-normal"
                  onchange="filterProducts()"
                >
                  <option value="">All Types</option>
                  <option value="Development">Development</option>
                  <option value="Security">Security</option>
                  <option value="Analytics">Analytics</option>
                </select>
              </label>
            </div>
          </div>
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <p class="text-[#101518] tracking-light text-[32px] font-bold leading-tight min-w-72">Available Projects</p>
              <p class="text-[#5c748a] text-sm">Showing <span id="resultCount">9</span> results</p>
            </div>
            <div id="productsContainer">
              <!-- Products will be dynamically populated here -->
            </div>
            <div class="flex items-center justify-center p-4">
              <a href="#" class="flex size-10 items-center justify-center">
                <div class="text-[#101518]" data-icon="CaretLeft" data-size="18px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"></path>
                  </svg>
                </div>
              </a>
              <a class="text-sm font-bold leading-normal tracking-[0.015em] flex size-10 items-center justify-center text-[#101518] rounded-full bg-[#eaedf1]" href="#">1</a>
              <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#101518] rounded-full" href="#">2</a>
              <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#101518] rounded-full" href="#">3</a>
              <span class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#101518] rounded-full">...</span>
              <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#101518] rounded-full" href="#">10</a>
              <a href="#" class="flex size-10 items-center justify-center">
                <div class="text-[#101518]" data-icon="CaretRight" data-size="18px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path>
                  </svg>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      // Sample products data
      const products = [
        {
          id: 1,
          name: "E-commerce Website with React",
          category: "Web Development",
          price: 150,
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuDEO6_xxp2Kty0-_T30BFVhc3Lf88QY1anmUwSwq20vyRHOdao3-AEd9yFO1_ZGIvGWoUtirbzBI3czgaEWrK7fo9Lfkk4VVIYIiEE3ZGYvVTwHa1-i4l3Ecr_DWxFQ3sUGMfuNn6bIT43IakJwXtHTqj8YL_FRxuXacLrS5VjnsuORPdoQCG6R6-QHad2dOezYYOtF_W3Sef4EmTf3BagqUrfbiSmCXr5qKoyi4uFnY06XvBqti5Allm5vagWcGUk0J_wJAOmdcXU"
        },
        {
          id: 2,
          name: "Machine Learning Model for Image Recognition",
          category: "AI/ML",
          price: 200,
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuAqqRb2C91bYX_37iElk8MGondPY0iO6cRvcEtlW-pxlP-wDfFbonTEA48RWanTg9Q7Z1F63pd39t9z5ELwZBgvdTWs58MWXUK2tF3oxBBT3uLwPbmxKmtR13lsbKcjTN-ar04I5-2BrQBGOW7O0iC6YjJyS_sBRyACqXejXXeQMUHSGxPJne4Bg9RkTpIIbdkGDQGzVBojXZUBkD4ZFKOk4x9p4xv7oTKmVJyKFthEkQFZhrQEm4RhBGRnTpRtBjE6SYhrJshJQEw"
        },
        {
          id: 3,
          name: "Database Management System using SQL",
          category: "Database",
          price: 100,
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuCYx1zLwcFh-qqzT323Cadi4qnMwHhqsQybX2mrBZpYgd3Bd_kYBjkoYNIJsvIu9oea3C5oLHqxYPFBLc8ut3zjQPoD6QAZMVFG_-sPBIJLXUKFPWgHZY-elRWCGf_chnWdS0_K0pR0ccsei4oLLFq4bD1ZCKz0B2VPl7xUkvVGw9CIH7gkZB7kjh0JJotfzvmZ55Y1YTvAkXxKBG-a76VLfh5c3w5s-pNjE6dKWfe6ZX-kvxB891fX0ToiON5rSTPdhYwtX7nvdwU"
        },
        {
          id: 4,
          name: "Network Configuration and Security Project",
          category: "Networking",
          price: 180,
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuDI9pEQ2D0gxSy83vmodbpsb3lP5mmcJk89bO5XyKcNQjnlCd-vGYCNB7_U7piO6badYfPxJzNYnpe33p91Jb89_ZZcf9OfExLO0WguSrI5R9yEoDlFJ0AUR-MRZjDJNUA6Ld18F5rUj2el2FqWI325IEkvd6XEJ79lSdK1IjqTw7Q7ML3RhyRsXXBcEHEmdD38DwFt380cSmbJadToKrvYYsAS2aXBTNPpgxELDRVFcDWlByS4JyXha_hL48LzluR7MzRuDgbyxRs"
        },
        {
          id: 5,
          name: "Mobile App Development with Flutter",
          category: "Mobile Development",
          price: 220,
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuDvUod0NZtmcFTLapIbsStVdbJ6CVq4ZD-Oa55guamYnawDUNvo6DfOnukdg4jIctMo_xavu4S-v5AkS310-UYs3VTekBlTL0SgOVMW2aCSguaY2Y-ax8TelKD2cEHw8qvq_-bFaF0w5nhwsETcos1rWKoItA8UeCx7LoGEsd-rS9M3yOXy0oJRvzhts787JLJkt3os6AGqNqNj4TvWjENRo94Kd5BtTQ6FscH36jokh38XXaMM4c3zyAqwXZhss51_kdLYsBxol4o"
        },
        {
          id: 6,
          name: "Data Analysis and Visualization Project",
          category: "Data Science",
          price: 160,
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuC25AZcBFD1WQPU1L1GyFCRMBKuD4g3sjLOVIERiZU560orXI2qmxJF0y-hsMJ43H_lITZxFrsFEZcsfVsMxuDsE7-gu3pN6lWz66yb6M6YM7Ho75N6DT-VEDMKbF0V1ATh215Qc6GYSkDxb1PumiJd4FCsk_fybj90WeTkOZR9Iqohdwirup6yL-bq_f2GlP7UIbbXanI3fJTasD011L56sUoqdyt1SQv2MH19Y11CfU6Tbtwcj9_KlbD-zQz7FxDjdHYmQn10e48"
        },
        {
          id: 7,
          name: "Cloud Computing Project with AWS",
          category: "Cloud Computing",
          price: 190,
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuD17O5AhIvW3E7LFJNgJEoFyrcHhzBkpZsyaLAvd3nbTYeAyqUBu9GyEkQ9YD2NFMD8cKydHET9m0eOkx-guIWig8p7f3rEWJlxensJyxMgM032qIBJACbg4tgJtDf45Cq7IKzDVsngXGM6Vq0AM3hApxLV47PMG-818wVZoVBcLVhc-bzytdRzVljWKnsV4oDG0T-dyUAyuIkCeXfL9ooO7BpUPicMzKey7gvIaYZhjEZeOWb-Rq9L-P13uytZsn2IQooMV1Xpvuw"
        },
        {
          id: 8,
          name: "Cybersecurity Project: Penetration Testing",
          category: "Cybersecurity",
          price: 210,
          image: "https://lh3.googleusercontent.com/aida-public/AB6AXuD5Y289BDeS1CrnC-pJf4wQnF_YZUGQI0uwGO1cPSMjxhg5N4hp8seK2jRXd3XCq3G1Riy_JwVMdlxy1DSYDPcE5NKVZnWAViP_Rb56H12165Kv-KcEsTxs91DpBBVNa5Dy_zAFSQFnS_1ixDwuZ28jl2vwj6YM9sgZWpyF6O0Wd0kzk9Ec8-LYJVL2I_wfhe8N28rdvAoQGX5VddpBw1NVQ0D5no3oa3t-Dn6q2sqo2f6tLTdViDwgPzm1FmzysWHNVYYcd4dPr1c"
        }
      ];

      let filteredProducts = [...products];
      let cartItems = 3;
      let currentSearchTerm = '';
      let priceRange = { min: 0, max: 500 };

      // Price slider functionality
      let isDragging = false;
      let activeThumb = null;

      function initializePriceSlider() {
        const slider = document.getElementById('priceSlider');
        const minThumb = document.getElementById('minThumb');
        const maxThumb = document.getElementById('maxThumb');
        const track = document.getElementById('priceTrack');

        function updateSlider() {
          const sliderWidth = slider.offsetWidth;
          const minPercent = (priceRange.min / 500) * 100;
          const maxPercent = (priceRange.max / 500) * 100;

          minThumb.style.left = minPercent + '%';
          maxThumb.style.left = maxPercent + '%';
          
          track.style.left = minPercent + '%';
          track.style.width = (maxPercent - minPercent) + '%';

          document.getElementById('minPrice').textContent = priceRange.min;
          document.getElementById('maxPrice').textContent = priceRange.max;
        }

        function handleMouseDown(e, thumb) {
          isDragging = true;
          activeThumb = thumb;
          e.preventDefault();
        }

        function handleMouseMove(e) {
          if (!isDragging || !activeThumb) return;

          const sliderRect = slider.getBoundingClientRect();
          const percent = Math.max(0, Math.min(100, ((e.clientX - sliderRect.left) / sliderRect.width) * 100));
          const value = Math.round((percent / 100) * 500);

          if (activeThumb === minThumb) {
            priceRange.min = Math.min(value, priceRange.max - 10);
          } else {
            priceRange.max = Math.max(value, priceRange.min + 10);
          }

          updateSlider();
          filterProducts();
        }

        function handleMouseUp() {
          isDragging = false;
          activeThumb = null;
        }

        minThumb.addEventListener('mousedown', (e) => handleMouseDown(e, minThumb));
        maxThumb.addEventListener('mousedown', (e) => handleMouseDown(e, maxThumb));
        document.addEventListener('mousemove', handleMouseMove);
        document.addEventListener('mouseup', handleMouseUp);

        updateSlider();
      }

      // Search functionality
      function performSearch() {
        const searchInput = document.getElementById('searchInput');
        currentSearchTerm = searchInput.value.toLowerCase().trim();
        filterProducts();
      }

      function handleSearchKeypress(event) {
        if (event.key === 'Enter') {
          performSearch();
        }
      } 

      // Filter products
      function filterProducts() {
        const categoryFilter = document.getElementById('categoryFilter').value;
        const typeFilter = document.getElementById('typeFilter').value;

        filteredProducts = products.filter(product => {
          // Search filter
          const matchesSearch = !currentSearchTerm || 
            product.name.toLowerCase().includes(currentSearchTerm) ||
            product.category.toLowerCase().includes(currentSearchTerm);

          // Category filter
          const matchesCategory = !categoryFilter || product.category === categoryFilter;

          // Price filter
          const matchesPrice = product.price >= priceRange.min && product.price <= priceRange.max;

          return matchesSearch && matchesCategory && matchesPrice;
        });

        renderProducts();
        updateResultCount();
      }

      // Render products
      function renderProducts() {
        const container = document.getElementById('productsContainer');
        
        if (filteredProducts.length === 0) {
          container.innerHTML = `
            <div class="flex flex-col items-center justify-center py-12">
              <p class="text-[#5c748a] text-lg mb-4">No projects found</p>
              <p class="text-[#5c748a] text-sm">Try adjusting your filters or search terms</p>
            </div>
          `;
          return;
        }

        const productsHTML = filteredProducts.map(product => `
          <div class="flex items-center gap-4 bg-gray-50 px-4 py-3 rounded-xl border border-[#eaedf1] hover:shadow-md transition-shadow">
            <div
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-14"
              style="background-image: url('${product.image}')"
            ></div>
            <div class="flex flex-col justify-center flex-1">
              <p class="text-[#101518] text-base font-medium leading-normal line-clamp-1">${product.name}</p>
              <p class="text-[#5c748a] text-sm font-normal leading-normal">${product.category}</p>
            </div>
            <div class="shrink-0 flex items-center gap-3">
              <p class="text-[#101518] text-base font-bold leading-normal tracking-[0.015em]">$${product.price}</p>
              <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-8 px-4 bg-[#dce8f3] text-[#101518] text-sm font-medium leading-normal hover:bg-[#c5d9ed] transition-colors"
                onclick="addToCart(${product.id})"
              >
                <span class="truncate">Add to Cart</span>
              </button>
            </div>
          </div>
        `).join('');

        container.innerHTML = `<div class="flex flex-col gap-3 p-4">${productsHTML}</div>`;
      }

      // Update result count
      function updateResultCount() {
        document.getElementById('resultCount').textContent = filteredProducts.length;
      }

      // Add to cart functionality
      function addToCart(productId) {
        cartItems++;
        document.getElementById('cartCount').textContent = cartItems;
        
        // Show feedback
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '<span class="truncate">Added!</span>';
        button.style.backgroundColor = '#10b981';
        button.style.color = 'white';
        
        setTimeout(() => {
          button.innerHTML = originalText;
          button.style.backgroundColor = '#dce8f3';
          button.style.color = '#101518';
        }, 1500);
      }

      // Initialize the page
      document.addEventListener('DOMContentLoaded', function() {
        initializePriceSlider();
        renderProducts();
        updateResultCount();
      });
    </script>
  </body>
</html>