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

// login function
function login($data)
{
    global $koneksi;

    $username = $data['username'];
    $password = $data['password'];

    // Check the username
    $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    // If username exists in database
    if (mysqli_num_rows($cek_username) === 1) {

        // Get data from username
        $data_from_username = mysqli_fetch_assoc($cek_username);

        if (password_verify($password, $data_from_username['password'])) {

            $_SESSION['username'] = $data_from_username['username'];
            $_SESSION['role'] = $data_from_username['role'];
            $_SESSION['id_user'] = $data_from_username['id_user'];

            // SweetAlert based on role
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
            echo "<script>Swal.fire('Error', 'Kata Sandi Salah', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('Error', 'Nama Pengguna Tidak Ditemukan', 'error');</script>";
    }
}

?>

</body>

</html>