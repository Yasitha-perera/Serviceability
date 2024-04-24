<?php
include 'index2.php'; 

// Check if usertype is not set or not equal to "admin", redirect to login page
if (!isset($_SESSION['usertype'])) {
    header("Location: Login.php");
    exit(); // Ensure that script execution stops after redirection
}
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Large Button Navigation</title>
<style>
    .button-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        margin-top: 10vh;
        height: 50vh;
        margin-left: 5vw;
    }

    .button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
        width: fit-content;
    }

    .button img {
        width: 40vh; /* Adjust as needed */
        height: 40vh; /* Adjust as needed */
    }

    .no-report-button {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        margin-top: 10vh;
        margin-left: 10vw;
    }

    /* Footer styles */
    footer {
        background:rgb(13, 42, 158);
        color: white;
        text-align: center;
        padding: 3px 0;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    }  body{
        background-color:rgba(13, 42, 158, 0.2); 

    }
</style>
</head>
<body>

<div class="button-container <?php echo (isset($_SESSION["usertype"]) && $_SESSION["usertype"] === "admin") ? '' : 'no-report-button'; ?>">
    <button class="button" onclick="window.location.href='Home.php'"><img src="images\FORMS_02.png" alt="Report Image"></button>
    <?php
    // Check if the user is logged in and their user type is admin
    if(isset($_SESSION["usertype"]) && $_SESSION["usertype"] === "admin") {
        echo '<button class="button" onclick="window.location.href=\'home2.php\'"><img src="images\TABLES_02.png" alt="Report Image"></button>';
    }
    ?>
    <button class="button" onclick="window.location.href='Serviceability.php'">
        <img src="images\SERVICEABILITY.png" alt="Report Image">
    </button>
    <button class="button" onclick="window.location.href='Report.php'">
        <img src="images\REPORTS.png" alt="Report Image">
    </button>
</div>

<footer>
    <p>&copy; Designed And Developed By AASL IT</p>
</footer>

</body>
</html>
