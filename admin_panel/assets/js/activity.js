// Activity Log JavaScript
let currentPage = 1;
let totalPages = 1;
let itemsPerPage = 10;
let totalLogs = 0;
let activityData = [];

$(document).ready(function() {
    // Load activity logs on page load
    loadActivityLogs();
    
    // Set up event listeners
    setupEventListeners();
    
    // Set default date filters (last 30 days)
    setDefaultDateFilters();
});

function setupEventListeners() {
    // Search input with debounce
    let searchTimeout;
    $('#searchInput').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            currentPage = 1;
            loadActivityLogs();
        }, 500);
    });
    
    // Filter dropdowns
    $('#roleFilter').on('change', function() {
        currentPage = 1;
        loadActivityLogs();
    });
    
    // Date filters
    $('#dateFrom, #dateTo').on('change', function() {
        currentPage = 1;
        loadActivityLogs();
    });
}

function setDefaultDateFilters() {
    const today = new Date();
    const thirtyDaysAgo = new Date(today);
    thirtyDaysAgo.setDate(today.getDate() - 30);
    
    $('#dateTo').val(today.toISOString().split('T')[0]);
    $('#dateFrom').val(thirtyDaysAgo.toISOString().split('T')[0]);
}

function loadActivityLogs() {
    showLoading();
    
    const searchTerm = $('#searchInput').val().trim();
    const roleFilter = $('#roleFilter').val();
    const dateFrom = $('#dateFrom').val();
    const dateTo = $('#dateTo').val();
    
    const requestData = {
        action: 'get_activity_logs',
        page: currentPage,
        limit: itemsPerPage,
        search: searchTerm,
        role: roleFilter,
        date_from: dateFrom,
        date_to: dateTo
    };
    
    $.ajax({
        url: 'ajax/activity.php',
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function(response) {
            hideLoading();
            
            if (response.success) {
                activityData = response.data;
                totalLogs = response.total;
                totalPages = Math.ceil(totalLogs / itemsPerPage);
                
                displayActivityLogs();
                updatePagination();
            } else {
                showError(response.message || 'Failed to load activity logs');
            }
        },
        error: function(xhr, status, error) {
            hideLoading();
            console.error('AJAX Error:', error);
            showError('Error loading activity logs: ' + error);
        }
    });
}

function displayActivityLogs() {
    const tbody = $('#activityTableBody');
    tbody.empty();
    
    if (activityData.length === 0) {
        $('#noDataMessage').show();
        return;
    }
    
    $('#noDataMessage').hide();
    
    activityData.forEach(function(admin) {
        const row = createActivityRow(admin);
        tbody.append(row);
    });
}

function createActivityRow(admin) {
    const profileImage = createProfileImage(admin.profile_image, admin.username);
    const roleDisplay = formatRole(admin.role);
    const statusDisplay = formatStatus(admin.status);
    const lastLogin = formatDateTime(admin.last_login);
    const ipAddress = admin.login_ip || 'N/A';
    
    return `
        <tr class="activity-row">
            <td class="text-center">${admin.id}</td>
            <td class="text-center">${profileImage}</td>
            <td>
                <a href="#" class="username-link" onclick="viewAdminDetails(${admin.id})">
                    ${escapeHtml(admin.username)}
                </a>
            </td>
            <td>${roleDisplay}</td>
            <td>${escapeHtml(admin.email || 'N/A')}</td>
            <td><span class="ip-address">${escapeHtml(ipAddress)}</span></td>
            <td><span class="datetime">${lastLogin}</span></td>
            <td class="text-center">${statusDisplay}</td>
        </tr>
    `;
}

function createProfileImage(profileImage, username) {
    if (profileImage && profileImage.trim() !== '') {
        return `<img src="${escapeHtml(profileImage)}" alt="Profile" class="profile-image" onerror="this.style.display='none'; this.nextSibling.style.display='flex';">
                <div class="admin-avatar" style="display: none;">${getInitials(username)}</div>`;
    } else {
        return `<div class="admin-avatar">${getInitials(username)}</div>`;
    }
}

function getInitials(name) {
    if (!name) return 'A';
    return name.substring(0, 2).toUpperCase();
}

function formatRole(role) {
    const roleMap = {
        'super': { text: 'Super Admin', class: 'role-super' },
        'editor': { text: 'Editor', class: 'role-editor' },
        'viewer': { text: 'Viewer', class: 'role-viewer' }
    };
    
    const roleInfo = roleMap[role] || { text: role, class: 'role-viewer' };
    return `<span class="role-badge ${roleInfo.class}">${roleInfo.text}</span>`;
}

function formatStatus(status) {
    const statusClass = status == 1 ? 'status-active' : 'status-inactive';
    const statusText = status == 1 ? 'Active' : 'Inactive';
    return `<span class="status-badge ${statusClass}">${statusText}</span>`;
}

function formatDateTime(datetime) {
    if (!datetime) return 'Never';
    
    const date = new Date(datetime);
    return date.toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function viewAdminDetails(adminId) {
    const admin = activityData.find(a => a.id == adminId);
    if (!admin) return;
    
    // Populate modal with admin details
    $('#viewAdminId').text(admin.id);
    $('#viewAdminUsername').text(admin.username);
    $('#viewAdminUsernameDetail').text(admin.username);
    $('#viewAdminFullName').text(admin.full_name || 'N/A');
    $('#viewAdminFullNameDetail').text(admin.full_name || 'N/A');
    $('#viewAdminEmail').text(admin.email || 'N/A');
    $('#viewAdminRoleDetail').text(formatRoleText(admin.role));
    $('#viewAdminStatus').text(admin.status == 1 ? 'Active' : 'Inactive');
    $('#viewAdminLastLogin').text(formatDateTime(admin.last_login));
    $('#viewAdminLoginIP').text(admin.login_ip || 'N/A');
    $('#viewAdminCreatedAt').text(formatDateTime(admin.created_at));
    $('#viewAdminUpdatedAt').text(formatDateTime(admin.updated_at));
    
    // Set profile image
    const profileImageHtml = createProfileImage(admin.profile_image, admin.username);
    $('#viewAdminProfileImage').html(profileImageHtml);
    
    // Set role badge
    $('#viewAdminRole').html(formatRole(admin.role));
    
    // Show modal
    $('#viewAdminModal').modal('show');
}

function formatRoleText(role) {
    const roleMap = {
        'super': 'Super Admin',
        'editor': 'Editor',
        'viewer': 'Viewer'
    };
    return roleMap[role] || role;
}

function updatePagination() {
    const start = totalLogs === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
    const end = Math.min(currentPage * itemsPerPage, totalLogs);
    
    $('#showingStart').text(start);
    $('#showingEnd').text(end);
    $('#totalLogs').text(totalLogs);
    $('#currentPageSpan').text(currentPage);
    
    // Update pagination buttons
    $('#prevPageBtn').prop('disabled', currentPage <= 1);
    $('#nextPageBtn').prop('disabled', currentPage >= totalPages);
}

function changePage(direction) {
    const newPage = currentPage + direction;
    
    if (newPage >= 1 && newPage <= totalPages) {
        currentPage = newPage;
        loadActivityLogs();
    }
}

function applyFilters() {
    currentPage = 1;
    loadActivityLogs();
}

function refreshActivityLog() {
    currentPage = 1;
    loadActivityLogs();
    
    // Add visual feedback
    const refreshBtn = $('button[onclick="refreshActivityLog()"]');
    const icon = refreshBtn.find('.fa-sync-alt');
    
    icon.addClass('fa-spin');
    setTimeout(() => {
        icon.removeClass('fa-spin');
    }, 1000);
}

function exportActivityLog() {
    const searchTerm = $('#searchInput').val().trim();
    const roleFilter = $('#roleFilter').val();
    const dateFrom = $('#dateFrom').val();
    const dateTo = $('#dateTo').val();
    
    const exportData = {
        action: 'export_activity_logs',
        search: searchTerm,
        role: roleFilter,
        date_from: dateFrom,
        date_to: dateTo
    };
    
   // Create a form and submit it to trigger download
    const form = $('<form>', {
        method: 'POST',
        action: 'ajax/activity.php'
    });
    
    Object.keys(exportData).forEach(key => {
        form.append($('<input>', {
            type: 'hidden',
            name: key,
            value: exportData[key]
        }));
    });
    
    // Append form to body and submit
    $('body').append(form);
    form.submit();
    form.remove();
    
    // Show success message
    showSuccess('Activity log export initiated');
}

function clearFilters() {
    $('#searchInput').val('');
    $('#roleFilter').val('');
    setDefaultDateFilters();
    currentPage = 1;
    loadActivityLogs();
}

// Utility functions
function showLoading() {
    $('#loadingSpinner').show();
    $('#activityTable').addClass('loading');
}

function hideLoading() {
    $('#loadingSpinner').hide();
    $('#activityTable').removeClass('loading');
}

function showError(message) {
    toastr.error(message, 'Error');
}

function showSuccess(message) {
    toastr.success(message, 'Success');
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
    return text.toString().replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Add keyboard shortcuts
$(document).keydown(function(e) {
    // Ctrl+F to focus search
    if (e.ctrlKey && e.keyCode === 70) {
        e.preventDefault();
        $('#searchInput').focus();
    }
    
    // ESC to clear search
    if (e.keyCode === 27) {
        $('#searchInput').val('').trigger('input');
    }
});

// Auto-refresh functionality (optional)
let autoRefreshInterval;

function toggleAutoRefresh() {
    const checkbox = $('#autoRefreshCheckbox');
    
    if (checkbox.is(':checked')) {
        // Start auto-refresh every 30 seconds
        autoRefreshInterval = setInterval(function() {
            loadActivityLogs();
        }, 30000);
        showSuccess('Auto-refresh enabled (30 seconds)');
    } else {
        // Stop auto-refresh
        if (autoRefreshInterval) {
            clearInterval(autoRefreshInterval);
            autoRefreshInterval = null;
        }
        showSuccess('Auto-refresh disabled');
    }
}

// Handle window beforeunload to clear intervals
$(window).on('beforeunload', function() {
    if (autoRefreshInterval) {
        clearInterval(autoRefreshInterval);
    }
});


// In loadActivityLogs function, add these lines:
console.log('Loading activity logs...');
console.log('Request data:', requestData);

// In the success callback:
console.log('Response received:', response);
console.log('Activity data:', activityData);

// In the error callback:
console.log('AJAX Error Details:', xhr.responseText);