<?php 
require 'db.func.php';
require 'toos.func.php';
session_start();
$uid = $_SESSION['user']['id'];
 if(!empty($_POST['title'])){
	 $title = htmlentities($_POST['title']);
	 $content = htmlentities($_POST['content']);
	 $create_time = time();
	 
		 $sql = "INSERT INTO topic(title,content,create_time,uid) 
		         VALUES('$title','$content','$create_time','$uid')";
		 if(execute($sql)){
			 setInfo("Create New Topic Success");
		 }else{
			 setInfo("Create New Topic Failure");
		 }
 }

 // require 'auth.php';
	$sql = "SELECT * FROM topic ";
	$topic = query($sql);
// require 'header.php';
 @$pageSize = 10; //Number of contents displayed on a page
 @$pageNum = empty($_GET["pageNum"])?1:$_GET["pageNum"];
 $sql = "select count(*) num from topic ";
 $count = queryOne($sql);
 @$allNum =$count['num'];
 @$endPage = ceil($allNum/$pageSize); //Total pages
 
 
 $sql = "SELECT id,title,content,uid,create_time FROM topic ORDER BY create_time DESC LIMIT "  .  (($pageNum - 1) * $pageSize) . "," . $pageSize;
 $topic = query($sql);
 
 function findname($id){
 	$sql = "select * from cc_user where id = {$id} ";
 	$res = queryOne($sql);
 	return $res['username'];
 }
 
 //Add message
 if(!empty($_POST['content']))
 {

    $file = $_FILES['tupian'];
    if($file['tmp_name'] != "") {
        $suffix = substr($file['name'],strrpos($file['name'],"."));
        $fileName = time() . $suffix;
        $pathName = "images/" . $fileName;
        move_uploaded_file($file['tmp_name'], $pathName); 
    } else {
        $pathName = "";
    }

     $title = $_POST['title'];
	 $content = $_POST['content'];

	 $create_time = time();
	 $sql = "INSERT INTO topic(title,content,uid,create_time,img)
	         VALUES('$title','$content',7,'$create_time','$pathName')";
	 if(execute($sql)){
	 		echo "<script language='javascript'>";
	 		echo "alert('Post Successful');";
	 		echo "location.href='forum.php'";
	 		echo "</script>";
	 }else{
	 		echo "<script language='javascript'>";
	 		echo "alert('Post Failed');";
	 		echo "location.href='forum.php'";
	 		echo "</script>";
	 }
 }
require 'header.php';
?>


	
	<div class="row">
      <h2 class="col-md-12 pageTitle">Create New Topic</h2>
      <div align="center" class="col-md-12"><p style="color :red"><?php  if(hasInfo()) echo  getInfo();?></p></div>
    </div>


    <div class="ContentContainer container">

    	<div class="row">
        	<div class="col-md-12">
            	<form action="" method="post" enctype="multipart/form-data">
            		<div class="postedTime"><h3>Title</h3></div>
            	    <input type="text" name="title" class="form-control"><br/>
            	    <div class="postedTime"><h3>Content</h3></div>
            	    <input type="file" name="tupian"  /><br/>
            	    <textarea name="content" class="form-control" rows="5" placeholder="" required=""></textarea><br	/>
            	    <input type="submit" class="btn-submit" value="Submit Topic" />
            	</form>
        	</div>
        </div>

    </div>




<?php 
require 'footer.php';
?>