<?php
session_start();
require "php/config.php";

// ONLY ADMIN CAN ACCESS
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

// Fetch all bookings
$bookings = mysqli_query($conn, "SELECT * FROM bookings ORDER BY date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings | Fabulous Cleaning</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">

    <!-- Icons -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

    <!-- SIDEBAR (ADMIN) -->
    <div class="sidebar" id="sidebar">
        <h2 class="sidebar-title"><i class="fas fa-user-shield"></i> Admin</h2>

        <a href="admin-dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="admin-users.php"><i class="fas fa-users"></i> Users</a>
        <a class="active" href="admin-bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a>
        <a href="admin-stats.php"><i class="fas fa-chart-pie"></i> Analytics</a>

        <a href="#" id="darkToggle"><i class="fas fa-moon"></i> Dark Mode</a>
        <a href="php/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="topbar">
            <i class="fas fa-bars" id="menuToggle"></i>
            <span>Manage Bookings</span>
        </div>

        <h1>All Bookings</h1>

        <table class="dashboard-table">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Service</th>
                <th>Date</th>
                <th>Address</th>
                <th>Notes</th>
                <th>Delete</th>
            </tr>

            <?php
            if (mysqli_num_rows($bookings) == 0) {
                echo "<tr><td colspan='9' style='text-align:center;'>No bookings found.</td></tr>";
            } else {
                while ($row = mysqli_fetch_assoc($bookings)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['service']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['notes']}</td>
                            <td>
                                <a href='php/delete-booking.php?id={$row['id']}'
                                   class='delete-btn'
                                   onclick=\"return confirm('Delete this booking?');\">
                                   <i class='fas fa-trash'></i>
                                </a>
                            </td>
                        </tr>";
                }
            }
            ?>
        </table>

    </div>

    <!-- JS -->
    <script src="js/sidebar.js"></script>
    <script src="js/darkmode.js"></script>

</body>
</html>
