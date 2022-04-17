<?php
// Session variables are stored in a folder specified below

ini_set( "session.save_path", "/home/unn_w19015804/sessionData" );

// Create a new session with a session ID
session_start();

// To establish a connect to the database, PHP code from another file needs to be embedded 
require_once( "functions.php" );
// Make database connection 
$connect = getConnection();

//$message = '';

/*// To check if a particular item has been added into cart, an if statement and under condition there's an isset function with the add_to_cart variable. If the cart variable .
if ( isset( $_POST[ "add_to_cart" ] ) ) {
  // If the item has already been added to the cart then this following block code will execute
  if ( isset( $_COOKIE[ "shopping_cart" ] ) ) {
    // Stripslashes function will remove any backslashes
    $cookie_data = stripslashes( $_COOKIE[ 'shopping_cart' ] );
    // This will convert JSON string to PHP variable and store it under cart_data variable 
    $cart_data = json_decode( $cookie_data, true );
    // Else if the if statement is false then the cart_data is equal to blank array
  } else {
    $cart_data = array();
  }
  // To get a list of item IDs that has been added into shopping cart, this function has been created. This will return value of item_id key from cart_data variable and store it under item_id_list variable
  $item_id_list = array_column( $cart_data, 'item_id' );

  // If a user has added the same item into the shopping cart then ONLY the quantity will need to be increased, not the whole item added again
  if ( in_array( $_POST[ "hidden_id" ], $item_id_list ) ) {
    // This foreach loop function is checking whether or not the same item has been added 
    foreach ( $cart_data as $keys => $values ) {
      // If the same item has been added then the quantity value will increase, so This code will not add new an item into the shopping cart, only the item quantity will be changed when the same item add has been added
      if ( $cart_data[ $keys ][ "item_id" ] == $_POST[ "hidden_id" ] ) {
        $cart_data[ $keys ][ "item_quantity" ] = $cart_data[ $keys ][ "item_quantity" ] + $_POST[ "quantity" ];
      }
    }
    // Else if a new item has been added to the shopping cart then this block of code will be executed 
  } else {
    // Storing all form data (below) into item_array variable
    $item_array = array(
      'item_id' => $_POST[ "hidden_id" ], // item_id value is set to get from post hidden_id
      'item_name' => $_POST[ "hidden_name" ], // item_name value is set to get from post hidden_name
      'item_price' => $_POST[ "hidden_price" ], // item_price value is set to get from hidden_price
      'item_quantity' => $_POST[ "quantity" ] // item_quantity value is set to get from quantity
    );
    // The item_array data is then stored into this $cart_data[]
    $cart_data[] = $item_array;
  }

  // $item_data variable is created to convert PHP array to JSON string
  // setcookie function takes three arguments - first argument is shopping_cart which is the name of this cookie, second argument is item_data which is data from $item_array which then stored under this shopping_cart variable and the third argument is the time function, 86400 * 30 = 1 day - meaning this cookie data will be expired after one day.
  // Once a user has added an item into the cart, the page will redirect to shoppingCart.php?success=1
  $item_data = json_encode( $cart_data );
  setcookie( 'shopping_cart', $item_data, time() + ( 86400 * 30 ) );
  header( "location:shoppingCart.php?success=1" );
}

if ( isset( $_GET[ "action" ] ) ) {

  // Create Delete function - delete item from the shopping cart
  if ( $_GET[ "action" ] == "delete" ) {
    // Remove backslpashes
    $cookie_data = stripslashes( $_COOKIE[ 'shopping_cart' ] );
    // Convert JSON string to PHP variable
    $cart_data = json_decode( $cookie_data, true );
    foreach ( $cart_data as $keys => $values ) {
      if ( $cart_data[ $keys ][ 'item_id' ] == $_GET[ "id" ] ) {
        // Unset function will destroy $keys
        unset( $cart_data[ $keys ] );
        // To update array data in cookie variable, cart_data array needs to be converted to JSON string
        $item_data = json_encode( $cart_data );
        // setcookie function takes three arguments - first argument is shopping_cart which is the name of this cookie, second argument is item_data which is data from $item_array which then stored under this shopping_cart variable and the third argument is the time function, 86400 * 30 = 1 day. This function will update the shopping cart cookie data
        // Once an item has been removed, the page will redirect to shoppingCart.php?remove=1
        setcookie( "shopping_cart", $item_data, time() + ( 86400 * 30 ) );
        header( "location:shoppingCart.php?remove=1" );
      }
    }
  }
  // This is 'Clear all' function
  if ( $_GET[ "action" ] == "clear" ) {
    // Time() - 3600 will expire shopping cart cookie variable with blank data so the shopping cart data will be destroyed
    // Then this page will be redirected to shoppingCart.php?clearall=1 URL after a user has clicked clear all button
    setcookie( "shopping_cart", "", time() - 3600 );
    header( "location:shoppingCart.php?clearall=1" );
  }

} */


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

  <title>Black SF signature cap - SF Products</title>
  


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
	
	<!-- main section -->
<main>
<div class="container py-5">
<div class="row">
<div class="col">
  <div class="box">  <img id="myImg" src="img/blackcap.png" alt="SF black cap">  </div>
</div>
	
	<!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

<?php

$dbConn = getConnection();


// Create the Publisher query - SELECT 
$query = "SELECT * FROM product WHERE proid = 'p1'";
// Execute the query
$statement = $connect->prepare( $query );
$statement->execute();
$result = $statement->fetchObject();
?>
<div class="col box textContainer">
  <div>
  <!-- Display the results in the form format -->
  <form name="myform" method="post" role="form">
    <div class="form-group"> 
      <!-- Display the product name from the database -->
      <h2><?php echo "{$result->name}" ?></h2>
      <p>A simple black cap with the SF signature on. </p>
			  <div>
  <i class="heart fa fa-heart-o"></i>
</div>
    </div>
    <div class="form-group"> 
      <!-- Display the product price from the database -->
      <h4> <?php echo "£{$result->price}" ?></h4>
      <!-- A user can input their desire quantity by typing straight into the inuput box -->
      <label for="quantity">Quantity:</label>
      <span>
      <input type="number" name="quantity" id="quantity" value="1" class="form-control" autocomplete="off"  min="1" max="5"/>
      </span> </div>
    <input type="hidden" name="hidden_name" value="<?php echo "{$result->name}" ?>" />
    <input type="hidden" name="hidden_price" value="<?php echo "{$result->price}"?>" />
    <input type="hidden" name="hidden_id" value="<?php echo "{$result->proid}" ?>" />
    <button type="submit" name="add_to_cart" class="btn btn-success submit-btn">Add to Cart</button>
    </div>
  </form>
</div>
</main>
<!-- End of main --> 
	
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
	
<!-- Optional JavaScript --> 
<!-- jQuery first, then Popper.js, then Bootstrap JS --> 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
<!-- Font Awesome Kit - this is link to an account --> 
<script src="https://kit.fontawesome.com/799d082bbd.js" crossorigin="anonymous"></script> 
<!-- CUSTOM JAVASCRIPT FOR THIS WEBSITE --> 
<script src="product.js" type="text/javascript"></script>
	<script>
// Initiate zoom effect:
imageZoom("myimage", "myresult");
</script>
</body>
</html>
