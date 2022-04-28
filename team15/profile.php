<?php
  //sessionData path
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
              
        //Query database for current user details
        $selectSQL = "SELECT *
              FROM dsf_users
              WHERE userid = $user_id";
              
        //Execute the query
        $queryResult = $dbConn->query( $selectSQL );
        $rowObj = $queryResult->fetchObject();

        //Display dashboard and profile
        echo "<div class='container-fluid display-table'>
          <div class='row display-table-row'>
            <div class='col-md-2 col-sm-1 hidden-xs display-table-cell v-align box' id='dashboard'>
              <div class='navi'>
                <ul>
                  <li class='active'><a href='profile.php'><i class='fa-solid fa-id-badge' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Profile</span></a></li>
                  <li><a href='orders.php'><i class='fa-solid fa-bag-shopping' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Orders</span></a></li>
                  <li><a href='favourites.php'><i class='fa-solid fa-heart' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Wish List</span></a></li>
                  <li><a href='addressBook.php'><i class='fa-solid fa-address-book' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Address Book</span></a></li>
                  <li><a href='changePassword.php'><i class='fa-solid fa-lock' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Change Password</span></a></li>
                  <li><a href='logout.php'><i class='fa-solid fa-arrow-right-from-bracket' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Log out</span></a></li>
                </ul>
              </div>
            </div>
          <div class='col-md-10 col-sm-11 display-table-cell v-align'>      
            <div class='user-dashboard'>
              <h1>Hello, {$rowObj->username}</h1>
              <div class='row'>
                <table>
                  <thead>
                    <tr>
                      <td class='profile-column'><h5>Your details:</h5></td>
                      <td class='profile-first-column'></td>
                      <td class='profile-first-column'><a href='updateDetails.php'><i class='fa-solid fa-pencil'></i></a></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class='profile-column'><b>First name:</b></td>
                      <td class='profile-first-column'>{$rowObj->firstname}</td>
                    </tr>
                    <tr>
                      <td class='profile-column'><b>Last name:</b></td>
                      <td class='profile-first-column'>{$rowObj->surname}</td>
                    </tr>
                    <tr>
                      <td class='profile-column'><b>Email:</b></td>
                      <td class='profile-column'>{$rowObj->email}</td>
                    </tr>
                    <tr>
                      <td class='profile-column'><b>Phone:</b></td>
                      <td class='profile-column'>{$rowObj->phone}</td>
                    </tr>
                  </tbody>  
                </table>                      
              </div>
            </div>
          </div>
        </div>
      </div>\n";
      } else {
        //If user id does not exist display message
         echo "<h1 class='profile-error text-center'>Please <a href='login.php'>log in</a> to access this page.</h1>\n";
      }
    } catch ( Exception $e ) {
      //Output error message
      echo "<h1 class='profile-error text-center'>There was a problem loading this page.</h1>\n";
      echo "<p class='profile-error text-center'>Please <a href='profile.php'>try again</a></p>";
                        
      //Log error
      log_error( $e );
    }
    ?>
    <!-- main ends -->
    
<?php 
include 'footer.php';
?>
