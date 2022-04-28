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
            
        //Query database for orders of current user and display in descending order
        $selectSQL = "SELECT *
              FROM orders
              WHERE userid = $user_id
              ORDER BY userid DESC";
            
        //Execute the query
        $queryResult = $dbConn->query( $selectSQL );

        //Display dashboard and table header
        echo "<div class='container-fluid display-table'>
          <div class='row display-table-row'>
            <div class='col-md-2 col-sm-1 hidden-xs display-table-cell v-align box' id='dashboard'>
              <div class='navi'>
                <ul>
                  <li><a href='profile.php'><i class='fa-solid fa-id-badge' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Profile</span></a></li>
                  <li class='active'><a href='orders.php'><i class='fa-solid fa-bag-shopping' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Orders</span></a></li>
                  <li><a href='favourites.php'><i class='fa-solid fa-heart' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>My Wish List</span></a></li>
                  <li><a href='addressBook.php'><i class='fa-solid fa-address-book' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Address Book</span></a></li>
                  <li><a href='changePassword.php'><i class='fa-solid fa-lock' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Change Password</span></a></li>
                  <li><a href='logout.php'><i class='fa-solid fa-arrow-right-from-bracket' aria-hidden='true'></i><span class='hidden-xs hidden-sm'>Log out</span></a></li>
                </ul>
              </div>
            </div>
          <div class='col-md-10 col-sm-11 display-table-cell v-align'> 
          <div class='user-dashboard'>
            <h1>My orders</h1>
            <table class='table'>
              <thead>
                <tr>
                  <th scope='col'>Order number</th>
                  <th scope='col'>Created</th>
                  <th scope='col'>Status</th>
                  <th scope='col'>Price</th>
                  <th scope='col'>Last updated</th>
                </tr>
              </thead>";

        //Loop results
        while ($rowObj = $queryResult->fetchObject()) {

          //Store status in variable
          $status = $rowObj->status;

          //If status is not empty store message in variable accordingly
          if (!empty($status)) {
            if ($status = 0) {
              $status = "Cancelled";
            } 
            if ($status = 1) {
              $status = "Unpaid";
            } 
            if ($status = 2) {
              $status = "Paid";
            } 
            if ($status = 3) {
              $status = "Delivered";
            } 
            if ($status = 4) {
              $status = "Transaction successful";
            } 
            if ($status = 5) {
              $status = "Transaction closed";
            }     
          } else {
            $status = "Unavailable";
          }

          //Display results in table
          echo "<tbody>
            <tr>
              <th scope='row'>{$rowObj->orderid}</th>
              <td>{$rowObj->createtime}</td>
              <td>{$rowObj->status}</td>
              <td>{$rowObj->payment}</td>
              <td>{$rowObj->updatetime}</td>
            </tr>
          </tbody>";                           
        }
        echo "</table>
        </div>
      </div>
    </div>
  </div>\n";
      } else {
        //If user if is empty display message
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
