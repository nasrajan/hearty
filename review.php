<?php

session_start();
include 'includes/header.php';
include 'includes/config.php'; // configuration settings, including username and password



if(!isset($_SESSION['loggedin'])) {
    print "<h4>You need to login before adding Review. Redirecting to Login page in a moment... or click <a href='login.php'>here</a> to go to "
    . "login page straightaway</h4>";
    print '<meta http-equiv="refresh" content="3;url=login.php">';
    exit;

}
if (!empty($_GET)) {
    
    //$product_id = $_GET['product_id'];
    $product_id = filter_input(INPUT_GET, "product_id");
    
} 

if (!isset($product_id)) {
    header("Location: products.php");
}

if (!empty($_POST)) {
    //form has been submitted
    $post_values  = filter_input_array(INPUT_POST);
    $product_id = $post_values['product_id'];
     $rating = $post_values['rating'];
     $review = $post_values['review'];
     
     $str = "'0', '".$product_id."' ,'".$rating."','".$review."'";
     $query = "INSERT INTO product_rating (user_id, product_id, star, review) VALUES(".$str.");";
     mysqli_query($link, $query);
     header("Location: product_details.php?id=".$product_id);
}

?>

  
<section id="three" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>Product Review</h2>

        </header>
        <form action="review.php" method="POST" name="loginForm">
            <input type="hidden" name="product_id" value="<?php print $product_id; ?>"/>    
            <h4>How Many stars for this product? </h4>
            <div id="myDropdown"></div>
            <select name="rating">
                <option value="1">1</option>
                 <option value="2">2</option>
                  <option value="3">3</option>
                   <option value="4">4</option>
                    <option value="5" selected>5</option>
            </select>

          <!-- <div class="rating">
                
                <?php for ($i = 1; $i <= 5; $i++) { ?>

                                   

                    <span id="<?php echo $i; ?>">&#9734;</span>  
                 <?php } ?>  
                </div>   -->                 
                                <br/>
                                <br/>
                                <label>Write your review:</label> 
                                
                                <textarea name="review" rows="4" cols="50"></textarea>  <br/>
                                <input type="submit" value="Submit">
                         
        </form>
    
</section>

<?php include 'includes/footer.php'; ?>
