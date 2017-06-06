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

if(isset($_REQUEST['p_id']) && !empty($_REQUEST['p_id']))
{
	$query = mysqli_query($con, "SELECT * FROM products where id=".$_REQUEST['p_id'] );
	$count = mysqli_num_rows($query); 

	if($count > 0)
	{
		$product_detail = mysqli_fetch_object($query);
	}
}



if(isset($_POST['update_product']))
{
	$filename= '';
	if(isset($_FILES['product_img']['name']) && !empty($_FILES['product_img']['name']))
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
	
	$update_product = mysqli_query($con, "update products set name='".$_POST['name']."', cat_id='".$_POST['cat_id']."', price='".$_POST['price']."', qty='".$_POST['qty']."', description='".$_POST['description']."' where id=".$_POST['product_id'] );	
	
	
	if(!empty($filename))
	{
		$update_image = mysqli_query($con, "update products set image='".$filename."' where id=".$_POST['product_id'] );	
		if($update_image && $update_product)
		{
			$dir = dirname(dirname(__FILE__))."/assets/images/";
			unlink($dir.$product_detail->image);
			header('Location:'.BASEURL.'/admin/products.php');
		}
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
						<input class="form-control" type="hidden" name="product_id" value="<?php if(!empty($product_detail->id)){echo $product_detail->id;} ?>" placeholder="Name" />
					  	<input class="form-control" name="name" value="<?php if(!empty($product_detail->name)){echo $product_detail->name;} ?>" placeholder="Name" type="text"><br />
					  	
					  	<?php
							//select users data
							$parent_categories = mysqli_query($con, "SELECT * FROM categories" );
							$count = mysqli_num_rows($parent_categories); 
						?>
					  	
						<select name="cat_id" class="form-control">
							<option value="0">Select category</option>
							<?php while($parent_cat = mysqli_fetch_object($parent_categories)){
								  ?>
								<option <?php if($product_detail->cat_id == $parent_cat->id){echo 'selected';}else{echo '';} ?> value="<?php echo $parent_cat->id; ?>"><?php echo $parent_cat->name; ?></option>
							<?php } ?>
						</select>
						<br />
						<input class="form-control" type="file" name="product_img" /> <br />
						<input class="form-control" value="<?php if(!empty($product_detail->price)){echo $product_detail->price;} ?>" name="price" placeholder="Price" type="text"><br />
						<input class="form-control" value="<?php if(!empty($product_detail->qty)){echo $product_detail->qty;} ?>" name="qty" placeholder="Qualtity" type="text"><br />
						<textarea class="form-control" name="description" placeholder="Description"><?php if(!empty($product_detail->description)){echo $product_detail->description;} ?></textarea>
					</div>
					
					<!-- /.box-body -->
				</div>
	      </div>
	      <div class="modal-footer">
	        <button class="btn btn-primary" type="submit" name="update_product" value="Add" class="btn btn-primary">Save </button>
	      </div>
	      </form>
        
      	</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
