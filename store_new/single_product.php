<?php
@session_start();

/*if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
}*/

include_once 'dbconnect.php';
include_once 'header.php';
?>
<div class="container">
	<section>
		<div class="row">
			<div class="col-md-12">
			<?php 
			if(isset($_REQUEST['pid']) && !empty($_REQUEST['pid']))
			{
				$product_query = mysqli_query($con, "SELECT * FROM products where id=".$_REQUEST['pid'] );
				$count = mysqli_num_rows($product_query);

				if($count > 0)
				{
					while($products = mysqli_fetch_object($product_query))
					{
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
					}
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