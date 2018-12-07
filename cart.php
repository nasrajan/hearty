<?php
session_start();
    

if(!isset($_SESSION['loggedin'])) {
    print "<h4>You need to login before adding products to cart. Redirecting to Login page in a moment... or click <a href='login.php'>here</a> to go to "
    . "login page straightaway</h4>";
    print '<meta http-equiv="refresh" content="3;url=login.php">';
    exit;

}

if (isset($_GET) && isset($_GET['ac']) && $_GET['ac'] == "delete") {
    unset($_SESSION['products'][$_GET['id']]);
    $_SESSION["products"] = array_values($_SESSION["products"]);

  // header("Location: cart.php");
   
}
include 'includes/header.php';
include_once 'includes/config.php';

##$result = mysqli_query($link, "select * from products");


if (isset($_POST)) {
    
   $array = array();
   $array['product_id'] = $_POST['product_id'];
   $array['product_image'] = $_POST['product_image'];
   $array['product_name'] = $_POST['product_name'];
   if(isset($_SESSION['products'])) {
       
      # $_SESSION['products'][] = $array;
   } else {
       $_SESSION['products'] = array();
      # $_SESSION['products'][] = $array;
   }
   $inflag = false;
   foreach ($_SESSION['products'] as $key=> $prds) {
       if (in_array($_POST['product_id'], $prds)) {
             $prds['quantity'] += 1;
             $inflag = true;
             $_SESSION['products'][$key] = $prds;
             break;
        } 
        
        
   }
   
   if ($inflag == false) {
       $array['quantity']= 1;
       $_SESSION['products'][] = $array;
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
        <h2 id="content">Shopping Cart</h2>
        <table>
        <?php foreach ($_SESSION['products'] as $product) { ?>    
            <tr>
                <td><img src="images/<?php print $product['product_image']; ?>" width="50" height="50"/></td>
                <td><?php print $product['product_name']; ?>
                    <br>
                    <a class="deletebutton" id="<?php print $product['product_id']; ?>" href="cart.php?ac=delete&id=<?php print $product['product_id']; ?>">Delete</a> | <a id="update" href="#">Update Quantity</a>
                </td>
                 <td><select name="quantity">
                        <?php for ($i=1; $i<=$product['quantity']; $i++){ ?> 
                         <option value="<?php print $i; ?>" selected><?php print $i; ?></option>
                        <?php } ?>
                    </select>
                 </td>
            </tr>
        <?php } ?>   
        </table>
        <a href="products.php" class="nsbutton">Continue Shopping</a>

        </div>

        <hr class="major" />

<?php include 'includes/footer.php'; ?>