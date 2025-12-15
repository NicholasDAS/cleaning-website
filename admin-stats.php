<?php
session_start();
require "php/config.php";

// only the admin can have access here
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

// fetch booking count dates
$datesQuery = mysqli_query($conn,
    "SELECT date, COUNT(*) AS total 
     FROM bookings 
     GROUP BY date 
     ORDER BY date ASC"
);

$chartDates = [];
$chartCounts = [];

while ($row = mysqli_fetch_assoc($datesQuery)) {
    $chartDates[] = $row['date'];
    $chartCounts[] = $row['total'];
}

// fetch books count service
$serviceQuery = mysqli_query($conn,
    "SELECT service, COUNT(*) AS total 
     FROM bookings 
     GROUP BY service"
);

$serviceNames = [];
$serviceCounts = [];

while ($row = mysqli_fetch_assoc($serviceQuery)) {
    $serviceNames[] = $row['service'];
    $serviceCounts[] = $row['total'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Analytics | Fabulous Cleaning</title>

  <!--css -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dashboard.css">

  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- chart js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

  <!-- sidebar admin -->
  <div class="sidebar" id="sidebar">
    <h2 class="sidebar-title"><i class="fas fa-user-shield"></i> Admin</h2>

    <a href="admin-dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
    <a href="admin-users.php"><i class="fas fa-users"></i> Users</a>
    <a href="admin-bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a>
    <a class="active" href="admin-stats.php"><i class="fas fa-chart-pie"></i> Analytics</a>

    <a href="#" id="darkToggle"><i class="fas fa-moon"></i> Dark Mode</a>
    <a href="php/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <!-- main content -->
  <div class="main-content">

    <div class="topbar">
      <i class="fas fa-bars" id="menuToggle"></i>
      <span>Analytics Overview</span>
    </div>

    <h1>Analytics</h1>

    <!--   line chart bookings by date-->
    <h2 class="section-title">Bookings Over Time</h2>

    <div style="max-width:900px;margin:auto;">
      <canvas id="lineChart"></canvas>
    </div>

    <br><br>

    <!-- bar chart bookings y service -->
    <h2 class="section-title">Bookings Per Service Type</h2>

    <div style="max-width:900px;margin:auto;">
      <canvas id="barChart"></canvas>
    </div>

  </div>

  <!-- JS -->
  <script src="js/sidebar.js"></script>
  <script src="js/darkmode.js"></script>

  <!-- chart data -->
  <script>
  const chartDates = <?php echo json_encode($chartDates); ?>;
  const chartCounts = <?php echo json_encode($chartCounts); ?>;

  const serviceNames = <?php echo json_encode($serviceNames); ?>;
  const serviceCounts = <?php echo json_encode($serviceCounts); ?>;
  </script>

  <script src="js/charts.js"></script>

</body>

</html>