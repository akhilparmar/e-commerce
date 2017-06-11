<?php
@session_start();

include_once 'dbconnect.php';
include_once 'header.php';
?>
<script>
function place_order()
{
	alert('Thank you, your order has been placed successfully...');
	window.location = "<?php echo BASEURL.'?clear_cart=1'; ?>";
}
function go_to_login()
{
	alert('Please Login to place the order. You will redirected to the Login page....');
	window.location = "<?php echo BASEURL.'login.php'; ?>";
}
</script>
<?php
if(isset($_REQUEST['del_id']) && !empty($_REQUEST['del_id']))
{
	unset($_SESSION['cart'][$_REQUEST['del_id']]);
}

if(isset($_POST['update_cart']))
{
	foreach($_SESSION['cart'] as $key=>$cart_item)
	{
		$_SESSION['cart'][$key]['qty'] = $_POST['qty_'.$key];
	}
}


if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
{
	?>
	<div class="container">
        <div class="col-md-12" id="basket">
            <div class="box">
                <form method="post" action="">
                    <h1>Shopping cart</h1>
                    <p class="text-muted">You currently have <?php echo count($_SESSION['cart']); ?> item(s) in your cart.</p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                    <th>Quantity</th>
                                    <th>Unit price</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	//cart total
                            	$total = 0;
                            	//serial number fgor generate dynamic id
                            	$sr_no = 1;
                            	foreach($_SESSION['cart'] as $key=>$cart_item)
								{
									$product_query = mysqli_query($con, "select * from products where id=".$key);
									$products = mysqli_fetch_object($product_query);
									?>
									<tr>
	                                    <td>
	                                        <a href="#">
	                                            <img height="100" src="<?php echo BASEURL.'assets/images/'.$products->image; ?>" alt="White Blouse Armani" />
	                                        </a>
	                                    </td>
	                                    <td>
	                                    	<a href="#"><?php echo $products->name; ?></a>
	                                    </td>
	                                    <td>
	                                        <input type="number" onchange="update_subtotal(<?php echo $cart_item['id']; ?>,this.value)" id="qty_<?php echo $cart_item['id']; ?>" name="qty_<?php echo $cart_item['id'];?>" value="<?php echo $cart_item['qty']; ?>" class="form-control" />
	                                    </td>
	                                    <td id="unit_<?php echo $cart_item['id']; ?>">
	                                    	<?php echo '$'.$products->price; ?>
	                                    </td>
	                                    <td>
	                                    	<a href="<?php echo BASEURL.'cart.php?del_id='.$cart_item['id']; ?>"><i class="fa fa-trash-o"></i>Delete</a>
	                                    </td>
	                                </tr>
									<?php 
									
									$total += ($products->price * $cart_item['qty']);
									$sr_no++;
								}
								?>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Total</th>
                                    <th colspan="2"><?php echo '$'.$total; ?></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- /.table-responsive -->

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="<?php echo BASEURL; ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-default" type="submit" onclick="update_cart();" name="update_cart"><i class="fa fa-refresh"></i> Update basket</button>
                            
                            <?php
                            if(!isset($_SESSION['user_id']))
                            {
								?>
								<button type="button" onclick="go_to_login()" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></button>
								<?php
							}
							else
							{
								?>
								<button type="button" onclick="place_order()" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></button>
								<?php
							}
                            ?>
                            
                        </div>
                    </div>

                </form>

            </div>
            <!-- /.box -->
        </div>
    </div>
    <?php
}
else
{
	?>
	<div class="container">
        <div class="col-md-12" id="basket">
            <div class="box">
	            <h1>Shopping cart</h1>
	            <p class="text-muted"> Your cart is Empty.</p>
	            
	            <div class="box-footer">
                    <div class="pull-left">
                        <a href="<?php echo BASEURL; ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Go back to shop</a>
                    </div>
                </div>
	        </div>
	    </div>
	</div>
	<?php	
}
?>
<?php
include_once 'footer.php';
?>