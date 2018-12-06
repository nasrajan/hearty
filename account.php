<?php
session_start();
if (isset($_GET['logout']) && $_GET['logout'] == true) {
    session_destroy();
    header("Location: login.php");
}
include 'includes/header.php';

$readlines = file("users.txt");
?>

<section id="three" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>List of Users</h2>	
            <div><a href="allusers.php">Click here to see all users from Market Place</a></div>
        </header>
        <table>
            <tr>
                <th>Name</th>

            </tr>
            <?php foreach ($readlines as $name) { ?>     
                <tr>
                    <td><?php echo $name ?></td>

                </tr>
            <?php } ?>    
        </table>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
