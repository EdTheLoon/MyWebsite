<?php
    $db_host="db416074814.db.1and1.com";
    $db_user="dbo416074814";
    $db_pass="omgSQL1";
    $db_name="db416074814";
    $db_link = mysql_connect($db_host,$db_user,$db_pass) or die;
    $db_salt = "omgSQL";
    mysql_select_db($db_name,$db_link);
?>