<?php 
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';

$id = intval($_GET['id']);
if(empty($id)){
	header('location:gonggao.php');
}
$prefix=getDBPregix();
$sql = "SELECT id,content,title
        FROM {$prefix}newsletter WHERE id = '$id'";
$current_user = queryOne($sql);
if(empty($current_user)){
	header('location:gonggao.php');
}

if(!empty($_POST['content'])){
	$content = htmlentities($_POST['content']);
	$update_time = time();
	$sql = "UPDATE {$prefix}newsletter 
	        SET content = '$content',update_time = '$update_time'
			WHERE id = '$id'";
    if(execute($sql)){
		setInfo('Update Successful');
	}else{
		setInfo('Update Failed');
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
								<h4 class="card-title">Edit</h4>
							</div>
							<div class="card-body">
								<p style="color: red;"><?php if(hasInfo())  echo getInfo();?></p>
								<form action="gonggao_edit.php?id=<?php echo $id; ?>" method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="bmd-label-floating">Title</label>
												<input type="text" name="title"  value="<?php echo $current_user['title'] ?>"  class="form-control">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="bmd-label-floating">Content</label>
												<input type="text" name="content"  value="<?php echo $current_user['content'] ?>"  class="form-control">
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-primary pull-right">Update</button>
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