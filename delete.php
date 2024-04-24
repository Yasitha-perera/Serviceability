<?php include 'index1.php'; 

// Check if the 'id' parameter is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect back to the page where the delete link was clicked
    header("Location: home2.php");
    exit();
}

// Include database connection file
include('database.php');

// Retrieve the machine ID from the URL parameter
$mid = $_GET['id'];

// Fetch machine details for confirmation message
$sql = "SELECT * FROM machine WHERE mid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $mid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Close statement
$stmt->close();

// Check if the form is submitted (confirmation is given)
if (isset($_POST['confirm_delete'])) {
    // Prepare and execute DELETE statement
    $sql = "DELETE FROM machine WHERE mid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $mid);

    if ($stmt->execute()) {
        // Check if the session variable containing the last page URL is set
        if(isset($_SESSION['last_page'])) {
            $last_page = $_SESSION['last_page'];
            // Redirect back to the page where the delete link was clicked
            header("Location: $last_page");
            exit();
        } else {
            // If session variable is not set, redirect to a default page
            header("Location: delete.php");
            exit();
        }
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}

// Display confirmation message
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Item</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Delete Item</h2>
    <p>Are you sure you want to delete the following Item?</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Equipment</th>
                <th>Location</th>
                <th>Date/Time</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $row['mid']; ?></td>
                <td><?php echo $row['equipment']; ?></td>
                <td><?php echo $row['loid']; ?></td>
                <td><?php echo $row['date_time']; ?></td>
            </tr>
        </tbody>
    </table>
    <form method="post">
      <button type="submit" class="btn btn-danger" name="confirm_delete">Confirm Delete</button>
      <a href="com.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
