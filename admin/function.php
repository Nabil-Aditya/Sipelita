<?php

include '../koneksi.php';



// -------------------------------------------------------------------PEGAWAI

// tambah pegawai
function tambah_pegawai($data)
{
    global $koneksi;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);


    $nip = $data['nip'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $jabatan = $data['jabatan'];
    $email = $data['email'];
    $telp = $data['telp'];


    $foto_profil = $_FILES['foto_profil']['name'];
    $tmpname = $_FILES['foto_profil']['tmp_name'];
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/pelita/SIPELITA-PROJECT/foto_pegawai/' . $foto_profil;


    //cek apakah ada username yang sama
    $cek_username = mysqli_query($koneksi, "SELECT * from user WHERE username = '$username';");
    if (mysqli_fetch_assoc($cek_username)) {
        echo "<script>alert('Username Tidak Tersedia');</script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>alert('Mohon konfirmasikan password dengna benar')</script>";
        return false;
    }

    // enkripsi password 
    $password = password_hash($password, PASSWORD_DEFAULT);

    // insert ke database
    // 1. Ke tabel user
    $ke_user = mysqli_query($koneksi, "INSERT INTO user (id_user, username, password, role) VALUES (NULL, '$username', '$password', '$jabatan')");
    if ($ke_user) {
        echo "<script>alert('Berhasil update data ke user')</script>";
    }
    

    // 2. Ke tabel pegawai
    $id_dari_user = mysqli_insert_id($koneksi);

    if  (move_uploaded_file($tmpname, $folder)) {
        $sql = mysqli_query($koneksi, "INSERT INTO pegawai (id_pegawai, id_user, nip, nama, alamat, telp, email, foto_profil) VALUES ('', '$id_dari_user', '$nip', '$nama', '$alamat', '$telp', '$email', '$foto_profil')");
        if ($sql) {
            echo "<script>alert('Register Success!'); window.location.href='index.php';</script>";
            // return mysqli_affected_rows($koneksi);
        } else {
            echo "<script>alert('gagal')</script>";
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

    // Penanganan upload foto profil
    $foto_profil = $_FILES['foto_profil']['name'];
    $tmpname = $_FILES['foto_profil']['tmp_name'];
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/github/SIPELITA-PROJECT/foto_pegawai/' . $foto_profil;

    // Ambil username lama dari database
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE id_user = '$id_user'");
    $currentData = mysqli_fetch_assoc($result);
    $currentUsername = $currentData['username'];

    // Cek apakah ada username yang sama, kecuali username milik user yang sedang diupdate
    if ($username !== $currentUsername) {
        $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
        if (mysqli_fetch_assoc($cek_username)) {
            echo "<script>alert('Username tidak tersedia.');</script>";
            return false;
        }
    }

    // Cek konfirmasi password
    if (!empty($password) && $password !== $password2) {
        echo "<script>alert('Mohon konfirmasikan password dengan benar');</script>";
        return false;
    }

    // Update tabel user
    if (!empty($password)) {
        // Enkripsi password jika diubah
        $password = password_hash($password, PASSWORD_DEFAULT);
        $updateUser = mysqli_query($koneksi, "UPDATE user SET username = '$username', password = '$password', role = '$jabatan' WHERE id_user = '$id_user'");
    } else {
        // Update hanya username dan role jika password tidak diubah
        $updateUser = mysqli_query($koneksi, "UPDATE user SET username = '$username', role = '$jabatan' WHERE id_user = '$id_user'");
    }

    // Update tabel pegawai
    if ($foto_profil) {
        // Jika ada file foto baru, pindahkan file dan update dengan nama file baru
        if (move_uploaded_file($tmpname, $folder)) {
            $updatePegawai = mysqli_query($koneksi, 
                "UPDATE pegawai SET nip = '$nip', nama = '$nama', email = '$email', telp = '$telp', alamat = '$alamat', foto_profil = '$foto_profil' WHERE id_user = '$id_user'");
        } else {
            echo "<script>alert('Gagal upload foto.');</script>";
            return false;
        }
    } else {
        // Update data pegawai tanpa mengubah kolom foto
        $updatePegawai = mysqli_query($koneksi, 
            "UPDATE pegawai SET nip = '$nip', nama = '$nama', email = '$email', telp = '$telp', alamat = '$alamat' WHERE id_user = '$id_user'");
    }

    // Cek apakah update berhasil di kedua tabel
    if ($updateUser && $updatePegawai) {
        $_SESSION['username'] = $username; // Update session username jika diperlukan
        echo "<script>alert('Account updated successfully!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Failed to update account.');</script>";
    }
}



// Fungsi untuk mendapatkan data pegawai
function get_pegawai() {
    global $koneksi;
    $sql = mysqli_query($koneksi, 
            "SELECT user.*, pegawai.* 
            FROM user 
            JOIN pegawai ON user.id_user = pegawai.id_user
            WHERE user.role = 'pegawai'"
            
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
            "SELECT user.*, pegawai.* 
            FROM user 
            JOIN pegawai ON user.id_user = pegawai.id_user
            WHERE user.role = 'supervisor'"
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