<?php
session_start();
require "config.php";

// Redirect if not logged in 
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$email = $_SESSION['email'];

// Fetch all bookings for this customer
$bookings = mysqli_query($conn, "SELECT * FROM bookings WHERE email='$email' ORDER BY date DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bookings | Fabulous Cleaning</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <h2 class="sidebar-title"><i class="fas fa-broom"></i> Dashboard</h2>

    <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
    <a class="active" href="customer-bookings.php"><i class="fas fa-calendar-check"></i> My Bookings</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    <a href="#" id="darkToggle"><i class="fas fa-moon"></i> Dark Mode</a>
    <a href="php/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <!-- main content -->
  <div class="main-content">
    <div class="topbar">
      <i class="fas fa-bars" id="menuToggle"></i>
      <span>My Bookings</span>
    </div>

    <h1>Your Bookings</h1>

    <table class="dashboard-table">
      <tr>
        <th>Date</th>
        <th>Service</th>
        <th>Address</th>
        <th>Notes</th>
      </tr>

      <?php
            if (mysqli_num_rows($bookings) == 0) {
                echo "<tr><td colspan='4' style='text-align:center;'>No bookings found.</td></tr>";
            } else {
                while ($row = mysqli_fetch_assoc($bookings)) {
                    echo "<tr>
                            <td>{$row['date']}</td>
                            <td>{$row['service']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['notes']}</td>
                          </tr>";
                }
            }
            ?>
    </table>

  </div>

  <script src="js/sidebar.js"></script>
  <script src="js/darkmode.js"></script>

</body>

</html>