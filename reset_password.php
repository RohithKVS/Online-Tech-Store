<?php
if(isset($_POST['submit']))
{
    require 'database.php';
    // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $token=mysqli_real_escape_string($conn,$_POST['token']);
    $salt=mt_rand();
    $password = hash('sha256', $salt.hash('sha256',$_POST['pass']));
    $stmt = $conn->prepare("UPDATE user_details SET password=?, salt=?, token=' ' WHERE email=?");
    $stmt->bind_param("sss", $password, $salt, $email);
    $stmt->execute();
    header("Location:login.php");
    exit();
}

if(isset($_GET['email']) AND isset($_GET['token']))
{
    require 'database.php';
    $email=mysqli_real_escape_string($conn,$_GET['email']);
    $token=mysqli_real_escape_string($conn,$_GET['token']);
    $sql="SELECT * FROM user_details WHERE email='$email' AND token='$token'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) == 0 )
    {
        header("Location:index.php");
        exit();
    }
}
else
{
    echo "<h1>Password reset failed!</h1>";
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet">
        <title>Reset Password</title>
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
            <main class="my-form">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Reset Password</div>
                            <div class="card-body">
                                Fields marked with (*) are mandatory
                                <form name="my-form" action="reset_password.php" method="POST">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Password*</label>
                                        <div class="col-md-6">
                                            <input type="password" placeholder="Password" id="pass" class="form-control" name="pass" required >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Confirm Password*</label>
                                        <div class="col-md-6">
                                            <input type="password" placeholder="Password" id="conf_pass" class="form-control" name="conf_pass" required >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right" id="result"></label>
                                    </div>
                                    <!-- This input field is needed, to get the email of the user -->
                                    <input type="hidden" name="email" value="<?= $email ?>">
                                    <input type="hidden" name="token" value="<?= $token ?>">
                                    <div class="col-md-6 offset-md-4">
                                        <input type="submit" name="submit" id="submit_forgot_password" value="Reset Password" class="btn btn-primary">
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