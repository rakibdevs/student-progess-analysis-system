<?php 
  require_once('connect.php');
  $mysqli->query("delete from course where id = '$_GET[id]'");
  header("Location:courses.php");
?> 