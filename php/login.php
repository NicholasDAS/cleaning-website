<?php
session_start();
require __DIR__ . "/../config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../login.html");
    exit();
}

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

// Check if user exists
$stmt = $conn->prepare("SELECT id, fullname, email, password, role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// If user found
if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();

    // place it here
    if (password_verify($password, $user["password"])) {

        // Create session
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["fullname"] = $user["fullname"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["role"] = $user["role"];

        // Redirect ALL users to main website
        header("Location: ../index.html");
        exit();
    }
    // end of block

    else {
        echo "<script>alert('Incorrect password'); window.location='../login.html';</script>";
        exit();
    }

} else {
    echo "<script>alert('Account not found'); window.location='../login.html';</script>";
    exit();
}
?>