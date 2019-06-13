<!-- <meta http-equiv='refresh' content='5'> -->
<?php
    $page="Add Exam";
    if (isset($_GET['Key'])) {
        $page=  $_GET['Key'] ;
     }
                        
   require_once('include/header.php');
   require_once('connect.php');
   $exam_key=$_GET['Key'];
   $exam_id=$_GET['id'];
   /*$teacher_id=5;*/
  $query_e = $mysqli->query("select * from exam where exam_id=$exam_id");
	$exam = $query_e->fetch_array();
	$course_id=$exam['course_id'];
	$query_c = $mysqli->query("select * from course where id=$course_id ");
	$course = $query_c->fetch_array();

  $query_join=$mysqli->query("select * from exam_result where exam_key='$exam_key' and student_id=$userStudent ");
  $checkjoin=$query_join->num_rows;

  
  $queryres=$mysqli->query("select * from exam_result where exam_key='$exam_key' and student_id=$userStudent ");  
  $examrslt=$queryres->fetch_array();
	


 ?>

<div class="container-fluid"> 
  <div class="row">
   <?php 
     if ($exam['status']=='Pending') { ?>
       <div class="col-lg-12">
          <div class=" panel-body join-exam-window">
             <input   class="btn join-exam" style="background:#ff0000; border:#ff0000"  value="Exam Not Started Yet!">
          </div>
       </div>
  

  <?php } ?>
  <!-- ///////////////////////////////////////////////////// -->
    <?php 
     if ($exam['status']=='Running' && $checkjoin==0) {
        if(isset($_POST['join_exam'])){
          $limit=$exam['qty_qus'];
          $random=$exam['random'];
          if ($random==1) {
            $query_q = $mysqli->query("select * from question where exam_key='$exam_key' order by rand() limit $limit");
          }
          if($random==0){
            $query_q = $mysqli->query("select * from question where exam_key='$exam_key'");
          }
          
          
          $qbank=array();
          while($qus = $query_q->fetch_array()){
            
            $qusid=$qus['qus_id'];
            array_push($qbank,$qusid);

          }
          $str=implode(",",$qbank);

         $insert = $mysqli->query("insert into exam_result (exam_key,student_id,questions,exam_status) values('$exam_key','$userStudent','$str','Joined')");
         echo "<meta http-equiv='refresh' content='0'>";       
          }

      ?>
      <form action="" class="add-professors" id="settings" method="post">
       <div class="col-lg-12">
          <div class=" panel-body join-exam-window">
             <input name="join_exam" type="submit" class="btn join-exam"  value="Join Exam">
          </div>
       </div>
      </form>
      
    <?php } ?>
    <!-- /////////////////////-//////////////////////////////// -->
    <?php 
    if ($exam['status']=='Running' && $checkjoin==1) { 
      $examqus=$query_join->fetch_array();
      $sl_qus=0;
      if($examqus['questions']!=''){
          $sl_qus=$examqus['questions'];
       }
      $query_q = $mysqli->query("select * from question where qus_id in ($sl_qus)");
       
      ?>
    <div class="col-lg-6">
       <div class="col-lg-12 panel-body">
         <div class="exam-info">
           Course Title: <?php echo $course['course_title'];?> <br>
            <b><?php echo $exam['exam_title'];?>- <?php echo $exam['exam_session'];?> </b><br>
            <?php echo $course['lvl_sem'];?>, <b>Course Code:</b> <?php echo $course['course_code'];?> &nbsp; <b>Credit Hours: </b><?php echo $course['credit'];?> <br>
            
            <b>Time:</b> <?php echo $exam['duration'];?> Hours      <b> Marks: </b> <?php echo $exam['marks'];?> <br><br>
          </div>
         
        <ul class="exam-list">
        <?php 
          while($qus = $query_q->fetch_array()){
            echo '<li>'.$qus['question'].'</li>';
          }
        
          ?>
        </ul>
        
      </div>
      
    </div>
    <div class="col-lg-6">
       <div class="col-lg-12 panel-body">
         <?php 
                 $duration=$exam['duration'];
                 $ex=explode(":", $duration);
                 $hour= $ex[0];
                 $min= $ex[1];
                 $exam_date=$exam['exam_date'];
                 $start_time=$exam['exam_time'];
                 $end_time=date('H:i:s',strtotime('+'.$hour.' hour +'.$min.' minutes +2 seconds',strtotime($start_time)));
                 //echo $end_time;
                 //echo $min; 
                 $showEndtime= date('H:i:s',strtotime($end_time));   //echo $hour;

              ?>
        <div class="time-left"></div>
        <time><?php echo $exam_date.'T'.$showEndtime.'+0600'; ?></time>

       </div>
    </div>
    <?php } ?>



    <!-- ///////////////////////-if complete-////////////////////////////// -->
<?php  if ($exam['status']=='Completed' && $checkjoin==1) { 
    $examqus=$query_join->fetch_array();
    $sl_qus=0;
    if($examqus['questions']!=''){
        $sl_qus=$examqus['questions'];
     }
    $query_q = $mysqli->query("select * from question where qus_id in ($sl_qus)");
       
?>
    <div class="col-lg-6 ">
       <div class="col-lg-12 panel-body five-houndred">
         <div class="exam-info">
       Course Title: <?php echo $course['course_title'];?> <br>
        <b><?php echo $exam['exam_title'];?>- <?php echo $exam['exam_session'];?> </b><br>
        <?php echo $course['lvl_sem'];?>, <b>Course Code:</b> <?php echo $course['course_code'];?> &nbsp; <b>Credit Hours: </b><?php echo $course['credit'];?> <br>
        
        <b>Time:</b> <?php echo $exam['duration'];?> Hours      <b> Marks: </b> <?php echo $exam['marks'];?> <br><br>
       </div>
         
        <ul class="exam-list">
        <?php 
          while($qus= $query_q->fetch_array()){
            echo '<li>'.$qus['question'].'</li>';
          }
        
          ?>
        </ul>
        
      </div>
      
    </div>

    <div class="col-lg-6 ">
       <div class="col-lg-12 panel-body five-houndred" style="text-align:center;">
       <h4>Marks</h4>
      <?php
        
        if ($examrslt['marks']!='') {
          echo $examrslt['marks']."/".$exam['marks']."<br>";
          if ($examrslt['marks']>=$exam['marks']*0.4) {
              echo "<b style='color:#006400;'>Passed</b>";
          }
          else echo "<b style='color:#ff0000;'>Failed</b>";
        }
        else
          echo "<b style='color:#ff0000;'>Pending!</b>";
        
        
        
        
        
      ?>
      <div class="sparkline10-list">
          <div class="sparkline10-graph" style="padding:0 100px;">
              <canvas id="pp"></canvas>
          </div>
          </div>
      </div>


       </div>
    </div>
  
<?php } ?>
<!--    -============  end complete =======    -->



  </div>
</div>

<?php require_once('include/footer.php'); ?>
<script type="text/javascript">
(function ($) {
 "use strict";
  /*c3.generate({
      bindto: '#pie_res',
      data:{
          columns: [
              ['Marks', <?php echo $examrslt['marks'];?>],
              ['', <?php echo $exam['marks']-$examrslt['marks']; ?>]
          ],
          colors:{
              data1: '#006400',
              data2: '#FF0000'
          },
          type : 'pie'
      }
  });*/
  var ctx = document.getElementById("pp");
  var piechart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["Marks", "Untouched" ],
      datasets: [{
        label: 'pie Chart',
                backgroundColor: [
          '#006400',
          '#FF0000'
        ],
        data: [ <?php echo $examrslt['marks'];?>,<?php echo $exam['marks']-$examrslt['marks']; ?>]
            }]
    },
    options: {
      responsive: true
    }
  });


})(jQuery); 
</script>


