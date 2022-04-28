<?php
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';
$prefix = getDBPregix();
if (empty($_POST['name'])) {
    $sql = "SELECT * FROM {$prefix}products ORDER BY createtime DESC";
} else {
    $name = $_POST['name'];
    $sql = "SELECT * FROM {$prefix}products WHERE name like '%$name%' ORDER BY createtime DESC";
}
$res = query($sql);
function type($tid)
{
    $prefix = getDBPregix();
    $sqll = "SELECT * FROM {$prefix}type WHERE id = '$tid' ";
    $ress = queryOne($sqll);
    echo $ress['name'];
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
                                <div class="col-10">
                                    <h4 class="card-title ">All products</h4>
                                </div>
                                <div class="col-2">
                                    <a href="product_add.php" class="btn btn-round btn-info" style="margin-left: 20px;">Add
                                        product</a>

                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <p style="color: red;"><?php if (hasInfo()) echo getInfo(); ?></p>
                            <div class="table-responsive">
                                <form action="" method="post">
                                    <input name="name" placeholder="Enter product name"/>
                                    <input type="submit"/>
                                </form>
                                <table class="table table-hover text-center">
                                    <thead class=" text-primary">
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Inventory</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Create time</th>
                                    <th>Operate</th>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($res as $products): ?>
                                        <tr>
                                            <td>
                                                <?php echo $products['proid']; ?>
                                            </td>
                                            <td>
                                                <?php echo $products['name']; ?>
                                            </td>
                                            <td>
                                                <?php type($products['cateid']); ?>
                                            </td>
                                            <td>
                                                <img onerror="nofind()" style="width: 100px;height: 100px;border-radius: 5px"
                                                     src="<?php echo '../admin/' . $products['image']; ?>" alt="">
                                            </td>
                                            <td>
                                                <?php echo $products['stock']; ?>
                                            </td>
                                            <td>
                                                <?php echo $products['price']; ?>
                                            </td>
                                            <td>
                                                <?php if($products['status'] == 1){ ?>
                                                    <span class="badge badge-success">On Sale</span>
                                                <?php }elseif($products['status'] == 2){ ?>
                                                    <span class="badge badge-dark">Take Down</span>
                                                <?php }else{ ?>
                                                    <span class="badge badge-danger">Deleted</span>
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php echo $products['createtime']; ?>
                                            </td>
                                            <td>
                                                <a href="product_edit.php?id=<?php echo $products['proid']; ?>">Edit</a>|
                                                <a href="javascript:if(confirm('Confitm Delete?')) location='product_del.php?id=<?php echo $products['proid']; ?>'">Delete</a>
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

    <script>
        function nofind(){
            var img=event.srcElement;
            img.src="imgs/img_error.png"; //Replacement images
            img.οnerrοr=null; //Control not to keep triggering errors
        }
    </script>
<?php
require 'footer.php';
?>