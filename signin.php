<?php
session_start();
$_SESSION['login_user']= $username; 
echo $_SESSION['login_user']; 
$msg = '';

if (isset($_POST['submit']) && !empty($_POST['username']) 
   && !empty($_POST['password']))
{
    
    $link = mysqli_connect("localhost:3306", "softwby8", "Meh2Fere@1", "softwby8_newdb");
    //$link = mysqli_connect("localhost", "root", "mysql", "CrossWorld");
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "SELECT * FROM web_site_users where username ='". $username. "'";
    $result = mysqli_query($link, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_row($result);
        $password =$row[4];
        $msg = "$password";
        if($_POST["password"] == $password)
          header("location: ./market/index.php");
    }
    else
        $msg = "Invalid Credentials...Please try again...!";       
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form" action="">
                        <h2 class="form-title">Sign In</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" id="username" placeholder="Username"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
           
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign in"/>
                            </a>
                        </div>
                    </form>
                    <?php if(isset($msg))echo $msg;?>
                    <p class="loginhere">
                        Don't Have an Account? <a href="index.php" class="loginhere-link">Sign Up</a>
                    </p>
                </div>
            </div>
        </section>

    </div>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>




