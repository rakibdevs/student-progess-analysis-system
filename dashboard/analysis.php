<style type="text/css">
    .ggg{
        width: 245px;
margin: 0 auto;
height: 35px;
    }
</style>
<div class="row panel-body">
<center><b>Compare Student Performance</b></center>
<form action="" class="add-professors" id="msg" method="post" style="text-align:center;">
        <div class="col-lg-12">
            <div class="form-group">
                <select name="pffd_course" type="text" class="form-control ggg" required>
                    <option value="0" selected="" >---Select Course---</option>
                    <?php
                    $query1 = $mysqli->query("select distinct course_teacher.course_id, course_code, course_title from course join course_teacher on course.id = course_teacher.course_id where course_teacher.teacher_id=$teacher_id and course_teacher.active=1");
                    while($course = $query1->fetch_array()){ 
                        ?>
                    <option value="<?php echo $course['course_id']; ?>|<?php echo $course['course_title']; ?>"><?php echo $course['course_title']; ?></option>
                    <?php } ?> 
                </select>
            </div>
            <div class="form-inline">
                <input id="student_id" name="student_id1" type="text" class="form-control" size="7" maxlength="7" placeholder="Student ID" style="height:35px;" required>
            
            
                <input id="student_id" name="student_id2" type="text" class="form-control" size="7" maxlength="7" style="height:35px;"  placeholder="Student ID" required>
          
                <input type="submit" name="compare" class="btn btn-primary waves-effect waves-light"  value="View">
            </div>
          </div>
</form>


<?php 
if(isset($_POST['compare'])){
    $id1=$_POST['student_id1'];
    $id2=$_POST['student_id2'];
    $course_info=$_POST['pffd_course'];
    $result_explode = explode('|', $course_info);
    $course_id=$result_explode[0];
    $cttt=$result_explode[1];
    $total=array();
    $passed=array();
    $tick=array();

    $qpp=$mysqli->query("select * from exam where teacher_id=$teacher_id and status='Completed' and course_id=$course_id order by exam_id desc limit 5");
    echo $mysqli->error;
    while($com_examw = $qpp->fetch_array()){

        $k=$com_examw['exam_key'];
        //echo $k;
        $total_s=$mysqli->query("select * from exam_result where exam_key='$k' and student_id=$id1");
        if($total_s->num_rows==1){
        $total_s=$total_s->fetch_array();
        $total_s=$total_s['marks'];
        }else
        $total_s=0;

        //echo $total_s;
        $total_p=$mysqli->query("select * from exam_result where exam_key='$k' and student_id=$id2");
        if($total_p->num_rows==1){
        $total_p=$total_p->fetch_array();
        $total_p=$total_p['marks'];
        }else
        $total_p=0;
        
        
        array_push($tick, $k);
        array_push($total, $total_s);
        array_push($passed, $total_p);
    }

    ?>


        <div class="sparkline9-list responsive-mg-b-30">
            <div class="sparkline9-hd">
                <div class="main-sparkline9-hd">
                    <br>
       <br>
                    <center><b> <?php echo $cttt; ?>   </b></center>
                    <center><b>Comparision between <i><?php echo $id1; ?> </i>  and <i><?php echo $id2; ?> </i>  </b></center>
                </div>
            </div>
      
            <div id="axis-chart">
                <canvas id="compare"></canvas>
            </div>
        </div>
 
    <script src="js/charts/Chart.js"></script>
    <script>
    (function ($) {
     "use strict";
      
        


        var ctx = document.getElementById("compare");
        var linechartmultiaxis = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($tick), ENT_NOQUOTES)); ?>],
                datasets: [{
                    label: "<?php echo $id1; ?>",
                    fill: false,
                    backgroundColor: '#008000',
                    borderColor: '#008000',
                    data: [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($total), ENT_NOQUOTES)); ?>],
                    yAxisID: "y-axis-1"
                    
                }, {
                    label: "<?php echo $id2; ?>",
                    fill: false,
                    backgroundColor: '#006DF0',
                    borderColor: '#006DF0',
                    data: [<?php echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($passed), ENT_NOQUOTES)); ?>],
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


<?php } ?>
</div>
<div><br></div>