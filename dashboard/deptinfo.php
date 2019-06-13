<style type="text/css">
	.metric{width:100%;}
</style>
<?php 
$numcourse = $mysqli->query("select * from course");
$numcourse = $numcourse->num_rows;

$numteacher = $mysqli->query("select * from teacher");
$numteacher = $numteacher->num_rows;


$numpost = $mysqli->query("select * from course_content");
$numpost = $numpost->num_rows;


$numbooks = $mysqli->query("select * from books");
$numbooks = $numbooks->num_rows;


$query = $mysqli->query("select * from teacher where id=$ch_id");
$rows = $query->fetch_array();

?>

<div class="panel-body row">


 

<div class="col-lg-5">
   <center><b>Info</b></center>
	<div class="metric " style="background: #ea6d12;">
		<p>
		<span class="number">
		<?php echo $numcourse; ?>
		 </span>
		 <span class="title">Courses</span>
		</p>
	</div>

	<div class="metric" style="background:#044b04;">
		<p>
			<span class="number">
				<?php echo $numteacher; ?>
					</span>
			<span class="title">Teachers</span>
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
				<?php echo $numbooks; ?>
			</span>
			<span class="title">Books</span>
		</p>
	</div>

</div>
<div class="col-lg-7">
	    <center><b>Chairman</b></center>
        <div class="profile-img">
            <img src="upload/professor/man.jpg" alt="" />
        </div>
        <div class="profile-details-hr">
            <div class="row">
                <div class="col-lg-12">
                    <div class="address-hr">
                        <b><?php echo $rows['full_name'] ?></b>
                    </div>
                    <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                        <?php echo $rows['designation'] ?>
                    </div>
                    <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                        <?php echo $rows['department'] ?>
                    </div>
                    <div class="address-hr">
                        <b>Email:</b> <?php echo $rows['email'] ?>
                    </div>
                    <div class="address-hr">
                        <b>Phone:</b> <?php echo $rows['phone'] ?>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</div>