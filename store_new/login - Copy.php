<?php
session_start();

if (isset($_SESSION['user_id'])!="") {
	header("Location: index.php");
	exit;
}

require_once 'dbconnect.php';

if (isset($_POST['btn-login'])) {
	
		
	$email = $_POST['email'];
	$password = md5($_POST['password']);	
	$query = mysqli_query($con, "SELECT * FROM user WHERE email='$email' and password='$password'" );
	$result = mysqli_fetch_object($query);
	
	$count = mysqli_num_rows($query); 
	
	// if email/password are correct returns must be 1 row
	
	if ($count > 0) 
	{
		$_SESSION['user_id'] = $result->id;
		header("Location: index.php");
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
	<link rel="stylesheet" href="<?php echo BASEURL; ?>style.css" />
</head>
<body>
<?php
if(isset($msg)){
	echo $msg;
}
?>
<form action="" method="post">
  <div class="container">
  	<h2 style="text-align: center;">Sign In</h2>
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Username" name="email" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" name="btn-login">Login</button>
    <div>Do not have account? <a href="<?php echo BASEURL; ?>register.php">Sign up here</a></div>
    <div><a href="<?php echo BASEURL; ?>forget.php">Forget password ?</a></div>
    
  </div>
</form>



</body>
</html>
