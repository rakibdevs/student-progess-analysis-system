<style type="text/css">
	.metric{width: 48%;}
</style>
<?php 
$numteacher = $mysqli->query("select * from course_teacher where teacher_id=$teacher_id and active=1 ");
$numteacher = $numteacher->num_rows;

$numexam = $mysqli->query("select * from exam where teacher_id=$teacher_id ");
$numexam = $numexam->num_rows;


$numpost = $mysqli->query("select * from course_content where up_by=$teacher_id ");
$numpost = $numpost->num_rows;



$numass = $mysqli->query("select * from assignment where teacher_id=$teacher_id ");
$numass = $numass->num_rows;

$query = $mysqli->query("select * from teacher where id=$teacher_id");
$rows = $query->fetch_array();

?>
<div class="panel-body row">
	<div class="profile-info-inner col-lg-6">
	    <div class="row">
	       <div style="width:35%;float:left;" >
	       	 <img src="upload/professor/man.jpg" alt="" style="width:100%;"/>
	       </div>
	        
	        <div style="width:65%;float:right;padding-top:20%;padding-left:10px;">
	        	<b><?php echo $rows['full_name'] ?></b> <br>
	                    <?php echo $rows['designation'] ?><br>
	                     
	        </div>
	                    
	    </div>
	    <div class="profile-details-hr">
	        <div class="row">
	                <?php echo $rows['department'] ?> <br>
	                    <b>Email:</b> <?php echo $rows['email'] ?><br>
	                    <b>Phone:</b> <?php echo $rows['phone'] ?><br>
	        </div>
	        
	    </div>
	</div>



 

<div class="col-lg-6">
	<div class="metric " style="background: #ea6d12;">
		<p>
		<span class="number">
		<?php  echo $numteacher;?>
		 </span>
		 <span class="title">Courses</span>
		</p>
	</div>

	<div class="metric" style="background:#044b04;">
		<p>
			<span class="number">
				<?php echo $numexam; ?>
					</span>
			<span class="title">Exams</span>
		</p>
	</div>

	<div class="metric" style="background: #ff0900;">
		<p>
			<span class="number">
				<?php echo $numpost; ?>
			</span>
			<span class="title">Posts</span>
		</p>
	</div>

	<div class="metric" style="background: #161e59;">
		<p>
			<span class="number">
				<?php echo $numass; ?>
			</span>
			<span class="title">Assignments</span>
		</p>
	</div>

</div>
</div>
<div><br></div>



