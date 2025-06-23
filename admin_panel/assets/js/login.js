// DOM Elements
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const signUpBtn = document.getElementById('sign-up');
const signInBtn = document.getElementById('sign-in');
const messageContainer = document.getElementById('message-container');
const loginButton = document.getElementById('login-btn');
const btnText = loginButton.querySelector('.btn-text');
const btnLoading = loginButton.querySelector('.btn-loading');

// Form switching functionality
signUpBtn.addEventListener('click', () => {
    loginForm.classList.add('none');
    registerForm.classList.remove('none');
    registerForm.classList.add('block');
    clearMessages();
});

signInBtn.addEventListener('click', () => {
    registerForm.classList.add('none');
    loginForm.classList.remove('none');
    loginForm.classList.add('block');
    clearMessages();
});

// Login form submission
loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    
    // Basic validation
    if (!username || !password) {
        showMessage('Please fill in all fields', 'error');
        return;
    }
    
    // Show loading state
    setLoadingState(true);
    clearMessages();
    
    try {
        // Prepare form data
        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);
        
        // Send AJAX request - FIXED: Updated URL path
        const response = await fetch('ajax/login_action.php', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        });
        
        // Check if response is ok
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (data.success) {
            showMessage(data.message, 'success');
            
            // FIXED: Use correct property name from PHP response
            setTimeout(() => {
                window.location.href = data.redirect || 'dashboard1.php';
            }, 1500);
        } else {
            showMessage(data.message, 'error');
            setLoadingState(false);
        }
        
    } catch (error) {
        console.error('Login error:', error);
        showMessage('An error occurred. Please try again.', 'error');
        setLoadingState(false);
    }
});

// Registration form submission (placeholder)
registerForm.addEventListener('submit', (e) => {
    e.preventDefault();
    showMessage('Registration functionality not implemented yet.', 'info');
});

// Message display functions
function showMessage(message, type = 'info') {
    clearMessages();
    
    const messageDiv = document.createElement('div');
    messageDiv.className = `message message--${type}`;
    messageDiv.innerHTML = `
        <span>${message}</span>
        <i class="bx bx-x message__close" onclick="this.parentElement.remove();"></i>
    `;
    
    messageContainer.appendChild(messageDiv);
    
    // Auto remove message after 5 seconds
    setTimeout(() => {
        if (messageDiv.parentElement) {
            messageDiv.remove();
        }
    }, 5000);
}

function clearMessages() {
    messageContainer.innerHTML = '';
}

function setLoadingState(loading) {
    if (loading) {
        loginButton.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-block';
        loginButton.style.opacity = '0.7';
    } else {
        loginButton.disabled = false;
        btnText.style.display = 'inline-block';
        btnLoading.style.display = 'none';
        loginButton.style.opacity = '1';
    }
}

// Input validation helpers
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePassword(password) {
    // At least 6 characters
    return password.length >= 6;
}

// Add input event listeners for real-time validation
document.getElementById('username').addEventListener('input', function() {
    this.classList.remove('error');
});

document.getElementById('password').addEventListener('input', function() {
    this.classList.remove('error');
});

// Prevent form submission on Enter key in input fields (optional)
document.querySelectorAll('.login__input').forEach(input => {
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && this.form.id === 'login-form') {
            e.preventDefault();
            loginForm.dispatchEvent(new Event('submit'));
        }
    });
});

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Focus on username field
    document.getElementById('username').focus();
    
    // Clear any existing messages
    clearMessages();
    
    console.log('Login system initialized');
});