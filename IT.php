<?php
include 'index.php'; 

// Check if usertype is not set or not equal to "admin", redirect to login page
if (!isset($_SESSION['usertype'])) {
    header("Location: Login.php");
    exit(); // Ensure that script execution stops after redirection
}

    // Connect to your database
    include 'database.php';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $location = $_POST['location'];
        $equipment = $_POST['field1'];
        $stid = isset($_SESSION['stid']) ? $_SESSION['stid'] : ''; // Assuming stid is stored in the session
        $machineType = "item";
        $cid = "4";
        echo $current_time = gmdate('Y-m-d H:i:s'); // Retrieve current time in UTC format

        // Prepare and execute SQL query to insert into the database
        $sql_insert = "INSERT INTO machine (loid, equipment, stid,machine_type,cid,date_time) VALUES ('$location', '$equipment', '$stid','$machineType', '$cid',' $current_time')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "<script type='text/javascript'>
            alert('Data Entered Successfully..');
            window.location.href ='IT.php';
            </script>";        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }

    // Close database connection
    $conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT</title>
    <style>.nav{
  position: fixed;
  top: 0;
  display: flex;
  justify-content: space-around;
  width: 100%;
  height: 100px;
  line-height: 100px;
  background:rgb(255, 121, 4);
  z-index: 100;
}
    .container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    
    .left {
        width: 30%;
        margin-left: 10vw;
    }
    
    .right {
        width: 35%;
        margin-right: 10vw;
    }
    
    .form-container {
        margin-bottom: 20px;
        

    }
    
    .form-container:last-child {
        margin-bottom: 0;
    }
    
    .form {
        background-color: rgba( 255, 121, 4, 0.3); /* Adjust the alpha value as needed */
    padding: 20px;
    border-radius: 5px;

    }
    button[type="submit"] {
        background-color:  rgba( 255, 121, 4);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: rgba( 255, 121, 4,0.7);
    }
    input[type="text"],
    select {
        width: 70%; 
        padding: 5px;
        margin-bottom: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    footer {
        background:rgb(255, 121, 4);
        color: white;
        text-align: center;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    }
    body{
        background-color:rgba(12, 81, 138, 0.1); 

    }
</style>
</head>
<body>
<div class="left">
        <div class="form-container">
            <h2>ITEM </h2>
            <form class="form" method="post">
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
        </select>   <br><br>
                <!-- Form fields for Form 1 -->
                <label for="field1">Equipment:</label>
                <input type="text" id="field1" name="field1"><br><br>
                
                <!-- Add more fields as needed -->
                <button type="submit">Submit</button>
            </form>
        </div>
    </div><footer>
    <p>&copy; Designed And Developed By AASL IT</p>
</footer>
</body>
</html>