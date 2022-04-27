<?php 
error_reporting(0);
require 'toos.func.php';
require 'db.func.php';
require 'header.php';
// require 'auth.php';
session_start();
$id = $_GET['id'];
if(empty($id)){
  echo "<script language='javascript'>";
  echo "alert('Wrong Operation');";
  echo "location.href='forum.php'";
  echo "</script>";
}
$sql = "SELECT * FROM topic WHERE id={$id} ";
  

 $topic = queryOne($sql);
 function findname($id){
  $sql = "select * from dsf_users where userid = {$id} ";
  $res = queryOne($sql);
  return $res['username'];
 }
 
 $lysql = "select * from message where tid = {$id}  ";
 $lylist = query($lysql);
 //添加评论留言
 if(!empty($_POST['message']))
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

   $content = $_POST['message'];
   $tid = $_POST['t_id'];

   $create_time = time();
   $sql = "INSERT INTO message(content,tid,create_time,img)
           VALUES('$content','$tid','$create_time','$pathName')";
   if(execute($sql)){
      echo "<script language='javascript'>";
      echo "alert('Comment Success');";
      echo "location.href='forum.php'";
      echo "</script>";
   }else{
      echo "<script language='javascript'>";
      echo "alert('Comment Failed');";
      echo "location.href='forum.php'";
      echo "</script>";
   }
 }
 
?>






    
    <div class="ContentContainer container">
      <div class="row">
        <h2 class="col-md-12 pageTitle"><?php echo $topic['title'] ?></h2>
      </div>  
      <div class="row">
        <div class="col-md-2 nameAndPic">
          <h3><?php echo findname($topic['uid']) ?></h3>
          <img class="forumAvatar" src="images/default-avatar.jpg">
        </div>
        <div class="col-md-10">
          <div class="postedTime"><h5><?php echo date('d-m-Y',$topic['create_time']) ?></h5></div>
          <div><p><?php echo $topic['content'] ?></p></div>
        </div>
        <hr width="100%">        
      </div>
      
      <?php  foreach($lylist as $ly): ?>
      <div class="row">
        <div class="col-md-2 nameAndPic">
          <h3><?php echo findname($ly['uid']) ?></h3>
          <img class="forumAvatar" src="images/default-avatar.jpg">
        </div>
        <div class="col-md-6">
          <div class="postedTime"><h5><?php echo date('d-m-Y',$ly['create_time']) ?></h5></div>
            <?php if($ly['img'] != "") : ?>
              <img src="<?php echo $ly['img']; ?>" alt="" style="width:60%;height:60%;" />
              <br/><br/>
            <?php endif; ?>
          <div><p><?php echo $ly['content'] ?></p></div>
        </div>
        <hr width="100%">        
      </div>
      <?php endforeach; ?>

      <div class="row col-lg-12 col-md-12 col-sm-12">
        
          <div class="form-group col-lg-12 col-md-12 col-sm-12">
            <h4>Leave a message</h4>


          <div class="form-group">
              <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="tupian" style="margin-bottom:20px;" />
                      <textarea name="message" class="form-control" rows="5" placeholder="Content" required=""></textarea>
                <input name="t_id" type="number" value="<?php echo $_GET['id'] ?>" style="display: none;" />
              </div>
              <div class="pt-row form-group col-lg-12 col-md-12 col-sm-12">
                  <div class="col-auto">
                    <a href="#"><input type="submit" class="btn-submit" value="submit" /></a>
                  </div>
              </div>
          </form>



      </div>

    </div>
</div>







<script src="bbs/js/bundle.js"></script>

<?php 
 require 'footer.php';
?>
