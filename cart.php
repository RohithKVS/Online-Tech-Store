<?php
session_start();
if (!isset($_SESSION['logged_in']))
{
	header("location:login.php");
	exit();
}
$product_ids=array();
if(isset($_POST['submit']))
{
	if(isset($_SESSION['shopping_cart']))
	{
		$count=count($_SESSION['shopping_cart']);
		$product_ids=array_column($_SESSION['shopping_cart'], 'id');
		if(!in_array($_GET['id'], $product_ids))
		{
			$_SESSION['shopping_cart'][$count]=array
			(
				'id' => $_GET['id'],
				'name' => $_POST['product_name'],
				'price' => $_POST['price'],
				'quantity' => $_POST['quantity'],
			);
		}
		else
		{
			for($i=0;$i< count($product_ids); $i++)
			{
				if($_GET['id']==$product_ids[$i])
				{
					$_SESSION['shopping_cart'][$i]['quantity']=$_POST['quantity'];
				}
			}
		}
	}
	else
	{
		$_SESSION['shopping_cart'][0]=array
		(
			'id' => $_GET['id'],
			'name' => $_POST['product_name'],
			'price' => $_POST['price'],
			'quantity' => $_POST['quantity'],
		);
	}
	header("Location:product_details.php?success=1&id=".$_GET['id']);
}
if(isset($_GET['id']) && $_GET['action']=='delete')
{
	foreach($_SESSION['shopping_cart'] as $keys => $values)
	{
		if($values['id']==$_GET['id'])
		{
			unset($_SESSION['shopping_cart'][$keys]);
		}
	}
	$_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link href="css/style.css" rel="stylesheet">
		<title>Cart</title>
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
						<div class="card-header">Cart</div>
						<div class="card-body">
							<div class="table-responsive">
								<?php
								if(empty($_SESSION['shopping_cart'])):
									echo 'Cart is empty';
								else:
									$total=0;
								?>
								<table class="table">
									<tr>
										<th>Product Name</th>
										<th>Quantity</th>
										<th>Price ($)</th>
										<th>Total ($)</th>
										<th>Action</th>
									</tr>
									<?php
									foreach($_SESSION['shopping_cart'] as $keys => $values):
									?>
									<tr>
										<td><?php echo $values['name'];?></td>
										<td><?php echo $values['quantity'];?></td>
										<td><?php echo $values['price'];?></td>
										<td><?php echo number_format($values['quantity'] * $values['price'], 2);?></td>
										<td><a href="product_details.php?id=<?=$values['id']?>" class="btn btn-primary">Update</a>&nbsp;<a href="cart.php?action=delete&id=<?php echo $values['id']?>" class="btn btn-primary">Remove</a></td>

									</tr>
									<?php
									$total=$total+($values['quantity'] * $values['price']);
									endforeach;
									?>
									<tr>
										<td colspan="3" align="right">Total ($)</td>
										<td align="right"><?php echo number_format($total,2);?></td>
										<td></td>
									</tr>
									<tr>
										<td>
											<?php
												$loc="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
												if(strpos($loc,'error=exceeded') !==false)
												{
												echo '<label for="for_result" class="col-form-label text-md-right" id="result">Quantity exceeded for '.$_GET['name'].'</label>';
												}
											?>
										</td>
										<td colspan="4" align="center">
											<a href="checkout.php" class="btn btn-primary">Checkout</a>
										</td>
									</tr>
									<?php endif;?>
								</table>
							</div>
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