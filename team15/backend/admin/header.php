<?php 

$script=basename($_SERVER['SCRIPT_FILENAME']);
// var_dump($script);die;
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
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
</head>

<body>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          <img src="./imgs/logo.png" style="width:100px;height:50px;" alt=""> 
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?php echo substr($script,0,5) =='index' || substr($script,0,5) == 'admin' ?'active' : '';?>">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php echo substr($script,0,4) =='prod'  ?'active' : '';?>">
            <a class="nav-link" href="products.php">
              <i class="material-icons">library_books</i>
              <p>Product Management</p>
            </a>
          </li>
		  <li class="nav-item <?php echo substr($script,0,4) =='type'  ?'active' : '';?>">
		    <a class="nav-link" href="type.php">
		      <i class="material-icons">library_books</i>
		      <p>Category Management</p>
		    </a>
		  </li>
	        <li class="nav-item <?php echo substr($script,0,5) =='order'  ?'active' : '';?>">
		        <a class="nav-link" href="orders.php">
			        <i class="material-icons">list</i>
			        <p>Order Management</p>
		        </a>
	        </li>
		 <li class="nav-item <?php echo substr($script,0,4) =='mess'  ?'active' : '';?>">
			    <a class="nav-link" href="mess.php">
			        <i class="material-icons">message_board</i>
			        <p>Post Management</p>
			    </a>
			</li>
			<li class="nav-item <?php echo substr($script,0,4) =='gong'  ?'active' : '';?>">
			    <a class="nav-link" href="gonggao.php">
			        <i class="material-icons">announcement</i>
			        <p>Newsletter Management</p>
			    </a>
			</li>
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    <div class="main-panel" style="position: relative;padding-bottom: 200px">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="index.php">Dashboard</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Administrator
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="admin_edit.php">Edit</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php">Log out</a>
                </div>
              </li>
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>