<?php
// Session variables are stored in a folder specified below

ini_set( "session.save_path", "/home/unn_w19015804/sessionData" );

// Create a new session with a session ID
 session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>SF Products</title>
  


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/products.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">

    <!-- header section starts -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span>
              <!-- Logo Image --> 
    <img src="img/logo.png" class="logo" alt="">
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.html">Home </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="products.php"> Products <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html"> About </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
            <div class="user_option-box">
              <a href="">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-search" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- shop section -->
	
	<!-- Users can filter the products depending on their preferences. Each of these button have data-filter variable that makes it possible to filter a div element by data names or data values -->
<div class="btn-toolbar text-center my-btn-container">
  <button class="btn btn-primary filter-button" data-filter="all">All products</button>
  <button class="btn btn-default filter-button" data-filter="caps">Caps</button>
  <button class="btn btn-default filter-button" data-filter="keyrings">Keyrings</button>
  <button class="btn btn-default filter-button" data-filter="mugs">Mugs</button>
  <button class="btn btn-default filter-button" data-filter="phonecases">Phone cases</button>
  <button class="btn btn-default filter-button" data-filter="glasses">Wine glasses</button>
  <button class="btn btn-default filter-button" data-filter="hoodies">Hoodies</button>
  <button class="btn btn-default filter-button" data-filter="tshirts">T-shirts</button>	
	
	<!-- users can search through different items instead of scrolling through page -->
<!--	<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Search items</button>
  <div id="myDropdown" class="dropdown-content">
    <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
    <a href="#caps">Caps</a>
    <a href="#hoodies">Hoodies</a>
    <a href="#keyrings">Keyrings</a>
    <a href="#mugs">Mugs</a>
    <a href="#case">Phone cases</a>
    <a href="#tees">T-shirts</a>
    <a href="#glass">Wine glasses</a>
  </div>
</div> -->
</div>

	
	<!-- START of the filterable elements -->
<!-- every product is being fetched from the database and echo out into 4 columns of boxes -->
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          All Products
        </h2>
      </div>

      <div class="row">
        <div class="col-sm-6 col-xl-3 filter caps">
          <div class="box">
            <a href="black_cap.php">
              <div class="img-box"> 
				  <img src="img/blackcap.png" alt="Black cap">
              </div>
              <div class="detail-box">
				            <?php
				  try {
          require_once( "functions.php" );
	  
          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p1'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";

					          } catch ( Exception $e ) {
          //Output error message
          echo "<p>problem occured</p>\n";
          //Log error
          log_error( $e );
        }
          ?>
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter caps">
          <div class="box">
            <a href="pink_cap.php">
              <div class="img-box"> 
				  <img src="img/pinkcap.png" alt="">
              </div>
              <div class="detail-box">				  
						<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p2'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";				  		  
				  ?>
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6  col-xl-3 filter keyrings">
          <div class="box">
            <a href="keyring1.php">
              <div class="img-box"> 
				  <img src="img/key_holder1.png" alt="">
              </div>
              <div class="detail-box">
				  			<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p3'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>
				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter keyrings">
          <div class="box">
            <a href="keyring2.php">
              <div class="img-box"> 
				  <img src="img/key_holder2.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p4'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter keyrings">
          <div class="box">
            <a href="keyring3.php">
              <div class="img-box"> 
				  <img src="img/key_holder3.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p5'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter mugs">
          <div class="box">
            <a href="mug1.php">
              <div class="img-box"> 
				  <img src="img/mug1.png" alt="">
              </div>
              <div class="detail-box">	
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p6'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
				  
				  ?>
				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6  col-xl-3 filter mugs">
          <div class="box">
            <a href="mug2.php">
              <div class="img-box"> 
                <img src="img/mug2.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p7'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
				  
				  ?>
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter mugs">
          <div class="box">
            <a href="mug3.php">
              <div class="img-box">
                <img src="img/mug3.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p8'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter phonecases">
          <div class="box">
            <a href="whitecase.php">
              <div class="img-box">
                <img src="img/whitecase.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p9'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter phonecases">
          <div class="box">
            <a href="peachcase.php">
              <div class="img-box">
                <img src="img/peachcase.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p10'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6  col-xl-3 filter glasses">
          <div class="box">
            <a href="glass1.php">
              <div class="img-box">
                <img src="img/glass1.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p11'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter glasses">
          <div class="box">
            <a href="glass2.php">
              <div class="img-box">
                <img src="img/glass2.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p12'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
				  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter hoodies">
          <div class="box">
            <a href="hoodie1.php">
              <div class="img-box">
                <img src="img/creamhoodie.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p13'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter hoodies">
          <div class="box">
            <a href="hoodie2.php">
              <div class="img-box">
                <img src="img/greenhoodie.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p14'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6  col-xl-3 filter hoodies">
          <div class="box">
            <a href="hoodie3.php">
              <div class="img-box">
                <img src="img/greyhoodie.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p15'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter tshirts">
          <div class="box">
            <a href="plaint.php">
              <div class="img-box">
                <img src="img/blankt.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p16'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter tshirts">
          <div class="box">
            <a href="bluet.php">
              <div class="img-box">
                <img src="img/bluet.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p17'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter tshirts">
          <div class="box">
            <a href="coralt.php">
              <div class="img-box">
                <img src="img/coralt.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p18'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6  col-xl-3 filter tshirts">
          <div class="box">
            <a href="greent.php">
              <div class="img-box">
                <img src="img/greent.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p19'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter tshirts">
          <div class="box">
            <a href="pinkt.php">
              <div class="img-box">
                <img src="img/pinkt.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p20'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter tshirts">
          <div class="box">
            <a href="redt.php">
              <div class="img-box">
                <img src="img/redt.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p21'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter tshirts">
          <div class="box">
            <a href="tealt.php">
              <div class="img-box">
                <img src="img/tealt.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p22'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";			
				  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6  col-xl-3 filter tshirts">
          <div class="box">
            <a href="whitet.php">
              <div class="img-box">
                <img src="img/whitet.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p23'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
		  
        <div class="col-sm-6 col-xl-3 filter tshirts">
          <div class="box">
            <a href="blackt.php">
              <div class="img-box">
                <img src="img/blackt.png" alt="">
              </div>
              <div class="detail-box">
				  		<?php

          // Get database connection
          $dbConn = getConnection();

          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT proid, name
							FROM product
							WHERE proid = 'p24'";
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
		  // Echo out the product name
          echo " <p class='card-title text-center'>{$rowObj->name}</p>\n";		
					  
				  ?>				  
              </div>
            </a>
          </div>
        </div>
      </div>		
		
	 <div class="back-to-top">
        <a href="">
          Back to top
        </a>
      </div>
    </div>
  </section>

  <!-- end shop section -->

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="footer_detail">
            <h4>
              About
            </h4>
            <p>
              Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="footer_contact">
            <h4>
              Reach at..
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  demo@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="footer_contact">
            <h4>
              Subscribe
            </h4>
            <form action="#">
              <input type="text" placeholder="Enter email" />
              <button type="submit">
                Subscribe
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> D’Effetto Style by Fancello. All Rights Reserved.
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script src="product.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->
</body>
</html>