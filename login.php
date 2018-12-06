<?php

include 'includes/header.php';
include 'includes/config.php'; // configuration settings, including username and password

if (isset($_POST)) {
    if (isset($_POST['username']) && $_POST['username'] == $config_username && $_POST['password'] == $config_password) { // Login validation
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $_POST['username'];
       

        header("Location: admin.php");
    } elseif ((isset ($_POST['username']) && $_POST['username'] != $config_username)  ||(isset($_POST['password']) && $_POST['password'] != $config_password))  {
        //Login validation. If wrong username / password, display error
        $error = "The username or password you entered is incorrect.";
    }
}
?>


<section id="three" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>Login</h2>

        </header>
        <form action="login.php" method="POST" name="loginForm">
            <label class="error"><?php echo $error; ?></label>
            Username: &nbsp; <input type="text" name="username" required width="50"><br>
            Password: &nbsp;<input type="password" name="password" required><br>
            <input type="submit" name="submit"><br>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
