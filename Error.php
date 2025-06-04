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
        
      <!-- Header -->
       <?php  include 'header.php'; ?>


        <div class="px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-col px-4 py-6">
              <div class="flex flex-col items-center gap-6">
                <div
                  class="bg-center bg-no-repeat aspect-video bg-cover rounded-xl w-full max-w-[360px]"
                  style='background-image: url("assets/images/error.jpg");'
                ></div>
                <div class="flex max-w-[480px] flex-col items-center gap-2">
                  <p class="text-[#121416] text-lg font-bold leading-tight tracking-[-0.015em] max-w-[480px] text-center">Oops! Page not found</p>
                  <p class="text-[#121416] text-sm font-normal leading-normal max-w-[480px] text-center">
                    We couldn't find the page you were looking for. Please check the URL or return to the homepage.
                  </p>
                </div>
                <button
                  class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-[#f1f2f4] text-[#121416] text-sm font-bold leading-normal tracking-[0.015em]"
                >
                  <span class="truncate">Go to Homepage</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
