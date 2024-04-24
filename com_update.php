<?php
include 'index1.php';

// Check if the user is logged in or not
if (!isset($_SESSION['usertype'])) {
    header("Location: Login.php");
    exit(); // Ensure that script execution stops after redirection
}

// Include the database connection file
include('database.php');

// Check if the id parameter is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the record from the database based on the ID
    $loggedInUserStid = $_SESSION['stid'];
    $sql = "SELECT * FROM vhf_communication WHERE vhfid = $id AND stid = $loggedInUserStid";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $datetime = $row['date_time'];

        // If the form is submitted, update the record
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve data from the form
            // Assuming you have input fields named 'equipment', 'transmits', 'status', 'location', and 'datetime'
            $equipment = $_POST['equipment'];
            $transmits = $_POST['transmits'];
            $status = $_POST['status'];
            $location = $_POST['location'];
            $datetime = $_POST['date_time'];

            // Prepare the update statement
            $update_sql = "UPDATE vhf_communication SET equipment = ?, transmits = ?, status = ?, loid = ?, date_time = ? WHERE vhfid = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("sssssi", $equipment, $transmits, $status, $location, $datetime, $id);

            // Execute the update statement
            if ($stmt->execute()) {
                // Redirect to the page where the update link was clicked
                header("Location: com.php");
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }

            // Close the prepared statement
            $stmt->close();
        }
    } else {
        echo "No record found with the given ID.";
    }
} else {
    echo "Invalid ID.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Update Record</title>
</head>
<body>
<div class="container mt-5">

    <h2>Update Record</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id"; ?>">
    
    <div class="form-group">
<label for="equipment">Equipment:</label>
        <input type="text"class="form-control" name="equipment" value="<?php echo $row['equipment']; ?>">
        </div>
        <div class="form-group">
<label for="transmits">Transmits:</label>
        <input type="text"class="form-control" name="transmits" value="<?php echo $row['transmits']; ?>">
        </div>
        <div class="form-group">
<label for="status">Status:</label>
        <input type="text"class="form-control" name="status" value="<?php echo $row['status']; ?>">
        </div>
       
        <div class="form-group">
        <label for="date_time">Date/Time:</label>
        <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($datetime)); ?>">
      </div>
        
        <div class="form-group">
      <label for="status">Location:</label>
        <select name="location" id="location">
        <option value="-Select-" selected disabled>-Select-</option>

        <?php
// Connect to your database
include 'database.php';

// Query to fetch location from the database
$sql = "SELECT loid, location FROM locations";
$result = $conn->query($sql);

// Populate options
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['location'] . "'>" . $row['location'] . "</option>";
    }
} else {
    echo "<option value=''>No location available</option>";
}

// Close database connection
$conn->close();
?>
        </select> 
      </div>
        <input  class="btn btn-primary"type="submit" value="Update">
    </form>
    </div>

</body>
</html>
