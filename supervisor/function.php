<?php
session_start();
include '../koneksi.php';


// ------------------------------------------------SUPERVISOR--------------------------------------------



function logout(){
    session_unset();
    session_destroy();
    echo "<script>alert('Logout'); window.location.href='../login.php'</script>";
}


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
        "SELECT user.*, supervisor.* 
         FROM user 
         JOIN supervisor ON user.id_user = supervisor.id_user 
         WHERE user.id_user = '$id_user'"
    );

    // Periksa jika ada hasil yang ditemukan
    if (mysqli_num_rows($sql) > 0) {
        return mysqli_fetch_assoc($sql); // Ambil data sebagai array asosiatif
    } else {
        return null; // Kembalikan null jika tidak ada data
    }
}


function get_pelatihan_supervisor() {
    global $koneksi;
    $id_supervisor = $_SESSION['id_user']; // Supervisor login

    $sql = mysqli_query($koneksi, "
        SELECT pelatihan.*, pegawai.nama AS nama_pegawai
        FROM pelatihan
        INNER JOIN pegawai ON pelatihan.id_pegawai = pegawai.id_pegawai
        INNER JOIN supervisor ON supervisor.id_supervisor = pegawai.id_supervisor
        WHERE supervisor.id_user = $id_supervisor
    ");

    if (!$sql) {
        die("Query error: " . mysqli_error($koneksi));
    }

    $pelatihan = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $pelatihan[] = $row;
    }

    return $pelatihan;
}








//-----Terima/Tolak : Pengajuan Pelatihan


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

function get_peserta_pelaporan(){
    global $koneksi;
    
    // Ambil id_pelaporan dari parameter GET
    $id_pelaporan = $_GET['id_pelaporan'];

    // Query untuk mengambil id_pelatihan berdasarkan id_pelaporan
    $sql_pelatihan = mysqli_query($koneksi, "
        SELECT id_pelatihan 
        FROM pelaporan 
        WHERE id_pelaporan = '$id_pelaporan'
    ");

    // Ambil id_pelatihan dari hasil query
    $data_pelatihan = mysqli_fetch_assoc($sql_pelatihan);
    if (!$data_pelatihan) {
        return []; // Jika id_pelatihan tidak ditemukan
    }

    $id_pelatihan = $data_pelatihan['id_pelatihan'];

    // Query untuk mengambil peserta berdasarkan id_pelatihan
    $sql = mysqli_query($koneksi, "
        SELECT peserta.id_pegawai, pegawai.nama 
        FROM peserta 
        JOIN pegawai ON peserta.id_pegawai = pegawai.id_pegawai 
        WHERE peserta.id_pelatihan = '$id_pelatihan'
    ");

    // Menyimpan hasil peserta ke dalam array
    $peserta = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $peserta[] = $row;
    }

    return $peserta;
}




function status_pelatihan($data) {
    global $koneksi;

    $id_pelatihan = $_GET['id_pelatihan'];
    $status = $data['status'];
    $keterangan = $data['komentar'];

    // Insert komentar pelatihan
    $insertKomentarQuery = "INSERT INTO komentar_pelatihan (id_pelatihan, komentar) VALUES ('$id_pelatihan', '$keterangan')";

    if (mysqli_query($koneksi, $insertKomentarQuery)) {
        // Update status pelatihan
        $updatePelatihanQuery = "UPDATE pelatihan SET status = '$status' WHERE id_pelatihan = '$id_pelatihan'";

        if (mysqli_query($koneksi, $updatePelatihanQuery)) {
            // Insert ke tabel pelaporan jika status diterima
            if ($status === "Diterima") {
                $insertPelaporanQuery = "INSERT INTO pelaporan (id_pelatihan, berkas, status, tgl) VALUES ('$id_pelatihan', NULL, 'Belum Mengupload LPJ', NULL)";
                if (!mysqli_query($koneksi, $insertPelaporanQuery)) {
                    echo "<script>
                        alert('Gagal menyimpan ke pelaporan: " . mysqli_error($koneksi) . "');
                    </script>";
                }
            }

            // Dapatkan id_pegawai dari tabel pelatihan dan gunakan untuk mengambil id_user dari tabel pegawai
            $getUserQuery = "SELECT pelatihan.id_pegawai, pelatihan.kompetensi
                             FROM pelatihan
                             JOIN pegawai ON pelatihan.id_pegawai = pegawai.id_pegawai
                             WHERE pelatihan.id_pelatihan = '$id_pelatihan'";

            $result = mysqli_query($koneksi, $getUserQuery);
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $id_pegawai = $user['id_pegawai']; // Ambil id_pegawai dari hasil join
                $kompetensi = $user['kompetensi'];

                // Dapatkan id_user dari tabel pegawai berdasarkan id_pegawai
                $getUserIdQuery = "SELECT id_user FROM pegawai WHERE id_pegawai = '$id_pegawai'";
                $userResult = mysqli_query($koneksi, $getUserIdQuery);
                $userData = mysqli_fetch_assoc($userResult);
                $id_user = $userData['id_user']; // Ambil id_user

                // Insert notifikasi
                $pesan = "Pengajuan pelatihan kompetensi $kompetensi anda $status";
                $type = "pelatihan";
                $tgl = date('Y-m-d');
                $is_read = 0;

                $insertNotifikasiQuery = "INSERT INTO notifikasi (pesan, type, id_user, tgl, is_read) VALUES ('$pesan', '$type', '$id_user', '$tgl', '$is_read')";

                if (!mysqli_query($koneksi, $insertNotifikasiQuery)) {
                    echo "<script>
                        alert('Gagal menyimpan notifikasi: " . mysqli_error($koneksi) . "');
                    </script>";
                }

                // Alert sukses
                echo "<script>
                    alert('Status pelatihan berhasil diperbarui dan notifikasi berhasil dikirim!');
                    window.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>
                    alert('Gagal mengambil data user: " . mysqli_error($koneksi) . "');
                </script>";
            }
        } else {
            echo "<script>
                alert('Gagal memperbarui status pelatihan: " . mysqli_error($koneksi) . "');
            </script>";
        }
    } else {
        echo "<script>
            alert('Gagal menyimpan komentar: " . mysqli_error($koneksi) . "');
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


function getall_pelatihan() {
    global $koneksi;

    // Ambil id_user dari sesi login
    $id_user = $_SESSION['id_user'];

    // Cari id_supervisor berdasarkan id_user yang login
    $query_supervisor = mysqli_query($koneksi, "
        SELECT id_supervisor 
        FROM supervisor 
        WHERE id_user = '$id_user'
    ");

    // Pastikan supervisor ditemukan
    if ($row_supervisor = mysqli_fetch_assoc($query_supervisor)) {
        $id_supervisor = $row_supervisor['id_supervisor'];

        // Ambil pelatihan berdasarkan pegawai yang diawasi oleh supervisor ini
        $query_pelatihan = mysqli_query($koneksi, "
            SELECT pelatihan.* 
            FROM pelatihan
            JOIN pegawai ON pelatihan.id_pegawai = pegawai.id_pegawai
            WHERE pegawai.id_supervisor = '$id_supervisor'
        ");

        // Kumpulkan data pelatihan
        $pelatihan = [];
        while ($row_pelatihan = mysqli_fetch_assoc($query_pelatihan)) {
            $pelatihan[] = $row_pelatihan;
        }

        return $pelatihan;
    } else {
        // Jika supervisor tidak ditemukan, kembalikan array kosong
        return [];
    }
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
function getall_pelatihan_byIdPelaporan() {
    global $koneksi;

    // Ambil id_pelaporan dari parameter GET
    $id_pelaporan = $_GET['id_pelaporan'];

    // Query untuk mengambil data pelaporan beserta data pelatihan terkait
    $sql = mysqli_query($koneksi, "
        SELECT 
            pelaporan.*, 
            pelatihan.*, 
            prodi.prodi, 
            jurusan.jurusan
        FROM pelaporan
        JOIN pelatihan ON pelaporan.id_pelatihan = pelatihan.id_pelatihan
        JOIN prodi ON pelatihan.id_prodi = prodi.id_prodi
        JOIN jurusan ON prodi.id_jurusan = jurusan.id_jurusan
        WHERE pelaporan.id_pelaporan = '$id_pelaporan'
    ");

    // Mengembalikan satu baris data pelaporan dan pelatihan
    return mysqli_fetch_assoc($sql);
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
    LEFT JOIN pegawai ON pelatihan.id_pegawai = pegawai.id_pegawai
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


function get_status_pelaporan_byId(){
    global $koneksi;

    // Ambil id_pelaporan dari parameter GET
    $id_pelaporan = $_GET['id_pelaporan'];

    // Query untuk mengambil status pelaporan berdasarkan id_pelaporan
    $sql = mysqli_query($koneksi, "
        SELECT status 
        FROM pelaporan 
        WHERE id_pelaporan = '$id_pelaporan'
    ");

    // Ambil status dari hasil query
    $data = mysqli_fetch_assoc($sql);

    return $data ? $data['status'] : null; // Mengembalikan status atau null jika tidak ditemukan
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

    $id_pelaporan = $_GET['id_pelaporan'];
    $status = $data['status'];
    $komentar = $data['komentar'];

    // Insert komentar pelaporan
    $insertKomentarQuery = "INSERT INTO komentar_pelaporan (id_pelaporan, komentar) VALUES ('$id_pelaporan', '$komentar')";

    if (mysqli_query($koneksi, $insertKomentarQuery)) {
        // Update status pelaporan
        $updatePelaporanQuery = "UPDATE pelaporan SET status = '$status' WHERE id_pelaporan = '$id_pelaporan'";
        
        if (mysqli_query($koneksi, $updatePelaporanQuery)) {
            // Dapatkan informasi tambahan dari tabel pelaporan
            $getInfoQuery = "SELECT pelaporan.id_pelatihan, pelatihan.kompetensi, pelatihan.id_pegawai 
                             FROM pelaporan 
                             JOIN pelatihan ON pelaporan.id_pelatihan = pelatihan.id_pelatihan 
                             WHERE pelaporan.id_pelaporan = '$id_pelaporan'";
            
            $infoResult = mysqli_query($koneksi, $getInfoQuery);
            if ($infoResult && mysqli_num_rows($infoResult) > 0) {
                $info = mysqli_fetch_assoc($infoResult);
                $kompetensi = $info['kompetensi'];
                $id_pegawai = $info['id_pegawai'];

                // Dapatkan id_user dari tabel pegawai
                $getUserQuery = "SELECT id_user FROM pegawai WHERE id_pegawai = '$id_pegawai'";
                $userResult = mysqli_query($koneksi, $getUserQuery);
                $userData = mysqli_fetch_assoc($userResult);
                $id_user = $userData['id_user'];

                // Insert notifikasi
                $pesan = "Pengajuan pelaporan kompetensi $kompetensi anda $status";
                $type = "pelaporan";
                $tgl = date('Y-m-d');
                $is_read = 0;

                $insertNotifikasiQuery = "INSERT INTO notifikasi (pesan, type, id_user, tgl, is_read) VALUES ('$pesan', '$type', '$id_user', '$tgl', '$is_read')";
                if (!mysqli_query($koneksi, $insertNotifikasiQuery)) {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal menyimpan notifikasi: " . mysqli_error($koneksi) . "'
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal mengambil data tambahan: " . mysqli_error($koneksi) . "'
                    });
                </script>";
            }

            // Alert sukses
            echo "<script>
                alert('Status pelaporan berhasil diperbarui dan notifikasi berhasil dikirim.');
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

function read_notifikasi($id) {
    global $koneksi;

    // Query untuk memperbarui status 'is_read' menjadi 1 (dibaca) menggunakan query biasa
    $query = "UPDATE notifikasi SET is_read = 1 WHERE id = $id";
    
    // Eksekusi query
    $result = mysqli_query($koneksi, $query);
    
    // Cek apakah query berhasil
    if ($result) {
        return true;
    } else {
        return false;
    }
}






?>