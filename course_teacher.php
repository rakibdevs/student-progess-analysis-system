<?php
   $page="Course Teacher"; 
   require_once('include/header.php');
   require_once('connect.php');

 ?>


<div class="container-fluid"> 
    <div class="sparkline13-list">
        <div class="sparkline13-hd">
            <div class="main-sparkline13-hd panel-body">
                <h4>Course Teacher </h4>
            </div>
        </div>
        <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright">
               <!--  <div id="toolbar">
                    <select class="form-control dt-tb">
						<option value="">Export Basic</option>
						<option value="all">Export All</option>
						<option value="selected">Export Selected</option>
					</select>
					data-toolbar="#toolbar"
					data-show-export="true"
                </div> -->
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                    data-cookie-id-table="saveId" data-click-to-select="true" >
                    <thead>
                        <tr>
                            <th data-field="name" >Course Code</th>
                            <th data-field="email" >Course Title</th>
                            <th data-field="phone" >Teacher</th>
                            <th data-field="date" >Assigned Date</th>
                            <!-- <th>Setting</th> -->
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
					      $query = $mysqli->query("select * from course_teacher");
						  while($rows = $query->fetch_array()){
                            $course_id=$rows['course_id'];
                            $teacher_id=$rows['teacher_id'];

                            $query1 = $mysqli->query("select * from course where id=$course_id");
                            $course = $query1->fetch_array();
                            $query2 = $mysqli->query("select * from teacher where id=$teacher_id");
                            $teacher = $query2->fetch_array();
					    ?>
                        <tr>
                            <td><?php echo $course['course_code']; ?></td>
                            <td><a style="color:#006DF0;" href="course_details.php?id=<?php echo $rows['course_id']; ?>&&title=<?php echo $course['course_title']; ?>"><?php echo $course['course_title']; ?></a></td>
                            <td><a href="teacher.php?id=<?php echo $teacher['id']; ?>&&name=<?php echo $teacher['full_name']; ?>"><?php echo $teacher['full_name']; ?></a></td>
                            <td><?php echo date('M d, Y', strtotime($rows['date_time'])); ?></td>
                            <!-- <td>
	                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
	                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php //echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
	                        </td> -->
                            
                        </tr>
                        
                        <?php  } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


 <!-- data table JS
		============================================ -->
    
<?php require_once('include/footer.php'); ?>



