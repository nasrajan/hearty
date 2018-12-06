<?php
session_start();
if (isset($_GET['logout']) && $_GET['logout'] == true) {
    session_destroy();
    header("Location: login.php");
}
if (!$_SESSION['loggedin']) { // Login validation
        
        header("Location: login.php");
    }
include 'includes/header.php';
include_once 'includes/config.php';
$query = "SELECT * FROM husers";

/*if (isset($_GET['search']) &&  !empty($_GET['searchby']) && !empty($_GET['searchval'])) {
    $query_part = " WHERE ".$_GET['searchby']." LIKE '%".$_GET['searchval']."%' ";
    $query .= $query_part;
} 
*/

$searchby = "";
if (isset($_GET['search'])) {
    if (!empty($_GET['searchby'])) {
        $query_part = " WHERE ".$_GET['searchby']." LIKE '%".$_GET['searchval']."%' ";
        $query .= $query_part;
    } else {
        $query_part = " WHERE first_name LIKE '%".$_GET['searchval']."%' OR ".
                              "last_name LIKE '%".$_GET['searchval']."%' OR ".
                               "email LIKE '%".$_GET['searchval']."%' OR ".
                               "home_phone LIKE '%".$_GET['searchval']."%' OR ".
                                "cell_phone LIKE '%".$_GET['searchval']."%'"              
                                ;
        $query .= $query_part;
    }
    
    $searchby = $_GET['searchby'];
}



$result = mysqli_query($link, $query);
?>

<section id="three" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>List of Users</h2>	
            <div><a href="adduser.php">Add User</a></div>
        </header>
        <h3>Search Form:</h3>
        <div>
            <form id="search" method="GET" action="">
                <table style="border:1px solid #ff0000;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td> <label for="">Search by:</label></td>
                        <td>
                            <select style="width:150px;" name="searchby" placeholder="Search By">
                                <option value="">Select</option>
                                <option <?php if ($searchby == "first_name") print "selected" ?> value="first_name">First Name</option>
                                <option <?php if ($searchby == "last_name") print "selected" ?> value="last_name">Last Name</option>
                                <option <?php if ($searchby == "email") print "selected" ?> value="email">Email</option>
                                <option <?php if ($searchby == "home_phone") print "selected" ?> value="home_phone">Home Phone</option>
                                <option <?php if ($searchby == "cell_phone") print "selected" ?> value="cell_phone">Cell Phone</option>
                            </select>
                        </td>
                        <td ><input type="text" name="searchval" placeholder="Search here"  style="width:350px;"></td>
                        <td><input type="submit" name="search" value="Search"></td>
                    </tr>
                </table>




            </form>
        </div>
        <table>
            <tr>
                <th>No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Home Address</th>
                <th>Home Phone</th>
                <th>Cell Phone</th>

            </tr>
            <?php $i=1; while ($row = mysqli_fetch_assoc($result)) { ?>     
                <tr>
                    <td><?php print $i++; ?></td>
                    <td><?php echo $row['first_name'] ?></td>
                    <td><?php echo $row['last_name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['home_address'] ?></td>
                    <td><?php echo $row['home_phone'] ?></td>
                    <td><?php echo $row['cell_phone'] ?></td>


                </tr>
            <?php } ?>    
        </table>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
