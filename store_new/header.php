<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Store</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
  	<link rel="stylesheet" href="<?php echo BASEURL.'assets/custom_style.css'; ?>" >

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- logo -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="home.php">Store</a>
	    </div>

	    <!-- Collect the nav links -->
	    <div class="collapse navbar-collapse" id="navbar-collapse-1">
	    
	      <ul class="nav navbar-nav navbar-right">
	      	<li><a href="home.php"> Home</a></li>
	      	<?php 
	      	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
	      	{
				?>
				<li><a href="<?php echo BASEURL.'user_profile.php?uid='.$_SESSION['user_id']; ?>" > Profile</a></li>
				<li><a href="<?php echo BASEURL.'cart.php'; ?>" > Cart(<?php if(!empty($_SESSION['cart'])){ echo count($_SESSION['cart']); }else {echo '0';  } ?>)</a></li>
				<li><a href="logout.php"> Logout</a></li>
				<?php 	
			}
			else
			{
				?>
				<li><a href="<?php echo BASEURL.'cart.php'; ?>" > Cart(<?php if(!empty($_SESSION['cart'])){ echo count($_SESSION['cart']); }else {echo '0';  } ?>)</a></li>
				<li><a href="login.php"> Login</a></li>
				<li><a href="register.php"> register</a></li>
				<?php 
			}
	      	?>
	      </ul>
	    </div>
	  </div>
	</nav>