<?php
$link = mysqli_connect("localhost", "root", "mysql", "CrossWorld");
	//return $conn variable.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$fb_Id = $_POST['fb_Id'];
		$selectquery
		$query = "INSERT INTO web_site_users(username,email,fb_id) VALUES ('".$name."','".$email."','".$fb_Id."')";
		$result = mysqli_query($link , $query) or die(mysqli_error());
		if ($result) {
			
			echo "successful entry";
		}else{
			echo "error";
		}
}else{
	echo "Try again Later";
}
 ?> 