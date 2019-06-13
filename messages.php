 <?php
   $page="Messages"; 
   require_once('include/header.php');
   require_once('connect.php');
 ?>

 <?php if($_SESSION['category']=='Student'){?>
<style type="text/css">
    
</style>
<div class="col-lg-9">
<ul class="message-view">


 

 
<?php
if (isset($_GET['id'])) {
    $get_id=$_GET['id'];
    $query = $mysqli->query("select * from message inner join course on message.course_id=course.id where course.lvl_sem='$sLvl_sem' and message.teacher_id=$get_id order by message.id desc");
}
else
$query = $mysqli->query("select * from message inner join course on message.course_id=course.id where course.lvl_sem='$sLvl_sem'  order by message.id desc");
 while($message = $query->fetch_array()){
    $time_date=date('M d, Y h:i A', strtotime($message['time_date']));
    //$exam_date=date('', strtotime($exam['exam_date']));
    //$status=$exam['status'];
    $course_id=$message['course_id'];
    $session_id=$message['teacher_id'];
    $query_c = $mysqli->query("select * from course where id=$course_id ");
    $e_course = $query_c->fetch_array();
?>
    <li>
            <div class="col-lg-1 message-img" >
                <img src="upload/professor/<?php echo $session_id; ?>.jpg" alt="">
            </div>
            <div class="col-lg-10 message" > 
                <span class="message-inner"><?php echo "<b>".$message['msg'].": </b><br>".$message['msg_body']; ?></span><br>
                
               <span style="font-size:10px;color: #cbc9c9;"><?php echo $time_date; ?> &nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $e_course['course_title']; ?> </span> 
            </div>
            <div class="col-lg-1"></div>
    </li>
<?php  } ?>
</ul>
<?php  } ?>

</div>
<div class="col-lg-3" style="border-left:1px solid #d1d1d1">
   <!--  <center><b>Message</b></center>
 -->    <ul class="message-menu" >
    <?php
    $queryd = $mysqli->query("select distinct message.teacher_id from message inner join course on message.course_id=course.id where course.lvl_sem='$sLvl_sem' order by message.id   desc");
    while($message = $queryd->fetch_array()){
        $this_id=$message['teacher_id'];
        $query_t = $mysqli->query("select * from teacher where id=$this_id ");
        $tt = $query_t->fetch_array();
    ?>
       <li <?php if (isset($_GET['id'])) {if ($_GET['id']==$this_id) {echo 'style="background:#d1d1d1;"';}} ?>>
        <a href="messages.php?id=<?php echo $this_id; ?>" style="color:#000;">
              <div class="message-img" style="float:right;">
                <img src="upload/professor/<?php echo $tt['image']; ?>" alt="">
              </div>
                <b><?php echo  $tt['full_name'];?> </b><br>
                <span style="font-size:11px;"><?php echo  $tt['designation'];?></span>
        </a> 
       </li>
    <?php  } ?>           
    </ul>
</div>
<?php require_once('include/footer.php'); ?>