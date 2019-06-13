<script src="js/ckeditor4/ckeditor.js"></script>


<?php
   $page="Add Course Content"; 
   require_once('include/header.php');
   require_once('connect.php');
   /*-------user category check start----------*/
   if($_SESSION['category'] != 'Teacher'){
    header("Location:404.php");   
   }
   /*-------user category check end----------*/


   $date = date('Y-m-d H:i:s');
 ?>

<?php
	if(isset($_POST['submit'])){
		$insert = $mysqli->query("insert into course_content (topic_name,pffd_course,content,keyword,date_time,up_by) values('$_POST[topic_name]', '$_POST[pffd_course]','$_POST[content]','$_POST[keyword]','$date','$teacher_id')");
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
<div class="container-fluid"> 
   <div class="col-lg-3"></div>
   <div class="col-lg-6  panel-body">
   <h4>Add Course Content</h4>
        
    <form action="" class="add-professors" id="teacher" method="post">
        <div class="col-lg-12">
             <?php if(isset($alert)){echo $alert;} ?>
                <div class="form-group">
                    <input name="topic_name" type="text" class="form-control" placeholder="Topic Name">
                </div>
                <div class="form-group">
                    <input name="keyword" type="text" class="keyword form-control" placeholder="Topic Name" data-role="tagsinput">
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
                
                
            
                
                
                <div class="form-group res-mg-t-15">
                    <label for="content">Content:</label>
                    <textarea id="content"  class="ckeditor"name="content" placeholder="Content" ></textarea>
                </div>
                
               
            
        </div>
                
               
        <div class="row">
            <div class="col-lg-12">
                <div class="payment-adress">
                    <input type="submit" name="submit" class="btn btn-primary waves-effect waves-light" value="Add Content" >
                </div>
            </div>
        </div>
    </form>
          
   </div>
                           
        
</div>

 <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
    CKEDITOR.replace( 'conetnt' );
    CKEDITOR.add; 
</script>

<?php require_once('include/footer.php'); ?>
<script>
$('.keyword').tagsinput();
</script>
