<?php 
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';

$id = intval($_GET['id']);
if(empty($id)){
	header('location:users.php');
}
$prefix=getDBPregix();
$sql = "SELECT id,name
        FROM {$prefix}type WHERE id = '$id'";
$current_user = queryOne($sql);
if(empty($current_user)){
	header('location:type.php');
}

if(!empty($_POST['name'])){
	$name = htmlentities($_POST['name']);
	$sql = "UPDATE {$prefix}type 
	        SET name = '$name'
			WHERE id = '$id'";
    if(execute($sql)){
		$current_user = array_merge($current_user,$_POST);
		setInfo('Update successful');
	}else{
		setInfo('Update failed');
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
								<h4 class="card-title">Type of modification</h4>
								<p class="card-category">Modify an item type</p>
							</div>
							<div class="card-body">
								<p style="color: red;"><?php if(hasInfo())  echo getInfo();?></p>
								<form action="type_edit.php?id=<?php echo $id; ?>" method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="bmd-label-floating">Name</label>
												<input type="text" name="name"  value="<?php echo $current_user['name'] ?>"  class="form-control">
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-primary pull-right">Update information</button>
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