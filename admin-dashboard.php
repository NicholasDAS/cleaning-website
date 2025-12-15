<?php
session_start();
require "php/config.php";

// Only admins can access
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php"); // redirect normal users
    exit();
}

$admin = $_SESSION['user'];

// Fetch stats
$totalUsers    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$totalBookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings"))['total'];

$today = date("Y-m-d");
$todaysBookings = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings WHERE date='$today'")
)['total'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | Fabulous Cleaning</title>

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dashboard.css">

  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

  <!-- sidebar admin version -->
  <div class="sidebar" id="sidebar">
    <h2 class="sidebar-title"><i class="fas fa-user-shield"></i> Admin</h2>

    <a class="active" href="admin-dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
    <a href="admin-users.php"><i class="fas fa-users"></i> Users</a>
    <a href="admin-bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a>
    <a href="admin-stats.php"><i class="fas fa-chart-pie"></i> Analytics</a>

    <a href="#" id="darkToggle"><i class="fas fa-moon"></i> Dark Mode</a>
    <a href="php/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <!-- main content -->
  <div class="main-content">

    <div class="topbar">
      <i class="fas fa-bars" id="menuToggle"></i>
      <span>Welcome, <strong>Admin <?php echo $admin; ?></strong></span>
    </div>

    <h1>Admin Dashboard</h1>

    <!-- card -->
    <div class="cards-container">

      <div class="card admin-card">
        <i class="fas fa-users card-icon"></i>
        <h3>Total Users</h3>
        <p><?php echo $totalUsers; ?></p>
      </div>

      <div class="card admin-card">
        <i class="fas fa-calendar-check card-icon"></i>
        <h3>Total Bookings</h3>
        <p><?php echo $totalBookings; ?></p>
      </div>

      <div class="card admin-card">
        <i class="fas fa-clock card-icon"></i>
        <h3>Today's Bookings</h3>
        <p><?php echo $todaysBookings; ?></p>
      </div>

    </div>

    <!-- chats -->
    <h2 class="section-title">Analytics</h2>

    <div style="max-width:900px;margin:auto;">
      <canvas id="lineChart"></canvas>
    </div>

    <br><br>

    <div style="max-width:900px;margin:auto;">
      <canvas id="barChart"></canvas>
    </div>

  </div>

  <!-- JS -->
  <script src="js/sidebar.js"></script>
  <script src="js/darkmode.js"></script>
  <script src="js/charts.js"></script>

</body>

</html>