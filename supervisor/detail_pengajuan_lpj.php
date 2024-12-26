<!-- KONEKSI -->
<?php 

include '../koneksi.php';
include '../loader.php';
include 'function.php'; 

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

$login = get_data_user_login();




$pelaporan = getall_pelatihan_byIdPelaporan();
$jurusan = getall_jurusan();
$prodi = getall_prodi();
$peserta = get_peserta_pelaporan();
$status = get_status_pelaporan_byId();


//Jika pengajuan pelatihan di tolak, (edit kesalahan)
if (isset($_POST['edit_pelatihan'])) {
    edit_pelatihan($_POST);
}


//Jika pengajuan diterima (buat lpj)
if (isset($_POST['buat_lpj'])) {
    add_lpj($_POST);
}

//get berkas jika sudah mengirim berkas
// $pelaporan = get_berkas_byPelatihan();

if (isset($_POST['status_pelaporan'])) {
    status_pelaporan($_POST);
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

    <title>SIPELITA | Detail Pengajuan LPJ</title>
    <link rel="icon" type="image/x-icon" href="./img/icon-tittle-sipelita.jpg">

    <!-- Font khusus untuk templat ini -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Font khusus untuk templat ini -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Font khusus untuk templat ini -->
    <link href="../css/pegawai/add-pengajuan-lpj.css" rel="stylesheet">

</head>

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
                <a class="nav-link" href="data_pegawai.php">
                    <i class="fas fas fa-user-friends"></i>
                    <span>Data Pegawai</span></a>
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
                                                class="dropdown-item d-flex align-items-center w-100 <?php echo ($data['is_read'] == 1) ? 'bg-kustom' : 'bg-light'; ?>">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $login['username'] ?></span>
                                <img class="img-profile rounded-circle obejct-cover"
                                    src="../assets/foto_supervisor/<?= $login['foto_profil'] ?>"
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
                <div class="container-fluid mt-4">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Formulir Pengajuan LPJ</h6>
                        </div>
                        <div class="card-body">



                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lembaga" class="font-weight-bold">Lembaga / Institusi</label>
                                        <input type="text" class="form-control bg-light-200" id="lembaga"
                                            placeholder="Masukkan Lembaga / Institusi"
                                            value="<?=$pelaporan['institusi']?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="programStudi" class="font-weight-bold">Program Studi</label>
                                        <input type="text" class="form-control bg-light-200" id="programStudi"
                                            placeholder="Masukkan Program Studi" value="<?=$pelaporan['prodi']?>"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="jurusan" class="font-weight-bold">Jurusan</label>
                                        <input type="text" class="form-control bg-light-200" id="jurusan"
                                            placeholder="Masukkan Jurusan" value="<?=$pelaporan['jurusan']?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="peserta" class="font-weight-bold">Peserta</label>
                                        <div id="selectedNames" class="d-flex flex-wrap gap-1">
                                            <?php foreach ($peserta as $data) { ?>
                                            <p
                                                class="badge bg-light text-dark rounded-pill px-3 py-2 border border-secondary">
                                                <?=$data['nama']?></p>
                                            <?php } ?>
                                        </div>
                                        <input type="hidden" name="peserta[]" id="pesertaHidden">
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat" class="font-weight-bold">Tempat / Alamat</label>
                                        <textarea class="form-control bg-light-200" id="alamat" rows="2"
                                            placeholder="Masukkan Tempat / Alamat"
                                            readonly><?=$pelaporan['alamat']?></textarea>
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggalKegiatan" class="font-weight-bold">Tanggal
                                            Kegiatan</label>
                                        <input type="date" class="form-control bg-light-200" id="tanggalKegiatan"
                                            value="<?=$pelaporan['tgl_start']?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggalSelesai" class="font-weight-bold">Tanggal Kegiatan
                                            Selesai</label>
                                        <input type="date" class="form-control bg-light-200" id="tanggalSelesai"
                                            value="<?=$pelaporan['tgl_end']?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="sumberDana" class="font-weight-bold">Sumber Dana (Virtual
                                            Account)</label>
                                        <input type="number" class="form-control bg-light-200" id="sumberDana"
                                            placeholder="Masukkan Sumber Dana (Virtual Account)"
                                            value="<?=$pelaporan['no_dana']?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="kompetensi" class="font-weight-bold">Kompetensi</label>
                                        <input type="text" class="form-control bg-light-200" id="kompetensi"
                                            placeholder="Masukkan Kompetensi" value="<?=$pelaporan['kompetensi']?>"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="targetKegiatan" class="font-weight-bold">Target yang ingin
                                            dicapai kegiatan</label>
                                        <textarea class="form-control bg-light-200" id="targetKegiatan" rows="2"
                                            placeholder="Target yang ingin dicapai kegiatan"
                                            readonly><?=$pelaporan['target']?></textarea>
                                    </div>

                                    <div class="form-group">

                                      <!-- Cek apakah berkas sudah ada -->
    <?php if (isset($pelaporan['berkas']) && !empty($pelaporan['berkas'])) : ?>
        <label for="fileLaporan" class="font-weight-bold text-success">Berkas Laporan (PDF) Tersedia:</label>
        <div class="input-group">
            <a href="../assets/berkas_lpj/<?= $pelaporan['berkas'] ?>"
               target="_blank"
               class="btn btn-primary">
                Lihat Berkas
            </a>
        </div>
        <hr>
        <label for="fileLaporan" class="font-weight-bold text-success">Berkas Sertifikat (PDF) Tersedia:</label>
        <div class="input-group">
            <a href="../assets/sertifikat_lpj/<?= $pelaporan['sertifikat'] ?>"
               target="_blank"
               class="btn btn-primary">
                Lihat Berkas
            </a>
        </div>
    <?php else : ?>
        <label for="fileLaporan" class="font-weight-bold text-danger">*Belum mengupload berkas</label>
    <?php endif; ?>
</div>
                                    <script>
                                    document.querySelector('.custom-file-input').addEventListener('change', function(
                                        e) {
                                        var fileName = e.target.files[0].name;
                                        var nextSibling = e.target.nextElementSibling;

                                        // Ubah teks label dengan nama file yang dipilih
                                        nextSibling.innerText = fileName;
                                    });
                                    </script>

                                </div>
                            </div>
                            <hr>


                            <?php if ($status !== 'Belum Mengupload LPJ' && $status !== 'Diterima' && $status !== 'Ditolak') : ?>
                            <div class="col-12">
                                <form method="post">
                                    <div class="row">
                                        <!-- Kolom Kiri -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="programStudi" class="font-weight-bold">Proses</label>
                                                <select class="form-control" id="programStudi" name="status">
                                                    <option value="" disabled selected>Diterma/Ditolak</option>
                                                    <option value="Diterima">Diterima</option>
                                                    <option value="Ditolak">Ditolak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="targetKegiatan" class="font-weight-bold">Komentar</label>
                                                <textarea class="form-control" id="targetKegiatan" rows="2"
                                                    name="komentar"
                                                    placeholder="Target yang ingin dicapai kegiatan"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" name="status_pelaporan"
                                            class="btn btn-primary">Buat</button>
                                    </div>
                                </form>
                            </div>
                            <hr>
                            <?php endif; ?>

                            <!-- Tombol Aksi -->
                             <div class="d-flex justify-content-between mt-4">
                                <?php 
                                    // Misalnya $status adalah status dari LPJ yang sudah ada
                                    if ($pelaporan['status'] === 'Ditolak' || $pelaporan['status'] === 'Belum Mengupload LPJ') { ?>
                                <a href='index.php' type="button" class="btn btn-danger">Kembali</a>                                        
                                <button type="submit" class="btn btn-primary" name="buat_lpj">Buat</button>
                                <?php } else { ?>
                                <a href='index.php' type="button" class="btn btn-danger">Kembali</a>                                        
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

                <!-- SweetAlert2 JS -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <!-- jQuery -->
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                <a class="btn btn-primary" href="login.php">Keluar</a>
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