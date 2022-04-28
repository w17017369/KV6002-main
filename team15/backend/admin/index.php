<?php 
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';
$prefix = getDBPregix();
$sql = "SELECT id,adminuser,created_at,login_at,login_ip
        FROM {$prefix}admin ORDER BY created_at DESC";
$data=query($sql);
// var_dump($data);die;
require 'header.php';





?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Admin</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        Username
                      </th>
                      <th>
                        Create time
                      </th>
                      <th>
                        Last log in time
                      </th>
                      <th>
                        Login IP
                      </th>
                      </thead>
                      <tbody>
				<?php foreach($data as $admin):?>
                      <tr>
                        <td>
                          <?php echo $admin['id']; ?>
                        </td>
                        <td>
                          <?php echo $admin['adminuser']; ?>
                          
                        </td>
                        <td>
                          <?php echo date('Y-m-d',$admin['created_at']); ?>
                          
                        </td>
                        <td>
                          <?php echo date('Y-m-d',$admin['login_at']); ?>
                          
                        </td>
                        <td>
                          <?php echo long2ip($admin['login_ip']); ?>
                          
                        </td>
                      </tr>
					<?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php
require 'footer.php';


?>