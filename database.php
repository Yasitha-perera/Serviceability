<?php
// Database configuration
$hostName = "localhost"; // MySQL server hostname
$dbUser = "root"; // MySQL username
$dbPassword = ""; // MySQL password (empty in this case)
$dbName = "atcdb"; // Database name

// Establishing connection to the database
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Checking if the connection was successful
if (!$conn) {
    // If connection fails, output an error message and stop script execution
    die("Something went wrong: " . mysqli_connect_error());
}
?>
