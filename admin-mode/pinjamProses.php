<?php 
	session_start();
	include 'koneksi.php';
	$idbuku=$_GET['idbuku'];
	$idanggota=$_GET['idAnggota'];
	$pinjam=date("Y-m-d");
	$sql=mysqli_query($koneksi,"SELECT * FROM buku WHERE IdBuku='$idbuku'");
	$data=mysqli_fetch_object($sql);
	if (($data->Status)=='Dikembalikan') {
		$query2=mysqli_query($koneksi, "UPDATE `buku` SET `Status`='Dipinjam' WHERE `IdBuku`='$idbuku'");
		$query= mysqli_query($koneksi, "INSERT INTO peminjaman VALUE ('','$idbuku','$pinjam','','','$idanggota')");
	} else { $message="Periksa Kembali ID buku!"; }
	
	header("Location: index.php?mess=$message");
?>
 