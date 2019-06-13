<?php 
require_once('connect.php');
  
  $mysqli->query("delete from assignment where ass_id = '$_GET[id]'");
  header("Location:exams.php");

?> 