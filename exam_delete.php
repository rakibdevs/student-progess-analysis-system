<?php 
require_once('connect.php');
  
  $mysqli->query("delete from exam where exam_id = '$_GET[id]'");
  header("Location:exams.php");

?> 