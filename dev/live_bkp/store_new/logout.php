<?php
@session_start();

//if te session is not set then go to login
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
} 
else if (isset($_SESSION['user_id'])!="") {
	//destroy the session 
	session_destroy();
	unset($_SESSION['user_id']);
	
	//redirect to login page
	header("Location: login.php");
}