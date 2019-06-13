<?php
	$mysqli = new MySQLi("localhost", "root", "", "ece_lab");
	$mysqli->set_charset('utf8');
	
	if($mysqli->connect_error)
	{
		echo $mysqli->connect_errno;	
	}
?>