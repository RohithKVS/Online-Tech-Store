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
	if(isset($_POST['submit']))
	{
		// Makes it easier to read
	    $oldpass = $_POST['old_pass'];
		$email=$_SESSION['email'];
		$sql = "SELECT * FROM user_details where email='$email'";
		$result = mysqli_query($conn, $sql);
		$user=mysqli_fetch_assoc($result);
		$pass=$user['password'];
	    $password = hash('sha256', $user['salt'].hash('sha256',$oldpass));	
	    if ($pass != $password)
		{
			header("Location: change_password.php?error=invalid");
			exit();
	    }
		else
		{
			$newpass=$_POST['new_pass'];
			$password = hash('sha256', $user['salt'].hash('sha256',$newpass));
			$stmt = $conn->prepare("UPDATE user_details SET password=? where email=?");
			$stmt->bind_param("ss", $password, $email);
			$stmt->execute();
			header("Location:afterlogin.php");
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link href="css/style.css" rel="stylesheet">
		<title>Change Password</title>
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
					<h3 align="center">Change Password</h3><br>
					<form name="my-form" action="change_password.php" method="POST">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>Current Password</td>
									<td><input type="password" id="old_pass" class="form-control" name="old_pass"></td>
								</tr>
								<tr>
									<td>New Password</td>
									<td><input type="password" id="new_pass" class="form-control" name="new_pass"></td>
								</tr>
								<tr>
									<td>Confirm Password</td>
									<td><input type="password" id="conf_new_pass" class="form-control" name="conf_new_pass"></td>
								</tr>
							</tbody>
						</table>
						<div class="form-group row">
							<?php
							$loc="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
							if(strpos($loc,'error=invalid') !==false)
							{
							echo '<label class="col-md-4 col-form-label text-md-right" id="result">Wrong password. Try again</label>';
							}
							?>
							<label class="col-md-4 col-form-label text-md-right" id="result"></label>
						</div>
						<div class="col-md-6 offset-md-4">
							<input type="submit" name="submit" id="submit_change_password" value="Submit" class="btn btn-primary">
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