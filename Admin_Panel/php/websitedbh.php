<?php
	
	//This is the name given on the website database

	$servername = "localhost";
	$username= "srconehm_Karthik";
	$password = "12345";
	$dbName = "srconehm_Construct";

	$conn= mysqli_connect($servername,$username,$password,$dbName);

	if(!$conn){
		die("connection failed:".mysqli_connect_error());
	}

?>