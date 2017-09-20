<?php 

	error_reporting(0);//to hide silly warnings that don't matter :)
	 $server = 'mysql.cs.mun.ca';
	 $user = 'cs3715w17_cag635';
	 $password = '%a!FAxXv';
	$dbName = 'cs3715w17_cag635';

	$con = mysqli_connect($server, $user, $password);

	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$currentDB = mysqli_select_db($con,$dbName);

	$createList = "CREATE TABLE IF NOT EXISTS ListItems 
		(
			listID int(10) NOT NUll auto_increment PRIMARY KEY,
			task varchar(255) NOT NULL,
			description varchar(255) NOT NULL,
			due_date date NOT NULL,
			completed tinyint(1) NOT NULL DEFAULT 0
		)";

	mysqli_query($con,$createList);

	$createTable = "CREATE TABLE IF NOT EXISTS Users 
		(
			userID int(10) NOT NUll auto_increment PRIMARY KEY,
			username varchar(255) NOT NULL,
			password varchar(255) NOT NULL
		)";

	mysqli_query($con,$createTable);
?>