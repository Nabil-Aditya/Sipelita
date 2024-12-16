<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman Login</title>
    <link rel="icon" type="image/x-icon" href="./img/icon-tittle-sipelita.jpg">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- styles this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/login.css" rel="stylesheet">

</head>

<?php

include 'function.php';

//login
if (isset($_POST['login'])) {
    login($_POST);
}

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        echo "<script>window.location.href = 'admin/index.php';</script>";
    } else if ($_SESSION['role'] === 'pegawai') {
        echo "<script>window.location.href = 'pegawai/index.php';</script>";
    } else if ($_SESSION['role'] === 'supervisor') {
        echo "<script>window.location.href = 'supervisor/index.php';</script>";
    }
    exit();
}
?>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 custom-shadow my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="./img/sipelita.jpg" alt="Logo" class="img-fluid"> V.1.0
                                <img src="./img/login_img.jpg" alt="Login Image" class="login-image">
                                <div class="text-center mt-1">
                                    <a href="assets/MANUAL-BOOK-SIPELITA.pdf" target="_blank" class="btn btn-link custom-link">Buku Panduan</a>
                                    <a href="https://wa.me/6287842033231" class="btn btn-link custom-link"
                                        target="_blank">Hubungi Kami</a> |
                                    <a href="#" class="btn btn-link custom-link" id="developerTeam">Tim Pengembang</a>
                                </div>
                                <div class="text-center mt-2">
                                    <p class="small-text">Hak Cipta @Sipelita 2024</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-5 custom-heading">Portal Masuk Sipelita</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <span class="bold-black-text">Nama Pengguna</span>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputText" aria-describedby="textHelp" name="username"
                                                placeholder="Masukkan Nama Pengguna..." required>
                                        </div>

                                        <span class="bold-black-text">Kata Sandi</span>
                                        <div class="form-group position-relative">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" id="exampleInputPassword"
                                                placeholder="Masukkan Kata Sandi..." minlength="6" required>
                                            <span class="position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; margin-right: 4px;">
                                                <i class="fa fa-eye-slash" id="togglePassword" style="color: grey;"></i>
                                            </span>
                                        </div>

                                        <span class="bold-black-text">CAPTCHA</span>
                                        <div class="form-group captcha-row">
                                            <div class="captcha-box"><?php echo $_SESSION['captcha']; ?></div>
                                            <input type="text" class="form-control form-control-user captcha-input"
                                                placeholder="Masukkan CAPTCHA..." name="captcha_input" required>
                                        </div>

                                        <button type="submit" name="login"
                                            class="btn btn-primary btn-user btn-block custom-button">
                                            Masuk
                                        </button>
                                    </form>
                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kata sandi dengan mata-->

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#exampleInputPassword");

        togglePassword.addEventListener("click", function() {
            // Toggle tipe input antara password dan text
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Toggle ikon antara fa-eye dan fa-eye-slash
            if (type === "text") {
                this.classList.remove("fa-eye-slash");
                this.classList.add("fa-eye");
                this.style.color = "red"; // Warna biru saat mata terbuka
            } else {
                this.classList.remove("fa-eye");
                this.classList.add("fa-eye-slash");
                this.style.color = "grey"; // Warna abu-abu saat mata tertutup
            }
        });

        // Efek hover untuk ikon
        togglePassword.addEventListener("mouseenter", function() {
            this.style.color = "red"; // Warna biru saat hover
        });

        togglePassword.addEventListener("mouseleave", function() {
            if (passwordField.getAttribute("type") === "password") {
                this.style.color = "grey"; // Kembali ke abu-abu jika password tersembunyi
            } else {
                this.style.color = "red"; // Tetap biru jika password terlihat
            }
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

    <script>
        document.getElementById("developerTeam").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default action of the link

            Swal.fire({
                title: 'Tim Pengembang',
                html: `
            <div class="popup-content">
                <!-- Logo at the center -->
                <img src="./img/sipelita.jpg" alt="Logo" class="popup-logo">
                <hr>
                <!-- Developer team image -->
                <img src="./img/developer.jpg" alt="Tim Pengembang" class="popup-image">
                <!-- Footer content with "Tutup" button -->
                <div class="popup-footer">
                    <button class="swal2-confirm swal2-styled" onclick="Swal.close()">Tutup</button>
                </div>
            </div>
        `,
                showConfirmButton: false, // Hide default confirm button
                showCloseButton: true, // Enable the "X" close button
                customClass: {
                    popup: 'swal2-full-popup', // Custom class untuk memperbesar popup
                }
            });
        });
    </script>


</body>

</html>