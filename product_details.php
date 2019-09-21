<?php
session_start();
require 'database.php';
$id=$_GET['id'];
$sql="SELECT * from products where product_id = $id AND deleted=0";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link href="css/style.css" rel="stylesheet">
		<title>Product Details</title>
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
							<a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
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
					<div class="card">
						<div class="card-header">Product Details</div>
						<div class="card-body">
							<form method="POST" action="cart.php?action=add&id=<?php echo $row['product_id']?>">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td>Image:</td>
											<td><img src="images/product_images/<?= $row['image_id']?>" class="products_img"></td>
										</tr>
										<tr>
											<td>Company Name:</td>
											<td><?=$row['company_name'];?></td>
										</tr>
										<tr>
											<td>Product Type:</td>
											<td><?=$row['product_type'];?></td>
										</tr>
										<tr>
											<td>Product Name:</td>
											<td><?=$row['product_name'];?></td>
										</tr>
										<tr>
											<td>Desciption:</td>
											<td><?=$row['description'];?></textarea>
											</td>
										</tr>
										<tr>
											<td>Category:</td>
											<td><?=$row['category'];?></td>
										</tr>
										<tr>
											<td>Price:</td>
											<td><?=$row['price'];?></td>
										</tr>
										<tr>
											<td>Enter Quantity:</td>
											<td><input type="text" name="quantity" class="form-control" value="1"></td>
										</tr>
									</tbody>
								</table>
								<div class="col-md-6 offset-md-4">
								<input type="hidden" name="product_name" value="<?php echo $row['product_name']?>">
								<input type="hidden" name="price" value="<?php echo $row['price']?>">
								<?php
								$flag=0;
								if($row['quantity_available']<=5 && $row['quantity_available']!=0)
								{
									echo '<div class="alert alert-warning" role="alert">Only '.$row['quantity_available'].' left in stock</div>';
								}
								else if($row['quantity_available'] == 0)
								{
									echo '<div class="alert alert-danger" role="alert">Out of stock</div>';
									$flag=1;
								}
								if($flag==0)
								{
									if(isset($_SESSION['logged_in']))
									{
										echo '<input type="submit" name="submit" id="submit_edit" value="Add to Cart" class="btn btn-primary">';
									}
									else
									{
										echo '<input type="submit" name="submit" id="submit_edit" value="Login to Add to Cart" class="btn btn-primary">';
									}
								}
								if(isset($_GET['success']))
								{
									echo '<div class="alert alert-success" role="alert">Product successfully added to cart</div>';
								}

								?>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		</body>
	</html>