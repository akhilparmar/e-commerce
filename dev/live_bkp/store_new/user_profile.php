<?php
@session_start();


//connectiong to the database
include_once 'dbconnect.php';
//including the headerfile
include_once 'header.php';

?>

<div class="container">
	<section>
		<div class="row">
			<div class="col-md-9 col-md-offset-1">			
			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Details</a></li>
			    <li role="presentation"><a href="#shipping" aria-controls="shipping" role="tab" data-toggle="tab">Shipping Details</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="basic">
			    	<?php 
			    	   //if the prodcuct is available then diplay product details
						if(isset($_REQUEST['uid']) && !empty($_REQUEST['uid']))
						{
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
									</div>									
									<?php
								}
							}
						}
						else
						{
							echo "You are not logged in. Please Login to see your Profile...";
						}
						?>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="shipping"></div>
			  </div>
			</div>
		</div>
	</section>
</div>




<?php
include_once 'footer.php';
?>