<?php
@session_start();
//defininf database connection
include_once 'dbconnect.php';
//including header
include_once 'header.php';
?>
<div class="container">
	<section>
		<div class="row">
			<div class="col-md-12">
			<?php 
			//displaying single product detail
			if(isset($_REQUEST['pid']) && !empty($_REQUEST['pid']))
			{
				$product_query = mysqli_query($con, "SELECT * FROM products where id=".$_REQUEST['pid'] );
				$count = mysqli_num_rows($product_query);

				if($count > 0)
				{
					$products = mysqli_fetch_object($product_query)
					/*while()
					{*/
						?>
						<div class="col-md-12">
							<div class="col-md-6 text-center single_rpoduct_wrapper">
								<div class="thumbnail">
									<img src="<?php echo BASEURL.'assets/images/'.$products->image; ?>" class="img-responsive" />
								</div>
							</div>
							<div class="col-md-6 text-center single_rpoduct_wrapper">
								<div class="box">
	                                <h1 class="text-center"><?php echo $products->name; ?></h1>
	                                <p class="goToDescription">
	                                	<a href="#details" class="scroll-to">Scroll to product details, material &amp; care and sizing</a>
	                                </p>
	                                <p class="price"><?php echo '$'.$products->price; ?></p>

	                                <p class="text-center buttons">
	                                    <a href="<?php echo BASEURL.'/add_to_cart.php?pid='.$products->id; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a> 
	                                </p>
	                            </div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="container box" id="details">
	                        	<p>
		                        	<h4>Product details</h4>
		                            <p><?php echo $products->description;  ?></p>
	                            </p>
		                    </div>
						</div>
						<?php
					//}
				}
			}
			
			?>
			
				
			</div>
		</div>
	</section>
	
	<section>
		<div class="row">
			<div class="page-header">	
				<h1>Related Products</h1>
			</div>
			<div class="col-md-12">
				<?php 
					//check and display suggested products replated to this product
					if(isset($_REQUEST['pid']) && !empty($_REQUEST['pid']))
					{
						$suggested = mysqli_query($con, "SELECT * FROM products where cat_id=".$products->cat_id." AND id !=".$_REQUEST['pid']);
						$count = mysqli_num_rows($suggested);
						if($count > 0)
						{
							while($s_products = mysqli_fetch_object($suggested))
							{
								?>
								<div class="col-md-4 text-center single_rpoduct_wrapper">
									<div class="thumbnail product_thumbnail">
										<a href="<?php echo BASEURL.'single_product.php?pid='.$s_products->id; ?>" class="btn btn-default"><img style="height: 250px;" src="<?php echo BASEURL.'assets/images/'.$s_products->image; ?>" class="img-responsive" /></a>
									</div>
									<div class="text">
					                    <h3><a href="#"><?php echo $s_products->name; ?></a></h3>
					                    <p class="price"><?php echo '$'.$s_products->price; ?></p>
					                    <p class="buttons">
					                        <a href="<?php echo BASEURL.'single_product.php?pid='.$s_products->id; ?>" class="btn btn-default">View detail</a>
					                    </p>
					                </div>
								</div>
								<?php
							}
						}
						else
						{
							echo "No Other Related Products";
						}
					}	
				?>
			</div>
		</div>
	</section>
	
</div>
<?php
include_once 'footer.php';
?>