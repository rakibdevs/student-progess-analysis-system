<?php
if (isset($_GET['title'])) {
	$page=$_GET['title'];
}else
$page='Course Content';
    
   require_once('include/header.php');
   require_once('connect.php');
   $content_id=$_GET['content_id']; 
   $query = $mysqli->query("select * from course_content where content_id=$content_id");
   $rows = $query->fetch_array();
   $course_id=$rows['pffd_course'];
   $post_time=date('h:i A', strtotime($rows['date_time']));
   $post_date=date('M d, Y', strtotime($rows['date_time']));
   $teacher_id=$rows['up_by']; 
   $queryt = $mysqli->query("select * from teacher where id=$teacher_id");
   $teacher = $queryt->fetch_array();

 ?>
 <div class="container-fluid">
   <div class="col-lg-8" style="padding:0;">
    <div class="panel-body">
        <h3><?php echo $rows['topic_name']; ?></h3>
        <p style="color: #6f6c6c;">
          <i class="fa fa-calendar"> </i> <?php echo $post_date; ?>&nbsp;&nbsp; 
          <i class="fa fa-clock-o" aria-hidden="true"> </i> <?php echo $post_time; ?>&nbsp;&nbsp;
          <i class="fa fa-pencil" aria-hidden="true"> </i> <a href="teacher.php?id=<?php echo $teacher['id']; ?>&&name=<?php echo $teacher['full_name']; ?>"> <?php echo $teacher['full_name']; ?></a> 
          <?php if($teacher['id']==$teacher_id){ ?> <a href="content_delete.php?id=<?php echo $rows['content_id']; ?>"> <i class="fa fa-trash-o" aria-hidden="true" titel="Delete content"> </i></a> <?php } ?>
        </p> 

        <ul class="keyword-list">
          <?php 
          $keyword= explode(',', $rows['keyword']);
          foreach ($keyword as $k) {
             echo '<li>'.$k.'</li>';
           } 
          ?>
        </ul>
    	<?php echo $rows['content']; ?>
    </div>
   	  
   </div> 
   <div class="col-lg-4 ">
   <?php
      if($rows['keyword']!=''){
       $sql = array('0'); // Stop errors when $words is empty

       foreach($keyword as $word){
          $sql[] = 'content LIKE "%'.$word.'%"';
         }

      $query_rx =$mysqli->query( "SELECT * FROM course_content WHERE ".implode(" OR ", $sql)." order by content_id desc limit 10");
      echo $mysqli->error;
       if ($query_rx->num_rows>0 ){ 
    ?>
     <div class="panel-body">
     <h4>Related Topic </h4>
     <ul>
       <?php 
       while($row_rx = $query_rx->fetch_array()){
        echo '<li> <i class="fa fa-angle-right"></i> <a href="course_content.php?content_id='.$row_rx['content_id'].'&&title='.$row_rx['topic_name'].'"> '.$row_rx['topic_name'].'</a></li>';
       }
       ?>
     </ul>
     </div>
     <hr>
     <?php }} ?>
     <div class="panel-body">
     <h4>Recent Materials</h4>
     <ul>
	     <?php
	     $query_r = $mysqli->query("select * from course_content where content_id!=$content_id order by content_id desc limit 5");
	     while($row_r = $query_r->fetch_array()){
	     	echo '<li> <i class="fa fa-angle-right"></i> <a href="course_content.php?content_id='.$row_r['content_id'].'&&title='.$row_r['topic_name'].'"> '.$row_r['topic_name'].'</a></li>';
	     }
	     ?>
	   </ul>
     </div>
   </div>
    
 </div>



<?php require_once('include/footer.php'); ?>
