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




// get pegawai 1
// function get_pegawai(){
//     global $koneksi;
//     $sql = mysqli_query($koneksi, "SELECT * FROM pegawai");
//     $jurusan = [];
//     while ($row = mysqli_fetch_assoc($sql)) {
//         $jurusan[] = $row;
//     }
//     return $jurusan;
// }


// get pegawai 2
function get_pegawai() {
    global $koneksi;

    // Query untuk mendapatkan data dari tabel user dan pegawai
    $sql = mysqli_query($koneksi, 
        "SELECT user.*, pegawai.* 
         FROM user 
         JOIN pegawai ON user.id_user = pegawai.id_pegawai"
    );

    // Periksa jika ada hasil yang ditemukan
    if (mysqli_num_rows($sql) > 0) {
        return mysqli_fetch_all($sql, MYSQLI_ASSOC); // Ambil semua data sebagai array asosiatif
    } else {
        return []; // Kembalikan array kosong jika tidak ada data
    }
}












// ---------------------------------------------------------------------------JURUSAN-

// tambah jurusan
function add_jurusan($data) {
    global $koneksi;

    $jurusan = $data['jurusan'];
    $sql = mysqli_query($koneksi, "INSERT INTO jurusan (id_jurusan, jurusan) VALUES ('', '$jurusan')");
    
    if ($sql) {
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
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
    $sql = mysqli_query($koneksi, "SELECT * FROM jurusan");
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
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
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


// get prodi
function getall_prodi(){
    global $koneksi;
    $sql = mysqli_query($koneksi, "SELECT * FROM prodi");
    $prodi = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $prodi[] = $row;
    }
    return $prodi;
}






?>