<?php
	
	//This is the name given on the website database

	$servername = "localhost";
	$username= "root";
	$password = "";
	$dbName = "srconstructions";

	$conn= mysqli_connect($servername,$username,$password,$dbName);

	if(!$conn){
		die("connection failed:".mysqli_connect_error());
	}

?>