<?php 
	session_start();
	include 'koneksi.php';
    $jn=$_SESSION['jn'];
    
    $info=$_GET['textinfo'];
    if(!empty($_SESSION['login'])){
        $idpet=$_SESSION['login'];
        $query= mysqli_query($koneksi, "INSERT INTO infopetugas VALUE('','$info','$idpet','1')");
        header("Location: $jn");
    } else {
        header("Location: endsession.php");
    }
?>
 