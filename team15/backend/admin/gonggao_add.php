<?php 
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';

 if(!empty($_POST['title'])){
	 $title = htmlentities($_POST['title']);
	 $content = htmlentities($_POST['content']);
	 $create_time = time();
	 $prefix = getDBPregix();
	 
		 $password = md5($password);
		 $sql = "INSERT INTO {$prefix}newsletter(title,content,create_time) 
		         VALUES('$title','$content','$create_time')";
		 if(execute($sql)){
			 setInfo("Add successful");
		 }else{
			 setInfo("Add failed");
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
								<h4 class="card-title">Add news</h4>
							</div>
							<div class="card-body">
							<p style="color :red">	<?php  if(hasInfo()) echo getInfo();?></p>
								<form action="" method="post">
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label class="bmd-label-floating">Title</label>
												<input type="text" name="title" value="" class="form-control">
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label class="bmd-label-floating">Content</label>
												<input type="text" name="content" value="" class="form-control">
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-primary pull-right">Add news</button>
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