<?php
	require_once "db_config.php";
	$query = "CREATE TABLE test";
	$result = mysql_query($query, $db_link);
	
	if ($result) {
		echo "Table created";
	} else {
		die("Could not create table " . mysql_error());
	}
	
	// Close the mySQL connection
	mysql_close($db_link);
?>