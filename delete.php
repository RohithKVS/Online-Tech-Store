<?php 
require 'database.php';
$id=$_GET['id'];
$stmt = $conn->prepare("UPDATE products SET deleted=1 where product_id=?");
$stmt->bind_param("s", $id);
$stmt->execute();
header("location:delete_product.php");
?>