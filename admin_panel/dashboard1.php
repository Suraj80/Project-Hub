<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

error_log("dashboard1.php loaded - Session ID: " . session_id());
error_log("Admin ID: " . ($_SESSION['admin_id'] ?? 'Not set'));


$admin_username = $_SESSION['admin_username'] ?? 'Admin';
$login_time = $_SESSION['login_time'] ?? time();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Traffic Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <style>
        :root {
            --primary: #4e73df;
            --success: #1cc88a;
            --info: #36b9cc;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --secondary: #858796;
            --light: #f8f9fc;
            --dark: #5a5c69;
        }

        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #858796;
            text-align: left;
            background-color: #f8f9fc;
        }

        .bg-gradient-primary {
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        }

        /* .sidebar {
            width: 14rem;
            min-height: 100vh;
        }

        .sidebar-brand {
            height: 4.375rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            padding: 1.5rem 1rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            white-space: nowrap;
        }

        .sidebar .nav-item .nav-link {
            font-weight: 400;
            color: rgba(255, 255, 255, 0.8);
            text-align: left;
            padding: 1rem;
            width: 14rem;
            display: flex;
            align-items: center;
            position: relative;
            text-decoration: none;
        } */

        /* .sidebar .nav-item .nav-link:hover {
            color: #fff;
        }

        .sidebar .nav-item.active .nav-link {
            color: #fff;
        }

        .sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin: 0 1rem 1rem;
        }

        .sidebar-heading {
            font-size: 0.75rem;
            font-weight: 800;
            padding: 1.5rem 1rem 0.5rem;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.05rem;
        }

        .topbar {
            height: 4.375rem;
            border-bottom: 1px solid #e3e6f0;
        } */

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
        }

        .shadow {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
        }

        .border-left-primary {
            border-left: 0.25rem solid var(--primary) !important;
        }

        .border-left-success {
            border-left: 0.25rem solid var(--success) !important;
        }

        .border-left-info {
            border-left: 0.25rem solid var(--info) !important;
        }

        .border-left-warning {
            border-left: 0.25rem solid var(--warning) !important;
        }

        .border-left-danger {
            border-left: 0.25rem solid var(--danger) !important;
        }

        .border-left-secondary {
            border-left: 0.25rem solid var(--secondary) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .text-success {
            color: var(--success) !important;
        }

        .text-info {
            color: var(--info) !important;
        }

        .text-warning {
            color: var(--warning) !important;
        }

        .text-danger {
            color: var(--danger) !important;
        }

        .text-gray-800 {
            color: #5a5c69 !important;
        }

        .text-gray-600 {
            color: #6c757d !important;
        }

        .text-gray-500 {
            color: #858796 !important;
        }

        .text-gray-300 {
            color: #dddfeb !important;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-success {
            background-color: var(--success);
            border-color: var(--success);
        }

        .btn-info {
            background-color: var(--info);
            border-color: var(--info);
        }

        .table-responsive {
            border-radius: 0.35rem;
        }

        .table {
            color: #858796;
        }

        .table th {
            border-top: none;
            color: #5a5c69;
            font-weight: 700;
        }

        .chart-area {
            position: relative;
            height: 20rem;
            width: 100%;
        }

        .chart-pie {
            position: relative;
            height: 15rem;
            width: 100%;
        }

        .status-indicator {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            position: absolute;
            bottom: 0;
            right: 0;
            border: 2px solid #fff;
        }

        .status-indicator.bg-success {
            background-color: var(--success);
        }

        .status-indicator.bg-warning {
            background-color: var(--warning);
        }

        .rotate-n-15 {
            transform: rotate(-15deg);
        }

        .fa-2x {
            font-size: 2em;
        }

        .date-filter-container {
            background: #fff;
            border-radius: 0.35rem;
            padding: 1rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 1.5rem;
        }

        .filter-btn {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .live-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #1cc88a;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        .metric-card {
            transition: transform 0.15s ease-in-out;
        }

        .metric-card:hover {
            transform: translateY(-2px);
        }

        .country-flag {
            width: 20px;
            height: 15px;
            margin-right: 8px;
        }

        .device-icon {
            font-size: 1.2rem;
            margin-right: 8px;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
   
<!-- <?php
include 'components/navbar.php';?>   -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            <i class="fas fa-chart-line text-primary mr-2"></i>Traffic Analytics Dashboard
                        </h1>
                        <div class="d-flex align-items-center">
                            <span class="live-indicator mr-2"></span>
                            <span class="text-success small font-weight-bold">Live Data</span>
                        </div>
                    </div>

                    <!-- Date Range Filter -->
                    <div class="date-filter-container">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h6 class="text-gray-800 font-weight-bold mb-2">Date Range Filter</h6>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary filter-btn active" data-range="today">Today</button>
                                    <button type="button" class="btn btn-outline-primary filter-btn" data-range="yesterday">Yesterday</button>
                                    <button type="button" class="btn btn-outline-primary filter-btn" data-range="7days">Last 7 Days</button>
                                    <button type="button" class="btn btn-outline-primary filter-btn" data-range="30days">This Month</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-gray-800 font-weight-bold mb-2">Custom Range</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <input type="date" class="form-control form-control-sm" id="startDate">
                                    </div>
                                    <div class="col-2 text-center">
                                        <span class="text-gray-500">to</span>
                                    </div>
                                    <div class="col-5">
                                        <input type="date" class="form-control form-control-sm" id="endDate">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards Row -->
                    <div class="row">
                        <!-- Total Visitors -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2 metric-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Visitors</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalVisitors">45,210</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Unique Visitors -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2 metric-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Unique Visitors</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="uniqueVisitors">32,150</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Returning Users -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2 metric-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Returning Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="returningUsers">13,060</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Users -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2 metric-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Active Right Now</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="activeUsers">247</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-circle fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Session Duration -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2 metric-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Avg. Session</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="sessionDuration">4m 32s</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bounce Rate -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2 metric-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Bounce Rate</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="bounceRate">24.5%</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row">
                        <!-- Traffic Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Live Traffic Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <select class="form-control form-control-sm" id="trafficTimeframe" style="width: auto;">
                                            <option value="hourly">Hourly</option>
                                            <option value="daily" selected>Daily</option>
                                            <option value="weekly">Weekly</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="trafficChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Device Traffic Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Traffic by Device</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="deviceChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Desktop
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Mobile
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Tablet
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tables Row -->
                    <div class="row">
                        <!-- Traffic Sources -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Top Traffic Sources</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Source Type</th>
                                                    <th>Visitors</th>
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody id="trafficSourcesTable">
                                                <tr>
                                                    <td><i class="fab fa-google text-warning mr-2"></i>Google Search</td>
                                                    <td>14,320</td>
                                                    <td><span class="badge badge-primary">31.7%</span></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-link text-secondary mr-2"></i>Direct Visit</td>
                                                    <td>10,210</td>
                                                    <td><span class="badge badge-success">22.6%</span></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fab fa-facebook text-primary mr-2"></i>Social Media</td>
                                                    <td>8,115</td>
                                                    <td><span class="badge badge-info">17.9%</span></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-external-link-alt text-info mr-2"></i>Referral Links</td>
                                                    <td>6,850</td>
                                                    <td><span class="badge badge-warning">15.1%</span></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-envelope text-danger mr-2"></i>Email Campaigns</td>
                                                    <td>5,715</td>
                                                    <td><span class="badge badge-secondary">12.6%</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <!-- Top Countries -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Top Countries</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Country</th>
                                                    <th>Visitors</th>
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody id="topCountriesTable">
                                                <tr>
                                                    <td>
                                                        <img src="https://flagcdn.com/w20/us.png" class="country-flag" alt="USA">
                                                        United States
                                                    </td>
                                                    <td>12,450</td>
                                                    <td><span class="badge badge-primary">27.5%</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://flagcdn.com/w20/gb.png" class="country-flag" alt="UK">
                                                        United Kingdom
                                                    </td>
                                                    <td>8,320</td>
                                                    <td><span class="badge badge-success">18.4%</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://flagcdn.com/w20/ca.png" class="country-flag" alt="Canada">
                                                        Canada
                                                    </td>
                                                    <td>6,750</td>
                                                    <td><span class="badge badge-info">14.9%</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://flagcdn.com/w20/au.png" class="country-flag" alt="Australia">
                                                        Australia
                                                    </td>
                                                    <td>5,890</td>
                                                    <td><span class="badge badge-warning">13.0%</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://flagcdn.com/w20/de.png" class="country-flag" alt="Germany">
                                                        Germany
                                                    </td>
                                                    <td>4,210</td>
                                                    <td><span class="badge badge-secondary">9.3%</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Real-time Activity Row -->
                    <div class="row">
                        <!-- Recent Activity -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <span class="live-indicator mr-2"></span>Real-time Activity
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div id="realtimeActivity" style="max-height: 300px; overflow-y: auto;">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="status-indicator bg-success mr-3"></div>
                                            <div class="flex-grow-1">
                                                <div class="small text-gray-500">2 seconds ago</div>
                                                <div>New visitor from <strong>United States</strong> via Google Search</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="status-indicator bg-warning mr-3"></div>
                                            <div class="flex-grow-1">
                                                <div class="small text-gray-500">15 seconds ago</div>
                                                <div>User session ended - <strong>3m 45s</strong> duration</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="status-indicator bg-success mr-3"></div>
                                            <div class="flex-grow-1">
                                                <div class="small text-gray-500">32 seconds ago</div>
                                                <div>New visitor from <strong>Canada</strong> via Direct Visit</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="status-indicator bg-success mr-3"></div>
                                            <div class="flex-grow-1">
                                                <div class="small text-gray-500">1 minute ago</div>
                                                <div>Page view: <strong>/products</strong> from Mobile device</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="status-indicator bg-success mr-3"></div>
                                            <div class="flex-grow-1">
                                                <div class="small text-gray-500">2 minutes ago</div>
                                                <div>New visitor from <strong>United Kingdom</strong> via Social Media</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Top Pages -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Most Visited Pages</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Page</th>
                                                    <th>Views</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><i class="fas fa-home mr-2 text-primary"></i>/home</td>
                                                    <td><span class="badge badge-primary">8,432</span></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-box mr-2 text-success"></i>/products</td>
                                                    <td><span class="badge badge-success">6,891</span></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-info-circle mr-2 text-info"></i>/about</td>
                                                    <td><span class="badge badge-info">4,521</span></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-envelope mr-2 text-warning"></i>/contact</td>
                                                    <td><span class="badge badge-warning">3,210</span></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-blog mr-2 text-secondary"></i>/blog</td>
                                                    <td><span class="badge badge-secondary">2,845</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Metrics Row -->
                    <div class="row">
                        <!-- Browser Stats -->
                        <div class="col-xl-4 col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Browser Statistics</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span><i class="fab fa-chrome mr-2 text-warning"></i>Chrome</span>
                                            <strong>45.2%</strong>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" style="width: 45.2%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span><i class="fab fa-safari mr-2 text-primary"></i>Safari</span>
                                            <strong>28.7%</strong>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" style="width: 28.7%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span><i class="fab fa-firefox mr-2 text-danger"></i>Firefox</span>
                                            <strong>16.4%</strong>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" style="width: 16.4%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span><i class="fab fa-edge mr-2 text-info"></i>Edge</span>
                                            <strong>9.7%</strong>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" style="width: 9.7%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Device Details -->
                        <div class="col-xl-4 col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Device Breakdown</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        <canvas id="deviceDetailChart" width="200" height="200"></canvas>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <i class="fas fa-desktop device-icon text-primary"></i>
                                            <div class="font-weight-bold">52.3%</div>
                                            <div class="small text-gray-500">Desktop</div>
                                        </div>
                                        <div class="col-4">
                                            <i class="fas fa-mobile-alt device-icon text-success"></i>
                                            <div class="font-weight-bold">34.8%</div>
                                            <div class="small text-gray-500">Mobile</div>
                                        </div>
                                        <div class="col-4">
                                            <i class="fas fa-tablet-alt device-icon text-info"></i>
                                            <div class="font-weight-bold">12.9%</div>
                                            <div class="small text-gray-500">Tablet</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Performance Metrics -->
                        <div class="col-xl-4 col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Performance Metrics</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Page Load Time</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">2.3s</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">First Paint</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">1.2s</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Time to Interactive</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">3.1s</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Server Response</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">180ms</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Overall Score</div>
                                            <div class="progress mb-2">
                                                <div class="progress-bar bg-success" style="width: 89%">89%</div>
                                            </div>
                                            <div class="small text-gray-500">Good performance rating</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2023 | Traffic Analytics Dashboard</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" style="display: none; position: fixed; right: 1rem; bottom: 1rem; width: 2.75rem; height: 2.75rem; text-align: center; color: #fff; background: rgba(90, 92, 105, 0.5); line-height: 46px; border-radius: 100%;">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap and jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script>
        // Sidebar Toggle
        $("#sidebarToggleTop, #sidebarToggle").on('click', function(e) {
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
        });

        // Date Filter Functionality
        $('.filter-btn').click(function() {
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');
            updateDashboard($(this).data('range'));
        });

        // Initialize Charts
        let trafficChart, deviceChart, deviceDetailChart;

        // Traffic Overview Chart
        const trafficCtx = document.getElementById('trafficChart').getContext('2d');
        trafficChart = new Chart(trafficCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Visitors',
                    data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 32000, 40000, 38000, 45000],
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
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
                            color: '#e3e6f0'
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

        // Device Pie Chart
        const deviceCtx = document.getElementById('deviceChart').getContext('2d');
        deviceChart = new Chart(deviceCtx, {
            type: 'doughnut',
            data: {
                labels: ['Desktop', 'Mobile', 'Tablet'],
                datasets: [{
                    data: [52.3, 34.8, 12.9],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Device Detail Chart (smaller version)
        const deviceDetailCtx = document.getElementById('deviceDetailChart').getContext('2d');
        deviceDetailChart = new Chart(deviceDetailCtx, {
            type: 'doughnut',
            data: {
                labels: ['Desktop', 'Mobile', 'Tablet'],
                datasets: [{
                    data: [52.3, 34.8, 12.9],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Real-time data simulation
        function simulateRealTimeData() {
            // Update active users count
            const activeUsers = Math.floor(Math.random() * 100) + 200;
            document.getElementById('activeUsers').textContent = activeUsers;

            // Add new activity
            addRealTimeActivity();
        }

        function addRealTimeActivity() {
            const activities = [
                'New visitor from <strong>United States</strong> via Google Search',
                'User session ended - <strong>4m 12s</strong> duration',
                'New visitor from <strong>Canada</strong> via Direct Visit',
                'Page view: <strong>/contact</strong> from Desktop device',
                'New visitor from <strong>Australia</strong> via Social Media',
                'User completed purchase - <strong>$85.99</strong>',
                'New visitor from <strong>Germany</strong> via Email Campaign'
            ];

            const countries = ['United States', 'United Kingdom', 'Canada', 'Australia', 'Germany', 'France', 'Japan'];
            const sources = ['Google Search', 'Direct Visit', 'Social Media', 'Email Campaign', 'Referral Links'];
            
            const activity = activities[Math.floor(Math.random() * activities.length)];
            const activityDiv = document.getElementById('realtimeActivity');
            
            const newActivity = document.createElement('div');
            newActivity.className = 'd-flex align-items-center mb-2';
            newActivity.innerHTML = `
                <div class="status-indicator bg-success mr-3"></div>
                <div class="flex-grow-1">
                    <div class="small text-gray-500">just now</div>
                    <div>${activity}</div>
                </div>
            `;
            
            activityDiv.insertBefore(newActivity, activityDiv.firstChild);
            
            // Keep only last 8 activities
            while (activityDiv.children.length > 8) {
                activityDiv.removeChild(activityDiv.lastChild);
            }
        }

        // Update dashboard based on date range
        function updateDashboard(range) {
            // Simulate different data based on range
            const data = {
                today: { visitors: 3420, unique: 2150, returning: 1270, bounce: 28.5 },
                yesterday: { visitors: 4210, unique: 2890, returning: 1320, bounce: 24.5 },
                '7days': { visitors: 25340, unique: 18250, returning: 7090, bounce: 26.2 },
                '30days': { visitors: 45210, unique: 32150, returning: 13060, bounce: 24.5 }
            };

            const currentData = data[range] || data['30days'];
            
            document.getElementById('totalVisitors').textContent = currentData.visitors.toLocaleString();
            document.getElementById('uniqueVisitors').textContent = currentData.unique.toLocaleString();
            document.getElementById('returningUsers').textContent = currentData.returning.toLocaleString();
            document.getElementById('bounceRate').textContent = currentData.bounce + '%';
        }

        // Start real-time updates
        setInterval(simulateRealTimeData, 5000);

        // Scroll to top functionality
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.scroll-to-top').fadeIn();
            } else {
                $('.scroll-to-top').fadeOut();
            }
        });

        $('.scroll-to-top').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 800);
        });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Set current date in date inputs
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('endDate').value = today;
        
        const weekAgo = new Date();
        weekAgo.setDate(weekAgo.getDate() - 7);
        document.getElementById('startDate').value = weekAgo.toISOString().split('T')[0];
    </script>
</body>
</html>