<?php 
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';

 $prefix = getDBPregix();
 $sql = "SELECT *
         FROM {$prefix}order ORDER BY created_at DESC";
$orders=query($sql);
// $back_cart_data[]=$cart;


function getUserById($uid) {
  $mysqli = connect();
  $result = mysqli_query($mysqli, "select * from cc_user where Id=$uid");
  $row =mysqli_fetch_assoc($result);
  return $row;
}

//  Get order status
function getPayStatusText($status){
    $arr = [
            '-1'=>'Refunded',
            '0'=>'Payment pending',
            '1'=>'Paid',
            '2'=>'Shipped',
            '3'=>'Completed',
    ];
    return $arr[$status];
}

 // var_dump($back_cart_data);die;
require 'header.php';
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <div class="row">
                    <div class="col-12">
                      <h4 class="card-title ">All orders</h4>
                      
                    </div>
                  </div>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        Order User ID
                      </th>
                     
                      <th>
                        Order Price
                      </th>
					  <th>
					    Order deposit
					  </th>
					  <th>
					    Products amount
					  </th>
                      <th>
                        Order time
                      </th>
                      <th>
                        Order Status
                      </th>
                      <th>
                        Order Operate
                      </th>
                      </thead>
                      <tbody>
						  <?php  
                foreach($orders as $order): 
                  $data = getUserById($order['uid']);
              ?>
                      <tr>
                        <td>
                          <?php echo $order['id'];?>
                        </td>
                        <td>
                          <?php echo $order['uid'];?>
                        </td>
                        <td>
                          <?php echo $order['price'];?>
                        </td>
                       
						<td>
						  <?php echo $order['dj'];?>
						</td>
						<td>
						  <?php echo $order['quantity'];?>
						</td>
                        <td>
                          <?php echo date('Y-m-d',$order['created_at']);?>
                          
                        </td>
                        <td>
                          <?php echo getPayStatusText($order['pay_status']);?>
                        </td>
                        <td>
<!--                          <a href="outofstock.php?id=--><?php //echo $order['id']; ?><!--">-->
<!--                            <button>Out Of Stock</button>-->
<!--                          </a>-->
						  <a href="orderDetails.php?id=<?php echo $order['Id']; ?>">
						    <button class="btn btn-info">Details</button>
						  </a>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="8" style="background:#eee;">
                        Consignee Information:
                          Username:
                        <?php echo $data['username'];?>
                        &nbsp;|&nbsp;
                        Email:
                        <?php echo $data['email'];?>
                        &nbsp;|&nbsp;
                        Phone:
                        <?php echo $data['phone'];?>
                        &nbsp;|&nbsp;
                        Address:
                        <?php echo $order['address'];?>
                        </td>
                      </tr>
					  <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    require 'footer.php';
    ?>