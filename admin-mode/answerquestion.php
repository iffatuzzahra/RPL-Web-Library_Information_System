<?php 
	session_start();
	include 'koneksi.php';
	$jn=$_SESSION['jn'];
    $kode=$_GET['kode'];

    if (empty($_SESSION['login'])) {
        header("Location: endsession.php");
    } elseif (!empty($_GET['kodetampil'])) {
       $kodetampil=$_GET['kodetampil'];
       if ($kodetampil=='1') {
        $sql=mysqli_query($koneksi,"UPDATE question SET KodeTampil='2' WHERE KodeQ='$kode'");
       } elseif ($kodetampil=='2') {
        $sql=mysqli_query($koneksi,"UPDATE question SET KodeTampil='1' WHERE KodeQ='$kode'");
       }
        header("Location: $jn");
    }
    else {
        $petugas=$_SESSION['login'];
        if (isset($_GET['textansw'])) {
            $textans=$_GET['textansw'];
            $text='A : '.$textans;
            //echo $text.$kode.$petugas;
            //$sql=mysqli_query($koneksi,"UPDATE question SET KodeTampil='1' WHERE KodeQ='$kode'");
            $sql2=mysqli_query($koneksi,"INSERT INTO answer VALUE('','$text','$petugas','$kode')");
        }
        $sql=mysqli_query($koneksi,"UPDATE question SET KodeTampil='1' WHERE KodeQ='$kode'");
        header("Location: $jn");
    }
    
?>
 