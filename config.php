<?php include 'index2.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Navigation</title>
    <style>
        /* Centering container */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: -15vh;
        }

        /* Style for buttons */
        .btn {
            padding: 5px 20px;
            margin: 10px;
            font-size: 36px;
            cursor: pointer;
            background-color:rgb(13, 42, 158);
            color: white;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #1565c0;
        }
            /* Additional CSS styles */
            body {
            background-color:rgba(13, 42, 158, 0.2); 

        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Button to go to Page 1 -->
        <button class="btn" onclick="goToPage1()">Register</button>
        
        <!-- Button to go to Page 2 -->
        <button class="btn" onclick="goToPage2()">Edit User</button>
    </div>

    <script>
        // Function to navigate to Page 1
        function goToPage1() {
            window.location.href = 'register.php';
        }
        
        // Function to navigate to Page 2
        function goToPage2() {
            window.location.href = 'change_detail.php';
        }
    </script>
</body>
</html>
