<?php
   if (isset($_GET['name'])) {
	$page=$_GET['name'];
    }else
   {$page="Teacher Profile"; }
   require_once('include/header.php');
   require_once('connect.php');
   $get_id=$_GET['id']; 
   $query = $mysqli->query("select * from teacher where id=$get_id");
   $rows = $query->fetch_array();

 ?>


<div class="container-fluid"> 
<div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="profile-info-inner">
                            <div class="profile-img">
                                <img src="upload/professor/man.jpg" alt="" />
                            </div>
                            <div class="profile-details-hr">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="address-hr">
                                            <b><?php echo $rows['full_name'] ?></b>
                                        </div>
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <?php echo $rows['designation'] ?>
                                        </div>
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <?php echo $rows['department'] ?>
                                        </div>
                                        <div class="address-hr">
                                            <b>Email:</b> <?php echo $rows['email'] ?>
                                        </div>
                                        <div class="address-hr">
                                            <b>Phone:</b> <?php echo $rows['phone'] ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                       <div  class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg panel-body">
                          <ul class="nav nav-tabs custon-set-tab">
                              <li class="active"><a data-toggle="tab" href="#Projects">Courses</a>
                              </li>
                              <li ><a data-toggle="tab" href="#Notes">Examination</a>
                              </li>
                              <li><a data-toggle="tab" href="#Settings">Course Materials</a>
                              </li>
                              
                              
                          </ul>
                  

                          <div class="tab-content custom-bdr-nt" style="min-height: 400px;padding: 20px 0;">
                              <div id="Notes" class="tab-pane fade ">
                                  <div class="notes-area-wrap">
                                     <ul class="exam-list">
                                       <?php 
                                          $query_e = $mysqli->query("select * from exam where teacher_id=$get_id and status='Pending' order by exam_date desc ");
                                          if($_SESSION['category']=='Student'){
                                            $query_e = $mysqli->query("select * from exam inner join course on exam.course_id=course.id where exam.teacher_id=$get_id and exam.status='Pending' and exam.exam_session='$sExam_session' and course.lvl_sem='$sLvl_sem' order by exam.exam_date desc");
                                          }
                                          while($exam = $query_e->fetch_array()){
                                            $exam_time=date('h:i A', strtotime($exam['exam_time']));
                                            $exam_date=date('M d, Y', strtotime($exam['exam_date']));
                                        ?>
                                        <li>
                                          <div class="<?php if (($userCat=='Teacher' && $get_id==$teacher_id)||$userCat=='Student') { echo 'col-lg-8';}else { echo'col-lg-12';}?>">

                                            <b><a  href="take_exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>"> <span style="color:#d4782c;"><?php echo $exam['exam_key']; ?> : </span>  <?php echo $exam['exam_title']; ?>- <?php echo $exam['exam_session'];?></a></b>
                                            
                                            <?php 
                                            $course_id=$exam['course_id'];
                                            $query_c = $mysqli->query("select * from course where id=$course_id ");
                                            $e_course = $query_c->fetch_array();
                                             ?>
                                             <br>
                                              <span style="font-size:12px;">Course: <a style="color:#006DF0;font-size:12px;" href="course_details.php?id=<?php echo $e_course['id']; ?>&&title=<?php echo $e_course['course_title']; ?>"><i><?php echo $e_course['course_title']; ?></i></a></span>
                                            <br>
                                            <span style="font-size:12px;color:#1a1a1a;"> 
                                            <i class="fa fa-calendar"> </i> <?php echo $exam_date; ?>&nbsp;&nbsp; 
                                            <i class="fa fa-clock-o" aria-hidden="true"> </i> <?php echo $exam_time; ?>&nbsp;&nbsp; </span>
                                          </div>
                                           <div class="col-lg-4" style="text-align:right;padding-top:15px;">
                                            <?php 
                                            if ($userCat=='Teacher' && $get_id==$teacher_id) {
                                            ?>
                                            
                                            <button data-toggle="tooltip" title="Start Exam" class="pd-setting-ed" type="button" style="color:green;" ><a style="color:green;" href="take_exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>">Start</a> </button>
                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a  href="edit_exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></button>
                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed" ><a href="exam_delete.php?id=<?php echo $exam['exam_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true" style="color:#ff0000;"></i></a></button>
                                            <?php } ?>
                                            <?php if($_SESSION['category']=='Student'){ ?>
                                            <button data-toggle="tooltip" title="Participate in Exam" class="pd-setting-ed" type="button" style="color:green;" ><a style="color:green;" href="exam.php?id=<?php echo $exam['exam_id']; ?>&&Key=<?php echo $exam['exam_key']; ?>">Participate</a> </button>
                                            <?php } ?>
                                            </div>

                                            
                                            
                                          

                                               <!--  <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button> -->
                                            
                                        </li>
                                       <?php  } ?>
                                    </ul>
                                  </div>
                              </div>
                              <div id="Projects" class="tab-pane fade in active">
                                 <div class="projects-settings-wrap exam-list">
                                   <ul>
                                      <?php
                                        $query1 = $mysqli->query("select * from course join course_teacher on course.id = course_teacher.course_id where course_teacher.teacher_id=$get_id");
                                        while($course = $query1->fetch_array()){
                                            echo '<li>  </i> <a href="course_details.php?id='.$course['course_id'].'&&title='.$course['course_title'].'">'.$course['course_title'].'</a> <i>'.$course['lvl_sem'].'</i><br>';
                                            $course=$course['course_id'];
                                            $qresult=$mysqli->query("select exam.course_id as cid, sum(exam.marks) as total, sum(exam_result.marks) as marks from exam inner join exam_result on exam.exam_key=exam_result.exam_key where exam.course_id=$course");
                                            //echo $mysqli->error;
                                            $r_exam = $qresult->fetch_array();
                                            if($r_exam['total']==0){
                                              $r_exam['total']=1;
                                            }
                                            $percentmarks=round(($r_exam['marks']/$r_exam['total'])*100);

                                            

                                            ?>
                                            <div class="col-lg-5 row">
                                                <div class="progress" style="margin:5px 0;">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percentmarks; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentmarks; ?>%">
                                                    <?php echo $percentmarks; ?>%
                                                  </div>
                                                </div>
                                            </div>
                                            
                                            </li>
                                      <?php } ?>
                                        
                                       
                                    </ul>


                                 </div>
                              </div>
                              <div id="Settings" class="tab-pane fade ">
                                 <div class="ex-pro">
                                    <ul>
                                      <?php
                                        $query = $mysqli->query("select * from books where teacher_id=$get_id");
                                        while($books = $query->fetch_array()){
                                            echo '<li><i class="fa fa-angle-right"></i><a href="read.php?book_id='.$books['id'].'">'.$books['book_name'].'-'.$books['edition'].'</a> by '.$books['writer'].'</li>';
                                        }
                                         
                                        ?>
                                        
                                       
                                    </ul>
                                </div>

                              </div>



                        
                    </div>
                </div>
            </div>
        </div>


</div>



<?php require_once('include/footer.php'); ?>