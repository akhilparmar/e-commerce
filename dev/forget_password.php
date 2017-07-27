<?php
@session_start();


//connectiong to the database
include_once 'dbconnect.php';

if(isset($_POST['send']))
{
	$email = $_POST['email'];
	
	//check if the Emailaddres is available
	$query = mysqli_query($con, "SELECT * FROM user WHERE email='$email' ");
	$result = mysqli_fetch_object($query);
	
	$count = mysqli_num_rows($query); 
	
	// if emaili is correct returns must be 1 row
	if ($count > 0) 
	{
		$subject = "";
		$link = BASEURL."reset_password.php?uid=".$result->id;
		$message = "We recived your request to reset your password <br /> click below link to reset your password: <br />".$link;
		
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <georgesettotest@gmail.com>' . "\r\n" .
					'Reply-To: <georgesettotest@gmail.com>';		
		
		if(mail($email,$subject,$message,$headers,'georgesettotest@gmail.com'))
		{
			$msg = "<div class='alert alert-success'>
					<span class='glyphicon glyphicon-info-sign'></span> An Email with reset password link has been sent to your registerd Email address.
				</div>";	
		}
		else
		{
			$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> Sorry, fail to send mail. Please try again.
				</div>";
		}
		
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> Email not match, Plese enter an email address you are registered with.
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
					<div class="panel-heading text-center">Forget Password</div>
					<div class="panel-body">
						<form action="" method="post">
						
						  <div class="form-group">
						    <label for="exampleInputEmail1">Please enter your registered Email address</label> 
						    <input type="email" class="form-control" placeholder="Enter Username" name="email" required="required" placeholder="Email" />
					 	  </div>
						  
						  <button type="submit" name="send" class="btn btn-primary">Send</button>
						</form>
					</div>
				</div>
			</div>
	</div>
</div>

</body>
</html>