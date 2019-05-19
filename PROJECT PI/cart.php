<?php
session_start();
include('config.php');
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop  loop molis vrei product
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
								<a href="index.html" style= "color:black">Home</a>
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

	</header>

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
}
?>

<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>
<td></td>
<td>ITEM NAME</td>
<td>QUANTITY</td>
<td>PRICE</td>
<td>ITEMS TOTAL</td>
</tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td><img src='<?php echo $product["image"]; ?>' width="50" height="40" /></td>
<td><?php echo $product["name"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onchange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
</select>
</form>
</td>
<td><?php echo "$".$product["price"]; ?></td>
<td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
</td>
</tr>



</tbody>
</table>
		
  <?php
}else{
	
	echo "<center><h3 >Your cart is empty!</h3></center>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>


		<form >
		<center>
					<div class="w-size2 p-t-20">
					
						<button   class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" >
						
					<?phpfunction clearCart(){
							unset($_SESSION['name']);
							unset($_SESSION['code']);
							unset($_SESSION['price']);
							unset($_SESSION['image']);
							unset($_SESSION['name']);
							}
					   ?>		
						<a href="cart1.php" style= "color:White">
							PURCHASE	
						</a>
						</button>
					</div>
		</center>
				</form>
					

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
				Copyright © 2019 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by our TEAM for School Project.
			</div>
		</div>
	</footer>

	
</body>
</html>