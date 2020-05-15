<?php  
$koneksi = new mysqli ("localhost","root","","db_tbm");
if ($koneksi->connect_error) {
	die('Maaf koneksi gagal: '. $koneksi->connect_error);
}
?>