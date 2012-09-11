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
		uid INT(7) NOT NULL AUTO_INCREMENT,
		user VARCHAR(20) UNIQUE,
		pass VARCHAR(32),
		email VARCHAR(50) UNIQUE,
		ip INT,
		dt DATETIME,
		validkey VARCHAR(7),
		validated BOOLEAN,
		PRIMARY KEY (uid)
	)";
	
	$result = mysql_query($query, $db_link);
	if (!$result) {
		die("Could not create users table: " . mysql_error() . "<br>");
	} else {
		echo "Users table created<br>";
	}
	
	// Create POSTS table
	$query = "CREATE TABLE posts
	(
		pid INT(7) NOT NULL AUTO_INCREMENT,
		uid INT(3) NOT NULL,
		date DATETIME,
		content TEXT NOT NULL,
		PRIMARY KEY (pid)
	)";
	
	$result = mysql_query($query, $db_link);
	if (!$result) {
		die("Could not create posts table: " . mysql_error() . "<br>");
	} else {
		echo "Posts table created<br>";
	}
	// Create COMMENTS table
	$query = "CREATE TABLE comments
	(
		cid INT(7) NOT NULL AUTO_INCREMENT,
		pid INT(7) NOT NULL,
		uid INT(7) NOT NULL,
		date DATETIME,
		content TEXT NOT NULL,
		PRIMARY KEY (cid)
	)";
	
	$result = mysql_query($query, $db_link);
	if (!$result) {
		die("Could not create comments table: " . mysql_error() . "<br>");
	} else {
		echo "Comments table created<br>";
	}
	
	// Close the mySQL connection
	mysql_close($db_link);
?>