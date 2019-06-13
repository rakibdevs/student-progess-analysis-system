<?php
   $page="Add Running Student"; 
   require_once('include/header.php');
   require_once('connect.php');
   if($_SESSION['category'] != 'Chairman'){
    header("Location:404.php");   
   }

 ?>

<?php
	if(isset($_POST['submit'])){
        if(isset($_POST['student_id'])&&isset($_POST['month'])&&isset($_POST['lvl_sem'])&&isset($_POST['year'])){
		    $exam_session=$_POST['year'].' ('.$_POST['month'].')';
		
			
			$insert = $mysqli->query("insert into student (student_id,session,lvl_sem,exam_session) values('$_POST[student_id]', '$_POST[session]','$_POST[lvl_sem]','$exam_session')");
				
		    if($insert){
				$msg= "<font color='#009900' size='+1'><b>Student Information (username:".$_POST['student_id']." and password: 1234 ) has been Saved!!</b></font>";
                $userinsert = $mysqli->query("insert into user (username,password,category) values('$_POST[student_id]', '1234','Student')");	
			}else{
				$msg= "<font color='#FF0000' size='+1'><b>Failed</b></font>";	
			}
			
			
		//echo $mysqli->error;
       }
		
	}
?>
<div class="container-fluid"> 
        <div class="row">
           <div class="col-lg-4">
           <div class="panel-body">
            <center><b>Add Student</b></center>
              
            <form action="" class="add-professors " id="teacher" method="post" >
              <?php if (isset($msg)) {echo $msg;} ?>  
                        <div class="form-group">
                            <label style="width:100%">Student Id: </label>
                            <input id="student_id" name="student_id" type="text" class="form-control" size="7" maxlength="7" placeholder="Student ID" required>
                        </div>
                        <div class="form-group">
                            <label style="width:100%">Session: </label>
                            <input id="session" type="text" class="form-control" name="session" placeholder="Session" size="4" maxlength="4" required>
                        </div>
                        <div class="" >
                            <label style="width:100%">Semester Session: </label>
                            <select id="year" name="year" type="text" style="width: 49%;text-align: center;height: 35px;float:left;margin-right:2%;" required>
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
                            <select id="month" name="month" type="text" style="width: 49%;text-align: center;height: 35px;"  required>
                                <option value="0" selected="" >---Select Month---</option>
                                <option value="Jan-Jun"  >Jan-Jun</option>
                                <option value="Jul-Dec"  >Jul-Dec</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="width:100%">Level & Semester: </label>
                            <select id="lvl_sem" name="lvl_sem" type="text" class="form-control" >
                                <option value="none" selected="" disabled="">Select Level & Semester</option>
                                <option value="L-1 S-I">L-1 S-I</option>
                                <option value="L-1 S-II">L-1 S-II</option> 
                                <option value="L-2 S-I">L-2 S-I</option> 
                                <option value="L-2 S-II">L-2 S-II</option> 
                                <option value="L-3 S-I">L-3 S-I</option> 
                                <option value="L-3 S-II">L-3 S-II</option> 
                                <option value="L-4 S-I">L-4 S-I</option> 
                                <option value="L-4 S-II">L-4 S-II</option>  
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary waves-effect waves-light"  value="Add Student">
                        </div>                                            
                   
                        
                
            </form>
                  
           </div>
        </div> 
        <div class="col-lg-8">
           <div class="panel-body">
              <center><b>Running Student</b></center>
              
              <?php include('running_student.php') ?>
           </div>

        </div>                  
        </div>
</div>



<?php require_once('include/footer.php'); ?>
<script>
$(document).on('input',"#student_id",function () {
       var optVal= $("#student_id").val();
       var res = optVal.substring(0, 2);
       var pp='20'.concat(res);
       $("#session").val(pp);

       
            
   });


</script>
<script>
document.getElementById('lvl_sem').value = "<?php echo $_POST['lvl_sem'];?>";
document.getElementById('year').value = "<?php echo $_POST['year'];?>";
document.getElementById('month').value = "<?php echo $_POST['month'];?>";
</script>