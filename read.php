<?php
   $page='Read Book';
   if (isset($_GET['title'])) {
       $page=$_GET['title'];
   }
   
   require_once('include/header.php');
   require_once('connect.php');
   

 ?>


<div class="container-fluid"> 
<div class="pdf-viewer-area mg-b-15 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1">
            </div>
            <?php

            $book_id=$_GET['book_id']; 
		    $query = $mysqli->query("select * from books where id=$book_id");
			$rows = $query->fetch_array();
            $teacher_id=$rows['teacher_id'];
			$query = $mysqli->query("select * from teacher where id=$teacher_id");
			$teacher = $query->fetch_array();

		    ?>
            <div class="col-lg-10 panel-body" >
                <h4>
                      <?php 
                       echo $rows['book_name'];
                       if ($rows['edition']!='') {
                         echo '- <i>'.$rows['edition'].'</i>'; 
                       }
                       ?>
                </h4>
                <p style="text-align:center;"> <b>Writer: </b></span> <?php echo $rows['writer'] ?> <b>Uploaded by:</b><a href="teacher.php?id=<?php echo $teacher['id'] ?>"> <?php echo $teacher['full_name'] ?></p>
                <div class="pdf-single-pro">
                    
				     <a class="media" href="upload/books/<?php echo $rows['filename'] ?>"></a>
                </div>
            </div>
        </div>
    </div>
</div>


</div>



<?php require_once('include/footer.php'); ?>
