<?php
session_start();
require "config.php";

// Ensure user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../login.html");
    exit();
}

$currentEmail = $_SESSION['email'];

// Collect form data safely
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$email    = mysqli_real_escape_string($conn, $_POST['email']);
$phone    = mysqli_real_escape_string($conn, $_POST['phone']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Build SQL query depending on whether password is updated
if (!empty($password)) {
    // New password was entered → hash it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users 
            SET fullname='$fullname', email='$email', phone='$phone', password='$hashedPassword' 
            WHERE email='$currentEmail'";
} else {
    // No password update
    $sql = "UPDATE users 
            SET fullname='$fullname', email='$email', phone='$phone' 
            WHERE email='$currentEmail'";
}

// Execute update
if (mysqli_query($conn, $sql)) {

    // Update session values
    $_SESSION['user']  = $fullname;
    $_SESSION['email'] = $email;

    echo "<h2 style='color:green;text-align:center;'>Profile Updated Successfully!</h2>";
    echo "<p style='text-align:center;'><a href='../profile.php'>Return to Profile</a></p>";

} else {
    echo "<h2 style='color:red;text-align:center;'>Error updating profile!</h2>";
    echo "<p style='text-align:center;'>". mysqli_error($conn) ."</p>";
    echo "<p style='text-align:center;'><a href='../edit-profile.php'>Try Again</a></p>";
}

?>
