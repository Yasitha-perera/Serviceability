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
    <title>Login </title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>

  <Style>
    body{
        overflow: hidden;
        margin-top: -15vh;
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
}
.wrapper1{
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
            <img src="images\Serviceability Report System_Logo.png" alt="Logo" style="height:100px;" >
            <div class="nav-logo">
            <p>Serviceability Report System</p>
            </div>
       
        <div class="nav-button">
            <button class="btn white-btn" >Sign In</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->
       
        <div class="login-container" id="login">
            <div class="top"> <index>Login</index>
            </div>
            <?php 
        // Display error message if present
        if(isset($_SESSION['error'])) { 
        ?>
            <div class="error"><?php echo $_SESSION['error']; ?></div>
        <?php 
            unset($_SESSION['error']); // Clear the error message after displaying
        } 
        ?><br>
        <form action="login_process.php" method="post">
            <div class="input-box">
                <input type="text" name="username_or_email" class="input-field" placeholder="First Name or Email">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Sign In">
            </div>
        </form>
        
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