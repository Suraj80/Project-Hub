// Order Management JavaScript with AJAX functionality

let currentPage = 1;
let ordersPerPage = 10;
let totalOrders = 0;
let currentFilters = {
    search: '',
    status: '',
    purchaseType: ''
};

// Initialize page when DOM is loaded
$(document).ready(function() {
    loadOrders();
    setupEventListeners();
});

// Setup event listeners for filters and search
function setupEventListeners() {
    // Search input with debounce
    let searchTimeout;
    $('#searchInput').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            currentFilters.search = $('#searchInput').val();
            currentPage = 1;
            loadOrders();
        }, 500);
    });

    // Status filter
    $('#statusFilter').on('change', function() {
        currentFilters.status = $(this).val();
        currentPage = 1;
        loadOrders();
    });

    // Purchase type filter
    $('#deliveryFilter').on('change', function() {
        currentFilters.purchaseType = $(this).val();
        currentPage = 1;
        loadOrders();
    });
}

// Load orders from server with AJAX
function loadOrders() {
    showLoading(true);
    
    const requestData = {
        action: 'fetch_orders',
        page: currentPage,
        limit: ordersPerPage,
        search: currentFilters.search,
        status: currentFilters.status,
        purchase_type: currentFilters.purchaseType
    };

    $.ajax({
        url: 'ajax/order_action.php',
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function(response) {
            showLoading(false);
            
            if (response.success) {
                renderOrders(response.data.orders);
                totalOrders = response.data.total;
                updatePaginationInfo();
                updatePagination();
                
                if (response.data.orders.length === 0) {
                    showNoData(true);
                } else {
                    showNoData(false);
                }
            } else {
                showError('Failed to load orders: ' + (response.message || 'Unknown error'));
                showNoData(true);
            }
        },
        error: function(xhr, status, error) {
            showLoading(false);
            showError('Connection error: ' + error);
            showNoData(true);
        }
    });
}

// Render orders in table
function renderOrders(orders) {
    const tbody = $('#ordersTableBody');
    tbody.empty();

    if (!orders || orders.length === 0) {
        return;
    }

    orders.forEach(function(order) {
        const row = `
            <tr>
                <td><strong>#${order.id}</strong></td>
                <td>
                    <div><strong>${escapeHtml(order.user_name)}</strong></div>
                    <small class="text-muted">${escapeHtml(order.user_email)}</small>
                </td>
                <td>
                    <div class="text-truncate-custom" title="${escapeHtml(order.product_name)}">
                        <strong>${escapeHtml(order.product_name)}</strong>
                    </div>
                    <small class="text-success">$${parseFloat(order.product_price).toFixed(2)}</small>
                </td>
                <td>
                    <span class="badge badge-secondary">${order.quantity}</span>
                </td>
                <td>${formatDateTime(order.order_date)}</td>
                <td>
                    <span class="badge purchase-type-badge badge-${order.purchase_type}">
                        ${order.purchase_type.charAt(0).toUpperCase() + order.purchase_type.slice(1)}
                    </span>
                </td>
                <td>
                    <span class="badge status-badge badge-${order.order_status}">
                        ${order.order_status.charAt(0).toUpperCase() + order.order_status.slice(1)}
                    </span>
                </td>
                <td class="table-actions">
                    <button class="btn btn-info btn-sm" onclick="viewOrderDetails(${order.id})" title="View Details">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="editOrderStatus(${order.id})" title="Update Status">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteOrder(${order.id})" title="Delete Order">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        tbody.append(row);
    });
}

// View order details in modal
function viewOrderDetails(orderId) {
    showLoading(true, 'Loading order details...');
    
    $.ajax({
        url: 'ajax/order_action.php',
        type: 'POST',
        data: {
            action: 'get_order_details',
            order_id: orderId
        },
        dataType: 'json',
        success: function(response) {
            showLoading(false);
            
            if (response.success) {
                displayOrderDetails(response.data);
                $('#orderDetailsModal').modal('show');
            } else {
                showError('Failed to load order details: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            showLoading(false);
            showError('Connection error: ' + error);
        }
    });
}

// Display order details in modal
function displayOrderDetails(order) {
    const modalBody = $('#orderDetailsBody');
    
    const detailsHtml = `
        <div class="order-details-section">
            <h6 class="text-primary">Order Information</h6>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Order ID:</strong> #${order.id}</p>
                    <p><strong>Order Date:</strong> ${formatDateTime(order.order_date)}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge status-badge badge-${order.order_status}">
                            ${order.order_status.charAt(0).toUpperCase() + order.order_status.slice(1)}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Quantity:</strong> ${order.quantity}</p>
                    <p><strong>Purchase Type:</strong> 
                        <span class="badge purchase-type-badge badge-${order.purchase_type}">
                            ${order.purchase_type.charAt(0).toUpperCase() + order.purchase_type.slice(1)}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="order-details-section">
            <h6 class="text-primary">Customer Information</h6>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> ${escapeHtml(order.user_name)}</p>
                    <p><strong>Email:</strong> ${escapeHtml(order.user_email)}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Phone:</strong> ${escapeHtml(order.user_phone || 'N/A')}</p>
                    <p><strong>Address:</strong> ${escapeHtml(order.user_address || 'N/A')}</p>
                </div>
            </div>
        </div>

        <div class="order-details-section">
            <h6 class="text-primary">Product Information</h6>
            <div class="row">
                <div class="col-md-8">
                    <p><strong>Product Name:</strong> ${escapeHtml(order.product_name)}</p>
                    <p><strong>Description:</strong> ${escapeHtml(order.product_description || 'N/A')}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Price:</strong> $${parseFloat(order.product_price).toFixed(2)}</p>
                    <p><strong>Total:</strong> $${(parseFloat(order.product_price) * parseInt(order.quantity)).toFixed(2)}</p>
                </div>
            </div>
        </div>
    `;
    
    modalBody.html(detailsHtml);
    $('#orderDetailsModal').data('order-id', order.id);
}

// Edit order status
function editOrderStatus(orderId) {
    // First get current order details
    $.ajax({
        url: 'ajax/order_action.php',
        type: 'POST',
        data: {
            action: 'get_order_details',
            order_id: orderId
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#updateOrderId').val(orderId);
                $('#newStatus').val(response.data.order_status);
                $('#statusNotes').val('');
                $('#statusUpdateModal').modal('show');
            } else {
                showError('Failed to load order details: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            showError('Connection error: ' + error);
        }
    });
}

// Save status update
function saveStatusUpdate() {
    const orderId = $('#updateOrderId').val();
    const newStatus = $('#newStatus').val();
    const notes = $('#statusNotes').val();
    
    if (!orderId || !newStatus) {
        showError('Please fill in all required fields.');
        return;
    }
    
    $.ajax({
        url: 'ajax/order_action.php',
        type: 'POST',
        data: {
            action: 'update_order_status',
            order_id: orderId,
            new_status: newStatus,
            notes: notes
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#statusUpdateModal').modal('hide');
                showSuccess('Order status updated successfully!');
                loadOrders(); // Reload orders
            } else {
                showError('Failed to update order status: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            showError('Connection error: ' + error);
        }
    });
}

// Delete order
function deleteOrder(orderId) {
    if (!confirm('Are you sure you want to delete this order? This action cannot be undone.')) {
        return;
    }
    
    $.ajax({
        url: 'ajax/order_action.php',
        type: 'POST',
        data: {
            action: 'delete_order',
            order_id: orderId
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showSuccess('Order deleted successfully!');
                loadOrders(); // Reload orders
            } else {
                showError('Failed to delete order: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            showError('Connection error: ' + error);
        }
    });
}

// Clear all filters
function clearFilters() {
    $('#searchInput').val('');
    $('#statusFilter').val('');
    $('#deliveryFilter').val('');
    
    currentFilters = {
        search: '',
        status: '',
        purchaseType: ''
    };
    
    currentPage = 1;
    loadOrders();
}

// Export orders - continuation from where it was cut off
function exportOrders() {
    showLoading(true, 'Preparing export...');
    
    const exportData = {
        action: 'export_orders',
        search: currentFilters.search,
        status: currentFilters.status,
        purchase_type: currentFilters.purchaseType
    };
    
    // Create a form and submit it to trigger download
    const form = $('<form>', {
        'method': 'POST',
        'action': 'ajax/order_action.php'
    });
    
    // Add data as hidden inputs
    $.each(exportData, function(key, value) {
        form.append($('<input>', {
            'type': 'hidden',
            'name': key,
            'value': value
        }));
    });
    
    // Submit form
    form.appendTo('body').submit().remove();
    
    showLoading(false);
    showSuccess('Export started! Download will begin shortly.');
}

// Pagination functions
function updatePaginationInfo() {
    const startItem = (currentPage - 1) * ordersPerPage + 1;
    const endItem = Math.min(currentPage * ordersPerPage, totalOrders);
    
    $('#paginationInfo').html(`
        Showing ${startItem} to ${endItem} of ${totalOrders} orders
    `);
}

function updatePagination() {
    const totalPages = Math.ceil(totalOrders / ordersPerPage);
    const paginationContainer = $('#paginationContainer');
    
    if (totalPages <= 1) {
        paginationContainer.hide();
        return;
    }
    
    paginationContainer.show();
    
    let paginationHtml = '<nav><ul class="pagination pagination-sm justify-content-center">';
    
    // Previous button
    if (currentPage > 1) {
        paginationHtml += `<li class="page-item">
            <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">Previous</a>
        </li>`;
    } else {
        paginationHtml += '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
    }
    
    // Page numbers
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, currentPage + 2);
    
    if (startPage > 1) {
        paginationHtml += '<li class="page-item"><a class="page-link" href="#" onclick="changePage(1)">1</a></li>';
        if (startPage > 2) {
            paginationHtml += '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }
    
    for (let i = startPage; i <= endPage; i++) {
        if (i === currentPage) {
            paginationHtml += `<li class="page-item active"><span class="page-link">${i}</span></li>`;
        } else {
            paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="changePage(${i})">${i}</a></li>`;
        }
    }
    
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            paginationHtml += '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="changePage(${totalPages})">${totalPages}</a></li>`;
    }
    
    // Next button
    if (currentPage < totalPages) {
        paginationHtml += `<li class="page-item">
            <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Next</a>
        </li>`;
    } else {
        paginationHtml += '<li class="page-item disabled"><span class="page-link">Next</span></li>';
    }
    
    paginationHtml += '</ul></nav>';
    
    paginationContainer.html(paginationHtml);
}

function changePage(page) {
    currentPage = page;
    loadOrders();
}

// Utility functions
function showLoading(show, message = 'Loading...') {
    if (show) {
        $('#loadingOverlay').show();
        $('#loadingMessage').text(message);
    } else {
        $('#loadingOverlay').hide();
    }
}

function showNoData(show) {
    if (show) {
        $('#noDataMessage').show();
        $('#ordersTable').hide();
        $('#paginationContainer').hide();
    } else {
        $('#noDataMessage').hide();
        $('#ordersTable').show();
    }
}

function showError(message) {
    toastr.error(message, 'Error', {
        closeButton: true,
        progressBar: true,
        timeOut: 5000
    });
}

function showSuccess(message) {
    toastr.success(message, 'Success', {
        closeButton: true,
        progressBar: true,
        timeOut: 3000
    });
}

function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function formatDateTime(dateString) {
    if (!dateString) return 'N/A';
    
    const date = new Date(dateString);
    const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    
    return date.toLocaleDateString('en-US', options);
}

// Additional utility functions for order management
function refreshOrders() {
    loadOrders();
    showSuccess('Orders refreshed successfully!');
}

function changeOrdersPerPage(newLimit) {
    ordersPerPage = parseInt(newLimit);
    currentPage = 1;
    loadOrders();
}

// Bulk actions
function selectAllOrders() {
    const checkboxes = $('.order-checkbox');
    const selectAllCheckbox = $('#selectAllOrders');
    
    checkboxes.prop('checked', selectAllCheckbox.is(':checked'));
    updateBulkActions();
}

function updateBulkActions() {
    const selectedOrders = $('.order-checkbox:checked');
    const bulkActionsBtn = $('#bulkActionsBtn');
    
    if (selectedOrders.length > 0) {
        bulkActionsBtn.show();
        $('#selectedCount').text(selectedOrders.length);
    } else {
        bulkActionsBtn.hide();
    }
}

function bulkStatusUpdate() {
    const selectedOrders = $('.order-checkbox:checked');
    const orderIds = [];
    
    selectedOrders.each(function() {
        orderIds.push($(this).val());
    });
    
    if (orderIds.length === 0) {
        showError('Please select at least one order.');
        return;
    }
    
    $('#bulkOrderIds').val(orderIds.join(','));
    $('#bulkStatusModal').modal('show');
}

function saveBulkStatusUpdate() {
    const orderIds = $('#bulkOrderIds').val();
    const newStatus = $('#bulkNewStatus').val();
    const notes = $('#bulkStatusNotes').val();
    
    if (!orderIds || !newStatus) {
        showError('Please fill in all required fields.');
        return;
    }
    
    $.ajax({
        url: 'ajax/order_action.php',
        type: 'POST',
        data: {
            action: 'bulk_update_status',
            order_ids: orderIds,
            new_status: newStatus,
            notes: notes
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#bulkStatusModal').modal('hide');
                showSuccess('Bulk status update completed successfully!');
                loadOrders();
                // Clear selections
                $('.order-checkbox').prop('checked', false);
                $('#selectAllOrders').prop('checked', false);
                updateBulkActions();
            } else {
                showError('Failed to update order statuses: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            showError('Connection error: ' + error);
        }
    });
}

// Initialize tooltips and other UI elements
function initializeUIElements() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Initialize toastr options
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };
}

// Call initialization when document is ready
$(document).ready(function() {
    initializeUIElements();
});