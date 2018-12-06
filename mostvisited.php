<?php
session_start();
include 'includes/header.php';
include_once 'includes/config.php';

$mostvisited = (array) json_decode($_COOKIE["mostvisited"]);

arsort($mostvisited);

$keyslist = array();
foreach ($mostvisited as $key => $value) {
    if (strstr($key, "product_") && count($keyslist) < 5) {
        $temp = explode("_", $key);
        $keyslist[] = $temp[1];
    }
}
$product_ids = implode(",", $keyslist);

$result = mysqli_query($link, "select * from products where id in (" . $product_ids . ")");
?>
<section id="main" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>Hearty Art</h2>
            <p>The one stop place for buying and selling heartfelt arts by amateur artists </p>
        </header>

        <!-- Content -->
        <h2 id="content">Most Visited products by you</h2>
        <p>Our little world is filled with hues. Hearty arts offer amateur arts in various categories. This includes Paintings Drawings,
            Digital Photography, Handmade Art, Handmade Crafts, Digital Paintings etc</p>
        <div><a href="products.php">See All products</div>
        <div class="row">

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="6u 12u$(small)">

                    <div class="image fit">
                        <a href="product_details.php?id=<?php print $row['id']; ?>">
                            <img style="border: 4px solid grey;max-width: 25%; height: auto;"  src="images/thumbnails/<?php print $row['prod_image'] ?>" alt="" />
                        </a>
                    </div>

                    <h4><?php print $row['prod_name']; ?></h4>
                    <p><?php print "Visit count: " . $mostvisited["product_" . $row['id']] ?> </p>


                </div>
<?php } ?>

        </div>

        <hr class="major" />

<?php include 'includes/footer.php'; ?>