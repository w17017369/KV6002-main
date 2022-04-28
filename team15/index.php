<?php
//sessionData path
ini_set( "session.save_path", "/home/unn_w19020174/sessionData");
if ( ! session_id() ) {
    //Create a new session with a session ID
    session_start();
}
//include config.php
include "config/config.php";
use SRC\Subscriber;

//If true create a new Subscriber object and make subscription
if ($_POST) {
    $subscriber = new Subscriber();
    $return = $subscriber->subscribe($_POST);
}
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

    <title>D'Effetto</title>

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

    <!-- Account pages style-->
    <link href="css/profile.css" rel="stylesheet" type="text/css" />
    <script src="script.js"></script>
</head>

<body>
<div class="hero_area">
    <!--
    <div class="hero_social">
      <a href="">
        <i class="fa fa-facebook" aria-hidden="true"></i>
      </a>
      <a href="">
        <i class="fa fa-instagram" aria-hidden="true"></i>
      </a>
    </div>-->
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
  <!-- slider section -->
  <section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container-fluid ">
            <div class="row">
              <div class="col-md-6">
                <div class="detail-box">
                  <h1>
                    T-Shirts
                  </h1>
                  <p>
                    Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl, convallis et augue sit amet, lobortis semper quam.
                  </p>
                  <div class="btn-box">
                    <a href="contact.php" class="btn1">
                      Contact Us
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="img-box">
                  <img src="images/slider-img.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item ">
          <div class="container-fluid ">
            <div class="row">
              <div class="col-md-6">
                <div class="detail-box">
                  <h1>
                   T-Shirts
                  </h1>
                  <p>
                    Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl, convallis et augue sit amet, lobortis semper quam.
                  </p>
                  <div class="btn-box">
                    <a href="contact.php" class="btn1">
                      Contact Us
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="img-box">
                  <img src="images/slider-img.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item ">
          <div class="container-fluid ">
            <div class="row">
              <div class="col-md-6">
                <div class="detail-box">
                  <h1>
                    T-Shirts
                  </h1>
                  <p>
                    Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl, convallis et augue sit amet, lobortis semper quam.
                  </p>
                  <div class="btn-box">
                    <a href="contact.php" class="btn1">
                      Contact Us
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="img-box">
                  <img src="images/slider-img.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <ol class="carousel-indicators">
        <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
        <li data-target="#customCarousel1" data-slide-to="1"></li>
        <li data-target="#customCarousel1" data-slide-to="2"></li>
      </ol>
    </div>

  </section>
  <!-- end slider section -->
</div>

<!-- shop section -->

<section class="shop_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Latest Watches
      </h2>
    </div>
    <div class="row">
      <div class="col-md-6 ">
        <div class="box">
          <a href="">
            <div class="img-box">
              <img src="images/w1.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Smartwatch
              </h6>
              <h6>
                Price:
                <span>
                    $300
                  </span>
              </h6>
            </div>
            <div class="new">
                <span>
                  Featured
                </span>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="box">
          <a href="">
            <div class="img-box">
              <img src="images/w2.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Smartwatch
              </h6>
              <h6>
                Price:
                <span>
                    $125
                  </span>
              </h6>
            </div>
            <div class="new">
                <span>
                  New
                </span>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="box">
          <a href="">
            <div class="img-box">
              <img src="images/w3.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Smartwatch
              </h6>
              <h6>
                Price:
                <span>
                    $110
                  </span>
              </h6>
            </div>
            <div class="new">
                <span>
                  New
                </span>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="box">
          <a href="">
            <div class="img-box">
              <img src="images/w4.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Smartwatch
              </h6>
              <h6>
                Price:
                <span>
                    $145
                  </span>
              </h6>
            </div>
            <div class="new">
                <span>
                  New
                </span>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="box">
          <a href="">
            <div class="img-box">
              <img src="images/w5.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Smartwatch
              </h6>
              <h6>
                Price:
                <span>
                    $195
                  </span>
              </h6>
            </div>
            <div class="new">
                <span>
                  New
                </span>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-6  col-xl-3">
        <div class="box">
          <a href="">
            <div class="img-box">
              <img src="images/w6.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Smartwatch
              </h6>
              <h6>
                Price:
                <span>
                    $170
                  </span>
              </h6>
            </div>
            <div class="new">
                <span>
                  New
                </span>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="box">
          <a href="">
            <div class="img-box">
              <img src="images/w1.png" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Smartwatch
              </h6>
              <h6>
                Price:
                <span>
                    $230
                  </span>
              </h6>
            </div>
            <div class="new">
                <span>
                  New
                </span>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="btn-box">
      <a href="">
        View All
      </a>
    </div>
  </div>
</section>

<!-- end shop section -->

<!-- about section -->

<section class="about_section">
  <div class="container  ">
    <div class="row">
      <div class="col-md-6 col-lg-5 ">
        <div class="img-box">
          <img src="images/about-img.png" alt="">
        </div>
      </div>
      <div class="col-md-6 col-lg-7">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              About Us
            </h2>
          </div>
          <p>
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
            in some form, by injected humour, or randomised words which don't look even slightly believable. If you
            are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
            the middle of text. All
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->

<!-- newsletter section -->

<section class="newsletter_section layout_padding">
  <div class="container">
    <div class="row">
        <div class="heading_container">
            <h2>
                Join our D’Effetto World!!!
            </h2>
            <h3>
                Sign-up to our Newsletter and we will keep you up to date
            </h3>
        </div>
        <div class="col-md-6">
        <div class="form_container" id="newsletter">
          <p>
            With any upcoming products, the latest offers, and precious tips to share the best drinks ever!
          </p>
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
          <form action="index.php#newsletter" method="post" >
            <div>
              <input type="text" placeholder="Full Name" name="name" >
            </div>
            <div>
              <input type="text" placeholder="Email" name="email" >
            </div>
            <div class="d-flex ">
              <button type="submit" value="Subscribe" onClick="goHere()">
                Subscribe
              </button>
            </div>
          </form>
        </div>
      </div>
        <div class="col-md-6">
            <div class="img-box">
                <img src="images/email-3249062.png" alt="newsletter">
            </div>
        </div>
    </div>
  </div>
</section>
<!-- end newsletter section -->
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

<script>
    function goHere() {
        window.location.href = '#newsletter';
    }
</script>
</body>

</html>


