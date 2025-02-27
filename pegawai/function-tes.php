<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
    

<?php
session_start();
include '../koneksi.php';

function logout(){
    session_unset();
    session_destroy();
    echo "<script>alert('Logout'); window.location.href='../login.php'</script>";
}

function get_supervisor_byPegawai(){
    global $koneksi;
    $id_user = $_SESSION['id_user'];
    $sql = mysqli_query($koneksi, 
    "SELECT s.* 
    FROM pegawai p
    JOIN supervisor s ON p.id_supervisor = s.id_supervisor
    WHERE p.id_user = '$id_user';
    "); 
    if ($sql) {
        return mysqli_fetch_assoc($sql);
    }
    
} 

// Fungsi edit pegawai
function edit_pegawai($data, $id_user) {
    global $koneksi;

    // Sanitasi dan validasi input
    $nip = strtolower(stripslashes($data['nip']));
    $nama = strtolower(stripslashes($data['nama']));
    $jabatan = strtolower(stripslashes($data['jabatan']));
    $email = strtolower(stripslashes($data['email']));
    $telp = mysqli_real_escape_string($koneksi, $data['telp']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $username = mysqli_real_escape_string($koneksi, $data['username']);
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $password2 = mysqli_real_escape_string($koneksi, $data['password2']);
    $old_password = mysqli_real_escape_string($koneksi, $data['old_password']);

    // Penanganan upload foto profil
    $foto_profil = $_FILES['foto_profil']['name'];
    $tmpname = $_FILES['foto_profil']['tmp_name'];
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/SIPELITA-PROJECT/assets/foto_pegawai/' . $foto_profil;

    // Ambil data user lama dari database
    $result = mysqli_query($koneksi, "SELECT username, password FROM user WHERE id_user = '$id_user'");
    if (!$result || mysqli_num_rows($result) === 0) {
        echo "<script>alert('User tidak ditemukan.');</script>";
        return false;
    }

    $currentData = mysqli_fetch_assoc($result);
    $currentUsername = $currentData['username'];
    $currentPassword = $currentData['password'];

    // Cek apakah username diubah dan sudah ada yang memakai username baru
    if ($username !== $currentUsername) {
        $cek_username = mysqli_query($koneksi, "SELECT id_user FROM user WHERE username = '$username'");
        if (mysqli_num_rows($cek_username) > 0) {
            echo "<script>alert('Username sudah digunakan.');</script>";
            return false;
        }
    }

    // Validasi password lama jika ada perubahan password
    if (!empty($password) && !empty($old_password)) {
        if (!password_verify($old_password, $currentPassword)) {
            echo "<script>alert('Password lama tidak sesuai!');</script>";
            return false;
        }
    }

    // Cek konfirmasi password jika ada perubahan password
    if (!empty($password) && $password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai.');</script>";
        return false;
    }

    // Update tabel user
    if (!empty($password)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $updateUser = mysqli_query($koneksi, 
            "UPDATE user SET username = '$username', password = '$password_hashed', role = '$jabatan' WHERE id_user = '$id_user'");
    } else {
        $updateUser = mysqli_query($koneksi, 
            "UPDATE user SET username = '$username', role = '$jabatan' WHERE id_user = '$id_user'");
    }

    // Update tabel pegawai
    if ($foto_profil) {
        if (move_uploaded_file($tmpname, $folder)) {
            $updatePegawai = mysqli_query($koneksi, 
                "UPDATE pegawai SET nip = '$nip', nama = '$nama', email = '$email', telp = '$telp', alamat = '$alamat', foto_profil = '$foto_profil' WHERE id_user = '$id_user'");
        } else {
            echo "<script>alert('Gagal mengunggah foto.');</script>";
            return false;
        }
    } else {
        $updatePegawai = mysqli_query($koneksi, 
            "UPDATE pegawai SET nip = '$nip', nama = '$nama', email = '$email', telp = '$telp', alamat = '$alamat' WHERE id_user = '$id_user'");
    }

    // Validasi keberhasilan query
    if ($updateUser && $updatePegawai) {
        $_SESSION['username'] = $username; // Update session username jika diperlukan
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href = 'index.php';</script>";
        return true;
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
        return false;
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

function getall_pegawai(){
    global $koneksi;
    $sql = mysqli_query($koneksi, "SELECT * FROM pegawai");
    $pegawai = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $pegawai[] = $row;
    }
    return $pegawai;
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

    // Ambil data dari form dan validasi input
    $id = $_SESSION['id_user'];
    $sql_pegawai = mysqli_query($koneksi, "SELECT id_pegawai FROM pegawai WHERE id_user = $id");
    $row_pegawai = mysqli_fetch_assoc($sql_pegawai);
    $id_pegawai = $row_pegawai['id_pegawai'];

    $institusi = trim($_POST['institusi']);
    $prodi = trim($_POST['prodi']);
    $jurusan = trim($_POST['jurusan']);
    $alamat = trim($_POST['alamat']);
    $tgl_start = $_POST['tgl_start'];
    $tgl_end = $_POST['tgl_end'];
    $no_dana = trim($_POST['no_dana']);
    $kompetensi = trim($_POST['kompetensi']);
    $target = trim($_POST['target']);
    $status = 'Diproses';
    $tgl_pengajuan = date('Y-m-d');

    // Validasi input
    if (empty($institusi) || empty($prodi) || empty($jurusan) || empty($alamat) || empty($tgl_start) || empty($tgl_end) || empty($no_dana) || empty($kompetensi) || empty($target)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Semua kolom wajib diisi!'
            });
        </script>";
        return;
    }

    if ($tgl_start > $tgl_end) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai!'
            });
        </script>";
        return;
    }

    if (!is_array($_POST['peserta'])) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data peserta tidak valid!'
            });
        </script>";
        return;
    }

    $peserta = array_filter($_POST['peserta'], fn($id) => $id != 0 && is_numeric($id));

    // Insert ke tabel pelatihan
    $queryPelatihan = $koneksi->prepare("
        INSERT INTO pelatihan (id_pegawai, institusi, id_prodi, id_jurusan, alamat, tgl_start, tgl_end, no_dana, kompetensi, target, status, tgl_pengajuan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $queryPelatihan->bind_param(
        'isssssssssss',
        $id_pegawai, $institusi, $prodi, $jurusan, $alamat,
        $tgl_start, $tgl_end, $no_dana, $kompetensi, $target,
        $status, $tgl_pengajuan
    );

    if ($queryPelatihan->execute()) {
        $id_pelatihan = $koneksi->insert_id;

        $queryPeserta = $koneksi->prepare("INSERT INTO peserta (id_pelatihan, id_pegawai) VALUES (?, ?)");
        foreach ($peserta as $id_pegawai_peserta) {
            $queryPeserta->bind_param('ii', $id_pelatihan, $id_pegawai_peserta);
            if (!$queryPeserta->execute()) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal menambahkan peserta: {$queryPeserta->error}'
                    });
                </script>";
                return;
            }
        }

        $nama = $_SESSION['username'];

        $querySupervisor = mysqli_query($koneksi, "SELECT id_supervisor FROM pegawai WHERE id_user = '$id'");
        if ($querySupervisor && mysqli_num_rows($querySupervisor) > 0) {
            $row = mysqli_fetch_assoc($querySupervisor);
            $id_supervisor = $row['id_supervisor'];

            $querySupervisorUser = mysqli_query($koneksi, "SELECT id_user FROM supervisor WHERE id_supervisor = '$id_supervisor'");
            if ($querySupervisorUser && mysqli_num_rows($querySupervisorUser) > 0) {
                $rowUser = mysqli_fetch_assoc($querySupervisorUser);
                $id_user = $rowUser['id_user'];

                $pesan = "$nama melakukan pengajuan pelatihan kompetensi $kompetensi";
                $type = "pelatihan";
                $tgl = date('Y-m-d');
                $is_read = 0;

                $queryNotifikasi = $koneksi->prepare("
                    INSERT INTO notifikasi (pesan, type, id_user, tgl, is_read) 
                    VALUES (?, ?, ?, ?, ?)
                ");
                $queryNotifikasi->bind_param('ssisi', $pesan, $type, $id_user, $tgl, $is_read);

                if ($queryNotifikasi->execute()) {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil disimpan dan notifikasi terkirim!'
                        }).then(() => {
                            window.location.href = 'index.php';
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Gagal mengirim notifikasi: {$queryNotifikasi->error}'
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal mendapatkan id_user dari supervisor!'
                    });
                </script>";
                return;
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal mendapatkan data supervisor!'
                });
            </script>";
            return;
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gagal menyimpan pelatihan: {$queryPelatihan->error}'
            });
        </script>";
    }
}







//edit pelatihan
function edit_pelatihan($data) {
    global $koneksi;

    // Ambil data dari form
    $id_pelatihan = $_GET['id_pelatihan'];
    $institusi = mysqli_real_escape_string($koneksi, $data['institusi']);
    $prodi = mysqli_real_escape_string($koneksi, $data['prodi']);
    $jurusan = mysqli_real_escape_string($koneksi, $data['jurusan']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $tgl_start = mysqli_real_escape_string($koneksi, $data['tgl_start']);
    $tgl_end = mysqli_real_escape_string($koneksi, $data['tgl_end']);
    $no_dana = mysqli_real_escape_string($koneksi, $data['no_dana']);
    $kompetensi = mysqli_real_escape_string($koneksi, $data['kompetensi']);
    $target = mysqli_real_escape_string($koneksi, $data['target']);
    $status = 'Diproses';

    // Update data pelatihan
    $query = "UPDATE pelatihan 
              SET institusi = '$institusi', id_prodi = '$prodi', id_jurusan = '$jurusan', 
                  alamat = '$alamat', tgl_start = '$tgl_start', tgl_end = '$tgl_end', 
                  no_dana = '$no_dana', kompetensi = '$kompetensi', target = '$target', 
                  status = '$status' 
              WHERE id_pelatihan = '$id_pelatihan'";

    if (mysqli_query($koneksi, $query)) {
        // Hapus semua peserta sebelumnya
        $deleteQuery = "DELETE FROM peserta WHERE id_pelatihan = '$id_pelatihan'";
        if (!mysqli_query($koneksi, $deleteQuery)) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal menghapus peserta sebelumnya'
                });
            </script>";
            return;
        }

        // Tambahkan peserta baru
        if (isset($data['peserta']) && is_array($data['peserta'])) {
            foreach ($data['peserta'] as $id_pegawai) {
                $id_pegawai = mysqli_real_escape_string($koneksi, $id_pegawai);
                $insertQuery = "INSERT INTO peserta (id_pelatihan, id_pegawai) 
                                VALUES ('$id_pelatihan', '$id_pegawai')";
                if (!mysqli_query($koneksi, $insertQuery)) {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal menambahkan peserta baru'
                        });
                    </script>";
                    return;
                }
            }
        }

        // Tampilkan pesan sukses
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Diperbarui',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        // Tampilkan pesan error jika update gagal
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
    $id = $_SESSION['id_user'];
    $sql_pegawai = mysqli_query($koneksi, "
    SELECT id_pegawai FROM pegawai WHERE id_user = $id
    ");
    $row_pegawai = mysqli_fetch_assoc($sql_pegawai);
    $id_pegawai = $row_pegawai['id_pegawai']; 
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
    
    return mysqli_fetch_assoc($sql); 
}

function get_komentar_byPelatihan(){
    global $koneksi;    
    $id_pelatihan = $_GET['id_pelatihan'];

    // Buat query
    $sql = mysqli_query($koneksi, "SELECT komentar FROM komentar_pelatihan 
    JOIN pelatihan ON komentar_pelatihan.id_pelatihan = pelatihan.id_pelatihan 
    WHERE komentar_pelatihan.id_pelatihan = '$id_pelatihan' 
    ORDER BY komentar_pelatihan.id_komentar_pelatihan DESC");
return mysqli_fetch_assoc($sql);
    
}



// --------------------------------------------------------PELAPORAN-----------------------------------------------

function get_peserta(){
    global $koneksi;
    $id_pelatihan = $_GET['id_pelatihan'];
    $sql = mysqli_query($koneksi, "SELECT peserta.id_pegawai, pegawai.nama FROM peserta JOIN pegawai ON peserta.id_pegawai = pegawai.id_pegawai WHERE id_pelatihan = '$id_pelatihan'");
    $peserta = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $peserta[] = $row;
    }
    return $peserta;
}

function add_lpj($data) {
    global $koneksi;

    // Ambil data dari session dan GET
    $id_pegawai = $_SESSION['id_user'];
    $id_pelatihan = $_GET['id_pelatihan'];
    
    // Ambil informasi file yang diunggah
    $berkas = $_FILES['berkas'];
    $sertifikat = $_FILES['sertifikat'];
    $status = 'Diproses';

    $tgl = date('Y-m-d');
    
    // Tentukan folder tujuan
    $upload_dir_berkas = '../assets/berkas_lpj/';
    $upload_dir_sertifikat = '../assets/sertifikat_lpj/';

    // Validasi file berkas
    $allowed_types = ['application/pdf'];
    $max_file_size = 100 * 1024 * 1024; // 100 MB

    if ($berkas['error'] === UPLOAD_ERR_OK) {
        $tmp_name_berkas = $berkas['tmp_name'];
        $name_berkas = basename($berkas['name']);
        $path_berkas = $upload_dir_berkas . $name_berkas;
        $file_type_berkas = mime_content_type($tmp_name_berkas);
        $file_size_berkas = $berkas['size'];

        // Validasi tipe dan ukuran file berkas
        if (!in_array($file_type_berkas, $allowed_types)) {
            echo "<script>alert('Berkas harus berupa file PDF.')</script>";
            return;
        }

        if ($file_size_berkas > $max_file_size) {
            echo "<script>alert('Ukuran berkas tidak boleh lebih dari 100 MB.')</script>";
            return;
        }

        if (move_uploaded_file($tmp_name_berkas, $path_berkas)) {
            // Proses unggah file sertifikat
            if ($sertifikat['error'] === UPLOAD_ERR_OK) {
                $tmp_name_sertifikat = $sertifikat['tmp_name'];
                $name_sertifikat = basename($sertifikat['name']);
                $path_sertifikat = $upload_dir_sertifikat . $name_sertifikat;
                $file_type_sertifikat = mime_content_type($tmp_name_sertifikat);
                $file_size_sertifikat = $sertifikat['size'];

                // Validasi tipe dan ukuran file sertifikat
                if (!in_array($file_type_sertifikat, $allowed_types)) {
                    echo "<script>alert('Sertifikat harus berupa file PDF.')</script>";
                    return;
                }

                if ($file_size_sertifikat > $max_file_size) {
                    echo "<script>alert('Ukuran sertifikat tidak boleh lebih dari 100 MB.')</script>";
                    return;
                }

                if (move_uploaded_file($tmp_name_sertifikat, $path_sertifikat)) {
                    // Update data ke database
                    $sql = mysqli_query($koneksi, "UPDATE pelaporan 
                        SET berkas='$name_berkas', sertifikat='$name_sertifikat', 
                            status='$status', tgl='$tgl' 
                        WHERE id_pelatihan='$id_pelatihan'");

                    if ($sql) {
                        echo "<script>alert('Berhasil memperbarui LPJ')</script>";
                    } else {
                        echo "<script>alert('Gagal memperbarui LPJ ke database')</script>";
                    }
                } else {
                    echo "<script>alert('Gagal mengunggah sertifikat.')</script>";
                }
            } else {
                echo "<script>alert('Error saat mengunggah file sertifikat.')</script>";
            }
        } else {
            echo "<script>alert('Gagal mengunggah file berkas.')</script>";
        }
    } else {
        echo "<script>alert('Error saat mengunggah file berkas.')</script>";
    }
}




function getall_pelaporan(){
    global $koneksi;
    // Dapatkan id_user dari session
    $id_user = $_SESSION['id_user'];
    
    // Cari id_pegawai berdasarkan id_user
    $getIdPegawaiQuery = "SELECT id_pegawai FROM pegawai WHERE id_user = '$id_user'";
    $result = mysqli_query($koneksi, $getIdPegawaiQuery);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $pegawai = mysqli_fetch_assoc($result);
        $id_pegawai = $pegawai['id_pegawai'];
        
        // Lakukan query untuk mendapatkan pelaporan berdasarkan id_pegawai
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
    } else {
        // Jika id_pegawai tidak ditemukan berdasarkan id_user, Anda bisa menangani error di sini
        echo "Error: id_pegawai tidak ditemukan untuk id_user: $id_user";
        return [];
    }
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


function get_komentar_byPelaporan(){
    global $koneksi;    
    $id_pelatihan = $_GET['id_pelatihan'];

    // Ambil id_pelaporan berdasarkan id_pelatihan
    $query_pelaporan = mysqli_query($koneksi, "SELECT id_pelaporan FROM pelaporan WHERE id_pelatihan = '$id_pelatihan'");
    $result_pelaporan = mysqli_fetch_assoc($query_pelaporan);


    $id_pelaporan = $result_pelaporan['id_pelaporan'];

    // Buat query untuk mendapatkan komentar berdasarkan id_pelaporan
    $sql = mysqli_query($koneksi, "SELECT komentar FROM komentar_pelaporan 
                                    WHERE id_pelaporan = '$id_pelaporan' 
                                    ORDER BY id_komentar_pelaporan DESC");

    return mysqli_fetch_assoc($sql);

}











//GET data user login
function get_data_user_login() {
    global $koneksi;

    // Cek apakah session 'id_user' ada
    if (!isset($_SESSION['id_user'])) {
        return null; // Kembalikan null jika session tidak ada
    }

    // Ambil id_user dari session
    $id_user = $_SESSION['id_user'];

    // Query untuk mendapatkan data dari user dan student
    $sql = mysqli_query($koneksi, 
        "SELECT user.*, pegawai.* 
         FROM user 
         JOIN pegawai ON user.id_user = pegawai.id_user 
         WHERE user.id_user = '$id_user'"
    );

    // Periksa jika ada hasil yang ditemukan
    if (mysqli_num_rows($sql) > 0) {
        return mysqli_fetch_assoc($sql); // Ambil data sebagai array asosiatif
    } else {
        return null; // Kembalikan null jika tidak ada data
    }
}










// -----------------------------------------------NOTIFIKASI


function get_notifikasi(){
    global $koneksi;
    $id_pegawai = $_SESSION['id_user'];
    
    $sql = mysqli_query($koneksi, "SELECT * FROM notifikasi WHERE id_user = '$id_pegawai' ORDER BY id_notifikasi DESC");
    
    $pelaporan = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $pelaporan[] = $row;
    }
    
    return $pelaporan;
}




function read_notifikasi($id_notifikasi) {
    global $koneksi;
    
    // Prepare the query to update the 'is_read' status to 1 (true) for the specific notification
    $sql = "UPDATE notifikasi SET is_read = 1 WHERE id_notifikasi = $id_notifikasi";
    
    // Execute the query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>window.location.href = location.href</script>";
    } else {
        return false; // Query failed
    }
}



function delete_notifikasi($id_notifikasi) {
    global $koneksi;
    
    // Prepare the query to update the 'is_read' status to 1 (true) for the specific notification
    $sql = "DELETE FROM notifikasi WHERE id_notifikasi = $id_notifikasi";
    
    // Execute the query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>window.location.href = location.href</script>";
    } else {
        return false; // Query failed
    }
}
