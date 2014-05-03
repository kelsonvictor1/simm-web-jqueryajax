<?php

$username = "root"; 
$password = "123"; 
$hostname = "localhost"; 
$databasename = 'simm'; 

$connecDB = mysql_connect($hostname, $username, $password)or die('could not connect to database');
mysql_select_db($databasename,$connecDB);

?>