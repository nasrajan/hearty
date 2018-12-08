<?php
include_once 'includes/config.php';
include 'includes/header.php';

#$product_id = $_GET['id'];
     
   
/*$query = "SELECT p.product_id, p.product_name, p.product_price, s.product_quantity "
        . "FROM products p, `shopping_cart` s "
        . "WHERE s.Shopping_id = 1  and p.product_id = s.product_id";
 * $result = mysqli_query($link, $query);
 * 
 */



/*while ($row = mysqli_fetch_assoc($result)) {
     $item["product_id"] = $row['product_id'];
     $item["product_name"] = $row['product_name'];
     $item["product_price"] = $row['product_price'];
     $item["product_quantity"] = $row['product_quantity'];
     $top5[] = $item;
}
 * 
 */


//print_r($_POST['cart_details']);

if (isset($_POST['cart_details'])) {
    $cart_details = $_POST['cart_details'];
    $cart = json_decode(htmlspecialchars_decode($cart_details));
    var_dump($cart_details);
    var_dump($cart);

    
}
if(isset($_POST['submit']))
{
    
    var_dump($cart_details);
    var_dump($cart);
    $to = 'supriyajain3010@gmail.com';
    $firstname = $_POST["name"];
    $email= $_POST["email"];
    $text= $_POST["address"];
    $phone= $_POST["phone"];

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message ='<table style="width:100%">
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
    
    foreach($cart as $item) {
        $message .= '<tr>';
        $message .=  '<td>'.$item->product_name.'</td>';
        $message .=  '<td>'.$item->product_price.'</td>';
        $message .=  '<td>'.$item->product_quantity.'</td>';
        $message .=  '<td>'.$item->product_price * $item->product_quantity.'</td>';
       
       $message .=   '</tr>';
    }
    $message .= '</table>';

    if (@mail($to, $email, $message, $headers))
    {
        $msg=  'Thank you. Your Order has been sent';
        print $message;
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
        <?php var_dump($cart_details); ?>
        <input type="hidden" name="cart_details" value="<?php print $cart_details; ?>">

        <input class="nsbutton" type="submit" name="submit"  value="Submit">
  </form>
        <a href="products.php" class="nsbutton">Continue Shopping</a>

        </div>

        <hr class="major" />

<?php include 'includes/footer.php'; ?>