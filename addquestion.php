<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" type="text/css" href="admin-mode/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="file:///C:/xampp/htdocs/TBM/admin-mode/bootstrap/js/bootstrap.min.js"></script>
    
</head>
<body>
<?php 
session_start();
//session_destroy();session_start();
include 'koneksi.php';
if (!empty($_GET['question'])) {
    $question=$_GET['question'];
}
    if(!empty($_GET['pin'])) {
        $sql=mysqli_query($koneksi,"SELECT * FROM anggota WHERE PIN='$_GET[pin]'");
        $jum=mysqli_num_rows($sql);
        if($jum!=0) {
            while($data=mysqli_fetch_array($sql)) {
                $_SESSION['memLogin']=$data['IdAnggota'];
            }
        } else {
            echo "<p padding-top=60px><center>PIN yang anda masukkan salah atau belum terdaftar</center></p><?";
        }
    }

    if (!empty($_SESSION['memLogin'])) {
        if ($question!='') {
            $question="Q : ".$question;
            $sql=mysqli_query($koneksi,"INSERT INTO question VALUE('','$question','$_SESSION[memLogin]','0') ");
        } 
        header("Location: $_SESSION[memjn]");
    }
    else { $question=$_GET['question'];
        ?>  <div class="container" style="margin-top:60px"> <center>
            <div class="card bg-dark text-light" style="width:400px">
                <div class="card-body " >
                    <form class="form-group" action="addquestion.php" method="get">
                        <input type="hidden" name="question" value="<?=$question?>">
                        <input class="form-control mb-sm-4" type="text" name="pin" placeholder="enter your pin">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form> 
                    <a href="index.php"><button class="btn btn-danger">Kembali</button></a>
                </div>
            </div></center>
        </div>
    <?php
    }
?>   
</body>
</html>

<?php 
	
   
?>
 