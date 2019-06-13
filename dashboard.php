<?php

   $page="Dashboard"; 
   require_once('include/header.php');
   require_once('connect.php');

 ?>


<div class="container-fluid five-houndred"> 
  <div class="col-lg-6">
    <?php 
    if ($userCat=='Teacher'){ 
      include('dashboard/teacherinfo.php');
      include('dashboard/running_exam.php');
      include('dashboard/recent_exam.php'); 
    } 
    if ($userCat=='Chairman'){include('dashboard/student_count.php');  }

    if ($userCat=='Student'){ 
      include('dashboard/running_exam.php');
      include('dashboard/sub_ass.php');

      include('dashboard/recent_exam.php'); 
      include('dashboard/stdnt_course.php');
      
      
    }
 

    ?>

  </div>
  <div class="col-lg-6 ">
     <div class="col-lg-12">
      <?php if ($userCat=='Chairman'){ include('dashboard/deptinfo.php'); } 
      if ($userCat=='Teacher'){ 
          include('dashboard/analysis.php');
          include('dashboard/teachergraph.php'); 

        }
      if ($userCat=='Student'){  
      include('dashboard/stdnt_graph.php');
      }
      ?>
     </div>
  </div>
 


</div>



<?php require_once('include/footer.php'); ?>
<?php

?>