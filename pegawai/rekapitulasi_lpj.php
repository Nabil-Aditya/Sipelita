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

//notifikasi unread
$unread = count(array_filter($notifikasi, function ($notif) {
    return $notif['is_read'] == 0;
}));



// Read notikasi
if (isset($_POST['read_notifikasi'])) {
    $id_notifikasi = $_POST['id_notifikasi']; // Get the ID from the form submission
    read_notifikasi($id_notifikasi); // Pass the ID to the function
}

// delete_notifikasi);
if (isset($_POST['delete_notifikasi'])) {
    $id_notifikasi = $_POST['id_notifikasi']; // Get the ID from the form submission
    delete_notifikasi($id_notifikasi); // Pass the ID to the function
}


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

//get supervisor sendiri
$supervisor = get_supervisor_byPegawai();



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

if ($_SESSION['role'] === 'admin') {
    echo "<script>window.location.href = '../admin/index.php';</script>";
} else if ($_SESSION['role'] === 'supervisor') {
    echo "<script>window.location.href = '../admin/index.php';</script>";
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
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
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
                        <a class="collapse-item" href="data_pengajuan_pelatihan.php">Pengajuan Pelatihan</a>
                        <a class="collapse-item" href="data_pengajuan_lpj.php">Pengajuan LPJ</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="rekapitulasi_lpj.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Rekapitulasi</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block mt-2">

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

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <?php if ($unread > 0) { ?>
                                    <span class="badge badge-danger badge-counter"><?= $unread ?></span>
                                <?php } ?>

                            </a>

                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown"
                                style="max-height: 300px !important; overflow-y: scroll !important; overflow-x: hidden !important;">
                                <h6 class="dropdown-header">
                                    Pemberitahuan
                                </h6>
                                <?php foreach ($notifikasi as $data) { ?>
                                    <div class="d-flex align-items-center w-100 <?php echo ($data['is_read'] == 1) ? 'bg-kustom' : 'bg-light'; ?>">
                                        <form method="post" class="flex-grow-1 w-100">
                                            <input type="number" name="id_notifikasi" value="<?= $data['id_notifikasi'] ?>" hidden>
                                            <button type="submit" name="read_notifikasi"
                                                class="dropdown-item d-flex align-items-center w-100 <?php echo ($data['is_read'] == 1) ? 'bg-custom' : 'bg-light'; ?>">
                                                <div class="mr-3">
                                                    <div
                                                        class="icon-circle bg-<?php echo (strpos($data['pesan'], 'tolak') !== false) ? 'danger' : (strpos($data['pesan'], 'terima') !== false ? 'success' : 'primary'); ?>">
                                                        <i class="fas fa-file-alt text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between w-100">
                                                    <div>
                                                        <div class="small text-gray-500"><?= $data['tgl'] ?></div>
                                                        <span class="font-weight-bold"><?= $data['pesan'] ?></span>
                                                        <?php if ($data['is_read'] == 0) { ?>
                                                            <span class="unread-indicator"></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>

                                        <?php if ($data['is_read'] == 1) { ?>
                                            <form method="post" class="ml-2">
                                                <input type="hidden" name="id_notifikasi" value="<?= $data['id_notifikasi'] ?>">
                                                <button type="submit" name="delete_notifikasi" class="btn p-0">
                                                    <div class="icon-circle bg-danger text-white ml-1 mr-3"
                                                        style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                                        <i class="fas fa-trash"></i>
                                                    </div>
                                                </button>
                                            </form>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
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
                        <h1 class="h3 mb-0 text-gray-800">Data Pengajuan LPJ</h1>
                        <a href="add_pengajuan_pelatihan.php"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;Buat Pengajuan?
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Pengajuan Diproses) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
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
                        <div class="col-xl-4 col-md-6 mb-4">
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
                        <div class="col-xl-4 col-md-6 mb-4">
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
                                            <button class="nav-link active" id="pelaporan-tab" data-bs-toggle="tab"
                                                data-bs-target="#pelaporan" type="button" role="tab"
                                                aria-controls="pelaporan" aria-selected="false">PELAPORAN</button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <!-- Tabel Pelaporan -->
                                        <div class="tab-pane fade show active" id="pelaporan" role="tabpanel"
                                            aria-labelledby="pelaporan-tab">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="pelaporanTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Institusi</th>
                                                            <th>Kompetensi</th>
                                                            <th>Tgl pengajuan</th>
                                                            <th>Status</th>
                                                            <th>Lihat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1; // Inisialisasi nomor urut
                                                        foreach ($pelaporan as $data) {
                                                            if ($data['pelaporan_status'] === 'Diterima') { ?>
                                                                <tr>
                                                                    <td><?= $no++ ?></td> <!-- Menampilkan dan menambah nomor urut -->
                                                                    <td><?= $data['institusi'] ?></td>
                                                                    <td><?= $data['kompetensi'] ?></td>
                                                                    <td><?= $data['tgl'] ?></td>
                                                                    <td>
                                                                        <span class="status-button accepted">
                                                                            <span class="dot"></span>
                                                                            <?= $data['pelaporan_status'] ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="add_pengajuan_lpj.php?id_pelatihan=<?= $data['id_pelatihan'] ?>">
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fas fa-eye"></i>
                                                                            </button>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        } ?>
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