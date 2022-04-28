<?php
// To establish a connect to the database, PHP code from another file needs to be embedded 
require_once( "functions.php" );
// Make database connection 
$cart_url = "login.php";
$row_count = "";
if ( isset( $_SESSION[ 'logged-in' ] ) ) {
    $cart_url = "cart.php";
    $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
    $row_count = mysqli_num_rows($select_rows);
}

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
                <a class="navbar-brand" href="index.php">
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
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php"> Products </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php"> About </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="forum.php"> Forum </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                    </ul>
                    <div class="user_option-box">
                        <?php
                        try {
                            //Link functions to get db connection, error functions and log in functions
                            require_once( "src/functions.php" );

                            //Check if session variable logged-in exists and whether it is true/false
                            if ( isset( $_SESSION[ 'logged-in' ] ) ) {
                                if ( check_login() ) {
                                    //If true display account and log out
                                    echo "<div class='dropdown'>
                      <button class='btn' type='button' data-toggle='dropdown'>
                        <i class='fa fa-user' aria-hidden='true'></i>
                      </button>
                      <ul class='dropdown-menu'>
                        <li><a href='profile.php'>Account</a></li>
                        <li><a href='logout.php'>Log out</a></li>
                      </ul>
                    </div>";
                                }
                            } else {
                                //If false display account and log in
                                echo "<div class='dropdown'>
                    <button class='btn' type='button' data-toggle='dropdown'>
                      <i class='fa fa-user' aria-hidden='true'></i>
                    </button>
                    <ul class='dropdown-menu'>
                      <li><a href='profile.php'>Account</a></li>
                      <li><a href='login.php'>Login</a></li>
                    </ul>
                  </div>";
                            }
                        } catch ( Exception $e ) {
                            //Output error message - this error message has to be short because it will be displayed in place of login button
                            echo "<p>Unavaialble</p>\n";

                            //Log error
                            log_error( $e );
                        }
                        ?>
                        <a href="<?php echo $cart_url ?>">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                <span style="color: white"><?php echo $row_count; ?></span>
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
	
	<!-- users can search sort products by price, low to high or high to low -->
	

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
				  <img src="img/keyholder1.png" alt="">
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
				  <img src="img/keyholder2.png" alt="">
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
				  <img src="img/keyholder3.png" alt="">
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
                <img src="img/blanktee.png" alt="">
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
                <img src="img/bluetee.png" alt="">
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
                <img src="img/coraltee.png" alt="">
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
                <img src="img/greentee.png" alt="">
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
                <img src="img/redtee.png" alt="">
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
                <img src="img/tealtee.png" alt="">
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

  <!-- end shop section -->
<?php
  include 'footer.php';
?>
