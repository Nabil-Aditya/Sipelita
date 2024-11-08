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


//buat pelatihan
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
    $tgl_pengajuan = date('Y-m-d');

    $query = "INSERT INTO pelatihan (id_pegawai, institusi, id_prodi, id_jurusan, nama_peserta, alamat, tgl_start, tgl_end, no_dana, kompetensi, target, status, tgl_pengajuan) 
              VALUES ('$id_pegawai', '$institusi', '$prodi', '$jurusan', '$nama_peserta', '$alamat', '$tgl_start', '$tgl_end', '$no_dana', '$kompetensi', '$target', '$status', '$tgl_pengajuan')";

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

//edit pelatihan
function edit_pelatihan($data) {
    global $koneksi;

    $id_pelatihan = $_GET['id_pelatihan'];
    $id_pegawai = $_SESSION['id_user'];
    $institusi = $data['institusi'];
    $prodi = $data['prodi'];
    $jurusan = $data['jurusan'];
    $nama_peserta = $data['nama_peserta'];
    $alamat = $data['alamat'];
    $tgl_start = $data['tgl_start'];
    $tgl_end = $data['tgl_end'];
    $no_dana = $data['no_dana'];
    $kompetensi = $data['kompetensi'];
    $target = $data['target'];
    $status = 'Diproses';

    $query = "UPDATE pelatihan 
              SET institusi = '$institusi', id_prodi = '$prodi', id_jurusan = '$jurusan', nama_peserta = '$nama_peserta', 
                  alamat = '$alamat', tgl_start = '$tgl_start', tgl_end = '$tgl_end', no_dana = '$no_dana', 
                  kompetensi = '$kompetensi', target = '$target', status = '$status'
              WHERE id_pelatihan = '$id_pelatihan'";

    if (mysqli_query($koneksi, $query)) {
        // Jika data berhasil diperbarui, tampilkan SweetAlert sukses
        echo "<script>window.location.href = 'index.php';</script>";

    } else {
        // Jika terjadi kesalahan, tampilkan SweetAlert error
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '" . mysqli_error($koneksi) . "'
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



// -----------------------------------------------LPJ

// function add_lpj($data) {
//     global $koneksi;

//     // Ambil data dari session dan GET
//     $id_pegawai = $_SESSION['id_user'];
//     $id_pelatihan = $_GET['id_pelatihan'];
    
//     // Ambil informasi file yang diunggah
//     $berkas = $_FILES['berkas'];
//     $status = 'Diproses' ;
    
//     // Cek apakah file diunggah dengan benar
//     if ($berkas['error'] === UPLOAD_ERR_OK) {
//         // Dapatkan informasi file
//         $tmp_name = $berkas['tmp_name'];
//         $name = basename($berkas['name']);
        
//         // Tentukan folder tujuan
//         $upload_dir = '../assets/berkas_lpj/';
//         $upload_file = $name;

//         // Pindahkan file ke folder yang dituju
//         if (move_uploaded_file($tmp_name, $upload_file)) {
//             $tgl = date('Y-m-d');

//             // Simpan ke database
//             $sql = mysqli_query($koneksi, "INSERT INTO pelaporan (id_pelatihan, berkas, status, tgl) VALUES ('$id_pelatihan', '$upload_file', '$status', '$tgl')");
//             if ($sql) {
//                 echo "<script>alert('Berhasil')</script>";
//             } else {
//                 echo "<script>alert('Gagal')</script>";
//             }
//         } else {
//             echo "<script>alert('Gagal mengunggah file.')</script>";
//         }
//     } else {
//         echo "<script>alert('Error saat mengunggah file.')</script>";
//     }
// }

function add_lpj($data) {
    global $koneksi;

    // Ambil data dari session dan GET
    $id_pegawai = $_SESSION['id_user'];
    $id_pelatihan = $_GET['id_pelatihan'];
    
    // Ambil informasi file yang diunggah
    $berkas = $_FILES['berkas'];
    $status = 'Diproses' ;
    
    // Cek apakah file diunggah dengan benar
    if ($berkas['error'] === UPLOAD_ERR_OK) {
        // Dapatkan informasi file
        $tmp_name = $berkas['tmp_name'];
        $name = basename($berkas['name']);
        
        // Tentukan folder tujuan
        $upload_dir = '../assets/berkas_lpj/';
        $upload_file = $name;

        // Pindahkan file ke folder yang dituju
        if (move_uploaded_file($tmp_name, $upload_dir . $upload_file)) {
            $tgl = date('Y-m-d');

            // Update data ke database
            $sql = mysqli_query($koneksi, "UPDATE pelaporan SET berkas='$upload_file', status='$status', tgl='$tgl' WHERE id_pelatihan='$id_pelatihan'");
            if ($sql) {
                echo "<script>alert('Berhasil memperbarui LPJ')</script>";
            } else {
                echo "<script>alert('Gagal memperbarui LPJ')</script>";
            }
        } else {
            echo "<script>alert('Gagal mengunggah file.')</script>";
        }
    } else {
        echo "<script>alert('Error saat mengunggah file.')</script>";
    }
}


function getall_pelaporan(){
    global $koneksi;
    $id_pegawai = $_SESSION['id_user'];
    
    $sql = mysqli_query($koneksi, "
        SELECT pelaporan.*, pelatihan.*, pelaporan.status AS pelaporan_status, pelatihan.status AS pelatihan_status
        FROM pelaporan 
        INNER JOIN pelatihan ON pelaporan.id_pelatihan = pelatihan.id_pelatihan 
        WHERE pelatihan.id_pegawai = '$id_pegawai'
    ");
    
    $pelaporan = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $pelaporan[] = $row;
    }
    
    return $pelaporan;
}




function get_berkas_byPelatihan(){
    global $koneksi;
    $id_pelatihan = $_GET['id_pelatihan'];
    $sql = mysqli_query($koneksi, "SELECT * FROM pelaporan WHERE id_pelatihan = '$id_pelatihan'");
    return mysqli_fetch_assoc($sql);
}

// function get_pelaporan_byPleatihan(){
//     global $koneksi;
//     $id_pelatihan = $_GET['id_pelatihan'];
//     $sql = mysqli_query($koneksi, "SELECT * FROM pelaporan WHERE id_pelatihan = '$id_pelatihan'");
//     return mysqli_fetch_assoc($sql);
// }





//JOIN pelatihan dan pelaporan
function get_pelaporan(){
    global $koneksi;
    $id_pegawai = $_SESSION['id_user'];
    
    $sql = mysqli_query($koneksi, "
        SELECT pelaporan.*, pelatihan.* 
        FROM pelaporan 
        INNER JOIN pelatihan ON pelaporan.id_pelatihan = pelatihan.id_pelatihan 
        WHERE pelatihan.id_pegawai = '$id_pegawai'
    ");
    
    $pelaporan = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $pelaporan[] = $row;
    }
    
    return $pelaporan;
}
?>