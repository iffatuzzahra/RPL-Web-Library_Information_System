<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin TBM-Prestasi</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    session_start();
    include 'koneksi.php';
    $_SESSION['jn']='overall.php';
#set session login
if (!empty($_GET['idpet'])) {
    $id=$_GET['idpet'];
    $_SESSION['login']=$id;
}
#Set Session page ova
if (!empty($_GET['sess'])) {
    $sess=$_GET['sess'];
    $_SESSION['ova']=$sess;
}
?> <!--HEADER-->
<header>
    <div style="background-image: url('picture/background/perpus.jpg'); " class="jumbotron jumbotron-fluid">   
    <div id="" class="container">
        <ul class="list-group">
            <li class="list-group-item list-group-item-primary">
                <a class="" href="overall.php?sess=question"><b>Question</b></a>
            </li>
            <li class="list-group-item list-group-item-primary">
                <a class="" href="overall.php?sess=info"><b>Informasi Petugas</b></a>
            </li>
            <li class="list-group-item list-group-item-primary">
                <a class="" href="overall.php?sess=keuangan"><b>Keuangan</b></a>
            </li>
            <li class="list-group-item list-group-item-primary">
                <a class="" href="overall.php?sess=buku"><b>Buku</b></a>
            </li>
            <li class="list-group-item list-group-item-primary">
                <a class="" href="overall.php?sess=aset"><b>Aset</b></a>
            </li>
            <li class="list-group-item list-group-item-primary">
                <a class="" href="overall.php?sess=anggota"><b>Anggota</b></a>
            </li>
            <li class="list-group-item list-group-item-primary">
                <a class="" href="overall.php?sess=peminjaman"><b>Peminjaman</b></a>
            </li>
            <li class="list-group-item list-group-item-primary">
                <a class="" href="index.php?sess=dash"><b>Back to Dashboard</b></a>
            </li>
        </ul>
    </div> 
    </div >
    
</header> 
<main> <?php
#form Login
if (empty($_SESSION['login'])) {
    ?><form action="overall.php" method="get">
        <div class="container" >
        <div class="form-group col-md-6 row">
            <label >Masukkan ID </label>
            <input type="text" class="form-control" name="idpet">
        </div>
        <button type="submit" class="btn btn-primary ">Masuk</button>
        </div> 
    </form>
<?php
} else {
    #Session/page question and answer
    if ($_SESSION['ova']=="question") {
        ?>  
        <div class="container">
        <!--TABLE ALL question and answer-->
        <table class="table">
            <thead>
                <th>Kode</th>
                <th>Pengirim</th>
                <th>Status</th>
                <th>Question And Answer</th>
            </thead>
            <?php $sql=mysqli_query($koneksi,"SELECT * FROM question JOIN anggota ON anggota.IdAnggota=question.IdAnggota");
            while($data=mysqli_fetch_object($sql)) {
            ?>
            <tr>
                <td rowspan="3"><?=$data->KodeQ?></td>
                <td><?=$data->IdAnggota?></td>
                <!--Kolom Kode /kategori pertanyaan-->
                <td rowspan="2">
                    <form action="answerquestion.php" method="get">
                    <input type="hidden" name="kode" value="<?=$data->KodeQ;?>">
                    <?php
                    if (($data->KodeTampil)=='2') { 
                        ?> <input type="hidden" name="kodetampil" value="<?=$data->KodeTampil?>">
                        <button type="submit" class="btn btn-warning">Kategori FAQ</button><?php
                    } elseif (($data->KodeTampil)=='1') {
                        ?> <input type="hidden" name="kodetampil" value="<?=$data->KodeTampil?>">
                        <button type="submit" class="btn btn-success">Telah Dibaca</button><?php
                    } else {
                        ?> <input type="hidden" name="kodetampil" value="<?=$data->KodeTampil?>">
                        <button type="submit" class="btn btn-danger">Belum Dibaca</button><?php
                    }
                    ?> </form>
                </td>
                <td><?=$data->IsiQ?></td>
            </tr>
            <tr>
                <td><?=$data->NamaAnggota?></td>
                <?php
                $kode=$data->KodeQ;
                $sql2=mysqli_query($koneksi,"SELECT * FROM answer WHERE KodeQ='$kode'");
                $jlh=mysqli_num_rows($sql2);
                if ($jlh>0) { $data2=mysqli_fetch_object($sql2);
                ?>
                    <td><?=$data2->IsiA?> ( Dibalas Oleh Petugas : <?=$data2->IdPetugas?> )</td>
                <?php
                } else {
                    ?><td></td><?php
                }
                ?>
            </tr>
            <tr><div><form method="get" action="answerquestion.php">
                <input type="hidden" name="kode" value="<?=$data->KodeQ;?>">
                <td colspan="3">
                    <table class="table"> <tr>
                        <td><textarea class ="form-control" name="textansw" cols="40" rows="1"></textarea></td>
                        <td><button class="btn btn-primary my-sm-0" type="submit">Balas</button></td>
                    </tr></table>
                </td>
                </form></div>
            </tr>
        <?php } ?>
        </table>
        </div>
    <?php
    } 
    #SESSION/Page info petugas && TABLE ALL InfoPetugas
    elseif ($_SESSION['ova']=="info") {
    ?>  
        <div class="container">
            <div style="float: left; margin-bottom:20px">
                <a href="index.php?sess=dash"><button class="btn btn-success">Tambah</button></a>
            </div>
            <table class="table">
            <?php $sql=mysqli_query($koneksi,"SELECT * FROM infopetugas");
            while($data=mysqli_fetch_object($sql)) {
            ?>
                <tr>
                    <td><?=$data->IdPetugas?></td>
                    <td><?=$data->IsiInfo?></td>
                    <td> 
                        <?php if (($data->KodeTampil)=='1') {?>
                            <a href="deleteInfoPetugas.php?id=<?=$data->KodeInfo;?>"><button class="btn btn-success my-sm-0" type="submit">Ditampilkan</button></a>
                        <?php } else { ?>
                            <button class="btn btn-danger">Diarsipkan</button>
                        <?php }
                        ?>
                    
                    </td>
                </tr>
            <?php } ?>
            </table>
        </div>
    <?php
    } 
    #Session/page Keuangan/kwitansi
    elseif ($_SESSION['ova']=="keuangan") {
        #Button Back Page
        if (!empty($_GET['backpage'])) {
            $back=$_GET['backpage']; ?>
            <a href="<?=$back?>"><button  style="margin-left:40px; float:left" class="btn btn-primary">Back</button></a>
        <?php }
    ?>
    <!--Button Tambah Kwitansi-->
    <div class="container">
        <div style="float: left">
            <a href="index.php?sess=keuangan"><button class="btn btn-success">Tambah</button></a>
        </div>
        <div style="float : right; padding-bottom:20px">
            <form class="form-inline ml-4" method="get" action="overall.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Jenis Transaksi" aria-label="Search" name="carikwitansi">
                <input type="hidden" name="backpage" value="overall.php">
                <button class="btn btn-success my-sm-0" type="submit">Cari</button>
            </form>
        </div>
        <?php
        #Table cari Kwitansi
        if (!empty($_GET['carikwitansi'])) {?>
            <div>
            <table class="table">
            <thead>
                    <th>No Kwitansi</th>
                    <th>Jenis Transaksi</th>
                    <th>Jumlah</th>
                    <th>Nominal</th>
                    <th>Petugas</th>
                </thead>
            <?php $jenis=$_GET['carikwitansi'];
            $sql=mysqli_query($koneksi,"SELECT * FROM keuangan WHERE JenisTransaksi LIKE '%$jenis%'");
            while($data=mysqli_fetch_object($sql)) {
            ?>
                <tr>
                    <td><?=$data->NoKwitansi?></td>
                    <td><?=$data->JenisTransaksi?></td>
                    <td><?=$data->Jumlah?></td>
                    <td><?=$data->Nominal?></td>
                    <td><?=$data->IdPetugas?></td>
                    <td>
                        <?php $nokwi=$data->NoKwitansi;
                        $query=mysqli_query($koneksi,"SELECT * FROM buku WHERE NoKwitansi='$nokwi'");
                        $row=mysqli_fetch_array($query);
                        if ($row<>0) {
                            ?>
                            <form class="form-inline ml-4" method="get" action="overall.php">
                                <input type="hidden" name="caribuku" value="<?=$data->NoKwitansi?>">
                                <input type="hidden" name="backsess" value="keuangan">
                                <input type="hidden" name="sess" value="buku">
                                <input type="hidden" name="backpage" value="overall.php">
                                <button class="btn btn-danger my-sm-0" type="submit">Lihat</button>
                            </form>
                            <?php
                        }
                        $query=mysqli_query($koneksi,"SELECT * FROM aset WHERE NoKwitansi='$nokwi'");
                        $row=mysqli_fetch_array($query);
                        if ($row<>0) {
                            ?>
                            <form class="form-inline ml-4" method="get" action="overall.php">
                                <input type="hidden" name="cariaset" value="<?=$data->NoKwitansi?>">
                                <input type="hidden" name="backsess" value="keuangan">
                                <input type="hidden" name="sess" value="aset">
                                <input type="hidden" name="backpage" value="overall.php">
                                <button class="btn btn-danger my-sm-0" type="submit">Lihat</button>
                            </form>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </table>
        </div>
        <?php } else { 
        ?>
        <div> <!--TABLE ALL Keuangan/Kwitansi-->
            <table class="table">
                <thead>
                    <th>No Kwitansi</th>
                    <th>Jenis Transaksi</th>
                    <th>Jumlah</th>
                    <th>Nominal</th>
                    <th>Petugas</th>
                </thead>
                <?php $sql=mysqli_query($koneksi,"SELECT * FROM keuangan");
                while($data=mysqli_fetch_object($sql)) {
                ?>
                <tr>
                    <td><?=$data->NoKwitansi?></td>
                    <td><?=$data->JenisTransaksi?></td>
                    <td><?=$data->Jumlah?></td>
                    <td><?=$data->Nominal?></td>
                    <td><?=$data->IdPetugas?></td>
                    <!--Kolom Detail Kwitansi-->
                    <td>
                        <?php $nokwi=$data->NoKwitansi;
                        $query=mysqli_query($koneksi,"SELECT * FROM buku WHERE NoKwitansi='$nokwi'");
                        $row=mysqli_fetch_array($query);
                        if ($row<>0) {
                            ?>
                            <form class="form-inline ml-4" method="get" action="overall.php">
                                <input type="hidden" name="caribuku" value="<?=$data->NoKwitansi?>">
                                <input type="hidden" name="backsess" value="keuangan">
                                <input type="hidden" name="sess" value="buku">
                                <input type="hidden" name="backpage" value="overall.php">
                                <button class="btn btn-danger my-sm-0" type="submit">Lihat</button>
                            </form>
                            <?php
                        }
                        $query=mysqli_query($koneksi,"SELECT * FROM aset WHERE NoKwitansi='$nokwi'");
                        $row=mysqli_fetch_array($query);
                        if ($row<>0) {
                            ?>
                            <form class="form-inline ml-4" method="get" action="overall.php">
                                <input type="hidden" name="cariaset" value="<?=$data->NoKwitansi?>">
                                <input type="hidden" name="backsess" value="keuangan">
                                <input type="hidden" name="sess" value="aset">
                                <input type="hidden" name="backpage" value="overall.php">
                                <button class="btn btn-danger my-sm-0" type="submit">Lihat</button>
                            </form>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <?php } ?>
    </div>
    <?php
    } 
    #Session/page Buku
    elseif ($_SESSION['ova']=="buku") {
        #Button Back Page
        if (!empty($_GET['backpage'])) {
            $back=$_GET['backpage']; 
            if (!empty($_GET['backsess'])) {$_SESSION['ova']=$_GET['backsess'];}
            ?>
            <a href="<?=$back?>"><button  style="margin-left:40px; float:left" class="btn btn-primary">Back</button></a>
        <?php }
    ?> <!--Button Tambah Buku-->
    <div class="container">
        <div style="float: left">
            <a href="index.php?sess=buku"><button class="btn btn-success">Tambah</button></a>
        </div>
        <div style="float : right; padding-bottom:20px">
            <form class="form-inline ml-4" method="get" action="overall.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Judul atau No Buku" aria-label="Search" name="caribuku">
                <input type="hidden" name="backpage" value="overall.php">
                <button class="btn btn-success my-sm-0" type="submit">Cari</button>
            </form>
        </div>
        <?php
        if (!empty($_GET['caribuku'])) {?>
            <div> <!--Table Cari Buku-->
            <table class="table">
                <thead>
                    <th>No Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Status</th>
                    <th>KlikToChange</th>
                    <th>No Kwitansi</th>
                </thead>
                <?php $cari=$_GET['caribuku'];
                if ($_SESSION['ova']=='keuangan') { $sql=mysqli_query($koneksi,"SELECT * FROM buku WHERE NoKwitansi='$cari'");} 
                else { $sql=mysqli_query($koneksi,"SELECT * FROM buku WHERE JudulBuku LIKE '%$cari%' OR IdBuku='$cari'");}
                while($data=mysqli_fetch_object($sql)) {
                ?>
                <tr>
                    <td><?=$data->IdBuku?></td>
                    <td><?=$data->JudulBuku?></td>
                    <td><?=$data->Pengarang?></td>
                    <td><?=$data->Penerbit?></td>
                    <td><?=$data->TahunTerbit?></td>
                    <td>   
                        <?php if(($data->Status)=='Dipinjam') { ?>
                            <form method="get" action="index.php">
                                <input type="hidden" name="kembali" value="<?=$data->KodePeminjaman;?>">
                                <button style="margin-left:12px" class="btn btn-warning my-sm-0" type="kembali">Dipinjam</button>
                            </form>
                            <td></td>
                        <?php } else { ?> <!--Edit Status Buku-->
                        <form action="tambahbuku.php">
                            <input type="hidden" name="id" value="<?=$data->IdBuku?>">
                            <select id="status" name="status" class="btn">
                                <option value=""><?=$data->Status?></option>
                                <option value="Dikembalikan">Dikembalikan</option>
                                <option value="Diarsipkan">Diarsipkan</option>
                                <option value="Hilang">Hilang</option>
                                <option value="Dibuang">Dibuang</option>
                                <option value="Disumbangkan">Disumbangkan</option>
                            </select>
                            <td><button class="btn btn-success">ChoseToChange</button></td>
                        </form> <?php } ?>
                    </td>
                    <td><?=$data->NoKwitansi?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <?php } else { 
        ?>
        <div> <!--TABLE ALL Buku-->
            <table class="table">
                <thead>
                    <th>No Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Status </th>
                    <th>KlikToChange</th>
                    <th>No Kwitansi</th>
                </thead>
                <?php $sql=mysqli_query($koneksi,"SELECT * FROM buku");
                while($data=mysqli_fetch_object($sql)) {
                ?>
                <tr>
                    <td><?=$data->IdBuku?></td>
                    <td><?=$data->JudulBuku?></td>
                    <td><?=$data->Pengarang?></td>
                    <td><?=$data->Penerbit?></td>
                    <td><?=$data->TahunTerbit?></td>
                    <td>   
                        <?php if(($data->Status)=='Dipinjam') { ?>
                            <form method="get" action="index.php">
                                <input type="hidden" name="kembali" value="<?=$data->KodePeminjaman;?>">
                                <button style="margin-left:12px" class="btn btn-warning my-sm-0" type="kembali">Dipinjam</button>
                            </form>
                            <td></td>
                        <?php } else { ?> <!--Edit Status Buku-->
                        <form action="tambahbuku.php">
                            <input type="hidden" name="id" value="<?=$data->IdBuku?>">
                            <select id="status" name="status" class="btn">
                                <option value=""><?=$data->Status?></option>
                                <option value="Dikembalikan">Dikembalikan</option>
                                <option value="Diarsipkan">Diarsipkan</option>
                                <option value="Hilang">Hilang</option>
                                <option value="Dibuang">Dibuang</option>
                                <option value="Disumbangkan">Disumbangkan</option>
                            </select>
                            <td><button class="btn btn-success">ChoseToChange</button></td>
                        </form> <?php } ?>
                    </td>
                    <td><?=$data->NoKwitansi?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <?php } ?>
    </div>
    <?php
    } 
    #Session/page Aset
    elseif ($_SESSION['ova']=="aset") {
        #Button Back
        if (!empty($_GET['backpage'])) {
            $back=$_GET['backpage']; 
            if (!empty($_GET['backsess'])) {$_SESSION['ova']=$_GET['backsess'];}
            ?>
            <a href="<?=$back?>"><button  style="margin-left:40px; float:left" class="btn btn-primary">Back</button></a>
        <?php }
    ?> <!--Button Tambah Aset-->
    <div class="container">
        <div style="float: left">
            <a href="index.php?sess=aset"><button class="btn btn-success">Tambah</button></a>
        </div>
        <div style="float : right; padding-bottom:20px">
            <form class="form-inline ml-4" method="get" action="overall.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Jenis atau No Kwitansi" aria-label="Search" name="cariaset">
                <input type="hidden" name="backpage" value="overall.php">
                <button class="btn btn-success my-sm-0" type="submit">Cari</button>
            </form>
        </div>
        <?php
        #Table Cari Aset
        if (!empty($_GET['cariaset'])) {?>
            <div>
            <table class="table">
                <thead>
                    <th>ID Aset</th>
                    <th>Jenis Aset</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>KlikToChange</th>
                    <th>No Kwitansi</th>
                </thead>
            <?php $cari=$_GET['cariaset']; 
            if ($_SESSION['ova']=='keuangan') { $sql=mysqli_query($koneksi,"SELECT * FROM aset WHERE NoKwitansi='$cari' ");} 
            elseif ($back=='index.php') {  $sql=mysqli_query($koneksi,"SELECT * FROM aset WHERE IdAset LIKE '%$cari%' ");} 
            else { $sql=mysqli_query($koneksi,"SELECT * FROM aset WHERE JenisAset LIKE '%$cari%' OR NoKwitansi LIKE '%$cari%' ");}
            while($data=mysqli_fetch_object($sql)) {
            ?>
                <tr>
                    <td><?=$data->IdAset?></td>
                    <td><?=$data->JenisAset?></td>
                    <td><?=$data->JumlahAset?></td>
                    <td>
                        <!--Edit Status Buku-->
                        <form action="tambahaset.php">
                            <input type="hidden" name="id" value="<?=$data->IdAset?>">
                            <select id="status" name="status" class="btn">
                                <option value=""><?=$data->Keterangan?></option>
                                <option value="Diarsipkan">Diarsipkan</option>
                                <option value="Hilang">Hilang</option>
                                <option value="Dibuang">Dibuang</option>
                                <option value="Disumbangkan">Disumbangkan</option>
                            </select>
                            <td><button class="btn btn-success">ChoseToChange</button></td>
                        </form>
                    </td>
                    <td><?=$data->NoKwitansi?></td>
                </tr>
            <?php } ?>
            </table>
        </div>
        <?php } else { 
        ?>
        <div> <!--TABLE ALL Aset-->
            <table class="table">
                <thead>
                    <th>ID Aset</th>
                    <th>Jenis Aset</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>KlikToChange</th>
                    <th>No Kwitansi</th>
                </thead>
                <?php $sql=mysqli_query($koneksi,"SELECT * FROM aset ");
                while($data=mysqli_fetch_object($sql)) {
                ?>
                <tr>
                    <td><?=$data->IdAset?></td>
                    <td><?=$data->JenisAset?></td>
                    <td><?=$data->JumlahAset?></td>
                    <td>
                        <!--Edit Keterangan Aset-->
                        <form action="tambahaset.php">
                            <input type="hidden" name="id" value="<?=$data->IdAset?>">
                            <select id="status" name="status" class="btn">
                                <option value=""><?=$data->Keterangan?></option>
                                <option value="Diarsipkan">Diarsipkan</option>
                                <option value="Hilang">Hilang</option>
                                <option value="Dibuang">Dibuang</option>
                                <option value="Disumbangkan">Disumbangkan</option>
                            </select>
                            <td><button class="btn btn-success">ChoseToChange</button></td>
                        </form>
                    </td>
                    <td><?=$data->NoKwitansi?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <?php } ?>
    </div>
    <?php
    } 
    #Session/Page Anggota
    elseif ($_SESSION['ova']=="anggota") {
        #Button Back Page
        if (!empty($_GET['backpage'])) {
            $back=$_GET['backpage']; 
            ?>
            <a href="<?=$back?>"><button  style="margin-left:40px; float:left" class="btn btn-primary">Back</button></a>
        <?php }
    ?> <!--Button Tambah Anggota-->
    <div class="container">
        <div style="float: left">
            <a href="index.php?sess=anggota"><button class="btn btn-success">Tambah</button></a>
        </div>
        <div style="float : right; padding-bottom:20px">
            <form class="form-inline ml-4" method="get" action="overall.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Nama atau No Anggota" aria-label="Search" name="carianggota">
                <input type="hidden" name="backpage" value="overall.php">
                <button class="btn btn-success my-sm-0" type="submit">Cari</button>
            </form>
        </div>
        <?php
        if (!empty($_GET['carianggota'])) {?>
            <div> <!--TABLE SEARCH Anggota-->
            <table class="table">
                <thead>
                    <th>No Anggota</th>
                    <th>PIN</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Pekerjaan</th>
                    <th>Instansi</th>
                    <th>No HP/WA</th>
                    <th></th>
                </thead>
                <?php $cari=$_GET['carianggota']; 
                $sql=mysqli_query($koneksi,"SELECT * FROM anggota WHERE IdAnggota LIKE '%$cari%' OR NamaAnggota LIKE '%$cari%' ");
                while($data=mysqli_fetch_object($sql)) {
                ?>
                <tr>
                    <td><?=$data->IdAnggota?></td>
                    <td><?=$data->PIN?></td>
                    <td><?=$data->NamaAnggota?></td>
                    <td><?=$data->AlamatAnggota?></td>
                    <td><?=$data->Pekerjaan?></td>
                    <td><?=$data->Instansi?></td>
                    <td><?=$data->NoHpWa?></td>
                    <td>
                    <form action="formEdit.php" method="get">
                        <input type="hidden" name="id" value="<?=$data->IdAnggota?>">
                        <input type="hidden" name="sess" value="anggota">
                        <button class="btn btn-danger" type="submit">Edit</button>
                    </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <?php } else { 
        ?>
        <div> <!--TABLE ALL Anggota-->
            <table class="table">
                <thead>
                    <th>No Anggota</th>
                    <th>PIN</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Pekerjaan</th>
                    <th>Instansi</th>
                    <th>No HP/WA</th>
                    <th></th>
                </thead>
                <?php $sql=mysqli_query($koneksi,"SELECT * FROM anggota ");
                while($data=mysqli_fetch_object($sql)) {
                ?>
                <tr>
                    <td><?=$data->IdAnggota?></td>
                    <td><?=$data->PIN?></td>
                    <td><?=$data->NamaAnggota?></td>
                    <td><?=$data->AlamatAnggota?></td>
                    <td><?=$data->Pekerjaan?></td>
                    <td><?=$data->Instansi?></td>
                    <td><?=$data->NoHpWa?></td>
                    <td> 
                    <form action="formEdit.php" method="get">
                        <input type="hidden" name="id" value="<?=$data->IdAnggota?>">
                        <input type="hidden" name="sess" value="anggota">
                        <button class="btn btn-danger" type="submit">Edit</button>
                    </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <?php } ?>
    </div>
    <?php
    } 
    #Session/page Peminjaman
    elseif ($_SESSION['ova']=="peminjaman") {
    ?> <!--Button Tambah Peminjaman-->
    <div class="container">
        <div style="margin -bottom:20px; float: left">
            <a href="index.php?sess=dash"><button class="btn btn-success">Tambah Peminjaman</button></a>
        </div>
        <div> <!--TABLE ALL Peminjaman-->
            <table class="table">
                <thead>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pinjam</th>
                    <th>Kembali</th>
                    <th>Denda</th>
                    <th></th>
                    <th>No Anggota</th>
                </thead>
                <?php 
                $sql=mysqli_query($koneksi,"SELECT * FROM peminjaman JOIN buku ON buku.IdBuku=peminjaman.IdBuku");
                while($data=mysqli_fetch_object($sql)) {
                    ?> <tr>
                        <td><?=$data->KodePeminjaman?></td>  
                        <td><?=$data->JudulBuku?></td>
                        <td><?=$data->TanggalPinjam?></td>
                        <td><?php if($data->TanggalKembali=='0000-00-00') {
                            ?> <a href="index.php?kembali=<?=$data->KodePeminjaman;?>">
                            <button class="btn btn-warning">Belum Dikembalikan</button></a> <?php
                            }
                            else { echo $data->TanggalKembali;} ?></td>
                        <td><?=$data->Denda?></td>
                        <td> <?php
                            if ($data->Denda!='0') { ?>
                                <a href="bayardenda.php?id=<?=$data->IdAnggota;?>"><button class="btn btn-warning">Bayar</button></a></td>
                            <?php }
                        ?>
                        <td><?=$data->IdAnggota?></td>
                    </tr>
                <?php }
                ?>  
            </table>
        </div>
    </div>
    <?php }
}
    ?>
</main>
<footer>
</footer>
</body>
</html>