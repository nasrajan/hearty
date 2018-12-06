<?php

include 'includes/header.php';
include 'includes/config.php'; // configuration settings, including username and password

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

<script>
    $(document).ready(function(){
        var ddData = [
    {
        text: "Facebook",
        value: 1,
        selected: false,
        description: "Description with Facebook",
        imageSrc: "http://i.imgur.com/XkuTj3B.png"
    },
    {
        text: "Twitter",
        value: 2,
        selected: false,
        description: "Description with Twitter",
        imageSrc: "http://i.imgur.com/8ScLNnk.png"
    },
    {
        text: "LinkedIn",
        value: 3,
        selected: true,
        description: "Description with LinkedIn",
        imageSrc: "http://i.imgur.com/aDNdibj.png"
    },
    {
        text: "Foursquare",
        value: 4,
        selected: false,
        description: "Description with Foursquare",
        imageSrc: "http://i.imgur.com/kFAk2DX.png"
    }
];
$('#myDropdown').ddslick({
    data:ddData,
    width:300,
    selectText: "Select your preferred social network",
    imagePosition:"right",
    onSelected: function(selectedData){
        //callback function: do something with selectedData;
    }   
});
        
        $("span").click(function(){
            var starid = $(this).attr("id");
            for (var i=1; i<=starid;i++) {
                
                $("#"+i).css("content", "\2605");
                $("#"+i).css("position", "absolute");
                $("#"+i).css("color", "orange");
            }
            
            
           
        });
         $("span").hover(function(){
             $(this).prevUntil("div").text("\2605");
             $(this).prevUntil("div").css("position", "absolute");
             $(this).prevUntil("div").css("color", "orange");
           
           
        });
    });
   /*function starsclicked(star) 
   {
       alert(star.id);
       for (int i=1; i<=star.id; i++) {
           pstar = document.getElementById(i);
           pstar.content = "\2605";
           pstar.style.color = 'orange';
       }
   }
   */
</script>    
<section id="three" class="wrapper">
    <div class="inner">
        <header class="align-center">
            <h2>Login</h2>

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
