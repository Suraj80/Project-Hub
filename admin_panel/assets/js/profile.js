// Global variables
let adminData = {};
let userStats = {};

// Utility functions
function getInitials(fullName) {
    if (!fullName) return 'AD';
    const names = fullName.split(' ');
    return names.map(name => name.charAt(0)).join('').toUpperCase();
}

function formatDateTime(dateString) {
    if (!dateString) return 'Never';
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function showLoading(show) {
    const loadingOverlay = document.getElementById('loadingOverlay');
    if (loadingOverlay) {
        if (show) {
            loadingOverlay.style.display = 'flex';
        } else {
            loadingOverlay.style.display = 'none';
        }
    }
}

function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show notification-toast`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10000;
        min-width: 300px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    `;
    notification.innerHTML = `
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 5000);
}

// Fetch admin profile data
function fetchAdminProfile() {
    showLoading(true);
    
    $.ajax({
        url: 'ajax/profile_action.php',
        type: 'POST',
        data: {
            action: 'fetch_profile'
        },
        dataType: 'json',
        success: function(response) {
            console.log('Profile response:', response);
            if (response.success) {
                adminData = response.data;
                userStats = response.stats;
                renderProfile();
            } else {
                console.error('Error fetching profile:', response.message);
                showNotification('Error loading profile: ' + response.message, 'danger');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            console.error('Response:', xhr.responseText);
            showNotification('Error connecting to server. Please try again.', 'danger');
        },
        complete: function() {
            showLoading(false);
        }
    });
}

// Render profile data
function renderProfile() {
    try {
        // Update profile image/avatar
        const profileImageContainer = document.getElementById('adminProfileImage');
        if (profileImageContainer) {
            if (adminData.profile_image) {
                profileImageContainer.innerHTML = `<img src="${adminData.profile_image}" alt="Admin Profile" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">`;
            } else {
                profileImageContainer.innerHTML = `<span style="display: inline-flex; align-items: center; justify-content: center; width: 100px; height: 100px; border-radius: 50%; background-color: #007bff; color: white; font-size: 24px; font-weight: bold;">${getInitials(adminData.full_name)}</span>`;
            }
        }
        
        // Update basic info
        const adminNameEl = document.getElementById('adminName');
        if (adminNameEl) adminNameEl.textContent = adminData.full_name || 'Admin';
        
        const adminRoleEl = document.getElementById('adminRole');
        if (adminRoleEl) adminRoleEl.textContent = adminData.role || 'Administrator';
        
        // Update profile details
        const adminIdEl = document.getElementById('adminId');
        if (adminIdEl) adminIdEl.textContent = adminData.id || 'N/A';
        
        const adminFullNameEl = document.getElementById('adminFullName');
        if (adminFullNameEl) adminFullNameEl.textContent = adminData.full_name || 'N/A';
        
        const adminEmailEl = document.getElementById('adminEmail');
        if (adminEmailEl) adminEmailEl.textContent = adminData.email || 'N/A';
        
        const adminPhoneEl = document.getElementById('adminPhone');
        if (adminPhoneEl) adminPhoneEl.textContent = adminData.phone || 'N/A';
        
        const adminRoleDetailEl = document.getElementById('adminRoleDetail');
        if (adminRoleDetailEl) adminRoleDetailEl.textContent = adminData.role || 'Administrator';
        
        const adminCreatedAtEl = document.getElementById('adminCreatedAt');
        if (adminCreatedAtEl) adminCreatedAtEl.textContent = formatDateTime(adminData.created_at);
        
        const adminLastLoginEl = document.getElementById('adminLastLogin');
        if (adminLastLoginEl) adminLastLoginEl.textContent = formatDateTime(adminData.last_login);
        
        const adminIpAddressEl = document.getElementById('adminIpAddress');
        if (adminIpAddressEl) adminIpAddressEl.textContent = adminData.ip_address || 'N/A';
        
        // Update stats
        const totalUsersEl = document.getElementById('totalUsers');
        if (totalUsersEl) totalUsersEl.textContent = userStats.total_users || 0;
        
        const activeUsersEl = document.getElementById('activeUsers');
        if (activeUsersEl) activeUsersEl.textContent = userStats.active_users || 0;
        
        const managedUsersEl = document.getElementById('managedUsers');
        if (managedUsersEl) managedUsersEl.textContent = userStats.total_users || 0;
        
        const approvedUsersEl = document.getElementById('approvedUsers');
        if (approvedUsersEl) approvedUsersEl.textContent = userStats.active_users || 0;
        
        const pendingUsersEl = document.getElementById('pendingUsers');
        if (pendingUsersEl) pendingUsersEl.textContent = userStats.pending_users || 0;
        
        const blockedUsersEl = document.getElementById('blockedUsers');
        if (blockedUsersEl) blockedUsersEl.textContent = userStats.banned_users || 0;
        
        console.log('Profile rendered successfully');
    } catch (error) {
        console.error('Error rendering profile:', error);
        showNotification('Error displaying profile data', 'danger');
    }
}

// Show edit profile modal
function showEditModal() {
    // Populate form with current data
    const editFullNameEl = document.getElementById('editFullName');
    if (editFullNameEl) editFullNameEl.value = adminData.full_name || '';
    
    const editEmailEl = document.getElementById('editEmail');
    if (editEmailEl) editEmailEl.value = adminData.email || '';
    
    const editPhoneEl = document.getElementById('editPhone');
    if (editPhoneEl) editPhoneEl.value = adminData.phone || '';
    
    // Clear password fields
    const editCurrentPasswordEl = document.getElementById('editCurrentPassword');
    if (editCurrentPasswordEl) editCurrentPasswordEl.value = '';
    
    const editNewPasswordEl = document.getElementById('editNewPassword');
    if (editNewPasswordEl) editNewPasswordEl.value = '';
    
    const editConfirmPasswordEl = document.getElementById('editConfirmPassword');
    if (editConfirmPasswordEl) editConfirmPasswordEl.value = '';
    
    // Show modal
    $('#editProfileModal').modal('show');
}

// Handle profile image change
function handleProfileImageChange(file) {
    if (file) {
        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            showNotification('Please select a valid image file (JPEG, PNG, GIF)', 'danger');
            return;
        }
        
        // Validate file size (max 5MB)
        const maxSize = 5 * 1024 * 1024;
        if (file.size > maxSize) {
            showNotification('Image size must be less than 5MB', 'danger');
            return;
        }
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            if (preview) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 200px;">`;
                preview.style.display = 'block';
            }
        };
        reader.readAsDataURL(file);
    }
}

// Update profile
function updateProfile() {
    const formData = new FormData();
    
    // Get form values
    const fullNameEl = document.getElementById('editFullName');
    const emailEl = document.getElementById('editEmail');
    const phoneEl = document.getElementById('editPhone');
    const currentPasswordEl = document.getElementById('editCurrentPassword');
    const newPasswordEl = document.getElementById('editNewPassword');
    const confirmPasswordEl = document.getElementById('editConfirmPassword');
    const profileImageEl = document.getElementById('editProfileImage');
    
    const fullName = fullNameEl ? fullNameEl.value.trim() : '';
    const email = emailEl ? emailEl.value.trim() : '';
    const phone = phoneEl ? phoneEl.value.trim() : '';
    const currentPassword = currentPasswordEl ? currentPasswordEl.value : '';
    const newPassword = newPasswordEl ? newPasswordEl.value : '';
    const confirmPassword = confirmPasswordEl ? confirmPasswordEl.value : '';
    const profileImage = profileImageEl ? profileImageEl.files[0] : null;
    
    // Basic validation
    if (!fullName) {
        showNotification('Full name is required', 'danger');
        return;
    }
    
    if (!email) {
        showNotification('Email is required', 'danger');
        return;
    }
    
    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showNotification('Please enter a valid email address', 'danger');
        return;
    }
    
    // Password validation if changing password
    if (newPassword) {
        if (!currentPassword) {
            showNotification('Current password is required to change password', 'danger');
            return;
        }
        
        if (newPassword.length < 6) {
            showNotification('New password must be at least 6 characters long', 'danger');
            return;
        }
        
        if (newPassword !== confirmPassword) {
            showNotification('New password and confirm password do not match', 'danger');
            return;
        }
    }
    
    // Prepare form data
    formData.append('action', 'update_profile');
    formData.append('full_name', fullName);
    formData.append('email', email);
    formData.append('phone', phone);
    
    if (newPassword) {
        formData.append('current_password', currentPassword);
        formData.append('new_password', newPassword);
    }
    
    if (profileImage) {
        formData.append('profile_image', profileImage);
    }
    
    showLoading(true);
    
    $.ajax({
        url: 'ajax/profile_action.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification('Profile updated successfully!', 'success');
                $('#editProfileModal').modal('hide');
                // Refresh profile data
                fetchAdminProfile();
            } else {
                showNotification('Error: ' + response.message, 'danger');
            }
        },
        error: function(xhr, status, error) {
            console.error('Update Error:', error);
            showNotification('Error updating profile. Please try again.', 'danger');
        },
        complete: function() {
            showLoading(false);
        }
    });
}

// Change password only
function changePassword() {
    const currentPasswordEl = document.getElementById('changeCurrentPassword');
    const newPasswordEl = document.getElementById('changeNewPassword');
    const confirmPasswordEl = document.getElementById('changeConfirmPassword');
    
    const currentPassword = currentPasswordEl ? currentPasswordEl.value : '';
    const newPassword = newPasswordEl ? newPasswordEl.value : '';
    const confirmPassword = confirmPasswordEl ? confirmPasswordEl.value : '';
    
    // Validation
   // Validation
    if (!currentPassword) {
        showNotification('Current password is required', 'danger');
        return;
    }
    
    if (!newPassword) {
        showNotification('New password is required', 'danger');
        return;
    }
    
    if (newPassword.length < 6) {
        showNotification('New password must be at least 6 characters long', 'danger');
        return;
    }
    
    if (newPassword !== confirmPassword) {
        showNotification('New password and confirm password do not match', 'danger');
        return;
    }
    
    showLoading(true);
    
    $.ajax({
        url: 'ajax/profile_action.php',
        type: 'POST',
        data: {
            action: 'change_password',
            current_password: currentPassword,
            new_password: newPassword
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification('Password changed successfully!', 'success');
                $('#changePasswordModal').modal('hide');
                // Clear form
                if (currentPasswordEl) currentPasswordEl.value = '';
                if (newPasswordEl) newPasswordEl.value = '';
                if (confirmPasswordEl) confirmPasswordEl.value = '';
            } else {
                showNotification('Error: ' + response.message, 'danger');
            }
        },
        error: function(xhr, status, error) {
            console.error('Password Change Error:', error);
            showNotification('Error changing password. Please try again.', 'danger');
        },
        complete: function() {
            showLoading(false);
        }
    });
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Fetch initial profile data
    fetchAdminProfile();
    
    // Edit profile button
    const editProfileBtn = document.getElementById('editProfileBtn');
    if (editProfileBtn) {
        editProfileBtn.addEventListener('click', showEditModal);
    }
    
    // Update profile button
    const updateProfileBtn = document.getElementById('updateProfileBtn');
    if (updateProfileBtn) {
        updateProfileBtn.addEventListener('click', updateProfile);
    }
    
    // Change password button
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    if (changePasswordBtn) {
        changePasswordBtn.addEventListener('click', changePassword);
    }
    
    // Profile image input change
    const profileImageInput = document.getElementById('editProfileImage');
    if (profileImageInput) {
        profileImageInput.addEventListener('change', function(e) {
            handleProfileImageChange(e.target.files[0]);
        });
    }
    
    // Password visibility toggles
    const toggleButtons = document.querySelectorAll('.toggle-password');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});

// Refresh profile data
function refreshProfile() {
    fetchAdminProfile();
}

// Logout function
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        showLoading(true);
        
        $.ajax({
            url: 'ajax/profile_action.php',
            type: 'POST',
            data: {
                action: 'logout'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = 'login.php';
                } else {
                    showNotification('Error during logout: ' + response.message, 'danger');
                }
            },
            error: function(xhr, status, error) {
                console.error('Logout Error:', error);
                // Even if there's an error, redirect to login
                window.location.href = 'login.php';
            },
            complete: function() {
                showLoading(false);
            }
        });
    }
}

// Delete profile image
function deleteProfileImage() {
    if (confirm('Are you sure you want to delete your profile image?')) {
        showLoading(true);
        
        $.ajax({
            url: 'ajax/profile_action.php',
            type: 'POST',
            data: {
                action: 'delete_profile_image'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification('Profile image deleted successfully!', 'success');
                    fetchAdminProfile(); // Refresh to show initials
                } else {
                    showNotification('Error: ' + response.message, 'danger');
                }
            },
            error: function(xhr, status, error) {
                console.error('Delete Image Error:', error);
                showNotification('Error deleting profile image. Please try again.', 'danger');
            },
            complete: function() {
                showLoading(false);
            }
        });
    }
}

// Export profile data
function exportProfile() {
    const exportData = {
        admin_info: adminData,
        user_statistics: userStats,
        exported_at: new Date().toISOString()
    };
    
    const dataStr = JSON.stringify(exportData, null, 2);
    const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
    
    const exportFileDefaultName = `admin_profile_${new Date().toISOString().split('T')[0]}.json`;
    
    const linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
    
    showNotification('Profile data exported successfully!', 'success');
}