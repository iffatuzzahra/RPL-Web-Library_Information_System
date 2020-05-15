<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TBM-Prestasi</title>

    <link rel="stylesheet" type="text/css" href="admin-mode/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="file:///C:/xampp/htdocs/TBM/admin-mode/bootstrap/js/bootstrap.min.js"></script>
    
</head>
<body>
<?php
session_start();
include 'koneksi.php';
$_SESSION['memjn']='index.php';
if (!empty($_GET['sess'])) {
    $sess=$_GET['sess'];
    $_SESSION['memHome']=$sess;
}
$_SESSION['memInfo']=$_GET['memInfo'];
if ($_GET['memInfo']=="logout") { header("location: endsession.php"); }

?>    
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="padding-left:50px;">TBM-Prestasi</a>
        
        <button class="navbar-toggler navbar-toggler-right dropdown-toggle" type="button" id="navbardrop" data-toggle="collapse" data-target="#navnav" aria-controls="navnav" aria-expanded="false" >
        </button>
        <div id="navnav" class="collapse navbar-collapse " >
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link " style="color:white" href="index.php?sess=dash">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:white" href="index.php?sess=about">Tentang Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"style="color:white"  href="index.php?sess=faq">FAQ</a>
            </li>
            <li class="nav-item">
               <div class="">
                    <form action="anggota.php" class="form-inline">
                        <button class="btn nav-link" style="color:white">Lihat Infomasi Anggota</button>
                        <select id="memInfo" name="memInfo" class="btn nav-link bg-dark" style="color:white; ">
                            <option value=""  >ChooseInfo</option>
                            <option value="data">Data Anggota</option>
                            <option value="peminjaman">Peminjaman</option>
                            <option value="question">My Question</option>
                            <option value="logout">Log Out</option>
                        </select>
                    </form>
                </div>
            </li>
            </ul>
        </div> 
        
      </div>
  </nav>
<main>
<div class="" style="margin:20px">
    <table class="table"> 
        <thead>
            <th class=""><center></center></th>
            <th class="bg-success"><center>Informasi Petugas</center></th>
        </thead>
        <tr >
    <?php 
    if (($_SESSION['memInfo']=="data")||($_GET['memInfo'])=="") { 
        $mainsql=mysqli_query($koneksi,"SELECT * FROM anggota WHERE IdAnggota='$_SESSION[memLogin]' ");
        while ($maindata=mysqli_fetch_object($mainsql)) {
    ?>
    <!--Data Anggota-->
        <td >
            <center><div class="card bg-dark text-light col mb-4" style="width:600px">
                <div class="card-body " style="" >
                    <table class="table table-dark">
                        <h4 class="card-title">Data Anggota</h4>
                        <tr>
                            <td>Id Anggota</td>
                            <td><p class="card-text"> : <?=$maindata->IdAnggota?></p></td>
                        </tr>
                        <tr>
                            <td>PIN</td>
                            <td><p class="card-text "> : <?=$maindata->PIN?></p></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><p class="card-text "> : <?=$maindata->NamaAnggota?></p></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><p class="card-text "> : <?=$maindata->AlamatAnggota?></p></p></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td><p class="card-text "> : <?=$maindata->Pekerjaan?></p></td>
                        </tr>
                        <tr>
                            <td>Instansi</td>
                            <td><p class="card-text "> : <?=$maindata->Instansi?></p></td>
                        </tr>
                        <tr>
                            <td>No HP/WA</td>
                            <td><p class="card-text "> : <?=$maindata->NoHpWa?></p></td>
                        </tr>
                    </table>
                </div>
            </div></center>
        </td> 
    <?php }
    }
    else if($_SESSION['memInfo']=="peminjaman") {
        $sql=mysqli_query($koneksi,"SELECT * FROM peminjaman JOIN buku ON buku.IdBuku=peminjaman.IdBuku WHERE IdAnggota='$_SESSION[memLogin]' ");
    ?> 
        <td ><div class="container">
            <table class="table">
            <thead class="bg-info">
                <th>Judul Buku</th>
                <th>Waktu Peminjaman</th>
                <th>Waktu Pengembalian</th>
                <th>Denda Peminjaman</th>
            </thead>
            <?php while ($data=mysqli_fetch_object($sql)) { ?>
                <tr>
                    <td><?=$data->JudulBuku?></td>
                    <td><?=$data->TanggalPinjam?></td>
                    <?php if (($data->TanggalKembali)!='0000-00-00') { ?>
                        <td><?=$data->TanggalKembali?></td>
                        <td><?=$data->Denda?></td>
                    <?php } else { 
                        ?> <td colspan="2" class="table-danger">Belum Dikembalikan!<br>Segera Kembalikan  <?php
                            $tanggal=date($data->TanggalPinjam);
                            $dplus=strtotime("+ 7 days");
                            $kembali=date('Y-m-d',strtotime('+ 6 days',strtotime($tanggal)));        
                            $nowdate=date('Y-m-d');
                            if ($kembali<$nowdate) {
                                $late=(abs((strtotime($kembali)/86400 )))-(abs((strtotime($nowdate)/86400 )));
                                ?> ! Pengembalian Sudah 
                                <b><i>Terlambat <?=$late?> Hari</i></b>
                                <?php
                            } else {
                                ?> Sebelum
                                <b><i><?=$kembali?></i></b>
                                <?php
                            }
                        ?>
                        
                        </td>
                        
                    <?php }?>
                </tr>
            <?php } ?>
            </table>
        </div></td>
    <?php
    }
    else if($_SESSION['memInfo']=="question") {
    ?> <td>
        <div class="container">
            <table class="table table-striped">
            <?php
            $sql=mysqli_query($koneksi,"SELECT * FROM  question WHERE IdAnggota='$_SESSION[memLogin]' ");
            while($data=mysqli_fetch_object($sql)) {
                ?>
                <tr>
                    <td><?=$data->IsiQ?></td>
                </tr>
                <tr>
                    <?php $kode=$data->KodeQ;
                        $sql2=mysqli_query($koneksi,"SELECT * FROM  answer WHERE KodeQ='$kode' ");
                        $jlh=mysqli_num_rows($sql2);
                        if ($jlh>0) {
                            while($data2=mysqli_fetch_object($sql2)) {
                                ?>
                                <tr><td>---> <?=$data2->IsiA?></td></tr>  
                            <?php } 
                        }?> 
                         
                    </form>
                </tr>
            <?php }
            ?>  <tr><form class="form-group" method="get" action="addquestion.php">
                    <td><textarea class ="form-control" name="question" cols="30" rows="2" placeholder="Tambahkan Pertanyaan"></textarea></td>
                    </tr><tr><td><button class="btn btn-danger my-sm-0" style="float:right" type="submit">Tanyakan</button></td>
                </tr>
            </table>
        </div>
        </td>
    <?php
    }
    ?>
        <!--informasi petugas-->
            <td style="width:300px" class="table-warning">
                <?php 
                    $sql=mysqli_query($koneksi,"SELECT * FROM infopetugas JOIN petugas ON infopetugas.IdPetugas=petugas.IdPetugas WHERE KodeTampil='1'");
                    while($data=mysqli_fetch_object($sql)) {
                ?>
                <div class="card col mb-4">
                    <div class="card-body ">
                        <p><?=$data->IsiInfo?></p>
                        <p style="float:right">Admin : <?=$data->NamaPetugas?></p>
                    </div> 
                </div> <?php } ?>
            </td>
        </tr>
    </table>
</div>
</main>
<footer>
</footer>
<?php

?>
</body>
</html>