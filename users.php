<?php
//This page acts like an API for the other partners
//Returns comma separated list of users, when called using CURL
include 'includes/config.php';

//$readlines = file("users.txt");
$result = mysqli_query($link, "SELECT * FROM users");
while ($row = mysqli_fetch_assoc($result)) {
   echo $row['name'].",";
   
}


?>

