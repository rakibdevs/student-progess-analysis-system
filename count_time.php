<?php  
require_once('connect.php');
$timeout= $_POST['time'];
$examid= $_POST['examid'];

date_default_timezone_set("Asia/Dhaka");
$timenow = date('Y-m-d H:i:s');

if (strtotime($timenow)>=strtotime($timeout)) {
	$update = $mysqli->query("update  exam set status='Completed' where exam_id=$examid");
	echo 'Completed';
}

?>