
<?php
$page="Add Books"; 
require_once('include/header.php');
if($_SESSION['category'] != 'Teacher'){
    header("Location:404.php");   
}
   
   //require_once('connect.php');

 

 ?>
<?php //echo $teacher_id; ?>

<div class="container-fluid">
 <div class="col-lg-3"></div>
 <div class=" col-lg-6 panel-body">

 <h4>Add Books</h4>
<?php
    if(isset($_POST['save'])){
       /*if(!empty($_FILES['bookfile']) )
       {*/
        $filename=basename( $_FILES['bookfile']['name']);
        $path = "upload/books/";
        $path = $path . basename( $_FILES['bookfile']['name']);
        if(move_uploaded_file($_FILES['bookfile']['tmp_name'], $path)) {
         $userEmail=$_SESSION['username'];
         
         /*$query=$mysqli->query("select id from teacher where email='$userEmail'");
         $teacher = $query->fetch_array();
         $teacher_id=$teacher['id'];
         echo $teacher_id;*/
         $insert = $mysqli->query("insert into books (book_name,edition,writer,filename,course_id,teacher_id) values('$_POST[book_name]', '$_POST[last_edition]','$_POST[writer]','$filename','$_POST[course_id]','$teacher_id')");
         //echo $mysqli->error;
            if($insert){
                echo '<div class="alert alert-success alert-success-style1 alert-st-bg alert-st-bg11">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                    </button>
                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr admin-check-pro-clr11" aria-hidden="true"></i>
                                <strong>Success!</strong> Course details succesfully added and the file <i style="color:#ff0000;">'.  basename( $_FILES['bookfile']['name']). 
          '</i> has been uploaded.
                            </div>';
                /*header('Refresh: 5; url:library.php');    */
            }else{
                echo "<font color='#FF0000' size='+1'><b>Failed</b></font>";    
            }

        } else{
            echo "There was an error uploading the file, please try again!";
        }
      }
                    
    /*} */   
?>










 <form action="" class="add-professors" id="teacher" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input name="book_name" type="text" class="form-control" placeholder="Book Name" required>
    </div>
    <div class="form-group">
        <input name="last_edition" type="text" class="form-control" placeholder="Edition or Year">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="writer" placeholder="Writer" required>
    </div>
    <div class="form-group">
        <p style="color:#ff0000;">*<i>pdf file only</i></p>
        <input id="bookfile" class="form-control" name="bookfile" type="file" accept="application/pdf" required/>

        
    </div>
 
   <div class="form-group">
    
        <select name="course_id" type="text" class="form-control" required>
            <option value="0" selected="">---Select Course---</option>
            <?php
              //$useremail=$_SESSION['username']; 
              $query = $mysqli->query("select id,course_title from course");
              while($rows = $query->fetch_array()){
            ?>
            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['course_title']; ?></option>
             <?php  } ?>
        </select>
    </div>  
    
    <input class="login-button" type="submit" name="save" value="Save">
  </form>
  </div>




</div>


<?php require_once('include/footer.php'); ?>

<script>
    
 $('#bookfile').on( 'change', function() {
   myfile= $( this ).val();
   var ext = myfile.split('.').pop();
   if(ext=="pdf"){
       //alert(ext);
   } else{
       document.getElementById('bookfile').value='';
       //alert('You can upload only pdf files!');

   }
});

</script>
<?php

?>