<?php
session_start();
require "config.php";

// Only admin can delete bookings
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Not authorized.");
}

$id = intval($_GET['id']);

mysqli_query($conn, "DELETE FROM bookings WHERE id = $id");

header("Location: ../admin-bookings.php");
exit();
?>
