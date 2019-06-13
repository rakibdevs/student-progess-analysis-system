<?php
   $page="Teachers"; 
   require_once('include/header.php');
   require_once('connect.php');
   
 ?>


<div class="container-fluid five-hundred">
    <div class="row five-houndred">
    <?php 
      $query = $mysqli->query("select * from teacher");
	  while($rows = $query->fetch_array()){
    ?>
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30 ">
                <div class="panel-body custom-panel-jw">
                    <a href="teacher.php?id=<?php echo $rows['id']; ?>&&name=<?php echo $rows['full_name']; ?>"><img  class="m-b" style="width:100%;" src="upload/professor/<?php echo $rows['id']; ?>.jpg" onerror="this.src='upload/professor/man.jpg'">
                    <h3><?php echo $rows['full_name']; ?></h3>
                    <p class="all-pro-ad"><?php echo $rows['designation']; ?></p>
                    <p ><?php echo $rows['department']; ?></p></a>
                    <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>
                    <a href="teacher.php?id=<?php echo $rows['id']; ?>&&name=<?php echo $rows['full_name']; ?>">View Profile </a>
                    
                </div>

                
            </div>
        </div>
        
    <?php  } ?>
    </div>
</div>
<?php require_once('include/footer.php'); ?>