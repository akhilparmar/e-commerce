<?php
session_start();
if (isset($_SESSION['admin_user_id'])!="") {
	header("Location: dashboard.php");
	exit;
}

require_once '../dbconnect.php';

if (isset($_POST['btn-login'])) {
	
		
	$username = $_POST['username'];
	$password = $_POST['password'];	
	
	if ($username == 'admin' && $password == 'admin') 
	{
		$_SESSION['admin_user_id'] = $username;
		header("Location: dashboard.php");
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
  	<h2 style="text-align: center;">Admin Login</h2>
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" name="btn-login">Login</button>
    <div><a href="<?php echo BASEURL; ?>forget.php">Forget password ?</a></div>
    
  </div>
</form>



</body>
</html>
