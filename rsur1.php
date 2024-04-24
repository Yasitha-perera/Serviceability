<?php
include 'header.php'; 
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
</head><style>
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
}footer {
  background:rgb(213, 35, 49);
        color: white;
        text-align: center;
        position: fixed;
        left: 0;
        bottom: -15px;
        width: 100%;
    }  body{
        background-color:rgba(12, 81, 138, 0.1); 

    }table{
    background-color: rgb(213, 35, 49,0.5) ;
}
  </style>
<body>
  <div class="container mt-5">
    <h2>Equipments
</h2>
<form method='post' action='save_serviceability.php'> 
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th>ID</th>
            <th>Equipment</th>
            <th>Location</th>
            <th>Serviceability</th>
          </tr>
        </thead>
        <tbody>
        <?php
  include('database.php');
  $loggedInUserStid = $_SESSION['stid'];

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM equipments WHERE stid = $loggedInUserStid AND cid = 3 AND loid='Control Tower'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["eid"] . "</td>";
          echo "<td>" . $row["category"] ."&nbsp;/&nbsp;".$row["sop"] ."&nbsp;/&nbsp;".$row["eane"] ."&nbsp;/&nbsp;".$row["item"] ."</td>";
          echo "<td>" . $row["loid"] . "</td>";
          echo "<td>";
          echo "<input type='hidden' name='mid[]' value='" . $row['eid'] . "'>"; 
          echo "<input type='hidden' name='equipment[]' value='" . $row["category"] ."&nbsp;/&nbsp;".$row["sop"] ."&nbsp;/&nbsp;".$row["eane"] ."&nbsp;/&nbsp;".$row["item"] ."'>"; 
          echo "<input type='hidden' name='loid[]' value='" . $row['loid'] . "'>";
          echo "<input type='hidden' name='cid[]' value='3'>"; 
          echo "<input type='hidden' name='machine_type[]' value='equipments'>"; 
          echo "<input type='hidden' name='stid[]' value='" . $loggedInUserStid . "'>"; // Add stid as hidden input
          echo "<select name='serviceability[]' class='form-control'>";
          echo "<option value='0' selected>Select</option>"; 
          
          $sql_serviceability = "SELECT status FROM serviceability";
          $result_serviceability = $conn->query($sql_serviceability);
          if ($result_serviceability->num_rows > 0) {
              while ($serviceability_row = $result_serviceability->fetch_assoc()) {
                  $status = $serviceability_row['status'];
                  echo "<option value='" . $status . "'>" . $status . "</option>";
              }
          }
          
          echo "</select>";
          echo "</td>";
          echo "</tr>";
      }
  } else {
      echo "<tr><td colspan='4'>No records found</td></tr>";
  }
  $conn->close();
  ?>
        </tbody>
      </table>
      <button type='submit' class='btn btn-primary mt-2' style='float: right; margin-bottom:5vh;'>Save</button>
      </form>
    <h2>Surveillance</h2>
    <form method='post' action='save_serviceability.php'> 
    <table class="table table-bordered table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Equipment</th>
          <th>Location</th>
          <th>Serviceability</th>
        </tr>
      </thead>
      <tbody>
      <?php
include('database.php');
$loggedInUserStid = $_SESSION['stid'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM machine WHERE stid = $loggedInUserStid AND cid = 3 AND machine_type = 'surveillance' AND loid='Control Tower'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["mid"] . "</td>";
        echo "<td>" . $row["equipment"] . "</td>";
        echo "<td>" . $row["loid"] . "</td>";
        echo "<td>";
        echo "<input type='hidden' name='mid[]' value='" . $row['mid'] . "'>"; 
        echo "<input type='hidden' name='equipment[]' value='" . $row['equipment'] . "'>"; 
        echo "<input type='hidden' name='loid[]' value='" . $row['loid'] . "'>";
        echo "<input type='hidden' name='cid[]' value='3'>"; 
        echo "<input type='hidden' name='machine_type[]' value='surveillance'>"; 
        echo "<input type='hidden' name='stid[]' value='" . $loggedInUserStid . "'>"; // Add stid as hidden input
        echo "<select name='serviceability[]' class='form-control'>";
        echo "<option value='0' selected>Select</option>"; 
        
        $sql_serviceability = "SELECT status FROM serviceability";
        $result_serviceability = $conn->query($sql_serviceability);
        if ($result_serviceability->num_rows > 0) {
            while ($serviceability_row = $result_serviceability->fetch_assoc()) {
                $status = $serviceability_row['status'];
                echo "<option value='" . $status . "'>" . $status . "</option>";
            }
        }
        
        echo "</select>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No records found</td></tr>";
}
$conn->close();
?>
      </tbody>
    </table>
    <button type='submit' class='btn btn-primary mt-2' style='float: right;'>Save</button>
    </form><br>
    <h2>Surveillance Supports
</h2>
<form method='post' action='save_serviceability.php'> 
    <table class="table table-bordered table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Equipment</th>
          <th>Location</th>
          <th>Serviceability</th>
        </tr>
      </thead>
      <tbody>
      <?php
include('database.php');
$loggedInUserStid = $_SESSION['stid'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM machine WHERE stid = $loggedInUserStid AND cid = 3 AND machine_type = 'surveillance supports'  AND loid='Control Tower'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["mid"] . "</td>";
        echo "<td>" . $row["equipment"] . "</td>";
        echo "<td>" . $row["loid"] . "</td>";
        echo "<td>";
        echo "<input type='hidden' name='mid[]' value='" . $row['mid'] . "'>"; 
        echo "<input type='hidden' name='equipment[]' value='" . $row['equipment'] . "'>"; 
        echo "<input type='hidden' name='loid[]' value='" . $row['loid'] . "'>";
        echo "<input type='hidden' name='cid[]' value='3'>"; 
        echo "<input type='hidden' name='machine_type[]' value='surveillance supports'>"; 
        echo "<input type='hidden' name='stid[]' value='" . $loggedInUserStid . "'>"; // Add stid as hidden input
        echo "<select name='serviceability[]' class='form-control'>";
        echo "<option value='0' selected>Select</option>"; 
        
        $sql_serviceability = "SELECT status FROM serviceability";
        $result_serviceability = $conn->query($sql_serviceability);
        if ($result_serviceability->num_rows > 0) {
            while ($serviceability_row = $result_serviceability->fetch_assoc()) {
                $status = $serviceability_row['status'];
                echo "<option value='" . $status . "'>" . $status . "</option>";
            }
        }
        
        echo "</select>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No records found</td></tr>";
}
$conn->close();
?>
      </tbody>
    </table>
    <button type='submit' class='btn btn-primary mt-2' style='float: right; margin-bottom:5vh;'>Save</button>
    </form><br>
  </div><footer>
    <p>&copy; Designed And Developed By AASL IT</p>
</footer>
</body>
</html>

