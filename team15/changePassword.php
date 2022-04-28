<?php
require_once( "functions.php" );
include 'header.php';

// Make database connection 
$connect = getConnection();
?>


    <!-- main -->
    <?php
    try {
      //Check if user_id exists 
      if (isset($_SESSION[ 'user_id'])) {
        //If user_id exists store user_id in variable
        $user_id = $_SESSION[ 'user_id'];
                              
        //Get database connection
        $dbConn = getConnection();
            
        //Create a sql query to retrieve current users data
        $selectSQL = "SELECT *
              FROM dsf_users
              WHERE userid = $user_id";
            
        //Execute the query
        $queryResult = $dbConn->query( $selectSQL );

        //Store results in variable
        $rowObj = $queryResult->fetchObject();
 
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
          <div class='col-md-10 col-sm-11 display-table-cell v-align'>
          <div class='user-dashboard'>
            <h1>Change password</h1>
            <div class='row'>
              <form class='update-details-form' action='changePasswordProcess.php' method='post'>
                <label class='update-details-label' for='oldpassword'>Old password:</label>
                <input class='update-details-input' type='password' class='form-control' name='oldpassword' placeholder='Old password' minlength='8' pattern='(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' autocomplete='current-password' title='8 or more characters, at least one uppercase, lowercase and number' accesskey='o' tabindex='1' required />
                <label class='update-details-label' for='newpassword'>New password:</label>
                <input class='update-details-input' type='password' class='form-control' name='newpassword' placeholder='New password' title='8 or more characters, at least one uppercase, lowercase and number' accesskey='n' minlength='8' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}' tabindex='2' required />
                <label class='update-details-label' for='confirmpassword'>Confirm password:</label>
                <input class='update-details-input' type='password' class='form-control' name='confirmpassword' placeholder='Confirm password' title='8 or more characters, at least one uppercase, lowercase and number' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}' accesskey='c' minlength='8' tabindex='3' required />
                <div class='update-details-submit'>
                  <button type='submit' class='btn btn-primary'>Save changes</button>
                </div>
              </form>  
            </div>
          </div>
        </div>
      </div>
    </div>\n";
      } else {
        //If user_id doesn't exist diplay message
        echo "<h1 class='profile-error text-center'>Please <a href='login.php'>log in</a> to access this page.</h1>\n";
      }
    } catch ( Exception $e ) {
      //Output error message
      echo "<h1 class='profile-error text-center'>There was a problem loading this page.</h1>\n";
      echo "<p class='profile-error text-center'>Please <a href='changePassword.php'>try again</a></p>";

      //Log error
      log_error( $e );
    }
    ?>
    <!-- main ends -->

<?php 
include 'footer.php';
?>
