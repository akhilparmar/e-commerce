<?php
session_start();

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
} 
else if (isset($_SESSION['user_id'])!="") {
	session_destroy();
	unset($_SESSION['user_id']);
	header("Location: login.php");
}