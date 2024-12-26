<!-- KONEKSI -->
<?php include 'function.php';

$supervisor = get_supervisor();

// tambah pegawai
if (isset($_POST['tambah_pegawai'])) {
    tambah_pegawai($_POST);
}

//get data session login
$login = get_data_user_login();


//logout
if (isset($_POST['logout'])) {
    logout();
}



$get_pegawai = get_pegawai();
$get_supervisor = get_supervisor();



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIPELITA | Tambah Pegawai</title>
    <link rel="icon" type="image/x-icon" href="../img/icon-tittle-sipelita.jpg">

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
            <li class="nav-item active">
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
                <div class="container-fluid mt-4">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Pegawai</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" id="pengajuanForm">
                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nip" class="font-weight-bold">NIP</label>
                                            <input type="text" class="form-control" id="nip" name="nip"
                                                placeholder="Masukkan NIP" minlength="10" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="font-weight-bold">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan" class="font-weight-bold">Jabatan</label>
                                            <select class="form-control" id="jabatan" name="jabatan" onchange="toggleSupervisorSelect()" required>
                                                <option value="">Pilih Jabatan</option>
                                                <option value="pegawai">Pegawai</option>
                                                <option value="supervisor">Supervisor</option>
                                            </select>
                                        </div>
                                        <!-- Dropdown tambahan untuk supervisor -->
                                        <div class="form-group" id="supervisorSelectContainer" style="display: none;">
                                            <label for="supervisor" class="font-weight-bold">Nama Supervisor</label>
                                            <select class="form-control" id="supervisor" name="supervisor">
                                                <option value="">Pilih Supervisor</option>
                                                <?php foreach ($supervisor as $key) { ?>
                                                    <option value="<?= $key['id_supervisor'] ?>"><?= $key['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="font-weight-bold">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telp" class="font-weight-bold">Telp</label>
                                            <input type="text" class="form-control" id="telp" name="telp"
                                                placeholder="Masukkan Telp" minlength="12" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="font-weight-bold">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat" required></textarea>
                                        </div>
                                        <label for="fileLaporan" class="font-weight-bold">Foto Profil</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="fileLaporan" name="foto_profil" accept=".jpg, .jpeg, .png" required>
                                                <label class="custom-file-label" for="fileLaporan">Pilih file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username" class="font-weight-bold">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="font-weight-bold">Password</label>
                                            <input type="password" class="form-control" minlength="6" id="password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password2" class="font-weight-bold">Konfirmasi Password</label>
                                            <input type="password" class="form-control" id="password2" name="password2" required>
                                            <small id="passwordError" class="text-danger" style="display: none;">Password tidak cocok!</small>
                                        </div>

                                        <script>
                                            document.getElementById('password2').addEventListener('input', function() {
                                                const password = document.getElementById('password').value;
                                                const password2 = this.value;
                                                const error = document.getElementById('passwordError');

                                                if (password2 !== password) {
                                                    this.classList.add('is-invalid');
                                                    error.style.display = 'block';
                                                } else {
                                                    this.classList.remove('is-invalid');
                                                    error.style.display = 'none';
                                                }
                                            });
                                        </script>

                                    </div>
                                </div>
                                <hr>
                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-between mt-4">
                                    <a href='index.php' type="button" class="btn btn-danger">Kembali</a>
                                    <button type="submit" name="tambah_pegawai" class="btn btn-primary">Buat</button>
                                </div>
                            </form>

                            <script>
                                function toggleSupervisorSelect() {
                                    var jabatan = document.getElementById("jabatan").value;
                                    var supervisorSelectContainer = document.getElementById("supervisorSelectContainer");
                                    if (jabatan === "pegawai") {
                                        supervisorSelectContainer.style.display = "block";
                                    } else {
                                        supervisorSelectContainer.style.display = "none";
                                    }
                                }
                            </script>

                        </div>
                    </div>
                </div>

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