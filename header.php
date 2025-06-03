
    <div class="relative flex size-full min-h-screen flex-col bg-slate-50 group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        <div class="layout-container flex h-full grow flex-col">
            <!-- Mobile-Responsive Header -->
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e7edf4] px-4 sm:px-6 lg:px-10 py-3 bg-white sticky top-0 z-50 shadow-sm">
                <!-- Logo and Brand -->
                <div class="flex items-center gap-4 text-[#0d141c]">
                    <div class="size-4">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="CodeCraft Logo">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <h1 class="text-[#0d141c] text-lg font-bold leading-tight tracking-[-0.015em]">
                        <a href="/" class="hover:text-[#0c7ff2] transition-colors">CodeCraft</a>
                    </h1>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex flex-1 justify-end gap-8" role="navigation" aria-label="Main navigation">
                    <div class="flex items-center gap-9">
                        <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 rounded-sm" href="index.php">Home</a>
                        <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 rounded-sm" href="products.php">Projects</a>
                        <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 rounded-sm" href="about.php">About</a>
                        <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 rounded-sm" href="contact.php">Contact</a>
                    </div>
                    <div class="flex gap-2">
                        <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] focus:bg-[#0a6fd1] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 transition-colors">
                            <span class="truncate">Signup</span>
                        </button>
                        <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#e7edf4] text-[#0d141c] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#d1dce7] focus:bg-[#d1dce7] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 transition-colors">
                            <span class="truncate">Login</span>
                        </button>
                    </div>
                </nav>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden flex items-center justify-center w-10 h-10 rounded-lg bg-[#e7edf4] text-[#0d141c] hover:bg-[#d1dce7] focus:bg-[#d1dce7] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 transition-colors" 
                        id="mobile-menu-button" 
                        aria-expanded="false" 
                        aria-controls="mobile-menu"
                        aria-label="Toggle mobile menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256" aria-hidden="true">
                        <path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"></path>
                    </svg>
                </button>
            </header>

            <!-- Mobile Navigation Menu -->
            <div class="lg:hidden hidden bg-white border-b border-[#e7edf4] px-4 py-4 shadow-lg" id="mobile-menu" role="navigation" aria-label="Mobile navigation">
                <div class="flex flex-col gap-4">
                    <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] focus:text-[#0c7ff2] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 transition-colors py-2 rounded-sm" href="#home">Home</a>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] focus:text-[#0c7ff2] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 transition-colors py-2 rounded-sm" href="#projects">Projects</a>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] focus:text-[#0c7ff2] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 transition-colors py-2 rounded-sm" href="#about">About</a>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal hover:text-[#0c7ff2] focus:text-[#0c7ff2] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 transition-colors py-2 rounded-sm" href="#contact">Contact</a>
                    <div class="flex flex-col gap-2 pt-4 border-t border-[#e7edf4]">
                        <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] focus:bg-[#0a6fd1] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 transition-colors">
                            <span class="truncate">Signup</span>
                        </button>
                        <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#e7edf4] text-[#0d141c] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#d1dce7] focus:bg-[#d1dce7] focus:outline-none focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 transition-colors">
                            <span class="truncate">Login</span>
                        </button>
                    </div>
                </div>
            </div>

            