<?php

ini_set('display_errors', 1);

$config_username = 'admin';
$config_password = 'test123';

//MYSQL Configuration
$host = "localhost";
$dbname = 'hearty';
$dbuser = 'hearty';
$dbpass = 'test123';

$link = mysqli_connect($host, $dbuser, $dbpass, $dbname) or die(mysqli_connect_error());
mysqli_select_db($link, $dbname);
?>
