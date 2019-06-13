<?php
   $page='Preview Asssignment';
   if (isset($_GET['Key'])) {
       $page=$_GET['Key'];
   }
   
  require_once('include/header.php');
  require_once('connect.php');
  $assfile_id=$_GET['id']; 
  $query = $mysqli->query("select * from ass_submission where id=$assfile_id");
  $rows = $query->fetch_array();
  $preview=$rows['preview'];
  $ass_key=$rows['ass_key'];

  $query2 = $mysqli->query("select * from assignment where ass_key='$ass_key'");
  $rows2 = $query2->fetch_array();
  $ass_teacher=$rows2['teacher_id'];

  /*check teacher*/
  if ($_SESSION['category']!='Teacher' || $teacher_id!=$ass_teacher) {
     header("Location:404.php");
  }



  if(isset($_POST['submit'])){
    $remarks=$_POST['remarks'];
    $comment=$_POST['comment'];
     $insert = $mysqli->query("update ass_submission set preview=1,remarks=$remarks,comment='$comment' where id=$assfile_id ");
     //echo $mysqli->error;
     if($insert){
                $alert= '<div class="alert alert-success alert-success-style1 alert-st-bg alert-st-bg11">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                    </button>
                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr admin-check-pro-clr11" aria-hidden="true"></i>
                                <strong>Successfully Previewed!!!! </div>';
                  
            }else{
                $alert= "<center><font color='#FF0000' size='+1'><b>Preview Failed!!!!!!</b></font></center>";    
            }
  }
   

 ?>


<div class="container-fluid"> 
<div class="pdf-viewer-area mg-b-15 ">
    <div class="row">
            <div class="col-lg-4 ">
              <div class="panel-body">
              <h4> <?php echo $rows['ass_file']; ?></h4>
              <?php if (isset($alert)) { echo $alert ;} ?>


              <form action="" class="add-professors" id="teacher" method="post" >
                  <div class="form-group">
                      <label>Remarks:</label>
                      <input type="number" class="form-control" name="remarks" max="<?php echo $rows2['marks']; ?>" min="0" placeholder="Marks" value="<?php if(isset($_POST['submit'])){ echo $_POST['remarks'];} else echo $rows['remarks']; ?>" required>
                      <i >Assignment Marks: <span style="color:#ff0000;"><?php echo $rows2['marks']; ?></span></i>
                  </div>
                  <div class="form-group res-mg-t-15">
                      <label for="content">Comment:</label>
                      <textarea id="content"  class="ckeditor" name="comment" placeholder="Content" value=""><?php if(isset($_POST['submit'])){ echo $_POST['comment'];} else echo $rows['comment']; ?></textarea>
                  </div>
                  <input type="submit" name="submit" class="btn btn-primary " value="<?php if ($preview==0) { echo 'Submit';}else echo 'Update'; ?>" >
              </form>




              </div>
            </div>
            
            <div class="col-lg-8 " >
              <div class="panel-body">
                
              
                <div class="pdf-single-pro">
                    
				              <a class="media" href="upload/assignment/<?php echo $rows['file'] ?>"></a>
                </div>
              </div>
            </div>
        </div>
    
</div>


</div>

 <script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.replace( 'content' );
CKEDITOR.add;
</script>

<?php require_once('include/footer.php'); ?>