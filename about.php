<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Space+Grotesk%3Awght%40400%3B500%3B700"
    />
    
    <title>About - CodeCraft</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
      /* Custom responsive utilities */
      @media (max-width: 640px) {
        .mobile-grid {
          grid-template-columns: 1fr;
        }
        .mobile-text-center {
          text-align: center;
        }
      }
      
      @media (min-width: 641px) and (max-width: 1024px) {
        .tablet-grid-2 {
          grid-template-columns: repeat(2, 1fr);
        }
      }
      
      /* Ensure images are responsive */
      .team-image {
        width: 100%;
        height: auto;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 50%;
      }
      
      /* Smooth transitions for responsive changes */
      * {
        transition: all 0.3s ease;
      }
    </style>
  </head>
  <body>
    
    <div class="relative flex size-full min-h-screen flex-col bg-slate-50 group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
      <div class="layout-container flex h-full grow flex-col">

        <!-- Header placeholder - replace with your actual header -->
        <?php
        include 'header.php'; // Include your header file here
        ?>

        <!-- Main content with responsive padding -->
        <div class="px-4 sm:px-6 lg:px-8 xl:px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1 w-full">
            
            <!-- Page title - responsive text sizing -->
            <div class="flex flex-wrap justify-between gap-3 p-2 sm:p-4">
              <h1 class="text-[#0d141c] tracking-light text-2xl sm:text-3xl lg:text-[32px] font-bold leading-tight min-w-0 w-full sm:min-w-72">
                About CodeCraft
              </h1>
            </div>
            
            <!-- Main description with responsive padding -->
            <p class="text-[#0d141c] text-sm sm:text-base font-normal leading-normal pb-3 pt-1 px-2 sm:px-4">
              CodeCraft is dedicated to providing high-quality computer science projects to students. Our mission is to help students excel in their studies by offering
              well-documented, ready-to-use projects that cover a wide range of topics, from basic programming to advanced algorithms and data structures.
            </p>
            
            <!-- Why Choose section with responsive heading -->
            <h2 class="text-[#0d141c] text-lg sm:text-xl lg:text-[22px] font-bold leading-tight tracking-[-0.015em] px-2 sm:px-4 pb-3 pt-5">
              Why Choose CodeCraft?
            </h2>
            
            <!-- Features grid - fully responsive -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 p-2 sm:p-4">
              
              <!-- Quality Projects card -->
              <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-3 sm:p-4 flex-col hover:shadow-md transition-shadow">
                <div class="text-[#0d141c] flex-shrink-0" data-icon="Code" data-size="24px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M69.12,94.15,28.5,128l40.62,33.85a8,8,0,1,1-10.24,12.29l-48-40a8,8,0,0,1,0-12.29l48-40a8,8,0,0,1,10.24,12.3Zm176,27.7-48-40a8,8,0,1,0-10.24,12.3L227.5,128l-40.62,33.85a8,8,0,1,0,10.24,12.29l48-40a8,8,0,0,0,0-12.29ZM162.73,32.48a8,8,0,0,0-10.25,4.79l-64,176a8,8,0,0,0,4.79,10.26A8.14,8.14,0,0,0,96,224a8,8,0,0,0,7.52-5.27l64-176A8,8,0,0,0,162.73,32.48Z"
                    ></path>
                  </svg>
                </div>
                <div class="flex flex-col gap-1">
                  <h3 class="text-[#0d141c] text-sm sm:text-base font-bold leading-tight">Quality Projects</h3>
                  <p class="text-[#49739c] text-xs sm:text-sm font-normal leading-normal">
                    Our projects are meticulously crafted by experienced developers and educators, ensuring they meet the highest standards of quality and relevance.
                  </p>
                </div>
              </div>
              
              <!-- Documentation card -->
              <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-3 sm:p-4 flex-col hover:shadow-md transition-shadow">
                <div class="text-[#0d141c] flex-shrink-0" data-icon="FileDoc" data-size="24px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M52,144H36a8,8,0,0,0-8,8v56a8,8,0,0,0,8,8H52a36,36,0,0,0,0-72Zm0,56H44V160h8a20,20,0,0,1,0,40Zm169.53-4.91a8,8,0,0,1,.25,11.31A30.06,30.06,0,0,1,200,216c-17.65,0-32-16.15-32-36s14.35-36,32-36a30.06,30.06,0,0,1,21.78,9.6,8,8,0,0,1-11.56,11.06A14.24,14.24,0,0,0,200,160c-8.82,0-16,9-16,20s7.18,20,16,20a14.24,14.24,0,0,0,10.22-4.66A8,8,0,0,1,221.53,195.09ZM128,144c-17.65,0-32,16.15-32,36s14.35,36,32,36,32-16.15,32-36S145.65,144,128,144Zm0,56c-8.82,0-16-9-16-20s7.18-20,16-20,16,9,16,20S136.82,200,128,200ZM48,120a8,8,0,0,0,8-8V40h88V88a8,8,0,0,0,8,8h48v16a8,8,0,0,0,16,0V88a8,8,0,0,0-2.34-5.66l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40v72A8,8,0,0,0,48,120ZM160,51.31,188.69,80H160Z"
                    ></path>
                  </svg>
                </div>
                <div class="flex flex-col gap-1">
                  <h3 class="text-[#0d141c] text-sm sm:text-base font-bold leading-tight">Comprehensive Documentation</h3>
                  <p class="text-[#49739c] text-xs sm:text-sm font-normal leading-normal">
                    Each project comes with detailed documentation, including setup instructions, code explanations, and usage examples, making it easy for students to understand and implement.
                  </p>
                </div>
              </div>
              
              <!-- Expert Support card -->
              <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-3 sm:p-4 flex-col hover:shadow-md transition-shadow md:col-span-2 lg:col-span-1">
                <div class="text-[#0d141c] flex-shrink-0" data-icon="UsersThree" data-size="24px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"
                    ></path>
                  </svg>
                </div>
                <div class="flex flex-col gap-1">
                  <h3 class="text-[#0d141c] text-sm sm:text-base font-bold leading-tight">Expert Support</h3>
                  <p class="text-[#49739c] text-xs sm:text-sm font-normal leading-normal">
                    We offer dedicated support to assist students with any questions or issues they may encounter while working on our projects.
                  </p>
                </div>
              </div>
            </div>
            
            <!-- Our Team section -->
            <h2 class="text-[#0d141c] text-lg sm:text-xl lg:text-[22px] font-bold leading-tight tracking-[-0.015em] px-2 sm:px-4 pb-3 pt-5">
              Our Team
            </h2>
            
            <!-- Team grid - responsive layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 p-2 sm:p-4">
              
              <!-- Team member 1 -->
              <div class="flex flex-col gap-3 text-center pb-3 hover:transform hover:scale-105 transition-transform">
                <div class="px-2 sm:px-4">
                  <div class="w-24 h-24 sm:w-32 sm:h-32 lg:w-full lg:h-auto mx-auto bg-center bg-no-repeat aspect-square bg-cover rounded-full border-4 border-white shadow-lg"
                    style='background-image: url("https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80");'>
                  </div>
                </div>
                <div>
                  <p class="text-[#0d141c] text-sm sm:text-base font-medium leading-normal">Sophia Chen</p>
                  <p class="text-[#49739c] text-xs sm:text-sm font-normal leading-normal">Lead Developer</p>
                </div>
              </div>
              
              <!-- Team member 2 -->
              <div class="flex flex-col gap-3 text-center pb-3 hover:transform hover:scale-105 transition-transform">
                <div class="px-2 sm:px-4">
                  <div class="w-24 h-24 sm:w-32 sm:h-32 lg:w-full lg:h-auto mx-auto bg-center bg-no-repeat aspect-square bg-cover rounded-full border-4 border-white shadow-lg"
                    style='background-image: url("https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80");'>
                  </div>
                </div>
                <div>
                  <p class="text-[#0d141c] text-sm sm:text-base font-medium leading-normal">Ethan Ramirez</p>
                  <p class="text-[#49739c] text-xs sm:text-sm font-normal leading-normal">Project Manager</p>
                </div>
              </div>
              
              <!-- Team member 3 -->
              <div class="flex flex-col gap-3 text-center pb-3 hover:transform hover:scale-105 transition-transform sm:col-span-2 lg:col-span-1">
                <div class="px-2 sm:px-4">
                  <div class="w-24 h-24 sm:w-32 sm:h-32 lg:w-full lg:h-auto mx-auto bg-center bg-no-repeat aspect-square bg-cover rounded-full border-4 border-white shadow-lg"
                    style='background-image: url("https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80");'>
                  </div>
                </div>
                <div>
                  <p class="text-[#0d141c] text-sm sm:text-base font-medium leading-normal">Olivia Patel</p>
                  <p class="text-[#49739c] text-xs sm:text-sm font-normal leading-normal">Support Specialist</p>
                </div>
              </div>
            </div>
            
          </div>
        </div>

        <!-- Footer placeholder - replace with your actual footer -->
        <?php
        include 'footer.php'; // Include your footer file here   
        ?>

      </div>
    </div>
  </body>
</html>