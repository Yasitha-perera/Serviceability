<?php
include 'index.php'; 

// Check if usertype is not set or not equal to "admin", redirect to login page
if (!isset($_SESSION['usertype'])) {
    header("Location: Login.php");
    exit(); // Ensure that script execution stops after redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Layout</title>
<style>.nav{
  position: fixed;
  top: 0;
  display: flex;
  justify-content: space-around;
  width: 100%;
  height: 100px;
  line-height: 100px;
  background:rgb(137, 6, 56);
  z-index: 100;
}
.container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-top: 5vh;
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
    
   
    
    .form {
        background-color: rgba(137, 6, 56, 0.5); /* Adjust the alpha value as needed */
    padding: 20px;
    border-radius: 5px;
    

    }
    button[type="submit"] {
        background-color: rgb(137, 6, 56);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 130px;
    }

    button[type="submit"]:hover {
        background-color:rgb(137, 6, 52,0.7);
    }
    input[type="text"],
    select {
        width: calc(100% - 130px); /* Adjust width as needed */
        padding: 5px;
        margin-bottom: 3px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        display: inline-block;
        vertical-align: middle;
    }
    label {
        display: inline-block;
        width: 120px; /* Adjust width as needed */
    }
h2{
    margin-bottom: 5px;
}footer {
    background:rgb(137, 6, 56);
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

<div class="container">
    <div class="left">
        <div class="form-container">
            <h2>None </h2>
            <form class="form" action="form_handler3.php" method="POST">
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
        </select><br><br>
                <!-- Form fields for Form 1 -->
                <label for="field1">Equipment:</label>
                <input type="text" id="field1" name="field1"><br><br>
                
                <!-- Add more fields as needed -->
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <div class="right">
        <div class="form-container">
            <h2>RWY 04   </h2>
            <form class="form" action="form_handler4.php" method="POST">
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
        </select><br><br>                <label for="field3">Equipment:</label>
                <input type="text" id="field3" name="field3"><br><br>
                
                <!-- Add more fields as needed -->
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="form-container">
            <h2>RWY 22</h2>
            <form class="form" action="form_handler5.php" method="POST">
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
        </select><br><br>                <label for="field5">Equipment:</label>
                <input type="text" id="field5" name="field5"><br><br>
           
                <!-- Add more fields as needed -->
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
<footer>
    <p>&copy; Designed And Developed By AASL IT</p>
</footer>
</body>
</html>
