<?php

session_start();


include_once 'includes/config.php';

if (isset($_POST)) {
    
    $products = json_decode(html_entity_decode($_POST['cart_details']));
    
    $query = "SELECT MAX(cart_id) FROM shopping_cart";
    $result = mysqli_query($link, $query);
    
    if ($row = mysqli_fetch_row($result)) {
        $cart_id = $row[0] + 1;
    } else {
        $cart_id = 1;
    }
    foreach ($products as $product) {
        $str = "'".$cart_id."','".$product->product_id."','".$product->quantity."','".$_SESSION['username']."'";
         
         $query = "INSERT INTO shopping_cart (cart_id, product_id, quantity, username) VALUES(".$str.")";
         
         mysqli_query($link, $query);
    }
    
    header("Location: cart_checkout.php?id=$cart_id");
}


?>
