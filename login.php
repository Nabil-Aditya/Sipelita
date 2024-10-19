<?php
session_start();

// Generate random 5-digit number for CAPTCHA
$_SESSION['captcha'] = rand(10000, 99999);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 100%;
            padding: 0 15px;
        }

        .login-image {
            width: 100%;
            height: auto;
            margin-top: 5%;
            margin-left: 2%;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .login-image {
                padding: 10px;
            }
        }

        @media (max-width: 576px) {
            .login-image {
                padding: 5px;
            }
        }

        .bold-black-text {
            color: black;
            font-weight: bold;
        }

        .small-text {
            font-size: 12px;
        }

        .custom-link {
            color: rgb(25, 25, 112);
            text-decoration: none;
            font-size: 13px;
        }

        .custom-link:hover {
            text-decoration: underline;
        }

        .custom-button {
            background-color: rgb(25, 25, 112);
            border-color: rgb(25, 25, 112);
        }

        .custom-button:hover {
            background-color: rgb(0, 40, 199);
            border-color: rgb(0, 0, 139);
        }

        .custom-heading {
            color: rgb(25, 25, 112);
            font-weight: bold;
            font-size: 25px;
        }

        .card.custom-shadow {
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.5);
        }

        /* Styling for CAPTCHA layout */
        .form-group.captcha-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Styling for the CAPTCHA box */
        .captcha-box {
            display: inline-block;
            padding: 10px;
            background-color: #E7F0FE;
            font-weight: bold;
            font-size: 18px;
            border-radius: 20%;
            /* Rounded borders */
            color: red;
            width: 100px;
            text-align: center;

            /* Prevent text selection and copying */
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        .captcha-input {
            flex-grow: 1;
        }

        .img-fluid {
            margin-top: 5%;
            width: 15%;
            /* Sesuaikan persentase sesuai kebutuhan */
            border-radius: 8px;
            margin-left: 14%;
        }
    </style>

</head>

<body class="bg-gradient-warning">

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
                                    <a href="#" class="btn btn-link custom-link">Buku Panduan</a> |
                                    <a href="#" class="btn btn-link custom-link">Hubungi Kami</a> |
                                    <a href="#" class="btn btn-link custom-link">Tim Pengembang</a>
                                </div>
                                <div class="text-center mt-2">
                                    <p class="small-text">Hak Cipta @Sipelita 2024</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-5 custom-heading">Sistem Informasi Pelaporan Latihan Kegiatan</h1>
                                    </div>
                                    <form class="user" method="post" action="index.php">

                                        <span class="bold-black-text">Nama Pengguna</span>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Masukkan Nama Pengguna..." required>
                                        </div>

                                        <span class="bold-black-text">Kata Sandi</span>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Masukkan Kata Sandi..." required>
                                        </div>

                                        <!-- CAPTCHA Section with Two Columns -->
                                        <span class="bold-black-text">CAPTCHA</span>
                                        <div class="form-group captcha-row">
                                            <div class="captcha-box"><?php echo $_SESSION['captcha']; ?></div>
                                            <input type="text" class="form-control form-control-user captcha-input" placeholder="Masukkan CAPTCHA..." name="captcha_input">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block custom-button">
                                            Masuk
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="custom-link" href="forgot-password.php">Lupa Kata Sandi?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>