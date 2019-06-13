<?php 
require_once('connect.php');
  
  $mysqli->query("delete from course_content where content_id = '$_GET[id]'");
  header("Location:library.php");

?> 