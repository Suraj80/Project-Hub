// js/products-management.js

class ProductsManager {
    constructor() {
        this.currentPage = 1;
        this.itemsPerPage = 10;
        this.currentFilters = {};
        this.isEditing = false;
        this.editingId = null;
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.loadProducts();
        this.loadCategories();
        this.loadTechnologies();
    }

    bindEvents() {
        // Search and filter events
        document.getElementById('searchInput').addEventListener('input', (e) => {
            this.debounce(() => this.handleSearch(e.target.value), 300)();
        });

        document.getElementById('categoryFilter').addEventListener('change', (e) => {
            this.handleFilter('category', e.target.value);
        });

        document.getElementById('difficultyFilter').addEventListener('change', (e) => {
            this.handleFilter('difficulty', e.target.value);
        });

        document.getElementById('featuredFilter').addEventListener('change', (e) => {
            this.handleFilter('featured', e.target.value);
        });

        document.getElementById('priceRangeFilter').addEventListener('change', (e) => {
            this.handleFilter('priceRange', e.target.value);
        });

        // Form events
        document.getElementById('productForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleFormSubmit();
        });

        document.getElementById('addProductBtn').addEventListener('click', () => {
            this.showAddForm();
        });

        document.getElementById('cancelBtn').addEventListener('click', () => {
            this.hideForm();
        });

        // Image preview
        document.getElementById('productImage').addEventListener('change', (e) => {
            this.previewImage(e.target.files[0]);
        });

        // Technology tags
        document.getElementById('technologyInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                this.addTechnology();
            }
        });

        document.getElementById('addTechBtn').addEventListener('click', () => {
            this.addTechnology();
        });

        // Pagination
        document.getElementById('prevPage').addEventListener('click', () => {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.loadProducts();
            }
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            this.currentPage++;
            this.loadProducts();
        });

        document.getElementById('itemsPerPage').addEventListener('change', (e) => {
            this.itemsPerPage = parseInt(e.target.value);
            this.currentPage = 1;
            this.loadProducts();
        });
    }

    async loadProducts() {
        try {
            this.showLoading();
            
            const formData = new FormData();
            formData.append('action', 'fetch');
            formData.append('page', this.currentPage);
            formData.append('limit', this.itemsPerPage);
            
            // Add filters
            Object.keys(this.currentFilters).forEach(key => {
                if (this.currentFilters[key]) {
                    formData.append(key, this.currentFilters[key]);
                }
            });

            const response = await fetch('ajax/product_action.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            
            if (result.success) {
                this.renderProducts(result.data);
                this.updatePagination(result.total, result.page, result.limit);
            } else {
                this.showError('Failed to load products: ' + result.message);
            }
        } catch (error) {
            this.showError('Error loading products: ' + error.message);
        } finally {
            this.hideLoading();
        }
    }

    renderProducts(products) {
        const container = document.getElementById('productsContainer');
        
        if (products.length === 0) {
            container.innerHTML = '<div class="no-products">No products found</div>';
            return;
        }

        const productsHTML = products.map(product => `
            <div class="product-card" data-id="${product.id}">
                <div class="product-image">
                    ${product.image ? 
                        `<img src="${product.image}" alt="${product.name}" loading="lazy">` : 
                        '<div class="no-image">No Image</div>'
                    }
                    ${product.featured ? '<span class="featured-badge">Featured</span>' : ''}
                </div>
                <div class="product-content">
                    <h3 class="product-title">${this.escapeHtml(product.name)}</h3>
                    <p class="product-category">${this.escapeHtml(product.category)}</p>
                    <div class="product-meta">
                        <span class="price">$${parseFloat(product.price).toFixed(2)}</span>
                        <span class="difficulty difficulty-${product.difficulty.toLowerCase()}">${product.difficulty}</span>
                        ${product.rating ? `<span class="rating">★ ${product.rating}</span>` : ''}
                    </div>
                    ${product.duration ? `<p class="duration">Duration: ${product.duration}</p>` : ''}
                    ${product.technologies && product.technologies.length > 0 ? `
                        <div class="technologies">
                            ${product.technologies.map(tech => `<span class="tech-tag">${this.escapeHtml(tech)}</span>`).join('')}
                        </div>
                    ` : ''}
                    ${product.description ? `<p class="description">${this.escapeHtml(product.description)}</p>` : ''}
                </div>
                <div class="product-actions">
                    <button class="btn btn-edit" onclick="productsManager.editProduct(${product.id})">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-delete" onclick="productsManager.deleteProduct(${product.id})">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        `).join('');

        container.innerHTML = productsHTML;
    }

    updatePagination(total, page, limit) {
        const totalPages = Math.ceil(total / limit);
        
        document.getElementById('currentPage').textContent = page;
        document.getElementById('totalPages').textContent = totalPages;
        document.getElementById('totalItems').textContent = total;
        
        document.getElementById('prevPage').disabled = page <= 1;
        document.getElementById('nextPage').disabled = page >= totalPages;
    }

    handleSearch(searchTerm) {
        this.currentFilters.search = searchTerm;
        this.currentPage = 1;
        this.loadProducts();
    }

    handleFilter(filterType, value) {
        this.currentFilters[filterType] = value;
        this.currentPage = 1;
        this.loadProducts();
    }

    showAddForm() {
        this.isEditing = false;
        this.editingId = null;
        document.getElementById('formTitle').textContent = 'Add New Product';
        document.getElementById('productForm').reset();
        document.getElementById('imagePreview').style.display = 'none';
        this.clearTechnologies();
        document.getElementById('productModal').style.display = 'block';
    }

    async editProduct(id) {
        try {
            const formData = new FormData();
            formData.append('action', 'get');
            formData.append('productId', id);

            const response = await fetch('ajax/product_action.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            
            if (result.success) {
                this.populateForm(result.data);
                this.isEditing = true;
                this.editingId = id;
                document.getElementById('formTitle').textContent = 'Edit Product';
                document.getElementById('productModal').style.display = 'block';
            } else {
                this.showError('Failed to load product: ' + result.message);
            }
        } catch (error) {
            this.showError('Error loading product: ' + error.message);
        }
    }

    populateForm(product) {
        document.getElementById('productName').value = product.name;
        document.getElementById('productCategory').value = product.category;
        document.getElementById('productPrice').value = product.price;
        document.getElementById('productDifficulty').value = product.difficulty;
        document.getElementById('productRating').value = product.rating || '';
        document.getElementById('productDuration').value = product.duration || '';
        document.getElementById('productDescription').value = product.description || '';
        document.getElementById('productFeatured').checked = product.featured;

        // Show current image
        if (product.image) {
            const preview = document.getElementById('imagePreview');
            preview.src = product.image;
            preview.style.display = 'block';
        }

        // Set technologies
        this.clearTechnologies();
        if (product.technologies && product.technologies.length > 0) {
            product.technologies.forEach(tech => {
                this.addTechnologyTag(tech);
            });
        }
    }

    async handleFormSubmit() {
        try {
            const formData = new FormData();
            formData.append('action', this.isEditing ? 'update' : 'add');
            
            if (this.isEditing) {
                formData.append('productId', this.editingId);
            }

            // Get form data
            formData.append('productName', document.getElementById('productName').value);
            formData.append('productCategory', document.getElementById('productCategory').value);
            formData.append('productPrice', document.getElementById('productPrice').value);
            formData.append('productDifficulty', document.getElementById('productDifficulty').value);
            formData.append('productRating', document.getElementById('productRating').value);
            formData.append('productDuration', document.getElementById('productDuration').value);
            formData.append('productDescription', document.getElementById('productDescription').value);
            
            if (document.getElementById('productFeatured').checked) {
                formData.append('productFeatured', '1');
            }

            // Add image if selected
            const imageFile = document.getElementById('productImage').files[0];
            if (imageFile) {
                formData.append('productImage', imageFile);
            }

            // Add technologies
            const technologies = this.getTechnologies();
            technologies.forEach(tech => {
                formData.append('technologies[]', tech);
            });

            const response = await fetch('ajax/product_action.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            
            if (result.success) {
                this.showSuccess(result.message);
                this.hideForm();
                this.loadProducts();
            } else {
                this.showError(result.message);
            }
        } catch (error) {
            this.showError('Error saving product: ' + error.message);
        }
    }

    async deleteProduct(id) {
        if (!confirm('Are you sure you want to delete this product?')) {
            return;
        }

        try {
            const formData = new FormData();
            formData.append('action', 'delete');
            formData.append('productId', id);

            const response = await fetch('ajax/product_action.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            
            if (result.success) {
                this.showSuccess(result.message);
                this.loadProducts();
            } else {
                this.showError(result.message);
            }
        } catch (error) {
            this.showError('Error deleting product: ' + error.message);
        }
    }

    hideForm() {
        document.getElementById('productModal').style.display = 'none';
    }

    previewImage(file) {
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    addTechnology() {
        const input = document.getElementById('technologyInput');
        const tech = input.value.trim();
        
        if (tech) {
            this.addTechnologyTag(tech);
            input.value = '';
        }
    }

    addTechnologyTag(tech) {
        const container = document.getElementById('technologiesContainer');
        const tag = document.createElement('span');
        tag.className = 'tech-tag';
        tag.innerHTML = `
            ${this.escapeHtml(tech)}
            <button type="button" class="remove-tech" onclick="this.parentElement.remove()">×</button>
        `;
        container.appendChild(tag);
    }

    getTechnologies() {
        const tags = document.querySelectorAll('#technologiesContainer .tech-tag');
        return Array.from(tags).map(tag => tag.textContent.replace('×', '').trim());
    }

    clearTechnologies() {
        document.getElementById('technologiesContainer').innerHTML = '';
    }

    async loadCategories() {
        try {
            const formData = new FormData();
            formData.append('action', 'getCategories');

            const response = await fetch('ajax/product_action.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            
            if (result.success) {
                const select = document.getElementById('categoryFilter');
                result.data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category;
                    option.textContent = category;
                    select.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error loading categories:', error);
        }
    }

    async loadTechnologies() {
        try {
            const formData = new FormData();
            formData.append('action', 'getTechnologies');

            const response = await fetch('ajax/product_action.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            
            if (result.success) {
                // You can use this data for autocomplete functionality
                this.availableTechnologies = result.data;
            }
        } catch (error) {
            console.error('Error loading technologies:', error);
        }
    }

    showLoading() {
        document.getElementById('loadingSpinner').style.display = 'block';
    }

    hideLoading() {
        document.getElementById('loadingSpinner').style.display = 'none';
    }

    showSuccess(message) {
        this.showNotification(message, 'success');
    }

    showError(message) {
        this.showNotification(message, 'error');
    }

    showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    debounce(func, wait) {
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
}

// Initialize the products manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.productsManager = new ProductsManager();
});