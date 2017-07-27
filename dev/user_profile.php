<?php
@session_start();


//connectiong to the database
include_once 'dbconnect.php';
//including the headerfile
include_once 'header.php';


if(isset($_POST['update']) && !empty($_POST['update']))
{
	$query = mysqli_query($con, "UPDATE user set pin='".$_POST['pin_code']."', address = '".$_POST['address']."' where id=".$_REQUEST['uid']);
	if ($query) {
		$msg = "<div class='alert alert-success'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully Added Your Shipping Details !
				</div>";
	}else {
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while Updating !
				</div>";
	}
}

?>

<div class="container">
	<section>
		<div class="row">
			<div class="col-md-9 col-md-offset-1">			
			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Details</a></li>
			    <li role="presentation"><a href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Your Orders</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
				<?php 
				//if the prodcuct is available then diplay product details
				if(isset($_REQUEST['uid']) && !empty($_REQUEST['uid']))
				{
				?>
			    	<div role="tabpanel" class="tab-pane active" id="basic">
			    	<?php
						$user_query = mysqli_query($con, "SELECT * FROM user where id=".$_REQUEST['uid'] );
						$count = mysqli_num_rows($user_query);

						if($count > 0)
						{
							while($user = mysqli_fetch_object($user_query))
							{
							?>
								<div class="col-md-12">
									<div class="col-md-4 text-center">
										<div class="thumbnail">
											<img src="<?php echo BASEURL.'assets/images/default_avatar.png'; ?>" class="img-responsive" />
										</div>
									</div>
									<div class="col-md-8 text-center">
										<div class="box">
		                                	<h1 class="text-center"><?php echo $user->name; ?></h1>
		                               		<div class="col-md-12"></div>
		                               		<label>Your Shipping Details</label>
		                               		<form method="post" action="">
		                               			<input class="form-control" type="text" name="pin_code" placeholder="Postal Code" value="<?php echo $user->pin; ?>" />
		                               			<textarea class="form-control" placeholder="Shipping address" name="address"><?php echo $user->address; ?></textarea>
		                               			<input type="submit" name="update" class="btn btn-primary">
		                               		</form>
		                               	</div>
		                            </div>
								</div>
																
							<?php
							}
						}
						?>
			    	</div>
			    	<div role="tabpanel" class="tab-pane" id="orders">
			    	<?php 
			    	//select users data
					$query = mysqli_query($con, "SELECT * FROM orders where user_id=".$_REQUEST['uid']." ORDER BY id DESC" );
					$count = mysqli_num_rows($query); 
			    	?>
			    
				    	<div class="row">
							<div class="col-sm-12 table-responsive">
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
								<?php }//end else ?>
								</tbody>
							</table>
						</div>
					</div>
			    </div>
			    <?php
			    }
				else
				{
					echo "You are not logged in. Please Login to see your Profile...";
				}
				?>
			  </div>
			</div>
		</div>
	</section>
</div>




<?php
include_once 'footer.php';
?>