<?php
@session_start();
ini_set('display_errors', 1);
//including database connection
require_once 'dbconnect.php';

if(!isset($_REQUEST['uid']))
{
	//redirect to login if ther user id is not set
	header('location:'.BASEURL.'login.php');
}


//if there is post request from reset form 
if(isset($_POST['btn-reset'])) {
	$pass = $_POST['password'];
	$cpass = $_POST['cpassword'];
	if($pass == $cpass)
	{
		//create an hased md5 password
		$hashed_password = md5($pass); 
		
			//insert the data if the email not found	
			$query = mysqli_query($con, "UPDATE user set password = '".$hashed_password."' where id=".$_REQUEST['uid']);

			if ($query) {
				$msg = "<div class='alert alert-success'>
							<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
						</div>";
					
				header("location:".BASEURL.'login.php');
			}else {
				$msg = "<div class='alert alert-danger'>
							<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while reset password !
						</div>";
			}
			
		
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
				<span class='glyphicon glyphicon-info-sign'></span> &nbsp; 
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
								  <div class="form-group">
								    <label>Password</label>
								    <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
								  </div>
							  </div>
							  <div class="form-group">
								  <div class="form-group">
								    <label>Confirm Password</label>
								    <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" required>
								  </div>
							  </div>
							  <button type="submit" name="btn-reset" class="signupbtn btn btn-primary">Reset</button>
							</form>
						</div>
					</div>
				</div>
		</div>
	</div>
</body>
</html>