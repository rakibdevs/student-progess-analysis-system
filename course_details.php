<?php
if (isset($_GET['title'])) {
  $page=$_GET['title'];
}else
   $page="Course Details";
   $course_id=$_GET['id']; 
   require_once('include/header.php');
   require_once('connect.php');

   $query = $mysqli->query("select * from course where id=$course_id");
   $rows = $query->fetch_array();


 ?>

<style type="text/css">
  .tab-content{height: 350px;overflow: auto;}
  .tab-pane{padding: 10px;}
</style>

<div class="container-fluid"> 
    <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="profile-info-inner course-info">
                   <h5><?php echo $rows['course_title']; ?></h5>
                   <p><b>Course Code :</b> <?php echo $rows['course_code']; ?> </p>
                   <p><b>Credit :</b> <?php echo $rows['credit']; ?> </p>

                       
                </div>
                
                <?php
                $query_r = $mysqli->query("select * from course_content where pffd_course=$course_id order by content_id desc limit 5");
                if ($query_r->num_rows>0){ ?>
                <div class="panel-body">
                 <b>Course Materials</b>
                 <hr>
                 <ul>
                   
                   <?php while($row_r = $query_r->fetch_array()){
                    $query_t =$mysqli->query("select * from teacher where id=$row_r[up_by] ");
                    $row_t = $query_t->fetch_array();
                    echo '<li> <i class="fa fa-hand-o-right">  </i> <a href="course_content.php?content_id='.$row_r['content_id'].'&&title='.$row_r['topic_name'].'"> '.$row_r['topic_name'].'</a> by 
<a style="font-size:12px;color:#d19354;" href="teacher.php?id='.$row_t['id'].'&&name='.$row_t['full_name'].'"><i>'.$row_t['full_name'].'</i></a></li>';
                   }
                   ?>
                 </ul>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                
                <div  class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg panel-body">
                  <ul class="nav nav-tabs custon-set-tab">
                      <li class="active"><a data-toggle="tab" href="#Notes">Syllabus</a>
                      </li>
                      <li><a data-toggle="tab" href="#Projects">Reference Books</a>
                      </li>
                      <li><a data-toggle="tab" href="#Settings">Course Teachers</a>
                      </li>
                      <li><a data-toggle="tab" href="#Exam">Examination</a>
                      </li>
                  </ul>
                  

                  <div class="tab-content custom-bdr-nt">
                      <div id="Notes" class="tab-pane fade in active">
                          <div class="notes-area-wrap">
                              <?php echo $rows['syllabus']; ?>
                          </div>
                      </div>
                      <div id="Projects" class="tab-pane fade">
                          <div class="projects-settings-wrap">
                          <?php if ($rows['ref_book']!='') {
                           echo '<h6>Books</h6><hr>'.$rows['ref_book'];
                          }
                          ?>
                              <?php    $query_b = $mysqli->query("select * from books where course_id=$course_id");
                                  if($query_b->num_rows > 0){
                                    ?>
                              
                                    <h6>PDF Books</h6>
                                    <hr>
                                    <ul>
                                    <?php  
                                        while($books = $query_b->fetch_array()){
                                          echo '<li><i class="fa fa-hand-o-right">  </i> <a href="read.php?book_id='.$books['id'].'">'.$books['book_name'].'-'.$books['edition'].'</a> by '.$books['writer'].'</li>';
                                        }
                                    ?>
                                        
                                       
                                    </ul>
                              <?php } ?>
                              
                          </div>
                      </div>
                      <div id="Settings" class="tab-pane fade">
                          <div class="datatable-dashv1-list custom-datatable-overright">
                             <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                    data-cookie-id-table="saveId" data-click-to-select="true" >
                              <thead>
                                  <tr>
                                      <th data-field="phone" >Teacher</th>
                                      <th data-field="date" >Assigned Date</th>
                                  </tr>
                              </thead>
                              <tbody>
                                 <?php 
                                    $query1 = $mysqli->query("select * from course_teacher where course_id=$course_id order by id desc");
                                    while($c_t = $query1->fetch_array()){

                                      $t_id=$c_t['teacher_id'];
                                      $query2 = $mysqli->query("select * from teacher where id=$t_id");
                                      $teacher = $query2->fetch_array();
                                  ?>
                                  <tr>
                                      <td> <a href="teacher.php?id=<?php echo $teacher['id']; ?>&&name=<?php echo $teacher['full_name']; ?>"><?php echo $teacher['full_name']; ?></a></td>
                                      <td> <?php echo date('M d, Y', strtotime($c_t['date_time'])); ?></td>
                                     
                                      
                                  </tr>
                                  
                                  <?php  } ?>
                                  
                              </tbody>
                           </table>
                              
                              

                          </div>
                      </div>
                      <div id="Exam" class="tab-pane fade ">
                                  <div class="notes-area-wrap">
                                     <ul class="exam-list">
                                       <?php 
                                          $query_e = $mysqli->query("select * from exam where course_id=$course_id  order by exam_date desc ");
                                          if($_SESSION['category']=='Student'){
                                            $query_e = $mysqli->query("select * from exam inner join course on exam.course_id=course.id where course.id=$course_id and exam.exam_session='$sExam_session' and course.lvl_sem='$sLvl_sem' order by exam.exam_date desc");
                                          }
                                          while($exam = $query_e->fetch_array()){
                                            $exam_time=date('h:i A', strtotime($exam['exam_time']));
                                            $exam_date=date('M d, Y', strtotime($exam['exam_date']));
                                            $courseteacher_id=$exam['teacher_id'];
                                        ?>
                                        <li>
                                        <div class="<?php if (($userCat=='Teacher' && $courseteacher_id==$teacher_id)||$userCat=='Student') { echo 'col-lg-8';}else { echo'col-lg-12';}?>">
                                            <b> <span style="color:#d4782c;"><?php echo $exam['exam_key']; ?> : </span>  <?php echo $exam['exam_title']; ?>- <?php echo $exam['exam_session'];?></b>
                                            <?php 
                                            $course_id=$exam['course_id'];
                                            $query_c = $mysqli->query("select * from course where id=$course_id ");
                                            $e_course = $query_c->fetch_array()
                                             ?>
                                             <?php 
                                               $status=$exam['status']; ?>


                                             
                                             
                                             <br>
                                             <i class="fa fa-hand-o-right">  </i> <span style="color: <?php if($status=='Completed'){echo '#64a338';} else if ($status=='Running'){echo '#3865a3';}else{echo '#e03b24';}?>">
                                               <?php echo $exam['status'];  ?>&nbsp;&nbsp;
                                             </span>
                                            <i class="fa fa-calendar"> </i> <?php echo $exam_date; ?>&nbsp;&nbsp; 
                                            <i class="fa fa-clock-o" aria-hidden="true"> </i> <?php echo $exam_time; ?>&nbsp;&nbsp;
                                                
                                               <!--  <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button> -->
                                           </div> 

                                           <?php if ($userCat=='Teacher' && $courseteacher_id==$teacher_id){  ?>
                                           <div class="col-lg-4" style="text-align:right;padding-top:5px;">
                                            <?php if($status=='Pending'){?>
                                            <button data-toggle="tooltip" title="Start Exam" class="pd-setting-ed" type="button" style="color:green;" ><a style="color:green;" href="take_exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>">Start</a> </button>
                                            <?php } ?>
                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a  href="edit_exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></button>
                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed" ><a href="exam_delete.php?id=<?php echo $exam['exam_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true" style="color:#ff0000;"></i></a></button>
                                           </div>

                                          <?php  } ?>
                                        </li>
                                       <?php  } ?>
                                    </ul>
                                  </div>
                      </div>
                  </div>

                
</div>




            </div>
        </div>

</div>



<?php require_once('include/footer.php'); ?>