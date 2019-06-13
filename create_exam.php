  <link rel="stylesheet" href="css/datapicker/datepicker3.css">
<?php
   $page="Create Exam"; 
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
      $hour=$_POST['hour'];
      $minute=$_POST['minute'];
      $duration=str_pad($hour, 2, "0", STR_PAD_LEFT).':'.str_pad($minute, 2, "0", STR_PAD_LEFT);
      $exam_time=$_POST['exam_time'];
      $course_info=$_POST['pffd_course'];
      $result_explode = explode('|', $course_info);
      $course_id=$result_explode[0];
      /*get last id*/
      $last_q=$mysqli->query("select exam_id from exam order by exam_id desc limit 1");
      $get_id=$last_q->fetch_array();
      $last_id=$get_id['exam_id']+1;
      $session=$_POST['year'].' ('.$_POST['month'].')';

      $exam_key=$result_explode[1].'-'.str_pad($last_id, 4, "0", STR_PAD_LEFT);
      $insert = $mysqli->query("insert into exam (exam_key,exam_title,duration,marks,exam_date,exam_time,teacher_id,course_id,exam_session,exam_type) values('$exam_key','$_POST[exam_title]','$duration', '$_POST[marks]','$_POST[exam_date]','$exam_time','$teacher_id','$course_id','$session','$_POST[exam_type]')");
        echo $mysqli->error;
        if($insert){
          $alert= '<div class="alert alert-success alert-success-style1 alert-st-bg alert-st-bg11">
                              <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                      <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                  </button>
                              <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr admin-check-pro-clr11" aria-hidden="true"></i>
                              <strong>Success!</strong> Exam <b>'.$exam_key.' </b> succesfully Created.
                          </div>';  
      }else{
        $alert="<font color='#FF0000' size='+1'><b>Failed</b></font>";  
      }
    }
      
    }
?>

<div class="container-fluid"> 
        <div class="row">

           <div class="col-lg-3">
           </div>
        
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 panel-body">
           <h4>Create Examination</h4>
                
            <form action="" class="add-professors" id="teacher" method="post">
                       <?php if (isset($alert)) {
                         echo $alert ;
                       }
                       ?>
                        <div class="form-group">
                            <input name="exam_title" type="text" class="form-control" placeholder="Exam Title" required>
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                             <label>Exam Date:</label>
                             <input class="form-control" type="date" name="exam_date" value="" required>
                            
                          </div>
                          <div class="col-lg-6">
                             <label>Exam Time:</label>
                                  <input class="form-control" type="time" name="exam_time" value="" required>
                            
                          </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                          <div class="col-lg-6">
                             <label>Marks:</label>
                             <input type="text" class="form-control" name="marks" placeholder="Marks" required>
                          </div>
                          <div class="col-lg-6" >
                            <label style="width:100%">Duration: </label> <br>
                            <input type="number" style="width: 49%;text-align: center;height: 35px;float:left;margin-right:2%;"  name="hour" placeholder="Hour" value="00" max="4"  pattern="[-+]?[0-9]">
                            <input type="number" style="width: 49%;text-align: center;height: 35px;"  name="minute" placeholder="Minute" value="00" max="59"  pattern="[-+]?[0-59]" required>
                          </div>
                        </div>

                        <div class="row" style="margin-top:10px;">
                          <div class="col-lg-6">
                            <div class="form-group  i-checks pull-left" style="">
                                <label style="width:100%">Exam Type: <?php //echo $exam['random'];?></label>
                                <!-- <label> --> <input id="exam_type1" name="exam_type" type="radio" value="MCQ "> <i></i> MCQ  <!-- </label> -->
                                <!-- <label>  --><input id="exam_type2" name="exam_type" type="radio" value="Written"> <i></i> Written <!--  </label> -->
                            </div>
                          </div>
                          <div class="col-lg-6" >
                            <label style="width:100%">Session: </label>
                            <select name="year" type="text" style="width: 49%;text-align: center;height: 35px;float:left;margin-right:2%;" required>
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
                            <select name="month" type="text" style="width: 49%;text-align: center;height: 35px;"  required>
                                <option value="0" selected="" >---Select Month---</option>
                                <option value="Jan-Jun"  >Jan-Jun</option>
                                <option value="Jul-Dec"  >Jul-Dec</option>
                                
                            </select>
                          </div>
                        </div>

                        
                        
                        
                        
                    
                        
                        <div class="form-group">
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



<?php require_once('include/footer.php'); ?>
  <!-- datapicker JS
		============================================ -->
    <script src="js/datapicker/bootstrap-datepicker.js"></script>
    <script src="js/datapicker/datepicker-active.js"></script>

<?php
/*}else{
    header("Location:login.php");   
}*/
?>