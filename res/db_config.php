<?php
    $db_host="hp109.hostpapa.com";
    $db_user="edthe579_site";
    $db_pass="icecream";
    $db_name="edthe579_website";
    $db_link = mysql_connect($db_host,$db_user,$db_pass) or die("Could not connect to mySQL: " . mysql_error());	
    $db_salt = "omgSQL";
    mysql_select_db($db_name,$db_link);
?>