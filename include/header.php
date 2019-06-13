<?php 
ob_start();
session_start();
require_once('connect.php');
date_default_timezone_set("Asia/Dhaka");
$userCat=$_SESSION['category'];
if(!isset($_SESSION['userId'])){
    header("Location:index.php");
    
}
if ($userCat=='Teacher') { 
 $userEmail=$_SESSION['username'];        
 $query_t=$mysqli->query("select id from teacher where email='$userEmail'");
 $teacher = $query_t->fetch_array();
 $teacher_id=$teacher['id'];
}

if ($userCat=='Chairman') {        
 $query_t=$mysqli->query("select teacher_id from chairman where id=1");
 $teacher = $query_t->fetch_array();
 $ch_id=$teacher['teacher_id'];
}

if ($userCat=='Student') {
    $userStudent= $_SESSION['username'];
    $query_t=$mysqli->query("select * from student where student_id=$userStudent");
    $student = $query_t->fetch_array();
    $sLvl_sem=$student['lvl_sem'];
    $sExam_session=$student['exam_session'];

}

?>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title> <?php echo $page; ?> | Class Assistant</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- favicon
	============================================ -->
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<!-- Google Fonts
	============================================ -->
<!-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet"> -->
<!-- Bootstrap CSS
	============================================ -->
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
<!-- modernizr JS
	============================================ -->
<script src="js/vendor/modernizr-2.8.3.min.js"></script>
<!-- jquery
  ============================================ -->
<script src="js/vendor/jquery-1.12.4.min.js"></script>


<script src="js/MathJax.js?config=MML_HTMLorMML"></script>
<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>

<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Start Left menu area -->
<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="index.php"><img src="img/logo/logosn.png" alt="" /><!-- <h3>Lab Assistant</h3> --></a>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                   <li >
                        <a  href="index.php">
                               <span class="educate-icon educate-home icon-wrap"></span>
                               <span class="mini-click-non">Dashboard</span>
                            </a>
                    </li>  
                   

                   <!-- sidebar menu for Chairman start -->
                   <?php 
                   if ($userCat=='Chairman') {
                   ?>
                   <li class="active">
                        <a class="has-arrow" href="teachers.php" aria-expanded="false"><span class="educate-icon educate-professor icon-wrap"></span> <span class="mini-click-non">Teacher</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="All Professors" href="teachers.php"><span class="mini-sub-pro">All Teacher</span></a></li>
                            <li><a title="Add Professor" href="teacher_add.php"><span class="mini-sub-pro">Add Teacher</span></a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a class="has-arrow" href="students.php" aria-expanded="false"><span class="educate-icon educate-student icon-wrap"></span> <span class="mini-click-non">Student</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="All Professors" href="students.php"><span class="mini-sub-pro">All Student</span></a></li>
                            <li><a title="Add Professor" href="student_add.php"><span class="mini-sub-pro">Add Student</span></a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow" href="courses.php" aria-expanded="false"><span class="educate-icon educate-course icon-wrap"></span> <span class="mini-click-non">Courses</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="All Courses" href="courses.php"><span class="mini-sub-pro">All Course</span></a></li>
                            <li><a title="Add Courses" href="course_add.php"><span class="mini-sub-pro">Add Course</span></a></li> 
                            <li><a title="Edit Courses" href="teacher_assign.php"><span class="mini-sub-pro">Assign Teacher</span></a></li>
                            <li><a title="Courses Profile" href="course_teacher.php"><span class="mini-sub-pro">Course Teacher</span></a></li>
                            <!--<li><a title="Product Payment" href="course-payment.html"><span class="mini-sub-pro">Courses Payment</span></a></li> -->
                        </ul>
                    </li>
                    <li >
                        <a  href="library.php">
                               <span class="educate-icon educate-library icon-wrap"></span>
                               <span class="mini-click-non">Library</span>
                            </a>
                    </li>


                   <?php } ?>
                   <!-- sidebar menu for Chairman End -->



                   <!-- sidebar menu for Teacher start -->
                   <?php 
                   if ($userCat=='Teacher') {
                   ?>
                   <li >
                        <a  href="teachers.php">
                               <span class="educate-icon educate-professor icon-wrap"></span>
                               <span class="mini-click-non">Teacher</span>
                            </a>
                    </li> 
                    <li>
                        <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="educate-icon educate-course icon-wrap"></span> <span class="mini-click-non">Courses</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="All Courses" href="courses.php"><span class="mini-sub-pro">All Course</span></a></li>
                            <li><a title="Courses Profile" href="course_teacher.php"><span class="mini-sub-pro">Course Teacher</span></a></li>
                            <!--<li><a title="Product Payment" href="course-payment.html"><span class="mini-sub-pro">Courses Payment</span></a></li> -->
                        </ul>
                    </li>


                   <li>
                        <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="educate-icon educate-library icon-wrap"></span> <span class="mini-click-non">Library</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="All Library" href="library.php"><span class="mini-sub-pro">Library Assets</span></a></li>
                            <li><a title="Add Library" href="add_books.php"><span class="mini-sub-pro">Add Book</span></a></li>
                            <li><a title="Add Content" href="add_content.php"><span class="mini-sub-pro">Add Content</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="educate-icon educate-data-table icon-wrap"></span> <span class="mini-click-non">Assignment</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="Departments List" href="create_assignment.php"><span class="mini-sub-pro">Create Assignment</span></a></li>
                            <li><a title="Add Departments" href="assignments.php"><span class="mini-sub-pro">All Assignment</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="educate-icon educate-department icon-wrap"></span> <span class="mini-click-non">Exam</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="Departments List" href="create_exam.php"><span class="mini-sub-pro">Create Exam</span></a></li>
                            <li><a title="Add Departments" href="exams.php"><span class="mini-sub-pro">All Exam</span></a></li>
                        </ul>
                    </li>


                   <?php } ?>
                   <!-- sidebar menu for Teacher End -->


                   <!-- sidebar menu for student start -->
                   <?php 
                   if ($userCat=='Student') {
                   ?>
                   <li >
                        <a  href="teachers.php">
                               <span class="educate-icon educate-professor icon-wrap"></span>
                               <span class="mini-click-non">Teachers</span>
                            </a>
                    </li>
                    <li >
                        <a  href="courses.php">
                               <span class="educate-icon educate-course icon-wrap"></span>
                               <span class="mini-click-non">Courses</span>
                            </a>
                    </li>
                    <li >
                        <a  href="library.php">
                               <span class="educate-icon educate-library icon-wrap"></span>
                               <span class="mini-click-non">Library</span>
                            </a>
                    </li>
                    <li >
                        <a  href="assignments.php">
                               <span class="educate-icon educate-data-table icon-wrap"></span>
                               <span class="mini-click-non">Assignment</span>
                            </a>
                    </li>
                    <li >
                        <a  href="exams.php">
                               <span class="educate-icon educate-department icon-wrap"></span>
                               <span class="mini-click-non">Exam</span>
                            </a>
                    </li>


                   <?php } ?>
                   <!-- sidebar menu for student End -->



                    
                    
                  
                    
                    
                    
                    
                   
                </ul>
            </nav>
        </div>
    </nav>
</div>
<!-- End Left menu area -->
<!-- Start Welcome area -->
<div class="all-content-wrapper">
    
    
    <div class="header-advance-area">
        <!-- include top header -->
        <?php include('header_top.php'); ?>


        <div class="breadcome-area" style="padding-top:60px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <ul class="breadcome-menu">
                                <li><i class="fa fa-home"> </i> <a href="#">Home</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod"><?php echo $page;?></span>
                                </li>
                            </ul>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
    </div>