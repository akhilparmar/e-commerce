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
require_once 'admin-header.php';
if(isset($_REQUEST['u_id']) && !empty($_REQUEST['u_id']))
{
	$query = mysqli_query($con, "delete FROM user where id=".$_REQUEST['u_id'] );
	if($query)
	{
		header('Location:'.BASEURL.'/admin/users.php');
	}
}


