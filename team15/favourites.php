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

        //Display dashboard
        echo "<div class='container-fluid display-table'>
          <div class='row display-table-row'>
            <div class='col-md-2 col-sm-1 hidden-xs display-table-cell v-align box' id='dashboard'>
              <div class='navi'>
                <ul>
                  <li><a href='profile.php'><i class='fa-solid fa-id-badge' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Profile</span></a></li>
                  <li><a href='orders.php'><i class='fa-solid fa-bag-shopping' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Orders</span></a></li>
                  <li class='active'><a href='favourites.php'><i class='fa-solid fa-heart' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Wish List</span></a></li>
                  <li><a href='addressBook.php'><i class='fa-solid fa-address-book' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Address Book</span></a></li>
                  <li><a href='changePassword.php'><i class='fa-solid fa-lock' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Change Password</span></a></li>
                  <li><a href='logout.php'><i class='fa-solid fa-arrow-right-from-bracket' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Log out</span></a></li>
                </ul>
              </div>
            </div>
          <div class='col-md-10 col-sm-11 display-table-cell v-align'>
              <div class='user-dashboard'>
                <h1>Saved items</h1>
                  <table class='table'>
                    <thead>
                      <tr>
                        <th scope='col'>Product</th>
                        <th scope='col'>Product Name</th>
                      </tr>
                    </thead>";
                              
        //Get database connection
        $dbConn = getConnection();
            
        //Create sql query to retrieve all saved items for current user in favourites table
        $selectSQL = "SELECT *
              FROM favourites
              WHERE userid = $user_id";
            
        //Execute the query
        $queryResult = $dbConn->query( $selectSQL );

        //Loop results to display all recorda
        while ($rowObj = $queryResult->fetchObject()) {                
          echo "<tbody>
            <tr>
              <td style='width: 50%;'><img style='width: 25%;' class='fav-img' src='img/{$rowObj->image}' alt='{$rowObj->name}'></td>
              <td>{$rowObj->name}</td>
              <td><a href='deleteFavourites.php?favid={$rowObj->favid}'><i class='fa-solid fa-trash-can'></i></a></td>                  
            </tr>
          </tbody>";               
          }
          echo "</table>
              </div>
            </div>
          </div>
        </div>\n";
      } else {
        //If user does not exist display message
        echo "<h1 class='profile-error text-center'>Please <a href='login.php'>log in</a> to access this page.</h1>\n";
      }
    } catch ( Exception $e ) {
      //Output error message
      echo "<h1 class='profile-error text-center'>There was a problem loading this page.</h1>\n";
      echo "<p class='profile-error text-center'>Please <a href='favourites.php'>try again</a></p>";
          
      //Log error
      log_error( $e );
    }
    ?>
    <!-- main ends -->
    
