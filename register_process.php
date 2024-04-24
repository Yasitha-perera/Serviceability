<?php
// Connect to MySQL database
include "database.php";


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$firstname = $_POST['firstname'];
$email = $_POST['email'];
$password = $_POST['password']; // Note: In a real-world scenario, you should hash the password before storing it in the database
$station = $_POST["station"];
$usertype = $_POST["usertype"];

// Insert data into database
$sql = "INSERT INTO users (firstname, email, password,stid,usertype) VALUES ('$firstname', '$email', '$password','$station','$usertype')";

if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>
    alert('User Created Successfully..');
    window.location.href ='register.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>