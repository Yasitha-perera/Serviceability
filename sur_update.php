<?php
// Check if the user is logged in
include 'index1.php';
if (!isset($_SESSION['usertype'])) {
    header("Location: Login.php");
    exit();
}

// Include database connection
include('database.php');

// Check if the ID parameter is set and numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the record from the database based on the ID
    $sql = "SELECT * FROM equipments WHERE eid = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $date_time = $row['date_time'];

        // If the form is submitted, update the record
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve data from the form
            // Assuming you have input fields named 'category', 'sop', 'eane', 'loid', and 'item'
            $category = $_POST['category'];
            $sop = $_POST['sop'];
            $eane = $_POST['eane'];
            $location = $_POST['location'];
            $item = $_POST['item'];
            $date_time = $_POST['datetime'];

            // Prepare the update statement
            $update_sql = "UPDATE equipments SET category = ?, sop = ?, eane = ?, loid = ?, item = ?, date_time = ? WHERE eid = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("ssssssi", $category, $sop, $eane, $location, $item, $date_time, $id);

            // Execute the update statement
            if ($stmt->execute()) {
                // Redirect to the page where the update link was clicked
                header("Location: sur.php");
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
            <label for="category">Category:</label>
            <input type="text" class="form-control" name="category" value="<?php echo $row['category']; ?>">
        </div>
        <div class="form-group">
            <label for="sop">Naming in SOP:</label>
            <input type="text" class="form-control" name="sop" value="<?php echo $row['sop']; ?>">
        </div>
        <div class="form-group">
            <label for="eane">Naming in EANE:</label>
            <input type="text" class="form-control" name="eane" value="<?php echo $row['eane']; ?>">
        </div>
        <div class="form-group">
            <label for="item">Item:</label>
            <input type="text" class="form-control" name="item" value="<?php echo $row['item']; ?>">
        </div>
        <div class="form-group">
        <label for="date_time">Date/Time:</label>
        <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($date_time)); ?>">
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
        <input class="btn btn-primary" type="submit" value="Update">
    </form>
</div>
</body>
</html>
