<?php
$server = "localhost";
$user = "root";
$password = "";

if(mysql_connect($server, $user, $password)){
	if(mysql_select_db("lostnfound")){
		
	}else{
		die('There was an error in DB connection');	
	}
}else{
	die('There was an error in Server connection');
}
?>