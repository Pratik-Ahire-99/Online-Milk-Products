<?php

include 'con_pg.php';

if(isset($_POST['add_to_cart'])){

   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_img = $_POST['p_img'];
   $p_quantity = 1;

   $select_cart = pg_query($con, "SELECT * FROM cart WHERE p_name = '$p_name'");

   if(pg_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = pg_query($con, "INSERT INTO cart(p_name, p_price, p_img, p_quantity) VALUES('$p_name', '$p_price', '$p_img', '$p_quantity')");
      $message[] = 'product added to cart succesfully';
   }

}

?>
<!doctype html>
<html>
<head>
    <title>Dairy Products</title>
<link type="text/css" rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
if(isset($message))
{
   
  foreach($message as $message)
  {
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;">&times</i> </div>';
  };
};
    ?>
    <?php //include 'header_new.php'?>
<ul>
    
<li><a href="dairy_product.php">Dairy Products</a></li>
<li><a href="logout.php" >Profile Logout </a></li>

<?php
$select_rows= pg_query($con,"SELECT * FROM cart") or die("query faild");
$row_count= pg_num_rows($select_rows);
?>
<li><a href="cart.php" >Cart ( <span><?php echo $row_count;?></span> )</a></li>
<label>Online Milk/Dairy Products</label>
<!-- <h2><?php //echo $_SESSION['u_name'];?></h2> -->
</ul>
   <div class="box7">
        <?php
      
      $select_products = pg_query($con, "SELECT * FROM products");
      if(pg_num_rows($select_products) > 0){
         while($fetch_product = pg_fetch_assoc($select_products))
         {
             $fetch_product[2]= pg_fetch_result($select_products, 'p_img');
             $img= pg_unescape_bytea($fetch_product['p_img']);
      ?>

      <form action="" method="post">
         <div class="itembox1">
            <img src="<?php echo $img; ?>" alt="">
            <h3><?php echo $fetch_product['p_name']; ?></h3>
            <div class="price">Rs.<?php echo $fetch_product['p_price']; ?>/-</div>
            <input type="hidden" name="p_name" value="<?php echo $fetch_product['p_name']; ?>">
            <input type="hidden" name="p_price" value="<?php echo $fetch_product['p_price']; ?>">
            <input type="hidden" name="p_image" value="<?php echo $fetch_product['p_img']; ?>">
            <input type="submit" class="btn" value="add to cart"   name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>
       <script src="script.js"></script>
       </div>
    
<div class="footer"> About Us </div> 
</body>
</html>
      