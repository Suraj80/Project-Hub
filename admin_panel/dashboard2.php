
  <?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

  include 'components/header.php';     // <head> with Bootstrap CSS
    // include 'components/sidebar.php';
  include 'components/navbar.php';     // Top navbar
    // Side menu
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Orders Dashboard - Admin Panel</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #6366f1;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #06b6d4;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --border-color: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
            line-height: 1.6;
        }

        /* Enhanced Navbar */
        /* .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 4px 20px rgba(79, 70, 229, 0.15);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white !important;
        }

        .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-radius: 0.75rem;
        } */

        /* Main Content */
        .main-content {
            padding: 2rem 0;
            min-height: 100vh;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 1rem;
        }

        /* Filter Card */
        .filter-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }

        /* Metric Cards */
        .metric-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .metric-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .metric-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .metric-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .metric-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .metric-change {
            font-size: 0.875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 0.5rem;
        }

        .metric-change.positive {
            color: var(--success-color);
        }

        .metric-change.negative {
            color: var(--danger-color);
        }

        /* Chart Cards */
        .chart-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .chart-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .chart-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .chart-container {
            position: relative;
            height: 350px;
        }

        .chart-container-small {
            position: relative;
            height: 300px;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-processing { background-color: #dbeafe; color: #1e40af; }
        .status-completed { background-color: #d1fae5; color: #065f46; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .status-refunded { background-color: #f3f4f6; color: #374151; }

        /* Recent Orders Table */
        .orders-table {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8fafc;
            border-bottom: 2px solid var(--border-color);
            font-weight: 600;
            color: var(--dark-color);
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .metric-value {
                font-size: 2rem;
            }
            
            .chart-container {
                height: 250px;
            }
            
            .chart-container-small {
                height: 200px;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }
    </style>
</head>

<body>


    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header fade-in-up">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-6 fw-bold mb-2">Orders Dashboard</h1>
                            <p class="lead mb-0">Monitor and manage your orders with real-time insights</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <button class="btn btn-light btn-lg">
                                <i class="fas fa-download me-2"></i>Export Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-card fade-in-up">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Date Range</label>
                        <select class="form-select" id="dateFilter" onchange="updateDashboard()">
                            <option value="today">Today</option>
                            <option value="week" selected>This Week</option>
                            <option value="month">This Month</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Order Status</label>
                        <select class="form-select" id="statusFilter" onchange="updateDashboard()">
                            <option value="all">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Delivery Mode</label>
                        <select class="form-select" id="deliveryFilter" onchange="updateDashboard()">
                            <option value="all">All Modes</option>
                            <option value="download">Download</option>
                            <option value="pendrive">Pen Drive</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-outline-primary w-100" onclick="resetFilters()">
                            <i class="fas fa-refresh me-2"></i>Reset Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Metrics Cards -->
            <div class="row g-4 mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card fade-in-up">
                        <div class="metric-icon" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="metric-value" id="totalOrders">152</div>
                        <div class="metric-label">Total Orders</div>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12% from last week</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card fade-in-up">
                        <div class="metric-icon" style="background: linear-gradient(135deg, var(--warning-color), #f97316);">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="metric-value" id="pendingOrders">23</div>
                        <div class="metric-label">Pending Orders</div>
                        <div class="metric-change negative">
                            <i class="fas fa-arrow-down"></i>
                            <span>-5% from last week</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card fade-in-up">
                        <div class="metric-icon" style="background: linear-gradient(135deg, var(--success-color), #059669);">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="metric-value" id="completedOrders">118</div>
                        <div class="metric-label">Completed Orders</div>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+18% from last week</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card fade-in-up">
                        <div class="metric-icon" style="background: linear-gradient(135deg, var(--info-color), #0891b2);">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <div class="metric-value" id="revenue">₹45,280</div>
                        <div class="metric-label">Total Revenue</div>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+25% from last week</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Mode Cards -->
            <div class="row g-4 mb-4">
                <div class="col-lg-6">
                    <div class="metric-card fade-in-up">
                        <div class="metric-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="metric-value" id="downloadOrdersToday">8</div>
                        <div class="metric-label">Download Orders Today</div>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+3 from yesterday</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="metric-card fade-in-up">
                        <div class="metric-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                            <i class="fas fa-usb"></i>
                        </div>
                        <div class="metric-value" id="pendriveOrdersToday">3</div>
                        <div class="metric-label">Pen Drive Orders Today</div>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+1 from yesterday</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row g-4 mb-4">
                <!-- Orders Trend Chart -->
                <div class="col-lg-8">
                    <div class="chart-card fade-in-up">
                        <div class="chart-header">
                            <h5 class="chart-title">Orders Trend</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Export Data</a></li>
                                    <li><a class="dropdown-item" href="#">View Details</a></li>
                                    <li><a class="dropdown-item" href="#">Refresh</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="ordersLineChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Order Status Distribution -->
                <div class="col-lg-4">
                    <div class="chart-card fade-in-up">
                        <div class="chart-header">
                            <h5 class="chart-title">Order Status</h5>
                        </div>
                        <div class="chart-container-small">
                            <canvas id="orderStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Charts Row -->
            <div class="row g-4 mb-4">
                <!-- Revenue Chart -->
                <div class="col-lg-6">
                    <div class="chart-card fade-in-up">
                        <div class="chart-header">
                            <h5 class="chart-title">Revenue Overview</h5>
                        </div>
                        <div class="chart-container-small">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Delivery Mode Distribution -->
                <div class="col-lg-6">
                    <div class="chart-card fade-in-up">
                        <div class="chart-header">
                            <h5 class="chart-title">Delivery Modes</h5>
                        </div>
                        <div class="chart-container-small">
                            <canvas id="deliveryModeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="orders-table fade-in-up">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Delivery Mode</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>#ORD-2025-001</strong></td>
                                <td>John Doe</td>
                                <td>Django E-commerce Project</td>
                                <td>₹2,500</td>
                                <td><span class="status-badge status-completed">Completed</span></td>
                                <td><span class="badge bg-primary">Download</span></td>
                                <td>Jun 20, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#ORD-2025-002</strong></td>
                                <td>Jane Smith</td>
                                <td>React Portfolio Website</td>
                                <td>₹1,800</td>
                                <td><span class="status-badge status-processing">Processing</span></td>
                                <td><span class="badge bg-warning">Pen Drive</span></td>
                                <td>Jun 19, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#ORD-2025-003</strong></td>
                                <td>Mike Johnson</td>
                                <td>Python ML Project</td>
                                <td>₹3,200</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td><span class="badge bg-primary">Download</span></td>
                                <td>Jun 19, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#ORD-2025-004</strong></td>
                                <td>Sarah Wilson</td>
                                <td>Vue.js Dashboard</td>
                                <td>₹2,100</td>
                                <td><span class="status-badge status-completed">Completed</span></td>
                                <td><span class="badge bg-warning">Pen Drive</span></td>
                                <td>Jun 18, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#ORD-2025-005</strong></td>
                                <td>David Brown</td>
                                <td>Angular CRM System</td>
                                <td>₹4,500</td>
                                <td><span class="status-badge status-cancelled">Cancelled</span></td>
                                <td><span class="badge bg-primary">Download</span></td>
                                <td>Jun 18, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script>
        // Orders Data
        const ordersData = {
            daily: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                orders: [12, 19, 8, 15, 22, 13, 7],
                completed: [10, 16, 6, 12, 18, 11, 5],
                pending: [2, 3, 2, 3, 4, 2, 2]
            },
            weekly: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                orders: [85, 92, 78, 94],
                completed: [72, 78, 65, 82],
                pending: [13, 14, 13, 12]
            },
            monthly: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                orders: [320, 285, 412, 380, 450, 290],
                completed: [280, 245, 365, 330, 395, 248],
                pending: [40, 40, 47, 50, 55, 42]
            }
        };

        // Initialize Charts
        function initializeCharts() {
            initOrdersLineChart();
            initOrderStatusChart();
            initRevenueChart();
            initDeliveryModeChart();
        }

        // Orders Line Chart
        function initOrdersLineChart() {
            const ctx = document.getElementById('ordersLineChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ordersData.daily.labels,
                    datasets: [{
                        label: 'Total Orders',
                        data: ordersData.daily.orders,
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#4f46e5',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6
                    }, {
                        label: 'Completed',
                        data: ordersData.daily.completed,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }

        // Order Status Pie Chart
        function initOrderStatusChart() {
            const ctx = document.getElementById('orderStatusChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Processing', 'Pending', 'Cancelled'],
                    datasets: [{
                        data: [118, 15, 23, 8],
                        backgroundColor: [
                            '#10b981',
                            '#3b82f6',
                            '#f59e0b',
                            '#ef4444'
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    },
                    cutout: '60%'
                }
            });
        }

        // Revenue Chart
        function initRevenueChart() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Revenue (₹)',
                        data: [8500, 12000, 6800, 9500, 15200, 7800, 4200],
                        backgroundColor: 'rgba(79, 70, 229, 0.8)',
                        borderColor: '#4f46e5',
                        borderWidth: 1,
                        borderRadius: 6,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return '₹' + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Delivery Mode Chart
        function initDeliveryModeChart() {
            const ctx = document.getElementById('deliveryModeChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Download', 'Pen Drive'],
                    datasets: [{
                        data: [85, 67],
                        backgroundColor: [
                            '#8b5cf6',
                            '#f59e0b'
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        }

        // Update Dashboard based on filters
        function updateDashboard() {
            const dateFilter = document.getElementById('dateFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const deliveryFilter = document.getElementById('deliveryFilter').value;
            
            // Update metrics based on filters
            updateMetrics(dateFilter, statusFilter, deliveryFilter);
            
            // Update charts
            updateCharts(dateFilter);
        }

        // Update Metrics
        function updateMetrics(dateFilter, statusFilter, deliveryFilter) {
            // Sample data updates based on filters
            let totalOrders, pendingOrders, completedOrders, revenue;
            
            switch(dateFilter) {
                case 'today':
                    totalOrders = 11;
                    pendingOrders = 3;
                    completedOrders = 7;
                    revenue = '₹6,400';
                    break;
                case 'month':
                    totalOrders = 485;
                    pendingOrders = 67;
                    completedOrders = 398;
                    revenue = '₹1,25,800';
                    break;
                default: // week
                    totalOrders = 152;
                    pendingOrders = 23;
                    completedOrders = 118;
                    revenue = '₹45,280';
            }
            
            // Update DOM elements
            document.getElementById('totalOrders').textContent = totalOrders;
            document.getElementById('pendingOrders').textContent = pendingOrders;
            document.getElementById('completedOrders').textContent = completedOrders;
            document.getElementById('revenue').textContent = revenue;
        }

        // Update Charts
        function updateCharts(dateFilter) {
            // This would typically re-initialize charts with new data
            // For demo purposes, we'll just reinitialize with different datasets
            const chartContainer = document.querySelector('#ordersLineChart');
            if (chartContainer) {
                // Destroy existing chart and create new one
                Chart.getChart(chartContainer)?.destroy();
                initOrdersLineChart();
            }
        }

        // Reset Filters
        function resetFilters() {
            document.getElementById('dateFilter').value = 'week';
            document.getElementById('statusFilter').value = 'all';
            document.getElementById('deliveryFilter').value = 'all';
            updateDashboard();
        }

        // Real-time updates simulation
        function simulateRealTimeUpdates() {
            setInterval(() => {
                // Simulate new order
                const currentTotal = parseInt(document.getElementById('totalOrders').textContent);
                const currentPending = parseInt(document.getElementById('pendingOrders').textContent);
                
                // Random chance of new order
                if (Math.random() > 0.95) {
                    document.getElementById('totalOrders').textContent = currentTotal + 1;
                    document.getElementById('pendingOrders').textContent = currentPending + 1;
                    
                    // Add notification
                    showNotification('New order received!', 'success');
                }
                
                // Random chance of order completion
                if (Math.random() > 0.97 && currentPending > 0) {
                    const currentCompleted = parseInt(document.getElementById('completedOrders').textContent);
                    document.getElementById('pendingOrders').textContent = currentPending - 1;
                    document.getElementById('completedOrders').textContent = currentCompleted + 1;
                    
                    showNotification('Order completed!', 'info');
                }
            }, 5000); // Check every 5 seconds
        }

        // Show Notification
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto dismiss after 4 seconds
            setTimeout(() => {
                notification.remove();
            }, 4000);
        }

        // Initialize everything when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
            simulateRealTimeUpdates();
            
            // Add smooth scrolling for better UX
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });

        // Export functionality (placeholder)
        function exportReport() {
            showNotification('Report export started...', 'info');
            
            // Simulate export process
            setTimeout(() => {
                showNotification('Report exported successfully!', 'success');
            }, 2000);
        }

        // Add click handler for export button
        document.addEventListener('DOMContentLoaded', function() {
            const exportBtn = document.querySelector('.btn-light');
            if (exportBtn) {
                exportBtn.addEventListener('click', exportReport);
            }
        });
    </script>
</body>
</html>