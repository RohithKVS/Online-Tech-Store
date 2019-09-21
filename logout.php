<?php
/* Log out process, unsets and destroys session variables */
session_start();
unset($_SESSION['logged_in']);
session_destroy();
header("Location: login.php");
?>