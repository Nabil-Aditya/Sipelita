<!-- KONEKSI -->
<?php

include '../koneksi.php';
include 'function.php';


//get data session login
$login = get_data_user_login();


//logout
if (isset($_POST['logout'])) {
    logout();
}

$get_pegawai = get_pegawai();
$get_supervisor = get_supervisor();

?>

<?php
date_default_timezone_set('Asia/Jakarta'); // Sesuaikan timezone jika diperlukan

// Mengambil nama hari dalam Bahasa Indonesia
function getIndonesianDayName($dayName)
{
    $dayNames = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    );
    return $dayNames[$dayName];
}

// Get current hour
$currentHour = date('H');

$greeting = "Selamat Pagi";

if ($currentHour >= 0 && $currentHour < 12) {
    $greeting = "Selamat Pagi";
} elseif ($currentHour >= 12 && $currentHour < 18) {
    $greeting = "Selamat Siang";
} else {
    $greeting = "Selamat Malam";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIPELITA | Beranda Admin</title>
    <link rel="icon" type="image/x-icon" href="../img/icon-tittle-sipelita.jpg">

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- styles this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/admin/index-admin.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Memastikan DataTables.js sudah di-link -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js">
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background-color: rgb(25, 25, 112);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="../img/sipelita.jpg" alt="Logo" class="img-fluid">
                </div>
                <div class="sidebar-brand-text mx-3 sipelita-text">Sipelita</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
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

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="add_pegawai.php">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Tambah Pegawai</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Kelola Pengguna</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilih Opsi:</h6>
                        <a class="collapse-item" href="view_pegawai.php">Pegawai</a>
                        <a class="collapse-item" href="view_supervisor.php">Supervisor</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - jurusan Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsejurusan"
                    aria-expanded="true" aria-controls="collapsejurusan">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>kelola Jurusan</span>
                </a>
                <div id="collapsejurusan" class="collapse" aria-labelledby="headingjurusan"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilih Opsi:</h6>
                        <a class="collapse-item" href="jurusan.php">Data Jurusan</a>
                        <a class="collapse-item" href="add_jurusan.php">Tambah Jurusan</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - prodi Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseprodi"
                    aria-expanded="true" aria-controls="collapseprodi">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>kelola Prodi</span>
                </a>
                <div id="collapseprodi" class="collapse" aria-labelledby="headingprodi" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilih Opsi:</h6>
                        <a class="collapse-item" href="prodi.php">Data Prodi</a>
                        <a class="collapse-item" href="add_prodi.php">Tambah Prodi</a>
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

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $login['username'] ?></span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="view_profile.php?id_user=<?= $_SESSION['id_user'] ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
                        <a href="add_pegawai.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;Tambah Pegawai?
                        </a>
                    </div>

                    <div class="profile-container">
                        <img src="../img/undraw_profile.svg" alt="Profile Picture" class="profile-img">
                        <div class="profile-text">
                            <h4><?php echo $greeting; ?>, <?= $login['username'] ?>!</h4>
                            <p id="timeDisplay">
                                <!-- Tampilkan waktu awal dengan PHP -->
                                <?php echo getIndonesianDayName(date('l')) . ', ' . date('j F Y') . ', ' . date('H:i:s'); ?>
                            </p>
                        </div>
                    </div>

                    <script>
                        function updateClock() {
                            // Buat objek tanggal baru
                            var now = new Date();

                            // Ambil elemen untuk menampilkan waktu
                            var timeDisplay = document.getElementById("timeDisplay");

                            // Array untuk nama hari dalam bahasa Indonesia
                            var dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

                            // Ambil hari, tanggal, bulan, tahun, jam, menit, dan detik
                            var day = dayNames[now.getDay()];
                            var date = now.getDate();
                            var month = now.toLocaleString('id-ID', {
                                month: 'long'
                            }); // Nama bulan dalam bahasa Indonesia
                            var year = now.getFullYear();
                            var hours = now.getHours().toString().padStart(2, '0');
                            var minutes = now.getMinutes().toString().padStart(2, '0');
                            var seconds = now.getSeconds().toString().padStart(2, '0');

                            // Format waktu
                            var formattedTime = day + ', ' + date + ' ' + month + ' ' + year + ', ' + hours + ':' +
                                minutes + ':' + seconds;

                            // Update elemen HTML dengan waktu terbaru
                            timeDisplay.textContent = formattedTime;
                        }

                        // Jalankan updateClock setiap detik
                        setInterval(updateClock, 1000);

                        // Panggil fungsi sekali untuk menampilkan waktu segera setelah halaman dimuat
                        updateClock();
                    </script>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (jumlah supervisor) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                JUMLAH AKUN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                2
                                                <!-- Mengambil jumlah supervisor dari PHP -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (jumlah akun supervisor) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                JUMLAH SUPERVISOR</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                1
                                                <!-- Mengambil jumlah akun supervisor dari PHP -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (akun aktif supervisor) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                JUMLAH PEGAWAI</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        1
                                                        <!-- Mengambil jumlah akun yang aktif dari PHP -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                             <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <h1 class="h3 mt-4 mb-2 text-gray-800">Daftar akun</h1>

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pengajuan-tab" data-bs-toggle="tab"
                                                data-bs-target="#pengajuan" type="button" role="tab"
                                                aria-controls="pengajuan" aria-selected="true">PEGAWAI</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pelaporan-tab" data-bs-toggle="tab"
                                                data-bs-target="#pelaporan" type="button" role="tab"
                                                aria-controls="pelaporan" aria-selected="false">SUPERVISOR</button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <!-- Tabel Pegawai -->
                                        <div class="tab-pane fade show active" id="pengajuan" role="tabpanel"
                                            aria-labelledby="pengajuan-tab">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="pengajuanTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>NIP</th>
                                                            <th>Nama</th>
                                                            <th>Telp</th>
                                                            <th>Email</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        foreach ($get_pegawai as $data) { ?>
                                                            <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td><?= $data['nip'] ?></td>
                                                                <td><?= $data['nama'] ?></td>
                                                                <td><?= $data['telp'] ?></td>
                                                                <td><?= $data['email'] ?></td>
                                                                <td class="text-center">
                                                                    <a
                                                                        href="view_pegawai.php?id_user=<?= $data['id_user'] ?>"><button
                                                                            class="btn btn-primary btn-sm">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Tabel Pelaporan -->
                                        <div class="tab-pane fade" id="pelaporan" role="tabpanel"
                                            aria-labelledby="pelaporan-tab">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="pelaporanTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>NIP</th>
                                                            <th>Nama</th>
                                                            <th>Telp</th>
                                                            <th>Email</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        foreach ($get_supervisor as $data) { ?>
                                                            <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td><?= $data['nip'] ?></td>
                                                                <td><?= $data['nama'] ?></td>
                                                                <td><?= $data['telp'] ?></td>
                                                                <td><?= $data['email'] ?></td>
                                                                <td class="text-center">
                                                                    <a
                                                                        href="view_supervisor.php?id_user=<?= $data['id_user'] ?>"><button
                                                                            class="btn btn-primary btn-sm">
                                                                            <i class="fas fa-eye"></i>
                                                                    </button></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Hak Cipta &copy;Sipelita 2024</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->
                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Yakin Untuk Keluar?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Pilih "Keluar" di bawah jika Anda siap untuk mengakhiri
                            sesi Anda saat ini.</div>
                        <div class="modal-footer">
                            <form method="post">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                <button class="btn btn-primary" type="submit" name="logout">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="../vendor/jquery/jquery.min.js"></script>
            <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>