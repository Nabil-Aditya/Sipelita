<?php 
$koneksi = mysqli_connect("localhost","root","","sipelita");

// cek koneksi
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>	