<?php
session_start();
include '../koneksi.php';



// --------------------------------------------PENGAJUAN PELATIHAN----------------------------------------------
function getall_jurusan(){
    global $koneksi;
    $sql = mysqli_query($koneksi, "SELECT * FROM jurusan");
    $jurusan = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $jurusan[] = $row;
    }
    return $jurusan;
}


function getall_prodi(){
    global $koneksi;
    $sql = mysqli_query($koneksi, "SELECT * FROM prodi");
    $prodi = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $prodi[] = $row;
    }
    return $prodi;
}




function pengajuan_pelatihan($data) {
    global $koneksi;

    $id_pegawai = $_SESSION['id_user'];
    $institusi = $_POST['institusi'];
    $prodi = $_POST['prodi'];
    $jurusan = $_POST['jurusan'];
    $nama_peserta = $_POST['nama_peserta'];
    $alamat = $_POST['alamat'];
    $tgl_start = $_POST['tgl_start'];
    $tgl_end = $_POST['tgl_end'];
    $no_dana = $_POST['no_dana'];
    $kompetensi = $_POST['kompetensi'];
    $target = $_POST['target'];
    $status = 'Diproses';

    $query = "INSERT INTO pelatihan (id_pegawai, institusi, id_prodi, id_jurusan, nama_peserta, alamat, tgl_start, tgl_end, no_dana, kompetensi, target, status) 
              VALUES ('$id_pegawai', '$institusi', '$prodi', '$jurusan', '$nama_peserta', '$alamat', '$tgl_start', '$tgl_end', '$no_dana', '$kompetensi', '$target', '$status')";

    if (mysqli_query($koneksi, $query)) {
        // Jika data berhasil disimpan, tampilkan SweetAlert sukses
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Disimpan',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    } else {
        // Jika terjadi kesalahan, tampilkan SweetAlert error
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '". mysqli_error($koneksi) ."'
            });
        </script>";
    }
}



function getall_pelatihan(){
    global $koneksi;
    $id_pegawai = $_SESSION['id_user'];
    $sql = mysqli_query($koneksi, "SELECT * FROM pelatihan WHERE id_pegawai = '$id_pegawai'");
    $pelatihan = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $pelatihan[] = $row;
    }
    return $pelatihan;
}

function getall_pelatihan_byId(){
    global $koneksi;
    $id_pelatihan = $_GET['id_pelatihan'];
    
    $sql = mysqli_query($koneksi, "
        SELECT pelatihan.*, 
               prodi.prodi, 
               jurusan.jurusan
        FROM pelatihan
        JOIN prodi ON pelatihan.id_prodi = prodi.id_prodi
        JOIN jurusan ON prodi.id_jurusan = jurusan.id_jurusan
        WHERE pelatihan.id_pelatihan = '$id_pelatihan'
    ");
    
    return mysqli_fetch_assoc($sql); // Mengembalikan satu baris saja
}



?>