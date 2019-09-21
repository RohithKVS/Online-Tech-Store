<?php 
require 'database.php';
$_POST=array_map('mysql_real_escape_string',$_POST);

$email = $_POST['email'];

$sql = "SELECT email FROM user_details where email='$email'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
	header("Location:signup.php?error=user");
	exit();
}

$stmt = $conn->prepare("INSERT INTO user_details (first_name, last_name, email, password, address1, address2, city, state, zipcode, country, phone,salt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $firstname, $lastname, $email, $password, $address1, $address2, $city, $state, $zipcode,$country,$phone,$salt);
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$address1=$_POST['line_1'];
$address2=$_POST['line_2'];
$city=$_POST['city'];
$state=$_POST['state'];
$zipcode=$_POST['zipcode'];
$country=$_POST['country'];
$phone=$_POST['phone'];
$salt=mt_rand();
$password = hash('sha256', $salt.hash('sha256',$_POST['pass']));
$stmt->execute();
header("Location:login.php?success");
?>