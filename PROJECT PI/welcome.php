<?php
// Initialize 
session_start();
 
// elegxos an mphke allios piso sto login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>WELCOME <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
    </div>
	<br><br><br><br>
    <p>
        
		
		
		<div>
						<button   class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
						
						<a href="logout.php" style= "color:black" >
							Sign Out of Your Account
						</a>
						<br>
						</button>
						<br><br>
						
						<button   class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
						
						<a a href="../index.html" style= "color:black" >
							ENTER
						</a>
					
						</button>
						
					
		
		
		
		
		 </div>
    </p>
</body>
</html>