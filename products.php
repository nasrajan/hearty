<?php
session_start();
include 'includes/header.php';
include_once 'includes/config.php';


if (!empty($_GET)){
    if ($_GET['type'] == "mostvisited") {
        $query = "SELECT p.id, p.prod_name, p.prod_description,p.prod_image, number_visits "
        . "FROM products p, `product_visits` pv "
        . "WHERE p.id = pv.product_id "
        . "ORDER BY number_visits DESC LIMIT 5";
    } 
    if ($_GET['type'] == "mostpopular") {
       $query = "SELECT p.id, p.prod_name, p.prod_description, p.prod_image, SUM(star) as top "
        . "FROM products p, `product_rating` pr "
        . "WHERE p.id = pr.product_id "
        . "GROUP BY product_id "
        . "ORDER BY top DESC LIMIT 5";
        
       
    }
} else {
    $query = "select * from products";
}

$result = mysqli_query($link, $query);

?>
<section id="main" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>Hearty Art</h2>
            <p>The one stop place for buying and selling heartfelt arts by amateur artists </p>
        </header>

        <!-- Content -->
        <h2 id="content">Products</h2>
        <a href="products.php?type=mostvisited" class="nsbutton">Top 5 Most visited products</a>
        <a href="products.php?type=mostpopular" class="nsbutton">Top 5 Most popular products</a>
        <a href="products.php" class="nsbutton">All products</a>
        <p>Our little world is filled with hues. Hearty arts offer amateur arts in various categories. This includes Paintings Drawings,
            Digital Photography, Handmade Art, Handmade Crafts, Digital Paintings etc</p>
        <div><a href="previous5.php">See last 5 previously visited products</div>
        <div><a href="mostvisited.php">See the 5 products most visited by you</div>
        <div class="row">

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="6u 12u$(small)">

                    <div class="image fit">
                        <a href="product_details.php?id=<?php print $row['id']; ?>">
                            <img style="border: 4px solid grey;max-width: 25%; height: auto;"  src="images/thumbnails/<?php print $row['prod_image'] ?>" alt="" />
                        </a>
                    </div>

                    <h4><?php print $row['prod_name']; ?></h4>
                    
                </div>
<?php } ?>

        </div>

        <hr class="major" />

<?php include 'includes/footer.php'; ?>