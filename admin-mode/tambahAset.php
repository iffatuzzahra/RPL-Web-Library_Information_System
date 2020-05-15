<?php 
	session_start();
	include 'koneksi.php';
	$jn=$_SESSION['jn'];

	$jenis=$_GET['jenis'];
    $jumlah=$_GET['jumlah'];
	$nokwi=$_GET['noKwitansi'];
	
	if (!empty($_GET['status'])) {
		$ket=$_GET['status'];
		$id=$_GET['id'];
		$query=mysqli_query($koneksi,"UPDATE aset SET Keterangan='$ket' WHERE IdAset='$id'");
	} else {
		$query= mysqli_query($koneksi, "INSERT INTO aset VALUE('','$jenis','$jumlah','Digunakan','$nokwi')");
	}
	header("Location: $jn");
?>
 