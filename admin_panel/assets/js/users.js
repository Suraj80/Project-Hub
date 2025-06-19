// Global variables
let currentPage = 1;
const usersPerPage = 10;
let allUsers = [];
let filteredUsers = [];

// Utility functions
function getInitials(fullName) {
    if (!fullName) return 'N/A';
    const names = fullName.split(' ');
    return names.map(name => name.charAt(0)).join('').toUpperCase();
}

function getStatusClass(status) {
    switch(status.toLowerCase()) {
        case 'active': return 'status-active';
        case 'inactive': return 'status-inactive';
        case 'pending': return 'status-pending';
        case 'banned': return 'status-banned';
        default: return 'status-active';
    }
}

function formatDateTime(dateString) {
    if (!dateString) return 'Never';
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function formatBoolean(value) {
    return value == 1 ? 'Yes' : 'No';
}

// AJAX function to fetch users
function fetchUsers() {
    showLoading(true);
    
    $.ajax({
        url: 'ajax/users_action.php',
        type: 'POST',
        data: {
            action: 'fetch_users'
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                allUsers = response.data;
                // Sort by created_at descending (newest first)
                allUsers.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                filterUsers();
            } else {
                console.error('Error fetching users:', response.message);
                alert('Error fetching users: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            alert('Error connecting to server. Please try again.');
        },
        complete: function() {
            showLoading(false);
        }
    });
}

// Function to show/hide loading indicator
function showLoading(show) {
    const loadingIndicator = document.getElementById('loadingIndicator');
    const tableBody = document.getElementById('userTableBody');
    
    if (show) {
        loadingIndicator.style.display = 'block';
        tableBody.style.display = 'none';
    } else {
        loadingIndicator.style.display = 'none';
        tableBody.style.display = '';
    }
}

// Function to render users table
function renderUsers() {
    const tableBody = document.getElementById('userTableBody');
    const startIndex = (currentPage - 1) * usersPerPage;
    const endIndex = startIndex + usersPerPage;
    const currentUsers = filteredUsers.slice(startIndex, endIndex);

    tableBody.innerHTML = '';

    if (currentUsers.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = '<td colspan="8" class="text-center text-muted py-4">No users found</td>';
        tableBody.appendChild(row);
    } else {
        currentUsers.forEach(user => {
            const row = document.createElement('tr');
            row.className = 'user-row';
            
            const profileDisplay = user.profile_image ? 
                `<img src="${user.profile_image}" class="profile-image" alt="Profile">` :
                `<div class="user-avatar">${getInitials(user.full_name)}</div>`;

            row.innerHTML = `
                <td>${user.id}</td>
                <td>${profileDisplay}</td>
                <td>${user.number}</td>
                <td>${user.full_name || 'N/A'}</td>
                <td>${user.email || 'N/A'}</td>
                <td><span class="status-badge ${getStatusClass(user.status)}">${user.status.charAt(0).toUpperCase() + user.status.slice(1)}</span></td>
                <td>${formatDateTime(user.last_login)}</td>
                <td>
                    <button class="btn btn-info btn-sm btn-action" onclick="viewUser(${user.id})">
                        <i class="fas fa-eye"></i> View
                    </button>
                    ${user.status !== 'banned' ? 
                        `<button class="btn btn-danger btn-sm btn-action" onclick="blockUser(${user.id})">
                            <i class="fas fa-ban"></i> Block
                        </button>` :
                        `<button class="btn btn-success btn-sm btn-action" onclick="unblockUser(${user.id})">
                            <i class="fas fa-check"></i> Unblock
                        </button>`
                    }
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    updatePaginationInfo();
}

// Function to update pagination information
function updatePaginationInfo() {
    const startIndex = filteredUsers.length > 0 ? (currentPage - 1) * usersPerPage + 1 : 0;
    const endIndex = Math.min(currentPage * usersPerPage, filteredUsers.length);
    
    document.getElementById('showingStart').textContent = startIndex;
    document.getElementById('showingEnd').textContent = endIndex;
    document.getElementById('totalUsers').textContent = filteredUsers.length;
    document.getElementById('currentPageSpan').textContent = currentPage;
    
    // Update pagination buttons
    const maxPage = Math.ceil(filteredUsers.length / usersPerPage);
    document.getElementById('prevPageBtn').disabled = currentPage <= 1;
    document.getElementById('nextPageBtn').disabled = currentPage >= maxPage || filteredUsers.length === 0;
}

// Function to change page
function changePage(direction) {
    const newPage = currentPage + direction;
    const maxPage = Math.ceil(filteredUsers.length / usersPerPage);
    
    if (newPage >= 1 && newPage <= maxPage) {
        currentPage = newPage;
        renderUsers();
    }
}

// Function to filter users
function filterUsers() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    
    filteredUsers = allUsers.filter(user => {
        const matchesSearch = !searchTerm || 
            user.id.toString().includes(searchTerm) ||
            (user.full_name && user.full_name.toLowerCase().includes(searchTerm)) ||
            user.number.includes(searchTerm) ||
            (user.email && user.email.toLowerCase().includes(searchTerm));
        
        const matchesStatus = !statusFilter || user.status === statusFilter;
        
        return matchesSearch && matchesStatus;
    });
    
    currentPage = 1;
    renderUsers();
}

// Function to view user details
function viewUser(userId) {
    const user = allUsers.find(u => u.id == userId);
    if (!user) return;
    
    // Update profile image/avatar
    const profileImageContainer = document.getElementById('viewUserProfileImage');
    if (user.profile_image) {
        profileImageContainer.innerHTML = `<img src="${user.profile_image}" class="profile-image mx-auto d-block mb-3" alt="Profile">`;
    } else {
        profileImageContainer.innerHTML = `<div class="user-avatar mx-auto mb-3">${getInitials(user.full_name)}</div>`;
    }
    
    // Update basic info
    document.getElementById('viewUserName').textContent = user.full_name || 'N/A';
    document.getElementById('viewUserNumber').textContent = user.number;
    
    // Update status badge
    const statusElement = document.getElementById('viewUserStatus');
    statusElement.textContent = user.status.charAt(0).toUpperCase() + user.status.slice(1);
    statusElement.className = `status-badge ${getStatusClass(user.status)}`;
    
    // Update detailed info
    document.getElementById('viewUserId').textContent = user.id;
    document.getElementById('viewUserNumberDetail').textContent = user.number;
    document.getElementById('viewUserFullName').textContent = user.full_name || 'N/A';
    document.getElementById('viewUserEmail').textContent = user.email || 'N/A';
    document.getElementById('viewUserPhoneVerified').textContent = formatBoolean(user.phone_verified);
    document.getElementById('viewUserEmailVerified').textContent = formatBoolean(user.email_verified);
    document.getElementById('viewUserLastLogin').textContent = formatDateTime(user.last_login);
    document.getElementById('viewUserCreatedAt').textContent = formatDateTime(user.created_at);
    document.getElementById('viewUserIpAddress').textContent = user.ip_address || 'N/A';
    document.getElementById('viewUserFailedAttempts').textContent = user.failed_login_attempts;
    
    // Show the modal
    $('#viewUserModal').modal('show');
}

// Function to block user
function blockUser(userId) {
    if (confirm('Are you sure you want to block this user?')) {
        $.ajax({
            url: 'ajax/users_action.php',
            type: 'POST',
            data: {
                action: 'block_user',
                user_id: userId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('User has been blocked successfully.');
                    // Update local data
                    const userIndex = allUsers.findIndex(u => u.id == userId);
                    if (userIndex !== -1) {
                        allUsers[userIndex].status = 'banned';
                        allUsers[userIndex].updated_at = new Date().toISOString();
                    }
                    filterUsers(); // Re-render table
                } else {
                    alert('Error blocking user: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Error connecting to server. Please try again.');
            }
        });
    }
}

// Function to unblock user
function unblockUser(userId) {
    if (confirm('Are you sure you want to unblock this user?')) {
        $.ajax({
            url: 'ajax/users_action.php',
            type: 'POST',
            data: {
                action: 'unblock_user',
                user_id: userId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('User has been unblocked successfully.');
                    // Update local data
                    const userIndex = allUsers.findIndex(u => u.id == userId);
                    if (userIndex !== -1) {
                        allUsers[userIndex].status = 'active';
                        allUsers[userIndex].updated_at = new Date().toISOString();
                    }
                    filterUsers(); // Re-render table
                } else {
                    alert('Error unblocking user: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Error connecting to server. Please try again.');
            }
        });
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the page
    fetchUsers();
    
    // Search input event listener
    document.getElementById('searchInput').addEventListener('input', filterUsers);
    
    // Status filter event listener
    document.getElementById('statusFilter').addEventListener('change', filterUsers);
});