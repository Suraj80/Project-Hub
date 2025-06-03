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
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  </head>
  <body>
    <!-- <div
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
              <h2 class="text-[#101518] text-lg font-bold leading-tight tracking-[-0.015em]">CodeCraft</h2>
            </div>
            <div class="flex items-center gap-9">
              <a class="text-[#101518] text-sm font-medium leading-normal" href="#">Home</a>
              <a class="text-[#101518] text-sm font-medium leading-normal" href="#">Projects</a>
              <a class="text-[#101518] text-sm font-medium leading-normal" href="#">About Us</a>
              <a class="text-[#101518] text-sm font-medium leading-normal" href="#">Contact</a>
            </div>
          </div>
          <div class="flex flex-1 justify-end gap-8">
            <label class="flex flex-col min-w-40 !h-10 max-w-64">
              <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                <div
                  class="text-[#5c748a] flex border-none bg-[#eaedf1] items-center justify-center pl-4 rounded-l-xl border-r-0"
                  data-icon="MagnifyingGlass"
                  data-size="24px"
                  data-weight="regular"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"
                    ></path>
                  </svg>
                </div>
                <input
                  placeholder="Search"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#101518] focus:outline-0 focus:ring-0 border-none bg-[#eaedf1] focus:border-none h-full placeholder:text-[#5c748a] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal"
                  value=""
                />
              </div>
            </label>
            <button
              class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-[#eaedf1] text-[#101518] text-sm font-bold leading-normal tracking-[0.015em]"
            >
              <span class="truncate">Cart (3)</span>
            </button>
            <div
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
              style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAg9-aOcXsbMnrMbI3Xp94a9vQE2OZBNVf__4BKAkbLgeycgAPBf6ZondpInLxEWAdmQezLZS66LaYWjJo43CBfxs4jSXtJ4RGkoy77lf_cny2suGQu9UZmA5tor5TqnC42fxSWnNbemr7Kw7iP4h2hEaQr6v9dpCVKWOTCcH-PtQSsLY0Dzr18O9VREHxVZOWPUm0p35rQs1tOpqN3qNTg2TCgAl_N_OHQLJOfmo0nlzUdRgbW6Z_izzfYB_lIZeHtTqZn9X4Agq0");'
            ></div>
          </div>
        </header> -->
  <?php
        // include - can include the same file multiple times
include 'header.php';

  ?>
        
        <div class="flex flex-1 px-10 py-8">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <h1 class="text-[#101518] tracking-light text-[32px] font-bold leading-tight mb-8">Shopping Cart</h1>
            
            <!-- Cart Items Table -->
            <div class="bg-white rounded-xl border border-[#eaedf1] overflow-hidden mb-8">
              <!-- Table Header -->
              <div class="grid grid-cols-12 gap-4 p-4 bg-[#f8f9fa] border-b border-[#eaedf1] text-sm font-medium text-[#5c748a]">
                <div class="col-span-5">Project</div>
                <div class="col-span-2 text-center">Quantity</div>
                <div class="col-span-2 text-center">Price</div>
                <div class="col-span-3 text-center">Remove</div>
              </div>
              
              <!-- Cart Item 1 -->
              <div class="grid grid-cols-12 gap-4 p-4 border-b border-[#eaedf1] items-center">
                <div class="col-span-5">
                  <p class="text-[#101518] text-base font-medium leading-normal">E-commerce Website</p>
                </div>
                <div class="col-span-2 text-center">
                  <span class="text-[#101518] text-base font-normal leading-normal">1</span>
                </div>
                <div class="col-span-2 text-center">
                  <span class="text-[#101518] text-base font-normal leading-normal">$150</span>
                </div>
                <div class="col-span-3 text-center">
                  <button class="text-[#5c748a] text-sm font-medium leading-normal hover:text-[#101518] cursor-pointer">Remove</button>
                </div>
              </div>
              
              <!-- Cart Item 2 -->
              <div class="grid grid-cols-12 gap-4 p-4 border-b border-[#eaedf1] items-center">
                <div class="col-span-5">
                  <p class="text-[#101518] text-base font-medium leading-normal">Data Analysis Tool</p>
                </div>
                <div class="col-span-2 text-center">
                  <span class="text-[#101518] text-base font-normal leading-normal">2</span>
                </div>
                <div class="col-span-2 text-center">
                  <span class="text-[#101518] text-base font-normal leading-normal">$200</span>
                </div>
                <div class="col-span-3 text-center">
                  <button class="text-[#5c748a] text-sm font-medium leading-normal hover:text-[#101518] cursor-pointer">Remove</button>
                </div>
              </div>
              
              <!-- Cart Item 3 -->
              <div class="grid grid-cols-12 gap-4 p-4 items-center">
                <div class="col-span-5">
                  <p class="text-[#101518] text-base font-medium leading-normal">Mobile App for Task Management</p>
                </div>
                <div class="col-span-2 text-center">
                  <span class="text-[#101518] text-base font-normal leading-normal">1</span>
                </div>
                <div class="col-span-2 text-center">
                  <span class="text-[#101518] text-base font-normal leading-normal">$250</span>
                </div>
                <div class="col-span-3 text-center">
                  <button class="text-[#5c748a] text-sm font-medium leading-normal hover:text-[#101518] cursor-pointer">Remove</button>
                </div>
              </div>
            </div>
            
            <!-- Order Summary -->
            <div class="bg-white rounded-xl border border-[#eaedf1] p-6">
              <h2 class="text-[#101518] text-[22px] font-bold leading-tight tracking-[-0.015em] mb-6">Order Summary</h2>
              
              <div class="space-y-4">
                <div class="flex justify-between items-center">
                  <span class="text-[#5c748a] text-base font-normal leading-normal">Subtotal</span>
                  <span class="text-[#101518] text-base font-medium leading-normal">$800</span>
                </div>
                
                <div class="flex justify-between items-center">
                  <span class="text-[#5c748a] text-base font-normal leading-normal">Shipping</span>
                  <span class="text-[#101518] text-base font-medium leading-normal">Free</span>
                </div>
                
                <div class="flex justify-between items-center">
                  <span class="text-[#5c748a] text-base font-normal leading-normal">Taxes</span>
                  <span class="text-[#101518] text-base font-medium leading-normal">$40</span>
                </div>
                
                <div class="border-t border-[#eaedf1] pt-4">
                  <div class="flex justify-between items-center">
                    <span class="text-[#101518] text-lg font-bold leading-tight">Total</span>
                    <span class="text-[#101518] text-lg font-bold leading-tight">$840</span>
                  </div>
                </div>
                
                <div class="pt-4">
                  <button
                    class="flex min-w-full cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-6 bg-[#007bff] text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-[#0056b3] transition-colors"
                  >
                    <span class="truncate">Proceed to Checkout</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
  </body>
</html>