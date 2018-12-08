<?php
include_once 'includes/config.php';
include 'includes/header.php';

if (isset($_GET['id'])) {
    $cart_id = $_GET['id'];
}
if (isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];
}  

$cart_id = 3;
   
$query = "SELECT p.id, p.prod_name, p.prod_price, s.quantity FROM products p, `shopping_cart` s WHERE p.id = s.product_id AND s.cart_id=".$cart_id;
//print $query;
  $result = mysqli_query($link, $query);
  
 


if (!empty($result)) {
    
    while ($row = mysqli_fetch_assoc($result)) {
         $item["product_id"] = $row['id'];
         $item["product_name"] = $row['prod_name'];
         $item["product_price"] = $row['prod_price'];
         $item["product_quantity"] = $row['quantity'];
         $top5[] = $item;
    }
    
    $messagestr = "";
    $messagestr .= '<table>';
    $messagestr .= '<tr>'
               . '<th>Item</price>'
            . '<th>Price</th>'
            . '<th>Quantity</th>'
            . '<th>Total</th>'
            . '</tr>';
    foreach($top5 as $item) {
        $messagestr .= '<tr>';
        $messagestr .=  '<td>'.$item['product_name'].'</td>';
        $messagestr .=  '<td>'.$item['product_price'].'</td>';
        $messagestr .=  '<td>'.$item['quantity'].'</td>';
        $messagestr .=  '<td>'.$item['product_price'] * $item['product_quantity'].'</td>';
       
       $messagestr .=   '</tr>';
    }
    $messagestr .= '</table>';
}else {
    $messagestr = "No products found";
}
  
 
    
    
    
if(isset($_POST['submit']))
{
    
    
    $to = 'supriyajain3010@gmail.com';
    $firstname = $_POST["name"];
    $email= $_POST["email"];
    $text= $_POST["address"];
    $phone= $_POST["phone"];

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message .='<table style="width:100%">
        <tr>
            <td>'.$firstname.'</td>
        </tr>
        <tr><td>Email: '.$email.'</td></tr>
        <tr><td>phone: '.$phone.'</td></tr>
        <tr><td>Address: '.$text.'</td></tr>
    </table>';
    $message .= '<table style="width:100%">';
    $message .= '<tr>'
               . '<th>Item</price>'
            . '<th>Price</th>'
            . '<th>Quantity</th>'
            . '<th>Total</th>'
            . '</tr>';
    
    $message = $messagestr;
    $message .= '</table>';
    
    
    print $message;

    if (mail($to, $email, $message, $headers))
    {
        $msg=  'Thank you. Your Order has been sent';
       # header("Location: products.php?$msg");
        
    }else{
        echo 'failed';
    }
}


?>



 
    
<section id="main" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>Hearty Art</h2>
            <p>The one stop place for buying and selling heartfelt arts by amateur artists </p>
        </header>

        <!-- Content -->
        <h2 id="content">Checkout</h2>
        
        <h3>Shipping Address</h3>
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="fname">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter Your Name..">

        <label for="lname">Address</label>
        <input type="text" id="add" name="address" placeholder="Enter Your Address..">

        <label for="lname">Phone Number</label>
        <input type="text" id="phone" name="phone" placeholder="Enter Your Phone Number..">


        <label for="lname">Email</label>
        <input type="text" id="email" name="email" placeholder="Enter Your Email..">
        
        <input type="hidden" name="cart_id" value="<?php print $cart_id; ?>"/>
        <input class="nsbutton" type="submit" name="submit"  value="Submit">
  </form>
        
        <a href="products.php" class="nsbutton">Continue Shopping</a>

        </div>

        <hr class="major" />

<?php include 'includes/footer.php'; ?>