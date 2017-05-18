<?php
session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])!="") {
	header("Location: home.php");
	exit;
}

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
		header("Location: home.php");
	} else {
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
				</div>";
	}
	
}
?>


<?php   
//including header and navigation
include "includes/header.php";
include "includes/nav.php";
?>


<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Sign In.</h2><hr />
        
        <?php
		if(isset($msg)){
			echo $msg;
		}
		?>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="email" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
			</button> 
            
            <a href="register.php" class="btn btn-default" style="float:right;">Sign UP Here</a>
            
        </div>  
        
        
      
      </form>

    </div>
    
</div>

<?php include "includes/footer.php"; ?>