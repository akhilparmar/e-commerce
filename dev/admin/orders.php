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
$query = mysqli_query($con, "SELECT * FROM orders order by id DESC" );
$count = mysqli_num_rows($query); 
?>


	<div class="right-column">

	<div class="section_title">
		<h2>orders</h2>
		<div class="col-md-6 pull-right">
			<form action="" method="post">
      			<input name="search_key" value="" placeholder="search" /><input type="submit" name="search" value="search">
      		</form>
		</div>
	</div>
	<!-- Main content -->
	<section class="content">
	  	<div class="row">
        <div class="col-xs-12">
          <div class="box">
          
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
							    	<th>User</th>
							        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Products</th>
							        <th>Shipping Method</th>
							        <th>order Total</th>
							    </tr>
							</thead>
							<tbody>
							<?php 
							$search_count = 0;
							if(isset($_POST['search']))
							{ 
						
								$search_query = mysqli_query($con, "SELECT o.*,u.name FROM orders as o join user as u on o.user_id = u.id WHERE o.id Like '".$_POST['search_key']."%' OR u.name LIKE '".$_POST['search_key']."%'" );
								$search_count = mysqli_num_rows($search_query); 
				
							
							?>
							<?php if($search_count > 0){ ?>
								<?php 
									$sr_no = 1;
									while($result = mysqli_fetch_object($search_query)){ 
								?>    
								    
								    <tr role="row">
										<td class=""><?php echo $sr_no; ?></td>
										<td class="">
											<?php 
											$user_detail_query = mysqli_query($con, "SELECT * FROM user where id=".$result->user_id);	
											$user_detail = mysqli_fetch_object($user_detail_query);
											
											echo $user_detail->name;
											?>
										</td>
										<td class="sorting_1">
											<?php
											$products = json_decode($result->product_id);
											
										 	foreach($products as $product)
										 	{
										 		$product_detail_query = mysqli_query($con, "SELECT * FROM products where id=".$product);	
										 		$product_detail = mysqli_fetch_object($product_detail_query);
												echo '-'.$product_detail->name.'<br /><br />';
											}
											?>
										</td>
										
										<td class="sorting_1"><?php echo $result->shipping_method	; ?></td>
										<td class="sorting_1"><?php echo $result->total	; ?></td>
								    </tr>
								<?php 
								$sr_no++;
								}//end-while 
								?>
							    <?php 
								  }
								  else
								  { 
								?>
								<tr role="row" class="odd">
									<td colspan="5"  class="">No Results found</td>
								</tr>
							<?php }//end else 
							}
							else
							{ ?>
							<?php if($count > 0){ ?>
								<?php 
									$sr_no = 1;
									while($result = mysqli_fetch_object($query)){ 
								?>    
								    
								    <tr role="row">
										<td class=""><?php echo $sr_no; ?></td>
										<td class="">
											<?php 
											$user_detail_query = mysqli_query($con, "SELECT * FROM user where id=".$result->user_id);	
											$user_detail = mysqli_fetch_object($user_detail_query);
											
											echo $user_detail->name;
											?>
										</td>
										<td class="sorting_1">
											<?php
											$products = json_decode($result->product_id);
											
										 	foreach($products as $product)
										 	{
										 		$product_detail_query = mysqli_query($con, "SELECT * FROM products where id=".$product);	
										 		$product_detail = mysqli_fetch_object($product_detail_query);
												echo '-'.$product_detail->name.'<br /><br />';
											}
											?>
										</td>
										
										<td class="sorting_1"><?php echo $result->shipping_method	; ?></td>
										<td class="sorting_1"><?php echo $result->total	; ?></td>
								    </tr>
								<?php 
								$sr_no++;
								}//end-while 
								?>
							    <?php 
								  }
								  else
								  { 
								?>
								<tr role="row" class="odd">
									<td colspan="5"  class="">No Results found</td>
								</tr>
							<?php }//end else 
							}//end else 
							?>
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


