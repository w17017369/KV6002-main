<?php 
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';
 if(!empty($_POST['name'])){
	 $name = htmlentities($_POST['name']);
	 $prefix = getDBPregix();
	 $create_time = time();
		 $sql = "INSERT INTO {$prefix}type(name,create_time) 
		         VALUES('$name','$create_time')";
		 if(execute($sql)){
			 setInfo("Add successful");
		 }else{
			 setInfo("Add Failed");
		 }
	 
 }


require 'header.php';
?>
		<!-- End Navbar -->
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header card-header-primary">
								<h4 class="card-title">Add product category</h4>
							</div>
							<div class="card-body">
							<p style="color :red">	<?php  if(hasInfo()) echo getInfo();?></p>
								<form action="type_add.php" method="post">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="bmd-label-floating">Category Name</label>
												<input type="text" name="name" value="" class="form-control">
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-primary pull-right">Add categoty</button>
									<div class="clearfix"></div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	<?php 
	
	
	
	require 'footer.php';
	?>