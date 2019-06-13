<?php  
$query_ck = $mysqli->query("select * from exam_result where exam_key='$exam_key'");



if (($query_ck->num_rows)>0) {
	echo '<ul class="exam-list exam-marks">';
	$in=0;
	?>
	<li><div class="col-lg-4">Student Id</div><div class="col-lg-8">Marks</div></li>
	<?php 
while($chkstdnt = $query_ck->fetch_array()){
	if ($chkstdnt['exam_status']=='Joined') {

		
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
}
echo '</ul>';
/*if(isset($_POST['submitmarks'])){
	    $marks=$_POST['marks'];
    	$id=$_POST['id'];
    	$updatemarks=$mysqli->query("update exam_result set marks='$marks' where student_id=$id and exam_key='$exam_key'");
    	//echo $updatemarks->error;
    	if($updatemarks){
    		echo "<meta http-equiv='refresh' content='1'>";
    	}
    }
	*/
}
else{
	echo "<hr>No Record!";
}


 ?>

