<style type="text/css">
  #limheight {
    height: 300px; /*your fixed height*/
    -webkit-column-count: 3;
       -moz-column-count: 3;
            column-count: 3; /*3 in those rules is just placeholder -- can be anything*/
}

#limheight li {
    display: inline-block; /*necessary*/
}
</style>

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
              <ul id="limheight" class="exam-list">
                <?php 
                  $query = $mysqli->query("select * from student where lvl_sem='L-1 S-I' and status='Running' order by student_id asc");
                  while($rows = $query->fetch_array()){
                     echo '<li><b style="color:#1a1a1a;">'.$rows['student_id'].'</b><button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="float:right;"><a href="student_delete.php?id='.$rows['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button></li>';

                 } ?>


                      
                </ul>
              </div>
          </div>

          <div id="12" class="tab-pane fade">
              <div class="projects-settings-wrap ">
              <ul id="limheight" class="exam-list">
                <?php 
                  $query = $mysqli->query("select * from student where lvl_sem='L-1 S-II' and status='Running' order by student_id asc");
                  while($rows = $query->fetch_array()){
                     echo '<li><b style="color:#1a1a1a;">'.$rows['student_id'].'</b><button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="float:right;"><a href="student_delete.php?id='.$rows['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button></li>';

                 } ?>


                      
                </ul>
              </div>
          </div>
          <div id="21" class="tab-pane fade">
              <div class="projects-settings-wrap ">
              <ul id="limheight" class="exam-list">
                <?php 
                  $query = $mysqli->query("select * from student where lvl_sem='L-2 S-I' and status='Running' order by student_id asc");
                  while($rows = $query->fetch_array()){
                     echo '<li><b style="color:#1a1a1a;">'.$rows['student_id'].'</b><button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="float:right;"><a href="student_delete.php?id='.$rows['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button></li>';

                 } ?>


                      
                </ul>
              </div>
          </div>
          <div id="22" class="tab-pane fade">
              <div class="projects-settings-wrap ">
              <ul id="limheight" class="exam-list">
                <?php 
                  $query = $mysqli->query("select * from student where lvl_sem='L-2 S-II' and status='Running' order by student_id asc");
                  while($rows = $query->fetch_array()){
                     echo '<li><b style="color:#1a1a1a;">'.$rows['student_id'].'</b><button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="float:right;"><a href="student_delete.php?id='.$rows['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button></li>';

                 } ?>


                      
                </ul>
              </div>
          </div>
          <div id="31" class="tab-pane fade">
              <div class="projects-settings-wrap ">

              <ul id="limheight" class="exam-list">
                <?php 
                  $query = $mysqli->query("select * from student where lvl_sem='L-3 S-I' and status='Running' order by student_id asc");
                  while($rows = $query->fetch_array()){
                     echo '<li><b style="color:#1a1a1a;">'.$rows['student_id'].'</b><button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="float:right;"><a href="student_delete.php?id='.$rows['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button></li>';

                 } ?>


                      
                </ul>
              </div>
          </div>
          <div id="32" class="tab-pane fade">
              <div class="projects-settings-wrap ">
              <ul id="limheight" class="exam-list">
                <?php 
                  $query = $mysqli->query("select * from student where lvl_sem='L-3 S-II' and status='Running' order by student_id asc");
                  while($rows = $query->fetch_array()){
                     echo '<li><b style="color:#1a1a1a;">'.$rows['student_id'].'</b><button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="float:right;"><a href="student_delete.php?id='.$rows['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button></li>';

                 } ?>


                      
                </ul>
              </div>
          </div>
          <div id="41" class="tab-pane fade">
              <div class="projects-settings-wrap ">
              <ul id="limheight" class="exam-list">
                <?php 
                  $query = $mysqli->query("select * from student where lvl_sem='L-4 S-I' and status='Running' order by student_id asc");
                  while($rows = $query->fetch_array()){
                     echo '<li><b style="color:#1a1a1a;">'.$rows['student_id'].'</b><button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="float:right;"><a href="student_delete.php?id='.$rows['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button></li>';

                 } ?>


                      
                </ul>
              </div>
          </div>
          <div id="42" class="tab-pane fade">
              <div class="projects-settings-wrap "> 
                <ul id="limheight" class="exam-list">
                <?php 
                  $query = $mysqli->query("select * from student where lvl_sem='L-4 S-II' and status='Running' order by student_id asc");
                  while($rows = $query->fetch_array()){
                     echo '<li><b style="color:#1a1a1a;">'.$rows['student_id'].'</b><button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="float:right;"><a href="student_delete.php?id='.$rows['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a></button></li>';

                 } ?>


                      
                </ul>
              
              </div>
          </div>




      </div>