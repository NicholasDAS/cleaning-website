<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user']) || !isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile | Fabulous Cleaning</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h2 class="sidebar-title"><i class="fas fa-broom"></i> Dashboard</h2>

        <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
        <a href="customer-bookings.php"><i class="fas fa-calendar-check"></i> My Bookings</a>
        <a href="profile.php" class="active"><i class="fas fa-user"></i> Profile</a>
        <a href="#" id="darkToggle"><i class="fas fa-moon"></i> Dark Mode</a>

        <a href="php/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <div class="topbar">
            <i class="fas fa-bars" id="menuToggle"></i>
            <span>Profile</span>
        </div>

        <h1>Your Profile</h1>

        <div class="profile-card">
            <div class="profile-left">
                <i class="fas fa-user-circle profile-icon"></i>
            </div>

            <div class="profile-right">
                <p><strong>Name:</strong> <?php echo $user; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Role:</strong> Customer</p>

                <a href="edit-profile.php" class="btn profile-btn">Edit Profile</a>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="js/sidebar.js"></script>
    <script src="js/darkmode.js"></script>

</body>
</html>
