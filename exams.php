<?php
   $page="All Exams"; 
   require_once('include/header.php');
   require_once('connect.php');

 ?>


<div class="container-fluid"> 
    <div class="panel-body">
                <h4 class="panel-head">All Exams </h4>
            
        <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright">
               
            <!-- if user is chairman or teacher -->
            <?php if($_SESSION['category']=='Teacher' || $_SESSION['category']=='Chairman'){ ?>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                    data-cookie-id-table="saveId" data-click-to-select="true" >
                    <thead>
                        <tr style="text-align:center;">
                            <th data-field="name" >Exam Key</th>
                            <th data-field="email" >Exam Title</th>
                            <th data-field="phone" >Exam Time</th>
                            <th data-field="complete">Status</th>
                            <?php if ($_SESSION['category']!='Chairman') {
                                echo '<th >Options</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
					      $query = $mysqli->query("select * from exam order by exam_date desc");
                          if ($_SESSION['category']=='Teacher') {
                            $query = $mysqli->query("select * from exam where teacher_id=$teacher_id order by exam_date desc");
                          }
						  while($exam = $query->fetch_array()){
                            $exam_time=date('h:i A', strtotime($exam['exam_time']));
                            $exam_date=date('M d, Y', strtotime($exam['exam_date']));
                            $status=$exam['status'];
                            $course_id=$exam['course_id'];
                            $session_id=$exam['teacher_id'];
                            $query_c = $mysqli->query("select * from course where id=$course_id ");
                            $e_course = $query_c->fetch_array();
					    ?>
                        <tr>
                            <td><?php echo $exam['exam_key']; ?> </td>
                            <td><a style="color:#006DF0;" href="take_exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>"><?php echo $exam['exam_title']; ?>- <?php echo $exam['exam_session'];?></a><br>
                                 <span style="font-size:12px;">Course: <a style="color:#d19354;font-size:12px;" href="course_details.php?id=<?php echo $e_course['id']; ?>&&title=<?php echo $e_course['course_title']; ?>"><i><?php echo $e_course['course_title']; ?></i></a>
                                 </span>
                            </td>
                            <td><i class="fa fa-calendar"> </i> <?php echo $exam_date; ?><br>
                                            <i class="fa fa-clock-o" aria-hidden="true"> </i> <?php echo $exam_time; ?></td>
                            <td>
                                <span style="color: <?php if($status=='Completed'){echo '#64a338';} else if ($status=='Running'){echo '#3865a3';}else{echo '#e03b24';}?>">
                                    <?php echo $exam['status'];  ?>
                                </span>
                            </td>
                            <!-- exam options for teacher -->
                            <?php
                             if ($userCat=='Teacher') { 
                                if($session_id==$teacher_id){
                                ?>
                                <td class="exam-button">
                                  <?php if($status=='Pending'){?>
                                            <button data-toggle="tooltip" title="Start Exam" class="pd-setting-ed" type="button" style="color:green;" ><a style="color:green;" href="take_exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>">Start</a> </button>
                                            <?php } ?>

                                    <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a  href="edit_exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></button>
                                    <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="exam_delete.php?id=<?php echo $exam['exam_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                            
                                </td>  
                                
                             <?php } } ?>
                             <!-- end  exam options for teacher  -->
	                            
	                        
                            
                        </tr>
                        
                        <?php  } ?>
                        
                    </tbody>
                </table>
            <?php } ?>
            <!-- end of chairman or teacher -->
           







            <!-- exam details for student -->
             <?php if($_SESSION['category']=='Student'){?>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                    data-cookie-id-table="saveId" data-click-to-select="true" >
                    <thead>
                        <tr style="text-align:center;">
                            <th data-field="name" >Exam Key</th>
                            <th data-field="email" >Exam Title</th>
                            <th data-field="phone" >Exam Time</th>
                            <th data-field="complete">Status</th>
                            <th >Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                          $query = $mysqli->query("select * from exam inner join course on exam.course_id=course.id where exam.exam_session='$sExam_session' and course.lvl_sem='$sLvl_sem' order by exam.exam_date desc");
                          while($exam = $query->fetch_array()){
                            $exam_time=date('h:i A', strtotime($exam['exam_time']));
                            $exam_date=date('M d, Y', strtotime($exam['exam_date']));
                            $status=$exam['status'];
                            $course_id=$exam['course_id'];
                            $session_id=$exam['teacher_id'];
                            $query_c = $mysqli->query("select * from course where id=$course_id ");
                            $e_course = $query_c->fetch_array();
                        ?>
                        <tr>
                            <td><?php echo $exam['exam_key']; ?> </td>
                            <td><a style="color:#006DF0;" href="exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>"><?php echo $exam['exam_title']; ?>- <?php echo $exam['exam_session'];?></a><br>
                                 <span style="font-size:12px;">Course: <a style="color:#d19354;font-size:12px;" href="course_details.php?id=<?php echo $e_course['id']; ?>&&title=<?php echo $e_course['course_title']; ?>"><i><?php echo $e_course['course_title']; ?></i></a>
                                 </span>
                            </td>
                            <td><i class="fa fa-calendar"> </i> <?php echo $exam_date; ?><br>
                                            <i class="fa fa-clock-o" aria-hidden="true"> </i> <?php echo $exam_time; ?></td>
                            <td>
                                <span style="color: <?php if($status=='Completed'){echo '#64a338';} else if ($status=='Running'){echo '#3865a3';}else{echo '#e03b24';}?>">
                                    <?php echo $exam['status'];  ?>
                                </span>
                            </td>
                            
                                <td class="exam-button">
                                    <button data-toggle="tooltip" title="Start Exam" class="pd-setting-ed" type="button"  ><a style="color:green;" href="exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>">Start</a> </button>

                                   
                                </td>  
                                
                       
                                
                            
                            
                        </tr>
                        
                        <?php  } ?>
                        
                    </tbody>
                </table>
            <?php } ?>










            </div>
        </div>
    </div>

</div>


 <!-- data table JS
		============================================ -->
    
<?php require_once('include/footer.php'); ?>



