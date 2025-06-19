<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Feedback Management</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Styles for Feedback Management */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-new { 
            background-color: #fff3cd; 
            color: #856404; 
        }

        .status-read { 
            background-color: #d4edda; 
            color: #155724; 
        }

        .status-replied { 
            background-color: #d1ecf1; 
            color: #0c5460; 
        }

        .btn-action {
            margin-right: 0.25rem;
            margin-bottom: 0.25rem;
        }

        .table-responsive {
            border-radius: 0.35rem;
        }

        .feedback-table th {
            border-top: none;
            background-color: #f8f9fc;
            font-weight: 600;
            color: #5a5c69;
        }

        .feedback-row:hover {
            background-color: #f8f9fc;
        }

        .search-filter-section {
            background-color: #f8f9fc;
            padding: 1.5rem;
            border-radius: 0.35rem;
            margin-bottom: 1.5rem;
        }

        .pagination-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding: 1rem 0;
        }

        .pagination-info {
            color: #5a5c69;
            font-size: 0.875rem;
        }

        .subject-preview {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .loading-row {
            text-align: center;
            padding: 2rem;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 1rem;
            border-radius: 0.25rem;
            margin: 1rem 0;
        }

        /* Enhanced Modal Styles */
        .modal-body #viewFeedbackMessage {
            background-color: #f8f9fc;
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            padding: 1rem;
            max-height: 300px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-family: inherit;
            line-height: 1.5;
            color: #5a5c69;
        }

        .modal-body .form-control-plaintext {
            word-wrap: break-word;
            white-space: pre-wrap;
        }

        .modal-footer .btn {
            margin-left: 0.5rem;
        }

        .modal-footer .btn:first-child {
            margin-left: 0;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            position: fixed;
            height: 100vh;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            z-index: 1000;
        }

        .sidebar-brand {
            color: white;
            text-decoration: none;
            padding: 1rem;
        }

        .sidebar-brand:hover {
            color: white;
            text-decoration: none;
        }

        .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
        }

        .nav-item .nav-link:hover {
            color: white;
        }

        .nav-item.active .nav-link {
            color: white;
        }

        .sidebar-divider {
            border-color: rgba(255, 255, 255, 0.15);
        }

        .sidebar-heading {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            padding: 1.5rem 1rem 0.5rem;
        }

        /* Main content */
        .content-wrapper {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            background-color: white;
            border-bottom: 1px solid #e3e6f0;
        }

        .container-fluid {
            padding: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .content-wrapper {
                margin-left: 0;
            }
            
            .search-filter-section {
                padding: 1rem;
            }
            
            .pagination-section {
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn-action {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
            
            .subject-preview {
                max-width: 150px;
            }
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Feedback (Active) -->
            <li class="nav-item active">
                <a class="nav-link" href="feedback.html">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Feedback Management</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div class="content-wrapper d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h1 class="h3 mb-0 text-gray-800">Feedback Management</h1>
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin User</span>
                                <i class="fas fa-user-circle fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Search and Filter Section -->
                    <div class="search-filter-section">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="searchInput" class="font-weight-bold">Search Feedback</label>
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search by ID or Name...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="statusFilter" class="font-weight-bold">Filter by Status</label>
                                    <select class="form-control" id="statusFilter">
                                        <option value="">All Status</option>
                                        <option value="new">New</option>
                                        <option value="read">Read</option>
                                        <option value="replied">Replied</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Feedback Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Feedback List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered feedback-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="feedbackTableBody">
                                        <!-- Sample data will be loaded here -->
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination Section -->
                            <div class="pagination-section">
                                <div class="pagination-info">
                                    Showing <span id="showingStart">0</span> to <span id="showingEnd">0</span> of <span id="totalFeedback">0</span> feedback entries
                                </div>
                                <div class="ml-auto">
                                    <button class="btn btn-outline-primary btn-sm" id="prevPageBtn" onclick="changePage(-1)" disabled>
                                        <i class="fas fa-chevron-left"></i> Previous
                                    </button>
                                    <span class="mx-2">Page <span id="currentPageSpan">1</span></span>
                                    <button class="btn btn-outline-primary btn-sm" id="nextPageBtn" onclick="changePage(1)" disabled>
                                        Next <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- View Feedback Modal -->
    <div class="modal fade" id="viewFeedbackModal" tabindex="-1" role="dialog" aria-labelledby="viewFeedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewFeedbackModalLabel">
                        <i class="fas fa-comments mr-2"></i>Feedback Details
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Feedback ID:</label>
                                <p class="form-control-plaintext" id="viewFeedbackId">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Name:</label>
                                <p class="form-control-plaintext" id="viewFeedbackName">-</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email:</label>
                                <p class="form-control-plaintext" id="viewFeedbackEmail">-</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Status:</label>
                                <p class="form-control-plaintext">
                                    <span class="status-badge" id="viewFeedbackStatus">-</span>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Created At:</label>
                                <p class="form-control-plaintext" id="viewFeedbackCreatedAt">-</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Subject:</label>
                        <p class="form-control-plaintext" id="viewFeedbackSubject">-</p>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Message:</label>
                        <div class="border rounded p-3 bg-light" id="viewFeedbackMessage" style="max-height: 200px; overflow-y: auto;">-</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="button" id="markAsReadBtn" onclick="markAsRead()">
                        <i class="fas fa-check"></i> Mark as Read
                    </button>
                    <button class="btn btn-info" type="button" id="markAsRepliedBtn" onclick="markAsReplied()">
                        <i class="fas fa-reply"></i> Mark as Replied
                    </button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>

    <script>
        // Feedback Management JavaScript - Fixed Version
        let currentPage = 1;
        const feedbackPerPage = 10;
        let allFeedback = [];
        let filteredFeedback = [];
        let currentFeedbackId = null;

        // Sample data for demonstration (replace with your AJAX call)
        const sampleFeedback = [
            {
                id: 1,
                name: "John Doe",
                email: "john.doe@example.com",
                subject: "Website Feedback",
                message: "Great website! Very user-friendly and intuitive. I especially love the clean design and fast loading times. Keep up the good work!",
                status: "new",
                created_at: "2024-01-15 10:30:00"
            },
            {
                id: 2,
                name: "Jane Smith",
                email: "jane.smith@example.com",
                subject: "Bug Report",
                message: "I found a bug in the login system. When I try to login with my credentials, it shows an error message even though my credentials are correct. Please look into this issue.",
                status: "read",
                created_at: "2024-01-14 14:22:00"
            },
            {
                id: 3,
                name: "Mike Johnson",
                email: "mike.johnson@example.com",
                subject: "Feature Request",
                message: "Could you please add a dark mode feature? It would be really helpful for users who prefer dark themes, especially during night time usage.",
                status: "new",
                created_at: "2024-01-13 09:15:00"
            },
            {
                id: 4,
                name: "Sarah Wilson",
                email: "sarah.wilson@example.com",
                subject: "Payment Issue",
                message: "I'm having trouble with the payment process. The payment gateway seems to be slow and sometimes doesn't respond. This is affecting my user experience.",
                status: "replied",
                created_at: "2024-01-12 16:45:00"
            },
            {
                id: 5,
                name: "David Brown",
                email: "david.brown@example.com",
                subject: "General Inquiry",
                message: "I wanted to know more about your premium features. What additional benefits do premium users get? Also, is there a trial period available?",
                status: "new",
                created_at: "2024-01-11 11:20:00"
            }
        ];

        // Initialize page when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            loadFeedback();
            setupEventListeners();
        });

        // Setup event listeners
        function setupEventListeners() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            
            if (searchInput) {
                searchInput.addEventListener('input', filterFeedback);
            }
            
            if (statusFilter) {
                statusFilter.addEventListener('change', filterFeedback);
            }
        }

        // Load feedback data
        function loadFeedback() {
            showLoading();
            
            // Simulate AJAX call - replace this with your actual AJAX call
            setTimeout(() => {
                try {
                    allFeedback = [...sampleFeedback];
                    // Sort by created_at descending (newest first)
                    allFeedback.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                    // Filter out replied feedback (auto-discard feature)
                    filteredFeedback = allFeedback.filter(feedback => feedback.status !== 'replied');
                    currentPage = 1;
                    renderFeedback();
                } catch (error) {
                    console.error('Error loading feedback:', error);
                    showError('Failed to load feedback. Please try again.');
                }
            }, 1000);
            
            // Uncomment and modify this for your actual AJAX call:
            
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
                        allFeedback.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
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
            if (tableBody) {
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
        }

        // Show error message
        function showError(message) {
            const tableBody = document.getElementById('feedbackTableBody');
            if (tableBody) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center">
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                ${message}
                                <br>
                                <button class="btn btn-primary btn-sm mt-2" onclick="loadFeedback()">
                                    <i class="fas fa-sync"></i> Retry
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }
        }

        // Get status class for styling
        function getStatusClass(status) {
            switch(status ? status.toLowerCase() : 'new') {
                case 'new': return 'status-new';
                case 'read': return 'status-read';
                case 'replied': return 'status-replied';
                default: return 'status-new';
            }
        }

        // Format date time
        function formatDateTime(dateString) {
            if (!dateString) return 'N/A';
            try {
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            } catch (error) {
                return 'Invalid Date';
            }
        }

        // Render feedback table
        function renderFeedback() {
            const tableBody = document.getElementById('feedbackTableBody');
            if (!tableBody) return;

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
                        <td class="action-buttons">${actionButtons}</td>
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
            
            const showingStart = document.getElementById('showingStart');
            const showingEnd = document.getElementById('showingEnd');
            const totalFeedback = document.getElementById('totalFeedback');
            const currentPageSpan = document.getElementById('currentPageSpan');
            
            if (showingStart) showingStart.textContent = startIndex;
            if (showingEnd) showingEnd.textContent = endIndex;
            if (totalFeedback) totalFeedback.textContent = filteredFeedback.length;
            if (currentPageSpan) currentPageSpan.textContent = currentPage;
            
            // Update pagination buttons
            const maxPage = Math.ceil(filteredFeedback.length / feedbackPerPage);
            const prevBtn = document.getElementById('prevPageBtn');
            const nextBtn = document.getElementById('nextPageBtn');
            
            if (prevBtn) prevBtn.disabled = currentPage <= 1;
            if (nextBtn) nextBtn.disabled = currentPage >= maxPage || filteredFeedback.length === 0;
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
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            
            const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
            const statusFilterValue = statusFilter ? statusFilter.value : '';
            
            // Start from all non-replied feedback
            let baseData = allFeedback.filter(feedback => feedback.status !== 'replied');
            
            filteredFeedback = baseData.filter(feedback => {
                const matchesSearch = !searchTerm || 
                    feedback.id.toString().includes(searchTerm) ||
                    (feedback.name && feedback.name.toLowerCase().includes(searchTerm));
                
                const matchesStatus = !statusFilterValue || feedback.status === statusFilterValue;
                
                return matchesSearch && matchesStatus;
            });
            
            currentPage = 1;
            renderFeedback();
        }

        // View feedback details - FIXED FUNCTION
        function viewFeedback(feedbackId) {
            console.log('viewFeedback called with ID:', feedbackId); // Debug log
            
            const feedback = allFeedback.find(f => f.id === feedbackId);
            if (!feedback) {
                console.error('Feedback not found with ID:', feedbackId);
                return;
            }
            
            currentFeedbackId = feedbackId;
            
            // Update modal content with proper error checking
            const elements = {
                viewFeedbackId: document.getElementById('viewFeedbackId'),
                viewFeedbackName: document.getElementById('viewFeedbackName'),
                viewFeedbackEmail: document.getElementById('viewFeedbackEmail'),
                viewFeedbackSubject: document.getElementById('viewFeedbackSubject'),
                viewFeedbackMessage: document.getElementById('viewFeedbackMessage'),
                viewFeedbackCreatedAt: document.getElementById('viewFeedbackCreatedAt'),
                viewFeedbackStatus: document.getElementById('viewFeedbackStatus'),
                markAsReadBtn: document.getElementById('markAsReadBtn'),
                markAsRepliedBtn: document.getElementById('markAsRepliedBtn')
            };
            
            // Check if all elements exist
            for (const [key, element] of Object.entries(elements)) {
                if (!element) {
                    console.error(`Element not found: ${key}`);
                }
            }
            
           // Update modal content
            if (elements.viewFeedbackId) elements.viewFeedbackId.textContent = feedback.id;
            if (elements.viewFeedbackName) elements.viewFeedbackName.textContent = feedback.name || 'N/A';
            if (elements.viewFeedbackEmail) elements.viewFeedbackEmail.textContent = feedback.email || 'N/A';
            if (elements.viewFeedbackSubject) elements.viewFeedbackSubject.textContent = feedback.subject || 'N/A';
            if (elements.viewFeedbackMessage) elements.viewFeedbackMessage.textContent = feedback.message || 'N/A';
            if (elements.viewFeedbackCreatedAt) elements.viewFeedbackCreatedAt.textContent = formatDateTime(feedback.created_at);
            
            // Update status badge
            if (elements.viewFeedbackStatus) {
                elements.viewFeedbackStatus.textContent = feedback.status ? feedback.status.charAt(0).toUpperCase() + feedback.status.slice(1) : 'New';
                elements.viewFeedbackStatus.className = `status-badge ${getStatusClass(feedback.status)}`;
            }
            
            // Update button visibility based on status
            if (elements.markAsReadBtn) {
                elements.markAsReadBtn.style.display = feedback.status === 'new' ? 'inline-block' : 'none';
            }
            if (elements.markAsRepliedBtn) {
                elements.markAsRepliedBtn.style.display = feedback.status !== 'replied' ? 'inline-block' : 'none';
            }
            
            // Show the modal
            $('#viewFeedbackModal').modal('show');
            
            // Mark as read if it's currently 'new' status
            if (feedback.status === 'new') {
                markAsRead(feedbackId, false); // false = don't close modal
            }
        }

        // Mark feedback as read
        function markAsRead(feedbackId = null, closeModal = true) {
            const id = feedbackId || currentFeedbackId;
            if (!id) return;
            
            // Find the feedback and update its status
            const feedbackIndex = allFeedback.findIndex(f => f.id === id);
            if (feedbackIndex !== -1) {
                allFeedback[feedbackIndex].status = 'read';
                
                // Update filtered feedback as well
                const filteredIndex = filteredFeedback.findIndex(f => f.id === id);
                if (filteredIndex !== -1) {
                    filteredFeedback[filteredIndex].status = 'read';
                }
                
                // Re-render the table
                renderFeedback();
                
                // Update modal if it's open
                if (!closeModal && currentFeedbackId === id) {
                    const viewFeedbackStatus = document.getElementById('viewFeedbackStatus');
                    const markAsReadBtn = document.getElementById('markAsReadBtn');
                    
                    if (viewFeedbackStatus) {
                        viewFeedbackStatus.textContent = 'Read';
                        viewFeedbackStatus.className = 'status-badge status-read';
                    }
                    if (markAsReadBtn) {
                        markAsReadBtn.style.display = 'none';
                    }
                }
                
                if (closeModal) {
                    $('#viewFeedbackModal').modal('hide');
                }
                
                // Show success message
                showToast('Feedback marked as read successfully!', 'success');
            }
            
            // Uncomment for actual AJAX call:
            
            $.ajax({
                url: 'ajax/feedback_action.php',
                type: 'POST',
                data: {
                    action: 'mark_as_read',
                    feedback_id: id
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
                        
                        renderFeedback();
                        
                        if (closeModal) {
                            $('#viewFeedbackModal').modal('hide');
                        }
                        
                        showToast('Feedback marked as read successfully!', 'success');
                    } else {
                        showToast('Failed to mark feedback as read: ' + (response.message || 'Unknown error'), 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    showToast('Failed to mark feedback as read. Please try again.', 'error');
                }
            });
            
        }

        // Mark feedback as replied
        function markAsReplied(feedbackId = null, closeModal = true) {
            const id = feedbackId || currentFeedbackId;
            if (!id) return;
            
            // Find the feedback and update its status
            const feedbackIndex = allFeedback.findIndex(f => f.id === id);
            if (feedbackIndex !== -1) {
                allFeedback[feedbackIndex].status = 'replied';
                
                // Remove from filtered feedback (auto-discard feature)
                filteredFeedback = filteredFeedback.filter(f => f.id !== id);
                
                // Re-render the table
                renderFeedback();
                
                if (closeModal) {
                    $('#viewFeedbackModal').modal('hide');
                }
                
                // Show success message
                showToast('Feedback marked as replied and archived successfully!', 'success');
            }
            
            // Uncomment for actual AJAX call:
            
            $.ajax({
                url: 'ajax/feedback_action.php',
                type: 'POST',
                data: {
                    action: 'mark_as_replied',
                    feedback_id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Update local data
                        const feedbackIndex = allFeedback.findIndex(f => f.id === id);
                        if (feedbackIndex !== -1) {
                            allFeedback[feedbackIndex].status = 'replied';
                        }
                        
                        // Remove from filtered data (auto-discard)
                        filteredFeedback = filteredFeedback.filter(f => f.id !== id);
                        
                        renderFeedback();
                        
                        if (closeModal) {
                            $('#viewFeedbackModal').modal('hide');
                        }
                        
                        showToast('Feedback marked as replied and archived successfully!', 'success');
                    } else {
                        showToast('Failed to mark feedback as replied: ' + (response.message || 'Unknown error'), 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    showToast('Failed to mark feedback as replied. Please try again.', 'error');
                }
            });
            
        }

        // Show toast notification
        function showToast(message, type = 'info') {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            toast.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-2"></i>
                ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            `;
            
            // Add to body
            document.body.appendChild(toast);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 5000);
        }

        // Refresh data
        function refreshData() {
            loadFeedback();
            showToast('Data refreshed successfully!', 'success');
        }

        // Export functionality (optional)
        function exportFeedback() {
            try {
                const dataToExport = filteredFeedback.map(feedback => ({
                    ID: feedback.id,
                    Name: feedback.name,
                    Email: feedback.email,
                    Subject: feedback.subject,
                    Message: feedback.message,
                    Status: feedback.status,
                    'Created At': formatDateTime(feedback.created_at)
                }));
                
                const csvContent = convertToCSV(dataToExport);
                downloadCSV(csvContent, 'feedback_export.csv');
                showToast('Feedback data exported successfully!', 'success');
            } catch (error) {
                console.error('Export error:', error);
                showToast('Failed to export feedback data.', 'error');
            }
        }

        // Convert JSON to CSV
        function convertToCSV(data) {
            if (!data.length) return '';
            
            const headers = Object.keys(data[0]);
            const csvRows = [headers.join(',')];
            
            for (const row of data) {
                const values = headers.map(header => {
                    const value = row[header];
                    return typeof value === 'string' ? `"${value.replace(/"/g, '""')}"` : value;
                });
                csvRows.push(values.join(','));
            }
            
            return csvRows.join('\n');
        }

        // Download CSV file
        function downloadCSV(csvContent, filename) {
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', filename);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + R to refresh
            if ((e.ctrlKey || e.metaKey) && e.key === 'r' && !e.shiftKey) {
                e.preventDefault();
                refreshData();
            }
            
            // Escape to close modal
            if (e.key === 'Escape') {
                $('#viewFeedbackModal').modal('hide');
            }
        });

        // Handle modal close events
        $('#viewFeedbackModal').on('hidden.bs.modal', function () {
            currentFeedbackId = null;
        });

        // Auto-refresh every 30 seconds (optional)
        // setInterval(loadFeedback, 30000);
    </script>
</body>
</html>