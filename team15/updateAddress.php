<?php
  // Session variables are stored in a folder specified below

  //sessionData path
  ini_set( "session.save_path", "/home/unn_w17017369/public_html/team15_practice/sessionData" );

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

    <title>Timups</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- font awesome style -->
    <script src="https://kit.fontawesome.com/152d9b5b12.js" crossorigin="anonymous"></script>
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

    <link href="css/profile.css" rel="stylesheet" type="text/css" />
    <script src="script.js"></script>
  </head>

  <body>
    <!-- header section starts -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <img src="img/logo.png" style="width: 10%">
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="watches.html"> Watches </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html"> About </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
            <div class="user_option-box">
              <?php
              try {
                require_once( "functions.php" );
                if ( isset( $_SESSION[ 'logged-in' ] ) ) {
                  if ( check_login() ) {
                    echo "<div class='dropdown'>
                      <button class='btn' type='button' data-toggle='dropdown'>
                        <i class='fa fa-user' aria-hidden='true'></i>
                      </button>
                      <ul class='dropdown-menu'>
                        <li><a href='profile.php'>Account</a></li>
                        <li><a href='logout.php'>Log out</a></li>
                      </ul>
                    </div>"; // Logout button
                    if ( isset( $_SESSION[ 'user_id'])) {
                      echo "i exist";
                    } else {
                      echo "i dont exist";
                    }
                  }
                } else {
                  echo "<div class='dropdown'>
                    <button class='btn' type='button' data-toggle='dropdown'>
                      <i class='fa fa-user' aria-hidden='true'></i>
                    </button>
                    <ul class='dropdown-menu'>
                      <li><a href='profile.php'>Account</a></li>
                      <li><a href='login.php'>Login</a></li>
                    </ul>
                  </div>"; // Logout button
                }
              } catch ( Exception $e ) {
                //Output error message
                //This error message has to be short because it will be displayed in place of login button 
                echo "<p>Unavaialble</p>\n";

                //Log error
                log_error( $e );
              }
              ?>
              <a href=""><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
              <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

    <!-- main -->
    <?php
    try {
      if (isset($_SESSION[ 'user_id'])) {
        $user_id = $_SESSION[ 'user_id'];

        $address_id = filter_has_var(INPUT_GET, 'address_id') ? $_GET['address_id'] : null;

        // Get database connection
        $dbConn = getConnection();

        if (empty($address_id)) {
          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT *
                FROM address_info
                WHERE userid = $user_id";
            
          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();

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
                  <form class='update-details-form' action='addressBookProcess.php' method='post'>
                    <label class='update-details-label' for='name'>Name:</label>
                    <input type='text' class='form-control' name='name' placeholder='Full name' pattern='[a-zA-Z]+' title='Only alphabets are allowed' size='20' minlenght='1' maxlength='20' accesskey='f'  tabindex='1' required />                        
                    <label class='update-details-label' for='line1'>Address line 1:</label>
                    <input class='update-details-input' type='text' class='form-control' name='line1' placeholder='Address line 1' pattern='\d+\s[A-z]+\s[A-z]+' title='Building name or number' size='50 minlength='1' maxlength='50' tabindex='2' required />                          
                    <label class='update-details-label' for='line2'>Address line 2:</label>
                    <input class='update-details-input' type='text' class='form-control' name='line2' placeholder='Address line 2' pattern='[A-z]+\s[A-z]+' title='City' size='50' minlength='1' tabindex='3' maxlength='50'/>                           
                    <label class='update-details-label' for='postcode'>Postcode:</label>
                    <input class='update-details-input' type='text' class='form-control' name='postcode' placeholder='Postcode' pattern='[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}' title='post code' size='7' minlength='1' maxlength='8' tabindex='4' required />                       
                    <label class='update-details-label' for='phone'>Phone:</label>
                    <input class='update-details-input' type='text' class='form-control' name='phone' placeholder='Phone number' size='11' minlenght='11' maxlength='11' accesskey='p' tabindex='5' required />                           
                    <div class='update-details-submit'>
                      <button type='submit' class='btn btn-primary'>Add address</button>
                    </div>
                  </form>  
                </div>
              </div>";
        } else {
          // Create the Publisher query - SELECT the product name
          $selectSQL = "SELECT *
                FROM address_info
                WHERE address_id = $address_id";

          // Execute the query
          $queryResult = $dbConn->query( $selectSQL );
          $rowObj = $queryResult->fetchObject();
                              
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
                <form class='update-details-form' action='addressBookProcess.php' method='post'> 
                  <label class='update-details-label' for='name'>Name:</label>
                  <input class='update-details-input' type='text' class='form-control' name='name' value='{$rowObj->real_name}' pattern='[a-zA-Z]+' title='Only alphabets are allowed' size='20' minlenght='1' maxlength='20' accesskey='f'  tabindex='1' required />               
                  <label class='update-details-label' for='line1'>Address line 1:</label>
                  <input class='update-details-input' type='text' class='form-control' name='line1' value='{$rowObj->addressline1}' pattern='\d+\s[A-z]+\s[A-z]+' title='Building name or number' size='50 minlength='1' maxlength='50' tabindex='2' required />
                  <label class='update-details-label' for='line2'>Address line 2:</label>
                  <input class='update-details-input' type='text' class='form-control' name='line2' value='{$rowObj->addressline2}' pattern='[A-z]+\s[A-z]+' title='City' size='50' minlength='1' maxlength='50' tabindex='3'/>               
                  <label class='update-details-label' for='postcode'>Postcode:</label>
                  <input class='update-details-input' type='text' class='form-control' name='postcode' value='{$rowObj->postcode}' pattern='[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}' title='Post code' size='7' minlength='1' maxlength='8' tabindex='4' required />              
                  <label class='update-details-label' for='phone'>Phone:</label>
                  <input class='update-details-input' type='text' class='form-control' name='phone' value='{$rowObj->tel_phone}' size='11' minlenght='11' maxlength='11' accesskey='p' tabindex='5' required />                  
                  <div class='update-details-submit'>
                    <button type='submit' class='btn btn-primary'>Save changes</button>
                  </div>
                </form>  
              </div>
            </div>";
          }
        //closing divs from echo
        echo "</div>
            </div>
          </div>\n";
      } else {
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
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
    <!-- End Google Map -->

  </body>
</html>