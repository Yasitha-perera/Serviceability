<?php include 'header2.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Table</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Additional CSS styles */
        body {
            padding-top: 20px;
            background-color:rgba(13, 42, 158, 0.2); 

        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid darkgrey;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #343a40; /* Dark gray background color for table header cells */
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Table</h2>
    <div class="table-responsive">
        <table class="table table-striped ">
            <thead class="thead-dark">
                <tr>
                    <th style="width:10%;">Station ID</th>
                    <th style="width:20%;">Name</th>
                    <th style="width:20%;">Email</th>
                    <th style="width:10%;">User Type</th>
                    <th style="width:10%;">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                include('database.php');
                $loggedInUserStid = $_SESSION['stid'];

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // SQL query to fetch users
                $sql = "SELECT * FROM users WHERE stid = $loggedInUserStid";
                $result = mysqli_query($conn, $sql);

                // Check if there are any users
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["stid"] . "</td>";
                        echo "<td>" . $row["firstname"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["usertype"] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_user.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Edit</a>";
                        echo " <a href='delete_user.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found</td></tr>";
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
