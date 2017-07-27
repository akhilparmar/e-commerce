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
	header("Location: index.php");
	exit;
}*/
require_once 'admin-header.php';

if(isset($_REQUEST['c_id']) && !empty($_REQUEST['c_id']))
{
	$query = mysqli_query($con, "SELECT * FROM categories where id=".$_REQUEST['c_id'] );
	$count = mysqli_num_rows($query); 
	if($count > 0)
	{
		$category_detail = mysqli_fetch_object($query);
	}
}


if(isset($_POST['update_category']))
{
	 $query = mysqli_query($con, "update categories set name='".$_POST['name']."', parent_id='".$_POST['category']."' where id=".$_REQUEST['c_id']);
	 if($query)
	 {
	 	header('Location:'.BASEURL.'/admin/category.php');
	 }
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="right-column">
	<div class="section_title">
		<h2>Add Categories</h2>
	</div>
	<!-- Main content -->
	<section class="content">
	  	<div class="row">
        	<form action="" method="post">
	      	<div class="modal-body">
				<div class="box box-success">
					
					<div class="box-body">
					  	<input class="form-control" name="name" placeholder="Category name" value="<?php echo $category_detail->name; ?>" type="text"><br />
					  	
					  	<?php
							//select users data
							$parent_categories = mysqli_query($con, "SELECT * FROM categories" );
							$count = mysqli_num_rows($parent_categories); 
							
						?>
					  	
						<select name="category" class="form-control">
							<option value="0">Select parent category</option>
							<?php while($parent_cat = mysqli_fetch_object($parent_categories)){
								  ?>
								<option <?php if($category_detail->parent_id == $parent_cat->id){echo "selected";}else{echo "";} ?> value="<?php echo $parent_cat->id; ?>"><?php echo $parent_cat->name; ?></option>
							<?php } ?>
						</select>
						<br />
					</div>
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn-primary" name="update_category" value="Add">Save</button>
	      </div>
	      </form>
        
      	</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
