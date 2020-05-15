<?php 
	session_start();
	include 'koneksi.php';
	$jn=$_SESSION['jn'];
	$judul=$_GET['judul'];
    $pengarang=$_GET['pengarang'];
    $penerbit=$_GET['penerbit'];
    $tahun=$_GET['tahun'];
    $nokwi=$_GET['noKwitansi'];
    if (!empty($_GET['status'])) {
        $status=$_GET['status'];
        $id=$_GET['id'];
        $query=mysqli_query($koneksi,"UPDATE `buku` SET `Status`='$status' WHERE `IdBuku`='$id'");
    } else {
        $query= mysqli_query($koneksi, "INSERT INTO buku VALUE('','$judul','$pengarang','$penerbit','$tahun','Dikembalikan','$nokwi')");
    }
    
    
	header("Location: $jn");
?>
 