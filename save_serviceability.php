<?php
include('database.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serviceability = NULL;
    // Check if data is received
    if (isset($_POST['mid']) && isset($_POST['equipment']) && isset($_POST['loid']) && isset($_POST['cid'])&& isset($_POST['machine_type'])&& isset($_POST['stid']) && isset($_POST['serviceability'])) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO serviceability_log (mid, equipment, loid, cid,machine_type,stid, serviceability,datetime) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Get current date and time
        date_default_timezone_set('Asia/Colombo');
        $submission_datetime = date("Y-m-d H:i:s");

        // Loop through the submitted data
        foreach ($_POST['mid'] as $key => $mid) {
            // Get values for each equipment
          
            $equipment = $_POST['equipment'][$key];
            $loid = $_POST['loid'][$key];
            $cid = $_POST['cid'][$key];
            $machine_type = $_POST['machine_type'][$key];
            $stid = $_POST['stid'][$key];
            $serviceability = $_POST['serviceability'][$key];
            
            // Bind parameters
            $stmt->bind_param("issssiss", $mid, $equipment, $loid, $cid, $machine_type,$stid , $serviceability, $submission_datetime);
            // Skip the row if serviceability is null
            if ($serviceability !== "0") {
                // Execute the SQL statement
                $stmt->execute();
            }
        }

        // Close statement
        $stmt->close();

        // Redirect back to the previous page
      header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // If data is not received, redirect back to the previous page with an error message
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=Data not received");
        exit();
    }
} else {
    // If the form is not submitted, redirect back to the previous page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
