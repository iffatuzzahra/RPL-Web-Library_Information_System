<?php 
	session_start();
	include 'koneksi.php';
	$jn=$_SESSION['jn'];
	$kodeinfo=$_GET['id'];
    
	$query= mysqli_query($koneksi, "UPDATE infopetugas SET KodeTampil='0' WHERE KodeInfo='$kodeinfo'");
	header("Location: $jn");
?>
 