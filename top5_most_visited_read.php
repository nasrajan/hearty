<?php
//program for market place
//Read the json encoded top 5 products from member websites
//json_decode and process
$url= "http://localhost/top5_mostvisited.php";

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);



    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    


curl_close($ch);
$products = json_decode($data);



foreach ($products as $product) {
    print $product->product_id;
    print " , ";
    print $product->product_name;
    print " , ";
    print $product->product_description;
    print " , ";
    print $product->visits;
    print "<br>";
}

?>
