<!DOCTYPE html>
<html lang="en">

<head>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
</head>

<?php
include 'koneksi.php';

// Fungsi login
function login($data)
{
    global $koneksi;

    // Mengambil data 'username' dan 'password' dari input pengguna
    $username = $data['username'];
    $password = $data['password'];

    // Menggunakan prepared statements untuk mencegah SQL injection
    // 'SELECT * FROM user WHERE username = ?' akan mencari data pengguna berdasarkan username
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM user WHERE username = ?");
    
    // Mengikat parameter 's' (string) dari '$username' ke prepared statement
    mysqli_stmt_bind_param($stmt, "s", $username);
    
    // Menjalankan query yang telah dipersiapkan
    mysqli_stmt_execute($stmt);
    
    // Mendapatkan hasil query untuk pengecekan
    $result = mysqli_stmt_get_result($stmt);

    // Memeriksa apakah ada data pengguna dengan username tersebut
    if (mysqli_num_rows($result) === 1) {

        // Mengambil data pengguna berdasarkan username
        $data_from_username = mysqli_fetch_assoc($result);

        // Verifikasi password yang dimasukkan dengan password di database menggunakan password_verify
        if (password_verify($password, $data_from_username['password'])) {

            // Menyimpan informasi pengguna dalam session untuk digunakan dalam aplikasi
            $_SESSION['username'] = $data_from_username['username'];
            $_SESSION['role'] = $data_from_username['role'];
            $_SESSION['id_user'] = $data_from_username['id_user'];

            // Menampilkan SweetAlert berdasarkan peran pengguna yang login
            // Jika role adalah 'pegawai'
            if ($data_from_username['role'] == 'pegawai') {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Anda Berhasil Masuk',
                            showConfirmButton: false,
                            timer: 2500
                        }).then(() => {
                            window.location.href = 'pegawai/index.php';
                        });
                      </script>";
                exit;
            } 
            // Jika role adalah 'supervisor'
            else if ($data_from_username['role'] == 'supervisor') {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Anda Berhasil Masuk',
                            showConfirmButton: false,
                            timer: 2500
                        }).then(() => {
                            window.location.href = 'supervisor/index.php';
                        });
                      </script>";
                exit;
            } 
            // Untuk peran lainnya, misalnya 'admin'
            else {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Anda Berhasil Masuk',
                            showConfirmButton: false,
                            timer: 2500
                        }).then(() => {
                            window.location.href = 'admin/index.php';
                        });
                    </script>";
                exit;
            }
        } 
        // Jika password salah
        else {
            echo "<script>Swal.fire('Proses Masuk Gagal', 'Kata Sandi Anda Salah', 'error');</script>";
        }
    } 
    // Jika username tidak ditemukan
    else {
        echo "<script>Swal.fire('Proses Masuk Gagal', 'Nama Pengguna Tidak Ditemukan', 'error');</script>";
    }

    // Menutup statement untuk membebaskan sumber daya
    mysqli_stmt_close($stmt);
}


?>

</body>

</html>