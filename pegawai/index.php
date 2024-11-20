<!-- KONEKSI -->
<?php
include '../koneksi.php';
include '../loader.php';
include 'function.php';



//logout
if (isset($_POST['logout'])) {
    logout();
}

//notifikasi
$notifikasi = get_notifikasi();
echo "<pre>";
print_r($notifikasi);  // atau var_dump($notifikasi);
echo "</pre>";

//get semua pelatihan
$pelatihan = getall_pelatihan();
$jumlah_pelatihan = count($pelatihan);
$jumlah_pelatihan_diproses = 0;
foreach ($pelatihan as $item) {
    if ($item['status'] === 'Diproses') {
        $jumlah_pelatihan_diproses++;
    }
}
$jumlah_pelatihan_ditolak = 0;
foreach ($pelatihan as $item) {
    if ($item['status'] === 'Ditolak') {
        $jumlah_pelatihan_diproses++;
    }
}
$jumlah_pelatihan_diterima = 0;
foreach ($pelatihan as $item) {
    if ($item['status'] === 'Diterima') {
        $jumlah_pelatihan_diproses++;
    }
}



//get pelaporan
$pelaporan = getall_pelaporan();
$jumlah_pelaporan = count($pelaporan);
$jumlah_pelaporan_diproses = 0;
foreach ($pelaporan as $item) {
    if ($item['status'] === 'Diproses') {
        $jumlah_pelaporan_diproses++;
    }
}
$jumlah_pelaporan_ditolak = 0;
foreach ($pelaporan as $item) {
    if ($item['status'] === 'Ditolak') {
        $jumlah_pelaporan_diproses++;
    }
}
$jumlah_pelaporan_diterima = 0;
foreach ($pelaporan as $item) {
    if ($item['status'] === 'Diterima') {
        $jumlah_pelaporan_diproses++;
    }
}

//get data session login
$login = get_data_user_login();

//tidak boleh mengakses halaman jika belum login
if (!$login) {
    echo "<script>window.location.href = '../login.php';</script>";
}

if ($login['role']) {
    # code...
}

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

// Dapatkan jam saat ini
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

    <title>Dashboard Pegawai</title>
    <link rel="icon" type="image/x-icon" href="../img/icon-tittle-sipelita.jpg">

    <!-- Font khusus untuk templat ini -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Font khusus untuk templat ini -->
    <link href="../css/sb-admin-2.minn.css" rel="stylesheet">
    <!-- Kustom khusus untuk templat ini -->
    <link href="../css/pegawai/index-pegawai.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font khusus untuk templat ini -->
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
                    <span>Beranda</span><?= $_SESSION['id_user'] ?></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Utama
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="add_pengajuan_pelatihan.php">
                    <i class="fas fa-fw fa-file-import"></i>
                    <span>Buat Pengajuan Pelatihan</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Data Pengajuan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilih Opsi:</h6>
                        <a class="collapse-item" href="view_pengajuan_pelatihan.php">Pengajuan Pelatihan</a>
                        <a class="collapse-item" href="view_pengajuan_lpj.php">Pengajuan LPJ</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="rekapitulasi_lpj.php">
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

                                <?php foreach ($notifikasi as $data) { ?>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div
                                            class="icon-circle bg-<?php echo (strpos($data['pesan'], 'tolak') !== false) ? 'danger' : (strpos($data['pesan'], 'terima') !== false ? 'success' : 'primary'); ?>">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?=$data['tgl']?></div>
                                        <span class="font-weight-bold"><?=$data['pesan']?></span>
                                    </div>
                                </a>
                                <?php }?>

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
                                        <img class="rounded-circle" src="../img/undraw_profile_1.svg" alt="...">
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
                                        <img class="rounded-circle" src="../img/undraw_profile_2.svg" alt="...">
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
                                        <img class="rounded-circle" src="../img/undraw_profile_3.svg" alt="...">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"
                                    style="display: inline-block; vertical-align: middle;">
                                    <?= $login['username'] ?>
                                </span>
                                <img class="img-profile rounded-circle obejct-cover"
                                    src="../assets/foto_pegawai/<?= $login['foto_profil'] ?>"
                                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="view_profile.php?id_user=<?= $_SESSION['id_user'] ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Aktivitas
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
                        <a href="add_pengajuan_pelatihan.php"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;Buat Pengajuan?
                        </a>
                    </div>

                    <div class="profile-container" style="display: flex; align-items: center;">
                        <img src="../assets/foto_pegawai/<?= $login['foto_profil'] ?>" alt="Profile Picture"
                            style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; object-position: center; margin-right: 16px;">
                        <div class="profile-text">
                            <h4><?php echo $greeting; ?>, <?= $login['nama'] ?></h4>
                            <p id="timeDisplay">
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

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                DATA PENGAJUAN LPJ</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $jumlah_pelatihan ?>
                                                <!-- Mengambil jumlah pengajuan diproses dari PHP -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Pengajuan Diproses) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                PENGAJUAN DIPROSES</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $jumlah_pelatihan_diproses ?>
                                                <!-- Mengambil jumlah pengajuan diproses dari PHP -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-import fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Pengajuan Diterima) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                PENGAJUAN DITERIMA</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?= $jumlah_pelatihan_diterima ?>
                                                        <!-- Mengambil jumlah pengajuan diterima dari PHP -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests (Pengajuan Ditolak) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                PENGAJUAN DITOLAK</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $jumlah_pelatihan_ditolak ?>
                                                <!-- Mengambil jumlah pengajuan ditolak dari PHP -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-times fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                DATA PELAPORAN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $jumlah_pelaporan ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Pengajuan Diproses) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                PELAPORAN DIPROSES</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $jumlah_pelaporan_diproses ?>
                                                <!-- Mengambil jumlah pengajuan diproses dari PHP -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-import fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Pengajuan Diterima) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                PELAPORAN DITERIMA</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?= $jumlah_pelaporan_diterima ?>
                                                        <!-- Mengambil jumlah pengajuan diterima dari PHP -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests (Pengajuan Ditolak) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                PELAPORAN DITOLAK</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $jumlah_pelaporan_ditolak ?>
                                                <!-- Mengambil jumlah pengajuan ditolak dari PHP -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-times fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <h1 class="h3 mt-4 mb-2 text-gray-800">Riwayat</h1>

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pengajuan-tab" data-bs-toggle="tab"
                                                data-bs-target="#pengajuan" type="button" role="tab"
                                                aria-controls="pengajuan" aria-selected="true">PENGAJUAN</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pelaporan-tab" data-bs-toggle="tab"
                                                data-bs-target="#pelaporan" type="button" role="tab"
                                                aria-controls="pelaporan" aria-selected="false">PELAPORAN</button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <!-- Tabel Pengajuan -->
                                        <div class="tab-pane fade show active" id="pengajuan" role="tabpanel"
                                            aria-labelledby="pengajuan-tab">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="pengajuanTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Institusi</th>
                                                            <th>Kompetensi</th>
                                                            <th>Tgl Pengajuan</th>
                                                            <th>Status</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pelatihan as $data) { ?>

                                                        <tr>
                                                            <td><?= $data['institusi'] ?></td>
                                                            <td><?= $data['kompetensi'] ?></td>
                                                            <td><?= $data['tgl_pengajuan'] ?></td>

                                                                <td>
                                                                    <span
                                                                        class="status-button 
                                                            <?= $data['status'] === 'Diproses' ? 'in-process' : ($data['status'] === 'Ditolak' ? 'rejected' : ($data['status'] === 'Diterima' ? 'accepted' : '')) ?>">
                                                                        <span class="dot"></span>
                                                                        <?= $data['status'] ?>
                                                                    </span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a
                                                                        href="add_pengajuan_lpj.php?id_pelatihan=<?= $data['id_pelatihan'] ?>"><button
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
                                                            <th>Institusi</th>
                                                            <th>Kompetensi</th>
                                                            <th>Tgl pengajuan</th>
                                                            <th>Status</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pelaporan as $data) { ?>
                                                            <tr>
                                                                <td><?= $data['institusi'] ?></td>
                                                                <td><?= $data['kompetensi'] ?></td>
                                                                <td><?= $data['tgl'] ?></td>
                                                                <td>
                                                                    <span
                                                                        class="status-button <?= $data['pelaporan_status'] === 'Belum Mengupload LPJ' ? 'in-belum' : ($data['pelaporan_status'] === 'Diproses' ? 'in-process' : ($data['pelaporan_status'] === 'Ditolak' ? 'rejected' : ($data['pelaporan_status'] === 'Diterima' ? 'accepted' : ''))) ?>">
                                                                        <span class="dot"></span>
                                                                        <?= $data['pelaporan_status'] ?>
                                                                    </span>

                                                                </td>
                                                                <td class="text-center">
                                                                    <a
                                                                        href="add_lpj.php?id_pelatihan=<?= $data['id_pelatihan'] ?>"><button
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
                    <!-- /.container-fluid -->

                    <!-- Inisialisasi DataTables dan Bootstrap Tab -->
                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            // Inisialisasi DataTables di awal
                            $('#pengajuanTable').DataTable();

                            // Saat tab pelaporan diklik, inisialisasi DataTables di tabel pelaporan
                            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                                var target = $(e.target).attr("data-bs-target");

                                if (target === '#pelaporan') {
                                    $('#pelaporanTable').DataTable();
                                }
                            });
                        });
                    </script>

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