<?php
	// mySQL Credentials and database information
	$db_host="hp109.hostpapa.com";
    $db_user="edthe579_adrian";
    $db_pass="14mSQL";
    $db_name="edthe579_website";
    $db_link = mysql_connect($db_host,$db_user,$db_pass) or die("Could not connect to database: " . mysql_error());
    mysql_select_db($db_name,$db_link);
	
	// Create USERS table
	$query = "CREATE TABLE users
	(
		uid INT(5) NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(uid),
		user VARCHAR(20),
		pass VARCHAR(32),
		email VARCHAR(50),
		ip INT,
		dt DATETIME,
		validkey VARCHAR(7),
		validated BOOLEAN
	)";
	
	$result = mysql_query($query, $db_link);
	if (!$result) {
		die("Could not create users table: " . mysql_error());
	} else {
		echo "Users table created";
	}
	
	// Create POST table
	
	$result = mysql_query($query, $db_link);
	if (!$result) {
		die("Could not create user table: " . mysql_error());
	} else {
		echo "User table created";
	}
	// Create COMMENT table
	
	$result = mysql_query($query, $db_link);
	if (!$result) {
		die("Could not create user table: " . mysql_error());
	} else {
		echo "User table created";
	}
	
	// Close the mySQL connection
	mysql_close($db_link);
?>