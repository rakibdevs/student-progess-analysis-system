<?php
   $page="Add Teacher"; 
   require_once('include/header.php');
   require_once('connect.php');
   if($_SESSION['category'] != 'Chairman'){
    header("Location:404.php");   
   }

 ?>

<?php
	if(!empty($_POST['submit'])){
		$check = $mysqli->query("select * from teacher where email = '$_POST[email]'");
		if($check->num_rows > 0){
			echo "<font color='#FF0000' size='+1'><b>Teacher Information is Allready exists</b></font>";	
		}
		else{
			
			$insert = $mysqli->query("insert into teacher (full_name,email,phone,password,department,designation,bio) values('$_POST[fullname]', '$_POST[email]','$_POST[phoneno]','$_POST[password]','$_POST[department]','$_POST[designation]')");
				
		    if($insert){
				$msg= "<font color='#009900' size='+1'><b>Student Information (username:".$_POST['email']." and password: 1234 ) has been Saved!!</b></font>";
                $userinsert = $mysqli->query("insert into user (username,password,category) values('$_POST[email]', '1234','Teacher')");   
			}else{
				$msg= echo "<font color='#FF0000' size='+1'><b>Failed</b></font>";	
			}
			
		}	
		//echo $mysqli->error;
		
	}
?>
<div class="container-fluid"> 
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
           <div class="panel-body">
            <h4>Add Teacher</h4>
            <form action="" class="add-professors " id="teacher" method="post" >
             <?php if (isset($msg)) {echo $msg;} ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >
                        <div class="form-group">
                            <input name="fullname" type="text" class="form-control" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input name="phoneno" type="text" class="form-control" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input name="confarmpassword" type="password" class="form-control" placeholder="Confirm Password">
                        </div>
                        
                        <!-- <div class="form-group alert-up-pd">
                            <div class="dz-message needsclick download-custom">
                                <i class="fa fa-download edudropnone" aria-hidden="true"></i>
                                <h2 class="edudropnone">Drop image here or click to upload.</h2>
                                <p class="edudropnone"><span class="note needsclick">(This is just a demo dropzone. Selected image is <strong>not</strong> actually uploaded.)</span>
                                </p>
                                <input name="imageico" class="hd-pro-img" type="text"/>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <select name="department" type="text" class="form-control">
								<!-- <option value="none" selected="" disabled="">Select Department</option> -->
								<option value="Electronics & Communication Engineering">Electronics & Communication Engineering</option>
								<option value="Computer Science & Engineering">Computer Science & Engineering</option>
								<option value="Electrical & Electronic Engineering">Electrical & Electronic Engineering</option>
							</select>
                        </div>
                        <div class="form-group">
                            <select name="designation" type="text" class="form-control">
								<option value="none" selected="" disabled="">Select Designation</option>
								<option value="Lecturer">Lecturer</option>
								<option value="Assistant Professor">Assistant Professor</option>
								<option value="Associate Professor">Associate Professor</option>
								<option value="Professor">Professor</option>
							</select>
                        </div>
                        <!-- <div class="form-group res-mg-t-15">
                            <label for="bio">Biography</label>
                            <textarea name="bio" placeholder="Biography"></textarea>
                        </div> -->
                        
                       
                        
                    </div>
                </div>
                        
                       
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-adress">
                            <input type="submit" name="submit" class="btn btn-primary waves-effect waves-light"  value="Add Teacher">
                        </div>
                    </div>
                </div>
            </form>
                  
           </div>
        </div>                   
        </div>
</div>



<?php require_once('include/footer.php'); ?>