<?php 
$servername = "localhost";
$username = "rohith";
$password = "rohith";
$dbname = "online_tech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>