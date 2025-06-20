<?php
session_start();
 include 'header2.php';
?>

<!DOCTYPE html>
<html lang="en">
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
    <title>CodeCraft - Ready-to-Use Computer Science Projects</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'sans': ['Inter', 'system-ui', 'sans-serif'],
            'mono': ['JetBrains Mono', 'monospace'],
          },
          colors: {
            primary: {
              300: '#93c5fd',
              400: '#60a5fa',
              600: '#2563eb',
              700: '#1d4ed8',
            },
            accent: {
              300: '#7dd3fc',
              400: '#38bdf8',
              600: '#0369a1',
            },
            dark: {
              900: '#0f172a'
            }
          },
          animation: {
            'fade-in': 'fadeIn 0.5s ease-in-out',
            'slide-up': 'slideUp 0.6s ease-out',
            'slide-in-right': 'slideInRight 1s ease-out both',
            'float': 'float 6s ease-in-out infinite',
            'glow': 'glow 2s ease-in-out infinite alternate',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            slideUp: {
              '0%': { opacity: '0', transform: 'translateY(30px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            slideInRight: {
              '0%': { opacity: '0', transform: 'translateX(50px)' },
              '100%': { opacity: '1', transform: 'translateX(0)' },
            },
            float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-20px)' },
            },
            glow: {
              '0%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
              '100%': { boxShadow: '0 0 30px rgba(59, 130, 246, 0.8)' },
            }
          }
        }
      }
    }
  </script>

  <style>
    .glass-effect {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .typewriter {
      overflow: hidden;
      border-right: 0.15em solid white;
      white-space: nowrap;
      margin: 0 auto;
      animation:
        typing 3s steps(50, end),
        blink-caret 0.75s step-end infinite;
      width: 100%;
    }

    @keyframes typing {
      from { width: 0 }
      to { width: 100% }
    }

    @keyframes blink-caret {
      from, to { border-color: transparent }
      50% { border-color: white }
    }
  </style>
</head>

<body class="bg-dark-900 text-white font-sans">
    
  <div class="relative min-h-screen overflow-x-hidden">
    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center"
      style='background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6)), url("assets/images/background1.jpg"); background-size: cover; background-position: center;'>

      <!-- Floating Bubbles -->
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-20 h-20 bg-primary-400 rounded-full opacity-20 animate-float"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-accent-400 rounded-full opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-40 left-20 w-24 h-24 bg-primary-300 rounded-full opacity-20 animate-float" style="animation-delay: 4s;"></div>
        <div class="absolute bottom-20 right-10 w-12 h-12 bg-accent-300 rounded-full opacity-20 animate-float" style="animation-delay: 1s;"></div>
      </div>
     
      <!-- Hero Content -->
      <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-slide-up">
          <!-- Code-style header -->
           <br>
          <div class="font-mono text-accent-300 text-sm mb-4">
            <span class="text-primary-400">class</span> <span class="text-white">CodeCraft</span> <span class="text-accent-300">{</span>
          </div>

          <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold mb-6 leading-tight animate-slide-in-right">
            <span class="bg-gradient-to-r from-white to-primary-200 bg-clip-text text-transparent">
              Premium CS Projects
            </span>
            <br>
            <span class="text-accent-300 font-mono text-2xl sm:text-3xl lg:text-4xl">
              for_students()
            </span>
          </h1>

          <p class="text-lg sm:text-xl lg:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto leading-relaxed typewriter">
            Get high-quality, professionally crafted computer science projects. 
            <span class="text-accent-300 font-mono">Instant download</span>, 
            <span class="text-primary-300 font-mono">clean code</span>, 
            <span class="text-accent-300 font-mono">detailed docs</span>.
          </p><br>

          <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8 animate-slide-in-right">
            <button onclick="window.location.href='products2.php'" class="group relative px-8 py-4 bg-primary-600 hover:bg-primary-700 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl animate-glow">
              <span class="relative z-10">Browse Projects</span>
              <div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-accent-600 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </button>

            <button class="group px-8 py-4 bg-transparent border-2 border-white/30 hover:border-white rounded-xl font-semibold text-lg transition-all duration-300 glass-effect hover:bg-white/20">
              <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m-6-8h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2z">
                  </path>
                </svg>
                View Demo
              </span>
            </button>
          </div>

          <!-- Stats -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-2xl mx-auto">
            <div class="text-center">
              <div class="text-2xl font-bold text-accent-300 font-mono">500+</div>
              <div class="text-sm text-gray-300">Projects</div>
            </div>
            <div class="text-center">
              <div class="text-2xl font-bold text-primary-300 font-mono">10k+</div>
              <div class="text-sm text-gray-300">Students</div>
            </div>
            <div class="text-center">
              <div class="text-2xl font-bold text-accent-300 font-mono">4.9★</div>
              <div class="text-sm text-gray-300">Rating</div>
            </div>
            <div class="text-center">
              <div class="text-2xl font-bold text-primary-300 font-mono">24/7</div>
              <div class="text-sm text-gray-300">Support</div>
            </div>
          </div>

          <div class="font-mono text-accent-300 text-sm mt-8">
            <span class="text-accent-300">}</span>
          </div>
        </div>
      </div>

      <!-- Scroll indicator -->
      <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
      </div>
    </section>
  </div>



                    <!-- About Section -->
                    <div class="flex flex-col gap-10 px-4 py-10 @container" id="about">
                        <div class="flex flex-col gap-4 text-center">
                            <h1 class="text-[#0d141c] tracking-light text-2xl sm:text-3xl lg:text-4xl font-bold leading-tight max-w-[720px] mx-auto">
                                Empowering Students with Quality Code
                            </h1>
                            <p class="text-[#0d141c] text-sm sm:text-base font-normal leading-normal max-w-[720px] mx-auto">
                                CodeCraft is your trusted partner in academic success. We provide professionally crafted computer science projects that help students learn, understand, and excel in their coursework. Our mission is to bridge the gap between theoretical knowledge and practical implementation.
                            </p>
                            <div class="flex justify-center mt-6">
                                <button class="flex min-w-[120px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-[#0c7ff2] text-slate-50 text-sm sm:text-base font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] transition-colors">
                                    <span class="truncate">Learn More About Us</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Features Section -->
                    <h2 class="text-[#0d141c] text-xl sm:text-2xl font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Why Choose CodeCraft?</h2>
                    <div class="flex flex-col gap-10 px-4 py-10 @container">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-0">
                            <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-4 sm:p-6 flex-col hover:shadow-lg transition-shadow">
                                <div class="text-[#0c7ff2]" data-icon="Code" data-size="32px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M69.12,94.15,28.5,128l40.62,33.85a8,8,0,1,1-10.24,12.29l-48-40a8,8,0,0,1,0-12.29l48-40a8,8,0,0,1,10.24,12.3Zm176,27.7-48-40a8,8,0,1,0-10.24,12.3L227.5,128l-40.62,33.85a8,8,0,1,0,10.24,12.29l48-40a8,8,0,0,0,0-12.29ZM162.73,32.48a8,8,0,0,0-10.25,4.79l-64,176a8,8,0,0,0,4.79,10.26A8.14,8.14,0,0,0,96,224a8,8,0,0,0,7.52-5.27l64-176A8,8,0,0,0,162.73,32.48Z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h2 class="text-[#0d141c] text-lg font-bold leading-tight">Premium Quality Projects</h2>
                                    <p class="text-[#49739c] text-sm font-normal leading-normal">
                                        Our projects are meticulously crafted by experienced developers with comprehensive documentation, clean code structure, and detailed explanations to help you understand every aspect.
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-4 sm:p-6 flex-col hover:shadow-lg transition-shadow">
                                <div class="text-[#0c7ff2]" data-icon="Money" data-size="32px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M128,88a40,40,0,1,0,40,40A40,40,0,0,0,128,88Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,152ZM240,56H16a8,8,0,0,0-8,8V192a8,8,0,0,0,8,8H240a8,8,0,0,0,8-8V64A8,8,0,0,0,240,56ZM193.65,184H62.35A56.78,56.78,0,0,0,24,145.65v-35.3A56.78,56.78,0,0,0,62.35,72h131.3A56.78,56.78,0,0,0,232,110.35v35.3A56.78,56.78,0,0,0,193.65,184ZM232,93.37A40.81,40.81,0,0,1,210.63,72H232ZM45.37,72A40.81,40.81,0,0,1,24,93.37V72ZM24,162.63A40.81,40.81,0,0,1,45.37,184H24ZM210.63,184A40.81,40.81,0,0,1,232,162.63V184Z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h2 class="text-[#0d141c] text-lg font-bold leading-tight">Student-Friendly Pricing</h2>
                                    <p class="text-[#49739c] text-sm font-normal leading-normal">We offer competitive pricing designed specifically for students, with flexible payment options and bulk discounts to make quality projects accessible to everyone.</p>
                                </div>
                            </div>
                            <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-4 sm:p-6 flex-col hover:shadow-lg transition-shadow">
                                <div class="text-[#0c7ff2]" data-icon="DownloadSimple" data-size="32px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M224,152v56a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V152a8,8,0,0,1,16,0v56H208V152a8,8,0,0,1,16,0Zm-101.66,5.66a8,8,0,0,0,11.32,0l40-40a8,8,0,0,0-11.32-11.32L136,132.69V40a8,8,0,0,0-16,0v92.69L93.66,106.34a8,8,0,0,0-11.32,11.32Z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h2 class="text-[#0d141c] text-lg font-bold leading-tight">Instant Access</h2>
                                    <p class="text-[#49739c] text-sm font-normal leading-normal">Download your chosen project immediately after purchase and start working on it right away. No waiting, no delays - just instant access to quality code.</p>
                                </div>
                            </div>
                            <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-4 sm:p-6 flex-col hover:shadow-lg transition-shadow">
                                <div class="text-[#0c7ff2]" data-icon="Users" data-size="32px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.27,98.63a8,8,0,0,1-11.07,2.22A79.71,79.71,0,0,0,172,184a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.27,206.63Z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h2 class="text-[#0d141c] text-lg font-bold leading-tight">Expert Support</h2>
                                    <p class="text-[#49739c] text-sm font-normal leading-normal">Get dedicated support from our team of experienced developers. We're here to help you understand the code and answer any questions you might have.</p>
                                </div>
                            </div>
                            <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-4 sm:p-6 flex-col hover:shadow-lg transition-shadow">
                                <div class="text-[#0c7ff2]" data-icon="Shield" data-size="32px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M208,40H48A16,16,0,0,0,32,56v58.78c0,89.61,75.82,119.34,91,124.39a15.53,15.53,0,0,0,10,0c15.2-5.05,91-34.78,91-124.39V56A16,16,0,0,0,208,40ZM48,56H208v58.78c0,78.42-63.8,105.1-80,112.05-16.2-6.95-80-33.63-80-112.05Z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h2 class="text-[#0d141c] text-lg font-bold leading-tight">100% Original Code</h2>
                                    <p class="text-[#49739c] text-sm font-normal leading-normal">All our projects are original and plagiarism-free. Each project is carefully crafted to ensure uniqueness and academic integrity.</p>
                                </div>
                            </div>
                            <div class="flex flex-1 gap-3 rounded-lg border border-[#cedbe8] bg-slate-50 p-4 sm:p-6 flex-col hover:shadow-lg transition-shadow">
                                <div class="text-[#0c7ff2]" data-icon="Clock" data-size="32px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h2 class="text-[#0d141c] text-lg font-bold leading-tight">Regular Updates</h2>
                                    <p class="text-[#49739c] text-sm font-normal leading-normal">Our project library is constantly updated with new projects and the latest technologies to keep you ahead of the curve in your studies.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Projects Section -->
                    <div class="flex flex-col gap-10 px-4 py-10 @container" id="projects">
                        <div class="flex flex-col gap-4">
                            <h1 class="text-[#0d141c] tracking-light text-2xl sm:text-3xl lg:text-4xl font-bold leading-tight max-w-[720px]">
                                Featured Projects
                            </h1>
                            <p class="text-[#0d141c] text-sm sm:text-base font-normal leading-normal max-w-[720px]">
                                Explore our most popular computer science projects, carefully selected for their educational value and practical applications.
                            </p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-0">
                            <div class="flex flex-col gap-3 pb-3 rounded-lg border border-[#cedbe8] bg-white hover:shadow-lg transition-shadow">
                                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-t-lg" style='background-image: url("/placeholder.svg?height=200&width=300");'></div>
                                <div class="flex flex-col gap-3 px-4">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-[#0d141c] text-base font-bold leading-tight">E-Commerce Website</h3>
                                        <p class="text-[#49739c] text-sm font-normal leading-normal">Full-stack web application with user authentication, shopping cart, and payment integration using React and Node.js.</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[#0c7ff2] text-lg font-bold">$29.99</span>
                                        <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] transition-colors">
                                            <span class="truncate">View Details</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-3 pb-3 rounded-lg border border-[#cedbe8] bg-white hover:shadow-lg transition-shadow">
                                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-t-lg" style='background-image: url("/placeholder.svg?height=200&width=300");'></div>
                                <div class="flex flex-col gap-3 px-4">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-[#0d141c] text-base font-bold leading-tight">Machine Learning Classifier</h3>
                                        <p class="text-[#49739c] text-sm font-normal leading-normal">Python-based image classification system using TensorFlow and OpenCV with detailed documentation and datasets.</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[#0c7ff2] text-lg font-bold">$39.99</span>
                                        <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] transition-colors">
                                            <span class="truncate">View Details</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-3 pb-3 rounded-lg border border-[#cedbe8] bg-white hover:shadow-lg transition-shadow">
                                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-t-lg" style='background-image: url("/placeholder.svg?height=200&width=300");'></div>
                                <div class="flex flex-col gap-3 px-4">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-[#0d141c] text-base font-bold leading-tight">Mobile Banking App</h3>
                                        <p class="text-[#49739c] text-sm font-normal leading-normal">Cross-platform mobile application built with React Native featuring secure transactions and modern UI design.</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[#0c7ff2] text-lg font-bold">$34.99</span>
                                        <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] transition-colors">
                                            <span class="truncate">View Details</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-3 pb-3 rounded-lg border border-[#cedbe8] bg-white hover:shadow-lg transition-shadow">
                                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-t-lg" style='background-image: url("/placeholder.svg?height=200&width=300");'></div>
                                <div class="flex flex-col gap-3 px-4">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-[#0d141c] text-base font-bold leading-tight">Database Management System</h3>
                                        <p class="text-[#49739c] text-sm font-normal leading-normal">Complete DBMS implementation with SQL queries, stored procedures, and a user-friendly interface using Java and MySQL.</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[#0c7ff2] text-lg font-bold">$24.99</span>
                                        <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] transition-colors">
                                            <span class="truncate">View Details</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-3 pb-3 rounded-lg border border-[#cedbe8] bg-white hover:shadow-lg transition-shadow">
                                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-t-lg" style='background-image: url("/placeholder.svg?height=200&width=300");'></div>
                                <div class="flex flex-col gap-3 px-4">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-[#0d141c] text-base font-bold leading-tight">Blockchain Voting System</h3>
                                        <p class="text-[#49739c] text-sm font-normal leading-normal">Secure and transparent voting application using blockchain technology with smart contracts and web3 integration.</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[#0c7ff2] text-lg font-bold">$49.99</span>
                                        <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] transition-colors">
                                            <span class="truncate">View Details</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-3 pb-3 rounded-lg border border-[#cedbe8] bg-white hover:shadow-lg transition-shadow">
                                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-t-lg" style='background-image: url("/placeholder.svg?height=200&width=300");'></div>
                                <div class="flex flex-col gap-3 px-4">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-[#0d141c] text-base font-bold leading-tight">Game Development Kit</h3>
                                        <p class="text-[#49739c] text-sm font-normal leading-normal">2D game engine with physics simulation, sprite animation, and level editor built using C++ and OpenGL.</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[#0c7ff2] text-lg font-bold">$44.99</span>
                                        <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#0c7ff2] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#0a6fd1] transition-colors">
                                            <span class="truncate">View Details</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <button class="flex min-w-[120px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-[#e7edf4] text-[#0d141c] text-sm sm:text-base font-bold leading-normal tracking-[0.015em] hover:bg-[#d1dce7] transition-colors">
                                <span class="truncate">View All Projects</span>
                            </button>
                        </div>
                    </div>

                    

                    <!-- Customer Testimonials -->
                    <h2 class="text-[#0d141c] text-xl sm:text-2xl font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">What Our Customers Say</h2>
                    <div class="flex flex-col gap-6 sm:gap-8 overflow-x-hidden bg-slate-50 p-4 rounded-lg">
                        <div class="flex flex-col gap-3 bg-slate-50">
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 flex-shrink-0" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDJ2xw_Bt-kTqrGgy80LBGTCHyF1kK_heQOXOS-t9FkWKhE8PNuBbn95oFXKplzCS8JQ5PXbdjjnUCNvOTeTHNoHwtE9gnMxoCMuOoxZfnJ56lafEIL6KBGukmP-9GyzkRWs4XWjh6IxMk_1KheBPzZXnpomWvrfwSBPrCfF7y1y2Ixcc-kCKbFs0mExwUWHdz9vVHOpqDuzEqse10qJ4LzEqI1tLXfoJKck6KkdcAr3eJ6wX3K6hUX38LOUvMYlHLo6UrcyI-xIjo");'></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[#0d141c] text-sm sm:text-base font-medium leading-normal">Ethan Carter</p>
                                    <p class="text-[#49739c] text-xs sm:text-sm font-normal leading-normal">Computer Science Student</p>
                                </div>
                            </div>
                            <div class="flex gap-0.5">
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                            </div>

                            
                            <p class="text-[#0d141c] text-sm sm:text-base font-normal leading-normal">
                                "CodeCraft's projects are a lifesaver! The quality is excellent, and they've helped me understand complex concepts better. The documentation is thorough and the code is clean and well-commented."
                            </p>
                        </div>
                        <div class="flex flex-col gap-3 bg-slate-50">
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 flex-shrink-0" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDF1qJlosCFyaR6XbihwSXn-SB8BlL-ME687ggaO-4aNRQEdGeC1CyuQN85nHAhvpg3lWMdrz7NJISRtfVewnRWmM_6DaUgBXyiiZPpK8BCfc_wKtraAL62J2KLWqqTBt8mOg24Je344HEzI511sjvGYj51kmyazxz6EYWzwVq-35ygq18hHKMsnkX3sMMRKpRsF6FzcrpEi6VaJsgBhNf-LJ03xn6gSiyGwlJVKIyOFjzc0Tt4Q7ks8394CBY9BuwqMd2zl5EE1_8");'></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[#0d141c] text-sm sm:text-base font-medium leading-normal">Sophia Bennett</p>
                                    <p class="text-[#49739c] text-xs sm:text-sm font-normal leading-normal">Software Engineering Student</p>
                                </div>
                            </div>
                            <div class="flex gap-0.5">
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#acc2d8]" data-icon="Star" data-size="20px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M239.2,97.29a16,16,0,0,0-13.81-11L166,81.17,142.72,25.81h0a15.95,15.95,0,0,0-29.44,0L90.07,81.17,30.61,86.32a16,16,0,0,0-9.11,28.06L66.61,153.8,53.09,212.34a16,16,0,0,0,23.84,17.34l51-31,51.11,31a16,16,0,0,0,23.84-17.34l-13.51-58.6,45.1-39.36A16,16,0,0,0,239.2,97.29Zm-15.22,5-45.1,39.36a16,16,0,0,0-5.08,15.71L187.35,216v0l-51.07-31a15.9,15.9,0,0,0-16.54,0l-51,31h0L82.2,157.4a16,16,0,0,0-5.08-15.71L32,102.35a.37.37,0,0,1,0-.09l59.44-5.14a16,16,0,0,0,13.35-9.75L128,32.08l23.2,55.29a16,16,0,0,0,13.35,9.75L224,102.26S224,102.32,224,102.33Z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-[#0d141c] text-sm sm:text-base font-normal leading-normal">"I found exactly what I needed at a great price. The instant download was a huge plus, and the customer support team was very helpful when I had questions."</p>
                        </div>
                        <div class="flex flex-col gap-3 bg-slate-50">
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 flex-shrink-0" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDS3sx8dsRiwAZkyItillmoXONYg8_kHe3mXROTFvc2Sb__VMVMTlkcS3CPp7zADMPGYTfNJKX85esxJD0sQToPILVf7tE6F2mz_Q6hz4meYA30xodpro4pgqhQdFi-RfWbR9AiVo3gTsVTy1HOt59at8zqjgipLIPDICLkPduXHNIP8Wb9eAdokm7QId6AsOxSzIoWC277FOMk5t1wUK97cNdTkMWHMlaoRIildebHmlX0IPzN1fAyEUPtRqhL_XuuNL9-Ne8ul4o");'></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[#0d141c] text-sm sm:text-base font-medium leading-normal">Liam Harper</p>
                                    <p class="text-[#49739c] text-xs sm:text-sm font-normal leading-normal">Data Science Student</p>
                                </div>
                            </div>
                            <div class="flex gap-0.5">
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                                <div class="text-[#0c7ff2]" data-icon="Star" data-size="20px" data-weight="fill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-[#0d141c] text-sm sm:text-base font-normal leading-normal">
                                "The projects are well-documented and easy to follow. Highly recommend for any computer science student. The machine learning projects especially helped me understand complex algorithms."
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Newsletter Section -->
                    <div class="flex flex-col gap-6 px-4 sm:px-6 py-8 sm:py-10 bg-[#0c7ff2] rounded-lg mx-4 my-10">
                        <div class="flex flex-col gap-4 text-center">
                            <h2 class="text-white text-xl sm:text-2xl font-bold leading-tight tracking-[-0.015em]">Stay Updated with CodeCraft</h2>
                            <p class="text-white text-sm sm:text-base font-normal leading-normal max-w-[600px] mx-auto">
                                Subscribe to our newsletter and be the first to know about new projects, special offers, and coding tips that will help you excel in your studies.
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3 max-w-[600px] mx-auto w-full">
                            <input 
                                type="email" 
                                placeholder="Enter your email address" 
                                class="flex-1 h-12 px-4 rounded-lg border border-white/20 bg-white/10 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm sm:text-base"
                                id="newsletter-email"
                            />
                            <button class="flex min-w-[120px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-white text-[#0c7ff2] text-sm sm:text-base font-bold leading-normal tracking-[0.015em] hover:bg-gray-100 transition-colors" id="subscribe-btn">
                                <span class="truncate">Subscribe</span>
                            </button>
                        </div>
                        <p class="text-white/80 text-xs sm:text-sm text-center">
                            No spam, unsubscribe at any time. We respect your privacy.
                        </p>
                    </div>

            <!-- Enhanced Footer -->
            <footer class="bg-[#0d141c] text-white">
                <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-10 py-8 sm:py-12">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                        <!-- Company Info -->
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center gap-3">
                                <div class="size-6 text-[#0c7ff2]">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold">CodeCraft</h3>
                            </div>
                            <p class="text-gray-300 text-sm leading-relaxed">
                                Empowering students with high-quality, ready-to-use computer science projects. Your success is our mission.
                            </p>
                            <!-- Social Media Icons -->
                            <div class="flex gap-4 mt-4">
                                <a href="#" class="text-gray-400 hover:text-[#0c7ff2] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm8,191.63V152h24a8,8,0,0,0,0-16H136V112a16,16,0,0,1,16-16h16a8,8,0,0,0,0-16H152a32,32,0,0,0-32,32v24H96a8,8,0,0,0,0,16h24v63.63a88,88,0,1,1,16,0Z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-[#0c7ff2] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160ZM176,24H80A56.06,56.06,0,0,0,24,80v96a56.06,56.06,0,0,0,56,56h96a56.06,56.06,0,0,0,56-56V80A56.06,56.06,0,0,0,176,24Zm40,152a40,40,0,0,1-40,40H80a40,40,0,0,1-40-40V80A40,40,0,0,1,80,40h96a40,40,0,0,1,40,40ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-[#0c7ff2] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M216,24H40A16,16,0,0,0,24,40V216a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V40A16,16,0,0,0,216,24Zm0,192H40V40H216V216ZM96,112v64a8,8,0,0,1-16,0V112a8,8,0,0,1,16,0Zm88,28v36a8,8,0,0,1-16,0V140a20,20,0,0,0-40,0v36a8,8,0,0,1-16,0V112a8,8,0,0,1,15.79-1.78A36,36,0,0,1,184,140ZM100,84A12,12,0,1,1,88,72,12,12,0,0,1,100,84Z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-[#0c7ff2] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M247.39,68.94A8,8,0,0,0,240,64H209.57A48,48,0,0,0,112,109.87V96a8,8,0,0,0-16,0v64a8,8,0,0,0,16,0V144a32,32,0,0,1,64,0v16a8,8,0,0,0,16,0V109.87A48,48,0,0,0,209.57,64H240A8,8,0,0,0,247.39,68.94Z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div class="flex flex-col gap-4">
                            <h4 class="text-lg font-semibold text-white">Quick Links</h4>
                            <div class="flex flex-col gap-2">
                                <a href="#home" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Home</a>
                                <a href="#projects" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Projects</a>
                                <a href="#about" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">About</a>
                                <a href="#contact" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Contact</a>
                                <a href="#" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Login</a>
                                <a href="#" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Signup</a>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="flex flex-col gap-4">
                            <h4 class="text-lg font-semibold text-white">Categories</h4>
                            <div class="flex flex-col gap-2">
                                <a href="#" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Web Development</a>
                                <a href="#" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Mobile Apps</a>
                                <a href="#" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Machine Learning</a>
                                <a href="#" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Data Science</a>
                                <a href="#" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Algorithms</a>
                                <a href="#" class="text-gray-300 hover:text-[#0c7ff2] transition-colors text-sm">Database Systems</a>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="flex flex-col gap-4" id="contact">
                            <h4 class="text-lg font-semibold text-white">Contact Info</h4>
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center gap-3">
                                    <div class="text-[#0c7ff2] flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48ZM203.43,64,128,133.15,52.57,64ZM216,192H40V74.19l82.59,75.71a8,8,0,0,0,10.82,0L216,74.19V192Z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-300 text-sm break-all">support@codecraft.com</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="text-[#0c7ff2] flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-300 text-sm">+1 (555) 123-4567</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="text-[#0c7ff2] flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128ZM176,16H80A64.07,64.07,0,0,0,16,80v96a64.07,64.07,0,0,0,64,64h96a64.07,64.07,0,0,0,64-64V80A64.07,64.07,0,0,0,176,16ZM224,176a48.05,48.05,0,0,1-48,48H80a48.05,48.05,0,0,1-48-48V80A48.05,48.05,0,0,1,80,32h96a48.05,48.05,0,0,1,48,48Z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-300 text-sm">San Francisco, CA</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="text-[#0c7ff2] flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-300 text-sm">24/7 Support Available</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Footer -->
                    <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-gray-300 text-sm text-center md:text-left">© 2024 CodeCraft. All rights reserved.</p>
                        <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                            <a href="#" class="text-gray-300 hover:text-[#0c7ff2] text-sm transition-colors">Privacy Policy</a>
                            <a href="#" class="text-gray-300 hover:text-[#0c7ff2] text-sm transition-colors">Terms of Service</a>
                            <a href="#" class="text-gray-300 hover:text-[#0c7ff2] text-sm transition-colors">Cookie Policy</a>
                            <a href="#" class="text-gray-300 hover:text-[#0c7ff2] text-sm transition-colors">Refund Policy</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
      

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Newsletter form submission
        const emailInput = document.getElementById('newsletter-email');
        const subscribeBtn = document.getElementById('subscribe-btn');

        function handleSubscription() {
            const email = emailInput.value.trim();
            if (email && email.includes('@')) {
                alert('Thank you for subscribing! We\'ll keep you updated with our latest projects.');
                emailInput.value = '';
            } else {
                alert('Please enter a valid email address.');
                emailInput.focus();
            }
        }

        emailInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleSubscription();
            }
        });

        subscribeBtn.addEventListener('click', handleSubscription);

        // Add loading states to buttons
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function() {
                if (this.textContent.includes('View Details') || this.textContent.includes('Browse Projects')) {
                    const originalText = this.textContent;
                    this.textContent = 'Loading...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.disabled = false;
                    }, 1000);
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.grid > div, .flex.flex-col.gap-3').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
   a
</body>
</html>