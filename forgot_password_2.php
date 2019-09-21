<?php
require 'database.php';
	$email=mysqli_real_escape_string($conn,$_POST['email']);
$sql = "SELECT * FROM user_details WHERE email='$email'";
	$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0 ) // User doesn't exist
{
		// User doesn't exist
		header("Location: forgot_password.php?error=invalid");
		exit();
}
	
else
	{
		$str="0947389hnlfdkhasdsfsdfgbnle43rlidohfklsd";
		$str=str_shuffle($str);
		$token=substr($str,0,8);
		$stmt = $conn->prepare("UPDATE user_details SET token=? where email=?");
		$stmt->bind_param("ss", $token, $email);
		$stmt->execute();
		$user =mysqli_fetch_assoc($result);
$first_name = $user['first_name'];
		$host=$_SERVER['HTTP_HOST'];
		
// Send registration confirmation link (reset.php)
$message ="
		Hello $first_name,
		
		You have requested for change of password for your account $email,
		
		Please click the link below to change your password.
		
		https://$host/wpl_project/reset_password.php?token=$token&email=$email

		If the link redirects to the home page, it means the link has already been used to change password. Please request a new link to change the password";
		
			//mail($email,"(noreply)",$message,"From:romi10444@gmail.com\r\n");
}
?>
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
					<h5>A link to reset your password has been sent to your email. Please check your email including spam. If you didn't get the email,<a href="forgot_password.php">Click here</a></h5><br>
					<?php echo $message; ?>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</body>
</html>