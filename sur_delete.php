<?php
include 'index1.php'; // Include session management file if needed

// Check if the 'id' parameter is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect back to the page where the delete link was clicked
    header("Location: sur.php");
    exit();
}

// Include database connection file
include('database.php');

// Retrieve the equipment ID from the URL parameter
$id = $_GET['id'];

// Check if the form is submitted (confirmation is given)
if (isset($_POST['confirm_delete'])) {
    // Prepare and execute DELETE statement
    $sql = "DELETE FROM equipments WHERE eid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect to the page where the delete link was clicked
        header("Location: sur.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}

// Fetch record details for confirmation message
$sql = "SELECT * FROM equipments WHERE eid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Close statement
$stmt->close();

// Display confirmation message
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Record</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Delete Record</h2>
    <p>Are you sure you want to delete the following record?</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Equipment</th>
                <th>Naming in SOP</th>
                <th>Naming in EANE</th>
                <th>Location</th>
                <th>Item</th>
                <th>Date/Time</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $row['eid']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['sop']; ?></td>
                <td><?php echo $row['eane']; ?></td>
                <td><?php echo $row['loid']; ?></td>
                <td><?php echo $row['item']; ?></td>
                <td><?php echo $row['date_time']; ?></td>
            </tr>
        </tbody>
    </table>
    <form method="post">
      <button type="submit" class="btn btn-danger" name="confirm_delete">Confirm Delete</button>
      <a href="sur.php" class="btn btn-secondary">Cancel</a> <!-- Redirect back to sur.php on cancel -->
    </form>
  </div>
</body>
</html>
