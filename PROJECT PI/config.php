<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'demo');
 
/* prospathia sundeshs */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// elegxos
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<?php


$con = mysqli_connect("localhost","root","","demo");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
		}
?>