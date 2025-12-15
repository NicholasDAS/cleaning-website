<?php
/*
    this place is for database connection file
   This file connects PHP backend to MySQL DB.
   this is why cuz i am using phpmyadmin MySQL for database, not SQLite3 */

$host = "localhost";     // this is the localhost
$user = "root";          // this is MySQL username
$pass = "";              // this is MySQL password and is always like this with double quotes and semi-column
$dbname = "cleaning_db"; // this is the database name which i have use to create the database

// this is to create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// this is to check the connection
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>