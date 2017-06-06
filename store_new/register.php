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
	<link rel="stylesheet" href="<?php echo BASEURL; ?>style.css" />
</head>
<body>
		<form action="" method="post">
		  <div class="container">
		  	<h2 style="text-align: center;">Signup Form</h2>
		    <label><b>Username</b></label>
		    <input type="text" placeholder="Enter username" name="username" required>
		    
		    <label><b>Email</b></label>
		    <input type="text" placeholder="Enter Email" name="email" required>

		    <label><b>Password</b></label>
		    <input type="password" placeholder="Enter Password" name="password" required>
		   
		    <div class="clearfix">
		      <button type="submit" name="btn-signup" class="signupbtn">Sign Up</button>
		    </div>
		    <div>Already have account? <a href="<?php echo BASEURL; ?>register.php">Sign in here</a></div>
		  </div>
		</form>
</body>
</html>