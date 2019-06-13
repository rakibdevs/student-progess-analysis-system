<?php  
require_once('connect.php');
$examkey= $_POST['examkey'];


$query_ck = $mysqli->query("select * from exam_result where exam_key='$examkey'");
if (($query_ck->num_rows)>0) {
	echo 'Active Examinies<hr><ol>';
while($chkstdnt = $query_ck->fetch_array()){
  	echo '<li>'.$chkstdnt['student_id'].'</li>';

}
echo '</ol>';
	
}
else{
	echo "<hr>No student joined yet!";
}


 ?>