<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<link style="text/css" rel="stylesheet" href="style.css"/>

    
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require('con_pg.php');
if(isset($_REQUEST['u_name']))
{
        $u_fname= stripslashes($_REQUEST['u_fname']);
        $u_fname= pg_escape_string($con,$u_fname);
        
        $u_lname= stripslashes($_REQUEST['u_lname']);
        $u_lname= pg_escape_string($con,$u_lname);
        
	$u_name= stripslashes($_REQUEST['u_name']);
	$u_name=pg_escape_string($con,$u_name);
        
	$u_email=stripslashes($_REQUEST['u_email']);
        $u_email=pg_escape_string($con,$u_email);
        
	$u_pass=stripslashes($_REQUEST['u_pass']);
        $u_pass=pg_escape_string($con,$u_pass);
        
        $u_phn=stripslashes($_REQUEST['u_phn']);
	$u_phn=pg_escape_string($con,$u_phn);
        
        $u_add=stripslashes($_REQUEST['u_add']);
	$u_add= pg_escape_string($con,$u_add);
	//$trn_date=date("Y-m-d #:i:s");
	$query="INSERT into users(u_fname,u_lname,u_name,u_email,u_pass,u_phn,u_add)VALUES('$u_fname','$u_lname','$u_name','$u_email','$u_pass','$u_phn','$u_add')";
	$result=pg_query($query);
	if($result)
	{
		echo"<div class='form'>
		<h1 class='h1'>Your are register successfully</h1>
		<br font-size='20px'><label>click here to<a href='index.php'> Login</a></label></div>";
           // alert("Your  are register successfully!");
           // header("location:index.php");
            
	}
}
else
{
	?>
            

</head>
<body>
	<ul>

<li><a>Dairy Products</a></li>
<li><a>Profile</a></li>
 <h3>Online Milk/Dairy Products</h3>
</ul>
	<div class="box3">
    <div class="hh1"><h1>Online<br>Milk/Dairy Products</h1></div>
    <div class="pp"><P>Already Have Account...!</p></div>
    <div class="pp"><p><a href="index.php"><input type="submit" name="login" class="login-btn" value="Login" /></a></p></div>
    </div>
	<div class="box4">
	<div class="regtxt"><h1>Registration</h1>
	<form action=" " name="registration" method="POST">
        <input type="text" name="u_fname" placeholder="First Name" required>
        <input type="text" name="u_lname" placeholder="Last Name" required><br>
	<input type="text" name="u_name" placeholder="username" required>
	<input type="email" name="u_email" placeholder="email" Required><br>
	<input type="text" name="u_phn" placeholder="Phone No."required>
	<input type="text" name="u_add" placeholder="Address"required><br>
	<input type="password" name="u_pass" placeholder="password" Required><br>
	<input type="submit" name="submit" class="login-btn" value="Register">
	</form>
	</div>
	</div>
	<div class="footer"> About Us </div>
<?php }?>
</body>
</html>
