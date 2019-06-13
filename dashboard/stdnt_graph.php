
<?php 
$gained=array();
$exams=array();

$qr=$mysqli->query("select * from exam_result where student_id=$userStudent and (exam_status='Passed' or exam_status='Failed') order by id desc limit 5");
echo $mysqli->error;
while($com_exam = $qr->fetch_array()){
  $exammarks=$com_exam['marks'];
  $k=$com_exam['exam_key'];
  $qe=$mysqli->query("select * from exam where exam_key='$k'");
  $qed = $qe->fetch_array();
  $total=$qed['marks'];
  $percent=($exammarks/$total)*100;
  array_push($gained, $percent);
  array_push($exams, $k);
 
 

}

$label=array();
$marks=array();

$qresult=$mysqli->query("select exam.course_id as cid, sum(exam.marks) as total, sum(exam_result.marks) as marks from exam inner join exam_result on exam.exam_key=exam_result.exam_key where exam_result.student_id=$userStudent group by exam.course_id");
echo $mysqli->error;
while($r_exam = $qresult->fetch_array()){
  if($r_exam['total']==0){
    $r_exam['total']=1;
  }
  $percentmarks=round(($r_exam['marks']/$r_exam['total'])*100);
  $course= $r_exam['cid'];
  $qep=$mysqli->query("select * from course where id=$course");
  $r_course = $qep->fetch_array();
  $coursecode=$r_course['course_code'];

  //echo $coursecode;

 
  array_push($label, $coursecode);
  array_push($marks, $percentmarks);
}
 //$qep=$mysqli->query("select * from exam where exam_key='$k' group by course_id");




?>

<div class="row panel-body">
<center><b>Result Graph</b></center>

  <div id="stepped-chart">
      <canvas id="linechartstepped"></canvas>
  </div>
</div>
<div><br></div>
<div class="row panel-body">
    <div class="sparkline9-list responsive-mg-b-30">
        <div class="sparkline9-hd">
            <div class="main-sparkline9-hd">
                <center><b> Efficiency Per Course  </b></center>
            </div>
        </div>
       <div id="bar4-chart">
            <canvas id="studentpass"></canvas>
        </div>
       
    </div>
</div>

<script src="js/charts/Chart.js"></script>
<script>
(function ($) {
 "use strict";

  var ctx = document.getElementById("linechartstepped");
  var linechartstepped = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($exams); ?>,
      datasets: [{
        label: "Marks(%)",
        fill: true,
        backgroundColor: '#008000',
        borderColor: '#008000',
        data: <?php echo json_encode($gained); ?>
            }]
    },
    options: {
      responsive: true
    }
  });

  var ctx = document.getElementById("studentpass");
  var barchart4 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($label), ENT_NOQUOTES)); ?>],
      datasets: [{
                label: 'Efficiency(%)',
        data: [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($marks), ENT_NOQUOTES)); ?>],
        borderWidth: 1,
        yAxisID: "y-axis-1",
                backgroundColor: [
          'rgba(255, 159, 64)',
          'rgba(54, 162, 235)',
          'rgba(255, 206, 86)',
          'rgba(255, 99, 132)',
          'rgba(153, 102, 255)',
          'rgba(75, 192, 192)'
        ],
            }]
    },
    options: {
      responsive: true,
      title:{
        display:true
      },
      tooltips: {
        mode: 'index',
        intersect: true
      },
      scales: {
        yAxes: [{
          type: "linear",
          display: true,
          position: "left",
          id: "y-axis-1",
        }],
      }
    }
  });


  })(jQuery);
  </script>