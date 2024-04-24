<?php include 'header1.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Database Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom Styles */
        .form-container {
            margin-top: 50px;
        }
        .card-body{
            background-color:rgba(193, 7, 7, 0.3); 
        }
        .card-header{
            background-color:rgba(193, 7, 7, 0.7); 
        }
        footer {
            background:rgb(193, 7, 7);
            color: white;
            text-align: center;
            position: fixed;
            left: 0;
            bottom: -15px;
            width: 100%;
        }
        body{
            background-color:rgba(193, 7, 7, 0.3); 
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            margin-left: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color:rgba(193, 7, 7, 0.7); 
            color: #fff;
        }
        .btn-primary:hover {
            background-color:rgba(193, 7, 7, 0.5); 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center form-container">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header  text-white">
                        Serviceability Report Generate
                    </div>
                    <div class="card-body">
                        <form id="myForm" method="post" action="">
                            <div class="form-group row">
                                <label for="start_datetime" class="col-sm-4 col-form-label">Start Date and Time:</label>
                                <div class="col-sm-8">
                                    <input type="datetime-local" name="start_datetime" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="end_datetime" class="col-sm-4 col-form-label">End Date and Time:</label>
                                <div class="col-sm-8">
                                    <input type="datetime-local" name="end_datetime" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <button type="submit" class="btn btn-primary" onclick="submitForm('pdf.php')">View Report</button>
                                    <button type="submit" class="btn btn-primary" onclick="submitForm('rpt.php')">Download Report</button>
                                <a href="email.php" class="btn btn-primary">Email Report</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; Designed And Developed By AASL IT</p>
    </footer>

    <script>
        function submitForm(action) {
            document.getElementById('myForm').action = action;
            document.getElementById('myForm').submit();
        }
    </script>
</body>
</html>
