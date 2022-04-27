<?php 
require 'toos.func.php';
require 'db.func.php';
include 'header.php';
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
 	$sql = "select * from dsf_users where userid = {$id} ";
 	$res = queryOne($sql);
 	return $res['username'];
 }
 
?>










<div class="row">
      <h2 class="col-md-12 pageTitle">Customer Forum</h2>
      <h4 class="col-md-12" style="text-align: center;">Share your ideas about products here!</h4>
      <div class="btn-post col-md-2"><a style="color: white" href="topic_create.php">Start new topic</a></div>
</div>

<div class="ContentContainer container">
    <?php  foreach($topic as $tz): ?>
      <div class="row">
        <div class="col-md-12">
          <div class="postedTime"><a href="topic_detail.php?id=<?php echo $tz['id'] ?>"><h3><?php echo $tz['title'] ?></h3></a></div>
          <div class=""><h4>by <?php echo findname($tz['uid']) ?> | <?php echo date('d-m-Y',$tz['create_time']) ?></h4></div>
          <!-- <div><p>Just a friendly nony have made one-off donations in the past, while a few have set up direct debts; thank you very much indeed to those for that generosity! </p></div> -->
        </div>
        <hr width="90%">        
      </div>
    <?php endforeach; ?>
    <div class="forumlistpagination">
        <!-- <a href="?pageNum=1">1</a> -->
        <a style="color: #6c757d" href="?pageNum=<?php echo $pageNum==1?1:($pageNum-1)?>">Prev</a>&nbsp&nbsp
        <a style="color: #6c757d" href="?pageNum=<?php echo $pageNum==$endPage?$endPage:($pageNum+1)?>">Next</a>&nbsp&nbsp
        <!-- <a href="?pageNum=<?php echo $endPage?>">End</a> -->
        <span style="color: #0f8773">Page <?php echo $pageNum ;?> of <?php echo $endPage ;?></span>
    </div>
</div>







<script src="bbs/js/bundle.js"></script>


<?php 
 require 'footer.php';
?>

