// Feedback Management JavaScript with improved debugging

// Global variables
let feedbackData = [];
let filteredData = [];
let currentPage = 1;
let itemsPerPage = 5;
let currentFeedbackId = null;

// Initialize the page
$(document).ready(function() {
    console.log('Feedback management system initializing...');
    loadFeedbackFromServer();
    setupEventListeners();
});

// Setup event listeners
function setupEventListeners() {
    console.log('Setting up event listeners...');
    
    // Search functionality
    $('#searchInput').on('input', function() {
        applyFilters();
    });

    // Status filter
    $('#statusFilter').on('change', function() {
        applyFilters();
    });

    // Pagination buttons
    $('#prevPageBtn').on('click', function() {
        changePage(-1);
    });

    $('#nextPageBtn').on('click', function() {
        changePage(1);
    });

    // Modal action buttons
    $('#markAsReadBtn').on('click', function() {
        markAsRead();
    });

    $('#markAsRepliedBtn').on('click', function() {
        markAsReplied();
    });

    $('#deleteFeedbackBtn').on('click', function() {
        deleteFeedback();
    });

    // Sidebar toggle
    $('#sidebarToggle, #sidebarToggleTop').on('click', function() {
        $('body').toggleClass('sidebar-toggled');
        $('.sidebar').toggleClass('toggled');
    });
}

// Load feedback data from server
function loadFeedbackFromServer() {
    console.log('Loading feedback from server...');
    showLoadingState();
    
    $.ajax({
        url: 'ajax/feedback_action.php',
        type: 'POST',
        data: {
            action: 'get_feedback'
        },
        dataType: 'json',
        timeout: 10000, // 10 second timeout
        success: function(response) {
            console.log('Server response:', response);
            
            if (response.success) {
                feedbackData = response.data || [];
                filteredData = [...feedbackData];
                console.log('Loaded', feedbackData.length, 'feedback items');
                loadFeedbackData();
                updateFeedbackStats();
            } else {
                console.error('Server returned error:', response.message);
                showError('Failed to load feedback: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error Details:');
            console.error('Status:', status);
            console.error('Error:', error);
            console.error('Response Text:', xhr.responseText);
            console.error('Status Code:', xhr.status);
            
            let errorMessage = 'Failed to load feedback. ';
            
            if (xhr.status === 0) {
                errorMessage += 'Unable to connect to server. Check if the server is running.';
            } else if (xhr.status === 404) {
                errorMessage += 'Feedback action file not found (404). Check the file path.';
            } else if (xhr.status === 500) {
                errorMessage += 'Server error (500). Check server logs for details.';
            } else if (status === 'timeout') {
                errorMessage += 'Request timed out. Server may be slow or unresponsive.';
            } else if (status === 'parsererror') {
                errorMessage += 'Invalid JSON response from server.';
            } else {
                errorMessage += `Server responded with error ${xhr.status}: ${error}`;
            }
            
            showError(errorMessage);
        }
    });
}

// Show loading state
function showLoadingState() {
    const tableBody = $('#feedbackTableBody');
    if (tableBody.length === 0) {
        console.error('feedbackTableBody element not found! Check your HTML.');
        return;
    }
    
    tableBody.html(`
        <tr class="loading-row">
            <td colspan="7" class="text-center py-4">
                <i class="fas fa-spinner fa-spin fa-2x text-muted mb-2"></i>
                <p class="text-muted">Loading feedback...</p>
            </td>
        </tr>
    `);
}

// Show error state
function showError(message) {
    console.error('Showing error:', message);
    const tableBody = $('#feedbackTableBody');
    
    if (tableBody.length === 0) {
        console.error('feedbackTableBody element not found! Check your HTML.');
        // Try to show error in console and alert as fallback
        alert('Error: ' + message + '\n\nAdditionally, the feedbackTableBody element was not found in the HTML.');
        return;
    }
    
    tableBody.html(`
        <tr>
            <td colspan="7" class="text-center py-4">
                <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                <p class="text-danger">${message}</p>
                <button class="btn btn-primary btn-sm" onclick="loadFeedbackFromServer()">
                    <i class="fas fa-redo mr-1"></i>Retry
                </button>
            </td>
        </tr>
    `);
    updatePaginationInfo(0, 0, 0);
}

// Apply search and filter
function applyFilters() {
    const searchTerm = $('#searchInput').val().toLowerCase();
    const statusFilter = $('#statusFilter').val();

    filteredData = feedbackData.filter(feedback => {
        const matchesSearch = !searchTerm || 
            feedback.id.toString().includes(searchTerm) ||
            (feedback.name && feedback.name.toLowerCase().includes(searchTerm)) ||
            (feedback.email && feedback.email.toLowerCase().includes(searchTerm)) ||
            (feedback.subject && feedback.subject.toLowerCase().includes(searchTerm));

        const matchesStatus = !statusFilter || feedback.status === statusFilter;

        return matchesSearch && matchesStatus;
    });

    currentPage = 1;
    loadFeedbackData();
}

// Load feedback data into table
function loadFeedbackData() {
    console.log('Loading feedback data into table...');
    const tableBody = $('#feedbackTableBody');
    
    if (tableBody.length === 0) {
        console.error('feedbackTableBody element not found! Check your HTML.');
        return;
    }
    
    tableBody.empty();

    if (filteredData.length === 0) {
        tableBody.append(`
            <tr>
                <td colspan="7" class="text-center py-4">
                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                    <p class="text-muted">No feedback found</p>
                </td>
            </tr>
        `);
        updatePaginationInfo(0, 0, 0);
        return;
    }

    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedData = filteredData.slice(startIndex, endIndex);

    console.log('Rendering', paginatedData.length, 'feedback items for page', currentPage);

    paginatedData.forEach(feedback => {
        const statusBadge = getStatusBadge(feedback.status);
        const subjectPreview = feedback.subject && feedback.subject.length > 30 ? 
            feedback.subject.substring(0, 30) + '...' : (feedback.subject || 'No subject');

        tableBody.append(`
            <tr class="feedback-row">
                <td>${feedback.id}</td>
                <td>${feedback.name || 'N/A'}</td>
                <td>${feedback.email || 'N/A'}</td>
                <td class="subject-preview" title="${feedback.subject || 'No subject'}">${subjectPreview}</td>
                <td>${statusBadge}</td>
                <td>${formatDate(feedback.created_at)}</td>
                <td>
                    <button class="btn btn-info btn-sm btn-action" onclick="viewFeedback(${feedback.id})" title="View Details">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-success btn-sm btn-action" onclick="markAsRead(${feedback.id})" title="Mark as Read" ${feedback.status === 'read' || feedback.status === 'replied' ? 'disabled' : ''}>
                        <i class="fas fa-check"></i>
                    </button>
                    <button class="btn btn-primary btn-sm btn-action" onclick="markAsReplied(${feedback.id})" title="Reply" ${feedback.status === 'replied' ? 'disabled' : ''}>
                        <i class="fas fa-reply"></i>
                    </button>
                    <button class="btn btn-danger btn-sm btn-action" onclick="confirmDelete(${feedback.id})" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `);
    });

    updatePaginationInfo(startIndex + 1, Math.min(endIndex, filteredData.length), filteredData.length);
    updatePaginationButtons();
}

// Get status badge HTML
function getStatusBadge(status) {
    const badges = {
        'new': '<span class="status-badge status-new">New</span>',
        'read': '<span class="status-badge status-read">Read</span>',
        'replied': '<span class="status-badge status-replied">Replied</span>'
    };
    return badges[status] || `<span class="status-badge">${status}</span>`;
}

// Format date
function formatDate(dateString) {
    if (!dateString) return 'N/A';
    
    try {
        const date = new Date(dateString);
        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    } catch (e) {
        console.error('Error formatting date:', dateString, e);
        return dateString;
    }
}

// View feedback details
function viewFeedback(feedbackId) {
    const feedback = feedbackData.find(f => f.id == feedbackId);
    if (!feedback) {
        showAlert('Feedback not found', 'error');
        return;
    }

    currentFeedbackId = feedbackId;

    $('#viewFeedbackId').text(feedback.id);
    $('#viewFeedbackName').text(feedback.name || 'N/A');
    $('#viewFeedbackEmail').text(feedback.email || 'N/A');
    $('#viewFeedbackSubject').text(feedback.subject || 'No subject');
    $('#viewFeedbackStatus').html(getStatusBadge(feedback.status));
    $('#viewFeedbackCreatedAt').text(formatDate(feedback.created_at));
    $('#viewFeedbackMessage').text(feedback.message || 'No message content');

    // Update button states
    updateModalButtons(feedback.status);

    $('#viewFeedbackModal').modal('show');
}

// Update modal button states based on feedback status
function updateModalButtons(status) {
    const readBtn = $('#markAsReadBtn');
    const repliedBtn = $('#markAsRepliedBtn');
    
    // Disable mark as read if already read or replied
    if (status === 'read' || status === 'replied') {
        readBtn.prop('disabled', true);
    } else {
        readBtn.prop('disabled', false);
    }
    
    // Disable mark as replied if already replied
    if (status === 'replied') {
        repliedBtn.prop('disabled', true);
    } else {
        repliedBtn.prop('disabled', false);
    }
}

// Mark feedback as read
function markAsRead(feedbackId = null) {
    const id = feedbackId || currentFeedbackId;
    if (!id) return;

    updateFeedbackStatus(id, 'read', 'Feedback marked as read successfully!');
}

// Mark feedback as replied
function markAsReplied(feedbackId = null) {
    const id = feedbackId || currentFeedbackId;
    if (!id) return;

    updateFeedbackStatus(id, 'replied', 'Feedback marked as replied successfully!');
}

// Update feedback status via AJAX
function updateFeedbackStatus(feedbackId, status, successMessage) {
    console.log('Updating feedback status:', feedbackId, 'to', status);
    
    // Show loading state on button
    const buttonMap = {
        'read': '#markAsReadBtn',
        'replied': '#markAsRepliedBtn'
    };
    
    const button = $(buttonMap[status]);
    const originalHtml = button.html();
    button.html('<i class="fas fa-spinner fa-spin mr-1"></i>Processing...').prop('disabled', true);

    $.ajax({
        url: 'ajax/feedback_action.php',
        type: 'POST',
        data: {
            action: 'update_status',
            feedback_id: feedbackId,
            status: status
        },
        dataType: 'json',
        success: function(response) {
            console.log('Status update response:', response);
            
            if (response.success) {
                // Update local data
                const feedbackIndex = feedbackData.findIndex(f => f.id == feedbackId);
                if (feedbackIndex !== -1) {
                    feedbackData[feedbackIndex].status = status;
                }
                
                // Refresh display
                applyFilters();
                
                // Update modal if it's open
                if (currentFeedbackId == feedbackId) {
                    $('#viewFeedbackStatus').html(getStatusBadge(status));
                    updateModalButtons(status);
                }

                showAlert(successMessage, 'success');
            } else {
                showAlert('Failed to update status: ' + response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error('Status update error:', error);
            console.error('Response:', xhr.responseText);
            showAlert('Failed to update feedback status. Please try again.', 'error');
        },
        complete: function() {
            // Restore button state
            button.html(originalHtml).prop('disabled', false);
        }
    });
}

// Confirm delete feedback
function confirmDelete(feedbackId) {
    if (confirm('Are you sure you want to delete this feedback? This action cannot be undone.')) {
        deleteFeedback(feedbackId);
    }
}

// Delete feedback
function deleteFeedback(feedbackId = null) {
    const id = feedbackId || currentFeedbackId;
    if (!id) return;

    console.log('Deleting feedback:', id);

    // For now, we'll implement client-side deletion
    // You can extend this to call the server if needed
    const feedbackIndex = feedbackData.findIndex(f => f.id == id);
    if (feedbackIndex !== -1) {
        feedbackData.splice(feedbackIndex, 1);
        applyFilters();
        $('#viewFeedbackModal').modal('hide');
        showAlert('Feedback deleted successfully!', 'success');
    } else {
        showAlert('Feedback not found', 'error');
    }
}

// Pagination functions
function changePage(direction) {
    const totalPages = Math.ceil(filteredData.length / itemsPerPage);
    const newPage = currentPage + direction;

    if (newPage >= 1 && newPage <= totalPages) {
        currentPage = newPage;
        loadFeedbackData();
    }
}

function updatePaginationInfo(start, end, total) {
    $('#showingStart').text(start);
    $('#showingEnd').text(end);
    $('#totalFeedback').text(total);
}

function updatePaginationButtons() {
    const totalPages = Math.ceil(filteredData.length / itemsPerPage);
    
    $('#prevPageBtn').prop('disabled', currentPage <= 1);
    $('#nextPageBtn').prop('disabled', currentPage >= totalPages || filteredData.length === 0);
    $('#currentPageSpan').text(currentPage);
}

// Show alert messages
function showAlert(message, type) {
    console.log('Showing alert:', type, message);
    
    const alertClass = type === 'success' ? 'alert-success' : 
                     type === 'warning' ? 'alert-warning' : 'alert-danger';
    
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-exclamation-circle'} mr-2"></i>
            ${message}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    `;
    
    // Remove existing alerts
    $('.alert').remove();
    
    // Add new alert to the top of the page
    const alertContainer = $('#alertContainer');
    if (alertContainer.length > 0) {
        alertContainer.html(alertHtml);
    } else {
        // Fallback: prepend to body if alertContainer doesn't exist
        $('body').prepend('<div id="alertContainer">' + alertHtml + '</div>');
    }
    
    // Auto-hide success messages after 3 seconds
    if (type === 'success') {
        setTimeout(() => {
            $('.alert').fadeOut(() => {
                $('.alert').remove();
            });
        }, 3000);
    }
}

// Statistics functions
function updateFeedbackStats() {
    if (feedbackData.length === 0) return;
    
    const stats = {
        total: feedbackData.length,
        new: feedbackData.filter(f => f.status === 'new').length,
        read: feedbackData.filter(f => f.status === 'read').length,
        replied: feedbackData.filter(f => f.status === 'replied').length
    };

    console.log('Feedback stats:', stats);

    // Update stats elements if they exist
    if ($('#totalFeedbackStat').length) $('#totalFeedbackStat').text(stats.total);
    if ($('#newFeedbackStat').length) $('#newFeedbackStat').text(stats.new);
    if ($('#readFeedbackStat').length) $('#readFeedbackStat').text(stats.read);
    if ($('#repliedFeedbackStat').length) $('#repliedFeedbackStat').text(stats.replied);

    // Update progress bars if they exist
    const totalNonNew = stats.total - stats.new;
    const readPercentage = stats.total > 0 ? Math.round((stats.read / stats.total) * 100) : 0;
    const repliedPercentage = stats.total > 0 ? Math.round((stats.replied / stats.total) * 100) : 0;

    if ($('#readProgressBar').length) {
        $('#readProgressBar').css('width', readPercentage + '%').attr('aria-valuenow', readPercentage);
    }
    if ($('#repliedProgressBar').length) {
        $('#repliedProgressBar').css('width', repliedPercentage + '%').attr('aria-valuenow', repliedPercentage);
    }
}

// Debug function to test server connectivity
function testServerConnection() {
    console.log('Testing server connection...');
    
    $.ajax({
        url: 'ajax/feedback_action.php',
        type: 'POST',
        data: {
            action: 'test'
        },
        success: function(response) {
            console.log('Server connection test successful:', response);
        },
        error: function(xhr, status, error) {
            console.error('Server connection test failed:');
            console.error('Status:', status);
            console.error('Error:', error);
            console.error('Response:', xhr.responseText);
        }
    });
}

// Call this function in browser console to test server connection
window.testServerConnection = testServerConnection;
window.loadFeedbackFromServer = loadFeedbackFromServer;