<?php
// Session variables are stored in a folder specified below
// To establish a connect to the database, PHP code from another file needs to be embedded 
require_once( "functions.php" );
// Make database connection 
$connect = getConnection();

//-------start----------Add to cart button function
$login_url = "login.php";
if(isset($_POST['add_to_cart'])){

  //Check if session variable logged-in exists and whether it is true/false
  if ( !isset( $_SESSION[ 'logged-in' ] ) ) {
    header("Location: $login_url");
  }

   $uid = $_SESSION['user_id'];
   $product_name = $_POST['hidden_name'];
   $product_price = $_POST['hidden_price'];
   $product_image = "whitecase.png";
   $product_quantity = $_POST['quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity, uid) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity', '$uid')");
      $message[] = 'product added to cart succesfully';
   }
}


if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   }
}
//-------end----------Add to cart button function
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

  <title>White phone case - SF Products</title>
  


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
  <div class="box"> <img id="myImg" src="img/whitecase.png" alt="White phone case"> </div>
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
$query = "SELECT * FROM product WHERE proid = 'p9'";
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
      <p>Plain white phonecase </p>
    </div>
	  	  	  	  	  	  			  <div>
  <i class="heart fa fa-heart-o"></i>
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
</body>
</html>