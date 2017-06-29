<?php @session_start(); ?>

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

//select users data
$query = mysqli_query($con, "SELECT * FROM products" );
$count = mysqli_num_rows($query); 
?>


	<div class="right-column">

	<div class="section_title">
		<h2>Products</h2>
	</div>
	<!-- Main content -->
	<section class="content">
	  	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="add_product.php">+ Add New Product</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
				  <div class="col-sm-6"></div>
				  <div class="col-sm-6"></div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
							<thead>
							    <tr role="row">
							    	<th>Sr. no.</th>
							        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Image</th>
							        <th class="sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending">Name</th>
							        <th>category</th>
							        <th>Price</th>
							        <th>Quantity</th>
							        <th colspan="2">Action</th>
							    </tr>
							</thead>
							<tbody>
							<?php if($count > 0){ ?>
								<?php 
									$sr_no = 1;
									while($result = mysqli_fetch_object($query)){ 
									
										$category = mysqli_query($con, "SELECT * FROM categories where id=".$result->cat_id );
										$count = mysqli_num_rows($category); 		
										$category_result = mysqli_fetch_object($category)
									
								?>    
								    
								    <tr role="row">
										<td class=""><?php echo $sr_no; ?></td>
										<td class=""><img height="100" src="<?php echo BASEURL.'assets/images/'.$result->image; ?>" /></td>
										<td class="sorting_1"><?php echo $result->name	; ?></td>
										<td class="sorting_1"><?php if(!empty($category_result->name)){echo $category_result->name;} ?></td>
										<td class="sorting_1"><?php echo $result->price	; ?></td>
										<td class="sorting_1"><?php echo $result->qty	; ?></td>
										<td class="sorting_1"><a href="edit_product.php?p_id=<?php echo $result->id; ?>">Edit</a></td>
										<td class="sorting_1"><a href="delete_product.php?p_id=<?php echo $result->id; ?>">Delete</a></td>
								    </tr>
								<?php $sr_no++;}//end-while ?>
							    <?php 
								  }
								  else
								  { 
								?>
								<tr role="row" class="odd">
									<td  class="">No Results found</td>
								</tr>
							<?php }//end else ?>
							</tbody>

						</table>
					</div>
				</div>

				</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
	</section>
	<!-- /.content -->
	
</div>
<!-- /.content-wrapper -->


