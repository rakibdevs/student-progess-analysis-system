


<?php 
$total=array();
$passed=array();
$tick=array();
$passrate=array();

$qr=$mysqli->query("select * from exam where teacher_id=$teacher_id and status='Completed' order by exam_id desc limit 5");
echo $mysqli->error;
while($com_exam = $qr->fetch_array()){

	$k=$com_exam['exam_key'];
	$total_s=$mysqli->query("select * from exam_result where exam_key='$k'");
	$total_s=$total_s->num_rows;
	$total_p=$mysqli->query("select * from exam_result where exam_key='$k' and exam_status='Passed'");
    if($total_p->num_rows>0){
       $total_p=$total_p->num_rows; 
   }else
   $total_p=1;
	
	$passratet=round(($total_p/$total_s)*100);
    array_push($tick, $k);
	array_push($total, $total_s);
    array_push($passed, $total_p);
    array_push($passrate, $passratet);
}



?>
<?php //echo json_encode($tick); ?>

<div class="row panel-body">
    <div class="sparkline9-list responsive-mg-b-30">
        <div class="sparkline9-hd">
            <div class="main-sparkline9-hd">
                <center><b>Student's Performance </b></center>
            </div>
        </div>
  
        <div id="axis-chart">
            <canvas id="linechartmultiaxis"></canvas>
        </div>
    </div>
</div>
<div><br></div>
<div class="row panel-body">
    <div class="sparkline9-list responsive-mg-b-30">
        <div class="sparkline9-hd">
            <div class="main-sparkline9-hd">
                <center><b> Pass Rate(%)  </b></center>
            </div>
        </div>
       <div class="sparkline9-graph">
           <!--  <div id="passratio"></div> -->
           <canvas id="barresult"></canvas>
        </div>
       
    </div>
</div>
<div><br></div>
<script src="js/charts/Chart.js"></script>
<script>
(function ($) {
 "use strict";
  
  	
   var ctx = document.getElementById("barresult");
    var barchart4 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($tick), ENT_NOQUOTES)); ?>],
            datasets: [{
                label: 'Pass (%)',
                data: [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($passrate), ENT_NOQUOTES)); ?>],
                borderWidth: 1,
                yAxisID: "y-axis-1",
                backgroundColor: [
                    'rgba(75, 192, 192)',
                    'rgba(153, 102, 255)',
                    'rgba(255, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(255, 206, 86',
                    'rgba(255, 159, 64)'
                ],
            }]
        },
        options: {
            responsive: true,
            title:{
                display:true,
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




    var ctx = document.getElementById("linechartmultiaxis");
	var linechartmultiaxis = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($tick), ENT_NOQUOTES)); ?>],
			datasets: [{
				label: "Passed",
				fill: false,
                backgroundColor: '#008000',
				borderColor: '#008000',
				data: [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($passed), ENT_NOQUOTES)); ?>],
				yAxisID: "y-axis-1"
				
            }, {
            	label: "Total Examinee",
				fill: false,
                backgroundColor: '#006DF0',
				borderColor: '#006DF0',
				data: [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($total), ENT_NOQUOTES)); ?>],
				yAxisID: "y-axis-1"
                
				
		}]
		},
		options: {
			responsive: true,
			hoverMode: 'index',
			stacked: false,
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