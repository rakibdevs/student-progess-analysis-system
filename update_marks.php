<?php
require_once('connect.php');
$exam_key= $_POST['exam_key'];
$totalmarks=$_POST['totalmarks'];
$marks=$_POST['marks'];
if ($marks>=$totalmarks*0.4) {
	$eStatus='Passed';
}else
 $eStatus='Failed';

$id=$_POST['stdnt'];
$updatemarks=$mysqli->query("update exam_result set marks='$marks', exam_status='$eStatus' where student_id=$id and exam_key='$exam_key'");
?>