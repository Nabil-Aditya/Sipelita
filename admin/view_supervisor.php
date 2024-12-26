<!-- KONEKSI -->
<?php 

include '../koneksi.php'; 
include 'function.php'; 

//get form value
// $get_supervisor_byId = get_pegawai_byId($_GET['id_user']);
$get_supervisor_byId = get_supervisor_byId($_GET['id_user']);


//edit pegawai
if (isset($_POST['edit_pegawai'])) {
    edit_pegawai($_POST, $_GET['id_user']);
}

if (isset($_POST['edit_supervisor'])) {
    edit_supervisor($_POST, $_GET['id_user']);
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

    <title>SIPELITA | Profil Supervisor</title>
    <link rel="icon" type="image/x-icon" href="../img/icon-tittle-sipelita.jpg">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/admin/view-profile.css" rel="stylesheet">

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
            <hr class="sidebar-divider">


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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">admin</span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Profil Supervisor</h6>
                        </div>
                        <div class="card-body">


                            <form method="post" enctype="multipart/form-data" id="pengajuanForm">

                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-12 mb-5">
                                        <div class="form-group d-flex justify-content-center">
                                            <img src="../assets/foto_supervisor/<?=$get_supervisor_byId['foto_profil']?>" alt="Foto"
                                                class="img-fluid rounded-circle"
                                                style="width: 200px; height: 200px; object-fit: cover;">
                                        </div>
                                    </div>

                                    <div class="col-md-6">



                                        <div class="form-group">
                                            <label for="nip" class="font-weight-bold">NIP</label>
                                            <input type="text" class="form-control" id="nip" name="nip"
                                                value="<?=$get_supervisor_byId['nip']?>" placeholder="Masukkan NIP">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="font-weight-bold">Nama </label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                value="<?=$get_supervisor_byId['nama']?>" placeholder="Masukkan Nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan" class="font-weight-bold">Jabatan</label>
                                            <select class="form-control" id="jabatan" name="jabatan">
                                                <option value="">Pilih Jabatan</option>
                                                <option value="pegawai"
                                                    <?= ($get_supervisor_byId['role'] == 'pegawai') ? 'selected' : '' ?>>
                                                    Pegawai</option>
                                                <option value="supervisor"
                                                    <?= ($get_supervisor_byId['role'] == 'supervisor') ? 'selected' : '' ?>>
                                                    Supervisor</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="font-weight-bold">Email </label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="<?=$get_supervisor_byId['email']?>" placeholder="Masukkan Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="telp" class="font-weight-bold">Telp </label>
                                            <input type="text" class="form-control" id="telp" name="telp"
                                                value="<?=$get_supervisor_byId['telp']?>" placeholder="Masukkan Telp">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="font-weight-bold">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                                placeholder="Masukkan Alamat"><?=$get_supervisor_byId['alamat']?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="fileLaporan" class="font-weight-bold">Foto Profil</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="fileLaporan"
                                                        name="foto_profil" accept=".jpg, .jpeg, .png">
                                                    <label class="custom-file-label" for="fileLaporan">Pilih
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username" class="font-weight-bold">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="<?=$get_supervisor_byId['username']?>">
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between">
        <!-- Tombol Ubah Password -->
        <button type="button" id="ubahPasswordBtn" class="btn btn-secondary">Ubah Password</button>
        
        <!-- Pembatas -->
        <div style="border-left: 2px solid #ddd; height: 24px; margin: 0 15px;"></div>
        
        <!-- Tombol Hapus Akun -->
        <a href="index.php" class="btn btn-danger">Hapus Akun</a>
    </div>

                                        <div id="passwordFields" style="display: none;">
                                            <div class="form-group">
                                                <label for="old_password" class="font-weight-bold">Password Lama</label>
                                                <input type="password" class="form-control" id="old_password"
                                                    name="old_password" placeholder="Masukkan Password Lama">
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="font-weight-bold">Password Baru</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Masukkan Password Baru">
                                            </div>
                                            <div class="form-group">
                                                <label for="password2" class="font-weight-bold">Konfirmasi Password
                                                    Baru</label>
                                                <input type="password" class="form-control" id="password2"
                                                    name="password2" placeholder="Konfirmasi Password Baru">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <!-- Tombol Aksi -->
                              <div class="d-flex justify-content-between mt-4">
                                    <a href='index.php' type="button" class="btn btn-danger">Kembali</a>
                                    <button type="submit" name="edit_supervisor" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
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
                </script>



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

                <script>
                // Update nama file pada label ketika file dipilih
                document.getElementById('fileLaporan').addEventListener('change', function() {
                    const fileName = this.files[0] ? this.files[0].name : "Pilih file";
                    this.nextElementSibling.textContent = fileName;
                });
                </script>



                <script>
                document.getElementById('ubahPasswordBtn').addEventListener('click', function() {
                    const passwordFields = document.getElementById('passwordFields');
                    if (passwordFields.style.display === 'none' || passwordFields.style
                        .display === '') {
                        passwordFields.style.display = 'block';
                        this.textContent = 'Batal Ubah Password';
                        this.classList.remove('btn-secondary');
                        this.classList.add('btn-danger');
                    } else {
                        passwordFields.style.display = 'none';
                        this.textContent = 'Ubah Password';
                        this.classList.remove('btn-danger');
                        this.classList.add('btn-secondary');

                        // Reset nilai input saat dibatalkan
                        document.getElementById('old_password').value = '';
                        document.getElementById('password').value = '';
                        document.getElementById('password2').value = '';
                    }
                });
                </script>

</body>

</html>