<?php
session_start();
require "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redirect if someone accesses book.php directly
    header("Location: ../contact.html");
    exit();
}



// this s simple   booking processor, Saves each booking into bookings.txt
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$date = $_POST['date'];

// Save in bookings file
$record = "$name | $email | $address | $date\n";
file_put_contents("bookings.txt", $record, FILE_APPEND);

// Response to message
echo "<h2>Booking received!</h2>";
echo "<p>Thank you, $name. We have received your request.</p>";
echo "<a href='../index.html'>Return Home</a>";
?>