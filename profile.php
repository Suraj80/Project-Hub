<html>
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

    <title>Profile - Innovate CS</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
      .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
      }
      
      .gradient-bg {
        background: linear-gradient(135deg, #0b80ee 0%, #49749c 100%);
      }
      
      .profile-shadow {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      }
      
      .input-focus:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(11, 128, 238, 0.25);
      }
      
      .hover-lift:hover {
        transform: translateY(-2px);
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
    <div class="relative flex size-full min-h-screen flex-col bg-gradient-to-br from-slate-50 to-blue-50 group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
      <div class="layout-container flex h-full grow flex-col">
        <!-- Enhanced Header -->
        <header class="glass-card sticky top-0 z-50 flex items-center justify-between whitespace-nowrap px-4 md:px-6 lg:px-10 py-4 shadow-sm">
          <div class="flex items-center gap-3 text-[#0d151c]">
            <div class="size-8 md:size-10 gradient-bg rounded-lg flex items-center justify-center">
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-5 md:size-6 text-white">
                <path
                  d="M4 42.4379C4 42.4379 14.0962 36.0744 24 41.1692C35.0664 46.8624 44 42.2078 44 42.2078L44 7.01134C44 7.01134 35.068 11.6577 24.0031 5.96913C14.0971 0.876274 4 7.27094 4 7.27094L4 42.4379Z"
                  fill="currentColor"
                ></path>
              </svg>
            </div>
            <h2 class="text-[#0d151c] text-lg md:text-xl font-bold leading-tight tracking-[-0.015em]">Innovate CS</h2>
          </div>
          
          <!-- Desktop Navigation -->
          <div class="hidden lg:flex flex-1 justify-end gap-8">
            <div class="flex items-center gap-6">
              <a class="text-[#0d151c] text-sm font-medium leading-normal hover:text-[#0b80ee] transition-colors duration-200" href="#">Projects</a>
              <a class="text-[#0d151c] text-sm font-medium leading-normal hover:text-[#0b80ee] transition-colors duration-200" href="#">Categories</a>
              <a class="text-[#0d151c] text-sm font-medium leading-normal hover:text-[#0b80ee] transition-colors duration-200" href="#">How it works</a>
              <a class="text-[#0d151c] text-sm font-medium leading-normal hover:text-[#0b80ee] transition-colors duration-200" href="#">Pricing</a>
            </div>
            <div class="flex items-center gap-3">
              <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-[#e7edf4] text-[#0d151c] text-sm font-bold leading-normal tracking-[0.015em] hover-lift transition-all duration-200"
              >
                <span class="truncate">Sign in</span>
              </button>
              <div
                class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 ring-2 ring-[#0b80ee] ring-offset-2 hover-lift transition-all duration-200 cursor-pointer"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAtXFuWA390UKMGGQ-zD4lEa-pbwhIx1nrpnsXQWYMK5qw2VOF0eR-kUdI_GSqxqj0sL_A2-zp1UhJZ6fxzU2fivvi1f1-SItacqg_hT5jdBVip-cHa41XOz2Ey85iVa4TICCb61g6lJbbpIPZ8FySeNtwygwLy-5yKIxBiS9aCptvIlks4RvzxQrmoIOqdX80w-3-tW6v6afHhtXFwG22zb3lNUqRwqHG-Pay3-iT0e30OU-ikBOcn18ERQYUVPCmM-lYCuaCPkmc");'
              ></div>
            </div>
          </div>
          
          <!-- Mobile Menu Button -->
          <button class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors" onclick="toggleMobileMenu()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </header>

        <!-- Mobile Menu -->
        <div class="mobile-menu fixed inset-y-0 left-0 z-40 w-64 glass-card lg:hidden" id="mobileMenu">
          <div class="flex flex-col h-full p-6">
            <div class="flex justify-between items-center mb-8">
              <h3 class="text-lg font-semibold text-[#0d151c]">Menu</h3>
              <button onclick="toggleMobileMenu()" class="p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>
            <nav class="flex flex-col gap-4">
              <a class="text-[#0d151c] text-sm font-medium py-2 hover:text-[#0b80ee] transition-colors" href="#">Projects</a>
              <a class="text-[#0d151c] text-sm font-medium py-2 hover:text-[#0b80ee] transition-colors" href="#">Categories</a>
              <a class="text-[#0d151c] text-sm font-medium py-2 hover:text-[#0b80ee] transition-colors" href="#">How it works</a>
              <a class="text-[#0d151c] text-sm font-medium py-2 hover:text-[#0b80ee] transition-colors" href="#">Pricing</a>
            </nav>
          </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden" id="mobileOverlay" onclick="toggleMobileMenu()"></div>

        <!-- Main Content -->
        <div class="flex-1 px-4 md:px-6 lg:px-8 xl:px-12 py-6 md:py-8">
          <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex mb-6 md:mb-8" aria-label="Breadcrumb">
              <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                  <a href="#" class="text-[#49749c] hover:text-[#0b80ee] text-sm font-medium transition-colors">Dashboard</a>
                </li>
                <li>
                  <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-[#0d151c] text-sm font-medium">Account</span>
                  </div>
                </li>
              </ol>
            </nav>

            <!-- Profile Header -->
            <div class="glass-card rounded-2xl p-6 md:p-8 mb-6 md:mb-8 profile-shadow">
              <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-8">
                <!-- Profile Image -->
                <div class="relative group">
                  <div
                    class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-24 h-24 md:w-32 md:h-32 ring-4 ring-white shadow-lg group-hover:scale-105 transition-transform duration-300"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDgM-K6VB8Kvd5-BhZ9fmMh8q9xFOzwU6tbnrSvmoB5eMZ-eeZRXpZPN2-o_ST6n6LUn5-V59HFxG0riExtxJ5QHhmEJeV-scsv-yPbozDBNVLBpcmIeDk7g_jMNsfgI1GVbbqBhcau0WQb9WmRHkQ2sGZsEgr0eNUMuKMEexSievhMTHXeEY9mZWeTmiOTg6B9bgh80jtNmMBTIu0kRb8YzPPH81liBjtGd40cTNnVtFrMfkX_kka7CQbYOrrlQLe4Vwg3Ja-DfiA");'
                  ></div>
                  <div class="absolute inset-0 rounded-full bg-black bg-opacity-0 group-hover:bg-opacity-20 flex items-center justify-center transition-all duration-300">
                    <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                  </div>
                </div>
                
                <!-- Profile Info -->
                <div class="flex-1 text-center md:text-left">
                  <h1 class="text-2xl md:text-3xl font-bold text-[#0d151c] mb-2">Sophia Carter</h1>
                  <p class="text-[#49749c] text-base md:text-lg mb-4">sophia.carter@email.com</p>
                  <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                    <button class="flex items-center justify-center gap-2 px-4 py-2 bg-[#0b80ee] text-white rounded-lg hover-lift transition-all duration-200 text-sm font-medium">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                      </svg>
                      Upload Photo
                    </button>
                    <button class="flex items-center justify-center gap-2 px-4 py-2 bg-[#e7edf4] text-[#0d151c] rounded-lg hover-lift transition-all duration-200 text-sm font-medium">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                      Remove
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Profile Form -->
            <div class="glass-card rounded-2xl p-6 md:p-8 profile-shadow">
              <div class="flex items-center gap-3 mb-6 md:mb-8">
                <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                </div>
                <h2 class="text-xl md:text-2xl font-bold text-[#0d151c]">Personal Information</h2>
              </div>

              <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <!-- Name Field -->
                  <div class="space-y-2">
                    <label class="block text-[#0d151c] text-sm font-semibold">
                      Full Name <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      value="Sophia Carter"
                      class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                      placeholder="Enter your full name"
                    />
                  </div>

                  <!-- Email Field -->
                  <div class="space-y-2">
                    <label class="block text-[#0d151c] text-sm font-semibold">
                      Email Address <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="email"
                      value="sophia.carter@email.com"
                      class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                      placeholder="Enter your email address"
                    />
                  </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <!-- Mobile Number Field -->
                  <div class="space-y-2">
                    <label class="block text-[#0d151c] text-sm font-semibold">
                      Mobile Number <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="tel"
                      value="+1 (555) 123-4567"
                      class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                      placeholder="Enter your mobile number"
                    />
                  </div>

                  <!-- Date of Birth Field -->
                  <div class="space-y-2">
                    <label class="block text-[#0d151c] text-sm font-semibold">
                      Date of Birth
                    </label>
                    <input
                      type="date"
                      class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                    />
                  </div>
                </div>

                <!-- Password Section -->
                <div class="pt-4 border-t border-[#e7edf4]">
                  <h3 class="text-lg font-semibold text-[#0d151c] mb-4">Security</h3>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                      <label class="block text-[#0d151c] text-sm font-semibold">
                        Current Password
                      </label>
                      <input
                        type="password"
                        class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                        placeholder="Enter current password"
                      />
                    </div>

                    <div class="space-y-2">
                      <label class="block text-[#0d151c] text-sm font-semibold">
                        New Password
                      </label>
                      <input
                        type="password"
                        class="input-focus form-input w-full rounded-xl border border-[#cedce8] bg-white px-4 py-3 text-[#0d151c] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0b80ee] focus:border-transparent placeholder:text-[#49749c]"
                        placeholder="Enter new password"
                      />
                    </div>
                  </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6">
                  <button
                    type="button"
                    class="px-6 py-3 bg-[#e7edf4] text-[#0d151c] rounded-lg hover-lift transition-all duration-200 font-semibold order-2 sm:order-1"
                  >
                    Cancel
                  </button>
                  <button
                    type="submit"
                    class="px-8 py-3 gradient-bg text-white rounded-lg hover-lift transition-all duration-200 font-semibold shadow-lg order-1 sm:order-2"
                  >
                    Save Changes
                  </button>
                </div>
              </form>
            </div>

            <!-- Additional Settings -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6 md:mt-8">
              <!-- Preferences Card -->
              <div class="glass-card rounded-2xl p-6 profile-shadow">
                <h3 class="text-lg font-semibold text-[#0d151c] mb-4">Preferences</h3>
                <div class="space-y-4">
                  <div class="flex items-center justify-between">
                    <span class="text-[#0d151c] text-sm">Email notifications</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input type="checkbox" checked class="sr-only peer">
                      <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0b80ee]"></div>
                    </label>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-[#0d151c] text-sm">SMS notifications</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input type="checkbox" class="sr-only peer">
                      <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0b80ee]"></div>
                    </label>
                  </div>
                </div>
              </div>

              <!-- Activity Card -->
              <div class="glass-card rounded-2xl p-6 profile-shadow">
                <h3 class="text-lg font-semibold text-[#0d151c] mb-4">Recent Activity</h3>
                <div class="space-y-3">
                  <div class="flex items-center gap-3">
                    <div class="w-2 h-2 bg-[#0b80ee] rounded-full"></div>
                    <span class="text-[#49749c] text-sm">Profile updated</span>
                    <span class="text-[#49749c] text-xs ml-auto">2 hours ago</span>
                  </div>
                  <div class="flex items-center gap-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <span class="text-[#49749c] text-sm">Password changed</span>
                    <span class="text-[#49749c] text-xs ml-auto">1 day ago</span>
                  </div>
                  <div class="flex items-center gap-3">
                    <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                    <span class="text-[#49749c] text-sm">Email verified</span>
                    <span class="text-[#49749c] text-xs ml-auto">3 days ago</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('mobileOverlay');
        
        if (menu.classList.contains('open')) {
          menu.classList.remove('open');
          overlay.classList.add('hidden');
        } else {
          menu.classList.add('open');
          overlay.classList.remove('hidden');
        }
      }

      // Close mobile menu when clicking outside
      document.addEventListener('click', function(event) {
        const menu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('mobileOverlay');
        const menuButton = document.querySelector('[onclick="toggleMobileMenu()"]');
        
        if (!menu.contains(event.target) && !menuButton.contains(event.target) && menu.classList.contains('open')) {
          menu.classList.remove('open');
          overlay.classList.add('hidden');
        }
      });

      // Add smooth scrolling and form validation
      document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input[required], input[type="email"]');
        
        inputs.forEach(input => {
          input.addEventListener('blur', validateInput);
          input.addEventListener('input', clearValidation);
        });
        
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          let isValid = true;
          
          inputs.forEach(input => {
            if (!validateInput({ target: input })) {
              isValid = false;
            }
          });
          
          if (isValid) {
            // Simulate form submission
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Saving...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
              submitBtn.textContent = 'Saved!';
              setTimeout(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
              }, 1000);
            }, 1500);
          }
        });
      });
      
      function validateInput(event) {
        const input = event.target;
        const value = input.value.trim();
        let isValid = true;
        
        // Remove existing error styling
        input.classList.remove('border-red-500', 'ring-red-500');
        
        // Check if required field is empty
        if (input.hasAttribute('required') && !value) {
          isValid = false;
        }
        
        // Check email format
        if (input.type === 'email' && value) {
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(value)) {
            isValid = false;
          }
        }
        
        // Add error styling if invalid
        if (!isValid) {
          input.classList.add('border-red-500', 'ring-red-500');
        }
        
        return isValid;
      }
      
      function clearValidation(event) {
        const input = event.target;
        input.classList.remove('border-red-500', 'ring-red-500');
      }
    </script>
  </body>
</html>