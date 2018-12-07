<?php
//program for market place
//Read the json encoded top 5 products from member websites
//json_decode and process
$url= "http://milestogo.in/market/auth.php";


$fields = array(
	'username' => urlencode($_POST['username']),
        'password' => urlencode($_POST['password'])
	
);
$fields_string ="";
foreach($fields as $key=>$value) { 
    $fields_string .= $key.'='.$value.'&'; 
    
}
rtrim($fields_string, '&');

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);



    curl_setopt($ch, CURLOPT_URL, $url);
    
    


$data = curl_exec($ch);
curl_close($ch);


if (!empty($data) && $data == "1") {
    
    session_start();
    $_SESSION['loggedin']= true;
    $_SESSION['username'] = $fields['username'];
    header("Location: products.php");
} else {
   header("Location: login.php?error=loginfailed");
    
}



?>
