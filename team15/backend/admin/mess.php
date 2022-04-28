<?php 
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';


 $sql = "SELECT id,uid,title,content,create_time
         FROM topic ORDER BY create_time ASC";
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
                      <h4 class="card-title ">All posts</h4>
                      <p class="card-category"> List of posts</p>
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
                        User name
                      </th>
            <th>
              Title
            </th>
                      <th>
                        Content
                      </th>
                      <th>
                        Publish time
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
                          <?php 
              $uid = $order['uid'] ;
              $sql="SELECT *FROM cc_user WHERE id = '$uid' ";
              $uname = queryOne($sql);
               echo $uname['username'];
              ?>
                          
                        </td>
            <td>
              <?php echo $order['title'];?>
            </td>
                        <td>
                          <?php echo $order['content'];?>
                        </td>
                        <td>
                          <?php echo date('Y-m-d',$order['create_time']);?>
                        </td>
            <td>
              <a href="mess_del.php?id=<?php echo $order['id'] ?>">Delete</a>
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