<?php
session_start();

require 'database.php';

//To prevent SQL Injections
$email =mysqli_real_escape_string($conn,$_POST['email']);
$admins = array("rohith@gmail.com", "chaitanya@gmail.com", "saikumar@gmail.com");
/* User login process, checks if user exists and password is correct */
$sql = "SELECT * FROM user_details where email='$email'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 0)
{
    header("Location:login.php?error=invalid");
    exit();
}
else 
{	// User exists
    $user =mysqli_fetch_assoc($result);
	$pass=$user['password'];
    $password = hash('sha256', $user['salt'].hash('sha256',$_POST['pass']));	
    if ($pass != $password)
	{
		header("Location: login.php?error=invalid");
		exit();
    }
	
    else 
	{
        if(in_array($user['email'], $admins))
        {
            $_SESSION['admin']=true;
        }
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
		
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: afterlogin.php");
    }
}
?>