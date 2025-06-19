<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Hub - Enhanced Design</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        .project-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }
        
        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .difficulty-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .price-tag {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .tech-tag {
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
            border: 1px solid rgba(99, 102, 241, 0.2);
        }
        
        .wishlist-btn {
            transition: all 0.3s ease;
        }
        
        .wishlist-btn:hover {
            transform: scale(1.1);
        }
        
        .wishlist-btn.active {
            color: #ef4444;
            animation: heartPulse 0.6s ease-in-out;
        }
        
        @keyframes heartPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .filter-section {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%);
        }
        
        .search-glow:focus-within {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .floating-action {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 50;
        }
        
        /* Enhanced Responsive Grid Layout - 4-5 products per row */
        .products-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(2, 1fr);
        }
        
        @media (min-width: 640px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (min-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 2rem;
            }
        }
        
        @media (min-width: 1280px) {
            .products-grid {
                grid-template-columns: repeat(5, 1fr);
                gap: 2rem;
            }
        }
        
        @media (min-width: 1536px) {
            .products-grid {
                grid-template-columns: repeat(6, 1fr);
            }
        }
        
        /* Filter Sidebar Styles */
        .filter-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .filter-sidebar.active {
            opacity: 1;
            visibility: visible;
        }
        
        .filter-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 350px;
            height: 100%;
            background: white;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        
        .filter-sidebar.active .filter-content {
            transform: translateX(0);
        }
        
        @media (max-width: 640px) {
            .filter-content {
                width: 300px;
            }
        }
        
        /* Filter Toggle Button */
        .filter-toggle {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .filter-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .view-toggle {
            background: rgba(99, 102, 241, 0.1);
            border-radius: 12px;
            padding: 4px;
        }
        
        .view-toggle button.active {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        /* Compact product card styling */
        .compact-card {
            min-height: 380px;
        }
        
        .compact-card .card-image {
            height: 180px;
        }
        
        @media (max-width: 640px) {
            .compact-card {
                min-height: 350px;
            }
            .compact-card .card-image {
                height: 160px;
            }
        }
        
        /* Animation for filter badge */
        .filter-badge {
            animation: bounceIn 0.3s ease;
        }
        
        @keyframes bounceIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        /* Enhanced mobile responsiveness */
        @media (max-width: 768px) {
            .mobile-hidden {
                display: none;
            }
            
            .mobile-full {
                width: 100%;
            }
        }
        
        /* Quick filter chips */
        .filter-chip {
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
            border: 1px solid rgba(99, 102, 241, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-chip:hover {
            background: rgba(99, 102, 241, 0.2);
            transform: translateY(-1px);
        }
        
        .filter-chip.active {
            background: #6366f1;
            color: white;
            border-color: #6366f1;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="glass-effect sticky top-0 z-40 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold text-gray-900">Project Hub</h1>
                    </div>
                    <nav class="hidden md:flex space-x-6">
                        <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors">Projects</a>
                        <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors">Categories</a>
                        <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors">About</a>
                    </nav>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="relative search-glow rounded-lg mobile-hidden">
                        <input 
                            type="text" 
                            placeholder="Search projects..." 
                            class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            id="searchInput"
                        >
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                    
                    <button class="relative p-2 text-gray-700 hover:text-indigo-600 transition-colors" onclick="toggleWishlistPanel()">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" id="wishlistCount">0</span>
                    </button>
                    
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors font-medium" onclick="toggleCart()">
                        Cart (<span id="cartCount">0</span>)
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Search Bar -->
    <div class="md:hidden bg-white border-b border-gray-200 px-4 py-3">
        <div class="relative search-glow rounded-lg">
            <input 
                type="text" 
                placeholder="Search projects..." 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                id="mobileSearchInput"
            >
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="2" fill="none"/>
            </svg>
        </div>
    </div>

    <!-- Filter Sidebar Overlay -->
    <div class="filter-sidebar" id="filterSidebar" onclick="closeFilterSidebar(event)">
        <div class="filter-content" onclick="event.stopPropagation()">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Filters</h3>
                    <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors" onclick="closeFilterSidebar()">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Category</label>
                    <select class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" id="categoryFilter">
                        <option value="">All Categories</option>
                        <option value="Web Development">Web Development</option>
                        <option value="AI/ML">AI/ML</option>
                        <option value="Mobile Development">Mobile Development</option>
                        <option value="Data Science">Data Science</option>
                        <option value="Cybersecurity">Cybersecurity</option>
                    </select>
                </div>
                
                <!-- Difficulty Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Difficulty</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600 mr-3 difficulty-filter" value="Beginner">
                            <span class="text-sm">Beginner</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600 mr-3 difficulty-filter" value="Intermediate">
                            <span class="text-sm">Intermediate</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600 mr-3 difficulty-filter" value="Advanced">
                            <span class="text-sm">Advanced</span>
                        </label>
                    </div>
                </div>
                
                <!-- Price Range -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Price Range</label>
                    <div class="space-y-4">
                        <input type="range" min="0" max="500" value="500" class="w-full" id="priceRange">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>$0</span>
                            <span id="maxPrice">$500</span>
                        </div>
                    </div>
                </div>
                
                <!-- Rating Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Minimum Rating</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="rating" class="text-indigo-600 mr-3" value="4.5">
                            <div class="flex items-center">
                                <span class="text-sm mr-2">4.5+</span>
                                <div class="flex text-yellow-400">
                                    ⭐⭐⭐⭐⭐
                                </div>
                            </div>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="rating" class="text-indigo-600 mr-3" value="4.0">
                            <div class="flex items-center">
                                <span class="text-sm mr-2">4.0+</span>
                                <div class="flex text-yellow-400">
                                    ⭐⭐⭐⭐
                                </div>
                            </div>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="rating" class="text-indigo-600 mr-3" value="">
                            <span class="text-sm">All Ratings</span>
                        </label>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <button class="flex-1 bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-colors font-medium" onclick="applyFilters()">
                        Apply Filters
                    </button>
                    <button class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-lg hover:bg-gray-200 transition-colors font-medium" onclick="clearFilters()">
                        Clear All
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
       

        <!-- Main Content Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900" id="pageTitle">Computer Science Projects</h2>
                <p class="text-gray-600 mt-1">Showing <span id="resultCount">8</span> projects</p>
                <div id="activeFilters" class="flex flex-wrap gap-2 mt-2"></div>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Filter Toggle Button -->
                <button class="filter-toggle" onclick="openFilterSidebar()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filters
                    <span id="filterCount" class="bg-white text-indigo-600 px-2 py-1 rounded-full text-xs font-bold hidden">0</span>
                </button>
                
                <!-- Sort Dropdown -->
                <select class="p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" id="sortSelect">
                    <option value="featured">Featured</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="rating">Highest Rated</option>
                    <option value="newest">Newest</option>
                </select>
                
                <!-- View Toggle -->
                <div class="view-toggle hidden sm:flex">
                    <button class="px-3 py-2 rounded-lg text-sm font-medium transition-all active" onclick="setView('grid')" id="gridView">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z"/>
                        </svg>
                    </button>
                    <button class="px-3 py-2 rounded-lg text-sm font-medium transition-all" onclick="setView('list')" id="listView">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid" id="projectsContainer">
            <!-- Projects will be loaded here -->
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="bg-gray-100 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-200 transition-colors font-medium" onclick="loadMore()">
                Load More Projects
            </button>
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="floating-action">
        <button class="bg-indigo-600 text-white p-4 rounded-full shadow-lg hover:bg-indigo-700 transition-all hover:shadow-xl" onclick="scrollToTop()">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2l-10 10h6v10h8V12h6L12 2z"/>
            </svg>
        </button>
    </div>

    <script>
        // Enhanced project data with more details
        const projects = [
            {
                id: 1,
                name: "E-commerce Platform with React & Node.js",
                category: "Web Development",
                price: 150,  
                difficulty: "Intermediate",
                rating: 4.8,
                duration: "6-8 weeks",
                technologies: ["React", "Node.js", "MongoDB", "Express"],
                description: "Build a full-stack e-commerce platform with user authentication, payment integration, and admin dashboard.",
                image: "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&h=250&fit=crop",
                students: 324,
                featured: true
            },
            {
                id: 2,
                name: "AI Image Recognition System",
                category: "AI/ML",
                price: 220,
                difficulty: "Advanced",
                rating: 4.9,
                duration: "8-10 weeks",
                technologies: ["Python", "TensorFlow", "OpenCV", "Flask"],
                description: "Develop an advanced image recognition system using deep learning techniques and neural networks.",
                image: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=250&fit=crop",
                students: 156,
                featured: true
            },
            {
                id: 3,
                name: "Mobile Banking App with Flutter",
                category: "Mobile Development",
                price: 180,
                difficulty: "Intermediate",
                rating: 4.7,
                duration: "7-9 weeks",
                technologies: ["Flutter", "Dart", "Firebase", "REST API"],
                description: "Create a secure mobile banking application with biometric authentication and real-time transactions.",
                image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=250&fit=crop",
                students: 298,
                featured: false
            },
            {
                id: 4,
                name: "Data Visualization Dashboard",
                category: "Data Science", 
                price: 140,
                difficulty: "Beginner",
                rating: 4.6,
                duration: "4-6 weeks",
                technologies: ["Python", "Pandas", "Plotly", "Streamlit"],
                description: "Build interactive data visualizations and dashboards for business intelligence and analytics.",
                image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=250&fit=crop",
                students: 412,
                featured: false
            },
            {
                id: 5,
                name: "Blockchain Voting System",
                category: "Cybersecurity",
                price: 280,
                difficulty: "Advanced", 
                rating: 4.9,
                duration: "10-12 weeks",
                technologies: ["Solidity", "Web3.js", "Ethereum", "React"],
                description: "Develop a secure, transparent voting system using blockchain technology and smart contracts.",
                image: "https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=400&h=250&fit=crop",
                students: 89,
                featured: true
            },
            {
                id: 6,
                name: "Social Media Analytics Tool",
                category: "Data Science",
                price: 160,
                difficulty: "Intermediate",
                rating: 4.5,
                duration: "6-7 weeks", 
                technologies: ["Python", "Twitter API", "NLP", "Django"],
                description: "Analyze social media trends and sentiment using natural language processing and data mining.",
                image: "https://images.unsplash.com/photo-1611224923853-80b023f02d71?w=400&h=250&fit=crop",
                students: 267,
                featured: false
            },
            {
                id: 7,
                name: "IoT Smart Home System",
                category: "Web Development", 
                price: 200,
                difficulty: "Advanced",
                rating: 4.8,
                duration: "8-10 weeks",
                technologies: ["Arduino", "Raspberry Pi", "MQTT", "React"],
                description: "Create an intelligent home automation system with sensor integration and mobile control.",
                image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=250&fit=crop",
                students: 143,
                featured: false
            },
            {
                id: 8,
                name: "Machine Learning Trading Bot",
                category: "AI/ML",
                price: 320,
                difficulty: "Advanced",
                rating: 4.9,
                duration: "12-14 weeks",
                technologies: ["Python", "Scikit-learn", "APIs", "Pandas"],
                description: "Build an automated trading bot using machine learning algorithms and real-time market data.",
                image: "https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=400&h=250&fit=crop",
                students: 76,
                featured: true
            },
            {
                id: 9,
                name: "Progressive Web App",
                category: "Web Development",
                price: 190,
                difficulty: "Intermediate",
                rating: 4.7,
                duration: "5-7 weeks",
                technologies: ["JavaScript", "Service Workers", "PWA", "IndexedDB"],
                description: "Build a modern Progressive Web App with offline capabilities and native-like experience.",
                image: "https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400&h=250&fit=crop",
                students: 201,
                featured: false
            },
            {
                id: 10,
                name: "Augmented Reality App",
                category: "Mobile Development", 
                price: 250,
                difficulty: "Advanced",
                rating: 4.8,
                duration: "9-11 weeks",
                technologies: ["Unity", "ARCore", "ARKit", "C#"],
                description: "Create an immersive AR experience for mobile devices with 3D object placement and interaction.",
                image: "https://images.unsplash.com/photo-1592478411213-6153e4ebc696?w=400&h=250&fit=crop",
                students: 134,
                featured: false
            },
            {
                id: 11,
                name: "Cybersecurity Monitoring System",
                category: "Cybersecurity",
                price: 290,
                difficulty: "Advanced",
                rating: 4.9,
                duration: "10-12 weeks",
                technologies: ["Python", "Wireshark", "Linux", "Docker"],
                description: "Develop a comprehensive network security monitoring and threat detection system.",
                image: "https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=400&h=250&fit=crop",
                students: 98,
                featured: true
            },
            {
                id: 12,
                name: "Real-time Chat Application",
                category: "Web Development",
                price: 130,
                difficulty: "Beginner",
                rating: 4.5,
                duration: "4-5 weeks",
                technologies: ["Socket.io", "Node.js", "React", "MongoDB"],
                description: "Build a modern real-time chat application with file sharing and emoji support.",
                image: "https://images.unsplash.com/photo-1577563908411-5077b6dc7624?w=400&h=250&fit=crop",
                students: 456,
                featured: false
            }
        ];

        // Global state management
        let filteredProjects = [...projects];
        let currentFilters = {
            category: '',
            difficulty: [],
            maxPrice: 500,
            minRating: '',
            search: ''
        };
        let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        let currentView = 'grid';

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            renderProjects();
            updateWishlistCount();
            updateCartCount();
            setupEventListeners();
        });

        function setupEventListeners() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const mobileSearchInput = document.getElementById('mobileSearchInput');
            
            if (searchInput) {
                searchInput.addEventListener('input', debounce(handleSearch, 300));
            }
            if (mobileSearchInput) {
                mobileSearchInput.addEventListener('input', debounce(handleSearch, 300));
            }

            // Sort functionality
            const sortSelect = document.getElementById('sortSelect');
            if (sortSelect) {
                sortSelect.addEventListener('change', handleSort);
            }

            // Price range slider
            const priceRange = document.getElementById('priceRange');
            if (priceRange) {
                priceRange.addEventListener('input', handlePriceRange);
            }

            // Filter event listeners
            const categoryFilter = document.getElementById('categoryFilter');
            if (categoryFilter) {
                categoryFilter.addEventListener('change', handleCategoryFilter);
            }

            const difficultyFilters = document.querySelectorAll('.difficulty-filter');
            difficultyFilters.forEach(filter => {
                filter.addEventListener('change', handleDifficultyFilter);
            });

            const ratingFilters = document.querySelectorAll('input[name="rating"]');
            ratingFilters.forEach(filter => {
                filter.addEventListener('change', handleRatingFilter);
            });
        }

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function handleSearch(event) {
            currentFilters.search = event.target.value.toLowerCase();
            applyFilters();
        }

        function handleSort() {
            const sortValue = document.getElementById('sortSelect').value;
            
            switch (sortValue) {
                case 'price-low':
                    filteredProjects.sort((a, b) => a.price - b.price);
                    break;
                case 'price-high':
                    filteredProjects.sort((a, b) => b.price - a.price);
                    break;
                case 'rating':
                    filteredProjects.sort((a, b) => b.rating - a.rating);
                    break;
                case 'newest':
                    filteredProjects.sort((a, b) => b.id - a.id);
                    break;
                case 'featured':
                default:
                    filteredProjects.sort((a, b) => {
                        if (a.featured && !b.featured) return -1;
                        if (!a.featured && b.featured) return 1;
                        return b.rating - a.rating;
                    });
                    break;
            }
            
            renderProjects();
        }

        function handlePriceRange() {
            const priceRange = document.getElementById('priceRange');
            const maxPrice = document.getElementById('maxPrice');
            currentFilters.maxPrice = parseInt(priceRange.value);
            maxPrice.textContent = `$${currentFilters.maxPrice}`;
        }

        function handleCategoryFilter() {
            currentFilters.category = document.getElementById('categoryFilter').value;
        }

        function handleDifficultyFilter() {
            const checkedDifficulties = document.querySelectorAll('.difficulty-filter:checked');
            currentFilters.difficulty = Array.from(checkedDifficulties).map(cb => cb.value);
        }

        function handleRatingFilter() {
            const checkedRating = document.querySelector('input[name="rating"]:checked');
            currentFilters.minRating = checkedRating ? parseFloat(checkedRating.value) : '';
        }

        function applyFilters() {
            filteredProjects = projects.filter(project => {
                // Search filter
                if (currentFilters.search && !project.name.toLowerCase().includes(currentFilters.search) && 
                    !project.description.toLowerCase().includes(currentFilters.search) &&
                    !project.technologies.some(tech => tech.toLowerCase().includes(currentFilters.search))) {
                    return false;
                }

                // Category filter
                if (currentFilters.category && project.category !== currentFilters.category) {
                    return false;
                }

                // Difficulty filter
                if (currentFilters.difficulty.length > 0 && !currentFilters.difficulty.includes(project.difficulty)) {
                    return false;
                }

                // Price filter
                if (project.price > currentFilters.maxPrice) {
                    return false;
                }

                // Rating filter
                if (currentFilters.minRating && project.rating < currentFilters.minRating) {
                    return false;
                }

                return true;
            });

            renderProjects();
            updateActiveFilters();
            closeFilterSidebar();
        }

        function clearFilters() {
            currentFilters = {
                category: '',
                difficulty: [],
                maxPrice: 500,
                minRating: '',
                search: ''
            };

            // Reset form elements
            document.getElementById('categoryFilter').value = '';
            document.querySelectorAll('.difficulty-filter').forEach(cb => cb.checked = false);
            document.getElementById('priceRange').value = 500;
            document.getElementById('maxPrice').textContent = '$500';
            document.querySelectorAll('input[name="rating"]').forEach(radio => radio.checked = false);
            document.getElementById('searchInput').value = '';
            document.getElementById('mobileSearchInput').value = '';

            filteredProjects = [...projects];
            renderProjects();
            updateActiveFilters();
            closeFilterSidebar();
        }

        function quickFilter(filterType) {
            const categories = ['Web Development', 'AI/ML', 'Mobile Development', 'Data Science', 'Cybersecurity'];
            const difficulties = ['Beginner', 'Intermediate', 'Advanced'];

            if (categories.includes(filterType)) {
                currentFilters.category = currentFilters.category === filterType ? '' : filterType;
                document.getElementById('categoryFilter').value = currentFilters.category;
            } else if (difficulties.includes(filterType)) {
                const index = currentFilters.difficulty.indexOf(filterType);
                if (index > -1) {
                    currentFilters.difficulty.splice(index, 1);
                } else {
                    currentFilters.difficulty.push(filterType);
                }
                // Update checkboxes
                document.querySelectorAll('.difficulty-filter').forEach(cb => {
                    cb.checked = currentFilters.difficulty.includes(cb.value);
                });
            } else if (filterType === 'Featured') {
                filteredProjects = currentFilters.category === 'Featured' ? [...projects] : projects.filter(p => p.featured);
                currentFilters.category = currentFilters.category === 'Featured' ? '' : 'Featured';
                renderProjects();
                updateActiveFilters();
                return;
            }

            applyFilters();
        }

        function updateActiveFilters() {
            const activeFiltersContainer = document.getElementById('activeFilters');
            const filterCount = document.getElementById('filterCount');
            let filterBadges = [];

            if (currentFilters.category && currentFilters.category !== 'Featured') {
                filterBadges.push(`Category: ${currentFilters.category}`);
            }

            if (currentFilters.difficulty.length > 0) {
                filterBadges.push(`Difficulty: ${currentFilters.difficulty.join(', ')}`);
            }

            if (currentFilters.maxPrice < 500) {
                filterBadges.push(`Max Price: $${currentFilters.maxPrice}`);
            }

            if (currentFilters.minRating) {
                filterBadges.push(`Rating: ${currentFilters.minRating}+`);
            }

            if (currentFilters.search) {
                filterBadges.push(`Search: "${currentFilters.search}"`);
            }

            activeFiltersContainer.innerHTML = filterBadges.map(badge => 
                `<span class="filter-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                    ${badge}
                    <button class="ml-2 text-indigo-600 hover:text-indigo-800" onclick="removeFilter('${badge}')">×</button>
                </span>`
            ).join('');

            // Update filter count
            if (filterBadges.length > 0) {
                filterCount.textContent = filterBadges.length;
                filterCount.classList.remove('hidden');
            } else {
                filterCount.classList.add('hidden');
            }

            // Update result count
            document.getElementById('resultCount').textContent = filteredProjects.length;
        }

        function removeFilter(badge) {
            if (badge.startsWith('Category:')) {
                currentFilters.category = '';
                document.getElementById('categoryFilter').value = '';
            } else if (badge.startsWith('Difficulty:')) {
                currentFilters.difficulty = [];
                document.querySelectorAll('.difficulty-filter').forEach(cb => cb.checked = false);
            } else if (badge.startsWith('Max Price:')) {
                currentFilters.maxPrice = 500;
                document.getElementById('priceRange').value = 500;
                document.getElementById('maxPrice').textContent = '$500';
            } else if (badge.startsWith('Rating:')) {
                currentFilters.minRating = '';
                document.querySelectorAll('input[name="rating"]').forEach(radio => radio.checked = false);
            } else if (badge.startsWith('Search:')) {
                currentFilters.search = '';
                document.getElementById('searchInput').value = '';
                document.getElementById('mobileSearchInput').value = '';
            }

            applyFilters();
        }

        function renderProjects() {
            const container = document.getElementById('projectsContainer');
            
            if (filteredProjects.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4">🔍</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No projects found</h3>
                        <p class="text-gray-600">Try adjusting your filters or search terms</p>
                        <button class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors" onclick="clearFilters()">
                            Clear Filters
                        </button>
                    </div>
                `;
                return;
            }

            container.innerHTML = filteredProjects.map(project => `
                <div class="project-card compact-card bg-white rounded-xl shadow-lg overflow-hidden glass-effect hover:shadow-2xl">
                    <div class="relative card-image bg-gradient-to-br from-indigo-50 to-purple-50">
                        <img src="${project.image}" alt="${project.name}" class="w-full h-full object-cover">
                        <div class="absolute top-3 right-3">
                            <button class="wishlist-btn p-2 bg-white rounded-full shadow-md hover:shadow-lg ${wishlist.includes(project.id) ? 'active' : ''}" 
                                    onclick="toggleWishlist(${project.id})">
                                <svg class="w-5 h-5" fill="${wishlist.includes(project.id) ? 'currentColor' : 'none'}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </div>
                        ${project.featured ? '<div class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-2 py-1 rounded-full text-xs font-bold">Featured</div>' : ''}
                    </div>
                    
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="difficulty-badge text-white px-2 py-1 rounded-full text-xs font-medium">${project.difficulty}</span>
                            <div class="flex items-center text-yellow-500">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">${project.rating}</span>
                            </div>
                        </div>
                        
                        <h3 class="font-bold text-gray-900 mb-2 text-sm leading-tight">${project.name}</h3>
                        <p class="text-gray-600 text-xs mb-3 line-clamp-2">${project.description}</p>
                        
                        <div class="flex flex-wrap gap-1 mb-3">
                            ${project.technologies.slice(0, 3).map(tech => 
                                `<span class="tech-tag px-2 py-1 rounded-full text-xs">${tech}</span>`
                            ).join('')}
                            ${project.technologies.length > 3 ? `<span class="text-xs text-gray-500">+${project.technologies.length - 3}</span>` : ''}
                        </div>
                        
                        <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                            <span>${project.duration}</span>
                            <span>${project.students} students</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="price-tag text-white px-3 py-1 rounded-full">
                                <span class="font-bold">$${project.price}</span>
                            </div>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors text-sm font-medium" 
                                    onclick="addToCart(${project.id})">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function toggleWishlist(projectId) {
            const index = wishlist.indexOf(projectId);
            if (index > -1) {
                wishlist.splice(index, 1);
            } else {
                wishlist.push(projectId);
            }
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            updateWishlistCount();
            renderProjects();
        }

        function addToCart(projectId) {
            const existingItem = cart.find(item => item.id === projectId);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id: projectId, quantity: 1 });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            
            // Show success message
            showToast('Added to cart successfully!');
        }

        function updateWishlistCount() {
            document.getElementById('wishlistCount').textContent = wishlist.length;
        }

        function updateCartCount() {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cartCount').textContent = totalItems;
        }

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform';
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => toast.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => document.body.removeChild(toast), 300);
            }, 3000);
        }

        // Filter sidebar functions
        function openFilterSidebar() {
            document.getElementById('filterSidebar').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeFilterSidebar(event) {
            if (!event || event.target === document.getElementById('filterSidebar')) {
                document.getElementById('filterSidebar').classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

        function setView(viewType) {
            currentView = viewType;
            const gridView = document.getElementById('gridView');
            const listView = document.getElementById('listView');
            
            if (viewType === 'grid') {
                gridView.classList.add('active');
                listView.classList.remove('active');
                document.getElementById('projectsContainer').className = 'products-grid';
            } else {
                listView.classList.add('active');
                gridView.classList.remove('active');
                document.getElementById('projectsContainer').className = 'space-y-4';
            }
            
            renderProjects();
        }

        function loadMore() {
            // Simulate loading more projects
            showToast('Loading more projects...');
            setTimeout(() => {
                showToast('All projects loaded!');
            }, 1000);
        }

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function toggleWishlistPanel() {
            showToast('Wishlist panel coming soon!');
        }

        function toggleCart() {
            showToast('Cart panel coming soon!');
        }

        // Update quick filter chip styling
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('filter-chip')) {
                document.querySelectorAll('.filter-chip').forEach(chip => {
                    chip.classList.remove('active');
                });
                e.target.classList.add('active');
            }
        });
    </script>
</body>
</html>