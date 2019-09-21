<?php
/* Displays user information and some useful messages */
session_start();
require 'database.php';
if (!isset($_SESSION['logged_in']))
{
	header("location:login.php");
	exit();
}
else
{
	$first_name = $_SESSION['first_name'];
	$last_name = $_SESSION['last_name'];
	$email = $_SESSION['email'];
	$sql1="SELECT DISTINCT transaction_id from purchase_history where email='$email'";
	$result1 = mysqli_query($conn, $sql1);
	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link href="css/style.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="js/pagination.js"></script>
		<title>Order History</title>
		<link rel="shortcut icon" href="images/do.jpg">
	</head>
	<body>
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<a class="navbar-brand" href="index.php">Online Tech Store</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto tech-navbar">
						<li class="nav-item">
							<a class="nav-link" href="afterlogin.php">Home<span class="sr-only">(current)</span></a>
						</li>
					</ul>
					<form class="form-inline my-2 my-lg-0 search-bar" action="search_products.php">
						<div class="form-group">
							<select class="form-control sel_category" id="sel1" name="category">
								<option>All</option>
								<option>Computers</option>
								<option>Electronics</option>
								<option>Software</option>
							</select>
						</div>
						<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="product">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/person.png" class="login_logo"></a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="view_profile.php">View Profile</a>
								<a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
								<a class="dropdown-item" href="change_password.php">Change Password</a>
								<a class="dropdown-item" href="order_history.php">Your Orders</a>
								<?php if(isset($_SESSION['admin'])) : ?>
								<a class="dropdown-item" href="add_product.php">Add Product</a>
								<a class="dropdown-item" href="update_product.php">Update Product</a>
								<a class="dropdown-item" href="delete_product.php">Delete Product</a>
								<?php endif; ?>
							</div>
						</li>
					</ul>
					<a href="cart.php" class="links my-2 my-sm-0"><img src="images/cart.png" class="login_logo"></a>
					<a href="logout.php" class="links my-2 my-sm-0"><img src="images/account-login.png" class="login_logo"></a>
				</div>
			</nav>
			<br>
			<div class="row justify-content-center">
				<div class="col-md-8">
					<h3 align="center">Your Orders</h3><br>
					<?php while ($row=mysqli_fetch_assoc($result1)) :
					$transaction_id=$row['transaction_id'];?>
					<div class="card each_order_history">
						<div class="card-header">Transaction ID:<?php echo $transaction_id;?></div>
						<div class="card-body">
							<?php
							$total=0;
								$sql2 = "SELECT p.image_id, p.product_name, p.price, q.quantity_purchased,q.transaction_id,q.date_purchased FROM products p JOIN purchase_history q ON p.product_id=q.product_id where transaction_id='$transaction_id'";
								$result2 = mysqli_query($conn, $sql2);
								while($row1=mysqli_fetch_assoc($result2)):
							?>
							<div class="row">
								<div class="col-md-4"><img src="images/product_images/<?= $row1['image_id']?>" class="products_img">
								</div>
								<div class="col-md-4">
									<h4><?= $row1['product_name']?></h4><br><h5>Quantity : <?= $row1['quantity_purchased']?></h5>
									<br><h5>Date Purchased : <?= $row1['date_purchased']?></h5>
								</div>
								<div class="col-md-4 text-md-right">Price ($): <?= $row1['price']?></div>
							</div>
							<?php $total=$total + ($row1['quantity_purchased'] * $row1['price']);?>
							<hr>
							<?php endwhile;?>
							<div class="text-md-right">Total ($): <?=$total?></div>
						</div>
					</div>
					
					<?php endwhile ;?>
					<div class="pagination-page"></div>
					<script>
						jQuery(function($) {
							// Consider adding an ID to your table
							// incase a second table ever enters the picture.
							var items = $(".each_order_history");
							var numItems = items.length;
							var perPage = 5;
							// Only show the first 2 (or first `per_page`) items initially.
							items.slice(perPage).hide();
							// Now setup the pagination using the `.pagination-page` div.
							$(".pagination-page").pagination({
								items: numItems,
								itemsOnPage: perPage,
								//cssStyle: "light-theme",
								// This is the actual page changing functionality.
								onPageClick: function(pageNumber) {
									// We need to show and hide `tr`s appropriately.
									var showFrom = perPage * (pageNumber - 1);
									var showTo = showFrom + perPage;
									// We'll first hide everything...
									items.hide()
										// ... and then only show the appropriate rows.
										.slice(showFrom, showTo).show();
								}
							});
							// EDIT: Let's cover URL fragments (i.e. #page-3 in the URL).
							// More thoroughly explained (including the regular expression) in:
							// https://github.com/bilalakil/bin/tree/master/simplepagination/page-fragment/index.html
							// We'll create a function to check the URL fragment
							// and trigger a change of page accordingly.
							function checkFragment() {
								// If there's no hash, treat it like page 1.
								var hash = window.location.hash || "#page-1";
								// We'll use a regular expression to check the hash string.
								hash = hash.match(/^#page-(\d+)$/);
								if(hash) {
									// The `selectPage` function is described in the documentation.
									// We've captured the page number in a regex group: `(\d+)`.
									$(".pagination-page").pagination("selectPage", parseInt(hash[1]));
								}
							};
							// We'll call this function whenever back/forward is pressed...
							$(window).bind("popstate", checkFragment);
							// ... and we'll also call it when the page has loaded
							// (which is right now).
							checkFragment();
						});
					</script>
				</div>
			</div>
		</div>
	</body>
</html>