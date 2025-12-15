<?php
session_start();

//redirect if not logged in
if (!isset($_SESSION['user']) || !isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$fullname = $_SESSION['user'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile | Fabulous Cleaning</title>

  <!-- css -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/dashboard.css">

  <!--iIcons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

  <!--sSidebar -->
  <div class="sidebar" id="sidebar">
    <h2 class="sidebar-title"><i class="fas fa-broom"></i> Dashboard</h2>

    <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
    <a href="customer-bookings.php"><i class="fas fa-calendar-check"></i> My Bookings</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    <a href="#" id="darkToggle"><i class="fas fa-moon"></i> Dark Mode</a>

    <a href="php/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <!-- main content -->
  <div class="main-content">

    <div class="topbar">
      <i class="fas fa-bars" id="menuToggle"></i>
      <span>Edit Profile</span>
    </div>

    <h1>Edit Your Profile</h1>

    <div class="edit-profile-card">
      <form action="php/update-profile.php" method="POST">

        <label>Full Name:</label>
        <input type="text" name="fullname" value="<?php echo $fullname; ?>" required>

        <label>Email Address:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>

        <label>Phone Number:</label>
        <input type="text" name="phone" placeholder="Enter phone number">

        <label>New Password (optional):</label>
        <input type="password" name="password" placeholder="Enter new password">

        <button type="submit" class="btn update-btn">Save Changes</button>

      </form>
    </div>

  </div>

  <!-- Scripts -->
  <script src="js/sidebar.js"></script>
  <script src="js/darkmode.js"></script>

</body>

</html>