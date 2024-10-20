<!-- KONEKSI -->
<?php include 'koneksi.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

</head>

<style>
    .nav-tabs .nav-link.active {
        background-color: #4e73df !important;
        color: white !important;
    }

    .sidebar-brand-icon img {
        max-width: 60px;
        height: auto;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Efek bayangan lembut */
    }

    .sipelita-text {
        font-size: 1.3rem;
        /* Ukuran font */
        font-weight: bold;
        /* Membuat teks tebal */
        color: #ffffff;
        /* Warna teks */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        /* Efek timbul pada teks */
    }

    /* Agar label responsif dan menangani teks panjang */
    .custom-file-label {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        /* Tambahkan ... di ujung jika teks terlalu panjang */
        display: block;
        width: 100%;
        /* Sesuaikan dengan lebar parent */
        padding-right: 10px;
        /* Ruang untuk teks tidak mepet */
        box-sizing: border-box;
    }

    /* Warna biru untuk nama file yang dipilih */
    .custom-file-label.selected {
        color: blue;

    }
</style>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background-color: rgb(25, 25, 112);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="./img/sipelita.jpg" alt="Logo" class="img-fluid">
                </div>
                <div class="sidebar-brand-text mx-3 sipelita-text">Sipelita</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Utama
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Pengajuan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilih Opsi:</h6>
                        <a class="collapse-item" href="add_pengajuan_pelatihan.php">Pengajuan Pelatihan</a>
                        <a class="collapse-item active" href="add_pengajuan_lpj.php">Pengajuan LPJ</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Rekapitulasi</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MENU PENGATURAN
            </div>


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengatuan</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilih Opsi:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading mt-4">
                Version
                <p>1.0 Build 15-10-2024</p>
            </div>

        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Pemberitahuan
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Pesan
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid mt-4">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Formulir Pengajuan LPJ</h6>
                        </div>
                        <div class="card-body">
                            <form id="pengajuanForm">
                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lembaga" class="font-weight-bold">Lembaga / Institusi</label>
                                            <input type="text" class="form-control" id="lembaga" placeholder="Masukkan Lembaga / Institusi">
                                        </div>
                                        <div class="form-group">
                                            <label for="programStudi" class="font-weight-bold">Program Studi</label>
                                            <input type="text" class="form-control" id="programStudi" placeholder="Masukkan Program Studi">
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan" class="font-weight-bold">Jurusan</label>
                                            <input type="text" class="form-control" id="jurusan" placeholder="Masukkan Jurusan">
                                        </div>
                                        <div class="form-group">
                                            <label for="namaPeserta" class="font-weight-bold">Nama Peserta</label>
                                            <textarea class="form-control" id="namaPeserta" rows="2" placeholder="Masukkan Nama Peserta"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="font-weight-bold">Tempat / Alamat</label>
                                            <textarea class="form-control" id="alamat" rows="2" placeholder="Masukkan Tempat / Alamat"></textarea>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggalKegiatan" class="font-weight-bold">Tanggal Kegiatan</label>
                                            <input type="date" class="form-control" id="tanggalKegiatan">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggalSelesai" class="font-weight-bold">Tanggal Kegiatan Selesai</label>
                                            <input type="date" class="form-control" id="tanggalSelesai">
                                        </div>
                                        <div class="form-group">
                                            <label for="sumberDana" class="font-weight-bold">Sumber Dana (Virtual Account)</label>
                                            <input type="number" class="form-control" id="sumberDana" placeholder="Masukkan Sumber Dana (Virtual Account)">
                                        </div>
                                        <div class="form-group">
                                            <label for="kompetensi" class="font-weight-bold">Kompetensi</label>
                                            <input type="text" class="form-control" id="kompetensi" placeholder="Masukkan Kompetensi">
                                        </div>
                                        <div class="form-group">
                                            <label for="targetKegiatan" class="font-weight-bold">Target yang ingin dicapai kegiatan</label>
                                            <textarea class="form-control" id="targetKegiatan" rows="2" placeholder="Target yang ingin dicapai kegiatan"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <!-- Teks dan link untuk template pelaporan -->
                                            <p class="mb-2">
                                                <b>Template Pelaporan:</b>
                                                <a href="Template_laporan.DOCX" download="Template_laporan.DOCX" class="text-primary">
                                                    Unduh Template Word
                                                </a>
                                            </p>

                                            <!-- Input untuk unggah file PDF -->
                                            <label for="fileLaporan" class="font-weight-bold text-danger">Unggah File Laporan (PDF)</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="fileLaporan" accept="application/pdf">
                                                    <label class="custom-file-label" for="fileLaporan">Pilih file</label>
                                                </div>
                                            </div>
                                            <small class="text-danger">
                                                Type file: pdf <br> Batas ukuran file: 100 MB
                                            </small>
                                        </div>
                                        <script>
                                            document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                                                var fileName = e.target.files[0].name;
                                                var nextSibling = e.target.nextElementSibling;

                                                // Ubah teks label dengan nama file dan tambahkan kelas 'selected'
                                                nextSibling.innerText = fileName;
                                                nextSibling.classList.add('selected');
                                            });
                                        </script>
                                    </div>
                                </div>
                                <hr>

                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="reset" class="btn btn-danger" id="resetButton">Reset</button>
                                    <button type="submit" class="btn btn-primary">Buat</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- Modal Konfirmasi Pengajuan -->
                <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="m-0 font-weight-bold text-primary" id="konfirmasiModalLabel">Konfirmasi Pengajuan Pelatihan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Lembaga / Institusi:</strong> <span id="confirmLembaga"></span></p>
                                <p><strong>Program Studi:</strong> <span id="confirmProgramStudi"></span></p>
                                <p><strong>Jurusan:</strong> <span id="confirmJurusan"></span></p>
                                <p><strong>Nama Peserta:</strong> <span id="confirmNamaPeserta"></span></p>
                                <p><strong>Alamat:</strong> <span id="confirmAlamat"></span></p>
                                <p><strong>Tanggal Kegiatan:</strong> <span id="confirmTanggalKegiatan"></span></p>
                                <p><strong>Tanggal Selesai:</strong> <span id="confirmTanggalSelesai"></span></p>
                                <p><strong>Sumber Dana:</strong> <span id="confirmSumberDana"></span></p>
                                <p><strong>Kompetensi:</strong> <span id="confirmKompetensi"></span></p>
                                <p><strong>Target Kegiatan:</strong> <span id="confirmTargetKegiatan"></span></p>
                                <p><strong>File Laporan:</strong> <a href="#" target="_blank" id="confirmFileLaporan">Lihat Laporan</a></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" id="submitPengajuan">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

                <!-- SweetAlert2 JS -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <!-- jQuery -->
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

                <script>
                    // Event listener untuk tombol Reset
                    $('#resetButton').on('click', function(event) {
                        event.preventDefault(); // Mencegah form langsung di-reset

                        // Tampilkan SweetAlert untuk konfirmasi reset
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Anda akan mereset semua data yang telah diisi!",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, reset',
                            cancelButtonText: 'Batal',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Jika pengguna memilih "Ya", reset form
                                $('#pengajuanForm')[0].reset(); // Reset form secara manual

                                // Reset input file secara manual
                                $('#fileLaporan').val(null); // Set input file ke null

                                // Reset label file dan hapus kelas 'selected'
                                var fileLabel = $('.custom-file-label');
                                fileLabel.text('Pilih file'); // Mengembalikan teks label ke default
                                fileLabel.removeClass('selected'); // Hapus kelas 'selected' jika ada

                                // SweetAlert otomatis tutup setelah 2500ms tanpa tombol OK
                                Swal.fire({
                                    title: 'Direset!',
                                    text: 'Formulir telah direset.',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2500 // Tutup otomatis setelah 2500ms (2.5 detik)
                                });
                            }
                        });
                    });

                    // Event listener untuk perubahan file input
                    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                        var fileName = e.target.files[0].name;
                        var nextSibling = e.target.nextElementSibling;

                        // Ubah teks label dengan nama file dan tambahkan kelas 'selected'
                        nextSibling.innerText = fileName;
                        nextSibling.classList.add('selected');
                    });
                </script>



                <script>
                    $('#pengajuanForm').on('submit', function(event) {
                        event.preventDefault(); // Mencegah submit form otomatis

                        // Ambil data dari form
                        const lembaga = $('#lembaga').val();
                        const programStudi = $('#programStudi').val();
                        const jurusan = $('#jurusan').val();
                        const namaPeserta = $('#namaPeserta').val();
                        const alamat = $('#alamat').val();
                        const tanggalKegiatan = $('#tanggalKegiatan').val();
                        const tanggalSelesai = $('#tanggalSelesai').val();
                        const sumberDana = $('#sumberDana').val();
                        const kompetensi = $('#kompetensi').val();
                        const targetKegiatan = $('#targetKegiatan').val();
                        const fileLaporan = $('#fileLaporan')[0].files[0]; // Ambil file yang diunggah

                        // Validasi jika ada kolom yang kosong
                        if (!lembaga || !programStudi || !jurusan || !namaPeserta || !alamat ||
                            !tanggalKegiatan || !tanggalSelesai || !sumberDana || !kompetensi ||
                            !targetKegiatan || !fileLaporan) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Semua kolom harus diisi, termasuk file laporan!'
                            });
                            return;
                        }

                        // Validasi format file PDF
                        if (fileLaporan.type !== 'application/pdf') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'File laporan harus berformat PDF!'
                            });
                            return;
                        }

                        // Buat URL untuk file yang diunggah agar bisa ditampilkan
                        const fileUrl = URL.createObjectURL(fileLaporan);

                        // Isi data di modal konfirmasi
                        $('#confirmLembaga').text(lembaga);
                        $('#confirmProgramStudi').text(programStudi);
                        $('#confirmJurusan').text(jurusan);
                        $('#confirmNamaPeserta').text(namaPeserta);
                        $('#confirmAlamat').text(alamat);
                        $('#confirmTanggalKegiatan').text(tanggalKegiatan);
                        $('#confirmTanggalSelesai').text(tanggalSelesai);
                        $('#confirmSumberDana').text(sumberDana);
                        $('#confirmKompetensi').text(kompetensi);
                        $('#confirmTargetKegiatan').text(targetKegiatan);
                        $('#confirmFileLaporan').attr('href', fileUrl); // Set href untuk link file

                        // Munculkan modal konfirmasi
                        $('#konfirmasiModal').modal('show');
                    });

                    // Ketika tombol "Kirim" ditekan, tampilkan notifikasi dan redirect
                    $('#submitPengajuan').on('click', function() {
                        $('#konfirmasiModal').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Pengajuan Pelatihan Berhasil Diajukan',
                            showConfirmButton: false,
                            timer: 2500
                        }).then(() => {
                            window.location.href = 'index.php'; // Redirect setelah sukses
                        });
                    });
                </script>

                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/datatables-demo.js"></script>


</body>

</html>