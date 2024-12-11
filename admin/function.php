<?php

include '../koneksi.php';

session_start();


function logout(){
    session_unset();
    session_destroy();
    echo "<script>alert('Logout'); window.location.href='../login.php'</script>";
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
        "SELECT * FROM user WHERE id_user = '$id_user'"
    );

    // Periksa jika ada hasil yang ditemukan
    if (mysqli_num_rows($sql) > 0) {
        return mysqli_fetch_assoc($sql); // Ambil data sebagai array asosiatif
    } else {
        return null; // Kembalikan null jika tidak ada data
    }
}

// -------------------------------------------------------------------PEGAWAI

// tambah pegawai
function tambah_pegawai($data)
{
    global $koneksi;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    // Validasi minimal password 6 karakter
    if (strlen($password) < 6) {
        echo "<script>alert('Password harus minimal 6 karakter');</script>";
        return false;
    }

    // Validasi konfirmasi password
    if ($password !== $password2) {
        echo "<script>alert('Mohon konfirmasikan password dengan benar')</script>";
        return false;
    }

    // Enkripsi password 
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Lanjutkan dengan proses lainnya
    $id_supervisor = $data['supervisor'];
    $nip = $data['nip'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $jabatan = $data['jabatan'];
    $email = $data['email'];
    $telp = $data['telp'];

    $foto_profil = $_FILES['foto_profil']['name'];
    $tmpname = $_FILES['foto_profil']['tmp_name'];

    // Tentukan folder penyimpanan berdasarkan jabatan
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/SIPELITA-PROJECT/assets/';
    $folder .= ($jabatan == 'supervisor') ? 'foto_supervisor/' : 'foto_pegawai/';
    $folder .= $foto_profil;

    //cek apakah ada username yang sama
    $cek_username = mysqli_query($koneksi, "SELECT * from user WHERE username = '$username';");
    if (mysqli_fetch_assoc($cek_username)) {
        echo "<script>alert('Username Tidak Tersedia');</script>";
        return false;
    }

    // insert ke database
    // 1. Ke tabel user
    $ke_user = mysqli_query($koneksi, "INSERT INTO user (id_user, username, password, role) VALUES (NULL, '$username', '$password', '$jabatan')");
    if ($ke_user) {
        echo "<script>alert('Berhasil update data ke user')</script>";
    }

    // 2. Dapatkan ID dari user yang baru saja dimasukkan
    $id_dari_user = mysqli_insert_id($koneksi);

    if (move_uploaded_file($tmpname, $folder)) {
        // Masukkan ke tabel pegawai jika jabatan bukan supervisor
        if ($jabatan == 'pegawai') {
            $sql = mysqli_query($koneksi, "INSERT INTO pegawai (id_pegawai, id_user, id_supervisor, nip, nama, alamat, telp, email, foto_profil) VALUES ('', '$id_dari_user', '$id_supervisor', '$nip', '$nama', '$alamat', '$telp', '$email', '$foto_profil')");
            if ($sql) {
                echo "<script>alert('Register Success!'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan data ke tabel pegawai')</script>";
            }
        }

        // Masukkan ke tabel supervisor jika jabatan adalah supervisor
        if ($jabatan == 'supervisor') {
            $sql = mysqli_query($koneksi, "INSERT INTO supervisor (id_supervisor, id_user, nip, nama, alamat, telp, email, foto_profil) VALUES ('', '$id_dari_user', '$nip', '$nama', '$alamat', '$telp', '$email', '$foto_profil')");
            if ($sql) {
                echo "<script>alert('Register Success!'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan data ke tabel supervisor')</script>";
            }
        }

    } else {
        // Jika gagal mengupload file
        echo "<script>alert('Gagal mengupload file');</script>";
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



// Fungsi edit supervisor
function edit_supervisor($data, $id_user) {
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
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/SIPELITA-PROJECT/assets/foto_supervisor/' . $foto_profil;

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

    // Update tabel supervisor
    if ($foto_profil) {
        if (move_uploaded_file($tmpname, $folder)) {
            $updatePegawai = mysqli_query($koneksi, 
                "UPDATE supervisor SET nip = '$nip', nama = '$nama', email = '$email', telp = '$telp', alamat = '$alamat', foto_profil = '$foto_profil' WHERE id_user = '$id_user'");
        } else {
            echo "<script>alert('Gagal mengunggah foto.');</script>";
            return false;
        }
    } else {
        $updatePegawai = mysqli_query($koneksi, 
            "UPDATE supervisor SET nip = '$nip', nama = '$nama', email = '$email', telp = '$telp', alamat = '$alamat' WHERE id_user = '$id_user'");
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




// Fungsi untuk mendapatkan data pegawai
function get_pegawai() {
    global $koneksi;
    $sql = mysqli_query($koneksi, 
            "SELECT user.*, pegawai.* 
            FROM user 
            JOIN pegawai ON user.id_user = pegawai.id_user"
    );
    if (mysqli_num_rows($sql) > 0) {
        return mysqli_fetch_all($sql, MYSQLI_ASSOC); 
    } else {
        return []; 
    }
}


// Get supervisor
function get_supervisor() {
    global $koneksi;

    $sql = mysqli_query($koneksi, 
            "SELECT user.*, supervisor.* 
            FROM user 
            JOIN supervisor ON user.id_user = supervisor.id_user"
    );
    if (mysqli_num_rows($sql) > 0) {
        return mysqli_fetch_all($sql, MYSQLI_ASSOC); 
    } else {
        return [];
    }
}



//get pegawai by id
function get_pegawai_byId($id_user) {
    global $koneksi;

    // Escape id_user untuk menghindari SQL Injection
    $id_user = mysqli_real_escape_string($koneksi, $id_user);

    // Query untuk mendapatkan data dari tabel user dan pegawai
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

//get supervisor by id
function get_supervisor_byId($id_user) {
    global $koneksi;

    // Escape id_user untuk menghindari SQL Injection
    $id_user = mysqli_real_escape_string($koneksi, $id_user);

    // Query untuk mendapatkan data dari tabel user dan supervisor
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


function get_admin_byId(){
    global $koneksi;

    // Escape id_user untuk menghindari SQL Injection
    $id_user = $_GET['id_user'];

    // Query untuk mendapatkan data dari tabel user dan supervisor
    $sql = mysqli_query($koneksi, 
        "SELECT * FROM user WHERE id_user = '$id_user'"
    );
    // Periksa jika ada hasil yang ditemukan
    if (mysqli_num_rows($sql) > 0) {
        return mysqli_fetch_assoc($sql); // Ambil data sebagai array asosiatif
    } else {
        return null; 
    }
}




// ---------------------------------------------------------------------------JURUSAN-

// tambah jurusan
function add_jurusan($data) {
    global $koneksi;

    $jurusan = $data['jurusan'];
    $sql = mysqli_query($koneksi, "INSERT INTO jurusan (id_jurusan, jurusan) VALUES ('', '$jurusan')");
    
    if ($sql) {
        echo "<script>
        alert('Data berhasil ditambahkan!');
        window.location.href = 'http://localhost/SIPELITA-PROJECT/admin/jurusan.php';
    </script>";
    } else {
        echo "<script>alert('Gagal menambahkan jurusan: " . mysqli_error($koneksi) . "');</script>";
    }
}


// get jumlah jurusan
function get_jumlah_jurusan(){
    global $koneksi;

    // Menjalankan query dengan COUNT(*)
    $sql = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jurusan");

    // Mengambil hasil query
    $data = mysqli_fetch_assoc($sql);

    // Mengembalikan jumlah total course
    return $data['total'];
}


// get jurusan
function getall_jurusan(){
    global $koneksi;
    $sql = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY id_jurusan DESC");
    $jurusan = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $jurusan[] = $row;
    }
    return $jurusan;
}





// Prodi --------------------------------

// tambah prodi
function add_prodi($data) {
    global $koneksi;

    $jurusan = $data['jurusan'];
    $prodi = $data['prodi'];
    
    $sql = mysqli_query($koneksi, "INSERT INTO prodi (id_prodi, id_jurusan, prodi) VALUES ('', '$jurusan', '$prodi')");
    
    if ($sql) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            window.location.href = 'http://localhost/SIPELITA-PROJECT/admin/prodi.php';
        </script>";
    } else {
        echo "<script>alert('Gagal menambahkan prodi: " . mysqli_error($koneksi) . "');</script>";
    }
}


// get jumlah prodi
function get_jumlah_prodi(){
    global $koneksi;

    // Menjalankan query dengan COUNT(*)
    $sql = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM prodi");

    // Mengambil hasil query
    $data = mysqli_fetch_assoc($sql);

    // Mengembalikan jumlah total course
    return $data['total'];
}


// get prodi with jurusan
function getall_prodi(){
    global $koneksi;
    $sql = mysqli_query($koneksi, "
        SELECT prodi.*, jurusan.jurusan 
        FROM prodi 
        JOIN jurusan ON prodi.id_jurusan = jurusan.id_jurusan 
        ORDER BY prodi.id_prodi DESC
    ");
    
    $prodi = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $prodi[] = $row;
    }
    return $prodi;
}







?>