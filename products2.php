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
        
        @media (max-width: 768px) {
            .project-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (min-width: 769px) and (max-width: 1024px) {
            .project-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1025px) {
            .project-grid {
                grid-template-columns: repeat(3, 1fr);
            }
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
                    <div class="relative search-glow rounded-lg">
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
                    
                    <button class="relative p-2 text-gray-700 hover:text-indigo-600 transition-colors" onclick="toggleWishlist()">
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stats-card rounded-xl p-6 text-white">
                <div class="text-3xl font-bold" id="totalProjects">12</div>
                <div class="text-indigo-100">Total Projects</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="text-3xl font-bold text-green-600" id="avgRating">4.8</div>
                <div class="text-gray-600">Avg Rating</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="text-3xl font-bold text-purple-600" id="categories">8</div>
                <div class="text-gray-600">Categories</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="text-3xl font-bold text-orange-600">$50-$300</div>
                <div class="text-gray-600">Price Range</div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Enhanced Filters Sidebar -->
            <aside class="lg:w-80">
                <div class="filter-section rounded-xl p-6 sticky top-24">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Filters</h3>
                    
                    <!-- Category Filter -->
                    <div class="mb-6">
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
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Difficulty</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-indigo-600 mr-3" value="Beginner">
                                <span class="text-sm">Beginner</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-indigo-600 mr-3" value="Intermediate">
                                <span class="text-sm">Intermediate</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-indigo-600 mr-3" value="Advanced">
                                <span class="text-sm">Advanced</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Price Range -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Price Range</label>
                        <div class="space-y-4">
                            <input type="range" min="0" max="500" value="500" class="w-full" id="priceRange">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>$0</span>
                                <span id="maxPrice">$500</span>
                            </div>
                        </div>
                    </div>
                    
                    <button class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-colors font-medium" onclick="applyFilters()">
                        Apply Filters
                    </button>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1">
                <!-- Header with View Toggle -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900" id="pageTitle">Computer Science Projects</h2>
                        <p class="text-gray-600 mt-1">Showing <span id="resultCount">8</span> projects</p>
                    </div>
                    
                    <div class="view-toggle">
                        <button class="px-4 py-2 rounded-lg text-sm font-medium transition-all active" onclick="setView('grid')" id="gridView">
                            <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z"/>
                            </svg>
                            Grid
                        </button>
                        <button class="px-4 py-2 rounded-lg text-sm font-medium transition-all" onclick="setView('list')" id="listView">
                            <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
                            </svg>
                            List
                        </button>
                    </div>
                </div>

                <!-- Projects Grid -->
                <div class="project-grid grid gap-8" id="projectsContainer">
                    <!-- Projects will be loaded here -->
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-12">
                    <button class="bg-gray-100 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-200 transition-colors font-medium" onclick="loadMore()">
                        Load More Projects
                    </button>
                </div>
            </main>
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
            }
        ];

        let filteredProjects = [...projects];
        let wishlistItems = JSON.parse(localStorage.getItem('wishlist') || '[]');
        let cartItems = JSON.parse(localStorage.getItem('cart') || '[]');
        let currentView = 'grid';

        function renderProjects() {
            const container = document.getElementById('projectsContainer');
            
            if (filteredProjects.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full flex flex-col items-center justify-center py-20">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No projects found</h3>
                        <p class="text-gray-600 text-center">Try adjusting your filters or search terms</p>
                    </div>
                `;
                return;
            }

            const projectsHTML = filteredProjects.map(project => `
                <div class="project-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">
                    <div class="relative">
                        <img src="${project.image}" alt="${project.name}" class="w-full h-48 object-cover">
                        ${project.featured ? '<div class="absolute top-4 left-4 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-xs font-semibold">Featured</div>' : ''}
                        <button class="wishlist-btn absolute top-4 right-4 p-2 bg-white rounded-full shadow-md hover:shadow-lg ${wishlistItems.includes(project.id) ? 'active' : ''}" onclick="toggleWishlist(${project.id})">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <div class="difficulty-badge text-white px-3 py-1 rounded-full text-xs font-semibold">
                                ${project.difficulty}
                            </div>
                            <div class="flex items-center text-yellow-500">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">${project.rating}</span>
                            </div>
                        </div>
                        
                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">${project.name}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">${project.description}</p>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            ${project.technologies.slice(0, 3).map(tech => 
                                `<span class="tech-tag px-2 py-1 rounded-md text-xs font-medium">${tech}</span>`
                            ).join('')}
                            ${project.technologies.length > 3 ? `<span class="text-xs text-gray-500">+${project.technologies.length - 3} more</span>` : ''}
                        </div>
                        
                        <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                            <span>⏱️ ${project.duration}</span>
                            <span>👥 ${project.students} students</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="price-tag text-white px-4 py-2 rounded-lg font-bold">
                                $${project.price}
                            </div>
                            <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors font-medium" onclick="addToCart(${project.id})">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');

            container.innerHTML = projectsHTML;
            document.getElementById('resultCount').textContent = filteredProjects.length;
            updateWishlistCount();
            updateCartCount();
        }

        function toggleWishlist(projectId) {
            const index = wishlistItems.indexOf(projectId);
            if (index > -1) {
                wishlistItems.splice(index, 1);
            } else {
                wishlistItems.push(projectId);
            }
            localStorage.setItem('wishlist', JSON.stringify(wishlistItems));
            renderProjects();
        }

        function addToCart(projectId) {
            if (!cartItems.includes(projectId)) {
                cartItems.push(projectId);
                localStorage.setItem('cart', JSON.stringify(cartItems));
                updateCartCount();
                
                // Show success animation
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = 'Added!';
                button.classList.add('bg-green-600');
                button.classList.remove('bg-indigo-600');
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('bg-green-600');
                    button.classList.add('bg-indigo-600');
                }, 1500);
            }
        }

        function updateWishlistCount() {
            document.getElementById('wishlistCount').textContent = wishlistItems.length;
        }

        function updateCartCount() {
            document.getElementById('cartCount').textContent = cartItems.length;
        }

        function setView(viewType) {
            currentView = viewType;
            const gridBtn = document.getElementById('gridView');
            const listBtn = document.getElementById('listView');
            
            if (viewType === 'grid') {
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');
            } else {
                listBtn.classList.add('active');
                gridBtn.classList.remove('active');
            }
            
            renderProjects();
        }

        function applyFilters() {
            const category = document.getElementById('categoryFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            filteredProjects = projects.filter(project => {
                const matchesCategory = !category || project.category === category;
                const matchesSearch = !searchTerm || 
                    project.name.toLowerCase().includes(searchTerm) ||
                    project.description.toLowerCase().includes(searchTerm) ||
                    project.technologies.some(tech => tech.toLowerCase().includes(searchTerm));
                
                return matchesCategory && matchesSearch;
            });
            
            renderProjects();
        }

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', applyFilters);
        document.getElementById('categoryFilter').addEventListener('change', applyFilters);

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderProjects();
            document.getElementById('totalProjects').textContent = projects.length;
        });
    </script>
</body>
</html>