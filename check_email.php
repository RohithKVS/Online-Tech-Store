<?php 
require 'database.php';
$email = $_POST['email'];
$sql = "SELECT email FROM user_details where email='$email'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
	echo "Email already exists";
}
else
	echo "Does not exists";
?>