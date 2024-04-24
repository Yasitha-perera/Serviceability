<?php
session_start();
include "database.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE (firstname = ? OR email = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['userid'] = $user['id'];
            $_SESSION['usertype'] = $user['usertype'];
            $_SESSION['stid'] = $user['stid'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username_or_email'] = $username_or_email;

            if ($_SESSION['usertype'] == 'admin') {
                header("Location: Home0.php");
                exit();
            } else {
                header("Location: Home0.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid password.";
            header("Location: Login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid username/email.";
        header("Location: Login.php");
        exit();
    }
}

$conn->close();
?>
