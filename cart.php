<?php
 include "con_pg.php";
 if(isset($_POST['update_update_btn']))
 {
     $update_value=$_POST['update_quantity'];
     $update_id=$_POST['update_quantity_id'];
     $update_quantity_query= pg_query($con,"UPDATE cart SET p_quantity='$update_value' WHERE c_id='$update_id'");
     if($update_quantity_query)
     {
         header('location:cart.php');
     };
 };
 if(isset($_GET['remove']))
 {
     $remove_id=$_GET['remove'];
     pg_query($con,"DELETE FROM cart WHERE c_id='$remove_id'");
     header('location:cart.php');
 };
 if(isset($_GET['delete_all']))
 {
     pg_query($con,"DELETE FROM cart");
     header('location:cart.php');
 }
?>
<html>
<head>
    <title>Product Cart</title>
    <link style="text/css" rel="stylesheet" href="style.css"/>
</head>
<body>
<ul>
<li><a href="dairy_product.php">Dairy Products</a></li>
<li><a href="logout.php">Profile Logout</a></li>
<?php
$select_rows= pg_query($con,"SELECT * FROM cart") or die("query faild");
$row_count= pg_num_rows($select_rows);
?>
<li><a href="cart.php" >Cart <span><?php echo $row_count;?></span></a></li>
<h3>Online Milk/Dairy Products</h3>
<!-- <h2><?php //echo $_SESSION['u_name'];?></h2> -->
</ul>
<div class="box7">
    <table border="2">
        <thead>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total price</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php
        $select_cart= pg_query($con,'SELECT * FROM cart');
        $grand_total=0;
        if(pg_num_rows($select_cart)>0)
        {
            while($fetch_cart= pg_fetch_assoc($select_cart))
            {
              //  $fetch_cart[3]= pg_fetch_result($select_cart, 'p_img');
            // $img= pg_unescape_bytea($fetch_cart['p_img']);
        ?>
        <tr>
            <td><img src="<?php echo $fetch_cart['p_img'];?>" height="100" alt=""></td>
             <td><?php echo $fetch_cart['p_name'];?> </td>
             <td>Rs. <?php echo number_format($fetch_cart['p_price']);?></td>
             <td>
        <form action="" method="post">
            <input type="hidden" name="p_image" value="<?php echo $fetch_cart['p_img']; ?>">
            <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['c_id'];?>">
            <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['p_quantity'];?>">
            <input type="submit" value="update" name="update_update_btn">
        </form>
             </td>
             <td>Rs.<?php echo $sub_total= number_format($fetch_cart['p_price'] * $fetch_cart['p_quantity']);?></td>
             <td><a href="cart.php?remove=<?php echo $fetch_cart['c_id'];?>" onclick="return confirm('remove item form cart?')" class="delete-btn2">Remove</a></td>
        </tr>
        <?php
        $grand_total += $sub_total;
            };
        };
        ?>
        <tr class="table-bottom">
            <td><a href="dairy_product.php" class="option-btn2" style="margin-top: 0;">Continue Shopping</a></td>
            <td colspan="3">grand total</td>
            <td>Rs.<?php echo $grand_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn2"> <i class="fas fa-trash"></i> Delete All </a></td>
         </tr>
    </tbody>
    </table>
     <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Proceed to checkout</a>
   </div>
</div>
    <script src="script.js"></script>
<div class="footer"> About Us </div> 
</body>
</html>
      