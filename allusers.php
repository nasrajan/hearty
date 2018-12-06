<?php
session_start();
if (isset($_GET['logout']) && $_GET['logout'] == true) {
    session_destroy();
    header("Location: login.php");
}
include 'includes/header.php';
include 'includes/config.php';

$websites = array();
$websites[0]['url'] = "http://nasrajan.theeram.net/users.php";
$websites[0]['sep'] = ",";
$websites[1]['url'] = "http://mrunaliskhandat.com/website/users.php";
$websites[1]['sep'] = ", ";
$websites[2]['url'] = "http://softwaredevelopmenthome.com/myusers.php";
$websites[2]['sep'] = ",";


$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

for ($i=0; $i < count($websites); $i++) {
    curl_setopt($ch, CURLOPT_URL, $websites[$i]['url']);
    $data = curl_exec($ch);
    $websites[$i]['data'] = explode($websites[$i]['sep'], $data);
}

curl_close($ch);


#$users = explode(",", $data);
?>

<section id="three" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>List of Users from Partner Network</h2>	

        </header>
        <?php foreach ($websites as $website) { 
                  $url = parse_url($website['url']);
                ?> 
        <table>
            <tr>
                <th>Users from <?php print $url['host']; ?></th>
            </tr>
            <tr>
                <table>
                    <tr>
                        <th>Name</th>
                    </tr>
                    <?php foreach ($website['data'] as $name) { ?>     
                    <tr>
                        <td><?php echo $name ?></td>
                    </tr>
                    <?php } ?>   
                </table>
            </tr>
             
        </table>
        <?php } ?>
              
       

    </div>
</section>

<?php include 'includes/footer.php'; ?>
