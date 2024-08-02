<?php
session_start();
if(!isset($_SESSION["u_name"]))
{
	location("dairy_product.php");
	exit();
}
?>