<?php
@session_start();

//redirect to home page if the session is set
if (isset($_SESSION['user_id'])!="") {
	header("Location: home.php");
	exit;
}

//including database connection
require_once 'dbconnect.php';


//if there is post request frm login form 
if (isset($_POST['btn-login'])) {
	
		
	$email = $_POST['email'];
	$password = md5($_POST['password']);	
	//check if the username and password is right
	$query = mysqli_query($con, "SELECT * FROM user WHERE email='$email' and password='$password'" );
	$result = mysqli_fetch_object($query);
	
	$count = mysqli_num_rows($query); 
	
	// if email/password are correct returns must be 1 row
	if ($count > 0) 
	{
		$_SESSION['user_id'] = $result->id;
		header("Location: home.php");
	} else {
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
				</div>";
	}
	
}
?>




<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	
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
				<?php
				if(isset($msg)){
					echo $msg;
				}
				?>
				<div class="panel panel-primary">
					<div class="panel-heading text-center">Sign In</div>
					<div class="panel-body">
						<form action="" method="post">
						  <div class="form-group">
						    <label for="exampleInputEmail1">Email address</label>
						    <input type="email" class="form-control" placeholder="Enter Username" name="email" required="required" placeholder="Email" />
						  </div>
						  <div class="form-group">
						    <label for="exampleInputPassword1">Password</label>
						    <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
						  </div>
						  <button type="submit" name="btn-login" class="btn btn-primary">Login</button>
						  <br />
						  <br />
						  
						  <div>Do not have account? <a href="<?php echo BASEURL; ?>register.php">Sign up here</a></div>
						  <br />
						  <a href="forget_password.php">Forget password ?</a>
						</form>
					</div>
				</div>
			</div>
	</div>
</div>

</body>
</html>
