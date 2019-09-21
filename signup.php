<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link href="css/style.css" rel="stylesheet">
		<title>Sign Up</title>
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
					<a href="login.php" class="links my-2 my-sm-0"><img src="images/account-login.png" class="login_logo">Login</a>
					<a href="signup.php" class="links my-2 my-sm-0"><img src="images/account-login.png" class="login_logo">Sign Up</a>
				</div>
			</nav>
			<br>
			<main class="my-form">
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">Register
								<?php
								$loc="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
								if(strpos($loc,'error=user') !==false)
								{
									echo '<label for="for_result" class="col-md-4 col-form-label text-md-right" id="result">Email address already exists</label>';
								}
								?>
								<label class="col-md-4 col-form-label text-md-right" id="result"></label>
							</div>
							<div class="card-body">
								Fields marked with (*) are mandatory
								<form name="my-form" action="user_register.php" method="POST">
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">First Name*</label>
										<div class="col-md-6">
											<input type="text" placeholder="First Name" id="first_name" class="form-control" name="first_name">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Last Name*</label>
										<div class="col-md-6">
											<input type="text" placeholder="Last Name" id="last_name" class="form-control" name="last_name">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">E-Mail Address*</label>
										<div class="col-md-6">
											<input type="email" placeholder="E-Mail Address" id="email" class="form-control" name="email">
										</div>
										
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Password*</label>
										<div class="col-md-6">
											<input type="password" placeholder="Password" id="pass" class="form-control" name="pass">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Confirm Password*</label>
										<div class="col-md-6">
											<input type="password" placeholder="Confirm Password" id="conf_pass" class="form-control" name="conf_pass">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Address</label>
										<div class="col-md-6 address-div">
											<input type="text" placeholder="Address*" id="line_1" class="form-control" name="line_1">
											<input type="text" placeholder="Address 2" id="line_2" class="form-control" name="line_2">
											<input type="text" placeholder="City*" id="city" class="form-control" name="city">
											<input type="text" placeholder="State*" id="state" class="form-control" name="state">
											<input type="text" placeholder="Zip Code*" id="zipcode" class="form-control" name="zipcode">
											<input type="text" placeholder="Country*" id="country" class="form-control" name="country">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Phone Number*</label>
										<div class="col-md-6">
											<input type="text" placeholder="Phone Number" id="phone" class="form-control" name="phone">
										</div>
									</div>
									<div class="col-md-6 offset-md-4">
										<input type="submit" id="submit" value="Sign Up" class="btn btn-primary">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="js/validate.js"></script>
	</body>
</html>