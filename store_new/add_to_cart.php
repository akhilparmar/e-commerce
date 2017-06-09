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
		if(!in_array($_REQUEST['pid'], $_SESSION['cart']))
			array_push($_SESSION['cart'], $_REQUEST['pid']);	
			
			
		header("location:".BASEURL."cart.php");	
	}
	else
	{
		$_SESSION['cart'] = array();
		array_push($_SESSION['cart'], $_REQUEST['pid']);
		
		header("location:".BASEURL."cart.php");
	}
}

?>

<?php
//include_once 'footer.php';
?>