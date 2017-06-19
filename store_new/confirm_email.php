<?php
@session_start();

//redirect to home page if the session is set
if (isset($_SESSION['user_id'])!="") {
	header("Location: home.php");
	exit;
}

//including database connection
require_once 'dbconnect.php';


//if the request parameters are set
if(isset($_REQUEST['uname'])!="" && isset($_REQUEST['email'])!="" && isset($_REQUEST['upass'])!="" )
{
	$uname = $_REQUEST['uname'];
	$email = $_REQUEST['email'];
	$upass = $_REQUEST['upass'];
	
	//create an hased md5 password
	$hashed_password = md5($upass); 
	
	
	//insert the data if the email not found	
	$query = mysqli_query($con, "INSERT INTO user(name,email,password) VALUES('$uname','$email','$hashed_password')");

	if ($query) {
		$msg = "<div class='alert alert-success'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
				</div>";
		//redirect to login page..
		header("location:".BASEURL."login.php");
	}else {
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
				</div>";
		//redirect to login page..
		header("location:".BASEURL."login.php");
	}
}
else
{
	//redirect to login page..
	header("location:".BASEURL."login.php");
}
		
	
	
?>