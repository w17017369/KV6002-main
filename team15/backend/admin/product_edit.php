<?php
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';

$id = intval($_GET['id']);
if (empty($id)) {
    header('location:products.php');
}
$prefix = getDBPregix();
$sql = "SELECT * FROM {$prefix}products WHERE proid = '$id'";
$pro = queryOne($sql);
if (empty($pro)) {
    header('location:products.php');
}

// Search for product type
$prefix = getDBPregix();
$sql = "SELECT * FROM {$prefix}type ORDER BY create_time DESC";
$typeList = query($sql);
function typename($tid)
{
    $prefix = getDBPregix();
    $sqll = "SELECT * FROM {$prefix}type WHERE id = '$tid' ";
    $ress = queryOne($sqll);
    echo $ress['name'];
}

if (!empty($_POST['name'])) {
    $name = htmlentities($_POST['name']);
    $price = htmlentities($_POST['price']);
    $code = htmlentities($_POST['code']);
    $cateid = htmlentities($_POST['cateid']);
    $stock = htmlentities($_POST['stock']);
    $detail = htmlentities($_POST['detail']);
    $image = htmlentities($_POST['image']);
    //modify image upload
    //Image upload
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);     // Get file extensions
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 204800)   // Less than 200 kb
        && in_array($extension, $allowedExts)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Error：: " . $_FILES["file"]["error"] . "<br>";
        } else {
            // Determine if the file exists in the upload directory in the current directory
            // If there is no upload directory, you need to create it, with 777 permissions on the upload directory
            if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " The document already exists. ";
            } else {
                // If the file does not exist in the upload directory, upload the file to the upload directory
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . time() . $_FILES["file"]["name"]);
                $image = "upload/" . time() . $_FILES["file"]["name"];
            }
        }
    } else {
        echo "Illegal file formats";
    }
    $sql = "UPDATE {$prefix}products 
	        SET name = '$name',cateid = '$cateid',stock = '$stock',price = '$price',code='$code',detail='$detail',image='$image' WHERE proid = '$id'";
    if ($err = execute($sql)) {
        $pro = array_merge($pro, $_POST);
        setInfo('Update successful');
    } else {
        setInfo('Update failed');
    }

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
                            <h4 class="card-title">Edit</h4>
                        </div>
                        <div class="card-body">
                            <p style="color: red;"><?php if (hasInfo()) echo getInfo(); ?></p>
                            <form action="product_edit.php?id=<?php echo $id; ?>" method="post"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Name</label>
                                            <input type="text" value="<?php echo $pro['name'] ?>" name="name"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Price</label>
                                            <input type="number" value="<?php echo $pro['price'] ?>" name="price"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">No.</label>
                                            <input type="text" value="<?php echo $pro['code'] ?>" name="code"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Category</label>
                                            <select class="form-control" name="cateid">
                                                <option value="<?php echo $pro['cateid'] ?>"><?php typename($pro['cateid']) ?></option>
                                                <?php foreach ($typeList as $t) { ?>
                                                    <option value="<?php echo $t['id'] ?>"><?php echo $t['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Detail</label>
                                            <div class="form-group bmd-form-group">
                                                <textarea id="description" name="detail" class="form-control"
                                                          rows="5"><?php echo $pro['detail'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Inventory</label>
                                            <div class="form-group bmd-form-group">
                                                <input type="text" value="<?php echo $pro['stock'] ?>" name="stock"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Picture</label>
                                            <div class="form-group bmd-form-group">
                                                <input type="hidden" name="image" value="<?php echo $pro['image']; ?>">
                                                <img onerror="nofind()" style="width: 100px;height: 100px;border-radius: 5px" src="<?php echo '../admin/' . $pro['image'] ?>"/>
                                                <input type="file" name="file"
                                                       style="opacity: 10; position: revert;margin-top: 15px"></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function nofind(){
            var img=event.srcElement;
            img.src="imgs/img_error.png"; //替换的图片
            img.οnerrοr=null; //控制不要一直触发错误
        }
    </script>
<?php
require 'footer.php';
?>