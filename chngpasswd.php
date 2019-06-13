
<?php


$page="Change Password"; 
require_once('include/header.php');

    if(isset($_POST['passwd'])){
        $oldpass=$_POST['oldpass'];
        $newpass=$_POST['newpass'];
        $re=$_POST['retypepass'];
        $check = $mysqli->query("select * from user where username = '$userEmail' and password='$oldpass'");
        if($check->num_rows == 1){
            if($newpass==$re){
               $insert = $mysqli->query("update user set password='$newpass' where username = '$userEmail'");
               $alert= '<div class="alert alert-success alert-success-style1 alert-st-bg alert-st-bg11">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                        <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                    </button>
                                <i class="fa fa-check edu-checked-pro admin-check-pro admin-check-pro-clr admin-check-pro-clr11" aria-hidden="true"></i>
                                <strong>Success!</strong> Course details succesfully added.
                            </div>';
            }
            else{
                $alert="<font color='#FF0000' size='+1'><b>Password not matched!</b></font>"; 
            }
        }
        else{
            $alert="<font color='#FF0000' size='+1'><b>Given old password is wrong!</b></font>"; 
                
            
        }   
        //echo $mysqli->error;
        
    }
?>





<div id="PasswordChange" >
        <div class="modal-dialog" style="width:400px;">
            <div class="modal-content">
                <div class="modal-body" >
                    
   
      
                <form action="" class="add-professors" id="msg" method="post">
                    <div class="col-lg-12">
                     <?php if(isset($alert)){echo $alert;} ?>
                        <div class="form-group">
                            <label>Old Password</label> 
                            <input type="password" name="oldpass" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="newpass" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Retype Password</label>
                            <input type="password" name="retypepass" class="form-control">
                        </div>
                    </div>
                                                     
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="payment-adress">
                                <!-- <a class="btn btn-primary waves-effect waves-light" data-dismiss="modal" href="#">Cancel</a> -->
                                <input type="submit" name="passwd" class="btn btn-primary waves-effect waves-light" value="Change Password" >
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php require_once('include/footer.php'); ?>