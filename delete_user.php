<?php
// Database connection
include('database.php');

// Check if user ID is provided in the URL
if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete user from the database
    $delete_sql = "DELETE FROM users WHERE id = '$user_id'";
    if(mysqli_query($conn, $delete_sql)) {
        // User deleted successfully, redirect to user table
        header("Location: change_detail.php");
        exit();
    } else {
        // Error occurred while deleting, handle appropriately
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    // User ID not provided, redirect to user table
    header("Location: change_detail.php");
    exit();
}

// Close connection
mysqli_close($conn);
?>
