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
	$sql="SELECT * from products where deleted=0";
	$result = mysqli_query($conn, $sql);
	$message="";
	if(isset($_POST['submit']))
	{
		$allowed_ext=array('jpg','jpeg','png');
		foreach ($_POST['product_id'] as $id)
		{
			$file=$_FILES['product_image_'.$id];
			$file_name=$file['name'];
			$file_tmpname=$file['tmp_name'];
			$file_size=$file['size'];
			$file_error=$file['error'];
			$file_type=$file['type'];
			$file_ext=strtolower(end(explode('.',$file_name)));
			$product_id=mysqli_real_escape_string($conn,$_POST['product_id'][$id]);
			$company_name=mysqli_real_escape_string($conn,$_POST['company_name'][$id]);
			$product_type=mysqli_real_escape_string($conn,$_POST['product_type'][$id]);
			$product_name=mysqli_real_escape_string($conn,$_POST['product_name'][$id]);
			$description=mysqli_real_escape_string($conn,$_POST['description'][$id]);
			$category=mysqli_real_escape_string($conn,$_POST['category_edit'][$id]);
			$price=mysqli_real_escape_string($conn,$_POST['price'][$id]);
			$quantity_available=mysqli_real_escape_string($conn,$_POST['quantity_available'][$id]);
			$stmt = $conn->prepare("UPDATE products SET company_name=? , product_type=? , product_name=? , description=? , category=? , price=? , quantity_available=? where product_id=?");
			$stmt->bind_param("ssssssss", $company_name, $product_type, $product_name, $description, $category, $price, $quantity_available,$product_id);
			$stmt->execute();
			if($file_error===0)
			{
				if(in_array($file_ext, $allowed_ext))
				{
					if($file_size<600000)
					{
						if(file_exists("images/product_images/".$product_id.'_image.'.$allowed_ext[0]))
							unlink("images/product_images/".$product_id.'_image.'.$allowed_ext[0]);
						if(file_exists("images/product_images/".$product_id.'_image.'.$allowed_ext[1]))
							unlink("images/product_images/".$product_id.'_image.'.$allowed_ext[1]);
						if(file_exists("images/product_images/".$product_id.'_image.'.$allowed_ext[2]))
							unlink("images/product_images/".$product_id.'_image.'.$allowed_ext[2]);
						$file_newname=$product_id."_image.".$file_ext;
						$file_destination="images/product_images/".$file_newname;
						move_uploaded_file($file_tmpname, $file_destination);
						$stmt = $conn->prepare("UPDATE products SET image_id=? where product_id=?");
						$stmt->bind_param("ss", $file_newname, $product_id);
						$stmt->execute();
					}
					else
					{
						$message = $message . "File size is too big for ".$product_name.'<br>';
					}
				}
				else
				{
					$message = $message . "File type should be .jpg, .jpeg or .png for ".$product_name.'<br>';
				}
			}
			else if($file_error===4)
			{
				
			}
			else
			{
				$message = $message . "Error uploading file for ".$product_name.'<br>';
			}
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="js/pagination.js"></script>
		<title>Update Product</title>
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
					<form name="my-form" action="update_product.php" method="POST" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header">Update Product
								<?php
										if($message!=="")
										{
										echo '<label for="for_result" id="result" class="col-md-6 col-form-label text-md-right">'.$message.'</label>';
										}
								?>
							</div>
							<?php while ($row=mysqli_fetch_assoc($result)) : ?>
							<div class="card-body each_table">
								<table class="table table-bordered">
									<tbody>
										<input type="hidden" name="product_id[<?=$row['product_id'];?>]" value="<?=$row['product_id'];?>">
										<tr>
											<td>Product Image:</td>
											<td>
												<img src="images/product_images/<?= $row['image_id']?>" class="products_img">
												<input type="file" id="file" name="product_image_<?=$row['product_id'];?>">
											</td>
										</tr>
										<tr>
											<td>Company Name:</td>
											<td><input type="text" class="form-control" name="company_name[<?=$row['product_id'];?>]" value="<?=$row['company_name'];?>"></td>
										</tr>
										<tr>
											<td>Product Type:</td>
											<td><input type="text" class="form-control" name="product_type[<?=$row['product_id'];?>]" value="<?=$row['product_type'];?>"></td>
										</tr>
										<tr>
											<td>Product Name:</td>
											<td><input type="text" class="form-control" name="product_name[<?=$row['product_id'];?>]" value="<?=$row['product_name'];?>"></td>
										</tr>
										<tr>
											<td>Desciption:</td>
											<td><textarea name="description[<?=$row['product_id'];?>]" class="form-control" required><?=$row['description'];?></textarea>
											</td>
										</tr>
										<tr>
											<td>Category:</td>
											<td>
												<select class="form-control sel_category" name="category_edit[<?=$row['product_id'];?>]">
													<option value="Computers" <?php if($row['category'] == "Computers") echo "SELECTED";?>>Computers</option>
													<option value="Electronics" <?php if($row['category'] == "Electronics") echo "SELECTED";?>>Electronics</option>
													<option value="Software" <?php if($row['category'] == "Software") echo "SELECTED";?>>Software</option>
												</select></td>
											</tr>
											<tr>
												<td>Price ($):</td>
												<td><input type="text" class="form-control" name="price[<?=$row['product_id'];?>]" value="<?=$row['price'];?>"></td>
											</tr>
											<tr>
												<td>Quantity Available:</td>
												<td><input type="text" class="form-control" name="quantity_available[<?=$row['product_id'];?>]" value="<?=$row['quantity_available'];?>"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<?php endwhile;?>
								<div class="pagination-page"></div>
								<script>
									jQuery(function($) {
										// Consider adding an ID to your table
										// incase a second table ever enters the picture.
										var items = $(".each_table");
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
							<div class="form-group row">
								<label class="col-md-4 col-form-label text-md-right" id="result"></label>
							</div>
							<div class="col-md-6 offset-md-4">
								<input type="submit" name="submit" id="submit_edit" value="Update" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</div>
		</body>
	</html>