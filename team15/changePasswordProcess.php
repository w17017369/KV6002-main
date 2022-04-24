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

    <!-- Account pages style -->
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
                <a class="nav-link" href="prooducts.php"> Products </a>
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
      if (isset($_SESSION['user_id'])) {
        //If user_id exists store user_id in variable
        $user_id = $_SESSION[ 'user_id'];

        //Display dashboard
        echo "<div class='container-fluid display-table'>
          <div class='row display-table-row'>
            <div class='col-md-2 col-sm-1 hidden-xs display-table-cell v-align box' id='dashboard'>
              <div class='navi'>
                <ul>
                  <li><a href='profile.php'><i class='fa-solid fa-id-badge' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Profile</span></a></li>
                  <li><a href='orders.php'><i class='fa-solid fa-bag-shopping' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Orders</span></a></li>
                  <li><a href='favourites.php'><i class='fa-solid fa-heart' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Wish List</span></a></li>
                  <li><a href='addressBook.php'><i class='fa-solid fa-address-book' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Address Book</span></a></li>
                  <li class='active'><a href='changePassword.php'><i class='fa-solid fa-lock' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Change Password</span></a></li>
                  <li><a href='logout.php'><i class='fa-solid fa-arrow-right-from-bracket' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Log out</span></a></li>
                </ul>
              </div>
            </div>
            <div class='col-md-10 col-sm-11 display-table-cell v-align'>";
          
        //Retrieve variables
        $oldpassword = filter_has_var(INPUT_POST, 'oldpassword') ? $_POST['oldpassword'] : null;
        $newpassword = filter_has_var(INPUT_POST, 'newpassword') ? $_POST['newpassword'] : null;
        $confirmpassword = filter_has_var(INPUT_POST, 'confirmpassword') ? $_POST['confirmpassword'] : null;

        //Remove whitespace from beginning and end of the string
        $oldpassword = trim($oldpassword);
        $newpassword = trim($newpassword);
        $confirmpassword = trim($confirmpassword);
		
		    //Set error variable to false
		    $error = false;

        //Check if referer exists
        if (isset($_SERVER['HTTP_REFERER'])) {
          //If it does then store referer in variable
          $referer = $_SERVER['HTTP_REFERER'];
        } else {
          //If not then store index.php in variable
          $referer = 'changePassword.php';
        }

        //Check for empty fields
        if (empty($oldpassword)) {
          echo "<h1 class='profile-error text-center'>Please fill in all the fields</h1>\n";
          echo "<p class='profile-error text-center'>Click <a href='$referer'>here</a> to go back</p>";
          $error = true;
        } 

        if (empty($newpassword)) {
          echo "<h1 class='profile-error text-center'>Please fill in all the fields</h1>\n";
          echo "<p class='profile-error text-center'>Click <a href='$referer'>here</a> to go back</p>";
          $error = true;
        }

        if (empty($confirmpassword)) {
          echo "<h1 class='profile-error text-center'>Please fill in all the fields</h1>\n";
          echo "<p class='profile-error text-center'>Click <a href='$referer'>here</a> to go back</p>";
          $error = true;
        }

        //Check if both passwords are the same
        if ($newpassword != $confirmpassword) {
          //If not display error message
          echo "<h1 class='profile-error text-center'>Passwords do not match.</h1>\n";
          echo "<p class='profile-error text-center'>Please <a href='$referer'>try again</a></p>";
        }

        //If there are no errors continue with checking and updating password
        if ($error == false) {
          try {          
            //Get database connection
            $dbConn = getConnection();

            //Create a sql query to retrieve current users hashed password from db 
            $selectSQL = "SELECT password_hash
                  FROM dsf_users
                  WHERE userid = $user_id";

            //Execute query
            $queryResult = $dbConn->query( $selectSQL );

            //Store result in variable
            $rowObj = $queryResult->fetchObject();

            //Check if result exists
            if ($rowObj) {
              //Store hashed password in variable
              $password_hash = $rowObj->password_hash;

              //Check if hashed password and the password provided from the user match
              if (password_verify($oldpassword, $password_hash)) {

                //If password match set cost and hash the new password
                $option = ['cost' => 12,];
                $passwordHash = password_hash($newpassword, PASSWORD_DEFAULT, $option);
                try {
                  //Update new hashed password for the current user
                  $updateSQL = "UPDATE dsf_users 
                        SET password_hash = :password_hash
                        WHERE userid = $user_id";
        
                  //Use prepared statement to execute query
                  $stmt = $dbConn->prepare($updateSQL);
                  $stmt->execute(array(':password_hash' => $passwordHash));

                  //Display message
                  echo "<h1 class='profile-error text-center'>Your password has been changed.</h1>\n";
                  echo "<p class='profile-error text-center'>Click <a href='changePassword.php'>here</a> to go back</p>";
                } catch (Exception $e) {
                  //Output error message
                  echo "<h1 class='profile-error text-center'>There was a problem processing your request.</h1></h1>\n";
                  echo "<p class='profile-error text-center'>Please <a href='$referer'>try again</a></p>";
              
                  //Log errors
                  log_error($e);
                }
              } else {
                //If old password and old hashed password do not metch display error
                echo "<h1 class='profile-error text-center'>Incorrect password.</h1>\n";
                echo "<p class='profile-error text-center'>Please <a href='$referer'>try again</a></p>";
              }
            } else {
              //If result from sql does not exist display error
              echo "<h1 class='profile-error text-center'>User does not exist.</h1>\n";
              echo "<p class='profile-error text-center'>Please <a href='$referer'>try again</a></p>";
            }      
          } catch (Exception $e) {
            //Output error message
            echo "<h1 class='profile-error text-center'>There was a problem loading this page.</h1>\n";
            echo "<p class='profile-error text-center'>Please <a href='changePassword.php'>try again</a></p>";
              
            //Log errors
            log_error($e);
          }
        }
        //Closing divs from echo
        echo "</div>
            </div>
          </div>\n";
      } else {
        //If user_id does not exist display message
        echo "<h1 class='profile-error text-center'>Please <a href='login.php'>log in</a> to access this page.</h1>\n";
      }
    } catch (Exception $e) {
      //Output error message
      echo "<h1 class='profile-error text-center'>There was a problem loading this page.</h1>\n";
      echo "<p class='profile-error text-center'>Please <a href='changePassword.php'>try again</a></p>";
        
      //Log errors
      log_error($e);
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