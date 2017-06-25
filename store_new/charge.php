<?php
  	require_once('stripe/init.php');
  
	$stripe = array(
	  "secret_key"      => "sk_test_cMlxLKaCbnQzmmaUZ37Aut2k",
	  "publishable_key" => "pk_test_0NyWbVxpODl39Wku273mi1Ot"
	);

	\Stripe\Stripe::setApiKey($stripe['secret_key']);

	if(isset($_POST['stripeToken']))
	{
		$token  = $_POST['stripeToken'];

		$customer = \Stripe\Customer::create(array(
		  'email' => $_POST['stripeEmail'],
		  'source'  => $token
		));

		$charge = \Stripe\Charge::create(array(
		  'customer' => $customer->id,
		  'amount'   => $_POST['stripeAmount'],
		  'currency' => 'cdn'
		));

		echo '<h1>Thank you, Your Order has been placed Successfully.. </h1>';
		echo '<a href="<?php echo BASEURL; ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Go back to shop</a>';
	}
?>