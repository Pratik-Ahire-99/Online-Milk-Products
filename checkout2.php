<?php
include 'con_pg.php';
?>
<html>
    <head>
        <title>CheckOut</title>
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
</ul>

        <div class="box7">
        <div class='form'>
		<h1 class='h1'>Your are Order Placed Successfully</h1>
                <h1 class='h1'>Thank you For Shopping!!!</h1>
		<br font-size='20px'><a href='dairy_product.php' class='btn'>Continue Shopping</a>
        </div>
        </div>
        <div class="footer"> About Us </div> 
    </body>
    
</html>