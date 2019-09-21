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
	$sql = "SELECT * FROM user_details where email='$email'";
	$result = mysqli_query($conn, $sql);
	$user=mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link href="css/style.css" rel="stylesheet">
		<title>Edit Profile</title>
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
					<h3 align="center">Edit Profile</h3><br>
					<h6>Note: You cannot change your email address</h6>
					<form name="my-form" action="modify_user.php" method="POST">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>First Name:</td>
									<td><input type="text" id="first_name" class="form-control" name="first_name" value="<?=$user['first_name'];?>"></td>
								</tr>
								<tr>
									<td>Last Name:</td>
									<td><input type="text" id="last_name" class="form-control" name="last_name" value="<?=$user['last_name'];?>"></td>
								</tr>
								<tr>
									<td rowspan="6">Address</td>
									<td><input type="text" id="line_1" class="form-control" name="line_1" value="<?=$user['address1'];?>"></td>
								</tr>
								<tr>
									<td><input type="text" id="line_2" class="form-control" name="line_2" value="<?=$user['address2'];?>"></td>
								</tr>
								<tr>
									<td><input type="text" id="city" class="form-control" name="city" value="<?=$user['city'];?>"></td>
								</tr>
								<tr>
									<td><input type="text" id="state" class="form-control" name="state" value="<?=$user['state'];?>"></td>
								</tr>
								<tr>
									<td><input type="text" id="zipcode" class="form-control" name="zipcode" value="<?=$user['zipcode'];?>"></td>
								</tr>
								<tr>
									<td><input type="text" id="country" class="form-control" name="country" value="<?=$user['country'];?>"></td>
								</tr>
								<tr>
									<td>Phone Number</td>
									<td><input type="text" id="phone" class="form-control" name="phone" value="<?=$user['phone'];?>"></td>
								</tr>
							</tbody>
						</table>
						<div class="form-group row">
							<label class="col-md-4 col-form-label text-md-right" id="result"></label>
						</div>
						<div class="col-md-6 offset-md-4">
							<input type="submit" id="submit_edit" value="Submit" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="js/validate.js"></script>
	</body>
</html>