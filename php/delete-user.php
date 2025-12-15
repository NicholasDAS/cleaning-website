<?php
require "config.php";
session_start();

// Only admin can delete
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Not authorized.");
}

$id = intval($_GET['id']);

mysqli_query($conn, "DELETE FROM users WHERE id=$id");

header("Location: ../admin-users.php");
exit();
?>
