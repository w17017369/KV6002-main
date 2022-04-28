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
   $product_image = "mug2.png";
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
      echo '<div class="message" style="font-size: 20px;"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   }
}
//-------end----------Add to cart button function
// Add to cart successfully alert box
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   }
}
// Add to cart successfully alert box

include 'header.php';

?>
	<!-- main section -->
<main>
<div class="container py-5">
<div class="row">
<div class="col">
  <div class="box"> <img id="myImg" src="img/mug2.png" alt="SF yellow mug"> </div>
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
$query = "SELECT * FROM product WHERE proid = 'p7'";
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
      <p>A blank yellow mug </p>
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
	
  

<?php
  include 'footer.php';
?>