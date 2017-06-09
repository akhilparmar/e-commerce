<?php
@session_start();

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
}

include_once 'dbconnect.php';
include_once 'header.php';

if(isset($_POST['update_cart']))
{
	print_r($_POST);exit;
}
?>
<script>
/**
* function calculates sub total for particular product 
* 
* @return
*/
function update_subtotal(id, qty)
{
	price = $('#price_'+id).val();
	unit_price = price*qty;
	$('#subtotal_'+id).html('$'+unit_price);
	$('#subtotal_hidden_'+id).val(unit_price);
}
</script>
<?php

if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
{
	?>
	<div class="container">
        <!--<div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="#">Home</a>
                </li>
                <li>Shopping cart</li>
            </ul>
        </div>-->

        <div class="col-md-9" id="basket">
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
                                    <th colspan="2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	$total = 0;
                            	foreach($_SESSION['cart'] as $cart_item)
								{
									$product_query = mysqli_query($con, "select * from products where id=".$cart_item);
									$products = mysqli_fetch_object($product_query);
									
									
									?>
									<tr>
	                                    <td>
	                                        <a href="#">
	                                            <img height="100" src="<?php echo BASEURL.'assets/images/'.$products->image; ?>" alt="White Blouse Armani">
	                                        </a>
	                                    </td>
	                                    <td><a href="#"><?php echo $products->name; ?></a>
	                                    </td>
	                                    <td>
	                                        <input type="number" onchange="update_subtotal(<?php echo $cart_item; ?>,this.value)" id="qty_<?php echo $cart_item; ?>" name="qty" value="1" class="form-control">
	                                        <input type="hidden" id="price_<?php echo $cart_item; ?>" name="product_price" value="<?php echo $products->price; ?>" class="form-control">
	                                    </td>
	                                    <td id="unit_<?php echo $cart_item; ?>"><?php echo '$'.$products->price; ?><input type="hidden" id="unit_hidden_<?php echo $cart_item; ?>"></td>
	                                    <td id="subtotal_<?php echo $cart_item; ?>"><?php echo '$'.$products->price; ?><input type="hidden" id="subtotal_hidden_<?php echo $cart_item; ?>"></td>
	                                    <td><a href="#"><i class="fa fa-trash-o"></i></a>
	                                    </td>
	                                </tr>
									<?php 
									
									$total += $products->price;
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
                            <a href="category.html" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-default" type="submit" name="update_cart"><i class="fa fa-refresh"></i> Update basket</button>
                            <button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                </form>

            </div>
            <!-- /.box -->



        </div>
        <!-- /.col-md-9 -->

        <!--<div class="col-md-3">
            <div class="box" id="order-summary">
                <div class="box-header">
                    <h3>Order summary</h3>
                </div>
                <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Order subtotal</td>
                                <th>$446.00</th>
                            </tr>
                            <tr>
                                <td>Shipping and handling</td>
                                <th>$10.00</th>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <th>$0.00</th>
                            </tr>
                            <tr class="total">
                                <td>Total</td>
                                <th>$456.00</th>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>


            <div class="box">
                <div class="box-header">
                    <h4>Coupon code</h4>
                </div>
                <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
                <form>
                    <div class="input-group">

                        <input type="text" class="form-control">

                        <span class="input-group-btn">

			<button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>

		    </span>
                    </div>
                    <!-- /input-group -->
                </form>
            </div>

        </div>-->
        <!-- /.col-md-3 -->

    </div>
    <?php
}
?>
<?php
include_once 'footer.php';
?>