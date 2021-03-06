<?php
@session_start();

//if the order is successfully placed and cart is need to be clear.
if(isset($_REQUEST['clear_cart']) && $_REQUEST['clear_cart'])
{
	unset($_SESSION['cart']);
}

//including database connection
include_once 'dbconnect.php';
//including the header
include_once 'header.php';
?>
<div id="slider" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#slider" data-slide-to="0" class="active"></li>
    <li data-target="#slider" data-slide-to="1"></li>
    <li data-target="#slider" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?php echo BASEURL.'assets/images/raspberrypi1.png'; ?>" alt="raspberrypi">
      <div class="carousel-caption">
        <h1>Slide 1</h1>
      </div>
    </div>
    <div class="item">
      <img src="<?php echo BASEURL.'assets/images/raspberrypi1.png'; ?>" alt="raspberrypi">
      <div class="carousel-caption">
         <h1>Slide 2</h1>
      </div>
    </div>
    ...
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#slider" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#slider" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<hr />
<div class="container-fluid">
	<section class="container">
		<div class="row">
			<div class="col-md-12 text-center">
			    <h2>Products</h2>
			</div>	
			<div class="col-md-12">
			<?php 
			if(isset($_POST['search_key']))
			{
				if($search_count > 0)
				{
					while($products = mysqli_fetch_object($search_query))
					{
						?>
							<div class="col-md-4 text-center single_rpoduct_wrapper">
								<div class="thumbnail product_thumbnail">
									<a href="<?php echo BASEURL.'single_product.php?pid='.$products->id; ?>" class="btn btn-default"><img style="height: 250px;" src="<?php echo BASEURL.'assets/images/'.$products->image; ?>" class="img-responsive" /></a>
								</div>
								<div class="text">
				                    <h3><a href="#"><?php echo $products->name; ?></a></h3>
				                    <p class="price"><?php echo '$'.$products->price; ?></p>
				                    <p class="buttons">
				                        <a href="<?php echo BASEURL.'single_product.php?pid='.$products->id; ?>" class="btn btn-default">View detail</a>
				                        <a href="<?php echo BASEURL.'add_to_cart.php?pid='.$products->id; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
				                    </p>
				                </div>
							</div>
						<?php
					}
				}
				else
				{
					?><h4>Sorry, No Products found related to your search...</h4><?php	
				}
			}
			else
			{
				$product_query = mysqli_query($con, "SELECT * FROM products" );
				$count = mysqli_num_rows($product_query);
				//display the products if available
				if($count > 0)
				{
					while($products = mysqli_fetch_object($product_query))
					{
						?>
						<div class="col-md-4 text-center single_rpoduct_wrapper">
							<div class="thumbnail product_thumbnail">
								<a href="<?php echo BASEURL.'single_product.php?pid='.$products->id; ?>" class="btn btn-default"><img style="height: 250px;" src="<?php echo BASEURL.'assets/images/'.$products->image; ?>" class="img-responsive" /></a>
							</div>
							<div class="text">
			                    <h3><a href="#"><?php echo $products->name; ?></a></h3>
			                    <p class="price"><?php echo '$'.$products->price; ?></p>
			                    <p class="buttons">
			                        <a href="<?php echo BASEURL.'single_product.php?pid='.$products->id; ?>" class="btn btn-default">View detail</a>
			                        <a href="<?php echo BASEURL.'add_to_cart.php?pid='.$products->id; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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