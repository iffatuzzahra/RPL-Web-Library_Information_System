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
?>    
  <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="padding-left:50px;">TBM-Prestasi</a>
        
        <button class="navbar-toggler navbar-toggler-right dropdown-toggle" type="button" id="navbardrop" data-toggle="collapse" data-target="#navnav" aria-controls="navnav" aria-expanded="false" >
        </button>
        <div id="navnav" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link " href="index.php?sess=dash">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?sess=about">Tentang Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?sess=faq">FAQ</a>
            </li>
            <?php
            if (!empty($_SESSION['memLogin'])) {
            ?>
            <li class="nav-item">
               <div class="">
                    <form action="anggota.php" class="form-inline">
                        <button class="btn nav-link">Lihat Infomasi Anggota</button>
                        <select id="memInfo" name="memInfo" class="btn nav-link">
                            <option value="" >ChooseInfo</option>
                            <option value="data">Data Anggota</option>
                            <option value="peminjaman">Peminjaman</option>
                            <option value="question">My Question</option>
                            <option value="logout">Log Out</option>
                        </select>
                    </form>
                </div>
            </li>
            <?php } else { ?>
                <div>
                    <a class="" href="addquestion.php?question=0"><img src="admin-mode/picture/icon/user.png" alt="" width=40px;></a>
                </div>
            <?php } ?>
            </ul>
        </div> 
        
        <form class="form-inline my-2 ml-4" method="get" action="index.php">
            <input type="hidden" name="sess" value="dash">
            <input class="form-control mr-sm-2" type="search" placeholder="Cari Buku" aria-label="Search" name="cari">
            <button class="btn btn-success my-sm-0" type="submit">Cari</button>
        </form>
    
        
      </div>
  </nav>
<header>
    <div style="background-image: url('admin-mode/picture/background/perpus.jpg'); height: 150px;" class="jumbotron jumbotron-fluid">
    </div >
</header> 
<main>
<div class="" style="margin:20px">
    <table class="table"> 
        <thead>
            <th class="table-secondary"><center></center></th>
            <th class="bg-success"><center>Informasi Petugas</center></th>
        </thead>
        <tr >
    <?php 
    if ((empty($_SESSION['memHome']))||($_SESSION['memHome']=="dash")) { 
    ?>
    <!--data buku-->
        <td >
            <?php if (empty($_GET['cari'])) { 
                    $sql=mysqli_query($koneksi,"SELECT * FROM buku ");    
                ?>
                <div class="row row-cols-1 row-cols-md-4" >
                <?php while($data=mysqli_fetch_object($sql)) {  ?> <div class="col mb-4">
                <div class="card bg-dark text-light text-justify "  style="width:200px; height:250px">
                    <div class="card-body text-center">
                        <h5 class="card-title "><?=$data->JudulBuku?></h5>
                        <p class="card-text "><?=$data->Pengarang?></p>
                        <p class="card-text "><?=$data->Penerbit?></p>
                        <div>
                            <form method="get" action="index.php">
                                <input type="hidden" name="cari" value="<?=$data->JudulBuku?>">
                                <input type="hidden" name="sess" value="dash">
                                <button class="btn btn-warning" type="submit">Detail</button>
                            </form>
                        </div>
                    </div>
                </div></div>
                <?php } ?> </div>
            <?php 
            } else {
                $cari=$_GET['cari'];
                $sql=mysqli_query($koneksi,"SELECT * FROM buku WHERE JudulBuku LIKE '%$cari%' ");
                while ($data=mysqli_fetch_object($sql)) {
                ?>
                    <center><div class="card bg-dark text-light col mb-4" style="width:600px">
                    <div class="card-body " style="text-align:left" >
                        <table class="table table-dark">
                            <tr>
                                <td>Judul Buku</td>
                                <td><h5 class="card-title "> : <?=$data->JudulBuku?></h5></td>
                            </tr>
                            <tr>
                                <td>Pengarang</td>
                                <td><p class="card-text "> : <?=$data->Pengarang?></p></td>
                            </tr>
                            <tr>
                                <td>Penerbit</td>
                                <td><p class="card-text "> : <?=$data->Penerbit?></p></p></td>
                            </tr>
                            <tr>
                                <td>Tahun Terbit</td>
                                <td><p class="card-text "> : <?=$data->TahunTerbit?></p></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><p class="card-text "> : <?=$data->Status?></p></td>
                            </tr>
                        </table>
                    </div>
                    </div></center>
                <?php }
            }
            ?>
        </td>
    <?php
    }
    else if($_SESSION['memHome']=="about") {
    ?> <td> 
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus reiciendis blanditiis veniam mollitia eius error amet minus, tempore eligendi! Officiis quas ipsam cumque, sapiente nobis impedit! Pariatur ipsum quia temporibus!
        </td>
    <?php
    }
    else if($_SESSION['memHome']=="faq") {
    ?> <td>
            <div class="container">
            <table class="table">
            <?php
            $sql=mysqli_query($koneksi,"SELECT * FROM  question JOIN answer ON question.KodeQ=answer.KodeQ WHERE KodeTampil='2'");
            while($data=mysqli_fetch_object($sql)) {
                ?>
                <tr>
                    <tr rowspan="2"><td><?=$data->IsiQ?></td></tr>
                    <tr rowspan="2"><td><?=$data->IsiA?></td></tr>    
                    </form>
                </tr>
            <?php }
            ?>  <tr><form class="form-group" method="get" action="addquestion.php">
                    <td><textarea class ="form-control" name="question" cols="30" rows="2" placeholder="Tambahkan Pertanyaan (pastikan sudah terdaftar sebagai anggota terlebih dahulu)"></textarea></td>
                    </tr><tr><td><button class="btn btn-danger my-sm-0" style="float:right" type="submit">Tanyakan</button></td>
                </tr>
            </table>
        </div>
        </td>
    <?php
    }
    else if($_SESSION['memHome']=="member") {
    ?> <td>
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

</body>
</html>