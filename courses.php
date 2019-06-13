<style type="text/css">
.course-list li{
width: 23%;
float: left;
margin: 1%;
padding: 1%;
height: 180px;
list-style: none;
background: #f6f8fa;
text-align: center;
box-shadow: 1px 2px 5px 2px #D1D1D1;}
</style>
<?php
   $page="Courses"; 
   require_once('include/header.php');
   require_once('connect.php');

 ?>


<div class="container-fluid">
    <div  class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg panel-body">
      <h4>Courses</h4>
      <ul class="nav nav-tabs custon-set-tab">
          <li class="active"><a data-toggle="tab" href="#11">L-1 S-I</a>
          </li>
          <li><a data-toggle="tab" href="#12">L-1 S-II</a>
          </li>
          <li><a data-toggle="tab" href="#21">L-2 S-I</a>
          </li>
          <li><a data-toggle="tab" href="#22">L-2 S-II</a>
          </li>
          <li><a data-toggle="tab" href="#31">L-3 S-I</a>
          </li>
          <li><a data-toggle="tab" href="#32">L-3 S-II</a>
          </li>
          <li><a data-toggle="tab" href="#41">L-4 S-I</a>
          </li>
          <li><a data-toggle="tab" href="#42">L-4 S-II</a>
          </li>
      </ul>
      <div class="tab-content custom-bdr-nt" style="min-height: 400px;padding: 20px 0;">

          <div id="11" class="tab-pane fade in active">
              <div class="notes-area-wrap">
              <ul class="course-list">
                <?php 
                  $query = $mysqli->query("select * from course where lvl_sem='L-1 S-I'");
                  while($rows = $query->fetch_array()){


                ?>
                   <li>
                      <a style="color:#006DF0;" href="course_details.php?id=<?php echo $rows['id']; ?>&&title=<?php echo $rows['course_title']; ?>"><?php echo $rows['course_title']; ?></a><br> <br>
                      Course Code: <?php echo $rows['course_code']; ?> <br>
                      Credit: <?php echo $rows['credit']; ?><br> <br>
                      <?php if ($userCat=='Chairman') {?>
                      <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a href="course_edit.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                      <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                      <?php } ?>

                        
                   </li>

                <?php } ?>
                </ul>
              </div>
          </div>

          <div id="12" class="tab-pane fade">
              <div class="projects-settings-wrap ">
              <ul class="course-list">
                <?php 
                  $query = $mysqli->query("select * from course where lvl_sem='L-1 S-II'");
                  while($rows = $query->fetch_array()){


                ?>
                   <li>
                      <a style="color:#006DF0;" href="course_details.php?id=<?php echo $rows['id']; ?>&&title=<?php echo $rows['course_title']; ?>"><?php echo $rows['course_title']; ?></a><br> <br>
                      Course Code: <?php echo $rows['course_code']; ?> <br>
                      Credit: <?php echo $rows['credit']; ?><br> <br>
                      <?php if ($userCat=='Chairman') {?>
                      <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a href="course_edit.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                      <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                      <?php } ?>

                        
                   </li>

                <?php } ?>
                </ul>
              </div>
          </div>
          <div id="21" class="tab-pane fade">
              <div class="projects-settings-wrap ">
              <ul class="course-list">
                <?php 
                  $query = $mysqli->query("select * from course where lvl_sem='L-2 S-I'");
                  while($rows = $query->fetch_array()){


                ?>
                   <li>
                      <a style="color:#006DF0;" href="course_details.php?id=<?php echo $rows['id']; ?>&&title=<?php echo $rows['course_title']; ?>"><?php echo $rows['course_title']; ?></a><br> <br>
                      Course Code: <?php echo $rows['course_code']; ?> <br>
                      Credit: <?php echo $rows['credit']; ?><br> <br>
                      <?php if ($userCat=='Chairman') {?>
                      <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a href="course_edit.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                      <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                      <?php } ?>

                        
                   </li>

                <?php } ?>
                </ul>
              </div>
          </div>
          <div id="22" class="tab-pane fade">
              <div class="projects-settings-wrap ">
              <ul class="course-list">
                <?php 
                  $query = $mysqli->query("select * from course where lvl_sem='L-2 S-II'");
                  while($rows = $query->fetch_array()){


                ?>
                   <li>
                      <a style="color:#006DF0;" href="course_details.php?id=<?php echo $rows['id']; ?>&&title=<?php echo $rows['course_title']; ?>"><?php echo $rows['course_title']; ?></a><br> <br>
                      Course Code: <?php echo $rows['course_code']; ?> <br>
                      Credit: <?php echo $rows['credit']; ?><br> <br>
                      <?php if ($userCat=='Chairman') {?>
                      <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a href="course_edit.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                      <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                      <?php } ?>

                        
                   </li>

                <?php } ?>
                </ul>
              </div>
          </div>
          <div id="31" class="tab-pane fade">
              <div class="projects-settings-wrap ">

              <ul class="course-list">
                <?php 
                  $query = $mysqli->query("select * from course where lvl_sem='L-3 S-I'");
                  while($rows = $query->fetch_array()){


                ?>
                   <li>
                      <a style="color:#006DF0;" href="course_details.php?id=<?php echo $rows['id']; ?>&&title=<?php echo $rows['course_title']; ?>"><?php echo $rows['course_title']; ?></a><br> <br>
                      Course Code: <?php echo $rows['course_code']; ?> <br>
                      Credit: <?php echo $rows['credit']; ?><br> <br>
                      <?php if ($userCat=='Chairman') {?>
                      <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a href="course_edit.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                      <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                      <?php } ?>

                        
                   </li>

                <?php } ?>
                </ul>
              </div>
          </div>
          <div id="32" class="tab-pane fade">
              <div class="projects-settings-wrap ">
              <ul class="course-list">
                <?php 
                  $query = $mysqli->query("select * from course where lvl_sem='L-3 S-II'");
                  while($rows = $query->fetch_array()){


                ?>
                   <li>
                      <a style="color:#006DF0;" href="course_details.php?id=<?php echo $rows['id']; ?>&&title=<?php echo $rows['course_title']; ?>"><?php echo $rows['course_title']; ?></a><br> <br>
                      Course Code: <?php echo $rows['course_code']; ?> <br>
                      Credit: <?php echo $rows['credit']; ?><br> <br>
                      <?php if ($userCat=='Chairman') {?>
                      <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a href="course_edit.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                      <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                      <?php } ?>

                        
                   </li>

                <?php } ?>
                </ul>
              </div>
          </div>
          <div id="41" class="tab-pane fade">
              <div class="projects-settings-wrap ">
              <ul class="course-list">
                <?php 
                  $query = $mysqli->query("select * from course where lvl_sem='L-4 S-I'");
                  while($rows = $query->fetch_array()){


                ?>
                   <li>
                      <a style="color:#006DF0;" href="course_details.php?id=<?php echo $rows['id']; ?>&&title=<?php echo $rows['course_title']; ?>"><?php echo $rows['course_title']; ?></a><br> <br>
                      Course Code: <?php echo $rows['course_code']; ?> <br>
                      Credit: <?php echo $rows['credit']; ?><br> <br>
                      <?php if ($userCat=='Chairman') {?>
                      <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a href="course_edit.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                      <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                      <?php } ?>

                        
                   </li>

                <?php } ?>
                </ul>
              </div>
          </div>
          <div id="42" class="tab-pane fade">
              <div class="projects-settings-wrap "> 
                <ul class="course-list">
                <?php 
                  $query = $mysqli->query("select * from course where lvl_sem='L-4 S-II'");
                  while($rows = $query->fetch_array()){


                ?>
                   <li>
                      <a style="color:#006DF0;" href="course_details.php?id=<?php echo $rows['id']; ?>&&title=<?php echo $rows['course_title']; ?>"><?php echo $rows['course_title']; ?></a><br> <br>
                      Course Code: <?php echo $rows['course_code']; ?> <br>
                      Credit: <?php echo $rows['credit']; ?><br> <br>
                      <?php if ($userCat=='Chairman') {?>
                      <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a href="course_edit.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                      <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><a href="course_delete.php?id=<?php echo $rows['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button>
                      <?php } ?>

                        
                   </li>

                <?php } ?>
                </ul>
              
              </div>
          </div>




      </div>
    </div>  









    

</div>


 <!-- data table JS
		============================================ -->
    
<?php require_once('include/footer.php'); ?>



