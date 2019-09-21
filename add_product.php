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
	$message="";
	if(isset($_POST['submit']))
	{
		$file=$_FILES['file'];
		$file_name=$file['name'];
		$file_tmpname=$file['tmp_name'];
		$file_size=$file['size'];
		$file_error=$file['error'];
		$file_type=$file['type'];
		$file_ext=strtolower(end(explode('.',$file_name)));
		$allowed_ext=array('jpg','jpeg','png');
		$company_name=mysqli_real_escape_string($conn,$_POST['company_name']);
		$product_type=mysqli_real_escape_string($conn,$_POST['product_type']);
		$product_name=mysqli_real_escape_string($conn,$_POST['product_name']);
		$description=mysqli_real_escape_string($conn,$_POST['description']);
		$category=mysqli_real_escape_string($conn,$_POST['category']);
		$price=mysqli_real_escape_string($conn,$_POST['price']);
		$quantity_available=mysqli_real_escape_string($conn,$_POST['quantity_available']);
		if(in_array($file_ext, $allowed_ext))
		{
			if($file_error===0)
			{
				if($file_size<600000)
				{
					$sql="SELECT * from products where deleted=0 ORDER BY product_id DESC";
					$result = mysqli_query($conn, $sql);
					$row=mysqli_fetch_assoc($result);
					$newid=$row['product_id']+1;
					$file_newname=$newid."_image.".$file_ext;
					$file_destination="images/product_images/".$file_newname;
					$stmt = $conn->prepare("INSERT INTO products (company_name, product_type, product_name, image_id, description, category, price, quantity_available) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("ssssssss", $company_name, $product_type, $product_name, $file_newname, $description, $category, $price, $quantity_available);
					$stmt->execute();
					move_uploaded_file($file_tmpname, $file_destination);
					$success="Yes";
				}
				else
				{
					$message = "File size is too big";
				}
			}
			else
			{
				$message = "Error uploading file";
			}
		}
		else
		{
			$message = "File type should be .jpg, .jpeg or .png";
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
		<title>Add Product</title>
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
					<div class="card">
						<div class="card-header">Add Product
							<?php
									if($message==="Yes")
									{
									echo '<label for="for_result" class="success col-md-6 col-form-label text-md-right">Product added successfully</label>';
									}
									else
									{
										echo '<label for="for_result" class="unsuccess col-md-6 col-form-label text-md-right">'.$message.'</label>';
									}
							?>		
						</div>
						<div class="card-body">
							<form name="my-form" action="add_product.php" method="POST" enctype="multipart/form-data">
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Product Image</label>
									<div class="col-md-6">
										<input type="file" id="file" name="file" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Company Name</label>
									<div class="col-md-6">
										<input type="text" id="company_name" class="form-control" name="company_name" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Product Type</label>
									<div class="col-md-6">
										<input type="text" id="product_type" class="form-control" name="product_type" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Product Name</label>
									<div class="col-md-6">
										<input type="text" id="product_name" class="form-control" name="product_name" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Description</label>
									<div class="col-md-6">
										<input type="textarea" id="description" class="form-control" name="description" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Category</label>
									<div class="col-md-6">
										<select class="form-control" id="category" name="category">
											<option>Computers</option>
											<option>Electronics</option>
											<option>Software</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Price ($)</label>
									<div class="col-md-6">
										<input type="text" id="price" class="form-control" name="price" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Quantity Available</label>
									<div class="col-md-6">
										<input type="text" id="quantity_available" class="form-control" name="quantity_available" required>
									</div>
								</div>
								<div class="col-md-6 offset-md-4">
									<input type="submit" id="submit" name="submit" value="Add Product" class="btn btn-primary">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</body>
</html>