<?php
require '../db.func.php';
require '../toos.func.php';
if(!empty($_POST['adminuser'])){
	$prefix = getDBPregix();
	
	$adminuser = $_POST['adminuser'];
	$adminpass = md5($_POST['adminpass']);
	
	$sql="SELECT id ,adminuser FROM  {$prefix}admin 
	      WHERE adminuser = '$adminuser' AND adminpass =  '$adminpass' ";
		  
	$res = queryOne($sql);
	// var_dump($res);die;
	if($res){
		//Store session
		setSession('admin',['adminuser'=>$adminuser,'id'=>$res['id']]);
		$login_at = date('Y-m-d H:i:s');
		$sql= "UPDATE {$prefix}admin 
		SET login_at = '{$login_at}' 
		WHERE id = '{$res['id']}' ";
		$b=execute($sql);
		  // var_dump($b);die;
		header('location:index.php');
	}else{
		setInfo('Wrong username or password');
	}
}

?>
<!doctype html>
<html>

<head>
  <title>Backstage Management System</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="assets/css/googlefonts.css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
</head>

<body>
  <div class="wrapper ">
    <div>
      <div>
        <div class="container" style="width: 50%;margin-top: 250px;">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">Login</h4>
                    <p class="card-category">Backend Management</p>
                  </div>
                  <div class="card-body">
					  <p><?php if(hasInfo()) echo getInfo()?></p>
                    <form action="login.php" method="post">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Username</label>
                            <input type="text" name="adminuser" value="" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Password</label>
                            <input type="password" name="adminpass" value="" class="form-control">
                          </div>
                        </div>
                      </div>
                      <a href='../../index.php' class="btn btn-primary pull-left">Homepage</a>
                      <button type="submit" class="btn btn-primary pull-right">Login</button>
                      <div class="clearfix"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
</body>

</html>