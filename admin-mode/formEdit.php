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
# Set Session edit/ edit Page
if (!empty($_GET['sess'])) {
    $sess=$_GET['sess'];
    $_SESSION['edit']=$sess;
}
?>
    <div class="container" style="margin-top:50px">
    <?php
    if (($_SESSION['edit'])=='anggota') {
        $id=$_GET['id'];
        $sql=mysqli_query($koneksi,"SELECT * FROM anggota WHERE IdAnggota='$id'");
        $data=mysqli_fetch_object($sql);
        ?>
        <form action="tambahanggota.php" method="get" class="">
            <div class="form-group">
                <h5>No Anggota : <?=$data->IdAnggota;?></h5>
                <h5>Nama : <?=$data->NamaAnggota;?></h5>
                <input type="hidden" name="id" class="form-control" value="<?=$id?>">
            </div>
            <div class="form-group">
                <label>Alamat </label>
                <input type="text" name="alamat" class="form-control" placeholder="<?=$data->AlamatAnggota;?>">
            </div>
            <div class="form-group">
                <label>Pekerjaan </label>
                <input type="text" name="pekerjaan" class="form-control" placeholder="<?=$data->Pekerjaan;?>">
            </div>
            <div class="form-group">
                <label>Instansi </label>
                <input type="text" name="instansi" class="form-control" placeholder="<?=$data->Instansi;?>">
            </div>
            <div class="form-group">
                <label>No HP/WA </label>
                <input type="text" name="hp" class="form-control" placeholder="<?=$data->NoHpWa;?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php }
    ?>
    </div>
</body>
</html>