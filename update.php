
<?php
include 'index1.php';

// Check if usertype is not set or not equal to "admin", redirect to login page
if (!isset($_SESSION['usertype'])) {
    header("Location: Login.php");
    exit(); // Ensure that script execution stops after redirection
}

// Check if the 'id' parameter is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect back to the page where the update link was clicked
    header("Location: home2.php");
    exit();
}

// Retrieve the machine ID from the URL parameter
$mid = $_GET['id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    // Assuming your form fields are named 'equipment', 'location', 'date_time'

    // Sanitize and validate input data
    $equipment = $_POST['equipment'];
    $location = $_POST['location'];
    $date_time = $_POST['date_time'];

    // Perform database update
    include('database.php');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare update statement
    $sql = "UPDATE machine SET equipment = '$equipment', loid = '$location', date_time = '$date_time' WHERE mid = $mid";

    if ($conn->query($sql) === TRUE) {
        // Check if the session variable containing the last page URL is set
        if(isset($_SESSION['last_page'])) {
            $last_page = $_SESSION['last_page'];
            // Redirect back to the page where the update link was clicked
            header("Location: $last_page");
            exit();
        } else {
            // If session variable is not set, redirect to a default page
            header("Location: default_page.php");
            exit();
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    // Fetch the machine details from the database to pre-populate the form
    include('database.php');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch machine details
    $sql = "SELECT * FROM machine WHERE mid = $mid";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Fetch machine details
        $row = $result->fetch_assoc();
        $equipment = $row['equipment'];
        $location = $row['loid'];
        $date_time = $row['date_time'];
    } else {
        echo "Machine not found.";
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Machine</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Update Machine</h2>
    <form method="post">
      <div class="form-group">
        <label for="equipment">Equipment:</label>
        <input type="text" class="form-control" id="equipment" name="equipment" value="<?php echo $equipment; ?>">
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
      <div class="form-group">
        <label for="date_time">Date/Time:</label>
        <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($date_time)); ?>">
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</body>
</html>
