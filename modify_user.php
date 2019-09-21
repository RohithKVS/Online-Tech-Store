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
	$email = $_SESSION['email'];
	$firstname = $_POST['first_name'];
	$lastname = $_POST['last_name'];
	$address1=$_POST['line_1'];
	$address2=$_POST['line_2'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zipcode=$_POST['zipcode'];
	$country=$_POST['country'];
	$phone=$_POST['phone'];
	$stmt = $conn->prepare("UPDATE user_details SET first_name=? , last_name=? , address1=? , address2=? , city=? , state=? , zipcode=? , country=? , phone=? where email=?");
	$stmt->bind_param("ssssssssss", $firstname, $lastname, $address1, $address2, $city, $state, $zipcode,$country,$phone, $email);
	$stmt->execute();
	header("Location:afterlogin.php");
}
?>