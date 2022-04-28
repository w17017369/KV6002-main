<?php

//sessionData path
ini_set( "session.save_path", "/home/unn_w19020174/sessionData");
if ( ! session_id() ) {
    //Create a new session with a session ID
    session_start();
}

include "src/email.php";

if ($_POST) {
    $return = email($_POST);
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

  <title>D'Effetto</title>

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

    <!-- Account pages style-->
    <link href="css/profile.css" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- Responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <script src="script.js"></script>

</head>

<body class="sub_page">

  <div class="hero_area">

      <!-- header section strats -->
      <header class="header_section">
          <div class="container-fluid">
              <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="index.php">
                      <img src="images/logo/logo.png">
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
                              <a class="nav-link" href="contact.php">Contact Us</a>
                          </li>
                      </ul>
                      <div class="user_option-box">
                          <!-- Check if user is logged in\out to display correct button -->
                          <?php
                          try {
                              //Link functions to get db connection, error functions and log in functions
                              require_once("src/functions.php");
                              //Check if session variable logged-in exists and whether it is true/false
                              if ( isset( $_SESSION[ 'logged-in' ] ) ) {
                                  if ( check_login() ) {
                                      //Check if role exists
                                      if (isset($_SESSION[ 'role'])) {
                                          //If so check if role is admin
                                          if ($_SESSION[ 'role'] == 0) {
                                              //If admin display admin within dropdown
                                              echo "<div class='dropdown'>
 <button class='btn' type='button' data-toggle='dropdown'>
 <i class='fa fa-user' aria-hidden='true'></i>
 </button>
 <ul class='dropdown-menu'>
 <li><a href='admin.php'>Admin</a></li>
 <li><a href='profile.php'>Account</a></li>
 <li><a href='logout.php'>Log out</a></li>
 </ul>
 </div>";
                                          } else {
                                              //If customer dispay normal dropdown
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

//If role cannot be checked display regular dropdown
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
                          <a href="cart.php">
                              <i class="fa fa-cart-plus" aria-hidden="true"></i>
                          </a>
                          <a href="#" data-toggle="collapse" data-target="#demo">
                              <i class="fa fa-search" aria-hidden="true"></i>
                          </a>
                      </div>
                  </div>
              </nav>
          </div>
      </header>
    <!-- end header section -->
  </div>
  <!-- search box -->
  <section class="search_section">
      <div id="demo" class="col-md-12 collapse searchBar">
          <form action="" method="get">
              <input type="text" placeholder="search">
              <button type="submit" class=""><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>

      </div>
  </section>
  <!-- end search box -->
  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="row">

        <div class="col-md-5">
          <div class="info-box">
            <h2>
              Contact Information
            </h2>
            <span>
              <i class="fa fa-map-marker" aria-hidden="true"></i>
                  Location
            </span>
            <span>
              <i class="fa fa-phone" aria-hidden="true"></i>
                  Call +01 1234567890
            </span>
            <span>
              <i class="fa fa-envelope" aria-hidden="true"></i>
                  deffetto.style@gmail.com
            </span>
          </div>
        </div>
          <div class="col-md-7">
              <div class="form_container">
                      <div class="heading_container">
                          <h2 style="text-align: center">
                              Got a Question?
                          </h2>
                          <h3>
                              We look forward to hear you and help to answer
                              any question you have
                          </h3>
                      </div>
                  <?php
                  if ($_POST) {
                      echo <<<EOT
<div class="alert">
<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
$return
</div>
EOT;
                  }
                  ?>
                  <form action="contact.php" method="post">
                      <div>
                          <input type="text" placeholder="Full Name" name="fullname" />
                      </div>
                      <div>
                          <input type="email" placeholder="Email" name="email"/>
                      </div>
                      <div>
                          <input type="text" placeholder="Subject" name="subject"/>
                      </div>
                      <div>
                 <textarea type="text" class="message-box" name="message" placeholder="Enter your query here..">
                </textarea>
                      </div>
                      <div class="d-flex ">
                          <button type="submit" value="send">
                              SEND
                          </button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->

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
                  deffetto.style@gmail.com
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
              <form action="index.php#newsletter" method="post">
                  <input type="text" placeholder="Full Name" name="name" />
                  <input type="email" placeholder="Enter email" name="email" />
                  <button type="submit" onClick="goHere()">
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
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a>
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
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

</body>

</html>