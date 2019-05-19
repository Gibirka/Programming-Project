<?php
session_start();
include('config.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];
$quantityp = $row['quantityp'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image,
	'quantityp'=>$quantityp)
);



if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;

    $result = mysqli_query($con, "UPDATE products SET quantityp = quantityp - 1 WHERE code =".$code);
	
	$status = "<div class='box'>Product is added to your cart!</div>";
}


else{
	$result = mysqli_query($con, "UPDATE products SET quantityp = quantityp - 1 WHERE code =".$code);
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}

}
?>
<html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/logo.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
</head>
<body style="width:100%; margin:100px auto;">

	<header class="header1">
		
		<div class="container-menu-header">
			
			<div class="wrap_header">
				
				<a href="index.html" class="logo">
					<img src="images/icons/logo.png" alt="IMG-LOGO" height="100" width="80">
				</a>

				
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="index.html"  style= "color:black">Home</a>
							</li>

							<li>
								<a href="product.php" style= "color:black">Shop</a>
							</li>

							<li>
								<a href="about.html" style= "color:black">About</a> 
							</li>
						</ul>
					</nav>
				</div>
				

				<div class="header-icons">
					<a href="login.php" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
					<a href="cart.php" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
					</a>
					</div>
				</div>
			</div>
		</div>
		<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/black12.png);">
		<div>
		<h2 class="l-text2 t-center">
			SHOP
		</h2>
	</section>
	</header>
	<br>	<br>	<br>	<br>	<br>	
	

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>

<?php
}

$result = mysqli_query($con,"SELECT * FROM `products`");
while($row = mysqli_fetch_assoc($result)){
		
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <div class='quantityp'>QUANTITY:".$row['quantityp']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
			  
        }
mysqli_close($con);

?>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
<br><br><br><br><br><br><br><br>
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="flex-w p-b-90">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					GET IN TOUCH
				</h4>

				<div>
					<p class="s-text7 w-size27">
						Any questions?<br/> Let us know in Technological Institute of Eastern Macedonia and Thrace. <br/> Call us on (+30) 69 *25* **78
					</p>

					<div class="flex-m p-t-30">
						<a href="https://www.facebook.com/StevenHGrey/" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<a href="https://www.instagram.com/stevenhgrey404/" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
						<a href="https://www.youtube.com/channel/UCxNX7I_l_1GUABElzjPVKqg" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
					</div>
				</div>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Categories
				</h4>

				<ul>
					<li class="p-b-9">
						<a  class="s-text7">
							Men
						</a>
					</li>

					<li class="p-b-9">
						<a  class="s-text7">
							Women
						</a>
					</li>

					<li class="p-b-9">
						<a " class="s-text7">
							Kids
						</a>
					</li>

					
				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Links
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="product.php" class="s-text7">
							Search
						</a>
					</li>
		
				</ul>
			</div>

			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					 SUBSCRIBE
				</h4>

				<form>
					<div class="w-size2 p-t-20">
						
						<button   class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
						
						<a href="https://www.youtube.com/channel/UCxNX7I_l_1GUABElzjPVKqg" style= "color:White" >
							JOIN NOW
						</a>
					
						</button>
					</div>

				</form>
			</div>
		</div>

		<div class="t-center p-l-15 p-r-15">
			<div class="t-center s-text8 p-t-20">
				Copyright © 2019 All rights reserved. | This Website is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by our TEAM for School Project.
			</div>
		</div>
	</footer>

</body>
</html>