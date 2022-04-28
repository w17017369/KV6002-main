<?php 
require '../toos.func.php';
require '../db.func.php';
require 'auth.php';
$current = getSession('admin');  //GetSession


if(!empty($_POST['adminpass'])){
	$adminpass = md5(htmlentities($_POST['adminpass']));
	$newpass = htmlentities($_POST['newpass']);
	$confirmpass = htmlentities($_POST['confirmpass']);
	if($newpass != $confirmpass){
		setInfo('Two inconsistent password entries');
	}else{
		$prefix = getDBPregix();
		$sql = "SELECT id FROM {$prefix}admin WHERE id = '{$current['id']}'
		        AND adminpass = '$adminpass'";
		$res = queryOne($sql);
		if($res){
			$pass = md5($newpass);
		  $sql = "UPDATE {$prefix}admin 
		          SET adminpass = '$pass'
				  WHERE id = '{$current['id']}'";
		   if(execute($sql)){
			   setInfo('Password change successful');
		   }else{
			   setInfo('Failed to change password');
		   }
		}else{
			setInfo('Old password is incorrect');
		}
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
								<h4 class="card-title">Update Password</h4>
								<p class="card-category">Modify the current administrator password</p>
							</div>
							<div class="card-body">
								<p style="color: red;"><?php if(hasInfo()) echo getInfo();	 ?></p>
								<form action="admin_edit.php" method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="bmd-label-floating">Username</label>
												<input type="text" disabled="disabled" name="adminuser" value="<?php echo $current['adminuser'] ?>" class="form-control">
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="bmd-label-floating">Old Password</label>
												<input type="password" name="adminpass" class="form-control">
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="bmd-label-floating">New Password</label>
												<input type="password" name="newpass"  class="form-control">
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="bmd-label-floating">Confirm Password</label>
												<input type="password" name="confirmpass" class="form-control">
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
<?php	
require 'footer.php';

?>