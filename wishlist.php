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
  </head>
  <body>
    <div class="relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f2f5] px-10 py-3">
          <div class="flex items-center gap-8">
            <div class="flex items-center gap-4 text-[#111418]">
              <div class="size-4">
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
              <h2 class="text-[#111418] text-lg font-bold leading-tight tracking-[-0.015em]">CodeCraft</h2>
            </div>
            <div class="flex items-center gap-9">
              <a class="text-[#111418] text-sm font-medium leading-normal" href="#">Home</a>
              <a class="text-[#111418] text-sm font-medium leading-normal" href="#">Projects</a>
              <a class="text-[#111418] text-sm font-medium leading-normal" href="#">About</a>
              <a class="text-[#111418] text-sm font-medium leading-normal" href="#">Contact</a>
            </div>
          </div>
          <div class="flex flex-1 justify-end gap-8">
            <label class="flex flex-col min-w-40 !h-10 max-w-64">
              <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                <div
                  class="text-[#60758a] flex border-none bg-[#f0f2f5] items-center justify-center pl-4 rounded-l-xl border-r-0"
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
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111418] focus:outline-0 focus:ring-0 border-none bg-[#f0f2f5] focus:border-none h-full placeholder:text-[#60758a] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal"
                  value=""
                />
              </div>
            </label>
            <div class="flex gap-2">
              <button
                class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 bg-[#f0f2f5] text-[#111418] gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5"
              >
                <div class="text-[#111418]" data-icon="Heart" data-size="20px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"
                    ></path>
                  </svg>
                </div>
              </button>
              <button
                class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 bg-[#f0f2f5] text-[#111418] gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5"
              >
                <div class="text-[#111418]" data-icon="ShoppingBag" data-size="20px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M216,40H40A16,16,0,0,0,24,56V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40Zm0,160H40V56H216V200ZM176,88a48,48,0,0,1-96,0,8,8,0,0,1,16,0,32,32,0,0,0,64,0,8,8,0,0,1,16,0Z"
                    ></path>
                  </svg>
                </div>
              </button>
            </div>
            <div
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
              style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBE3IaRDksNwbaNKqrh56-Q9WefC9GboHd029cOA3sWX93X_66pYQGn_quhcEcxNpa7xYI5sGey-6g6uZGrFxfOsY6JzNzOmczIJFv-uomMrKnKD2SiI6Jp_14-1Qg9_BmBh4Vc3gdTBpmUFqjjqhUGmujZg0X6Co60fJ29ov-skhO6b7GlwcrNfAA2bi8nIfNeyLVbh0wsODt4LlQmPjaTC0FQ1lu6s5jGunSzY8o4qozP7Ms6FithGmNIo28YUin-l8GugCtOtlAa");'
            ></div>
          </div>
        </header>
        <div class="px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4"><p class="text-[#111418] tracking-light text-[32px] font-bold leading-tight min-w-72">My Wishlist</p></div>
            <div class="p-4">
              <div class="flex items-stretch justify-between gap-4 rounded-xl">
                <div class="flex flex-[2_2_0px] flex-col gap-4">
                  <div class="flex flex-col gap-1">
                    <p class="text-[#111418] text-base font-bold leading-tight">Project: E-commerce Platform</p>
                    <p class="text-[#60758a] text-sm font-normal leading-normal">
                      A full-featured e-commerce platform with user authentication, product catalog, shopping cart, and payment gateway integration.
                    </p>
                  </div>
                  <button
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-8 px-4 flex-row-reverse bg-[#f0f2f5] text-[#111418] text-sm font-medium leading-normal w-fit"
                  >
                    <span class="truncate">View Details</span>
                  </button>
                </div>
                <div
                  class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl flex-1"
                  style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDXGMNcyilqs-G51NwKAcudNKLgX4Kamvsk43nwMDlpQTGKjbk1XqeVMC63qvSP4gV-uks6J_qLym9K1uECQV1EL3dbONL1aw-MqP__BTSMyDpL4Hsmpr6rVe3xKENj15NiqCttmlOnph5EDX9cJUoM0dcOnUQVRnjO-8o9BpgKy0lZNXIg2WP_OPe8QhOvk8RSFBz3DEh32keafQ4vwg4gFRm_vwkVa2Ekx4D--ab2ftaEe7V3dZp61SGkta34O3-d4ZQVI7NaYnSl");'
                ></div>
              </div>
            </div>
            <div class="flex items-center gap-4 bg-white px-4 min-h-14 justify-between">
              <p class="text-[#111418] text-base font-normal leading-normal flex-1 truncate">Remove from Wishlist</p>
              <div class="shrink-0">
                <div class="text-[#111418] flex size-7 items-center justify-center" data-icon="Trash" data-size="24px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"
                    ></path>
                  </svg>
                </div>
              </div>
            </div>
            <div class="p-4">
              <div class="flex items-stretch justify-between gap-4 rounded-xl">
                <div class="flex flex-[2_2_0px] flex-col gap-4">
                  <div class="flex flex-col gap-1">
                    <p class="text-[#111418] text-base font-bold leading-tight">Project: Social Media Dashboard</p>
                    <p class="text-[#60758a] text-sm font-normal leading-normal">
                      A dashboard to manage multiple social media accounts, schedule posts, and analyze engagement metrics.
                    </p>
                  </div>
                  <button
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-8 px-4 flex-row-reverse bg-[#f0f2f5] text-[#111418] text-sm font-medium leading-normal w-fit"
                  >
                    <span class="truncate">View Details</span>
                  </button>
                </div>
                <div
                  class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl flex-1"
                  style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB7aDdbdB2OAuu7R4MzXByCXtTkX1dU9eH7clRbKVZih82vA_P8a2_jmFNqb7jTXGPKkQDiDGtObDX4vopP86I8AlFBxUXKM_mDcyFcBgeaElpeT7MeM7OIMlTAoc4dNRDKubOcuw-3BI18y-n4uWpjOoU8tu7YjJSQ_bzbAw0XR6WtIuosTcgyp40iXLX30lOa2vA4uhBDeoUF1cQ_Pw1Vuekf9ABJ_v5vSl0SXoSBwm71hC_tvCgAOGn6zInqbo4jv3omNbuMDrjr");'
                ></div>
              </div>
            </div>
            <div class="flex items-center gap-4 bg-white px-4 min-h-14 justify-between">
              <p class="text-[#111418] text-base font-normal leading-normal flex-1 truncate">Remove from Wishlist</p>
              <div class="shrink-0">
                <div class="text-[#111418] flex size-7 items-center justify-center" data-icon="Trash" data-size="24px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"
                    ></path>
                  </svg>
                </div>
              </div>
            </div>
            <div class="p-4">
              <div class="flex items-stretch justify-between gap-4 rounded-xl">
                <div class="flex flex-[2_2_0px] flex-col gap-4">
                  <div class="flex flex-col gap-1">
                    <p class="text-[#111418] text-base font-bold leading-tight">Project: Task Management Application</p>
                    <p class="text-[#60758a] text-sm font-normal leading-normal">
                      A task management application with features like task creation, assignment, prioritization, and progress tracking.
                    </p>
                  </div>
                  <button
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-8 px-4 flex-row-reverse bg-[#f0f2f5] text-[#111418] text-sm font-medium leading-normal w-fit"
                  >
                    <span class="truncate">View Details</span>
                  </button>
                </div>
                <div
                  class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl flex-1"
                  style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD1zeh2rV_vANXeEXPk9VrnAZVu3fTqHa0LpkpscnbC0S3HrkPye92qTojQaBYFSnZTqSa3MvaIjYRLKyrbENemKjpgsdZYH322q_6YY-dvzTPZ5ChtwSZq51Jf5yTHC9yCNg7zrShOS5txuHvmgDrnby8zJ7xjLk2m-w_otNMcWAZ4X9N87ETaEb2m8OzOyFvs2NqLMm9UwOE5jQXc6WDkuoVVNP9ckTGAeHkago7m4skCq9evkYN25rBKSK5Q-gBqjD4UOwiBkDew");'
                ></div>
              </div>
            </div>
            <div class="flex items-center gap-4 bg-white px-4 min-h-14 justify-between">
              <p class="text-[#111418] text-base font-normal leading-normal flex-1 truncate">Remove from Wishlist</p>
              <div class="shrink-0">
                <div class="text-[#111418] flex size-7 items-center justify-center" data-icon="Trash" data-size="24px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"
                    ></path>
                  </svg>
                </div>
              </div>
            </div>
            <div class="p-4">
              <div class="flex items-stretch justify-between gap-4 rounded-xl">
                <div class="flex flex-[2_2_0px] flex-col gap-4">
                  <div class="flex flex-col gap-1">
                    <p class="text-[#111418] text-base font-bold leading-tight">Project: Blog Platform</p>
                    <p class="text-[#60758a] text-sm font-normal leading-normal">
                      A blogging platform with user authentication, post creation, commenting, and category management.
                    </p>
                  </div>
                  <button
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-8 px-4 flex-row-reverse bg-[#f0f2f5] text-[#111418] text-sm font-medium leading-normal w-fit"
                  >
                    <span class="truncate">View Details</span>
                  </button>
                </div>
                <div
                  class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl flex-1"
                  style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAOP5NyP2JaJrPNfM_7FlTWK-8A_w5E3OHROMv2begJ_JgADb8I6I9I4YLyRT_uo3HusIpO1QCnqRNpkmsMZ-JCpKA6s8TtMm9oD9lhUYJA6NdBg5m7nC8RI1Plg5I35LBiUCzipYF8DcxXhvJXNBlYTQd8uurGgLLn_TG8LpwzjZGSenT-UPzG05SLhV0ZoTSr5FDm7ufe5YQ8bNADFoEYGANLML_PE3BH-4ObIfEWViRtPyOH0eTsfuIZAxLGJENU3YFjCjd76Rqj");'
                ></div>
              </div>
            </div>
            <div class="flex items-center gap-4 bg-white px-4 min-h-14 justify-between">
              <p class="text-[#111418] text-base font-normal leading-normal flex-1 truncate">Remove from Wishlist</p>
              <div class="shrink-0">
                <div class="text-[#111418] flex size-7 items-center justify-center" data-icon="Trash" data-size="24px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"
                    ></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
