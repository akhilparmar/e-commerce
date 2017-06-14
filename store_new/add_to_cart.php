<?php
@session_start();

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
}
//include the databse connection
include_once 'dbconnect.php';

//if there a parameter set in query string
if(isset($_REQUEST['pid']) && !empty($_REQUEST['pid']))
{
	//if the cart is not empty
	if(!empty($_SESSION['cart']))
	{	
		if(!array_key_exists ($_REQUEST['pid'] , $_SESSION['cart']))
		{
			//if the item is not in the cart add it to the cart
			$cart_item = array();
			$cart_item['id'] = $_REQUEST['pid'];
			$cart_item['qty'] = 1;
			
			// adding item to the cart
			$_SESSION['cart'][$_REQUEST['pid']] = $cart_item;
		}
		else
		{
			//if the item is already in the caert, increase the quantity
			foreach($_SESSION['cart'] as $item)
			{
				if($item['id'] == $_REQUEST['pid'])
				{
					$_SESSION['cart'][$item['id']]['qty'] += 1; 		
				}
			} 
		}
		header("location:".BASEURL."cart.php");	
	}
	else//if the cart is empty
	{
		/*deffining cart array*/
		$_SESSION['cart'] = array();
		//defining array for the item to add in the cart
		$cart_item = array();
		$cart_item['id'] = $_REQUEST['pid'];
		$cart_item['qty'] = 1;
		
		// adding the item to the cart
		$_SESSION['cart'][$_REQUEST['pid']] = $cart_item;
		
		//redirect to cart
		header("location:".BASEURL."cart.php");
	}
}

?>

<?php
//include_once 'footer.php';
?>