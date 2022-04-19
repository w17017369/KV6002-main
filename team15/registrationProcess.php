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
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
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
                        <li><a href='customerAccount.php'>Account</a></li>
                        <li><a href='logout.php'>Log out</a></li>
                      </ul>
                    </div>"; // Logout button
                  }
                } else {
                  echo "<div class='dropdown'>
                    <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>
                      <i class='fa fa-user' aria-hidden='true'></i>
                    </button>
                    <ul class='dropdown-menu'>
                      <li><a href='cusomerAccount.php'>Account</a></li>
                      <li><a href='login.php'>Login</a></li>
                    </ul>
                  </div>"; // Logout button
                }
              } catch ( Exception $e ) {
                //Output error message
                echo "<p>problem occured</p>\n";
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
		//Retrieve variables from login form
		$firstname = filter_has_var(INPUT_POST, 'firstname') ? $_POST['firstname'] : null;
		$surname = filter_has_var(INPUT_POST, 'surname') ? $_POST['surname'] : null;
		$username = filter_has_var(INPUT_POST, 'username') ? $_POST['username'] : null;
		$newpassword = filter_has_var(INPUT_POST, 'newPassword') ? $_POST['newPassword'] : null;
		$confirmpassword = filter_has_var(INPUT_POST, 'confirmPassword') ? $_POST['confirmPassword'] : null;
		$referer = filter_has_var(INPUT_POST, 'referer') ? $_POST['referer']: null;
    $email = filter_has_var(INPUT_POST, 'email') ? $_POST['email']: null;
    $phone = filter_has_var(INPUT_POST, 'phone') ? $_POST['phone']: null;
		
		//Remove whitespace from variables
		$firstname = trim($firstname);
		$surname = trim($surname);
		$username = trim($username);
		$newpassword = trim($newpassword);
		$confirmpassword = trim($confirmpassword);
    $email = trim($email);
    $phone = trim($phone);
		
		//Check if first name, last name , username, password is empty
		if (empty($firstname) || empty($username) || empty($newpassword) || empty($confirmpassword) || empty($email)) {
			//If empty display message - URL needs to be changed depending on which group member is programming the website 
			echo "<div class='container'>
				<div class='text-center py-5'>
				  <h1>PLEASE FILL IN ALL THE FIELDS</h1>
			    <p>Please <span class='try-again'><a href='registration.php'>try again.</a></span></p>
			  </div>
			</div>\n";
		}
	  //Check if both passwords are the same
		else if ($newpassword != $confirmpassword) {
			//If not display error message - URL needs to be changed depending on which group member is programming the websit
			echo "<div class='container'>
				<div class='text-center py-5'>
					<h1>PASSWORDS DO NOT MATCH</h1>
			    <p>Please <span class='try-again'><a href='registration.php'>try again.</a></span></p>
			  </div>
			</div>\n";
		}
		else {
			//set cost and store in variable
			$option = ['cost' => 12,];
			//hash password to store in database
			$passwordHash = password_hash($newpassword, PASSWORD_DEFAULT, $option);
			
			try {
				//connect to databse
				require_once("functions.php");
				$dbConn = getConnection();
				
				//Insert new user record into databse
				$querySQL = "INSERT INTO dsf_users (username, password_hash, phone, role, email, firstname, surname) VALUES (:username, :password_hash, :phone, 1, :email, :firstname, :surname)";
				
				//use prepared statement to execute query
				$stmt = $dbConn->prepare($querySQL);
				$stmt->execute(array(':username' => $username, ':password_hash' => $passwordHash, ':phone' => $phone, ':email' => $email, ':firstname' => $firstname, ':surname' => $surname));
				
				//use select query to retrieve usernames from databse
				$selectSQL = "SELECT username
							FROM dsf_users";
				//execute query and fetch data
				$queryResult = $dbConn->query( $selectSQL );
        $user = $queryResult->fetchObject();
				
				if ($user) {
					//check if username already exists in databse
					if ($username == ':username') {
						//if it does display error message
						echo "<div class='container'>
							<div class='text-center py-5'>
								<h1>USERNAME IS ALREADY TAKEN</h1>
						    <p>Please <span class='try-again'><a href='registration.php'>try again.</a></span></p>
						  </div>
						</div>\n";
					} 
					else {
						//Set session variable-logged-in to true
						$_SESSION['logged-in'] = true;
						
						//If username does not exist check if referer is the same as continue page url
						if ($referer == '') {
							//If it is redirect browser to checkout page
							header('Location: checkout.php');
						}
						else {
							//if not redirect to home page
							header('Location: login.php');
						}
					}
				}
			} catch (Exception $e) {
	    	//Output error message
	  		echo "<div class='container'>
					<div class='text-center py-5'>
						<h1>USERNAME IS ALREADY TAKEN something else</h1>
				    <p>Please <span class='try-again'><a href='registration.php'>try again.</a></span></p>
				  </div>
				</div>\n";
	  		//Log errors
	  		log_error($e);
			}
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