<?php 
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';

 $prefix = getDBPregix();
 $sql = "SELECT id,content,create_time
         FROM cc_newsletter ";
$orders=query($sql);
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
                      <h4 class="card-title ">Newsletter</h4>
					  <div class="col-2">
					    <a href="gonggao_add.php" class="btn btn-round btn-info" style="">Add news</a>
					  </div>
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
                        Content
                      </th>
                      <th>
                        Time modified
                      </th>
					  <th>
					    Operation
					  </th>
                      </thead>
                      <tbody>
						  <?php foreach($orders as $order): ?>
                      <tr>
                        <td>
                          <?php echo $order['id'];?>
                        </td>
                        <td>
                          <?php echo $order['content'];?>
                        </td>
                        <td>
                          <?php echo date('Y-m-d',$order['create_time']);?>
                        </td>
						<td>
						  <a href="gonggao_edit.php?id=<?php echo $order['id'] ?>">Edit</a>
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