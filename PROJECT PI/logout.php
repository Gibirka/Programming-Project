<?php
// Initialize 
session_start();
 
// Unset all 
$_SESSION = array();
 
// Destroy 
session_destroy();
 
// Redirect 
header("location: login.php");
exit;
?>