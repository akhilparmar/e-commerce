<?php @session_start(); ?>
<?php
require_once '../dbconnect.php';

/*if (isset($_SESSION['userSession'])!="") {
	header("Location: home.php");
	exit;
}*/
require_once 'header.php';
require_once 'sidebar.php';

?>

<?php
//select users data
$query = mysqli_query($con, "SELECT * FROM products" );
$count = mysqli_num_rows($query); 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
	  	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Products</h3>
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
										<td class=""><?php echo $result->image; ?></td>
										<td class="sorting_1"><?php echo $result->name	; ?></td>
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

<?php
require_once 'footer.php';
