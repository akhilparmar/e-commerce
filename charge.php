<?php
session_start();

	//including database connection
	include_once 'dev/dbconnect.php';
	
  	require_once('dev/stripe/init.php');
  
	$stripe = array(
	    "secret_key"      => "sk_test_4wOFJ0Nc8GBEH9WlrIkxGifz",
  		"publishable_key" => "pk_test_fCgOGtUXuAWf44TdWl3liZOd"
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
		echo '<h1>Your order Has been placed successfully. You can check your order in your profile... </h1>';
		echo '<a href="'.BASEURL.'" class="btn btn-default"><i class="fa fa-chevron-left"></i> Go back to shop</a>';
		
		foreach($_SESSION['cart'] as $key=>$cart_item)
		{
			if($key != 'shipping_details')
			{
				$products[] = $key;
			}
		}
		$order_total = number_format((float)$_POST['order_total'], 2, '.', '');
				
		$query = mysqli_query($con, "INSERT INTO orders (`user_id`, `product_id`, `shipping_method`, `total`, `created_date`) values('".$_SESSION['user_id']."', '".json_encode($products)."', '".$_SESSION['cart']['shipping_details']['name']."', '".$order_total."', '".date('d-m-y')."')" );	
		if($query)
		{
			$query = mysqli_query($con, "SELECT * FROM user WHERE id =".$_SESSION['user_id']);
			$result = mysqli_fetch_object($query);
			
			$email = $result->email;
			$subject = "Order Successfull";
			$message = "Congratulations.. <br /> Your order Has been placed successfully. You can check your order in your profile. <br />";
			
			// set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			//$headers .= 'From: nevilgolwala@gmail.com' . "\r\n"; 
			$headers .= 'From: <georgesettotest@gmail.com>' . "\r\n" .
						'Reply-To: <georgesettotest@gmail.com>';		
			mail($email,$subject,$message,$headers,'-fwebmaster@example.com');
			
			header("refresh:5;url=".BASEURL.'?clear_cart=1');	
		}
		
	}
	exit;
?>
?>