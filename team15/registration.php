<?php
  // Session variables are stored in a folder specified below

  //sessionData path
  ini_set( "session.save_path", "/home/unn_w17017369/public_html/team15_practice/sessionData" );

  // Create a new session with a session ID
  session_start();

  /**if (isset($_SESSION['user_id'])) {
    echo("{$_SESSION['user_id']}"."<br />");
    echo "exists";
    echo "<a href='login.php>click here</a>";
  } else {
    echo("{$_SESSION['user_id']}"."<br />");
    echo "doenst exist";
  }**/
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
                    }
                  } else {
                    echo "
                      <div class='dropdown'>
                        <button class='btn' type='button' data-toggle='dropdown'>
                          <i class='fa fa-user' aria-hidden='true'></i>
                          <!--<span class='caret'></span>-->
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
    <div class="limiter">
		  <div class="container-login100">
			  <div class="wrap-login100">
				  <div class="login100-form-title">
					  <span class="login100-form-title-1">CREATE A NEW ACCOUNT</span>
				  </div>
				  <form class="login100-form validate-form" action="registrationProcess.php" method="post">
            <div class="wrap-input100 validate-input m-b-26">
              <?php
              //If referer exists then
              if ( isset( $_SERVER[ 'HTTP_REFERER' ] ) ) {
                //Store in variable
                $referer = $_SERVER[ 'HTTP_REFERER' ];
              } else {
                //If not then store home.php
                $referer = "index.php";
              }
              ?>
              <input type="hidden" name="referer" value="<?= $referer?>"/> 
              <label class="label-input100" for="firstname"></label>
              <input type="text" class="input100" name="firstname" id="firstname" placeholder="First Name" pattern="[a-zA-Z]+" title="Only alphabets are allowed." size="20" minlenght="1" maxlength="20" accesskey="f"  tabindex="1" required />
            </div>
            <div class="wrap-input100 validate-input m-b-18">
              <label for="surname"></label>
              <input type="text" class="input100" name="surname" id="surname" placeholder="Last name" pattern="[a-zA-Z]+" title="Only alphabets are allowed." size="20" minlenght="1" maxlength="20" accesskey="l" tabindex="2" required />
            </div>
            <div class="wrap-input100 validate-input m-b-18">
              <label for="email"></label>
              <input type="email" class="input100" name="email" id="email" placeholder="Email"  size="20" accesskey="e" tabindex="3" required />
            </div>
            <div class="wrap-input100 validate-input m-b-18">
              <label for="phone"></label>
              <input type="text" class="input100" name="phone" id="phone" placeholder="Phone"  size="11" minlenght="11" maxlength="11" accesskey="p" tabindex="4" required />
            </div>
            <div class="wrap-input100 validate-input m-b-18">
              <label for="username"></label>
              <input type="text" class="input100" id="username" id="username" size="30" tabindex="5" placeholder="Username" accesskey="u" name="username" pattern="^[A-Za-z0-9_]{1,15}$" size="20" maxlength="20" required >
              <!--  usernames have a character maximum of 15--> 
            </div>
            <div class="wrap-input100 validate-input m-b-18">
              <label for="newPassword"></label>
              <input type="password" class="input100" id="newPassword" size="50" tabindex="2" placeholder="New Password" title="8 or more characters, at least one uppercase, lowercase and number" accesskey="n" name="newPassword"  minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" tabindex="6" required>
              <!--Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars)--> 
			      </div>
            <div class="wrap-input100 validate-input m-b-18">
              <label for="confirmPassword"></label>
              <input type="password" class="input100" id="confirmPassword" size="50" tabindex="2" placeholder="Confirm Password" title="8 or more characters, at least one uppercase, lowercase and number" accesskey="c" name="confirmPassword" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" tabindex="7" required>
			      </div>
			      <div class="container-login100-form-btn">
              <button type="submit" class="login100-form-btn" value="Register" name="submit" id="rsubmit" tabindex="6" accesskey="s">Register</button>						
					  </div>
				  </form>
			  </div>
		  </div> 
	  </div>
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