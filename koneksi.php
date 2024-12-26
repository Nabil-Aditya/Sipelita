<?php 
$koneksi = mysqli_connect("localhost","simplif1_sipelita-acc","#Polibatam123@","simplif1_sipelita");

// cek koneksi
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>	