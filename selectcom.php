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
    <style>
  
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
  
  .button-container {
    text-align: center;
    margin-top: 28vh;
  }
  
  .button {
    display: inline-block;
    padding: 20px 40px;
    font-size: 24px;
    background-color:rgb(12, 81, 138);
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 8px;
    margin: 10px;
    text-decoration: none; /* Remove underline */
    width: 20vw;
  }
  
  .button:hover {
    background-color:rgb(12, 81, 138);
    
  }footer {
    background:rgb(12, 81, 138);
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

<div class="button-container">
  <a style="text-decoration: none;" href="rcom.php" class="button">CACC </a>
  <a style="text-decoration: none;"href="rcom1.php" class="button">Control Tower </a>
</div>
<footer>
    <p>&copy; Designed And Developed By AASL IT</p>
</footer>
</body>

</html>

