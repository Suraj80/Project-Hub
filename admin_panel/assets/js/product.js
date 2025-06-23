// assets/js/product.js

let currentPage = 1;
let itemsPerPage = 10;
let currentFilters = {};
let deleteProductId = null;

$(document).ready(function() {
    loadProducts();
    bindEvents();
});

function bindEvents() {
    // Search functionality with debounce
    let searchTimeout;
    $('#searchInput').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentFilters.search = $(this).val();
            currentPage = 1;
            loadProducts();
        }, 300);
    });

    // Filter events
    $('#categoryFilter, #difficultyFilter, #featuredFilter, #priceFilter').on('change', function() {
        const filterId = $(this).attr('id');
        const value = $(this).val();
        
        switch(filterId) {
            case 'categoryFilter':
                currentFilters.category = value;
                break;
            case 'difficultyFilter':
                currentFilters.difficulty = value;
                break;
            case 'featuredFilter':
                currentFilters.featured = value;
                break;
            case 'priceFilter':
                currentFilters.priceRange = value;
                break;
        }
        
        currentPage = 1;
        loadProducts();
    });

    // Form submission
    $('#productForm').on('submit', function(e) {
        e.preventDefault();
        saveProduct();
    });

    // Image preview
    $('#productImage').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#currentImagePreview').attr('src', e.target.result).show();
                $('#imagePreviewContainer').show();
            };
            reader.readAsDataURL(file);
        }
    });
}

function loadProducts() {
    $('#loadingSpinner').show();
    
    const formData = new FormData();
    formData.append('action', 'fetch');
    formData.append('page', currentPage);
    formData.append('limit', itemsPerPage);
    
    // Add filters
    Object.keys(currentFilters).forEach(key => {
        if (currentFilters[key]) {
            formData.append(key, currentFilters[key]);
        }
    });

    $.ajax({
        url: 'ajax/product_action.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            $('#loadingSpinner').hide();
            
            if (response.success) {
                renderProducts(response.data);
                updatePagination(response.total, response.page, response.limit);
            } else {
                showError('Failed to load products: ' + response.message);
                $('#productsTableBody').html('<tr><td colspan="9" class="text-center">Error loading products</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            $('#loadingSpinner').hide();
            console.error('AJAX Error:', error);
            showError('Failed to load products. Please try again.');
            $('#productsTableBody').html('<tr><td colspan="9" class="text-center">Error loading products</td></tr>');
        }
    });
}

function renderProducts(products) {
    const tbody = $('#productsTableBody');
    tbody.empty();
    
    if (products.length === 0) {
        tbody.html('<tr><td colspan="9" class="text-center">No products found</td></tr>');
        return;
    }

    products.forEach(product => {
        const row = `
            <tr>
                <td>
                    ${product.image ? 
                        `<img src="${product.image}" alt="${escapeHtml(product.name)}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">` : 
                        '<div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 5px;"><i class="fas fa-image text-muted"></i></div>'
                    }
                </td>
                <td>${escapeHtml(product.name)}</td>
                <td>${escapeHtml(product.category)}</td>
                <td>$${parseFloat(product.price).toFixed(2)}</td>
                <td>
                    <span class="badge badge-${getDifficultyBadgeClass(product.difficulty)}">${product.difficulty}</span>
                </td>
                <td>
                    ${product.rating ? 
                        `<span class="text-warning">${'★'.repeat(Math.floor(product.rating))}${'☆'.repeat(5-Math.floor(product.rating))}</span> ${product.rating}` : 
                        'No rating'
                    }
                </td>
                <td>
                    ${product.technologies && product.technologies.length > 0 ? 
                        product.technologies.map(tech => `<span class="badge badge-secondary mr-1">${escapeHtml(tech)}</span>`).join('') : 
                        'None'
                    }
                </td>
                <td>
                    ${product.featured ? 
                        '<span class="badge badge-success">Featured</span>' : 
                        '<span class="badge badge-light">Regular</span>'
                    }
                </td>
                <td>
                    <button class="btn btn-sm btn-info mr-1" onclick="viewProduct(${product.id})" title="View">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-warning mr-1" onclick="editProduct(${product.id})" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="confirmDeleteProduct(${product.id})" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        tbody.append(row);
    });
}

function updatePagination(total, page, limit) {
    const totalPages = Math.ceil(total / limit);
    const start = (page - 1) * limit + 1;
    const end = Math.min(page * limit, total);
    
    $('#paginationInfo').text(`Showing ${start} to ${end} of ${total} entries`);
    
    const pagination = $('#pagination');
    pagination.empty();
    
    // Previous button
    pagination.append(`
        <li class="page-item ${page <= 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${page - 1})" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
    `);
    
    // Page numbers
    const startPage = Math.max(1, page - 2);
    const endPage = Math.min(totalPages, page + 2);
    
    for (let i = startPage; i <= endPage; i++) {
        pagination.append(`
            <li class="page-item ${i === page ? 'active' : ''}">
                <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
            </li>
        `);
    }
    
    // Next button
    pagination.append(`
        <li class="page-item ${page >= totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${page + 1})" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    `);
}

function changePage(page) {
    if (page >= 1) {
        currentPage = page;
        loadProducts();
    }
}

function showAddProductModal() {
    $('#productModalLabel').text('Add New Product');
    $('#productForm')[0].reset();
    $('#productId').val('');
    $('#imagePreviewContainer').hide();
    clearTechnologies();
    $('#productModal').modal('show');
}

function editProduct(id) {
    const formData = new FormData();
    formData.append('action', 'get');
    formData.append('productId', id);

    $.ajax({
        url: 'ajax/product_action.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                populateForm(response.data);
                $('#productModalLabel').text('Edit Product');
                $('#productModal').modal('show');
            } else {
                showError('Failed to load product: ' + response.message);
            }
        },
        error: function() {
            showError('Error loading product');
        }
    });
}

function populateForm(product) {
    $('#productId').val(product.id);
    $('#productName').val(product.name);
    $('#productCategory').val(product.category);
    $('#productPrice').val(product.price);
    $('#productDifficulty').val(product.difficulty);
    $('#productRating').val(product.rating || '');
    $('#productDuration').val(product.duration || '');
    $('#productDescription').val(product.description || '');
    $('#productFeatured').prop('checked', product.featured);

    // Show current image
    if (product.image) {
        $('#currentImagePreview').attr('src', product.image);
        $('#imagePreviewContainer').show();
    }

    // Set technologies
    clearTechnologies();
    if (product.technologies && product.technologies.length > 0) {
        product.technologies.forEach(tech => {
            addTechnologyInput(tech);
        });
    }
}

function saveProduct() {
    const formData = new FormData();
    const productId = $('#productId').val();
    
    formData.append('action', productId ? 'update' : 'add');
    if (productId) {
        formData.append('productId', productId);
    }

    // Add form data
    formData.append('productName', $('#productName').val());
    formData.append('productCategory', $('#productCategory').val());
    formData.append('productPrice', $('#productPrice').val());
    formData.append('productDifficulty', $('#productDifficulty').val());
    formData.append('productRating', $('#productRating').val());
    formData.append('productDuration', $('#productDuration').val());
    formData.append('productDescription', $('#productDescription').val());
    
    if ($('#productFeatured').is(':checked')) {
        formData.append('productFeatured', '1');
    }

    // Add image if selected
    const imageFile = $('#productImage')[0].files[0];
    if (imageFile) {
        formData.append('productImage', imageFile);
    }

    // Add technologies
    const technologies = getTechnologies();
    technologies.forEach(tech => {
        formData.append('technologies[]', tech);
    });

    $.ajax({
        url: 'ajax/product_action.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showSuccess(response.message);
                $('#productModal').modal('hide');
                loadProducts();
            } else {
                showError(response.message);
            }
        },
        error: function() {
            showError('Error saving product');
        }
    });
}

function confirmDeleteProduct(id) {
    deleteProductId = id;
    $('#deleteModal').modal('show');
}

function confirmDelete() {
    if (deleteProductId) {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('productId', deleteProductId);

        $.ajax({
            url: 'ajax/product_action.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showSuccess(response.message);
                    $('#deleteModal').modal('hide');
                    loadProducts();
                } else {
                    showError(response.message);
                }
            },
            error: function() {
                showError('Error deleting product');
            }
        });
    }
}

function viewProduct(id) {
    const formData = new FormData();
    formData.append('action', 'get');
    formData.append('productId', id);

    $.ajax({
        url: 'ajax/product_action.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                displayProductDetails(response.data);
                $('#productDetailsModal').modal('show');
            } else {
                showError('Failed to load product details');
            }
        },
        error: function() {
            showError('Error loading product details');
        }
    });
}

function displayProductDetails(product) {
    const detailsHtml = `
        <div class="row">
            <div class="col-md-4">
                ${product.image ? 
                    `<img src="${product.image}" alt="${escapeHtml(product.name)}" class="img-fluid rounded">` : 
                    '<div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px; border-radius: 5px;"><i class="fas fa-image fa-3x text-muted"></i></div>'
                }
            </div>
            <div class="col-md-8">
                <h4>${escapeHtml(product.name)}</h4>
                <p><strong>Category:</strong> ${escapeHtml(product.category)}</p>
                <p><strong>Price:</strong> $${parseFloat(product.price).toFixed(2)}</p>
                <p><strong>Difficulty:</strong> <span class="badge badge-${getDifficultyBadgeClass(product.difficulty)}">${product.difficulty}</span></p>
                ${product.rating ? `<p><strong>Rating:</strong> ${product.rating}/5</p>` : ''}
                ${product.duration ? `<p><strong>Duration:</strong> ${escapeHtml(product.duration)}</p>` : ''}
                <p><strong>Featured:</strong> ${product.featured ? 'Yes' : 'No'}</p>
                ${product.description ? `<p><strong>Description:</strong><br>${escapeHtml(product.description)}</p>` : ''}
                ${product.technologies && product.technologies.length > 0 ? `
                    <p><strong>Technologies:</strong><br>
                    ${product.technologies.map(tech => `<span class="badge badge-secondary mr-1">${escapeHtml(tech)}</span>`).join('')}
                    </p>
                ` : ''}
            </div>
        </div>
    `;
    
    $('#productDetailsBody').html(detailsHtml);
}

function clearFilters() {
    currentFilters = {};
    $('#searchInput').val('');
    $('#categoryFilter, #difficultyFilter, #featuredFilter, #priceFilter').val('');
    currentPage = 1;
    loadProducts();
}

function addTechnologyInput(value = '') {
    const container = $('#technologiesContainer');
    const inputGroup = $(`
        <div class="technology-input-group mb-2">
            <div class="input-group">
                <input type="text" class="form-control" name="technologies[]" placeholder="Enter technology" value="${escapeHtml(value)}">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeTechnologyInput(this)">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
    `);
    container.append(inputGroup);
}

function removeTechnologyInput(button) {
    $(button).closest('.technology-input-group').remove();
}

function getTechnologies() {
    const technologies = [];
    $('input[name="technologies[]"]').each(function() {
        const value = $(this).val().trim();
        if (value) {
            technologies.push(value);
        }
    });
    return technologies;
}

function clearTechnologies() {
    $('#technologiesContainer').empty();
    addTechnologyInput(); // Add one empty input
}

function getDifficultyBadgeClass(difficulty) {
    switch(difficulty.toLowerCase()) {
        case 'beginner': return 'success';
        case 'intermediate': return 'warning';
        case 'advanced': return 'danger';
        default: return 'secondary';
    }
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function showSuccess(message) {
    // You can use Bootstrap toast or alert here
    alert('Success: ' + message);
}

function showError(message) {
    // You can use Bootstrap toast or alert here
    alert('Error: ' + message);
}