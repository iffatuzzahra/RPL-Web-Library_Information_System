<?php 

	session_start();
	$jn=$_SESSION['jn'];
	session_destroy();

	header("location: $jn");
 ?>