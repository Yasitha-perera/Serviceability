<?php
// Include your database connection
include 'database.php'; // Assuming the database.php file is in the parent directory
session_start();

// Define machine_type and cid variables with the values you want to insert
$machineType = "links";
$cid = "1";
date_default_timezone_set('Asia/Colombo');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $location = $_POST["location"];
    $equipment = $_POST["field5"]; // Assuming field3 is your equipment field
    $stid = isset($_SESSION['stid']) ? $_SESSION['stid'] : ''; // Assuming stid is stored in the session
    $current_time = date('Y-m-d H:i:s');


    // SQL insert statement
    $sql_insert = "INSERT INTO machine (loid, equipment, stid, machine_type, cid,date_time) 
                   VALUES ('$location', '$equipment', '$stid', '$machineType', '$cid',' $current_time')";

    // Execute the SQL insert statement
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script type='text/javascript'>
        alert('Data Entered Successfully..');
        window.location.href ='Communication.php';
        </script>";
        } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
