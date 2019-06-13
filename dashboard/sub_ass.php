<div class="row panel-body"> 
<center><b>New Assignment</b></center>

<ul class="exam-list">
<?php
$query1 = $mysqli->query("select * from assignment inner join course on assignment.course_id=course.id where assignment.ass_session='$sExam_session' and course.lvl_sem='$sLvl_sem' order by assignment.ass_id desc");
$cnt=0;                        
while($assignment = $query1->fetch_array()){
	$deadline=date('M d, Y', strtotime($assignment['deadline']));

	$course_id=$assignment['course_id'];
	$session_id=$assignment['teacher_id'];
	$ass_key=$assignment['ass_key'];
	$query_c = $mysqli->query("select * from course where id=$course_id ");
	$e_course = $query_c->fetch_array(); ?>
	<?php 
	     $query_p = $mysqli->query("select * from ass_submission where ass_key='$ass_key' and submitted_by=$userStudent");
	     $asssub = $query_p->num_rows; 

	  ?>
    <?php if($asssub==0){ ?>
    <li>
    <div class="col-lg-9" style="padding:0;">
		 
		<a style="color:#006DF0;" href="assignment.php?id=<?php echo $assignment['ass_id']; ?>&&Key=<?php echo $assignment['ass_key']; ?>"><?php echo $assignment['ass_key'].': '.$assignment['ass_title'].'- '.$assignment['ass_session'];?></a> <br>
		<span style="font-size:12px;">Course: <i><a style="color:#d19354;font-size:12px;" href="course_details.php?id=<?php echo $e_course['id']; ?>&&title=<?php echo $e_course['course_title']; ?>"><?php echo $e_course['course_title']; ?></a> </i>
	     </span> <br>

	     <i class="fa fa-calendar"> </i> <?php echo $deadline; ?>
	</div>

    <div class="col-lg-3" style="padding:0;text-align:right;">                              
      <button data-toggle="tooltip" title="Submit Assignment" class="pd-setting-ed" type="button"  ><a style="color:green;" href="assignment.php?id=<?php echo $assignment['ass_id']; ?>&&Key=<?php echo $assignment['ass_key']; ?>">Submit</a> </button>
    </div>
   </li>
<?php  
  $cnt++;
  }
  
} 
if ($cnt==0) {
  	echo "<span style='color:#ff0000;'>No assignments!</span>";
  }
?>
</ul>
</div>
<div><br></div>