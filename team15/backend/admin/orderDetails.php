<?php
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';

$id = $_GET['id'];
$prefix = getDBPregix();
$sql = "SELECT *,`B`.*,`D`.name as category_name FROM  {$prefix}order `A` 
    INNER JOIN {$prefix}products `B` ON `A`.products=`B`.proid
    INNER JOIN {$prefix}address_info `C` ON `C`.userid=`A`.uid
    LEFT JOIN {$prefix}type `D` ON `D`.id=`B`.cateid
    WHERE `A`.Id={$id} ORDER BY `A`.created_at DESC";
$orders = query($sql);
$orders = $orders[0];

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
                                    <h4 class="card-title ">Order Details: #<?php echo $id; ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr style="background: #dddddd">
                                        <th colspan="6">
                                            Order Info
                                        </th>
                                    </tr>
                                    <tr>
                                        <td width="140">Order NO</td>
                                        <td colspan="6"><?php echo $orders['order_no']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="140">Pay Status</td>
                                        <td colspan="6"><?php echo getPayStatusText($orders['pay_status']); ?></td>
                                    </tr>
                                    <?php if($orders['pay_status'] == 1){ ?>
                                        <tr>
                                            <td width="140">Pay Time</td>
                                            <td colspan="6"><?php echo $orders['paymenttime']; ?></td>
                                        </tr>
                                    <?php } elseif($orders['pay_status'] == 2) { ?>
                                        <tr>
                                            <td width="140">Send Time</td>
                                            <td colspan="6"><?php echo $orders['sendtime']; ?></td>
                                        </tr>
                                    <?php }elseif($orders['pay_status'] == 3) { ?>
                                        <tr>
                                            <td width="140">Finish Time</td>
                                            <td colspan="6"><?php echo $orders['endtime']; ?></td>
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <td width="140">Delivery Company</td>
                                        <td colspan="6"><?php echo $orders['delivery_company']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="140">Postage</td>
                                        <td colspan="6"><?php echo $orders['postage']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="140">Deposit</td>
                                        <td colspan="6">￥<?php echo $orders['dj']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="140">Remark</td>
                                        <td colspan="6"><?php echo $orders['remark']; ?></td>
                                    </tr>
                                    <tr  style="background: #dddddd">
                                        <th colspan="2">
                                            Product Name
                                        </th>
                                        <th width="100">Price</th>
                                        <th width="100">Count</th>
                                        <th width="100">Total</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <?php echo $orders['name']  ?>
                                        </td>
                                        <td>
                                            ￥<?php echo $orders['price']; ?>
                                        </td>
                                        <td>
                                            <?php echo $orders['quantity']; ?>
                                        </td>
                                        <td>
                                            ￥<?php echo round($orders['price'] * $orders['quantity'],2); ?>
                                        </td>
                                    </tr>
                                    <tr  style="background: #dddddd">
                                        <th colspan="6">
                                            Product Details
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>Total Money</td>
                                        <td colspan="6">
                                            ￥<?php echo round($orders['price'] * $orders['quantity'],2); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Product Category</td>
                                        <td colspan="6">
                                            <?php echo $orders['category_name'] ?>
                                        </td>
                                    </tr>
                                    <tr  style="background: #dddddd">
                                        <th colspan="6">
                                            Address Info
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>Receiver Name</td>
                                        <td colspan="6">
                                            <?php echo $orders['receiver_name']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tel</td>
                                        <td colspan="6">
                                            <?php echo $orders['tel_phone']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td colspan="6">
                                            <?php echo $orders['address']; ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button <?php if($orders['pay_status'] < 1){ echo "disabled";} ?> class="btn btn-danger" onclick="refund(<?php echo $id ?>)" >Refunds</button>
                                <button <?php if($orders['pay_status'] == 2 || $orders['pay_status'] == -1 || $orders['pay_status'] == 3){ echo "disabled";} ?> class="btn btn-warning" onclick="mySend(<?php echo $id ?>)" >Shipping</button>
                                <button <?php if($orders['pay_status'] != 2){ echo "disabled";} ?> class="btn btn-success" onclick="myEnd(<?php echo $id ?>)" >Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
       function refund(id){
           if(confirm('Determined to get a refund')){
               window.location.href = 'refund.php?id=' + id
           }
       }
       function mySend(id){
           if(confirm('Make sure you want to ship')){
               window.location.href = 'mySend.php?id=' + id
           }
       }
       function myEnd(id){
           if(confirm('Determine to complete')){
               window.location.href = 'myEnd.php?id=' + id
           }
       }
    </script>
<?php
require 'footer.php';
?>