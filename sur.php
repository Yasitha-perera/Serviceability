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
  background:rgb(213, 35, 49);
  z-index: 100;
}
table{
    background-color: rgb(213, 35, 49,0.5) ;
}footer {
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
    <h2>Equipments
</h2>
    <table class="table table-bordered table-sm"> 
    <thead>
      <tr>
      <th style="width: 5%;">ID</th>
          <th>Equipment </th>
          <th>Naming in SOP</th>
          <th>Naming in EANE</th>
          <th>Location</th>
          <th>Item</th>
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
          $sql = "SELECT * FROM equipments WHERE stid = $loggedInUserStid AND cid = 3";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["eid"] . "</td>";
                  echo "<td>" . $row["category"] . "</td>";
                  echo "<td>" . $row["sop"] . "</td>";
                  echo "<td>" . $row["eane"] . "</td>";
                  echo "<td>" . $row["loid"] . "</td>";
                  echo "<td>" . $row["item"] . "</td>";
                  echo "<td>" . $row["date_time"] . "</td>"; echo "<td>";
                  // Update button
                  echo "<a href='sur_update.php?id=" . $row['eid'] . "' class='btn btn-primary btn-sm'>Update</a> ";
                  // Delete button
                  echo "<a href='sur_delete.php?id=" . $row['eid'] . "' class='btn btn-danger btn-sm'>Delete</a>";
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
    <h2>Surveillance</h2>
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
          $sql = "SELECT * FROM machine WHERE stid = $loggedInUserStid AND cid = 3 AND machine_type = 'surveillance'";
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
    <h2>Surveillance Supports
</h2>
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
          $sql = "SELECT * FROM machine WHERE stid = $loggedInUserStid AND cid = 3 AND machine_type = 'surveillance supports'";
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

