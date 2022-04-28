
<?php
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';
$prefix = getDBPregix();
$sql ="SELECT id,name,create_time
      FROM {$prefix}type ORDER BY id ASC";
$res=query($sql);  
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
                    <div class="col-10">
                      <h4 class="card-title ">Category</h4>
                    </div>
                    <div class="col-2">
                      <a href="type_add.php" class="btn btn-round btn-info" style="margin-left: 20px;">Add product category</a>
                    </div>
                  </div>

                </div>
                <div class="card-body">
					<p style="color: red;"><?php if(hasInfo()) echo getInfo(); ?></p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class=" text-primary">
                      <th>
                        No.
                      </th>
                      <th>
                        Category Name
                      </th>
                      <th>
                        Create time
                      </th>
                      <th>
                        Edit
                      </th>
                      </thead>
                      <tbody>
					  <?php foreach($res as $products): ?>
                      <tr>
                        <td>
                          <?php echo $products['id']; ?>
                        </td>
                        <td>
                          <?php echo $products['name']; ?>
                        </td>
                        <td>
                          <?php echo date('Y-m-d',$products['create_time']); ?>
                        </td>
                        <td>
                          <a href="type_edit.php?id=<?php echo $products['id']; ?>">Edit</a>
                          |
						
                          <a href= "javascript:if(confirm('Confirm Delete?')) location='type_del.php?id=<?php echo $products['id']; ?>'">Delete</a>
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