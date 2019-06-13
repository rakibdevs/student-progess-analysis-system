
 <?php if($_SESSION['category']=='Student'){?>
<ul class="message-menu">
 

 

 
<?php
$query = $mysqli->query("select * from message inner join course on message.course_id=course.id where course.lvl_sem='$sLvl_sem' order by message.id desc");
 while($message = $query->fetch_array()){
    $time_date=date('M d, Y h:i A', strtotime($message['time_date']));
    //$exam_date=date('', strtotime($exam['exam_date']));
    //$status=$exam['status'];
    $course_id=$message['course_id'];
    $this_id=$message['teacher_id'];
    $query_c = $mysqli->query("select * from course where id=$course_id ");
    $e_course = $query_c->fetch_array();
?>
    <li>
        <a href="messages.php?id=<?php echo $this_id; ?>">
            <div class="message-img" >
                <img src="upload/professor/<?php echo $this_id; ?>.jpg" alt="">
            </div>
            <div class="message"> 
                <?php echo "<b>".$message['msg'].": </b>".substr($message['msg_body'], 0, 60).'....'; ?>
                <i class="message-date"><?php echo $time_date; ?></i> 
            </div>

            
        </a>
    </li>
<?php  } ?>


</ul>
<div class="message-viewe">
    <a href="messages.php">View All Messages</a>
</div>


<?php  } ?>



<?php
if($_SESSION['category']=='Teacher'){

   $date = date('Y-m-d H:i:s');
    if(isset($_POST['upmsg'])){
        $insert = $mysqli->query("insert into message (msg,msg_body,teacher_id,course_id,time_date) values('$_POST[msg]','$_POST[msg_body]','$teacher_id', '$_POST[pffd_course]','$date')");
        //echo $mysqli->error;
        if($insert){
            $alert= '<div class="alert alert-success alert-success-style1 alert-st-bg alert-st-bg11">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                </button>
                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr admin-check-pro-clr11" aria-hidden="true"></i>
                            <strong>Success!</strong> Content has been succesfully Uploaded.
                        </div>';    
        }else{
            $alert= "<font color='#FF0000' size='+1'><b>Failed</b></font>"; 
        }
            
        
    }
?>

                    
   
      
    <form action="" class="add-professors" id="msg" method="post">
        <div class="col-lg-12">
         <?php if(isset($alert)){echo $alert;} ?>
            <div class="form-group">
                <input name="msg" type="text" class="form-control" placeholder="Message Title">
            </div>
            
            <div class="form-group">
                <select name="pffd_course" type="text" class="form-control">
                    <option value="0" selected="" >---Preffered Course---</option>
                    <?php
                    $query1 = $mysqli->query("select distinct course_teacher.course_id, course_title from course join course_teacher on course.id = course_teacher.course_id where course_teacher.teacher_id=$teacher_id");
                    while($course = $query1->fetch_array()){ 
                        ?>
                    <option value="<?php echo $course['course_id']; ?>"><?php echo $course['course_title']; ?></option>
                    <?php } ?> 
                </select>
            </div>
            <div class="form-group ">                   
                <textarea    name="msg_body" placeholder="Content" style="height:100px;"></textarea>
            </div>
            
        </div>
                                         
        <div class="row">
            <div class="col-lg-12">
                <div class="payment-adress">
                    <!-- <a class="btn btn-primary waves-effect waves-light" data-dismiss="modal" href="#">Cancel</a> -->
                    <input type="submit" name="upmsg" class="btn btn-primary waves-effect waves-light" value="Add Message" >
                </div>
            </div>
        </div>
    </form>


<?php }       ?>


