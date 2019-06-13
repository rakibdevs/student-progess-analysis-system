  <link rel="stylesheet" href="css/datapicker/datepicker3.css">
<?php
   $page="Create Assignment"; 
   require_once('include/header.php');
   require_once('connect.php');

   /*-------user category check start----------*/
   if($_SESSION['category'] != 'Teacher'){
    header("Location:404.php");   
   }
   /*-------user category check end----------*/

 ?>
<?php
  if(isset($_POST['submit'])){
    if(empty($_POST['year'])||empty($_POST['month'])||empty($_POST['pffd_course'])){
       $alert="<font color='#FF0000' size='1' align='center'><b>Select fields!</b></font>";
    }
    
    //$exam_time=date('Y-m-d H:i:s', strtotime($_POST['exam_time']));
    if(empty(!$_POST['year'])&&!empty($_POST['month'])&&!empty($_POST['pffd_course'])){
      //$deadline=$_POST['deadline'];
      $course_info=$_POST['pffd_course'];
      $result_explode = explode('|', $course_info);
      $course_id=$result_explode[0];
      /*get last id*/
      $last_q=$mysqli->query("select ass_id from assignment order by ass_id desc limit 1");
      $get_id=$last_q->fetch_array();
      $last_id=$get_id['ass_id']+1;
      $session=$_POST['year'].' ('.$_POST['month'].')';

      $ass_key='AM-'.$result_explode[1].'-'.str_pad($last_id, 4, "0", STR_PAD_LEFT);
      $insert = $mysqli->query("insert into assignment (ass_key,ass_title,ass_session,instruction,deadline, marks,teacher_id,course_id) values('$ass_key','$_POST[ass_title]','$session','$_POST[instruction]','$_POST[deadline]', '$_POST[marks]','$teacher_id','$course_id')");
        
        if($insert){
          $alert= '<div class="alert alert-success alert-success-style1 alert-st-bg alert-st-bg11">
                              <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                      <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                  </button>
                              <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr admin-check-pro-clr11" aria-hidden="true"></i>
                              <strong>Success!</strong> Assignment No. <b>'.$ass_key.' </b> has been succesfully Created.
                          </div>';  
      }else{
        $alert="<font color='#FF0000' size='+1'><b>Failed</b></font>";  
      }
    }
      
    }
?>

<div class="container-fluid"> 
        <div class="col-lg-12">

           
           
        
            <div class=" panel-body">
           <h4>Create Assignment</h4>
                
            <form action="" class="add-professors" id="teacher" method="post">
                       <?php if (isset($alert)) {
                         echo $alert ;
                       }
                       ?>
                       <div class="col-lg-6">
                          <div class="form-group">
                              <label>Assignment Title:</label>
                              <input name="ass_title" type="text" class="form-control" placeholder="Assignment Title" required>
                          </div>
                          <div class="form-inline" >
                                 <label>Deadline:</label>
                                    <input class="form-control" type="date" name="deadline" value="" required>
                               
                            </div>
                          
                          <div class="form-group">
                              <label>Marks:</label>
                              <input type="text" class="form-control" name="marks" placeholder="Marks" required>
                          </div>
                           <div class="form-group">
                              <label>Course:</label>
                              <select name="pffd_course" type="text" class="form-control" required>
                                  <option value="0" selected="" >---Select Course---</option>
                                  <?php
                                  $query1 = $mysqli->query("select distinct course_teacher.course_id, course_code, course_title from course join course_teacher on course.id = course_teacher.course_id where course_teacher.teacher_id=$teacher_id and course_teacher.active=1");
                                  while($course = $query1->fetch_array()){ 
                                      ?>
                                  <option value="<?php echo $course['course_id']; ?>|<?php echo $course['course_code']; ?>"><?php echo $course['course_title']; ?></option>
                                  <?php } ?> 
                              </select>
                          </div>
                          <div class="form-inline form-group ">
                              <label>Session: </label>
                              <select name="year" type="text" class="form-control" required>
                                  <option value="0" selected="" >---Select Year---</option>
                                  <option value="2015"  >2015</option>
                                  <option value="2016"  >2016</option>
                                  <option value="2017"  >2017</option>
                                  <option value="2018"  >2018</option>
                                  <option value="2019"  >2019</option>
                                  <option value="2020"  >2020</option>
                                  <option value="2021"  >2021</option>
                                  <option value="2022"  >2022</option>
                              </select>
                              <select name="month" type="text" class="form-control" required>
                                  <option value="0" selected="" >---Select Month---</option>
                                  <option value="Jan-Jun"  >Jan-Jun</option>
                                  <option value="Jul-Dec"  >Jul-Dec</option>
                                  
                              </select>

                          </div>
                          
                        </div>
                    
                        <div class="col-lg-6">
                          <div class="form-group res-mg-t-15">
                              <label for="content">Instruction:</label>
                              <textarea id="content"  class="ckeditor"name="instruction" placeholder="Content" ></textarea>
                          </div>
                         
                        </div>
                       
                        
                        
                        
                       
                        
                        
                    
                    
               
                        
                       
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-adress">
                            <input type="submit" name="submit" class="btn btn-primary waves-effect waves-light" value="Create Exam" >
                        </div>
                    </div>
                </div>
            </form>
                  
           </div>
                           
        </div>
</div>

<script>
    CKEDITOR.replace( 'conetnt' );
    CKEDITOR.add; 
</script>

<?php require_once('include/footer.php'); ?>
  <!-- datapicker JS
		============================================ -->
    <script src="js/datapicker/bootstrap-datepicker.js"></script>
    <script src="js/datapicker/datepicker-active.js"></script>
