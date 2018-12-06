<?php
session_start();
include_once 'includes/config.php';
if (isset($_GET['logout']) && $_GET['logout'] == true) {
    session_destroy();
    header("Location: login.php");
}
if (!$_SESSION['loggedin']) { // Login validation
        
        header("Location: login.php");
    }
$query ="";

if (isset($_POST['submit'])) {
    
    if (!isset($_POST['email']) || !isset($_POST['first_name']) || !isset($_POST['last_name'])) {
        $error = "Please enter the required fields marked with *";
        
    } else {
        $query = "INSERT INTO husers (first_name, last_name, email, home_address, home_phone, cell_phone) VALUES(";
        $query .= "'".$_POST['first_name']."', ";
        $query .= "'".$_POST['last_name']."', ";
        $query .= "'".$_POST['email']."', ";
        $query .= "'".$_POST['home_address']."', ";
        $query .= "'".$_POST['home_phone']."', ";
        $query .= "'".$_POST['cell_phone']."'";

        $query .= ")";

        mysqli_query($link, $query) or die(mysqli_error($link));
        header("Location: admin.php");
    }

}


include 'includes/header.php';
include_once 'includes/config.php';

$result = mysqli_query($link, "SELECT * FROM husers");
?>

<section id="three" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>List of Users</h2>	
            <div><a href="adduser.php">Add User</a></div>
        </header>
        <div>
            <form id="adduser" method="POST" action="">
                <label for="first_name">First Name *
                <input type="text" name="first_name" placeholder="Enter your first name" required> <br>
                <label for="last_name">Last Name *
                <input type="text" name="last_name" placeholder="Enter your last name" required> <br>
                <label for="email">Email *
                <input type="email" name="email" placeholder="Enter your email address" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email"> 
                <br>
                <label for="home_address">Home Address
                <input type="text" name="home_address" placeholder="Enter your home address">
                <br>
                <label for="home_phone">Home Phone
                <input type="tel" name="home_phone" placeholder="Enter your home phone"> <br>
                <label for="cell_phone">Cell Phone
                <input type="tel" name="cell_phone" placeholder="Enter your cell phone"> <br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
