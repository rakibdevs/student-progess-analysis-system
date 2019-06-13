<div class="row panel-body">
<center><b>Courses</b></center>

<ul class="exam-list">
  <?php 
    $query = $mysqli->query("select * from course where lvl_sem='L-4 S-II'");
    while($rows = $query->fetch_array()){
      $cid=$rows['id'];
      $qt= $mysqli->query("select * from course_teacher inner join teacher on course_teacher.teacher_id = teacher.id  where course_teacher.course_id=$cid  and course_teacher.active=1");
      echo $mysqli->error;
      $rowt = $qt->fetch_array();


  ?>
     <li>
        <a style="color:#d4782c;" href="course_details.php?id=<?php echo $rows['id']; ?>&&title=<?php echo $rows['course_title']; ?>"><?php echo $rows['course_title']; ?></a><br>
       <span style="font-size:11px;"> Course Teacher:  <a style="font-size: 13px;" href="teacher.php?id=<?php echo $rowt['id']; ?>&&name=<?php echo $rowt['full_name']; ?>"> <?php echo $rowt['full_name'];  ?> </a> <br>                     
         Course Code:  <?php echo $rows['course_code']; ?> ; 
         Credit:  <?php echo $rows['credit'];  ?>  </span>    </li>

  <?php } ?>
  </ul>
</div>
<div><br></div>
