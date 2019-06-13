<?php
   $page="Assign Course Teacher"; 
   require_once('include/header.php');
   if($_SESSION['category'] != 'Chairman'){
    header("Location:404.php");   
   }
   require_once('connect.php');
   date_default_timezone_set('Asia/Dhaka');
   $date = date('Y-m-d');

 
if(isset($_POST['save'])){

      $updaate=$mysqli->query("update course_teacher set active=0 where course_id='$_POST[course_id]'");
    
      $insert = $mysqli->query("insert into course_teacher (course_id,teacher_id,date_time,active) values('$_POST[course_id]', '$_POST[teacher_id]','$date','1')");
        
        if($insert){
        $msg= '<div class="alert alert-success alert-success-style1 alert-st-bg alert-st-bg11">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                    </button>
                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr admin-check-pro-clr11" aria-hidden="true"></i>
                                <strong>Success!</strong> Course teacher info succesfully added.
                            </div>';  
      }else{
        $msg= "<font color='#FF0000' size='+1'><b>Failed</b></font>";  
      }
      
    } 
    //echo $mysqli->error;
    

  ?>

<div class="container-fluid">
 <div class="col-lg-3"></div>
 <div class=" col-lg-6 panel-body">

 <h4>Assign Course Teacher</h4>
 <form action="" class="add-professors" id="teacher" method="post">
 <?php if (isset($msg)) { echo $msg;} ?>
  <div class="form-group">
        <select name="teacher_id" type="text" class="form-control">
            <option value="none" selected="" disabled="">---Select Teacher---</option>
            <?php 
              $query = $mysqli->query("select id,full_name from teacher");
              while($rows = $query->fetch_array()){
            ?>
            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['full_name']; ?></option>
             <?php  } ?>
        </select>
    </div>
  <div class="form-group">
    
        <select name="course_id" type="text" class="form-control" onchange="getNewVal(this);">
            <option value="none" selected="" disabled="">---Select Course---</option>
            <?php 
              $query = $mysqli->query("select id,course_title from course");
              while($rows = $query->fetch_array()){
            ?>
            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['course_title']; ?></option>
             <?php  } ?>
        </select>
    </div> 
    <div id="course-info" >
      
    </div>

    

  
    
    
    <input class="login-button" type="submit" name="save" value="Save">
  </form>
  </div>




</div>

<?php require_once('include/footer.php'); ?>

<script>
  function getNewVal(item)
{

   if (window.XMLHttpRequest) {
// script for browser version above IE 7 and the other popular browsers (newer browsers)
            xmlhttp = new XMLHttpRequest();
        } else {
// script for the IE 5 and 6 browsers (older versions)
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("course-info").innerHTML = this.responseText;
// get the element in which we will use as a placeholder and space for table
            }
        };
        xmlhttp.open("GET","include/get_courseinfo.php?q="+item.value,true);
        xmlhttp.send();
    }




</script>