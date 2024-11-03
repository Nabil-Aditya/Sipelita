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

    $query = "INSERT INTO pelatihan (id_pegawai, institusi, id_prodi, id_jurusan, nama_peserta, alamat, tgl_start, tgl_end, no_dana, kompetensi, target) 
              VALUES ('$id_pegawai', '$institusi', '$prodi', '$jurusan', '$nama_peserta', '$alamat', '$tgl_start', '$tgl_end', '$no_dana', '$kompetensi', '$target')";

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

?>