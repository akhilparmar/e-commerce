<?php
	//including database connection
	include_once 'dbconnect.php';
	
  	require_once('stripe/init.php');
  
	$stripe = array(
	    "secret_key"      => "sk_test_yrMzZkvPxkgJcGSUOHJdzATw",
  		"publishable_key" => "pk_test_gld0ORF92yZEasbSA0xNgNgw"
	);

	\Stripe\Stripe::setApiKey($stripe['secret_key']);
	
	if(isset($_POST['stripeToken']))
	{
		$token  = $_POST['stripeToken'];

		// Charge the user's card:
		$charge = \Stripe\Charge::create(array(
		  "amount" => $_POST['stripeAmount'],
		  "currency" => "cad",
		  "description" => "card Payment",
		  "capture" => false,
		  "source" => $token,
		));
		echo '<h1>Thank you, Your Order has been placed Successfully.. </h1>';
		echo '<a href="'.BASEURL.'" class="btn btn-default"><i class="fa fa-chevron-left"></i> Go back to shop</a>';
		
		header("location:".BASEURL.'?clear_cart=1');
	}
	exit;
?>