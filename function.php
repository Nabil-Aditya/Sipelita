<!DOCTYPE html>
<html lang="en">

<head>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
</head>

<?php
session_start();
include 'koneksi.php';

// Fungsi untuk membuat CAPTCHA
if (!isset($_SESSION['captcha'])) {
    $buat_captcha = rand(10000, 99999);
    $_SESSION['captcha'] = $buat_captcha;
}
function login($data)
{
    global $koneksi;

    // Mengambil data dari input pengguna
    $username = $data['username'];
    $password = $data['password'];
    $captcha_input = (int)$data['captcha_input']; // Konversi ke integer

    // Verifikasi CAPTCHA
    if (!isset($_SESSION['captcha']) || $captcha_input !== $_SESSION['captcha']) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Proses Masuk Gagal',
                    text: 'CAPTCHA yang Anda masukkan salah.',
                    showConfirmButton: true
                });
              </script>";
        // Buat CAPTCHA baru setelah percobaan gagal
        $_SESSION['captcha'] = rand(10000, 99999);
        return false;
    }

    // Reset CAPTCHA setelah verifikasi
    $_SESSION['captcha'] = rand(10000, 99999);

    // Menggunakan prepared statements untuk mencegah SQL injection
    // Menambahkan BINARY untuk membuat perbandingan username case-sensitive
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM user WHERE BINARY username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $data_from_username = mysqli_fetch_assoc($result);

        if (password_verify($password, $data_from_username['password'])) {
            $_SESSION['username'] = $data_from_username['username'];
            $_SESSION['role'] = $data_from_username['role'];
            $_SESSION['id_user'] = $data_from_username['id_user'];

            // Redirect berdasarkan role
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
            } else if ($data_from_username['role'] == 'supervisor') {
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
            } else {
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
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Proses Masuk Gagal',
                        text: 'Kata sandi Anda salah.',
                        showConfirmButton: true
                    });
                  </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Proses Masuk Gagal',
                    text: 'Nama pengguna tidak ditemukan.',
                    showConfirmButton: true
                });
              </script>";
    }

    mysqli_stmt_close($stmt);
    return false;
}
function logout()
{
    session_unset();
    session_destroy();
    echo "<script>alert('Logout'); window.location.href='login.php'</script>";
}

?>

</body>

</html>