<?php include('../connect.php'); ?>


<?php
if(isset($_GET['q'])){
	
	$q = intval($_GET['q']);
	$query = $mysqli->query("select * from course where id=$q");
	
	//$array = array();
	
	while($rows = $query->fetch_array()){
	    echo "<p>".$rows['course_title']."</p>";
	    echo "<p> Course Code: ".$rows['course_code']."</p>";
	    echo "<p>Credit: ".$rows['credit']."</p>";
	    echo "<p>Course for: ".$rows['lvl_sem']."</p>";

	 }
	//$array = array('Jahid Hasan', 'Tauhid-ul-sadik');
	
	//echo json_encode($array);
	//echo $_POST['query'];
}
?>