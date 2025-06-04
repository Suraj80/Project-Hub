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
          <div class="flex flex-1 justify-end gap-8">
            <div class="flex items-center gap-9">
              <a class="text-[#111418] text-sm font-medium leading-normal" href="#">Projects</a>
              <a class="text-[#111418] text-sm font-medium leading-normal" href="#">Tutorials</a>
              <a class="text-[#111418] text-sm font-medium leading-normal" href="#">Community</a>
              <a class="text-[#111418] text-sm font-medium leading-normal" href="#">About</a>
            </div>
            <button
              class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-[#f0f2f5] text-[#111418] text-sm font-bold leading-normal tracking-[0.015em]"
            >
              <span class="truncate">Sign in</span>
            </button>
          </div>
        </header>
        <div class="px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4"><p class="text-[#111418] tracking-light text-[32px] font-bold leading-tight min-w-72">Privacy Policy</p></div>
            <h3 class="text-[#111418] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">What Data We Collect</h3>
            <p class="text-[#111418] text-base font-normal leading-normal pb-3 pt-1 px-4">
              We collect information you provide directly to us, such as when you create an account, purchase a project, or contact us for support. This may include your name,
              email address, payment information, and project preferences. We also collect data automatically, such as your IP address, browser type, and usage patterns on our
              site, to improve our services and personalize your experience.
            </p>
            <h3 class="text-[#111418] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">How We Use Your Information</h3>
            <p class="text-[#111418] text-base font-normal leading-normal pb-3 pt-1 px-4">
              We use the information we collect to provide, maintain, and improve our services, process transactions, communicate with you, and personalize your experience. This
              includes sending you project updates, promotional materials, and responding to your inquiries. We may also use your data for analytics and research purposes to
              understand user behavior and optimize our platform.
            </p>
            <h3 class="text-[#111418] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Your Rights</h3>
            <p class="text-[#111418] text-base font-normal leading-normal pb-3 pt-1 px-4">
              You have the right to access, correct, or delete your personal information. You can manage your account settings or contact us directly to exercise these rights. We
              will respond to your requests within a reasonable timeframe. You also have the right to opt-out of receiving promotional communications from us at any time.
            </p>
          </div>
        </div>
        <footer class="flex justify-center">
          <div class="flex max-w-[960px] flex-1 flex-col">
            <footer class="flex flex-col gap-6 px-5 py-10 text-center @container">
              <div class="flex flex-wrap items-center justify-center gap-6 @[480px]:flex-row @[480px]:justify-around">
                <a class="text-[#60758a] text-base font-normal leading-normal min-w-40" href="#">Terms of Service</a>
                <a class="text-[#60758a] text-base font-normal leading-normal min-w-40" href="#">Privacy Policy</a>
                <a class="text-[#60758a] text-base font-normal leading-normal min-w-40" href="#">Contact Us</a>
              </div>
              <p class="text-[#60758a] text-base font-normal leading-normal">© 2023 CodeCraft. All rights reserved.</p>
            </footer>
          </div>
        </footer>
      </div>
    </div>
  </body>
</html>
