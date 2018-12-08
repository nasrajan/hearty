<?php

//Program to display top5 products in the member websites
// and json encode the result
include_once 'includes/config.php';


$query = "SELECT p.id, p.prod_name, p.prod_description, p.prod_image, SUM(star) as top "
        . "FROM products p, `product_rating` pr "
        . "WHERE p.id = pr.product_id "
        . "GROUP BY product_id "
        . "ORDER BY top DESC LIMIT 5";

$result = mysqli_query($link, $query);

$top5 = array();
$item = array();

while ($row = mysqli_fetch_assoc($result)) {
     $item["product_image"] = urlencode("http://nasrajan.theeram.net/images/".$row['prod_image']);
     $item["product_url"] = urlencode("http://nasrajan.theeram.net/product_details.php?id=".$row['id']);
     $item["product_id"] = $row['id'];
     $item["product_name"] = $row['prod_name'];
     $item["product_description"] = utf8_encode(truncate_text($row['prod_description']));
     $item["rating"] = $row['top'];
     $top5[] = $item;
}

$json = json_encode($top5);



print $json;
function truncate_text($str, $limit=100) {
    if (strlen($str) <= $limit) return $str;
	
	if (false !== ($max = strpos($str, ".", $limit))) {
		 
		if ($max < strlen($str) - 1) {
			
			$str = substr($str, 0, $max) . "...";
			
		}
		
	}

        return $str;
}

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

?>
