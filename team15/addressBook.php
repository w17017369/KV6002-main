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
              
        //Create a sql query to retrieve address for current user using user_id
        $selectSQL = "SELECT *
              FROM address_info
              WHERE userid = $user_id";
              
        //Execute the query
        $queryResult = $dbConn->query( $selectSQL );
                                
        //Display dashboard
        echo "<div class='container-fluid display-table'>
          <div class='row display-table-row'>
            <div class='col-md-2 col-sm-1 hidden-xs display-table-cell v-align box' id='dashboard'>
              <div class='navi'>
                <ul>
                  <li><a href='profile.php'><i class='fa-solid fa-id-badge' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Profile</span></a></li>
                  <li><a href='orders.php'><i class='fa-solid fa-bag-shopping' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Orders</span></a></li>
                  <li><a href='favourites.php'><i class='fa-solid fa-heart' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Wish List</span></a></li>
                  <li class='active'><a href='addressBook.php'><i class='fa-solid fa-address-book' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Address Book</span></a></li>
                  <li><a href='changePassword.php'><i class='fa-solid fa-lock' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Change Password</span></a></li>
                  <li><a href='logout.php'><i class='fa-solid fa-arrow-right-from-bracket' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Log out</span></a></li>
                </ul>
              </div>
            </div>
          <div class='col-md-10 col-sm-11 display-table-cell v-align'>  
            <div class='user-dashboard'>
              <h1>My addresses</h1>";

      //Store result in variable
      $rowObj = $queryResult->fetchObject();
                                  
      //Check if variable is not empty
      if (!empty($rowObj)) {
        //Loop results
        while ($rowObj = $queryResult->fetchObject()) {
          //Display results in table
          echo "<table class='table'>
            <tr>
              <th><h3>{$rowObj->nickname}</h3></th>
                <td style='text-align:right;'>
                  
                  <a href='updateAddress.php?address_id={$rowObj->address_id}'><i class='fa-solid fa-pencil'></i></a>
                  <a href='deleteAddress.php?address_id={$rowObj->address_id}'><i class='fa-solid fa-trash-can'></i></a>
                </td>                              
              </tr>       
              <tr>
                <th>Name</th>
                <td>{$rowObj->real_name}</td>
              </tr>
              <tr>
                <th>Address Line 1</th>
                <td>{$rowObj->addressline1}</td>
              </tr>
              <tr>
                <th>Address Line 2</th>
                <td>{$rowObj->addressline2}</td>
              </tr>
              <tr>
                <th>Postcode</th>
                <td>{$rowObj->postcode}</td>
              </tr>
              <tr>
                <th>Phone</th>
                <td>{$rowObj->tel_phone}</td>
              </tr>";  
          }
          echo "</table>
              <div class='col-md-12 text-center' style='margin-top: 5%; margin-bottom: 5%;'>
                <a href='updateAddress.php'><button type='button' class='btn btn-primary'>Add an address</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>\n";
        } else {
          //If variable if empty display message
          echo "<h1 class='profile-error text-center'>You have no addresses available.</h1>\n";
          echo "<p class='profile-error text-center'><a href='updateAddress.php'>Add an address</a></p>
          </div>
        </div>
      </div>";    
        } 
      } else {
        //If user_id does not exist display message
        echo "<h1 class='profile-error text-center'>Please <a href='login.php'>log in</a> to access this page.</h1>\n";
      }
    } catch ( Exception $e ) {
      //Output error message
      echo "<h1 class='profile-error text-center'>There was a problem loading this page.</h1>\n";
      echo "<p class='profile-error text-center'>Please <a href='addressBook.php'>try again</a></p>";    

      //Log error
      log_error( $e );
    } 
    ?>
    <!-- main ends -->
    

<?php 
include 'footer.php';
?>
