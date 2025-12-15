<?php
/* 
   sign up backend with support role
   in this place
   - Automatically assigns role = 'customer'
   - Saves new user into MySQL database
   - Hashes password securely
   - Redirects to login page after registration
    */

    // database connection
session_start();
require __DIR__ . "/../config.php";
 

// Collect form data safely
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$email    = mysqli_real_escape_string($conn, $_POST['email']);
$phone    = mysqli_real_escape_string($conn, $_POST['phone']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check for existing email
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($check) > 0) {
    echo "<h2 style='color:red;text-align:center;'>Email already exists!</h2>";
    echo "<p style='text-align:center;'><a href='../signup.html'>Go Back</a></p>";
    exit();
}

// new Role column automatically set to customer
$role = "customer";

// Insert new user
$sql = "INSERT INTO users (fullname, email, phone, password, role)
        VALUES ('$fullname', '$email', '$phone', '$hashed_password', '$role')";

if (mysqli_query($conn, $sql)) {
    echo "<h2 style='color:green;text-align:center;'>Account Created Successfully!</h2>";
    echo "<p style='text-align:center;'><a href='../login.html'>Login Now</a></p>";
} else {
    echo "<h2 style='color:red;text-align:center;'>Error creating account!</h2>";
    echo "<p style='text-align:center;'>". mysqli_error($conn) ."</p>";
}

?>