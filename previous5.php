<?php
session_start();
include 'includes/header.php';
include_once 'includes/config.php';

#$result = mysqli_query($link, "select * from products");

if (!empty($_COOKIE['prev5'])) {
    $previous5 = json_decode($_COOKIE['prev5']);
}

$prevlist = implode(",", $previous5);
$query = "SELECT * FROM products WHERE id in(" . $prevlist . ")";
$result = mysqli_query($link, $query);
?>
<section id="main" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>Hearty Art</h2>
            <p>The one stop place for buying and selling heartfelt arts by amateur artists </p>
        </header>

        <!-- Content -->
        <h2 id="content">Last viewed 5 products</h2>
        <p>Our little world is filled with hues. Hearty arts offer amateur arts in various categories. This includes Paintings Drawings,
            Digital Photography, Handmade Art, Handmade Crafts, Digital Paintings etc</p>
        <div><a href="products.php">See All Products</div>
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
            <!--<div class="6u 12u$(small)">
                    
                    <div class="image fit">
                            <img src="images/pic07.jpg" alt="Pic 01" />
                    </div>
                    <header>
                            <h3>Paintings and Drawings</h3>
                    </header>
            </div>
            <div class="6u$ 12u$(small)">
                    <div class="image fit">
                            <img src="images/pic08.jpg" alt="Pic 02" />
                    </div>
                    <header>
                            <h3>Digital Photos</h3>
                    </header>
            </div> -->
            <!-- Break -->
            <!--<div class="4u 12u$(medium)">
                    <div class="image fit">
                            <img src="images/pic09.jpg" alt="Pic 02" />
                    </div>
                    <header>
                            <h3>Handmade Arts</h3>
                    </header>
            </div>
            <div class="4u 12u$(medium)">
                    <div class="image fit">
                            <img src="images/pic11.jpg" alt="Pic 02" />
                    </div>
                    <header>
                            <h3>Digital Drawings</h3>
                    </header>
            </div>
            <div class="4u$ 12u$(medium)">
                    <div class="image fit">
                            <img src="images/pic12.jpg" alt="Pic 02" />
                    </div>
                    <header>
                            <h3>Handmade Crafts</h3>
                    </header>
            </div>-->
        </div>

        <hr class="major" />

<?php include 'includes/footer.php'; ?>