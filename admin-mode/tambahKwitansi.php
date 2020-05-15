<?php 
	session_start();
    include 'koneksi.php';
    $jn=$_SESSION['jn'];

	$nokwi=$_GET['noKwitansi'];
	$jenis=$_GET['jenis'];
    $jumlah=$_GET['jumlah'];
    $nominal=$_GET['nominal'];
    if(!empty($_SESSION['login'])){
        $idpet=$_SESSION['login'];
	    $query= mysqli_query($koneksi, "INSERT INTO keuangan VALUE('$nokwi','$jenis','$jumlah','$nominal','$idpet')");
	    header("Location: $jn");
    } else {
        header("Location: endsession.php");
    }
    
?>
 