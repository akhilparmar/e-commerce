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
	$user_query = mysqli_query($con, "SELECT * FROM user where id=".$_REQUEST['u_id'] );
	$count = mysqli_num_rows($user_query); 

	if($count > 0)
	{
		$user_detail = mysqli_fetch_object($user_query);
	}
}



if(isset($_POST['update_user']))
{

	$update_user = mysqli_query($con, "update user set name='".$_POST['name']."', email='".$_POST['email']."' where id=".$_POST['user_id'] );	
	if($update_user)
	{
		header('Location:'.BASEURL.'/admin/users.php');
	}
}
	
?>



<!-- Content Wrapper. Contains page content -->
<div class="right-column">
	<div class="section_title">
		<h2>Edit Product</h2>
	</div>
	<!-- Main content -->
	<section class="content">
	  	<div class="row">
        	<form action="" method="post" enctype="multipart/form-data">
	      <div class="modal-body">
				<div class="box box-success">
					
					<div class="box-body">
						<input class="form-control" type="hidden" name="user_id" value="<?php if(!empty($user_detail->id)){echo $user_detail->id;} ?>" />
					  	<input class="form-control" name="name" value="<?php if(!empty($user_detail->name)){echo $user_detail->name;} ?>" placeholder="Name" type="text" /><br />
						<input class="form-control" value="<?php if(!empty($user_detail->email)){echo $user_detail->email;} ?>" name="email" placeholder="Email address" type="text" /><br />						
					</div>
					
					<!-- /.box-body -->
				</div>
	      </div>
	      <div class="modal-footer">
	        <button class="btn btn-primary" type="submit" name="update_user" value="Add" class="btn btn-primary">Save</button>
	      </div>
	      </form>
        
      	</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
