<?php
	//start session
	session_start();
	$root = 'http://'.$_SERVER['HTTP_HOST'].'/car';
	
	$db_host = "localhost";
	$db_username = "root";
	$db_pass = "root";
	$db_name = "cpms";
	
	mysql_connect("$db_host","$db_username","$db_pass") or die(mysql_error());
	mysql_select_db("$db_name") or die("Database Connection Error");
?>