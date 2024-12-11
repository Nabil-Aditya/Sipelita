<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipelita - Beranda</title>
    <link rel="icon" type="image/x-icon" href="./img/icon-tittle-sipelita.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index-css.css">

</head>

<body>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            navbarToggler.addEventListener('click', function() {
                this.classList.toggle('active');
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.getElementById("navbar");

            function adjustNavbar() {
                if (window.scrollY > 50) {
                    navbar.classList.add("scrolled");
                } else {
                    navbar.classList.remove("scrolled");
                }
            }

            window.addEventListener("scroll", adjustNavbar);
        });
    </script>


    <nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="./img/sipelita.jpg" alt="Digisiondev Image" class="logo-image">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kenapakami">Kenapa kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <li class="nav-item ms-3 mt-2">
                        <a href="login.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-section text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 hero-content">
                    <h1 class="display-4 mb-4">SIPELITA</h1>
                    <p class="lead mb-4">Aplikasi Sipelita bertujuan menciptakan sistem pelaporan yang efisien, transparan, dan akuntabel, mempermudah Pegawai dan Supervisor dalam menyusun, mengelola, serta memonitor laporan kegiatan.</p>
                    <a href="#layanan" class="btn btn-light btn-lg">Jelajahi Layanan</a>
                </div>
                <div class="col-md-6">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        </div>

                        <!-- Carousel Items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="./img/gambar5.jpg" alt="Digital Services 1" class="d-block w-100 hero-image">
                            </div>
                            <div class="carousel-item">
                                <img src="./img/gambar6.jpg" alt="Digital Services 2" class="d-block w-100 hero-image">
                            </div>
                            <div class="carousel-item">
                                <img src="./img/gambar7.jpg" alt="Digital Services 3" class="d-block w-100 hero-image">
                            </div>
                            <div class="carousel-item">
                                <img src="./img/gambar8.jpg" alt="Digital Services 4" class="d-block w-100 hero-image">
                            </div>
                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Layanan Kami</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card service-card text-center p-4">
                        <div class="service-icon mb-3">
                            <i class="fas fa-solid fa-file-import fa-2x"></i>
                        </div>
                        <h3 class="mb-3">Ajuan Usulan Pelatihan</h3>
                        <p>Buat Pengajuan Pelatihan Dengan Mudah dan cepat.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card text-center p-4">
                        <div class="service-icon mb-3">
                            <i class="fas fa-file-invoice-dollar fa-2x"></i>
                        </div>
                        <h3 class="mb-3">Ajuan Proposal LPJ</h3>
                        <p>Buat Pengajuan LPJ Dengan Mudah dan cepat.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card text-center p-4">
                        <div class="service-icon mb-3">
                            <i class="fas fa-solid fa-bell fa-2x"></i>
                        </div>
                        <h3 class="mb-3">Pemberitaahuan</h3>
                        <p>Pemberitahuan terbaru mengenai Status pengajuan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kenapakami" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Mengapa Memilih Kami?</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="why-item text-center">
                        <div class="why-icon mb-3 animate-bounce">
                            <i class="fas fa-award fa-3x"></i>
                        </div>
                        <h3>Pengalaman Terpercaya</h3>
                        <p>Dengan pengalaman dalam Pembuatan Aplikasi, kami siap memberikan solusi terbaik
                            untuk kebutuhan Anda.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="why-item text-center">
                        <div class="why-icon mb-3 animate-bounce">
                            <i class="fas fa-rocket fa-3x"></i>
                        </div>
                        <h3>Inovasi Berkelanjutan</h3>
                        <p>Kami selalu mengikuti perkembangan teknologi terbaru untuk memberikan solusi yang inovatif
                            dan efektif.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="why-item text-center">
                        <div class="why-icon mb-3 animate-bounce">
                            <i class="fas fa-thumbs-up fa-3x"></i>
                        </div>
                        <h3>Kepuasan Pelanggan</h3>
                        <p>Kepuasan pelanggan adalah prioritas utama kami. Kami berkomitmen untuk memberikan pengalaman
                            terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
<footer id="kontak" class="footer py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>SIPELITA</h4>
                <p>Sistem Informasi Pelaporan Latihan Kegiatan</p>
            </div>
            <div class="col-md-4">
                <h4>Tautan Cepat</h4>
                <ul class="list-unstyled">
                    <li><a href="#beranda" class="text-white text-decoration-none">Beranda</a></li>
                    <li><a href="#layanan" class="text-white text-decoration-none">Layanan</a></li>
                    <li><a href="#kenapakami" class="text-white text-decoration-none">Kenapa Kami</a></li>
                    <li><a href="#kontak" class="text-white text-decoration-none">Kontak</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Kontak</h4>
                <p>Email: sipelita@gmail.com</p>
                <p>Telepon: +62 812-3456-7890</p>
            </div>
        </div>
    </div>
    <div class="map-container mt-3" style="margin:0 10%;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d237.66661578993637!2d101.44901008951264!3d0.47327566565364004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4696be3d3ac84971%3A0x55e23d98264b5c5b!2sDigision.id!5e1!3m2!1sid!2sid!4v1733384318041!5m2!1sid!2sid"
            width="100%" height="280" 
            style="border: 0; display: block;" 
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <p class="text-center mt-2">&copy; Hak Cipta @SIPELITA 2024</p>
</footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>