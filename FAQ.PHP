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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      /* Custom CSS for very small screens like 394×498 */
      @media (max-width: 420px) {
        .mobile-container {
          padding-left: 8px !important;
          padding-right: 8px !important;
        }
        .mobile-content {
          padding: 8px !important;
        }
        .mobile-title {
          font-size: 20px !important;
          line-height: 1.3 !important;
          margin-bottom: 16px !important;
        }
        .mobile-faq-item {
          padding: 8px 12px !important;
          margin-bottom: 12px !important;
        }
        .mobile-question {
          font-size: 14px !important;
          line-height: 1.4 !important;
          padding-right: 8px !important;
        }
        .mobile-answer {
          font-size: 13px !important;
          line-height: 1.5 !important;
          padding-bottom: 8px !important;
        }
        .mobile-icon {
          width: 18px !important;
          height: 18px !important;
        }
      }
      
      /* Additional mobile optimizations */
      @media (max-width: 480px) {
        body {
          overflow-x: hidden;
        }
        .layout-container {
          min-width: 100%;
        }
      }
    </style>
  </head>
  <body>
    <div class="relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden" style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
      <div class="layout-container flex h-full grow flex-col">
        
      <!-- Header  -->
       <?php include 'header.php'; ?>

       
        <div class="mobile-container px-4 sm:px-6 md:px-8 lg:px-16 xl:px-40 flex flex-1 justify-center py-3 sm:py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1 w-full">
            <div class="flex flex-wrap justify-between gap-2 sm:gap-3 mobile-content p-2 sm:p-4">
              <p class="mobile-title text-[#121416] tracking-light text-xl sm:text-2xl md:text-[32px] font-bold leading-tight min-w-0 w-full sm:min-w-72">Frequently Asked Questions</p>
            </div>
            <div class="flex flex-col mobile-content p-2 sm:p-4 gap-2 sm:gap-3">
              
              <details class="mobile-faq-item flex flex-col rounded-xl border border-[#dde0e3] bg-white px-3 sm:px-[15px] py-2 sm:py-[7px] group" open="">
                <summary class="flex cursor-pointer items-start sm:items-center justify-between gap-3 sm:gap-6 py-2">
                  <p class="mobile-question text-[#121416] text-sm font-medium leading-normal flex-1 pr-2">What types of projects do you offer?</p>
                  <div class="mobile-icon text-[#121416] group-open:rotate-180 flex-shrink-0 mt-1 sm:mt-0" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                    </svg>
                  </div>
                </summary>
                <p class="mobile-answer text-[#6a7581] text-sm font-normal leading-normal pb-2">
                  We specialize in providing final year computer science projects. Our collection includes a wide range of web-based applications, machine learning (ML) projects, and other cutting-edge software solutions tailored for academic submission.
                </p>
              </details>
              
              <details class="mobile-faq-item flex flex-col rounded-xl border border-[#dde0e3] bg-white px-3 sm:px-[15px] py-2 sm:py-[7px] group">
                <summary class="flex cursor-pointer items-start sm:items-center justify-between gap-3 sm:gap-6 py-2">
                  <p class="mobile-question text-[#121416] text-sm font-medium leading-normal flex-1 pr-2">How do I purchase a project?</p>
                  <div class="mobile-icon text-[#121416] group-open:rotate-180 flex-shrink-0 mt-1 sm:mt-0" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                    </svg>
                  </div>
                </summary>
                <p class="mobile-answer text-[#6a7581] text-sm font-normal leading-normal pb-2">
                  To purchase a project, simply browse our collection, choose the one you want, and click the Buy Now or Order button. Complete the payment process, and you'll receive a download link instantly. If you've opted for Cash on Delivery, we will ship a pen drive containing the project to your address.
                </p>
              </details>
              
              <details class="mobile-faq-item flex flex-col rounded-xl border border-[#dde0e3] bg-white px-3 sm:px-[15px] py-2 sm:py-[7px] group">
                <summary class="flex cursor-pointer items-start sm:items-center justify-between gap-3 sm:gap-6 py-2">
                  <p class="mobile-question text-[#121416] text-sm font-medium leading-normal flex-1 pr-2">Are the projects customizable?</p>
                  <div class="mobile-icon text-[#121416] group-open:rotate-180 flex-shrink-0 mt-1 sm:mt-0" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                    </svg>
                  </div>
                </summary>
                <p class="mobile-answer text-[#6a7581] text-sm font-normal leading-normal pb-2">
                   No, as of now, we do not provide customization services. We offer ready-made projects that are complete and ready for submission. However, after purchasing, you are free to make any changes or modifications to the project on your own to better suit your needs.
                </p>
              </details>
              
              <details class="mobile-faq-item flex flex-col rounded-xl border border-[#dde0e3] bg-white px-3 sm:px-[15px] py-2 sm:py-[7px] group">
                <summary class="flex cursor-pointer items-start sm:items-center justify-between gap-3 sm:gap-6 py-2">
                  <p class="mobile-question text-[#121416] text-sm font-medium leading-normal flex-1 pr-2">What payment methods do you accept?</p>
                  <div class="mobile-icon text-[#121416] group-open:rotate-180 flex-shrink-0 mt-1 sm:mt-0" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                    </svg>
                  </div>
                </summary>
                <p class="mobile-answer text-[#6a7581] text-sm font-normal leading-normal pb-2">
                 We've integrated Razorpay as our secure payment gateway, which supports various methods including credit/debit cards, UPI, net banking, and popular wallets. Additionally, we also offer a Cash on Delivery (COD) option, where the project will be shipped to you in a pen drive.
                </p>
              </details>
              
              <details class="mobile-faq-item flex flex-col rounded-xl border border-[#dde0e3] bg-white px-3 sm:px-[15px] py-2 sm:py-[7px] group">
                <summary class="flex cursor-pointer items-start sm:items-center justify-between gap-3 sm:gap-6 py-2">
                  <p class="mobile-question text-[#121416] text-sm font-medium leading-normal flex-1 pr-2">What is your refund policy?</p>
                  <div class="mobile-icon text-[#121416] group-open:rotate-180 flex-shrink-0 mt-1 sm:mt-0" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                    </svg>
                  </div>
                </summary>
                <p class="mobile-answer text-[#6a7581] text-sm font-normal leading-normal pb-2">
                 No, we do not offer refunds. Due to the digital nature of our products, all sales are final once the project is delivered.
                </p>
              </details>

              <details class="mobile-faq-item flex flex-col rounded-xl border border-[#dde0e3] bg-white px-3 sm:px-[15px] py-2 sm:py-[7px] group">
                <summary class="flex cursor-pointer items-start sm:items-center justify-between gap-3 sm:gap-6 py-2">
                  <p class="mobile-question text-[#121416] text-sm font-medium leading-normal flex-1 pr-2">Can I resell or share the project with others after purchasing it?</p>
                  <div class="mobile-icon text-[#121416] group-open:rotate-180 flex-shrink-0 mt-1 sm:mt-0" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,.32,11.32Z"></path>
                    </svg>
                  </div>
                </summary>
                <p class="mobile-answer text-[#6a7581] text-sm font-normal leading-normal pb-2">
                 No, you are not allowed to resell or redistribute the project. Doing so is strictly against our policy and may result in legal action.
                </p>
              </details>

              <details class="mobile-faq-item flex flex-col rounded-xl border border-[#dde0e3] bg-white px-3 sm:px-[15px] py-2 sm:py-[7px] group">
                <summary class="flex cursor-pointer items-start sm:items-center justify-between gap-3 sm:gap-6 py-2">
                  <p class="mobile-question text-[#121416] text-sm font-medium leading-normal flex-1 pr-2">Do you offer any support if I face issues understanding or running the project?</p>
                  <div class="mobile-icon text-[#121416] group-open:rotate-180 flex-shrink-0 mt-1 sm:mt-0" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                    </svg>
                  </div>
                </summary>
                <p class="mobile-answer text-[#6a7581] text-sm font-normal leading-normal pb-2">
                 Yes, if you face any issues with running the project, you can contact us via email, and we'll assist you. However, we do not offer support for project customization or changes.
                </p>
              </details>

              <details class="mobile-faq-item flex flex-col rounded-xl border border-[#dde0e3] bg-white px-3 sm:px-[15px] py-2 sm:py-[7px] group">
                <summary class="flex cursor-pointer items-start sm:items-center justify-between gap-3 sm:gap-6 py-2">
                  <p class="mobile-question text-[#121416] text-sm font-medium leading-normal flex-1 pr-2">How will I receive the project after purchase?</p>
                  <div class="mobile-icon text-[#121416] group-open:rotate-180 flex-shrink-0 mt-1 sm:mt-0" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                    </svg>
                  </div>
                </summary>
                <p class="mobile-answer text-[#6a7581] text-sm font-normal leading-normal pb-2">
                 After your payment is confirmed, you will receive a secure download link to access and download the complete project files instantly.
                </p>
              </details>

            </div>
          </div>
        </div>
        <?php include 'footer.php'; ?>

          </div>
        </footer>
      </div>
    </div>
  </body>
</html>