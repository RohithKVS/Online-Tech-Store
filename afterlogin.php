<?php
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
$sql="SELECT * from products where deleted=0 LIMIT 0,5";
$result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <title>Welcome <?= $first_name.' '.$last_name?></title>
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
          <div class="alert alert-info alert-dismissible fade show" role="alert">Welcome <?= $first_name.' '.$last_name?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php
          if(isset($_GET['placed']))
          {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Order placed successfully. Your transaction ID is '.$_GET['id'].'. Please keep this for future reference.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
          }
          ?>
          <br>
          <h4 align="center">Here are our mostly viewed products</h4>
          <?php while ($row=mysqli_fetch_assoc($result)) : ?>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4"><a href="product_details.php?id=<?=$row['product_id']?>"><img src="images/product_images/<?= $row['image_id']?>" class="products_img"></a>
              </div>
              <div class="col-md-4">
                <a href="product_details.php?id=<?=$row['product_id']?>" class="product"><h4><?= $row['product_name']?></h4></a><br><h5>Price ($): <?= $row['price']?></h5>
              </div>
            </div>
          </div>
        </div>
        <?php endwhile ;?>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>