<?php
$query1 = $mysqli->query("select * from student where lvl_sem='L-1 S-I' and status='Running'");
$oneone= $query1->num_rows;
$query2 = $mysqli->query("select * from student where lvl_sem='L-1 S-II' and status='Running'");
$onetwo= $query2->num_rows;
$query3 = $mysqli->query("select * from student where lvl_sem='L-2 S-I' and status='Running'");
$twoone= $query3->num_rows;
$query4 = $mysqli->query("select * from student where lvl_sem='L-2 S-II' and status='Running'");
$twotwo= $query4->num_rows;
$query5 = $mysqli->query("select * from student where lvl_sem='L-3 S-I' and status='Running'");
$threeone= $query5->num_rows;
$query6 = $mysqli->query("select * from student where lvl_sem='L-3 S-II' and status='Running'");
$threetwo= $query6->num_rows;
$query7 = $mysqli->query("select * from student where lvl_sem='L-4 S-I' and status='Running'");
$fourone= $query7->num_rows;
$query8 = $mysqli->query("select * from student where lvl_sem='L-4 S-II' and status='Running'");
$fourtwo= $query8->num_rows;

?>

<div class="panel-body">
  <center><b>Stucent Count</b></center>
  <div id="bar1-chart">
	    <canvas id="stdntcnt"></canvas>
	</div>
</div>

<script src="js/charts/Chart.js"></script>
<script>
(function ($) {
 "use strict";
	 /*----------------------------------------*/
	/*  1.  Bar Chart
	/*----------------------------------------*/

	


  var ctx = document.getElementById("stdntcnt");
  var barchart4 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["L-1 S-I", "L-1 S-II", "L-2 S-I", "L-2 S-II", "L-3 S-I", "L-3 S-II", "L-4 S-I","L-4 S-II"],
      datasets: [{
                label: 'Student',
        data: [<?php echo $oneone.','.$onetwo.','.$twoone.','.$twotwo.','.$threeone.','.$threetwo.','.$fourone.','.$fourtwo; ?>],
        borderWidth: 1,
        yAxisID: "y-axis-1",
                backgroundColor: [
                    'rgba(153, 102, 255)',
				    'rgb(0,0,0)',
					'rgba(255, 99, 132)',
					'rgba(54, 162, 235)',
					'rgba(255, 206, 86)',
					'rgba(75, 192, 192)',			
					'rgba(255, 159, 64)',
					'rgb(128,0,0)',
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