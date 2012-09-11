<?php
	require_once "db_config.php";
	$query = "CREATE TABLE test";
	$result = mysql_query($query, $db_link);
	
	if ($result) {
		echo "Table created";
	} else {
		echo "Table not created";
	}
?>