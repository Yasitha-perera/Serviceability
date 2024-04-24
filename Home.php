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
<title>Large Button Navigation</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .button-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        margin-top: 10vh;
        height: 50vh;
        margin-left: 6vw;


    }
    .button {
        background-color: transparent;
    border: none;
    cursor: pointer;
    width: fit-content;
}

.button img {
    width: 35vh; /* Adjust as needed */
    height: 35vh; /* Adjust as needed */
}

footer {
    background:rgb( 0, 113, 188);
        color: white;
        text-align: center;
        padding: 3px 0;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    }
    body{
        background-color:rgba(13, 42, 158, 0.3); 

    }

</style>
</head>
<body>

<div class="button-container">
    
    <button class="button" onclick="window.location.href='Communication.php'"><img src="images\COMMINICATION.png" alt="Report Image"></button>
    <button class="button" onclick="window.location.href='Navigation.php'"><img src="images\NAVIGATION.png" alt="Report Image"></button>
    <button class="button" onclick="window.location.href='Surveillance.php'"><img src="images\SURVEILLANCE.png" alt="Report Image"></button>
    <button class="button" onclick="window.location.href='IT.php'"><img src="images\INFORMATION.png" alt="Report Image"></button>
</div>
<footer>
    <p>&copy; Designed And Developed By AASL IT</p>
</footer>
</body>
</html>
