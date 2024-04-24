<?php include 'header2.php';

include('database.php');

// Check if user ID is provided in the URL
if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user details based on user ID
    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        // User found, fetch user data
        $user_data = mysqli_fetch_assoc($result);
    } else {
        // User not found, redirect to user table
        header("Location: user_table.php");
        exit();
    }
} else {
    // User ID not provided, redirect to user table
    header("Location: user_table.php");
    exit();
}

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $usertype = $_POST['usertype'];
    $new_password = $_POST['new_password'];

    // Update user details in the database
    $update_sql = "UPDATE users SET firstname='$firstname', email='$email', usertype='$usertype'";

    // Check if new password is provided and update password if so
    if (!empty($new_password)) {
        // Hash the new password before storing it in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql .= ", password='$hashed_password'";
    }

    $update_sql .= " WHERE id='$user_id'";

    if(mysqli_query($conn, $update_sql)) {
        // Redirect to user table after successful update
        header("Location: change_detail.php");
        exit();
    } else {
        // Error occurred while updating, handle appropriately
        $error_message = "Error updating user: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Additional CSS styles */
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-primary, .btn-secondary {
            color: #fff;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover, .btn-secondary:hover {
            filter: brightness(90%);
        }
        body {
            padding-top: 20px;
            background-color:rgba(13, 42, 158, 0.2); 

        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit User</h2>
    <?php if(isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user_data['firstname']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_data['email']; ?>">
        </div>
        <div class="form-group">
            <label for="usertype">User Type:</label>
            <input type="text" class="form-control" id="usertype" name="usertype" value="<?php echo $user_data['usertype']; ?>">
        </div>
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="change_detail.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
