<<?php @session_start(); ?>

<style>
.box-body table td, .box-body table th
{
	padding: 10px 20px;
	border: 1px solid rgba(0,0,0,0.2);
}
.content
{
	padding: 30px;
}

.section_title h2
{
	padding: 0 30px;
}
</style>

<?php
/*if (isset($_SESSION['userSession'])!="") {
	header("Location: home.php");
	exit;
}*/
require_once 'admin-header.php';

if(isset($_REQUEST['c_id']) && !empty($_REQUEST['c_id']))
{
	$query = mysqli_query($con, "delete FROM categories where id=".$_REQUEST['c_id'] );
	
	if($query)
	{
		header('Location:'.BASEURL.'/admin/category.php');
	}
}


