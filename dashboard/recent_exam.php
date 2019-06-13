
   <?php 
   if($_SESSION['category']=='Teacher'){
      $query_e = $mysqli->query("select * from exam where teacher_id=$teacher_id and status='Pending' order by exam_date asc limit 3 ");
  }
      if($_SESSION['category']=='Student'){
        $query_e = $mysqli->query("select * from exam inner join course on exam.course_id=course.id where  exam.status='Pending' and exam.exam_session='$sExam_session' and course.lvl_sem='$sLvl_sem' order by exam.exam_date asc limit 3");
      }
      $numrow=$query_e->num_rows;

    if ($numrow>0) { ?>
    <div class="panel-body row">
          <center><b>Next Exam</b></center>
         
          <ul class="exam-list">
    <?php
      while($exam = $query_e->fetch_array()){
        $exam_time=date('h:i A', strtotime($exam['exam_time']));
        $exam_date=date('M d, Y', strtotime($exam['exam_date']));
    ?>
    <li>
      <div class="<?php if (($userCat=='Teacher')||$userCat=='Student') { echo 'col-lg-9';}else { echo'col-lg-12';}?>" style="padding: 0;">

        <a  href="take_exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>"> <span style="color:#d4782c;"><?php echo $exam['exam_key']; ?> : </span>  <?php echo $exam['exam_title']; ?>- <?php echo $exam['exam_session'];?></a>
        
        <?php 
        $course_id=$exam['course_id'];
        $query_c = $mysqli->query("select * from course where id=$course_id ");
        $e_course = $query_c->fetch_array();
         ?>
         <br>
          <span style="font-size:12px;">Course: <a style="color:#006DF0;font-size:12px;" href="course_details.php?id=<?php echo $e_course['id']; ?>&&title=<?php echo $e_course['course_title']; ?>"><i><?php echo $e_course['course_title']; ?></i></a></span>
        <br>
        <span style="font-size:12px;color:#1a1a1a;"> 
        <i class="fa fa-calendar"> </i> <?php echo $exam_date; ?>&nbsp;&nbsp; 
        <i class="fa fa-clock-o" aria-hidden="true"> </i> <?php echo $exam_time; ?>&nbsp;&nbsp; </span>
      </div>
       <div class="col-lg-3" style="text-align:right;padding: 0;">
        <?php 
        if ($userCat=='Teacher') {
        ?>
        
        <button data-toggle="tooltip" title="Start Exam" class="pd-setting-ed" type="button" style="color:green;" ><a style="color:green;" href="take_exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>">Start</a> </button>
        <?php } ?>
        <?php if($_SESSION['category']=='Student'){ ?>
        <button data-toggle="tooltip" title="Participate in Exam" class="pd-setting-ed" type="button" style="color:green;" ><a style="color:green;" href="exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>">Participate</a> </button>
        <?php } ?>
        </div>

        
        
      

           <!--  <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button> -->
        
    </li>
   <?php  } ?>
</ul>
  </ul>
  </div>
      <div><br></div>
  <?php  } ?>
