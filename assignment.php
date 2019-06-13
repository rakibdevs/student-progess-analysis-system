<style type="text/css">
	.media,iframe{width: 100% !important;}
</style>
<?php
    $page="Add Exam";
    if (isset($_GET['Key'])) {
        $page=  $_GET['Key'] ;
     }
                        
   require_once('include/header.php');
   require_once('connect.php');
   $ass_key=$_GET['Key'];
   $ass_id=$_GET['id'];

    $query_ass = $mysqli->query("select * from assignment where ass_id=$ass_id");
	$assignment = $query_ass->fetch_array();
	$ass_key=$assignment['ass_key'];
	$c_id=$assignment['course_id'];

	$query_d = $mysqli->query("select * from course where id=$c_id ");
	$course = $query_d->fetch_array();

	$date = date('Y-m-d H:i:s');
 if ($_SESSION['category']=='Student') {

	$ass_file=$assignment['ass_key'].'-'.$userStudent;


	/*-------------query for assignment submission----------*/
	$query_a = $mysqli->query("select * from ass_submission where ass_file='$ass_file' and submitted_by=$userStudent");
	$ass= $query_a->fetch_array();
	$sub_time=date('h:i A', strtotime($ass['sub_time']));
    $sub_date=date('M d, Y', strtotime($ass['sub_time']));
 }
 ?>
<?php
    if(isset($_POST['submit'])){
       
        $filename=basename( $_FILES['bookfile']['name']);
        $tmp_ext=explode(".", $filename);
        $ext=end($tmp_ext);
        $path = "upload/assignment/";

        $new_name=$ass_file.'.'.$ext;
        $path = $path . $new_name ;
        if(move_uploaded_file($_FILES['bookfile']['tmp_name'], $path)) {
         
         $insert = $mysqli->query("insert into ass_submission (ass_key,submitted_by,file,ass_file, sub_time) values('$ass_key', '$userStudent','$new_name','$ass_file','$date')");
         //echo $mysqli->error;
            if($insert){
                $alert= '<div class="alert alert-success alert-success-style1 alert-st-bg alert-st-bg11">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                    </button>
                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr admin-check-pro-clr11" aria-hidden="true"></i>
                                <strong>Success!</strong> Assignment file <i style="color:#ff0000;">'.  $new_name. 
          '</i> has been submitted.
                            </div>';
                echo "<meta http-equiv='refresh' content='0'>";   
            }else{
                $alert= "<font color='#FF0000' size='+1'><b>Failed</b></font>";    
            }

        } else{
            $alert= "There was an error uploading the file, please try again!";
        }
      }
                    
    /*} */   
?>

<div class="container-fluid"> 
<div class="row">
	<div class="col-lg-5">
	   <div class="col-lg-12 panel-body">
	       <div class="exam-info ">
	       <b style="color:#c26206;"><?php echo $ass_key;?></b><hr>
	       <h4><?php echo $assignment['ass_title'];?> </h4>
		    <?php echo $course['course_title'];?> - <?php echo $assignment['ass_session'];?> <br>
		    
		    Course Code: <?php echo $course['course_code'];?>, <?php echo $course['lvl_sem'];?>  <br> 
		    Credit Hours: <?php echo $course['credit'];?>  <b>Marks: <?php echo $assignment['marks'];?></b> <br>
		    <br>
		    <b>Deadline: <span style="color:#ff0000;"><?php echo date('M d, Y', strtotime($assignment['deadline'])); ?></span>  </b> <br>
		   </div>
	       
	       
	       
	   	
	   </div>
      <?php 
        if ($_SESSION['category']=='Student') { 
           if ($query_a->num_rows!=0) {
      	?>
	   <div class="col-lg-12 panel-body" style="margin-top:10px;">


	        <center><b>Submission Info: <span style="color:#d4782c;"><?php echo $ass['ass_file']; ?>  </span></b></center> <hr>
            <p><i class="fa fa-calendar"> </i> <?php echo $sub_date; ?>&nbsp;&nbsp; 
            <i class="fa fa-clock-o" aria-hidden="true"> </i> <?php echo $sub_time; ?>&nbsp;&nbsp;
            <?php if ($ass['preview']==1) {
            	echo '<b style="float:right;">Marks: '.$ass['remarks'].'</p></b>Comment: <i style="color:#029809!important;">'.$ass['comment'].'</i>';
            
            }
            else echo '<b style="float:right;color:#ff0000;">Not Reviewed!</b></p>'; ?> 
	   </div>
	  <?php 
           }
	    } 
	  ?>
	</div>
	<div class="col-lg-7">
		<div class="col-lg-12 panel-body">

		 <?php

        if ($_SESSION['category']=='Student') {
        	

		 
	     
         
          if (isset($alert)) {
             echo $alert ;
           }
                       
	     
	   
	    /*---------if not uploaded-------------*/
	    if ($query_a->num_rows==0) {
		 ?>
		    <center><b style="color:#c26206;">Submit Assignment</b></center><hr>
		    <form action="" class="add-professors" id="teacher" method="post" enctype="multipart/form-data">

	           
				<div class="form-group">
				    <label>Assignment:</label>
			 
			        <input id="bookfile" class="form-control" name="bookfile" type="file" accept="application/pdf" required/>
			        <p style="color:#ff0000;text-align:right;">*<i>pdf file only</i></p>

			        
			    </div>
		        <input type="submit" name="submit" class="btn btn-primary " value="Submit" >
		    </form>
		   
		  <?php 
		}
		/*---------if  uploaded-------------*/
		else{
        ?>
            <center><b >My Assignment: <span style="color:#d4782c;"><?php echo $ass['ass_file']; ?></b></center><hr>
            


           
            <div class="pdf-single-pro">
                    
				     <a class="media" href="upload/assignment/<?php echo $ass['file'] ?>"></a>
                </div>
            



		<?php 
		    } 

        }
		?>



		<!-- /if teacher/ -->

		<?php 
	        if ($_SESSION['category']=='Teacher') { ?>
	        <center><b style="color:#c26206;">Submitted Assignment</b></center>
	        <div  class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg panel-body">
	          <ul class="nav nav-tabs custon-set-tab">
	              <li class="active"><a data-toggle="tab" href="#Notes">New</a>
	              </li>
	              <li><a data-toggle="tab" href="#Settings">Previewed</a>
	              </li>
	              
	          </ul>
	          <div class="tab-content custom-bdr-nt" style="min-height: 350px;padding: 20px 0;">
	              <div id="Notes" class="tab-pane fade in active">
	                  <div class="notes-area-wrap">
	                  <ul class="exam-list">
	                    <?php  $query_a = $mysqli->query("select * from ass_submission where ass_key='$ass_key' and preview=0");
						      //echo '<ul>';
					          while($ass= $query_a->fetch_array()){
					          	$sub_time=date('h:i A', strtotime($ass['sub_time']));
				                $sub_date=date('M d, Y', strtotime($ass['sub_time']));
					    ?>
				            <li>
				             <div class="col-lg-2">
				              <b> <?php echo $ass['submitted_by']; ?> </b>
				             </div>
				             <div class="col-lg-7"> 
				               <i style="font-size:11px;">
				               <i class="fa fa-calendar"> </i> <?php echo $sub_date; ?>&nbsp;&nbsp; 
				               <i class="fa fa-clock-o" aria-hidden="true"> </i> <?php echo $sub_time; ?> </i>
				             </div>
				              <div class="col-lg-3" style="text-align:right;">
				               <button data-toggle="tooltip" title="Preview Assignment" class="pd-setting-ed"><a  href="preview_assignment.php?id=<?php echo $ass['id']; ?>&&Key=<?php echo $ass['ass_file']; ?>">Preview</a></button>  
                              </div>
				            </li>


						<?php  } ?>
	                  	
	                  </ul>
	                  </div>
	              </div>
	          
	          <div id="Settings" class="tab-pane fade in ">
	                  <div class="notes-area-wrap">
	                  <ul class="exam-list">
	                    <?php  $query_a = $mysqli->query("select * from ass_submission where ass_key='$ass_key' and preview=1");
						      //echo '<ul>';
					          while($ass= $query_a->fetch_array()){
					    ?><li>
				            <div class="col-lg-2">
				               <b><?php echo $ass['submitted_by']; ?></b>
				            </div><div class="col-lg-7"> Remarks: <?php echo $ass['remarks']; ?><br>
				               <i style="font-size:11px;"><?php echo $ass['comment']; ?></i>
				            </div>
				            <div class="col-lg-3" style="text-align:right;">
				               <button data-toggle="tooltip" title="View Assignment" class="pd-setting-ed"><a  href="preview_assignment.php?id=<?php echo $ass['id']; ?>&&Key=<?php echo $ass['ass_file']; ?>">View</a></button>  
                            </div>

                          </li>
						<?php }  ?>
	                  	
	                  </ul>
	                  </div>
	           </div>

		
	        </div>
	       </div>  
		   <?php } ?>
		  
			
		 
			
		</div>
	</div>
</div>

</div>



<?php require_once('include/footer.php'); ?>
<script>
                
    CKEDITOR.replace( 'conetnt' );
    CKEDITOR.add; 
</script>
<script>
    
 $('#bookfile').on( 'change', function() {
   myfile= $( this ).val();
   var extt = myfile.split('.').pop();
   if(extt=="pdf"){
       //alert('You can upload pdf files only!!');
   } else{
       document.getElementById('bookfile').value='';
       alert('You can upload only pdf file!');

   }
});

</script>