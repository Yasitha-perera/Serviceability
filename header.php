<?php
session_start(); // Start the session
if (!isset($_SESSION['usertype'])) {
    header("Location: Login.php");
    exit(); // Ensure that script execution stops after redirection
}
// Function to check if the user is an admin
function isAdmin() {
    return isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'admin';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviceability Report System</title>
    <link rel="icon" href="images\SRS_Logo.ico" type="image/x-icon">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
    <style>
        a {
    text-decoration: none; /* Remove underline */
    color: #333; /* Set text color */
    font-size: 24px; /* Set font size */
    font-weight: bold; /* Set font weight */
    /* Add any additional styles you want */
  }

  /* CSS for the paragraph inside the link */
  p {
    margin: 0; /* Remove default paragraph margin */
  } 
  .nav{
  position: fixed;
  top: 0;
  display: flex;
  justify-content: space-around;
  width: 100%;
  height: 100px;
  line-height: 100px;
  background:rgb(0, 146, 69);
  z-index: 100;
}
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="nav">            
            <img src="images\Serviceability Report System_Logo.png" alt="Logo" style="height:100px;" >

            <div class="nav-logo">
            <a style="text-decoration: none!important; "href="Home0.php"><p>Serviceability Report System</p></a>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul> 
                        <!-- Display this link only if the user is not an admin -->
                        <li><a href="Serviceability.php" class="link">Home</a></li>
                        <!-- Display this link only if the user is not an admin -->
                        <li><a href="selectcom.php" class="link">Communication</a></li>
                        <!-- Display this link only if the user is not an admin -->
                        <li><a href="rnav.php" class="link">Navigation</a></li>
                        <!-- Display this link only if the user is not an admin -->
                        <li><a href="selectsur.php" class="link">Surveillance</a></li>
                        <!-- Display this link only if the user is not an admin -->
                        <li><a href="rid.php" class="link">IT</a></li>
                    
                    <li><a href="logout.php" class="link">Logout</a></li>
                </ul>
            </div>
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>
    </div>

    <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");
            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }
    </script>
</body>
</html>
