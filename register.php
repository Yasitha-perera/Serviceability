<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviceability Report System</title>           
     <link rel="icon" href="images\SRS_Logo.ico" type="image/x-icon">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
    <style>
        a {
    text-decoration: none; /* Remove underline */
    color: #333; /* Set text color */
    font-size: 24px; /* Set font size */
    font-weight: bold; /* Set font weight */
    /* Add any additional styles you want */
  }

  /* CSS for the paragraph inside the link */
  p {
    margin: 0; /* Remove default paragraph margin */
  } 
  .nav{
  position: fixed;
  top: 0;
  display: flex;
  justify-content: space-around;
  width: 100%;
  height: 100px;
  line-height: 100px;
  background:rgb(13, 42, 158);
  z-index: 100;
}
    </style>
</head>
<body>
    <div class="wrapper">
    <nav class="nav">
            <img src="images\Serviceability Report System_Logo.png" alt="Logo" style="height:100px;" >
            <div class="nav-logo">
            <a  style="text-decoration: none!important;"  href="Home0.php"><p>Serviceability Report System</p></a>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul> 
                    <li><a href="logout.php" class="link">Logout</a></li>
                </ul>
            </div>
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>
    </div>

    <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");
            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>

    <Style>
    body{
        overflow: hidden;
        margin-top: -25vh;
    }
        a {
    text-decoration: none; /* Remove underline */
    color: #333; /* Set text color */
    font-size: 24px; /* Set font size */
    font-weight: bold; /* Set font weight */
    /* Add any additional styles you want */
  }

  /* CSS for the paragraph inside the link */
  p {
    margin: 0; /* Remove default paragraph margin */
  } 
  .nav{
  position: fixed;
  top: 0;
  display: flex;
  justify-content: space-around;
  width: 100%;
  height: 100px;
  line-height: 100px;
  background:rgb(13, 42, 158);
  z-index: 100;
}.wrapper1{
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 110vh;
  background: rgba(13, 42, 158, 0.7);
}
body{
  background: url("images/AA.png");
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
}
  </style>
</head>
<body>
 <div class="wrapper1">
    <nav class="nav">   
        <div class="nav-logo">
            <a  style="text-decoration: none!important;"  href="config.php"><p>Serviceability Report System</p></a>
        </div>
        <div class="nav-button">
            <button class="btn" >Sign Up</button>
        </div>
        
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

<!----------------------------- Form box ----------------------------------->    
    <div class="form-box" style="margin-top: 200px;" >
        
        <!------------------- login form -------------------------->
       
        <div class="login-container" id="login">
        <div class="top">
        <index>Sign Up</index>
    </div>
    <form id="registrationForm" action="register_process.php" method="POST"  onsubmit="return validateForm()">
        <div class="two-forms">
            <div class="input-box">
                <input type="text" id="firstname"name="firstname" class="input-field" placeholder="Firstname">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box" >
            <select name="usertype" id="usertype" class="input-field1">
            <option value="-Select-" selected disabled>User Type</option>

<?php
    // Connect to your database
    include 'database.php';

    // Query to fetch location from the database
    $sql = "SELECT uid, usertype FROM user_type";
    $result = $conn->query($sql);

    // Populate options
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['usertype'] . "'>" . $row['usertype'] . "</option>";
        }
    } else {
        echo "<option value=''>No station available</option>";
    }

    // Close database connection
    $conn->close();
?>
</select>

            </div><div class="input-box">
            <select name="station" id="station" class="input-field2">
        <option value="-Select-" selected disabled >Station</option>

            <?php
                // Connect to your database
                include 'database.php';

                // Query to fetch location from the database
                $sql = "SELECT stid, station FROM stations";
                $result = $conn->query($sql);

                // Populate options
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['stid'] . "'>" . $row['station'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No station available</option>";
                }

                // Close database connection
                $conn->close();
            ?>
        </select>
            </div>
        </div>
        <div class="input-box">
    <input type="email" id="email" name="email" class="input-field" placeholder="Email" oninput="validateEmail(this)">
    <i class="bx bx-envelope"></i>
</div>

        <div class="input-box">
            <input type="password" id="password"name="password" class="input-field" placeholder="Password">
            <i class="bx bx-lock-alt"></i>
        </div>
        <div class="input-box">
            <input type="password" id="repeat-password"name="repeat-password" class="input-field" placeholder="Repeat Password">
            <i class="bx bx-lock-alt"></i>
        </div>
        <div class="input-box">
            <input type="submit" class="submit" value="Register">
        </div>
    </form>
    <div class="two-col">
        <div class="one">
            <input type="checkbox" id="register-check" onclick="togglePassword()">
            <label for="register-check"> Show Password</label>
        </div>
        
    </div>
        </div>

        <!------------------- registration form -------------------------->
        

    </div>
</div>   




<script>

    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }

</script>

</body>
</html>