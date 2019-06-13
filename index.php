<?php
ob_start();
session_start();
require_once('connect.php');
if(isset($_SESSION['userId'])){
	header("Location:dashboard.php");
}
else{
?>

 <?php
	if (isset($_POST['login'])) {
		
		$category = $_POST['category'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$loginSql = "SELECT * FROM user WHERE "."username = '$username'"."and password = '$password'"."and category = '$category'";
		
		$query = $mysqli->query($loginSql);
		echo $mysqli->error;
		$count = $query->num_rows;
		
		if($count == 1){
				$array = $query->fetch_array();
				$_SESSION['userId'] = $array['id'];
				$_SESSION['category'] = $array['category'];
				$_SESSION['username']=$array['username'];
				header("Location:dashboard.php");
		}else{
			$error='<div class="alert alert-danger alert-mg-b alert-success-style4 alert-st-bg3" style="padding: 8px;">
	        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
					<span class="icon-sc-cl" aria-hidden="true">&times;</span>
				</button>
	        <i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-clr3" aria-hidden="true"></i>
	       <strong>Sorry!</strong> Wrong username or password!
	    </div>';
		}

	}
	?>


<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title> login | Class Assistant</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- favicon
	============================================ -->
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Bootstrap CSS
	============================================ -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- owl.carousel CSS
	============================================ -->
<link rel="stylesheet" href="css/owl.carousel.css">
<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/owl.transitions.css">
<!-- animate CSS
	============================================ -->
<link rel="stylesheet" href="css/animate.css">
<!-- normalize CSS
	============================================ -->
<link rel="stylesheet" href="css/normalize.css">
<!-- meanmenu icon CSS
	============================================ -->
<link rel="stylesheet" href="css/meanmenu.min.css">
<!-- main CSS
	============================================ -->
<link rel="stylesheet" href="css/main.css">
<!-- educate icon CSS
	============================================ -->
<link rel="stylesheet" href="css/educate-custon-icon.css">
<!-- morrisjs CSS
	============================================ -->
<link rel="stylesheet" href="css/morrisjs/morris.css">
<!-- mCustomScrollbar CSS
	============================================ -->
<link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
<!-- metisMenu CSS
	============================================ -->
<link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
<link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
<!-- calendar CSS
	============================================ -->
<link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
<link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
<link rel="stylesheet" href="css/c3/c3.min.css">
<!-- style CSS
	============================================ -->
<link rel="stylesheet" href="style.css">
 <link rel="stylesheet" href="css/modals.css">
<!-- responsive CSS
	============================================ -->
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/data-table/bootstrap-table.css">
<link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
<link rel="stylesheet" href="css/bootstrap-tagsinput.css">

<style type="text/css"> body{padding-top: 150px;}</style>
<div class="login-panel">
    <div class="col-lg-7 login-right" style="padding:0;">
    <!-- <img src="img/demo.jpg" style="width:100%;"> -->
        <div class="login-shadow">
        	<h3 style="color:yellow;font-size: 40px;"><span class="educate-icon educate-student icon-wrap" style="font-size: 33px;"></span>  EIMS</h3>
        	<span style="color:#f1f1f1;">Department of Electronics & Communication Engineering,</span><br>
        	<span>Hajee Mohammad Danesh Science & Technology University.</span> <br>
        	<a href="books.php">Books</a>
        	<a href="courses.php">Courses</a>
        </div>

    </div> 
	<div class="col-lg-5" style="padding:0;">
		<div class="hpanel">
            <div class="panel-body" style="padding: 10px 20px;height: 100%;">
              <!--  <center><b>User Login</b></center> -->
                <form action="" id="loginForm" method="post">
                     <div class="form-group" style="height:40px;"><?php   if(isset($error)){echo $error;}?></div>
                      <div class="form-group">
                        <select name="category" type="text" class="form-control">
                            <option value="none" selected="" disabled="">--Select Category--</option>
                            <option value="Chairman">Chairman</option>
                            <option value="Teacher">Teacher</option> 
                            <option value="Student">Student</option>  
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="username">Email/Username/Student ID</label>
                        <input type="text" placeholder="such as: name@hstu.ac.bd or 1402170" title="Please enter you email" required="" value="" name="username" id="username" class="form-control">
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">Password</label>
                        <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                       
                    </div>
                   
                    
                    <input class="login-button" type="submit" name="login" value="Login">
                </form>
            </div>
            
		</div>
             
    </div>

</div>




<!-- jquery
	============================================ -->
<script src="js/vendor/jquery-1.12.4.min.js"></script>
<!-- bootstrap JS
	============================================ -->
<script src="js/bootstrap.min.js"></script>
<!-- wow JS
	============================================ -->
<script src="js/wow.min.js"></script>
<!-- price-slider JS
	============================================ -->
<script src="js/jquery-price-slider.js"></script>
<!-- meanmenu JS
	============================================ -->
<script src="js/jquery.meanmenu.js"></script>
<!-- owl.carousel JS
	============================================ -->
<script src="js/owl.carousel.min.js"></script>
<!-- sticky JS
	============================================ -->
<script src="js/jquery.sticky.js"></script>
<!-- scrollUp JS
	============================================ -->
<script src="js/jquery.scrollUp.min.js"></script>
<!-- counterup JS
	============================================ -->

<!-- plugins JS
	============================================ -->
<script src="js/plugins.js"></script>
<!-- main JS
	============================================ -->
<script src="js/main.js"></script>
<?php
}
?>