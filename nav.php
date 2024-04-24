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
    .nav{
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
table{
    background-color: rgb(137, 6, 56,0.5) ;
}
footer {
    background:rgb(137, 6, 56);
        color: white;
        text-align: center;
        position: fixed;
        left: 0;
        bottom: -15px;
        width: 100%;
    }  body{
        background-color:rgba(12, 81, 138, 0.1); 

    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2>None</h2>
    <table class="table table-bordered table-sm">
    <thead>
      <tr>
      <th>ID</th>
          <th>Equipment </th>
          <th>Location</th>
          <th>Date/Time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
          <?php
         include('database.php');
         $loggedInUserStid = $_SESSION['stid'];

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          $sql = "SELECT * FROM machine WHERE stid = $loggedInUserStid AND cid = 2 AND machine_type = 'None'";
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
    <h2>RWY 04
</h2>
    <table class="table table-bordered table-sm">
    <thead>
      <tr>
      <th>ID</th>
          <th>Equipment </th>
          <th>Location</th>
          <th>Date/Time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
          <?php
         include('database.php');
         $loggedInUserStid = $_SESSION['stid'];

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          $sql = "SELECT * FROM machine WHERE stid = $loggedInUserStid AND cid = 2 AND machine_type = 'rwy04'";
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
    <h2>RWY 22
</h2>
<table class="table table-bordered table-sm" style="margin-bottom:5vh;" >
    <thead>
      <tr>
      <th>ID</th>
          <th>Equipment </th>
          <th>Location</th>
          <th>Date/Time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
          <?php
         include('database.php');
         $loggedInUserStid = $_SESSION['stid'];

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          $sql = "SELECT * FROM machine WHERE stid = $loggedInUserStid AND cid = 2 AND machine_type = 'rwy22'";
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

