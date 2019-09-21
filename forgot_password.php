<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link href="css/style.css" rel="stylesheet">
		<title>Forgot Password</title>
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
						<li class="nav-item active">
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
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">Forgot Password</div>
						<div class="card-body">
							<h5>Please enter the registered email address. We will send you a link to reset your password.</h5><br>
							<form name="my-form" action="forgot_password_2.php" method="POST">
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Email address*</label>
									<div class="col-md-6">
										<input type="email" placeholder="Email Address" id="email" class="form-control" name="email" required autofocus>
									</div>
								</div>
								<div class="form-group row">
									<?php
									$loc="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
									if(strpos($loc,'error=invalid') !==false)
									{
									echo "<div id='result'>User does not exists</div>";
									}
									?>
								</div>
								<div class="col-md-6 offset-md-4">
									<input type="submit" id="submit" value="Send my Reset Link" class="btn btn-primary">
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