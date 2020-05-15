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
<div class="container">
    
<?php
    session_start();
    include 'koneksi.php';
    $jn=$_SESSION['jn'];
    $jlhdenda=0;
    $id=$_GET['id'];
    $sql=mysqli_query($koneksi,"SELECT * FROM peminjaman JOIN buku ON buku.IdBuku=peminjaman.IdBuku WHERE IdAnggota='$id' AND Denda!='0'");
    //$data=mysqli_fetch_object($sql);
    ?>
    <div style="padding:20px;">
        <h3><center><?=$id?></center></h3>
    </div>
    <table class="table">
        <thead>
            <th>Kode</th>
            <th>Judul Buku</th>
            <th>Tanggal Dipinjam</th>
            <th>Tanggal Dikembalikan</th>
            <th>Denda</th>
        </thead>
        <tr><?php
    while ($data=mysqli_fetch_object($sql)) {
    ?>  
           <td><?=$data->KodePeminjaman?></td>
           <td><?=$data->JudulBuku?></td>
           <td><?=$data->TanggalPinjam?></td>
           <td><?=$data->TanggalKembali?></td>
           <td><?=$data->Denda?></td>    
    <?php 
        $jlhdenda=$data->Denda+$jlhdenda;
    ?>  </tr>
    <?php }
    ?>  
    </table>
    <div style=" padding:15px; text-align:right;">
    <label style="font-size:20px;"> Besar Keseluruhan Denda : <?=$jlhdenda;?></label>
    </div>
    <?php
    if (!empty($_GET['bayar'])) {
        $sql=mysqli_query($koneksi,"SELECT * FROM peminjaman JOIN buku ON buku.IdBuku=peminjaman.IdBuku WHERE IdAnggota='$id' AND Denda!='0'");
        $bayar=$_GET['bayar'];
        while(($data=mysqli_fetch_object($sql))&&($bayar>0)) {
            $kodepinjam=($data->KodePeminjaman);
            $denda=($data->Denda); 
            if ($denda>$bayar) {
                $sisa=$denda-$bayar;
                $query=mysqli_query($koneksi,"UPDATE `peminjaman` SET `Denda`='$sisa' WHERE `KodePeminjaman`='$kodepinjam'");
                $bayar=0;
            } else {
                $query=mysqli_query($koneksi,"UPDATE `peminjaman` SET `Denda`='0' WHERE `KodePeminjaman`='$kodepinjam'");
                $bayar=$bayar-$denda; 
            }      
        }
        //$query=mysqli_query($koneksi,"UPDATE peminjaman SET Denda='$jumlah' WHERE KodePeminjaman='$kodepinjam'");
      header("Location: $jn");
    }
    else {
        ?>
        <div class="container">
        <table class="table">
            <form class="form-group" method="get" action="bayardenda.php">
            <input type="hidden" name="id" value="<?=$id;?>">
            <tr><td colspan="2"><input class="form-control mr-sm-2" type="text" placeholder="Jumlah Pembayaran" name="bayar"></td></tr>
            <tr><td><button class="btn btn-success my-sm-0" type="submit">Bayar</button>
            </form>
                <a href="<?=$jn?>"><button class="btn btn-danger my-sm-0">Tidak Sekarang</button></a>
            </td></tr>
        </table>
        
        </div>
    <?php } ?>
</div>
</body>
</html>