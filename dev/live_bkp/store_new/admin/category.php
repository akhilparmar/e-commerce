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
?>
<!-- Content Wrapper. Contains page content -->
<div class="right-column">
	<div class="section_title">
		<h2>Categories</h2>
	</div>
	<!-- Main content -->
	<section class="content">
	  	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="add_category.php">+ Add New Category</a>
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
							        <th class="sorting_desc" tabindex="0"  rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending">Name</th>
							        <th class="sorting_desc" tabindex="0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending">Parent Category</th>
							        <th colspan="2">Action</th>
							    </tr>
							</thead>
							<tbody>
							<?php
							//select users data
							$category = mysqli_query($con, "SELECT * FROM categories" );
							$count = mysqli_num_rows($category); 
							?>
							<?php if($count > 0){ ?>
								<?php 
									$sr_no = 1;
									while($result = mysqli_fetch_object($category)){ 
								?>    
								    
								    <tr role="row">
										<td class=""><?php echo $sr_no; ?></td>
										<td class="sorting_1"><?php echo $result->name; ?></td>
										<td class="sorting_1">
										<?php 
										if($result->parent_id != 0)
										{
											$parent = mysqli_query($con, "SELECT name FROM categories where id=".$result->parent_id );
											$parent_category = mysqli_fetch_object($parent);
											if(!empty($parent_category->name))
											{
												echo $parent_category->name; 		
											}
											else
											{
												echo "--";
											}
										}
										else
										{
											echo '---';
										}
										?>
										</td>
										<td class="sorting_1"><a href="edit_category.php?c_id=<?php echo $result->id; ?>">Edit</a></td>
										<td class="sorting_1"><a href="delete_category.php?c_id=<?php echo $result->id; ?>">Delete</a></td>
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
