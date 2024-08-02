<?php
include 'con_pg.php';
if(isset($_POST['order_btn'])){
    $p_name=$_POST['u_name'];
    $onumber=$_POST['mobile'];
    $email=$_POST['email'];
    $omethod=$_POST['omethod'];
    $flat=$_POST['flat'];
    $city=$_POST['city'];
    $price_total=$_POST['total_price'];
    $product_total=$_POST['total_product'];
    $cart_query= pg_query($con,"SELECT * FORM cart");
    $price_total=0;
    if(pg_num_rows($cart_query)>0)
    {
        while($product_item= pg_fetch_assoc($cart_query))
        {
            $product_name[]=$product_item['p_name'].'('.$product_item['p_quantity'].')';
            $product_price= number_format($product_item['p_price'] * $product_item['p_quantity']);
            $price_total+=$product_price;
        }
    }
    echo "Hello";
    $p_name= stripslashes($_REQUEST['u_name']);
    $p_name= pg_escape_string($con,$p_name);
    $onumber= stripslashes($_REQUEST['mobile']);
    $onumber= pg_escape_string($con,$onumber);
    $email= stripslashes($_REQUEST['email']);
    $email= pg_escape_string($con,$email);
    $omethod= stripslashes($_REQUEST['omethod']);
    $omethod= pg_escape_string($con,$omethod);
    $flat= stripslashes($_REQUEST['flat']);
    $flat= pg_escape_string($con,$flat);
    $city= stripslashes($_REQUEST['city']);
    $city= pg_escape_string($con,$city);
    $price_total= stripslashes($_REQUEST['total_price']);
    $price_total= pg_escape_string($con,$price_total);
    $product_total= stripslashes($_REQUEST['total_product']);
    $product_total= pg_escape_string($con,$product_total);
    
    $total_product= implode(',', $product_name);
    $detail_query= pg_query($con,"INSERT INTO order(u_name,mobile,email,omethod,flat,city,total_product,total_price)VALUES('$p_name','$onumber','$email','$omethod','$flat','$city','$total_product','$price_total')") or die ('Query Failed');
    
    if($cart_query && $detail_query){
        echo"
            <div class='order-message-container'>
            <div class='message-container'>
            <h3>Thank You For Shooping...!!</h3>
            <div class='order-detail'>
             <span>".$total_product."</span>
                 <span class='total>total :Rs.".$price_total."/- </span>
                     </div>
                     <div class='customer-details'>
            <p>your name:<span>".$u_name."</span></p>
                <p> your number:<span>".$mobile."</span></p>
                    <p> email:<span>".$email."</span></p>
                        <p>add:<span>".$flat.".".$city."</span></p>
                            <p>Payment:<span>".$omethod."</span></p>
                   <p>(*Pay When product arrives*)</p>
                   </div>
                   <a href='dairy_products.php' class='btn'>Continue Shopping</a>
                   </div>
                   </div>
            
                                          
                ";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>CheckOut</title>
 <link style="text/css" rel="stylesheet" href="style.css"/>

</head>
<body>
<ul>
   
<li><a href="dairy_product.php">Dairy Products</a></li>
<li><a href="logout.php">Profile Logout</a></li>
 <h3>Online Milk/Dairy Products</h3>
<?php
$select_rows= pg_query($con,"SELECT * FROM cart") or die("query faild");
$row_count= pg_num_rows($select_rows);
?>
<li><a href="cart.php" >Cart <span><?php echo $row_count;?></span></a></li>
<!-- <h2><?php //echo $_SESSION['u_name'];?></h2> -->
</ul>
    <div class="box7">
        
       
        <section class="checkout-form">

   <h1 class="heading">complete your order</h1>
   <div class="container">

   <form action="checkout2.php" method="post">

   <div class="display-order">
      <?php
         $select_cart = pg_query($con, "SELECT * FROM cart");
         $total = 0;
         $grand_total = 0;
         if(pg_num_rows($select_cart) > 0){
            while($fetch_cart = pg_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['p_price'] * $fetch_cart['p_quantity']);
            $grand_total = $total += $total_price;
      ?>
      <?= $fetch_cart['p_name']; ?>(<?= $fetch_cart['p_quantity']; ?>) ,
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="u_name" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="text" placeholder="enter your number" name="mobile" required>
         </div><br>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="omethod">
               <option value="cash on delivery" selected>cash on delivery</option>
               <option value="credit cart">credit cart</option>
               
            </select>
         </div><br>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         
         <div class="inputBox">
             <span>city  </span><br>
            <input type="text" placeholder="e.g. mumbai" name="city" required>
         </div><br>
       
      </div><br>
      <a href="checkout2.php"><input type="submit" value="order now" name="order_btn" class="btn2"></a>
   </form>
 </div>
</section>
       
    </div>

<div class="footer"> About Us </div>
</body>
</html>
