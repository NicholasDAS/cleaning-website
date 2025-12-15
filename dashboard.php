<?php
session_start();

// redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Fabulous Cleaning</title>

  <!-- main website css -->
  <link rel="stylesheet" href="css/style.css">

  <!-- dashboard ccs -->
  <link rel="stylesheet" href="css/dashboard.css">

  <!-- link, i copied this from fontawesome to create icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">




</head>

<body>

  <!-- sidebard -->
  <div class="sidebar" id="sidebar">
    <h2 class="sidebar-title"><i class="fas fa-broom"></i>Dashboard</h2>

    <a href="dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
    <a href="booking.html"><i class="fas fa-calendar-plus"></i> Book Now</a> <!-- ADD THIS -->
    <a href="customer-bookings.php"><i class="fas fa-calendar-check"></i> My Bookings</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    <a href="#" id="darkToggle"><i class="fas fa-moon"></i> Dark Mode</a>

    <a href="php/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>


  <!-- main content -->
  <div class="main-content">

    <div class="topbar">
      <i class="fas fa-bars" id="menuToggle"></i>
      <span>Welcome, <strong><?php echo $user; ?></strong></span>
    </div>

    <h1>Your Dashboard</h1>

    <!-- dashboard cards -->
    <div class="cards-container">

      <!-- car one-->
      <div class="card">
        <i class="fas fa-calendar-day card-icon"></i>
        <h3>Upcoming Booking</h3>
        <p>No upcoming bookings</p>
      </div>

      <!--card 1-->
      <div class="card">
        <i class="fas fa-list card-icon"></i>
        <h3>Total Bookings</h3>
        <p>0</p>
      </div>

      <!-- card3 -->
      <div class="card">
        <i class="fas fa-user card-icon"></i>
        <h3>Your Profile</h3>
        <p>View & Edit Profile</p>
      </div>

    </div>

    <!-- table -->
    <h2 class="section-title">Recent Booking History</h2>

    <table class="dashboard-table">
      <tr>
        <th>Date</th>
        <th>Service</th>
        <th>Status</th>
      </tr>

      <tr>
        <td colspan="3" style="text-align:center;">No booking history yet.</td>
      </tr>
    </table>

  </div>

  <!-- js -->
  <script src="js/sidebar.js"></script>
  <script src="js/darkmode.js"></script>

</body>

</html>