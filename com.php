<?php
include 'index1.php'; 
$_SESSION['last_page'] = basename($_SERVER['PHP_SELF']);

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
  <title>Three Tables</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
        /* CSS for the logo image */
        .logo-img {
            width: 100px; /* Adjust width as needed */
            height: auto; /* Maintain aspect ratio */
        }
        
        .nav{
  position: fixed;
  top: 0;
  display: flex;
  justify-content: space-around;
  width: 100%;
  height: 100px;
  line-height: 100px;
  background:rgb(12, 81, 138);
  z-index: 100;
}
table{
    background-color: rgb(12, 81, 138,0.5) ;
}
footer {
    background:rgb(12, 81, 138);
        color: white;
        text-align: center;
        position: fixed;
        left: 0;
        bottom: -15px;
        width: 100%;
    }
    body{
        background-color:rgba(12, 81, 138, 0.1); 

    }
    </style>
</head>
<body>
  <div class="container mt-5">
    <h2>VHF Communication
</h2>
<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th style="width: 20%;" >Equipment</th>
            <th>Transmits</th>
            <th style="width: 10%;" >Status</th>
            <th style="width: 20%;" >Location</th>
            <th>Date/Time</th>
            <th style="width: 20%;">Actions</th> <!-- New column for actions -->
        </tr>
    </thead>
    <tbody>
        <?php
        include('database.php');
        $loggedInUserStid = $_SESSION['stid'];

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM vhf_communication WHERE stid = $loggedInUserStid AND cid = 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["vhfid"] . "</td>";
                echo "<td>" . $row["equipment"] . "</td>";
                echo "<td>" . $row["transmits"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>" . $row["loid"] . "</td>";
                echo "<td>" . $row["date_time"] . "</td>";
                echo "<td>";
                // Update button
                echo "<a href='com_update.php?id=" . $row['vhfid'] . "' class='btn btn-primary btn-sm'>Update</a> ";
                // Delete button
                echo "<a href='com_delete.php?id=" . $row['vhfid'] . "' class='btn btn-danger btn-sm'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>


    <h2>Scanners</h2>
    <table class="table table-bordered table-sm">
      <thead>
      <tr>
      <th>ID</th>
          <th>Equipment </th>
          <th style="width: 20%;">Location</th>
          <th>Date/Time</th>
          <th style="width: 20%;">Actions</th>
        </tr>
      </thead>
      <tbody>
          <?php
         include('database.php');
         $loggedInUserStid = $_SESSION['stid'];

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          $sql = "SELECT * FROM machine WHERE stid = $loggedInUserStid AND cid = 1 AND machine_type = 'scanners'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["mid"] . "</td>";
                  echo "<td>" . $row["equipment"] . "</td>";
                  echo "<td>" . $row["loid"] . "</td>";
                  echo "<td>" . $row["date_time"] . "</td>";
                  echo "<td>";
                  echo "<a href='update.php?id=" . $row["mid"] . "' class='btn btn-primary btn-sm'>Update</a>";
                  echo "&nbsp;";
                  echo "<a href='delete.php?id=" . $row["mid"] . "' class='btn btn-danger btn-sm'>Delete</a>";
                  echo "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='3'>No records found</td></tr>";
          }
          $conn->close();
        ?>
      </tbody>
    </table>

    <h2>Links</h2>
    <table class="table table-bordered table-sm" style="margin-bottom:5vh;" >
      <thead>
      <tr>     
         <th>ID</th>
          <th>Equipment </th>
          <th style="width: 20%;">Location</th>
          <th>Date/Time</th>
          <th style="width: 20%;">Actions</th>
        </tr>
      </thead>
      <tbody>
          <?php
         include('database.php');
         $loggedInUserStid = $_SESSION['stid'];

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          $sql = "SELECT * FROM machine WHERE stid = $loggedInUserStid AND cid = 1 AND machine_type = 'links'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["mid"] . "</td>";
                  echo "<td>" . $row["equipment"] . "</td>";
                  echo "<td>" . $row["loid"] . "</td>";
                  echo "<td>" . $row["date_time"] . "</td>";
                  echo "<td>";
                  echo "<a href='update.php?id=" . $row["mid"] . "' class='btn btn-primary btn-sm'>Update</a>";
                  echo "&nbsp;";
                  echo "<a href='delete.php?id=" . $row["mid"] . "' class='btn btn-danger btn-sm'>Delete</a>";
                  echo "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='3'>No records found</td></tr>";
          }
          $conn->close();
        ?>
      </tbody>
    </table>
  </div>
  <footer>
    <p>&copy; Designed And Developed By AASL IT</p>
</footer>
</body>
</html>

