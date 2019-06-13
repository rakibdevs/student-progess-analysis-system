<?php
   $page="All Assignments"; 
   require_once('include/header.php');
   require_once('connect.php');

 ?>


<div class="container-fluid"> 
    <div class="panel-body">
                <h4 class="panel-head">All Assignments </h4>
            
        <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright">
               
            <!-- if user is chairman or teacher -->
            <?php if($_SESSION['category']=='Teacher' || $_SESSION['category']=='Chairman'){ ?>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"data-cookie-id-table="saveId" data-click-to-select="true" >
                    <thead>
                        <tr style="text-align:center;">
                            <th data-field="name" >Assignment Key</th>
                            <th data-field="email" >Assignment Title</th>
                            <th data-field="phone" >Deadline</th>
                            <?php if ($_SESSION['category']!='Chairman') {
                                echo '<th >Options</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
					      $query = $mysqli->query("select * from assignment order by ass_id desc");
                          if ($_SESSION['category']=='Teacher') {
                            $query = $mysqli->query("select * from assignment where teacher_id=$teacher_id order by ass_id desc");
                          }
						  while($assignment = $query->fetch_array()){
                            $deadline=date('M d, Y', strtotime($assignment['deadline']));
                            $course_id=$assignment['course_id'];
                            $session_id=$assignment['teacher_id'];
                            $query_c = $mysqli->query("select * from course where id=$course_id ");
                            $e_course = $query_c->fetch_array();
					    ?>
                        <tr>
                            <td><?php echo $assignment['ass_key']; ?> </td>
                            <td><a style="color:#006DF0;" href="assignment.php?id=<?php echo $assignment['ass_id']; ?>&&Key=<?php echo $assignment['ass_key']; ?>"><?php echo $assignment['ass_title']; ?></a><br>
                                 <span style="font-size:12px;">Course: <i><a style="color:#d19354;font-size:12px;" href="course_details.php?id=<?php echo $e_course['id']; ?>&&title=<?php echo $e_course['course_title']; ?>"><?php echo $e_course['course_title']; ?></a><?php echo $assignment['ass_session'];?></i>
                                 </span>
                            </td>
                            <td><i class="fa fa-calendar"> </i> <?php echo $deadline; ?>
                            
                            <!-- exam options for teacher -->
                            <?php
                             if ($userCat=='Teacher') { 
                                if($session_id==$teacher_id){
                                ?>
                                <td class="exam-button">

                                    <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a  href="edit_assignment.php?id=<?php echo $assignment['ass_id']; ?>&&Key=<?php echo $assignment['ass_key']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></button>
                                    <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="assignment_delete.php?id=<?php echo $assignment['ass_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                            
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
             <?php if($_SESSION['category']=='Student'){ ?>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"  data-cookie-id-table="saveId" data-click-to-select="true" >
                    <thead>
                        <tr style="text-align:center;">
                            <th data-field="name" >Assignment Key</th>
                            <th data-field="email" >Assignment Title</th>
                            <th data-field="phone" >Deadline</th>
                            <th >Option</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                          $query1 = $mysqli->query("select * from assignment inner join course on assignment.course_id=course.id where assignment.ass_session='$sExam_session' and course.lvl_sem='$sLvl_sem' order by assignment.ass_id desc");
                          
                          while($assignment = $query1->fetch_array()){
                            $deadline=date('M d, Y', strtotime($assignment['deadline']));

                            $course_id=$assignment['course_id'];
                            $session_id=$assignment['teacher_id'];
                            $ass_key=$assignment['ass_key'];
                            $query_c = $mysqli->query("select * from course where id=$course_id ");
                            $e_course = $query_c->fetch_array();
                        
                        ?>
                        <tr>
                            <td><?php echo $assignment['ass_key']; ?> </td>
                            <td><a style="color:#006DF0;" href="assignment.php?id=<?php echo $assignment['ass_id']; ?>&&Key=<?php echo $assignment['ass_key']; ?>"><?php echo $assignment['ass_title']; ?> </a><br>
                                 <span style="font-size:12px;">Course: <i><a style="color:#d19354;font-size:12px;" href="course_details.php?id=<?php echo $e_course['id']; ?>&&title=<?php echo $e_course['course_title']; ?>"><?php echo $e_course['course_title']; ?></a> <?php echo $assignment['ass_session'];?></i>
                                 </span>
                            </td>
                            <td><i class="fa fa-calendar"> </i> <?php echo $deadline; ?>
                            
                            
                                <td class="exam-button">

                                  <?php 
                                     $query_p = $mysqli->query("select * from ass_submission where ass_key='$ass_key' and submitted_by=$userStudent");/*
                                     $asssub= $query_p->fetch_array();*/
                                     $asssub = $query_p->num_rows; 

                                  ?>
                                    <button data-toggle="tooltip" title="Submit Assignment" class="pd-setting-ed" type="button"  ><a style="color:green;" href="assignment.php?id=<?php echo $assignment['ass_id']; ?>&&Key=<?php echo $assignment['ass_key']; ?>"> <?php if($asssub==0){echo 'Submit';} else echo 'View'; ?></a> </button>

                                   
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



