<?php
session_start();
include 'header2.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <title>CodeCraft - Premium Computer Science Projects for Students</title>
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
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        accent: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        dark: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
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
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .code-pattern {
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(255,255,255,0.1) 2px, transparent 0),
                radial-gradient(circle at 75px 75px, rgba(255,255,255,0.1) 2px, transparent 0);
            background-size: 100px 100px;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .tech-grid {
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="bg-dark-900 text-white font-sans">
    <div class="relative min-h-screen overflow-x-hidden">
        
        <!-- Hero Section -->
        <section id="home" class="relative min-h-screen flex items-center justify-center black-bg code-pattern">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-20 left-10 w-20 h-20 bg-primary-400 rounded-full opacity-20 animate-float"></div>
                <div class="absolute top-40 right-20 w-16 h-16 bg-accent-400 rounded-full opacity-20 animate-float" style="animation-delay: 2s;"></div>
                <div class="absolute bottom-40 left-20 w-24 h-24 bg-primary-300 rounded-full opacity-20 animate-float" style="animation-delay: 4s;"></div>
                <div class="absolute bottom-20 right-10 w-12 h-12 bg-accent-300 rounded-full opacity-20 animate-float" style="animation-delay: 1s;"></div>
            </div>
            
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="animate-slide-up">
                    <!-- Code-style header -->
                    <div class="font-mono text-accent-300 text-sm mb-4">
                        <span class="text-primary-400">class</span> <span class="text-white">CodeCraft</span> <span class="text-accent-300">{</span>
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-white to-primary-200 bg-clip-text text-transparent">
                            Premium CS Projects
                        </span>
                        <br>
                        <span class="text-accent-300 font-mono text-2xl sm:text-3xl lg:text-4xl">
                            for_students()
                        </span>
                    </h1>
                    
                    <p class="text-lg sm:text-xl lg:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto leading-relaxed">
                        Get high-quality, professionally crafted computer science projects. 
                        <span class="text-accent-300 font-mono">Instant download</span>, 
                        <span class="text-primary-300 font-mono">clean code</span>, 
                        <span class="text-accent-300 font-mono">detailed docs</span>.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
                        <button class="group relative px-8 py-4 bg-primary-600 hover:bg-primary-700 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl animate-glow">
                            <span class="relative z-10">Browse Projects</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-accent-600 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                        
                        <button class="group px-8 py-4 bg-transparent border-2 border-white/30 hover:border-white rounded-xl font-semibold text-lg transition-all duration-300 glass-effect hover:bg-white/20">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m-6-8h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2z"></path>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-dark-800 tech-grid">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">
                        <span class="text-primary-400 font-mono">Why</span> Choose CodeCraft?
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Built by developers, for developers. Every project is crafted with attention to detail and educational value.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="group p-8 bg-dark-700/50 rounded-2xl border border-dark-600 hover:border-primary-500 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-accent-500 rounded-xl flex items-center justify-center mb-6 group-hover:animate-pulse">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-white">Premium Quality Code</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Clean, well-documented code following industry best practices. Every project includes comprehensive documentation and setup instructions.
                        </p>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="group p-8 bg-dark-700/50 rounded-2xl border border-dark-600 hover:border-primary-500 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="w-16 h-16 bg-gradient-to-br from-accent-500 to-primary-500 rounded-xl flex items-center justify-center mb-6 group-hover:animate-pulse">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-white">Student-Friendly Pricing</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Affordable pricing designed for students. Bulk discounts available and flexible payment options to fit your budget.
                        </p>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="group p-8 bg-dark-700/50 rounded-2xl border border-dark-600 hover:border-primary-500 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-accent-500 rounded-xl flex items-center justify-center mb-6 group-hover:animate-pulse">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4 text-white">Instant Download</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Get immediate access to your projects after purchase. No waiting, no delays - start coding right away.
                        </p>
                    </div>
                    
        </section>

        <!-- Featured Projects Section -->
        <section id="projects" class="py-20 bg-dark-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">
                        Featured <span class="text-accent-400 font-mono">Projects</span>
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Explore our most popular computer science projects, carefully selected for their educational value and practical applications.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Project 1 -->
                    <div class="group bg-dark-800 rounded-2xl overflow-hidden border border-dark-700 hover:border-primary-500 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="relative h-48 bg-gradient-to-br from-primary-600 to-accent-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <div class="absolute top-4 right-4 bg-black/20 backdrop-blur-sm rounded-lg px-3 py-1">
                                <span class="text-white text-sm font-mono">React + Node.js</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-3 text-white">E-Commerce Platform</h3>
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Full-stack web application with user authentication, shopping cart, payment integration, and admin dashboard.
                            </p>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-accent-400 font-mono">$29.99</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-400">4.9 (127)</span>
                                </div>
                            </div>
                            <button class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 rounded-xl transition-colors duration-300">
                                View Details
                            </button>
                        </div>
                    </div>
                    
                    <!-- Project 2 -->
                    <div class="group bg-dark-800 rounded-2xl overflow-hidden border border-dark-700 hover:border-primary-500 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="relative h-48 bg-gradient-to-br from-accent-600 to-primary-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                            <div class="absolute top-4 right-4 bg-black/20 backdrop-blur-sm rounded-lg px-3 py-1">
                                <span class="text-white text-sm font-mono">Python + TensorFlow</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-3 text-white">ML Image Classifier</h3>
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Advanced machine learning system for image classification using deep neural networks and computer vision.
                            </p>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-accent-400 font-mono">$39.99</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-400">4.8 (89)</span>
                                </div>
                            </div>
                            <button class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 rounded-xl transition-colors duration-300">
                                View Details
                            </button>
                        </div>
                    </div>
                    
                    <!-- Project 3 -->
                    <div class="group bg-dark-800 rounded-2xl overflow-hidden border border-dark-700 hover:border-primary-500 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="relative h-48 bg-gradient-to-br from-primary-600 to-accent-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <div class="absolute top-4 right-4 bg-black/20 backdrop-blur-sm rounded-lg px-3 py-1">
                                <span class="text-white text-sm font-mono">React Native</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-3 text-white">Mobile Banking App</h3>
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Cross-platform mobile application with secure transactions, biometric authentication, and modern UI.
                            </p>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-accent-400 font-mono">$34.99</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-400">4.9 (156)</span>
                                </div>
                            </div>
                            <button class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 rounded-xl transition-colors duration-300">
                                View Details
                            </button>
                        </div>
                    </div>
                    
                    
                
                <div class="text-center mt-12">
                    <button class="px-8 py-4 bg-transparent border-2 border-primary-500 text-primary-400 hover:bg-primary-500 hover:text-white rounded-xl font-semibold text-lg transition-all duration-300">
                        View All Projects
                    </button>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-20 bg-dark-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">
                        What <span class="text-primary-400 font-mono">Students</span> Say
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Join thousands of satisfied students who have accelerated their learning with CodeCraft.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-dark-700/50 p-8 rounded-2xl border border-dark-600">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                E
                            </div>
                            <div class="ml-4">
                                <h4 class="text-white font-semibold">Ethan Carter</h4>
                                <p class="text-gray-400 text-sm">Computer Science Student</p>
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-300 leading-relaxed">
                            "CodeCraft's projects are incredible! The code quality is excellent, and the documentation helped me understand complex concepts. My grades improved significantly!"
                        </p>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="bg-dark-700/50 p-8 rounded-2xl border border-dark-600">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-accent-500 to-primary-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                S
                            </div>
                            <div class="ml-4">
                                <h4 class="text-white font-semibold">Sophia Bennett</h4>
                                <p class="text-gray-400 text-sm">Software Engineering Student</p>
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-300 leading-relaxed">
                            "Perfect for students on a budget! The instant download feature saved me when I had a tight deadline. Customer support is amazing too."
                        </p>
                    </div>
                    
                    <!-- Testimonial 3 -->
                    <div class="bg-dark-700/50 p-8 rounded-2xl border border-dark-600">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                L
                            </div>
                            <div class="ml-4">
                                <h4 class="text-white font-semibold">Liam Harper</h4>
                                <p class="text-gray-400 text-sm">Data Science Student</p>
                            </div>
                        </div>
                        
                </div>
            </div>
        </section>

        

        <!-- Footer -->
        <footer class="bg-dark-900 border-t border-dark-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white">CodeCraft</h3>
                        </div>
                        <p class="text-gray-300 mb-6 max-w-md leading-relaxed">
                            Empowering students with high-quality, ready-to-use computer science projects. Your success is our mission.
                        </p>
                        
                        <!-- Social Media -->
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 bg-dark-700 hover:bg-primary-600 rounded-lg flex items-center justify-center transition-colors duration-300">
                                <svg class="w-5 h-5 text-gray-400 hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-dark-700 hover:bg-primary-600 rounded-lg flex items-center justify-center transition-colors duration-300">
                                <svg class="w-5 h-5 text-gray-400 hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-dark-700 hover:bg-primary-600 rounded-lg flex items-center justify-center transition-colors duration-300">
                                <svg class="w-5 h-5 text-gray-400 hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-dark-700 hover:bg-primary-600 rounded-lg flex items-center justify-center transition-colors duration-300">
                                <svg class="w-5 h-5 text-gray-400 hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                   
                    
                    <!-- Categories -->
                    <div>
                        <h4 class="text-lg font-semibold text-white mb-6">Categories</h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Web Development</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Mobile Apps</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Machine Learning</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Data Science</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Blockchain</a></li>
                        </ul>
                    </div>
                </div>
                
               
                
                <!-- Bottom Footer -->
                <div class="border-t border-dark-700 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-400 text-sm">© 2024 CodeCraft. All rights reserved.</p>
                    <div class="flex flex-wrap gap-6">
                        <a href="#" class="text-gray-400 hover:text-primary-400 text-sm transition-colors duration-300">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-primary-400 text-sm transition-colors duration-300">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-primary-400 text-sm transition-colors duration-300">Cookie Policy</a>
                        <a href="#" class="text-gray-400 hover:text-primary-400 text-sm transition-colors duration-300">Refund Policy</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript -->
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
                // Add loading state
                subscribeBtn.textContent = 'Subscribing...';
                subscribeBtn.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    alert('Thank you for subscribing! We\'ll keep you updated with our latest projects.');
                    emailInput.value = '';
                    subscribeBtn.textContent = 'Subscribe';
                    subscribeBtn.disabled = false;
                }, 1000);
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

        // Add loading states to project buttons
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('View Details')) {
                button.addEventListener('click', function() {
                    const originalText = this.textContent;
                    this.textContent = 'Loading...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.disabled = false;
                        // Here you would typically redirect to the project details page
                        alert('Redirecting to project details...');
                    }, 1000);
                });
            }
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
        document.querySelectorAll('.grid > div, section > div').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Add parallax effect to hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('#home');
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Add typing effect to hero text
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.innerHTML = '';
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Initialize typing effect on page load
        window.addEventListener('load', () => {
            const heroSubtext = document.querySelector('#home p');
            if (heroSubtext) {
                const originalText = heroSubtext.textContent;
                setTimeout(() => {
                    typeWriter(heroSubtext, originalText, 50);
                }, 1000);
            }
        });
    </script>
</body>
</html>