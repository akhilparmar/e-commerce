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
require_once 'admin-header.php';
?>

<?php
//select users data
$query = mysqli_query($con, "SELECT * FROM user" );
$count = mysqli_num_rows($query); 
?>
	<div class="right-column">
		<div class="section_title">
			<h2>Users</h2>
		</div>
	
	
    	<!-- Main content -->
		<section class="content">
	      <div class="box">
	        <div class="box-header">
	          <!--<a href="add_user.php">+ Add New User</a>-->
	        </div>
	        	<!-- /.box-header -->
	        	<div class="box-body">
					<table>
						<thead>
						    <tr role="row">
						    	<th>Sr. no.</th>
						        <th>Name</th>
						        <th>Email</th>
						        <th colspan="2">Action</th>
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
									<td class=""><?php echo $result->name; ?></td>
									<td class="sorting_1"><?php echo $result->email; ?></td>
									<td class="sorting_1"><a href="edit_user.php?u_id=<?php echo $result->id; ?>">Edit</a></td>
									<td class="sorting_1"><a href="delete_user.php?u_id=<?php echo $result->id; ?>">Delete</a></td>
							    </tr>
							<?php $sr_no++;}//end-while ?>
						    <?php 
							  }
							  else
							  { 
							?>
							<tr role="row" class="odd">
								<td  class="">No Results found.</td>
							</tr>
						<?php }
							//end else 
						?>
						</tbody>
					</table>
				</div>
	        </div>
	        <!-- /.box-body -->
		</section>
		<!-- /.content -->
    </div>
</div>
 
<div></div>





	
	
	
	<!-- Modal -->
	<!--<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>-->
</div>
<!-- /.content-wrapper -->

