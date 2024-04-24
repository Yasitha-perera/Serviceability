<?php
// Include your database connection
include 'database.php'; // Assuming the database.php file is in the parent directory
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $location = $_POST["location"];
    $category = $_POST["field1"];
    $naming_sop = $_POST["field2"];
    $naming_eane = $_POST["field3"];
    $item = $_POST["field4"];
    $stid = isset($_SESSION['stid']) ? $_SESSION['stid'] : ''; // Assuming stid is stored in the session
    $cid = "3";
    $machineType = "equipments";
    date_default_timezone_set('Asia/Colombo');

    $current_time = date('Y-m-d H:i:s');

    // SQL insert statement
    $sql_insert = "INSERT INTO equipments (loid, category, sop, eane, item, stid,cid,machine_type,date_time) 
                   VALUES ('$location', '$category', '$naming_sop', '$naming_eane', '$item', '$stid','$cid','$machineType',' $current_time')";

    // Execute the SQL insert statement
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script type='text/javascript'>
        alert('New record inserted successfully..');
        window.location.href ='Surveillance.php';
        </script>";    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
