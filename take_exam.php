<!-- <meta http-equiv='refresh' content='5'> -->
<?php
date_default_timezone_set("Asia/Dhaka");
    $page="Add Exam";
    if (isset($_GET['Key'])) {
        $page=  $_GET['Key'] ;
     }
                        
   require_once('include/header.php');
   require_once('connect.php');
   $exam_key=$_GET['Key'];
   $exam_id=$_GET['id'];
   /*$teacher_id=5;*/
   $query_e = $mysqli->query("select * from exam where exam_id=$exam_id");
	$exam = $query_e->fetch_array();
	$course_id=$exam['course_id'];
	$query_c = $mysqli->query("select * from course where id=$course_id ");
	$course = $query_c->fetch_array();

	$query_q = $mysqli->query("select * from question where exam_key='$exam_key'");
	$tn_qus= $query_q->num_rows;

 ?>
 <?php
	if(isset($_POST['submit'])&&!empty($_POST['question'])){
		$insert = $mysqli->query("insert into question (exam_key,question) values('$exam_key', '$_POST[question]')");
			
	    if($insert){
			$alert='<div class="alert alert-success alert-success-style1 alert-st-bg alert-st-bg11">
                            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                </button>
                            <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr admin-check-pro-clr11" aria-hidden="true"></i>
                            <strong>Success!</strong> Content succesfully Uploaded.
                        </div>';
            echo "<meta http-equiv='refresh' content='0'>"; 	
		}else{
			$alert= "<font color='#FF0000' size='+1'><b>Failed</b></font>";	
		}
			
		
	}/*else if(empty($_POST['question'])){
		$alert= "<p style='color:#FF0000;text-align:center'><b >Question content is empty!!</b></p>";
	}
	else{}*/

    if(isset($_POST['start_exam'])){
    	$random=$exam['random'];
    	if (isset($_POST['random'])) {
    		$random=$_POST['random'];
    	}
    	$exam_date = date('Y-m-d');
    	$exam_time=  date('H:i:s');
    	
    	$qty_qus=$_POST['qty_qus'];
    	$update=$mysqli->query("update exam set exam_date='$exam_date', exam_time='$exam_time', status='Running',random=$random,qty_qus=$qty_qus where exam_key='$exam_key'");
    	//echo $update->error;
    	if($update){
    		$exam_stat='Exam has been started successfully! Please wait for 2 Seconds to reload!';
    		echo "<meta http-equiv='refresh' content='1'>";
    	}
    }
?>


<div class="container-fluid"> 
<div class="row">
	
	<div class="col-lg-6 five-houndred">
	    <!-- if exam status is pending then Settings option is displayed. -->
	    <?php if ($exam['status']=='Pending') { ?>
	     <div class="col-lg-12 panel-body ">

	      <form action="" class="add-professors" id="settings" method="post">
	            <div class="col-lg-12"><?php if (isset($exam_stat)) { echo $exam_stat ;} ?></div>
	            <div class="col-lg-5">
                    <div class="form-group">
                    <label>Question Qty:</label>
	                    <input style="height:35px;" type="number" class="form-control" name="qty_qus" min="0" max="<?php echo $tn_qus; ?>" placeholder="Number of Set Question: <?php echo $exam['qty_qus']; ?> " value="<?php echo $exam['qty_qus']; ?>">
	                    <i style="color:red;font-size:12px;">Out of  <?php echo $tn_qus; ?> Questions! </i>
	                </div>

	                
                </div>
	            
                <div class="col-lg-4 ">
                    <div class="form-group  i-checks pull-left" style="">
                        
                            <label>Exam Type: <?php //echo $exam['random'];?></label>
                            <label> <input id="exam_type1" name="random" type="radio" value="0"> <i></i> Classic  </label>
							<label>	<input id="exam_type2" name="random" type="radio" value="1"> <i></i> Random  </label>
                    </div>
                </div>
                <div class="col-lg-3"><input name="start_exam" type="submit" class="btn" style="background:transparent;border:1px solid green;color:green;" value="Start Exam"></div>
                
            </form>
         </div>
         <div class="row col-lg-12"><br></div>
        <?php } ?>
        <!-- question settings window disabled -->

        
        

	     
		<div class="col-lg-12 panel-body ">
		   <div class="exam-info">
		   Course Title: <?php echo $course['course_title'];?> <br>
		    <b><?php echo $exam['exam_title'];?>- <?php echo $exam['exam_session'];?> </b><br>
		    <?php echo $course['lvl_sem'];?>, <b>Course Code:</b> <?php echo $course['course_code'];?> &nbsp; <b>Credit Hours: </b><?php echo $course['credit'];?> <br>
		    
		    <b>Time:</b> <?php echo $exam['duration'];?> Hours      <b> Marks: </b> <?php echo $exam['marks'];?> <br><br>
		   </div>
		   
			<ul class="exam-list">
			<?php 
			
				while($qus = $query_q->fetch_array()){
					echo '<li>'.$qus['question'].'</li>';
				}
		    ?>
			</ul>
			
		</div>
	</div>

	<div class="col-lg-6">
	   <div class="col-lg-12 panel-body five-houndred">
	   <!-- if exam status is pending then add question option is displayed. -->
	    <?php if ($exam['status']=='Pending' and $exam['exam_type']=='Written') { ?>
	    	
	    
	       <h4>Add Questions</h4>
	       
	       <div class="row">
	         
            </div> 
	        <form action="" class="add-professors" id="question" method="post">
	            <?php if (isset($alert)) {echo $alert ;}?>
				<div class="form-group res-mg-t-15">
		            <label for="content">Question:</label>
		            <textarea id="content"  class="ckeditor" name="question" placeholder="Content" required></textarea>
		        </div>
		        <input type="submit" name="submit" class="btn btn-primary waves-effect waves-light" value="Add Question" >
		    </form>
		<?php } ?>
		<!-- end pending -->

        <!-- If exam is running -->
		<?php if ($exam['status']=='Running') { ?>
		<div class="row">		    
		    <div class="col-lg-6 " style="color:#ff0000;">
		    	<i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro admin-check-pro-none" aria-hidden="true"></i>
                <strong>Danger!</strong> Don't close the browser!
		    </div>
		    <?php 
	               $duration=$exam['duration'];
	               $ex=explode(":", $duration);
	               $hour= $ex[0];
	               $min= $ex[1];
	               $exam_date=$exam['exam_date'];
	               $start_time=$exam['exam_time'];
	               $end_time=date('H:i:s',strtotime('+'.$hour.' hour +'.$min.' minutes +2 seconds',strtotime($start_time)));
	              
	               $showEndtime= date('H:i:s',strtotime($end_time));
	               

	            ?>



	            <?php //echo $exam_date.'T'.$showEndtime.'+0600'?>
		    <div class="col-lg-6  exam-settings ">
		        <i class="fa fa-clock-o"></i> <span class="time-left"></span>
		        <input style="background: #fff;color:#0d6f00;border:1px solid #0d6f00;padding:3px;border-radius:4px;" type="submit"  title="Finish Exam"  value="Finish">
                <input style="background: #fff;color:#ff0000;border:1px solid #ff0000;padding:3px;border-radius:4px;" type="submit"  title="Cancel Exam"  value="Cancel">
		   
		    
		    	
		    </div>


		</div>

                
            

		    
		    <div class="row ">

              <div id="joined-student" class="col-lg-12 "></div>
            </div>
           



		    

 
		    
		  
		    
		    
		    
		<?php } ?>
		<!-- end running -->

		<!-- If exam is Completed -->
		<?php if ($exam['status']=='Completed') { ?>
		 <!-- after complete exam -->
          <?php if (isset($_GET['exam_status'])==1) {
          	echo '<h4 style="color:green;">Exam has been Successfully Completed!</h4>';

          }
		  echo 'Participated Examinies: <hr>';
		  
          ?>
          <?php  
			$query_ck = $mysqli->query("select * from exam_result where exam_key='$exam_key'");



			if (($query_ck->num_rows)>0) {
				echo '<ul class="exam-list exam-marks">';
				$in=0;
				?>
				<li><div class="col-lg-4">Student Id</div><div class="col-lg-8">Marks</div></li>
				<?php 
			while($chkstdnt = $query_ck->fetch_array()){
				

					
				?>
			    <li <?php if ($chkstdnt['marks']!='') { echo "style='color:#179e09;'"; } ?> >
			     		<span id="marksid<?php echo $in; ?>"  class="col-lg-4 "><i class="fa fa-check edu-checked-pro " aria-hidden="true"></i> <?php echo $chkstdnt['student_id']; ?> </span>
					<form action="" class="col-lg-8 marks-form" id="<?php echo $in; ?>"  method="post">
					     <input id="stdnt<?php echo $in; ?>" name="id<?php echo $in; ?>" value="<?php echo $chkstdnt['student_id']; ?>" style="display:none;">
			             <input id="marks<?php echo $in; ?>" name="marks<?php echo $in; ?>" type="text" class="input-marks" value="<?php echo $chkstdnt['marks']; ?>"  placeholder="marks">
			             <!-- <input type="submit" name="submitmarks" class="input-marks" value="Save"> -->
			             <button class="marks-update" onclick="updatemarks(<?php echo $in; ?>)"><?php if ($chkstdnt['marks']!='') { echo "Update"; } else echo "Save"; ?></button>
					</form>
				</li>
			    <?php
			    $in++;
				
			}
			echo '</ul>';

			}
			else{
				echo "<hr>No Record!";
			}
			 ?>
            
		  <!-- default page of exam -->

		<?php } ?>
		<!-- end Completed -->
	   	
	   </div>


		
	</div>
</div>

</div>


<?php require_once('include/footer.php'); ?>

<script type="text/javascript">

 var check= <?php echo $exam['random'];?>;
 if (check==1) {
    $('#exam_type2').parent().addClass('checked');
 }
 else
 {$('#exam_type1').parent().addClass('checked');}

</script>



<?php if ($exam['status']=='Running') { ?>
<script type="text/javascript">

  $(".time-left")
  .countdown("<?php echo $exam_date.' '.$showEndtime; ?>", function(event) {
    $(this).text(
      event.strftime('%H:%M:%S')
    );
  });



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $(function poll(){
        setTimeout(function(){
            $.ajax({
                url:'count_time.php',
                type: "POST", 
                data : {time:'<?php echo $exam_date.' '.$showEndtime; ?>',examid:<?php echo $exam_id; ?>,},
                success: function(response){   
                	if (response=='Completed') {
                		window.location = 'take_exam.php?id=<?php echo $exam_id; ?>&&Key=<?php echo $exam_key; ?>&&exam_status=1';
                		//$('body').load('take_exam.php?id=<?php echo $exam_id; ?>&&Key=<?php echo $exam_key; ?>');
                		//$("<meta http-equiv='refresh' content='1'>").appendTo("head");
                		//setTimeout(function(){ location.reload(true); }, 5000);
                    }
                	
                },
        complete: poll
            });
        },1000);
   
});


   
$(function checkjoin(){
        setTimeout(function(){
            $.ajax({
                url:'check_joined.php',
                type: "POST", 
                data : {examkey:'<?php echo $exam_key; ?>',},
                success: function(joined){   
                $("#joined-student").html(joined);
                	
                },
        complete: checkjoin
            });
        },1000);
   
});

</script>
<?php } ?>


<script>
    
</script>
<script type="text/javascript"> 
//var auto_refresh = setInterval( function() { $('#loadtweets').load('count_time.php').fadeIn("slow"); }, 1000); 
</script>
<script>
                
    CKEDITOR.replace( 'conetnt' );
    CKEDITOR.add; 
</script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
  function updatemarks(i){

        var m='#marks'+i;
        var d='#stdnt'+i;
        var stdnt=$(d).val();
        var marks=$(m).val();
        var totalmarks= <?php echo $exam['marks'];?>;
        //alert(marks);
           $.ajax({
                url:'update_marks.php',
                type: "POST", 
                data : {marks,stdnt,exam_key: '<?php echo $exam_key; ?>',totalmarks,},
                success: function(response){   
                	     alert(response);
                	     $('.icon').css({color: "green"});           	
                },
                complete: updatemarks
            });
  }
  
</script>
  
