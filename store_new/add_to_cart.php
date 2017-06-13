<?php
@session_start();

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
}

include_once 'dbconnect.php';
//include_once 'header.php';

if(isset($_REQUEST['pid']) && !empty($_REQUEST['pid']))
{
	if(!empty($_SESSION['cart']))
	{	
		if(!array_key_exists ($_REQUEST['pid'] , $_SESSION['cart']))
		{
			$cart_item = array();
			$cart_item['id'] = $_REQUEST['pid'];
			$cart_item['qty'] = 1;
			$_SESSION['cart'][$_REQUEST['pid']] = $cart_item;
		}
		else
		{
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
	else
	{
		$_SESSION['cart'] = array();
		$cart_item = array();
		$cart_item['id'] = $_REQUEST['pid'];
		$cart_item['qty'] = 1;
		$_SESSION['cart'][$_REQUEST['pid']] = $cart_item;
		
		//redirect to cart
		header("location:".BASEURL."cart.php");
	}
}

?>

<?php
//include_once 'footer.php';
?>