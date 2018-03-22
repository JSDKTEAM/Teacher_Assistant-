<?php
	$hostname="localhost";
	$username="db";
	$pass = "db";
	$dbname="db";	
	$con=mysql_connect($hostname,$username,$pass)or die(mysql_error ());
	mysql_select_db($dbname,$con) or die (mysql_error ());
?>

