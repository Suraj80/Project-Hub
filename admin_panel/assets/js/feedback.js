// Feedback Management JavaScript

let currentPage = 1;
const feedbackPerPage = 10;
let allFeedback = [];
let filteredFeedback = [];
let currentFeedbackId = null;

// Initialize page when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    loadFeedback();
    setupEventListeners();
});

// Setup event listeners
function setupEventListeners() {
    document.getElementById('searchInput').addEventListener('input', filterFeedback);
    document.getElementById('statusFilter').addEventListener('change', filterFeedback);
}

// Load feedback data via AJAX
function loadFeedback() {
    showLoading();
    
    $.ajax({
        url: 'ajax/feedback_action.php',
        type: 'POST',
        data: {
            action: 'get_feedback'
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                allFeedback = response.data;
                // Sort by created_at descending (newest first)
                allFeedback.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                // Filter out replied feedback (auto-discard feature)
                filteredFeedback = allFeedback.filter(feedback => feedback.status !== 'replied');
                currentPage = 1;
                renderFeedback();
            } else {
                showError('Failed to load feedback: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            showError('Failed to load feedback. Please check your connection and try again.');
        }
    });
}

// Show loading state
function showLoading() {
    const tableBody = document.getElementById('feedbackTableBody');
    tableBody.innerHTML = `
        <tr>
            <td colspan="7" class="text-center loading-row">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2">Loading feedback...</p>
            </td>
        </tr>
    `;
}

// Show error message
function showError(message) {
    const tableBody = document.getElementById('feedbackTableBody');
    tableBody.innerHTML = `
        <tr>
            <td colspan="7" class="text-center">
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    ${message}
                    <br>
                    <button class="btn btn-primary btn-sm mt-2" onclick="loadFeedback()">
                        <i class="fas fa-refresh"></i> Retry
                    </button>
                </div>
            </td>
        </tr>
    `;
}

// Get status class for styling
function getStatusClass(status) {
    switch(status.toLowerCase()) {
        case 'new': return 'status-new';
        case 'read': return 'status-read';
        case 'replied': return 'status-replied';
        default: return 'status-new';
    }
}

// Format date time
function formatDateTime(dateString) {
    if (!dateString) return 'N/A';
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Render feedback table
function renderFeedback() {
    const tableBody = document.getElementById('feedbackTableBody');
    const startIndex = (currentPage - 1) * feedbackPerPage;
    const endIndex = startIndex + feedbackPerPage;
    const currentFeedback = filteredFeedback.slice(startIndex, endIndex);

    if (currentFeedback.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="7" class="text-center">
                    <p class="text-muted mb-0">No feedback entries found.</p>
                </td>
            </tr>
        `;
    } else {
        tableBody.innerHTML = '';

        currentFeedback.forEach(feedback => {
            const row = document.createElement('tr');
            row.className = 'feedback-row';
            
            // Generate action buttons based on status
            let actionButtons = `<button class="btn btn-info btn-sm btn-action" onclick="viewFeedback(${feedback.id})">
                <i class="fas fa-eye"></i> View
            </button>`;
            
            // Only show Read button for 'new' status
            if (feedback.status === 'new') {
                actionButtons += `<button class="btn btn-success btn-sm btn-action" onclick="markAsRead(${feedback.id})">
                    <i class="fas fa-check"></i> Read
                </button>`;
            }
            
            // Show Replied button for 'new' and 'read' status (not for 'replied')
            if (feedback.status !== 'replied') {
                actionButtons += `<button class="btn btn-primary btn-sm btn-action" onclick="markAsReplied(${feedback.id})">
                    <i class="fas fa-reply"></i> Replied
                </button>`;
            }
            
            row.innerHTML = `
                <td>${feedback.id}</td>
                <td>${feedback.name || 'N/A'}</td>
                <td>${feedback.email || 'N/A'}</td>
                <td>
                    <div class="subject-preview" title="${feedback.subject || 'N/A'}">
                        ${feedback.subject || 'N/A'}
                    </div>
                </td>
                <td>
                    <span class="status-badge ${getStatusClass(feedback.status)}">
                        ${feedback.status ? feedback.status.charAt(0).toUpperCase() + feedback.status.slice(1) : 'New'}
                    </span>
                </td>
                <td>${formatDateTime(feedback.created_at)}</td>
                <td>${actionButtons}</td>
            `;
            tableBody.appendChild(row);
        });
    }

    updatePaginationInfo();
}

// Update pagination information
function updatePaginationInfo() {
    const startIndex = filteredFeedback.length > 0 ? (currentPage - 1) * feedbackPerPage + 1 : 0;
    const endIndex = Math.min(currentPage * feedbackPerPage, filteredFeedback.length);
    
    document.getElementById('showingStart').textContent = startIndex;
    document.getElementById('showingEnd').textContent = endIndex;
    document.getElementById('totalFeedback').textContent = filteredFeedback.length;
    document.getElementById('currentPageSpan').textContent = currentPage;
    
    // Update pagination buttons
    const maxPage = Math.ceil(filteredFeedback.length / feedbackPerPage);
    document.getElementById('prevPageBtn').disabled = currentPage <= 1;
    document.getElementById('nextPageBtn').disabled = currentPage >= maxPage || filteredFeedback.length === 0;
}

// Change page
function changePage(direction) {
    const newPage = currentPage + direction;
    const maxPage = Math.ceil(filteredFeedback.length / feedbackPerPage);
    
    if (newPage >= 1 && newPage <= maxPage) {
        currentPage = newPage;
        renderFeedback();
    }
}

// Filter feedback based on search and status
function filterFeedback() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    
    // Start from all non-replied feedback
    let baseData = allFeedback.filter(feedback => feedback.status !== 'replied');
    
    filteredFeedback = baseData.filter(feedback => {
        const matchesSearch = !searchTerm || 
            feedback.id.toString().includes(searchTerm) ||
            (feedback.name && feedback.name.toLowerCase().includes(searchTerm));
        
        const matchesStatus = !statusFilter || feedback.status === statusFilter;
        
        return matchesSearch && matchesStatus;
    });
    
    currentPage = 1;
    renderFeedback();
}

// View feedback details
function viewFeedback(feedbackId) {
    const feedback = allFeedback.find(f => f.id === feedbackId);
    if (!feedback) return;
    
    currentFeedbackId = feedbackId;
    
    // Update modal content with proper text wrapping for message
    document.getElementById('viewFeedbackId').textContent = feedback.id;
    document.getElementById('viewFeedbackName').textContent = feedback.name || 'N/A';
    document.getElementById('viewFeedbackEmail').textContent = feedback.email || 'N/A';
    document.getElementById('viewFeedbackSubject').textContent = feedback.subject || 'N/A';
    
    // Handle message display with proper formatting
    const messageElement = document.getElementById('viewFeedbackMessage');
    messageElement.innerHTML = ''; // Clear previous content
    
    if (feedback.message) {
        // Create a text node to prevent XSS and preserve formatting
        const messageText = document.createTextNode(feedback.message);
        messageElement.appendChild(messageText);
        
        // Apply white-space: pre-wrap to preserve line breaks
        messageElement.style.whiteSpace = 'pre-wrap';
        messageElement.style.wordWrap = 'break-word';
    } else {
        messageElement.textContent = 'N/A';
    }
    
    document.getElementById('viewFeedbackCreatedAt').textContent = formatDateTime(feedback.created_at);
    
    // Update status badge
    const statusElement = document.getElementById('viewFeedbackStatus');
    statusElement.textContent = feedback.status ? feedback.status.charAt(0).toUpperCase() + feedback.status.slice(1) : 'New';
    statusElement.className = `status-badge ${getStatusClass(feedback.status)}`;
    
    // Update modal buttons based on current status
    const markAsReadBtn = document.getElementById('markAsReadBtn');
    const markAsRepliedBtn = document.getElementById('markAsRepliedBtn');
    
    // Show Read button only for 'new' status
    markAsReadBtn.style.display = feedback.status === 'new' ? 'inline-block' : 'none';
    
    // Show Replied button for 'new' and 'read' status
    markAsRepliedBtn.style.display = feedback.status !== 'replied' ? 'inline-block' : 'none';
    
    // Show the modal
    $('#viewFeedbackModal').modal('show');
    
    // Automatically mark as read if it's new
    if (feedback.status === 'new') {
        setTimeout(() => {
            markAsRead(feedbackId, false); // false = don't show alert
        }, 1000);
    }
}

// Mark feedback as read
function markAsRead(feedbackId = null, showAlert = true) {
    const id = feedbackId || currentFeedbackId;
    if (!id) return;
    
    $.ajax({
        url: 'ajax/feedback_action.php',
        type: 'POST',
        data: {
            action: 'update_status',
            feedback_id: id,
            status: 'read'
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Update local data
                const feedbackIndex = allFeedback.findIndex(f => f.id === id);
                if (feedbackIndex !== -1) {
                    allFeedback[feedbackIndex].status = 'read';
                }
                
                // Update filtered data
                const filteredIndex = filteredFeedback.findIndex(f => f.id === id);
                if (filteredIndex !== -1) {
                    filteredFeedback[filteredIndex].status = 'read';
                }
                
                // Re-render table
                renderFeedback();
                
                // Update modal if it's open
                if (currentFeedbackId === id) {
                    const statusElement = document.getElementById('viewFeedbackStatus');
                    statusElement.textContent = 'Read';
                    statusElement.className = 'status-badge status-read';
                    
                    // Update button visibility
                    document.getElementById('markAsReadBtn').style.display = 'none';
                    document.getElementById('markAsRepliedBtn').style.display = 'inline-block';
                }
                
                if (showAlert) {
                    alert('Feedback marked as read successfully.');
                }
            } else {
                alert('Failed to update feedback status: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            alert('Failed to update feedback status. Please try again.');
        }
    });
}

// Mark feedback as replied
function markAsReplied(feedbackId = null) {
    const id = feedbackId || currentFeedbackId;
    if (!id) return;
    
    if (!confirm('Are you sure you want to mark this feedback as replied? This will remove it from the list.')) {
        return;
    }
    
    $.ajax({
        url: 'ajax/feedback_action.php',
        type: 'POST',
        data: {
            action: 'update_status',
            feedback_id: id,
            status: 'replied'
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Update local data
                const feedbackIndex = allFeedback.findIndex(f => f.id === id);
                if (feedbackIndex !== -1) {
                    allFeedback[feedbackIndex].status = 'replied';
                }
                
                // Remove from filtered data (auto-discard feature)
                filteredFeedback = filteredFeedback.filter(f => f.id !== id);
                
                // Adjust current page if necessary
                const maxPage = Math.ceil(filteredFeedback.length / feedbackPerPage);
                if (currentPage > maxPage && maxPage > 0) {
                    currentPage = maxPage;
                }
                
                // Re-render table
                renderFeedback();
                
                // Close modal if it's open
                if (currentFeedbackId === id) {
                    $('#viewFeedbackModal').modal('hide');
                    currentFeedbackId = null;
                }
                
                alert('Feedback marked as replied and removed from the list successfully.');
            } else {
                alert('Failed to update feedback status: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            alert('Failed to update feedback status. Please try again.');
        }
    });
}