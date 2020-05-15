<?php 
	session_start();
    include 'koneksi.php';
    $jn=$_SESSION['jn'];
	
	$id=$_GET['id'];
    $nama=$_GET['nama'];
    $sql=mysqli_query($koneksi,"SELECT * FROM anggota WHERE IdAnggota='$id'");
    $data=mysqli_fetch_object($sql);
    if (!empty($_GET['alamat'])) {$alamat=$_GET['alamat'];} else {$alamat=$data->AlamatAnggota;}
    if (!empty($_GET['pekerjaan'])) {$pekerjaan=$_GET['pekerjaan'];} else {$pekerjaan=$data->Pekerjaan;}
    if (!empty($_GET['instansi'])) {$instansi=$_GET['instansi'];} else {$instansi=$data->Instansi;}
    if (!empty($_GET['hp'])) {$hpWa=$_GET['hp'];} else {$hpWa=$data->NoHpWa;}

    $pin=rand(1001,9999);
    if ($jn=='index.php') {
        $query= mysqli_query($koneksi, "INSERT INTO anggota VALUE('$id','$pin','$nama','$alamat','$pekerjaan','$instansi','$hpWa')");
    } else {
        $query=mysqli_query($koneksi,"UPDATE anggota SET AlamatAnggota='$alamat', Pekerjaan='$pekerjaan', Instansi='$instansi', NoHpWa='$hpWa' WHERE IdAnggota='$id'" );
    }
	
	header("Location: $jn");
?>
 