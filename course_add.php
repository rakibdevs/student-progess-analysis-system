<script src="js/ckeditor4/ckeditor.js"></script>


<?php
   $page="Add Course"; 
   require_once('include/header.php');
   if($_SESSION['category'] != 'Chairman'){
    header("Location:404.php");   
   }
   require_once('connect.php');

 ?>

<?php
	if(!empty($_POST['submit'])){
		$check = $mysqli->query("select * from course where course_code = '$_POST[course_code]'");
		if($check->num_rows > 0){
			echo "<font color='#FF0000' size='+1'><b>Course Information is Allready exists</b></font>";	
		}
		else{
			
			$insert = $mysqli->query("insert into course (course_title,course_code,credit,lvl_sem,ref_book,syllabus) values('$_POST[course_title]', '$_POST[course_code]','$_POST[credit]','$_POST[lvl_sem]','$_POST[ref_book]','$_POST[syllabus]')");
				
		    if($insert){
				echo '<div class="alert alert-success alert-success-style1 alert-st-bg alert-st-bg11">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                    </button>
                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr admin-check-pro-clr11" aria-hidden="true"></i>
                                <strong>Success!</strong> Course details succesfully added.
                            </div>';	
			}else{
				echo "<font color='#FF0000' size='+1'><b>Failed</b></font>";	
			}
			
		}	
		//echo $mysqli->error;
		
	}
?>
<div class="container-fluid"> 
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class=" panel-body">
           <h4>Add Course Information</h4>
                
            <form action="" class="add-professors" id="teacher" method="post">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input name="course_title" type="text" class="form-control" placeholder="Course Title">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="course_code" placeholder="Course Code">
                        </div>
                        
                        <div class="form-group res-mg-t-15">
                            <label for="reference_books">Reference Books:</label>
                            <textarea id="reference_books" class="ckeditor" name="ref_book" placeholder="Reference Books"></textarea>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="credit" placeholder="Credit Hour">
                        </div>
                        <div class="form-group">
                            <select name="lvl_sem" type="text" class="form-control">
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
                        
                        <div class="form-group res-mg-t-15">
                            <label for="syllabus">Syllabus:</label>
                            <textarea id="syllabus"  class="ckeditor"name="syllabus" placeholder="Syllabus" ></textarea>
                        </div>
                        
                        
                       
                        
                        
                    </div>
                    
                </div>
                        
                       
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-adress">
                            <input type="submit" name="submit" class="btn btn-primary waves-effect waves-light" value="Add Course" >
                        </div>
                    </div>
                </div>
            </form>
                  
           </div>
         </div>                  
        </div>
</div>

 <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'syllabus' );
                CKEDITOR.add; 
                CKEDITOR.replace( 'reference_books' );
                CKEDITOR.add;
            </script>

<?php require_once('include/footer.php'); ?>
<script  src="js/wirislib.js"></script>