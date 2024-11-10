<?php
session_start();
include '../koneksi.php';





// ------------------------------------------------SUPERVISOR--------------------------------------------

// get semua pelatihan
function get_all_pelatihan(){
    global $koneksi;
    $sql = mysqli_query($koneksi, "
        SELECT pelatihan.*, pegawai.nama AS nama_pegawai
        FROM pelatihan
        LEFT JOIN pegawai ON pelatihan.id_pegawai = pegawai.id_user
    ");
    
    $pelatihan = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $pelatihan[] = $row;
    }
    
    return $pelatihan;
}






//-----Terima/Tolak : Pengajuan Pelatihan
function status_pelatihan($data) {
    global $koneksi;

    $id_pelatihan = $_GET['id_pelatihan']; // Pastikan `id_pelatihan` dikirimkan lewat URL atau form
    $status = $data['status'];
    $keterangan = $data['komentar'];

    // Insert ke tabel komentar
    $insertKomentarQuery = "INSERT INTO komentar_pelatihan (id_pelatihan, komentar) VALUES ('$id_pelatihan', '$keterangan')";

    if (mysqli_query($koneksi, $insertKomentarQuery)) {
        // Update status di tabel pelatihan jika insert ke komentar berhasil
        $updatePelatihanQuery = "UPDATE pelatihan SET status = '$status' WHERE id_pelatihan = '$id_pelatihan'";

        if (mysqli_query($koneksi, $updatePelatihanQuery)) {
            // Jika statusnya "Diterima", insert ke tabel pelaporan
            if ($status === "Diterima") {
                $insertPelaporanQuery = "INSERT INTO pelaporan (id_pelatihan, berkas, status, tgl) VALUES ('$id_pelatihan', NULL, 'Belum Mengupload LPJ', NULL)";

                if (!mysqli_query($koneksi, $insertPelaporanQuery)) {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal menyimpan ke pelaporan: " . mysqli_error($koneksi) . "'
                        });
                    </script>";
                }
            }

            // Redirect jika semua berhasil
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal memperbarui status pelatihan: " . mysqli_error($koneksi) . "'
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal menyimpan komentar: " . mysqli_error($koneksi) . "'
            });
        </script>";
    }
}





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
        if (move_uploaded_file($tmp_name, $upload_file)) {
            $tgl = date('Y-m-d');

            // Simpan ke database
            $sql = mysqli_query($koneksi, "INSERT INTO pelaporan (id_pelatihan, berkas, status, tgl) VALUES ('$id_pelatihan', '$upload_file', '$status', '$tgl')");
            if ($sql) {
                echo "<script>alert('Berhasil')</script>";
            } else {
                echo "<script>alert('Gagal')</script>";
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

function getall_pelaporan_supervisor() {
    global $koneksi;

    $sql = mysqli_query($koneksi, "
    SELECT pelaporan.*, pelaporan.status AS status_pelaporan, pelatihan.*, pegawai.nama AS nama_pegawai
    FROM pelaporan
    LEFT JOIN pelatihan ON pelaporan.id_pelatihan = pelatihan.id_pelatihan
    LEFT JOIN pegawai ON pelatihan.id_pegawai = pegawai.id_user
");



    if (!$sql) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $pelaporan = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $pelaporan[] = $row;
    }

    return $pelaporan;
}


function get_pelaporan_supervisorByID() {
    global $koneksi;
    $id_pelaporan = $_GET['id_pelaporan'];

    $sql = "
        SELECT pelaporan.*, pelaporan.status AS status_pelaporan, pelatihan.*, 
               pegawai.nama, jurusan.jurusan AS nama_jurusan, prodi.prodi AS nama_prodi
        FROM pelaporan
        INNER JOIN pelatihan ON pelaporan.id_pelatihan = pelatihan.id_pelatihan
        INNER JOIN pegawai ON pelatihan.id_pegawai = pegawai.id_user
        INNER JOIN jurusan ON pelatihan.id_jurusan = jurusan.id_jurusan
        INNER JOIN prodi ON pelatihan.id_prodi = prodi.id_prodi
        WHERE pelaporan.id_pelaporan = '$id_pelaporan'
    ";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        $pelaporan = mysqli_fetch_assoc($result);
        return $pelaporan;
    } else {
        return null; // Query gagal
    }
}





function get_berkas_byPelatihan(){
    global $koneksi;
    $id_pegawai = $_GET['id_pelatihan'];
    $sql = mysqli_query($koneksi, "SELECT * FROM pelaporan WHERE id_pelatihan = '$id_pegawai'");
    return mysqli_fetch_assoc($sql);
}





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


//edit pelatihan
function edit_pelaporan($data) {
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










function status_pelaporan($data) {
    global $koneksi;

    $id_pelaporan = $_GET['id_pelaporan']; // Pastikan `id_pelaporan` dikirimkan lewat URL atau form
    $status = $data['status'];
    $komentar = $data['komentar'];

    // Insert ke tabel komentar
    $insertKomentarQuery = "INSERT INTO komentar_pelaporan (id_pelaporan, komentar) VALUES ('$id_pelaporan', '$komentar')";

    if (mysqli_query($koneksi, $insertKomentarQuery)) {
        // Update status di tabel pelaporan jika insert ke komentar berhasil
        $updatePelaporanQuery = "UPDATE pelaporan SET status = '$status' WHERE id_pelaporan = '$id_pelaporan'";
        
        if (mysqli_query($koneksi, $updatePelaporanQuery)) {
            echo "<script>
                alert('Status pelaporan berhasil diperbarui.');
                window.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal memperbarui status pelaporan: " . mysqli_error($koneksi) . "'
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal menyimpan komentar: " . mysqli_error($koneksi) . "'
            });
        </script>";
    }
}





?>