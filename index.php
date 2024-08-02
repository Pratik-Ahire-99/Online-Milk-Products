<!DOCTYPE html>
<html>
<head>
    <title>LogIn</title>
<link style="text/css" rel="stylesheet" href="style.css"/>
<meta charset="utf-8">
</head>
<?php
require('con_pg.php');
session_start();
if(isset($_POST['u_name']))
{
 $u_name=stripslashes($_REQUEST['u_name']);
 $u_name=pg_escape_string($con,$u_name);
 $u_pass=stripslashes($_REQUEST['u_pass']);
 $u_pass=pg_escape_string($con,$u_pass);
 $query="SELECT * FROM users WHERE u_name='$u_name' and u_pass='$u_pass'";
 $result=pg_query($con,$query)or die(pg_last_error());
 $rows=pg_num_rows($result);
 if($rows==1)
 {
  
  $_SESSION['u_name']=$u_name;
  header("Location:dairy_product.php");
 }
 else
 {
  echo "<div class='form'>
  <h1 class='h1'>Username/Password is Incorrect</h1>
  <br><label>Click here to <a href='index.php'> Login</a></label></div>";
 }
}
else
 {
	 ?>


<body>
<ul>
    
<li><a>Dairy Products</a></li>
<li><a>Profile</a></li>
<h3>Online Milk/Dairy Products</h3>
</ul>
<div class="box1">
<div class="h1"><h1>Online<br>Milk/Dairy Products</h1></div>
<div class="p"><P>Don't Have Account?</p></div>
<div class="p"><p><a href="registration.php"><input type="submit" name="register" value="register" class="login-btn"/></a></p></div>
</div>
<div class="box2">
<div class="logintxt">
    Login</div><br><br>
    
<form action=" " method="POST" name="login">
    <label>User Name&nbsp: </label><input type="text" name="u_name" placeholder="username" required/><br><br>
    <label>&nbsp Password &nbsp: </label><input type="password" name="u_pass" placeholder="password" required/><br><br>
<input type="submit" name="submit" value="login" class="login-btn">
</form>
</div>
<div class="footer"> About Us </div>
 <?php } ?>
</body>
</html>
      