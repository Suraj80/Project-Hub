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
    
    <!-- <div class="relative flex size-full min-h-screen flex-col bg-slate-50 group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e7edf4] px-10 py-3">
          <div class="flex items-center gap-4 text-[#0d141c]">
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
            <h2 class="text-[#0d141c] text-lg font-bold leading-tight tracking-[-0.015em]">CodeCraft</h2>
          </div>
          <div class="flex flex-1 justify-end gap-8">
            <div class="flex items-center gap-9">
              <a class="text-[#0d141c] text-sm font-medium leading-normal" href="#">Projects</a>
              <a class="text-[#0d141c] text-sm font-medium leading-normal" href="#">About</a>
              <a class="text-[#0d141c] text-sm font-medium leading-normal" href="#">Contact</a>
            </div>
            <button
              class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em]"
            >
              <span class="truncate">Get Started</span>
            </button>
          </div>
        </header> -->

        <?php
        include 'header.php'; ?>


        <div class="px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4"><p class="text-[#0d141c] tracking-light text-[32px] font-bold leading-tight min-w-72">About CodeCraft</p></div>
            <p class="text-[#0d141c] text-base font-normal leading-normal pb-3 pt-1 px-4">
              CodeCraft is dedicated to providing high-quality computer science projects to students. Our mission is to help students excel in their studies by offering
              well-documented, ready-to-use projects that cover a wide range of topics, from basic programming to advanced algorithms and data structures.
            </p>
            <h2 class="text-[#0d141c] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Why Choose CodeCraft?</h2>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
              <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-4 flex-col">
                <div class="text-[#0d141c]" data-icon="Code" data-size="24px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M69.12,94.15,28.5,128l40.62,33.85a8,8,0,1,1-10.24,12.29l-48-40a8,8,0,0,1,0-12.29l48-40a8,8,0,0,1,10.24,12.3Zm176,27.7-48-40a8,8,0,1,0-10.24,12.3L227.5,128l-40.62,33.85a8,8,0,1,0,10.24,12.29l48-40a8,8,0,0,0,0-12.29ZM162.73,32.48a8,8,0,0,0-10.25,4.79l-64,176a8,8,0,0,0,4.79,10.26A8.14,8.14,0,0,0,96,224a8,8,0,0,0,7.52-5.27l64-176A8,8,0,0,0,162.73,32.48Z"
                    ></path>
                  </svg>
                </div>
                <div class="flex flex-col gap-1">
                  <h2 class="text-[#0d141c] text-base font-bold leading-tight">Quality Projects</h2>
                  <p class="text-[#49739c] text-sm font-normal leading-normal">
                    Our projects are meticulously crafted by experienced developers and educators, ensuring they meet the highest standards of quality and relevance.
                  </p>
                </div>
              </div>
              <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-4 flex-col">
                <div class="text-[#0d141c]" data-icon="FileDoc" data-size="24px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M52,144H36a8,8,0,0,0-8,8v56a8,8,0,0,0,8,8H52a36,36,0,0,0,0-72Zm0,56H44V160h8a20,20,0,0,1,0,40Zm169.53-4.91a8,8,0,0,1,.25,11.31A30.06,30.06,0,0,1,200,216c-17.65,0-32-16.15-32-36s14.35-36,32-36a30.06,30.06,0,0,1,21.78,9.6,8,8,0,0,1-11.56,11.06A14.24,14.24,0,0,0,200,160c-8.82,0-16,9-16,20s7.18,20,16,20a14.24,14.24,0,0,0,10.22-4.66A8,8,0,0,1,221.53,195.09ZM128,144c-17.65,0-32,16.15-32,36s14.35,36,32,36,32-16.15,32-36S145.65,144,128,144Zm0,56c-8.82,0-16-9-16-20s7.18-20,16-20,16,9,16,20S136.82,200,128,200ZM48,120a8,8,0,0,0,8-8V40h88V88a8,8,0,0,0,8,8h48v16a8,8,0,0,0,16,0V88a8,8,0,0,0-2.34-5.66l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40v72A8,8,0,0,0,48,120ZM160,51.31,188.69,80H160Z"
                    ></path>
                  </svg>
                </div>
                <div class="flex flex-col gap-1">
                  <h2 class="text-[#0d141c] text-base font-bold leading-tight">Comprehensive Documentation</h2>
                  <p class="text-[#49739c] text-sm font-normal leading-normal">
                    Each project comes with detailed documentation, including setup instructions, code explanations, and usage examples, making it easy for students to understand
                    and implement.
                  </p>
                </div>
              </div>
              <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-4 flex-col">
                <div class="text-[#0d141c]" data-icon="UsersThree" data-size="24px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"
                    ></path>
                  </svg>
                </div>
                <div class="flex flex-col gap-1">
                  <h2 class="text-[#0d141c] text-base font-bold leading-tight">Expert Support</h2>
                  <p class="text-[#49739c] text-sm font-normal leading-normal">
                    We offer dedicated support to assist students with any questions or issues they may encounter while working on our projects.
                  </p>
                </div>
              </div>
            </div>
            <h2 class="text-[#0d141c] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Our Team</h2>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
              <div class="flex flex-col gap-3 text-center pb-3">
                <div class="px-4">
                  <div
                    class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-full"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAyMEnSwYP0KsbUpvEbgQ1QSAYqCb2fgpDK_5p5tQ-VxfZT3QUEC8lAkKmXMddi1s3kJoOh0ykvSGij-TM3CZG6w5YvInpw__zun__EKyj_dTuzV_xrdjhD3HAdCUEzATr-9e4LBmcVlaUj3U25uiGHyYTrSZgvb8TzEgyTNSICZ4gQyp3PviIEvCEejTKvXwk2VPjdTQhD02AANuftKQc0wXCGhqpbO6nyDbloEpibRu2N4-krOBKMX04KZH_DbLAkkdMdsBBQSU4");'
                  ></div>
                </div>
                <div>
                  <p class="text-[#0d141c] text-base font-medium leading-normal">Sophia Chen</p>
                  <p class="text-[#49739c] text-sm font-normal leading-normal">Lead Developer</p>
                </div>
              </div>
              <div class="flex flex-col gap-3 text-center pb-3">
                <div class="px-4">
                  <div
                    class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-full"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAVXkUbriOtbK5j3zrBRTk5UrzckkFv-K8jY-U8AAhBKQr0FZJIxyYUZ57PikKGT49Xh32h4T-4L4A8hME2VJL2GfkXYyOs57bQD17EfPrlwyoWWz1Txt70T5FdXClfdpHWL8-UnZVm6mMnzcC-bmWSXTsUD-12GBH-56salJP3eyga97a_nNIxXf2JYMLoLAKw7hV53jLSFfa7ZVbBlmYxMdVldae1aZ7a1BvIgkhSsRe21XIBG3gX0vlc655Xq55exCpir6JI5sk");'
                  ></div>
                </div>
                <div>
                  <p class="text-[#0d141c] text-base font-medium leading-normal">Ethan Ramirez</p>
                  <p class="text-[#49739c] text-sm font-normal leading-normal">Project Manager</p>
                </div>
              </div>
              <div class="flex flex-col gap-3 text-center pb-3">
                <div class="px-4">
                  <div
                    class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-full"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC2WlZV_SoxaHO_N_OFCeI_MdcpMIxRKWlAAbyNfbrcls2ihlniwNZh6HuocTv_LXP8FIOmUEtQHgQ-qW9M-LuqqxdZj_28YDvawV7q07aSxS5eIH7kccxqQi79bd0rAPVet32mjVyFfNRlW0tmDuh7S0O28IK8OfokNTwyaaHmie4wUpSbqdw3K0BiZDoQoR1NADZoUKXWRCqNMInP4QP3V7uINfT3cUYk1g89531GI1Gmo2QVtVATX-R8huboqp5wlxLxJoqJMKk");'
                  ></div>
                </div>
                <div>
                  <p class="text-[#0d141c] text-base font-medium leading-normal">Olivia Patel</p>
                  <p class="text-[#49739c] text-sm font-normal leading-normal">Support Specialist</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
        include 'footer.php'; ?>

      </div>
    </div>
  </body>
</html>
