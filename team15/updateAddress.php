<?php
  //sessionData path
  ini_set( "session.save_path", "/home/unn_w17017369/public_html/team15_practice/sessionData" );

  //Create a new session with a session ID
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title>Timups</title>

    <!-- Bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- Owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- Font awesome style -->
    <script src="https://kit.fontawesome.com/152d9b5b12.js" crossorigin="anonymous"></script>
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- Responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

    <!-- Account page style -->
    <link href="css/profile.css" rel="stylesheet" type="text/css" />
    <script src="script.js"></script>
  </head>

  <body>
    <!-- header section starts -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <img src="img/logo.png" style="width: 10%">
          </a>

          <!-- Hamburger nav -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <!-- Main nav -->
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
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>
            </ul>
            <div class="user_option-box">
              <!-- Check if user is logged in\out to display correct button -->
              <?php
              try {
                //Link functions to get db connection, error functions and log in functions
                require_once( "functions.php" );

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
              <!-- Display basket and search icon -->
              <a href=""><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
              <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- End header section -->

    <!-- main -->
    <?php
    try {
      //Check if user_id exists 
      if (isset($_SESSION[ 'user_id'])) {
        //If user_id exists store user_id in variable
        $user_id = $_SESSION[ 'user_id'];

        //Retrive address id
        $address_id = filter_has_var(INPUT_GET, 'address_id') ? $_GET['address_id'] : null;

        //Get database connection
        $dbConn = getConnection();

        //If address id is empty display empty form
        if (empty($address_id)) {
          echo "<div class='container-fluid display-table'>
            <div class='row display-table-row'>
              <div class='col-md-2 col-sm-1 hidden-xs display-table-cell v-align box' id='dashboard'>
                <div class='navi'>
                  <ul>
                    <li><a href='profile.php'><i class='fa-solid fa-id-badge' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Profile</span></a></li>
                    <li><a href='orders.php'><i class='fa-solid fa-bag-shopping' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Orders</span></a></li>
                    <li><a href='favourites.php'><i class='fa-solid fa-heart' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Wish List</span></a></li>
                    <li class='active'><a href='addressBook.php'><i class='fa-solid fa-address-book' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Address Book</span></a></li>
                    <li><a href='changePassword.php'><i class='fa-solid fa-lock' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Change Password</span></a></li>
                    <li><a href='logout.php'><i class='fa-solid fa-arrow-right-from-bracket' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Log out</span></a></li>
                  </ul>
                </div>
              </div>
            <div class='col-md-10 col-sm-11 display-table-cell v-align'> 
              <div class='user-dashboard'>
                <h1>Add address</h1>
                <div class='row'>
                  <form class='update-details-form' action='updateAddressProcess.php' method='post'>
                    <label class='update-details-label' for='nickname'>Address nickname:</label>
                    <input class='update-details-input' type='text' class='form-control' name='nickname' placeholder='Home' size='20' minlenght='1' maxlength='20' accesskey='f'  tabindex='1'/>  
                    <label class='update-details-label' for='name'>*Full name:</label>
                    <input class='update-details-input' type='text' class='form-control' name='name' placeholder='John Smith' size='20' minlenght='1' maxlength='20' accesskey='f'  tabindex='2' required />                        
                    <label class='update-details-label' for='line1'>*Address line 1:</label>
                    <input class='update-details-input' type='text' class='form-control' name='line1' placeholder='12 Main street' size='50 minlength='1' maxlength='50' tabindex='3' required />                          
                    <label class='update-details-label' for='line2'>Address line 2:</label>
                    <input class='update-details-input' type='text' class='form-control' name='line2' placeholder='Newcastle Upon Tyne' size='50' minlength='1' tabindex='4' maxlength='50'/>                           
                    <label class='update-details-label' for='postcode'>*Postcode:</label>
                    <input class='update-details-input' type='text' class='form-control' name='postcode' placeholder='NE1 6PT' pattern='[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}' title='e.g. NE1 6PT (with a space)' size='7' minlength='1' maxlength='8' tabindex='5' required />                       
                    <label class='update-details-label' for='phone'>*Phone:</label>
                    <input class='update-details-input' type='text' class='form-control' name='phone' placeholder='07967829036' size='11' minlenght='11' maxlength='11' accesskey='p' tabindex='6' required />                           
                    <div class='update-details-submit'>
                      <button type='submit' class='btn btn-primary'>Add address</button>
                    </div>
                  </form>  
                </div>
              </div>";
        } else {
          //Query database to get address details using address id
          $selectSQL = "SELECT *
                FROM address_info
                WHERE address_id = $address_id";

          //Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
                   
          //Display populated form
          echo "<div class='container-fluid display-table'>
            <div class='row display-table-row'>
              <div class='col-md-2 col-sm-1 hidden-xs display-table-cell v-align box' id='dashboard'>
                <div class='navi'>
                  <ul>
                    <li><a href='profile.php'><i class='fa-solid fa-id-badge' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Profile</span></a></li>
                    <li><a href='orders.php'><i class='fa-solid fa-bag-shopping' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Orders</span></a></li>
                    <li><a href='favourites.php'><i class='fa-solid fa-heart' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Wish List</span></a></li>
                    <li class='active'><a href='addressBook.php'><i class='fa-solid fa-address-book' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Address Book</span></a></li>
                    <li><a href='changePassword.php'><i class='fa-solid fa-lock' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Change Password</span></a></li>
                    <li><a href='logout.php'><i class='fa-solid fa-arrow-right-from-bracket' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Log out</span></a></li>
                  </ul>
                </div>
              </div>
            <div class='col-md-10 col-sm-11 display-table-cell v-align'> 
            <div class='user-dashboard'>
              <h1>Update address</h1>
              <div class='row'>
                <form class='update-details-form' action='updateAddressProcess.php' method='post'> 
                <input type='hidden' name='address_id' value='$address_id'>
                  <label class='update-details-label' for='nickname'>Address nickname:</label>
                  <input class='update-details-input' type='text' class='form-control' name='nickname' value='{$rowObj->nickname}' size='20' minlenght='1' maxlength='20' accesskey='f'  tabindex='1'/>
                  <label class='update-details-label' for='name'>*Full name:</label>
                  <input class='update-details-input' type='text' class='form-control' name='name' value='{$rowObj->real_name}' size='50' minlenght='1' maxlength='50' accesskey='f'  tabindex='2' required />               
                  <label class='update-details-label' for='line1'>*Address line 1:</label>
                  <input class='update-details-input' type='text' class='form-control' name='line1' value='{$rowObj->addressline1}' size='50 minlength='1' maxlength='50' tabindex='3' required />
                  <label class='update-details-label' for='line2'>Address line 2:</label>
                  <input class='update-details-input' type='text' class='form-control' name='line2' value='{$rowObj->addressline2}' size='50' minlength='1' maxlength='50' tabindex='4'/>               
                  <label class='update-details-label' for='postcode'>*Postcode:</label>
                  <input class='update-details-input' type='text' class='form-control' name='postcode' value='{$rowObj->postcode}' pattern='[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}' title='e.g. NE1 6PT (with a space)' size='7' minlength='1' maxlength='8' tabindex='5' required />              
                  <label class='update-details-label' for='phone'>*Phone:</label>
                  <input class='update-details-input' type='text' class='form-control' name='phone' value='{$rowObj->tel_phone}' size='11' minlenght='11' maxlength='11' accesskey='p' tabindex='6' required />                  
                  <div class='update-details-submit'>
                    <button type='submit' class='btn btn-primary'>Save changes</button>
                  </div>
                </form>  
              </div>
            </div>";
          }
        //Closing divs from echo
        echo "</div>
            </div>
          </div>\n";
      } else {
        //If user does not exist display message
        echo "<h1 class='profile-error text-center'>Please <a href='login.php'>log in</a> to access this page.</h1>\n";
      }
    } catch ( Exception $e ) {
      //Output error message
      echo "<h1 class='profile-error text-center'>There was a problem loading this page.</h1>\n";
      echo "<p class='profile-error text-center'>Please <a href='addressBook.php'>try again</a></p>";
                    
      //Log error
      log_error( $e );
    }
    ?>
    <!-- main ends -->
    
    <!-- footer section -->
    <footer class="footer_section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 footer-col">
            <div class="footer_detail">
              <h4>About</h4>
              <p>Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with</p>
              <div class="footer_social">
                <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 footer-col">
            <div class="footer_contact">
              <h4>Reach at..</h4>
              <div class="contact_link_box">
                <a href=""><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location</span></a>
                <a href=""><i class="fa fa-phone" aria-hidden="true"></i><span>Call +01 1234567890</span></a>
                <a href=""><i class="fa fa-envelope" aria-hidden="true"></i><span>demo@gmail.com</span></a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 footer-col">
            <div class="footer_contact">
              <h4>Subscribe</h4>
              <form action="#">
                <input type="text" placeholder="Enter email" />
                <button type="submit">Subscribe</button>
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
          <p>&copy; <span id="displayYear"></span> All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
        </div>
      </div>
    </footer>
    <!-- footer section -->

    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- Popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- Owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- Custom js -->
    <script src="js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
    <!-- End Google Map -->

  </body>
</html>