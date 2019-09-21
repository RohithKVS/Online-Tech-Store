<?php
session_start();
require 'database.php';
$category=mysqli_real_escape_string($conn,$_GET['category']);
$product=mysqli_real_escape_string($conn,$_GET['product']);
//echo $category.' '.$product;
$list=explode(" ", $product);
if($category=="All")
{
	if(count($list)==2)
	{
		$company_name=$list[0];
		$product_type=$list[1];
		$sql="SELECT * from products where company_name='$company_name' AND product_type LIKE '%$product_type%' AND deleted=0";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) == 0)
		{
		$sql="SELECT * from products where company_name='$company_name' AND product_name LIKE '%$product_type%' AND deleted=0";
			$result = mysqli_query($conn, $sql);
		}
	}
	else if(count($list)==1)
	{
		$product_type=$list[0];
		$sql="SELECT * from products where company_name='$product_type' AND deleted=0";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) == 0)
		{
			$sql="SELECT * from products where product_type LIKE '%$product_type%' AND deleted=0";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) == 0)
			{
				$sql="SELECT * from products where product_name LIKE '%$product_type%' AND deleted=0";
				$result = mysqli_query($conn, $sql);
			}
		}
	}
	else
	{
		$company_name=$list[0];
		$product_name = substr($product, ($pos = strpos($product, ' ')) !== false ? $pos + 1 : 0);
		$sql="SELECT * from products where company_name='$company_name' AND product_name LIKE '%$product_name%' AND deleted=0";
		$result = mysqli_query($conn, $sql);
	}
}
else
{
	if(count($list)==2)
	{
		$company_name=$list[0];
		$product_type=$list[1];
		$sql="SELECT * from products where company_name='$company_name' AND product_type LIKE '%$product_type%' AND category='$category' AND deleted=0";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) == 0)
		{
		$sql="SELECT * from products where company_name='$company_name' AND product_name LIKE '%$product_type%' AND category='$category' AND deleted=0";
			$result = mysqli_query($conn, $sql);
		}
	}
	else if(count($list)==1)
	{
		$product_type=$list[0];
		$sql="SELECT * from products where company_name='$product_type' AND category='$category' AND deleted=0";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) == 0)
		{
			$sql="SELECT * from products where product_type LIKE '%$product_type%' AND category='$category' AND deleted=0";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) == 0)
			{
				$sql="SELECT * from products where product_name LIKE '%$product_type%' AND category='$category' AND deleted=0";
				$result = mysqli_query($conn, $sql);
			}
		}
	}
	else
	{
		$company_name=$list[0];
		$product_name = substr($product, ($pos = strpos($product, ' ')) !== false ? $pos + 1 : 0);
		$sql="SELECT * from products where company_name='$company_name' AND product_name LIKE '%$product_name%' AND category='$category' AND deleted=0";
		$result = mysqli_query($conn, $sql);
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link href="css/style.css" rel="stylesheet">
		<title>Search Products</title>
		<link rel="shortcut icon" href="images/do.jpg">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="js/pagination.js"></script>
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
							<a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
						</li>
					</ul>
					<form class="form-inline my-2 my-lg-0 search-bar" action="search_products.php">
						<div class="form-group">
							<select class="form-control sel_category" id="sel1" name="category">
								<option value="All" <?php if($category == "All") echo "SELECTED";?> >All</option>
								<option value="Computers" <?php if($category == "Computers") echo "SELECTED";?>>Computers</option>
								<option value="Electronics" <?php if($category == "Electronics") echo "SELECTED";?>>Electronics</option>
								<option value="Software" <?php if($category == "Software") echo "SELECTED";?>>Software</option>
							</select>
						</div>
						<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="product">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
					<?php if(isset($_SESSION['logged_in'])) : ?>
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
					<?php else : ?>
					<a href="login.php" class="links my-2 my-sm-0"><img src="images/account-login.png" class="login_logo">Login</a>
					<a href="signup.php" class="links my-2 my-sm-0"><img src="images/account-login.png" class="login_logo">Sign Up</a>
					<?php endif; ?>
				</div>
			</nav>
			<br>
			<div class="row justify-content-center">
				<div class="col-md-8">
					<h3 align="center">Search result for : <?php echo $product?></h3><br>
					<?php if (mysqli_num_rows($result) ==0){
						echo '<div class="row">No products found for the given criteria. Try searching with a different criteria.</div>';
						} ?>
					<?php while ($row=mysqli_fetch_assoc($result)) : ?>
					<div class="card each_product">
						<div class="card-body">
							<div class="row">
								<div class="col-md-4"><a href="product_details.php?id=<?=$row['product_id']?>"><img src="images/product_images/<?= $row['image_id']?>" class="products_img"></a>
							</div>
							<div class="col-md-4">
								<a href="product_details.php?id=<?=$row['product_id']?>" class="product"><h4><?= $row['product_name']?></h4></a><br><h5>Price ($): <?= $row['price']?></h5>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile ;?>
				
				
				<div class="pagination-page"></div>
				<script>
					jQuery(function($) {
						// Consider adding an ID to your table
						// incase a second table ever enters the picture.
						var items = $(".each_product");
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