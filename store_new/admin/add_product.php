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

if(isset($_POST['add_product']))
{
	$filename= '';
	if(isset($_FILES))
	{
		$target_dir = dirname(dirname(__FILE__))."/assets/images/";
		$target_file = $target_dir . basename($_FILES["product_img"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			// Check file size
		if ($_FILES["product_img"]["size"] > 5000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}	
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {
		    	$filename = $_FILES["product_img"]['name'];
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}
	
	
	
	$query = mysqli_query($con, "Insert into products values('null', '".$_POST['name']."', '".$filename."', '".$_POST['cat_id']."', '".$_POST['price']."', '".$_POST['qty']."', '".$_POST['description']."')" );	
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="right-column">
	<div class="section_title">
		<h2>Add Product</h2>
	</div>
	<!-- Main content -->
	<section class="content">
	  	<div class="row">
        	<form action="" method="post" enctype="multipart/form-data">
	      <div class="modal-body">
				<div class="box box-success">
					
					<div class="box-body">
					  	<input class="form-control" name="name" placeholder="Name" type="text"><br />
					  	
					  	<?php
							//select users data
							$parent_categories = mysqli_query($con, "SELECT * FROM categories" );
							$count = mysqli_num_rows($parent_categories); 
							
						?>
					  	
						<select name="cat_id" class="form-control">
							<option value="0">Select parent category</option>
							<?php while($parent_cat = mysqli_fetch_object($parent_categories)){
								  ?>
								<option value="<?php echo $parent_cat->id; ?>"><?php echo $parent_cat->name; ?></option>
							<?php } ?>
						</select>
						<br />
						<input class="form-control" type="file" name="product_img" /> <br />
						<input class="form-control" name="price" placeholder="Price" type="text"><br />
						<input class="form-control" name="qty" placeholder="Qualtity" type="text"><br />
						<textarea class="form-control" name="description" placeholder="Description"></textarea>
					</div>
					
					<!-- /.box-body -->
				</div>
	      </div>
	      <div class="modal-footer">
	        <button class="btn btn-primary" type="submit" name="add_product" value="Add" class="btn btn-primary">Save </button>
	      </div>
	      </form>
        
      	</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
