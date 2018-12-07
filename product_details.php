<?php
session_start();
include 'includes/header.php';
include_once 'includes/config.php';



if (isset($_GET['id'])) {
    $prod_id = $_GET['id']; // TODO: sanitize input. outside the scope of lab for now.
}


// -- Start cookie tracking for the visited product.
if (!isset($_COOKIE['prev5'])) { // check if cookie is there for tracking previous 5 visits
    $prev5 = array();           // If no, initialize and push the current product id to array
    $prev5[] = $prod_id;
} else {

    $prev5 = json_decode($_COOKIE["prev5"]); // if cookie is already there in browser, decode it

    if (array_search($prod_id, $prev5) === false) { // if the current product is already there in the visited list, there is nothing to do.
        $prev5[] = $prod_id;                       // Else, add the product id to the cookie.
        if (count($prev5) > 5) {
            array_shift($prev5);
        }
    }
}

setcookie("prev5", json_encode($prev5), time() + (30 * 24 * 60 * 60)); // since its an array to be stored in cookies, json_encode and store
//-- End cookie tracking for the visited product.
// Start cookie tracking for most visited product by the user
// For this,  an associative array is saved in cookies with product id as key and visit count as value
if (!isset($_COOKIE['mostvisited'])) { // if cookie is not already there in browser, initialize.
    $mostvisited = array();
    $mostvisited["product_" . $prod_id] = 1; // set visit count = 1 for that particular product is.
} else {
    $mostvisited = (array) json_decode($_COOKIE["mostvisited"]);

    if (array_key_exists("product_" . $prod_id, $mostvisited) === false) { // if no count for current product, initialize to 1.
        $mostvisited["product_" . $prod_id] = 1;
    } else { // if the current product was visited before, just increment the visit count by 1.
        $mostvisited["product_" . $prod_id] = $mostvisited["product_" . $prod_id] + 1;
    }
}

setcookie("mostvisited", json_encode($mostvisited), time() + (30 * 24 * 60 * 60));

$result = mysqli_query($link, "select * from products where id='" . $prod_id . "'");
$ratingsresult = mysqli_query($link, "SELECT * FROM product_rating WHERE product_id='".$prod_id."'");

$avgresult = mysqli_query($link, "SELECT AVG(star) as  avg FROM product_rating WHERE product_id='".$prod_id."' GROUP BY product_id");
$avgrow = mysqli_fetch_row($avgresult);

// For easiness, I inserted all product id's in product_visits in advance, with number_visits=0
mysqli_query($link, "UPDATE product_visits SET number_visits = number_visits + 1 WHERE product_id='".$prod_id."'");

?>

<section id="main" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>Hearty Arts</h2>
            <p>The one stop place for buying and selling heartfelt arts by amateur artists </p>
        </header>

        <!-- Content -->
        <h2 id="content">Product details</h2>
        <p>Our little world is filled with hues. Hearty arts offer amateur arts in various categories. This includes Paintings Drawings,
            Digital Photography, Handmade Art, Handmade Crafts, Digital Paintings etc</p>

        <div class="row">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="6u 12u$(small)">

                    <div class="image fit">

                        <img src="images/<?php print $row['prod_image'] ?>" alt="" />

                    </div>

                    <h4><?php print $row['prod_name']; ?></h4>
                    <p><?php print $row['category']; ?></p>
                    <p>Price: $<?php print $row['prod_price']; ?>.00</p>
                    <form name="cart" method="post" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php print $row['id']; ?>">
                        <input type="hidden" name="product_image" value="<?php print $row['prod_image']; ?>">
                        <input type="hidden" name="product_name" value="<?php print $row['prod_name']; ?>">
                       
                      <button id="cart" class="nsbutton">Add to Cart</button>
                    </form>
                    <div class="rating">
                        <a href="#ratingsform">
                            <?php for ($i = 1; $i <= $avgrow[0]; $i++) { ?>

                                <span  class="ratingsdone">&#x2B50;</span>

                            <?php } ?> 
                           <?php for ($i = 5; $i > $avgrow[0]; $i--) { ?>

                                <span  class="ratingsdone" style="font-size:20px; color:orange;">&#x2606;</span>

                            <?php } 
                             print round($avgrow[0],2)." out of 5";
                            ?>      
                                
                        </a>

                    </div>
                    <p><?php print $row['prod_description']; ?></p>

                </div>
<?php } ?>

        </div>
        <a name="ratingsform"
        <a href="review.php?product_id=<?php print $prod_id; ?>" class="nsbutton">Review this product</a>
            
        <h2>Customer Reviews</h2>      
        <div class="ratingdone">
              
            <?php  while($ratingsrow = mysqli_fetch_assoc($ratingsresult)) { 
                        
                        for ($i=1; $i<= $ratingsrow['star']; $i++) {
                ?>
                            <span>&#x2B50;</span>
                        <?php } ?>
                        <?php for ($i = 5; $i > $ratingsrow['star']; $i--) { ?>

                                <span  class="ratingsdone" style="font-size:20px; color:orange;">&#x2606;</span>

                            <?php } 
                            print $ratingsrow['star']." out of 5";
                            ?>
                                
                            <br/>
                            <p>
                                <?php print $ratingsrow['review']; ?>
                            </p>   
            <?php  } ?>
        </div>   
        </div>

        <hr class="major" />

<?php include 'includes/footer.php'; ?>
