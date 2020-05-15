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
$_SESSION['jn']='index.php';
#Pengembalian Buku
if(!empty($_GET['kembali'])){
    $tanggal=date("Y-m-d");
	$kode=$_GET['kembali'];
	$sql=mysqli_query($koneksi,"SELECT * FROM `peminjaman` WHERE `KodePeminjaman`='$kode'");
    while($data=mysqli_fetch_object($sql)){
        //$dplus=strtotime("+7 Days");
        //$kembali=date($data->TanggalPinjam, $dplus);
        $kembali=date($data->TanggalPinjam);
        $hitungk=abs((strtotime($kembali)/86400 ));
        $hitungsi=abs(strtotime($tanggal)/86400);
        if($hitungsi>$hitungk) {
            //$telat=($hitungsi-$hitungk)*500;
            $telat= abs($hitungsi-$hitungk-7)*500;
            $sql2=mysqli_query($koneksi,"UPDATE `peminjaman` SET `TanggalKembali`='$tanggal', `Denda`='$telat' WHERE `KodePeminjaman`='$kode'");
        } else {
            $sql2=mysqli_query($koneksi,"UPDATE `peminjaman` SET `TanggalKembali`='$tanggal' WHERE `KodePeminjaman`='$kode'");
        } $sql3=mysqli_query($koneksi,"UPDATE `buku` SET `Status`='Dikembalikan' WHERE IdBuku='$data->IdBuku'");
        if (!empty($telat)) {
            header("Location: bayardenda.php?id=$data->IdAnggota");
        }
    }
} #set session login
if (!empty($_GET['idpet'])) {
    $id=$_GET['idpet'];
    $_SESSION['login']=$id;
} #set session home/page
if (!empty($_GET['sess'])) {
    $sess=$_GET['sess'];
    $_SESSION['home']=$sess;
}
?> <!--HEADER-->
<header>
    <div style="background-image: url('picture/background/perpus.jpg'); " class="jumbotron jumbotron-fluid">   
    <div id="" class="container">
        <ul class="list-group">
        <li class="list-group-item list-group-item-primary">
            <a class="" href="index.php?sess=dash"><b>Dashboard</b></a>
        </li>
        <li class="list-group-item list-group-item-primary">
            <a class="" href="index.php?sess=keuangan"><b>Keuangan</b></a>
        </li>
        <li class="list-group-item list-group-item-primary">
            <a class="" href="index.php?sess=buku"><b>Buku</b></a>
        </li>
        <li class="list-group-item list-group-item-primary">
            <a class="" href="index.php?sess=aset"><b>Aset</b></a>
        </li>
        <li class="list-group-item list-group-item-primary">
            <a class="" href="index.php?sess=anggota"><b>Anggota</b></a>
        </li>
        <li class="list-group-item list-group-item-primary">
            <a class="" href="index.php?sess=question"><b>Question</b></a>
        </li>
        <li class="list-group-item list-group-item-primary">
            <a class="" href="overall.php?sess=question"><b>Overall Data</b></a>
        </li>
        </ul>
    </div> 
    </div >
    
</header> 
<main>
<?php #Login Petugas
if (empty($_SESSION['login'])) {
    ?><form action="index.php" method="get">
    <div class="container" >
      <div class="form-group col-md-6 row">
        <label >Masukkan ID </label>
        <input type="text" class="form-control" name="idpet">
      </div>
      <button type="submit" class="btn btn-primary ">Masuk</button>
    </div> </form>

<?php
} else {
?> <!--Button Berganti Tugas-->
    <div>
        <a href="endsession.php" style="float: right; margin-right:40px">
        <button type="submit" class="btn btn-primary ">Berganti<br> Tugas</button></a>
    </div>
    <!--Halaman Dashboard-->
    <?php if ((empty($_SESSION['home']))||($_SESSION['home']=="dash")) { 
    ?>
        <div class="container">
            <table class="table">
                <thead>
                    <th><center>Peminjaman</center></th>
                    <th><center>Pengembalian</center></th>
                    <th><center>Informasi Petugas</center></th>
                </thead>
                <tr height="40px">
                    <!--Form Peminjaman-->
                    <div class="form-group"><td>
                        <form method="get" action="pinjamProses.php">
                            <table >
                                <tr >
                                    <td> Kode Buku </td>
                                    <td> : </td>
                                    <td> <input class="form-control" type="text" name="idbuku"> </td>
                                </tr>
                                <tr>
                                    <td> No Anggota </td>
                                    <td> : </td>
                                    <td> <input class="form-control" type="text" name="idAnggota"> </td>
                                </tr>
                                <tr>
                                    <td colspan="2"> <button class="btn btn-success" type="submit">Submit
                                    </button> </td>
                                    <td><?php
                                        if (!empty($_GET['mess'])) { $message=$_GET['mess']; echo $message; }
                                    ?></td>
                                </tr>
                            </table>
                        </form>
                    </td>
                    <!--Pencarian Pengembalian-->
                    <td> 
                        <form class="form-group" method="get" action="index.php">
                            <table>
                                <tr><td><input class="form-control mr-sm-2" type="search" placeholder="Cari Anggota" aria-label="Search" name="cari"></td></tr>
                                <tr><td><button class="btn btn-success my-sm-0" type="submit">Cari</button></td></tr>
                                <?php 
                                if(!empty($_GET['cari'])){
                                    $query=mysqli_query($koneksi,"SELECT * from peminjaman JOIN buku ON buku.IdBuku=peminjaman.IdBuku WHERE peminjaman.IdAnggota='$_GET[cari]' AND peminjaman.TanggalKembali='0000-00-00'");
                                    while($data=mysqli_fetch_array($query)) {
                                        ?><tr>
                                            <?php $tanggal=date($data['TanggalPinjam']);
                                            
                                            $dplus=strtotime("+ 7 days");
                                            $kembali=date('Y-m-d',strtotime('+ 6 days',strtotime($tanggal)));
                                            //$kembali=(date($data['TanggalPinjam'])
                                            ?>
                                            <td><?=$data['JudulBuku'];?><br><br>Pinjam : <?=$data['TanggalPinjam']?><br>Tanggal Seharusnya Kembali : <?=$kembali?></td>
                                            <form method="get" action="index.php">
                                                <input type="hidden" name="kembali" value="<?=$data['KodePeminjaman'];?>">
                                                <td><button class="btn btn-success my-sm-0" type="kembali">Kembalikan</button></td>
                                            </form>
                                            </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </form>
                    </td>
                    <!--Tabel Informasi Petugas-->
                    <td rowspan="2"> 
                        <div>
                            <table width="500px">
                                <?php 
                                    $sql=mysqli_query($koneksi,"SELECT * FROM infopetugas WHERE KodeTampil='1'");
                                    while($data=mysqli_fetch_object($sql)) {
                                ?>
                                <tr><td><?=$data->IsiInfo;?></td>
                                <td> <a href="deleteInfoPetugas.php?id=<?=$data->KodeInfo;?>">
                                    <button class="btn btn-success my-sm-0" type="submit">Hapus</button></a>
                                </td></tr>
                                    <?php }?>
                            </table>
                            <form class="form-group" method="get" action="tambahInfoPetugas.php">
                                <table>
                                    <tr><td> <textarea class ="form-control" name="textinfo" cols="40" rows="10"></textarea></td></tr>
                                    <tr><td><button class="btn btn-success my-sm-0" type="submit">Tambah</button></td></tr>
                                </table>    
                            </form>
                        </div> 
                    </td></div>
                </tr>
                <tr>
                    <!--Tabel Pengembailan dan Denda-->
                    <td colspan="2">
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
                            $sql=mysqli_query($koneksi,"SELECT * FROM peminjaman JOIN buku ON buku.IdBuku=peminjaman.IdBuku WHERE TanggalKembali='0000-00-00' OR Denda!='0'");
                            while($data=mysqli_fetch_object($sql)) {
                                ?> <tr>
                                    <td><?=$data->KodePeminjaman?></td>  
                                    <td><?=$data->JudulBuku?></td>
                                    <td><?=$data->TanggalPinjam?></td>
                                    <td><?php if($data->TanggalKembali=='0000-00-00') {
                                        ?> <a href="index.php?kembali=<?=$data->KodePeminjaman;?>">
                                        <button class="btn btn-warning">Kembalikan</button></a> <?php
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
                    </td>
                </tr>
            </table>
        </div>
    <?php 
    } 
    #Halaman Keuangan
    elseif ($_SESSION['home']=="keuangan") {
    ?>
        <div class="container">
        <table class="table" > 
        <tr>
            <td>
            <table class="table">
                <thead>
                    <th>No Kwitansi</th>
                    <th>Jenis Transaksi</th>
                    <th>Petugas </th>
                    <th>Detail </th>
                </thead>
            <?php
                $sql=mysqli_query($koneksi,"SELECT * FROM keuangan");
                while($data=mysqli_fetch_object($sql)) {
                ?> 
                    <tr>
                        <td><?=$data->NoKwitansi;?></td>
                        <td><?=$data->JenisTransaksi;?></td>
                        <td><?=$data->IdPetugas;?></td>
                        <td>
                        <form action="overall.php" method="get">
                            <input type="hidden" name="carikwitansi" value="<?=$data->JenisTransaksi;?>">
                            <input type="hidden" name="sess" value="keuangan">
                            <input type="hidden" name="backpage" value="index.php">
                            <button class="btn btn-danger">Detail</button> 
                        </form>
                        </td>
                    </tr>
                <?php
                }
            ?></table>
            </td>
            <td>
                <!--Form Tambah Kwitansi-->
                <form action="tambahKwitansi.php" method="get">
                    <div class="form-group">
                        <label>No Kwitansi </label>
                        <input type="text" name="noKwitansi" class="form-control" placeholder="2018/001">
                    </div>
                    <div class="form-group">
                        <label>Jenis Transaksi </label>
                        <input type="text" name="jenis" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Jumlah </label>
                        <input type="text" name="jumlah" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Nominal </label>
                        <input type="text" name="nominal" class="form-control" placeholder="">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </td>
        </tr>
        </table>
        </div>
    <?php
    } 
    #Halaman Buku
    elseif ($_SESSION['home']=="buku") {
    ?>
        <div class="container">
        <table class="table" > 
        <tr>
            <td>
            <table class="table">
                <thead>
                    <th>ID Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Status</th>
                    <th>No Kwitansi</th>
                    <th>Detail</th>
                </thead>
            <?php
                $sql=mysqli_query($koneksi,"SELECT * FROM buku");
                while($data=mysqli_fetch_object($sql)) {
                ?> 
                    <tr>
                        <td><?=$data->IdBuku;?></td>
                        <td><?=$data->JudulBuku;?></td>
                        <td><?=$data->Pengarang;?></td>
                            <?php if(($data->Status)=='Dipinjam') { ?>
                                <form method="get" action="index.php">
                                    <input type="hidden" name="kembali" value="<?=$data->KodePeminjaman;?>">
                                    <td><button class="btn btn-warning my-sm-0" type="kembali">Dipinjam</button></td>
                                </form>
                            <?php } else { ?><td><?=$data->Status;?></td><?php }
                            ?>
                        <td><?=$data->NoKwitansi;?></td>
                        <td>
                        <form action="overall.php" method="get">
                            <input type="hidden" name="caribuku" value="<?=$data->IdBuku;?>">
                            <input type="hidden" name="sess" value="buku">
                            <input type="hidden" name="backpage" value="index.php">
                            <button class="btn btn-danger">Detail</button> 
                        </form>
                        </td>
                    </tr>
                <?php
                }
            ?></table>
            </td>
            <td>
                <!--Form Tambah Buku-->
                <form action="tambahBuku.php" method="get">
                    <div class="form-group">
                        <label>Judul Buku </label>
                        <input type="text" name="judul" class="form-control" placeholder="2018/001">
                    </div>
                    <div class="form-group">
                        <label>Pengarang </label>
                        <input type="text" name="pengarang" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Penerbit </label>
                        <input type="text" name="penerbit" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Tahun Terbit </label>
                        <input type="text" name="tahun" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>No Kwitansi </label>
                        <input type="text" name="noKwitansi" class="form-control" placeholder="">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </td>
        </tr>
        </table>
        </div>
    <?php
    } 
    #Halaman Aset
    elseif ($_SESSION['home']=="aset") {
    ?>
        <div class="container">
        <table class="table">
        <tr>
            <td>
                <table class="table">
                    <thead>
                        <th>ID Aset</th>
                        <th>Jenis</th>
                        <th>Keterangan</th>
                        <th>No Kwitansi</th>
                        <th>Detail</th>
                    </thead>
                <?php
                    $sql=mysqli_query($koneksi,"SELECT * FROM aset ");
                    while($data=mysqli_fetch_object($sql)) {
                    ?> 
                        <tr>
                            <td><?=$data->IdAset;?></td>
                            <td><?=$data->JenisAset;?></td>
                            <td><?=$data->Keterangan?></td>
                            <td><?=$data->NoKwitansi;?></td>
                            <td>
                            <form action="overall.php" method="get">
                                <input type="hidden" name="cariaset" value="<?=$data->IdAset;?>">
                                <input type="hidden" name="sess" value="aset">
                                <input type="hidden" name="backpage" value="index.php">
                                <button class="btn btn-danger">Detail</button> 
                            </form>
                            </td>
                        </tr>
                    <?php
                    }
                ?></table>
            </td>
            <td>
                <!--Form Tambah Aset-->
                <form action="tambahAset.php" method="get">
                    <div class="form-group">
                        <label>Jenis Aset </label>
                        <input type="text" name="jenis" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Aset </label>
                        <input type="text" name="jumlah" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>No Kwitansi </label>
                        <input type="text" name="noKwitansi" class="form-control" placeholder="">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </td>
        </tr>
        </table>
        </div>
    <?php
    } 
    #Halaman Anggota
    elseif ($_SESSION['home']=="anggota") {
    ?>
        <div class="container">
        <table class="table">
        <tr>
            <td>
            <table class="table">
                <thead>
                    <th>No Anggota</th>
                    <th>PIN</th>
                    <th>Nama</th>
                    <th>Detail</th>
                </thead>
                <?php
                $sql=mysqli_query($koneksi,"SELECT * FROM anggota ");
                while($data=mysqli_fetch_object($sql)) {
                ?> 
                    <tr>
                        <td><?=$data->IdAnggota;?></td>
                        <td><?=$data->PIN;?></td>
                        <td><?=$data->NamaAnggota;?></td>
                        <td>
                            <form action="overall.php" method="get">
                                <input type="hidden" name="carianggota" value="<?=$data->IdAnggota;?>">
                                <input type="hidden" name="sess" value="anggota">
                                <input type="hidden" name="backpage" value="index.php">
                                <button class="btn btn-danger">Detail</button> 
                            </form>
                        </td>
                    </tr>
                <?php
                }
            ?></table>
            </td>
            <td>
                <!--Form Tambah Anggota-->
                <form action="tambahAnggota.php" method="get">
                    <div class="form-group">
                        <label>No Anggota </label>
                        <input type="text" name="id" class="form-control" placeholder="086/p-18">
                    </div>
                    <div class="form-group">
                        <label>Nama </label>
                        <input type="text" name="nama" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Alamat </label>
                        <input type="text" name="alamat" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan </label>
                        <input type="text" name="pekerjaan" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Instansi </label>
                        <input type="text" name="instansi" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>No HP/WA </label>
                        <input type="text" name="hp" class="form-control" placeholder="">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </td>
            </tr>
        </table>
        
        </div>
    <?php
    } 
    # Halaman question 
    elseif ($_SESSION['home']=="question") {
    ?>  
        <div class="container">
        <table class="table">
        <?php
        $sql=mysqli_query($koneksi,"SELECT * FROM  question WHERE KodeTampil='0'");
        while($data=mysqli_fetch_object($sql)) {
            ?>
            <tr>
                <tr><td><?=$data->IdAnggota?></td>
                <form action="answerquestion.php">
                <input type="hidden" name="kodetampil" value="<?=$data->KodeTampil?>">
                <input type="hidden" name="kode" value="<?=$data->KodeQ;?>">
                <td><button class="btn btn-danger my-sm-0" type="baca">Baca</button></td></tr>
                </form>
                
                <tr rowspan="2"><td><?=$data->IsiQ?></td></tr>
                <tr><form class="form-group" method="get" action="answerquestion.php">
                    <input type="hidden" name="kode" value="<?=$data->KodeQ;?>">
                <td><textarea class ="form-control" name="textansw" cols="40" rows="2"></textarea></td>
                <td><button class="btn btn-success my-sm-0" type="submit">Balas</button></td></tr>    
                </form>
            </tr>
        <?php }
        ?>
        </table>
        </div>
    <?php } 
} 
    ?>
    
</main>
<footer>
</footer>

</body>
</html>