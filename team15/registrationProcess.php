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
                    <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>
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
		//Retrieve variables from registration form
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
		
		//Check if variables are empty - display message if they are
		if (empty($firstname) || empty($username) || empty($newpassword) || empty($confirmpassword) || empty($email)) {
			echo "<h1 class='profile-error text-center'>Please fill in all the fields</h1>\n";
      echo "<p class='profile-error text-center'>Click <a href='registration.php'>here</a> to go back</p>";
		}
	  //Check if both passwords are the same - display message if they are
		else if ($newpassword != $confirmpassword) {
			echo "<h1 class='profile-error text-center'>Passwords do not match</h1>\n";
      echo "<p class='profile-error text-center'>Click <a href='registration.php'>here</a> to go back</p>";
		}
		else {
			//Set cost and store in variable
			$option = ['cost' => 12,];
			//Hash password to store in database
			$passwordHash = password_hash($newpassword, PASSWORD_DEFAULT, $option);
			
			try {
				//Connect to databse
				$dbConn = getConnection();
				
				//Insert new user record into databse
				$querySQL = "INSERT INTO dsf_users (username, password_hash, phone, role, email, firstname, surname) 
              VALUES (:username, :password_hash, :phone, 1, :email, :firstname, :surname)";
				
				//Use prepared statement to execute query
				$stmt = $dbConn->prepare($querySQL);
				$stmt->execute(array(':username' => $username, ':password_hash' => $passwordHash, ':phone' => $phone, ':email' => $email, ':firstname' => $firstname, ':surname' => $surname));
				
				//Use select query to retrieve all usernames from databse
				$selectSQL = "SELECT username
							FROM dsf_users";

				//Execute query and fetch data
				$queryResult = $dbConn->query( $selectSQL );
        $user = $queryResult->fetchObject();
				
				if ($user) {
					//Check if username already exists in database
					if ($username == ':username') {
						//If it does display error message
						echo "<h1 class='profile-error text-center'>Username is already taken</h1>\n";
            echo "<p class='profile-error text-center'>Click <a href='registration.php'>here</a> to go back</p>";
					} 
					else {
						//Set session variable-logged-in to true
						$_SESSION['logged-in'] = true;

            //Set success variable to true
            $success= true;

            //If success is true retrieve use id and store in sessions
            if ($success) {
              //Query database to retrieve user id for user
              $userSQL = "SELECT userid
                    FROM dsf_users
                    WHERE username = :username";
              
              //Prepare SQL statement using PDO
              $userstmt = $dbConn->prepare($userSQL);
              
              //Execute query using PDO
              $userstmt->execute(array(':username' => $username));
              
              //Retreive user record
              $user_id = $userstmt->fetchObject();

              //Store user id in session variable
              $_SESSION['user_id'] = $user_id->userid;
            } else {
              //If success is false display error message
              echo "<h1 class='profile-error text-center'>There was a problem loading this page.</h1>\n";
              echo "<p class='profile-error text-center'>Please <a href='registration.php'>try again</a></p>";
            }
					}
				}
			}
       catch (Exception $e) {
	    	//Output error message
	  		echo "<h1 class='profile-error text-center'>There was a problem loading this page.</h1>\n";
        echo "<p class='profile-error text-center'>Please <a href='registration.php'>try again</a></p>";

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