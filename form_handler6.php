<?php
// Include your database connection
include 'database.php'; // Assuming the database.php file is in the same directory as the form_handler6.php file
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $location = $_POST["location"];
    $equipment = $_POST["field1"];
    $transmits = $_POST["field2"];
    $status = $_POST["field3"];
    $cid = "1"; // Assuming a default value for cid
    $machineType = "vhf_communication";
    date_default_timezone_set('Asia/Colombo');

    // Get the current time
    $current_time = date('Y-m-d H:i:s');

    // Get the session stid if available
    $stid = isset($_SESSION['stid']) ? $_SESSION['stid'] : ''; // Assuming stid is stored in the session

    // SQL insert statement
    $sql_insert = "INSERT INTO vhf_communication (loid, equipment, transmits, status, cid, machine_type, date_time, stid) 
                   VALUES ('$location', '$equipment', '$transmits', '$status', '$cid','$machineType', '$current_time', '$stid')";

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
