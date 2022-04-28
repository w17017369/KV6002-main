<?php 
require '../db.func.php';
require '../toos.func.php';
require 'auth.php';

// Search for product type
$prefix = getDBPregix();
$sql ="SELECT * FROM {$prefix}type ORDER BY create_time DESC";
$typeList = query($sql);


 if(!empty($_POST['name'])){
	 $name = htmlentities($_POST['name']);
	 $price = htmlentities($_POST['price']);
	 $cateid = htmlentities($_POST['cateid']);
	 $code = htmlentities($cateid.'-'.$_POST['code']);
	 $detail = htmlentities($_POST['detail']);
	 $stock = htmlentities($_POST['stock']);
	 $createtime = date('Y-m-d H:i:s');
     $image = "";
	 // Image upload
	 $allowedExts = array("gif", "jpeg", "jpg", "png");
	 $temp = explode(".", $_FILES["file"]["name"]);
	 $extension = end($temp);     // Get file extensions
	 if ((($_FILES["file"]["type"] == "image/gif")
	 || ($_FILES["file"]["type"] == "image/jpeg")
	 || ($_FILES["file"]["type"] == "image/jpg")
	 || ($_FILES["file"]["type"] == "image/pjpeg")
	 || ($_FILES["file"]["type"] == "image/x-png")
	 || ($_FILES["file"]["type"] == "image/png"))
	 // && ($_FILES["file"]["size"] < 204800)   // Less than 200 kb
	 && in_array($extension, $allowedExts))
	 {
	     if ($_FILES["file"]["error"] > 0)
	     {
	         echo "Error：: " . $_FILES["file"]["error"] . "<br>";
	     }
	     else
	     {
	         // Determine if the file exists in the upload directory in the current directory
	         // If there is no upload directory, you need to create it, with 777 permissions on the upload directory
	         if (file_exists("upload/" . $_FILES["file"]["name"]))
	         {
	             echo $_FILES["file"]["name"] . " The document already exists ";
	         }
	         else
	         {
	             // If the file does not exist in the upload directory, upload the file to the upload directory
	             move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . time().$_FILES["file"]["name"]);
                 $image = "upload/" . time().$_FILES["file"]["name"];
	         }
	     }
	 }
	 else
	 {
	     echo "Illegal file formats"; exit();
	 }
	 $prefix = getDBPregix();
		 $sql = "INSERT INTO {$prefix}products(name,cateid,price,code,detail,stock,createtime,image) 
		         VALUES('$name','$cateid','$price','$code','$detail','$stock','$createtime','$image')";
		 if($err = execute($sql)){
			 setInfo("Added successful");
		 }else{
			 setInfo("Added Failed");
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
								<h4 class="card-title">Add product</h4>
							</div>
							<div class="card-body">
								<p style="color: red;"><?php  if(hasInfo()) echo getInfo();?></p>
								<form action="product_add.php" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="bmd-label-floating">Name</label>
												<input type="text" name="name" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="bmd-label-floating">Price</label>
												<input type="number" name="price" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="bmd-label-floating">No.</label>
												<input type="text" name="code" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="bmd-label-floating">Category</label>
												<!-- <input type="text" name="code" class="form-control"> -->
												<select name="cateid" class="form-control">
													<?php foreach($typeList as $t){ ?>
													<option value="<?php echo $t['id'] ?>"><?php echo $t['name'] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Inventory</label>
												<div class="form-group bmd-form-group">
													<input type="text" class="form-control" name="stock" ></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Description</label>
												<div class="form-group bmd-form-group">
													<textarea class="form-control" name="detail" rows="5"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Picture</label>
												<div class="form-group bmd-form-group">
													<input type="file" class="form-control" name="file" height="50px" style="opacity: 10; position: revert;"></input>
												</div>
											</div>
										</div>
									</div>
                                    <button type="submit" class="btn btn-primary pull-right">Add product</button>
                                </form>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
<?php 
require 'footer.php';
?>	