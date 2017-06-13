<?php
session_start();
if (isset($_SESSION['user_id'])!="") {
	header("Location: home.php");
}
require_once 'dbconnect.php';

if(isset($_POST['btn-signup'])) {
	$uname = $_POST['username'];
	$email = $_POST['email'];
	$upass = $_POST['password'];
	
	$hashed_password = md5($upass); 
	// this function works only in PHP 5.5 or latest version
	
	$check_email = mysqli_query($con, "SELECT email FROM user WHERE email='$email'");
	$count = mysqli_num_rows($check_email);
	
	if ($count==0) {
		
		$query = mysqli_query($con, "INSERT INTO user(name,email,password) VALUES('$uname','$email','$hashed_password')");

		if ($query) {
			$msg = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
					</div>";
		}else {
			$msg = "<div class='alert alert-danger'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
					</div>";
		}
		
	} else {
		
		
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken !
				</div>";
			
	}	
	
}
?>


<!DOCTYPE html>
<html>


<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<!--<link rel="stylesheet" href="<?php echo BASEURL; ?>style.css" />-->
	
	<style>
	body{
		background:url('assets/images/background.jpg');	
	} 
	.wrapper
	{
		height:100%;
		width: 100%;
		background-color:rgba(0,0,0,0.5);
		z-index:-1; 
		top: 0;
		left: 0;
		position: absolute;
	}
	.login-area
	{
		margin-top: 150px;
	}
	</style>
</head>
<body>
	<div class="wrapper"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 login-area">
					<div class="panel panel-primary">
						<div class="panel-heading text-center">Sign In</div>
						<div class="panel-body">
							<form action="" method="post">
							  <div class="form-group">
							    <label for="exampleInputEmail1">Username</label>
							    <input type="text" class="form-control" placeholder="Enter username" name="username" required="required">
							  </div>
							  
							  <div class="form-group">
							    <label for="exampleInputEmail1">Email address</label>
							    <input type="text" class="form-control" placeholder="Enter Email" name="email" required="required">
							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1">Password</label>
							    <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
							  </div>
							  <button type="submit" name="btn-signup" class="signupbtn btn btn-primary">Sign Up</button>
							  <br />
							  <br />
							  
							  <div>Already have account? <a href="<?php echo BASEURL; ?>login.php">Sign in here</a></div>
							</form>
						</div>
					</div>
				</div>
		</div>
	</div>
</body>
</html>