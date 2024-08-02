<?php
$host="host=localhost";
$port="port=5432";
$dbname="dbname=dairy_db";
$credentials="user=tybcs password=msgcs";
$con=pg_connect("$host $port $dbname $credentials")or die("Query Faild.pg_last_error()");
if(!$dbname)
{
	echo"Error unable to open";
}
else
{
	//echo"Open Successfully";
}
?>