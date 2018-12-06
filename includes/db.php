<?php

include_once 'config.php';

$result = mysqli_query($link, "SELECT name from users LIMIT 5");



while ($row = mysqli_fetch_assoc($result) ) {
    $query = "INSERT INTO husers (first_name, last_name, email) VALUES(";
    $name = explode(" ", $row['name']);
    $first_name = $name[0];
    $last_name = $name[1];
    $query.= "'".$first_name."', ";
    $query.= "'".$last_name."', ";
    $query.= "'".strtolower($first_name).".".strtolower($last_name)."@gmail.com"."');";
    print $query;
    print "<br>";
}

?>
