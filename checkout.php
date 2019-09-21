<?php
require 'database.php';
session_start();

if (!isset($_SESSION['logged_in']))
{
	header("location:login.php");
	exit();
}
else
{
	$curr_date=date("Y-m-d");
	$first_name = $_SESSION['first_name'];
  	$last_name = $_SESSION['last_name'];
  	$email = $_SESSION['email'];
  	foreach($_SESSION['shopping_cart'] as $keys => $values)
	{
		$product_id=$values['id'];
		$quantity_purchased=$values['quantity'];
		$name=$values['name'];
		$sql="SELECT quantity_available from products where product_id=$product_id";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		if($row['quantity_available'] < $quantity_purchased)
		{
			header("location:cart.php?error=exceeded&name=".$name);
			exit();
		}
	}
	
	$str="0947389hnlfdkhasdsfsdfgbnle43rlidohfklsd";
	$str=str_shuffle($str);
	$transaction_id=substr($str,0,10);

	foreach($_SESSION['shopping_cart'] as $keys => $values)
	{
		$product_id=$values['id'];
		$name=$values['name'];
		$quantity_purchased=$values['quantity'];
		$price=$values['price'];
		$stmt = $conn->prepare("INSERT INTO purchase_history (email, product_id, quantity_purchased, date_purchased, transaction_id) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("sssss", $email, $product_id, $quantity_purchased, $curr_date, $transaction_id);
		$stmt->execute();
		$row['quantity_available'] -= $quantity_purchased;
		$stmt = $conn->prepare("UPDATE products SET quantity_available=? WHERE product_id=?");
		$stmt->bind_param("ss", $row['quantity_available'], $product_id);
		$stmt->execute();
	}
	unset($_SESSION['shopping_cart']);
	header("location:afterlogin.php?placed=1&id=".$transaction_id);
}
?>