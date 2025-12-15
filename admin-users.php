<?php
session_start();
require "php/config.php";

// Only admins allowed
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

// Fetch all users
$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users | Fabulous Cleaning</title>

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dashboard.css">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

  <!-- sidebar admin -->
  <div class="sidebar" id="sidebar">
    <h2 class="sidebar-title"><i class="fas fa-user-shield"></i> Admin</h2>

    <a href="admin-dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
    <a class="active" href="admin-users.php"><i class="fas fa-users"></i> Users</a>
    <a href="admin-bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a>
    <a href="admin-stats.php"><i class="fas fa-chart-pie"></i> Analytics</a>

    <a href="#" id="darkToggle"><i class="fas fa-moon"></i> Dark Mode</a>
    <a href="php/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <!-- main content -->
  <div class="main-content">

    <div class="topbar">
      <i class="fas fa-bars" id="menuToggle"></i>
      <span>User Management</span>
    </div>

    <h1>All Users</h1>

    <table class="dashboard-table">
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Role</th>
        <th>Delete</th>
      </tr>

      <?php
            while ($row = mysqli_fetch_assoc($users)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['fullname']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['role']}</td>
                        <td>
                            <a href='php/delete-user.php?id={$row['id']}' 
                               class='delete-btn'
                               onclick=\"return confirm('Delete this user?');\">
                                <i class='fas fa-trash'></i>
                            </a>
                        </td>
                    </tr>";
            }
            ?>
    </table>

  </div>

  <!-- JS -->
  <script src="js/sidebar.js"></script>
  <script src="js/darkmode.js"></script>

</body>

</html>