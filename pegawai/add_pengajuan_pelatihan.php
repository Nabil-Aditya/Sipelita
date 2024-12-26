<!-- KONEKSI -->
<?php
include '../koneksi.php';
include '../loader.php';
include 'function.php';

$jurusan = getall_jurusan();
$prodi = getall_prodi();
$pegawai = getall_pegawai();


if (isset($_POST['create_pelatihan'])) {
    pengajuan_pelatihan($_POST);
}

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

    <title>SIPELITA | Buat Pengajuan Pelatihan</title>
    <link rel="icon" type="image/x-icon" href="../img/icon-tittle-sipelita.jpg">

    <!-- Font khusus untuk templat ini -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            <li class="nav-item active">
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
            <li class="nav-item">
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
<div class="container-fluid mt-4">
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Pengajuan Pelatihan</h6>
        </div>
        <div class="card-body">
            <form method="post" id="formPengajuan">
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lembaga" class="font-weight-bold">Lembaga / Institusi</label>
                            <input type="text" class="form-control" id="lembaga" name="institusi" placeholder="Masukkan Lembaga / Institusi" required>
                        </div>
                        <div class="form-group">
                            <label for="jurusan" class="font-weight-bold">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan" required>
                                <option value="" disabled selected>Pilih Jurusan</option>
                                <?php foreach ($jurusan as $data) { ?>
                                    <option value="<?= $data['id_jurusan'] ?>"><?= $data['jurusan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prodi" class="font-weight-bold">Prodi</label>
                            <select class="form-control" id="prodi" name="prodi" required>
                                <option value="" disabled selected>Pilih prodi</option>
                                <?php foreach ($prodi as $data) { ?>
                                    <option value="<?= $data['id_prodi'] ?>"><?= $data['prodi'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="peserta" class="font-weight-bold">Peserta</label>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih Nama
                                </button>
                                <ul class="dropdown-menu dropdown-search" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <input type="text" id="searchInput" class="form-control mb-2" placeholder="Cari nama..."/>
                                    </li>
                                    <?php foreach ($pegawai as $data) {
                                        // Filter hanya menampilkan pegawai dengan ID valid
                                        if ($data['id_pegawai'] > 0) { ?>
                                            <li class="dropdown-item" data-value="<?= $data['nama'] ?>" data-id="<?= $data['id_pegawai'] ?>"><?= $data['nama'] ?></li>
                                        <?php }
                                    } ?>
                                </ul>
                            </div>

                            <p class="mt-3">Nama Terpilih:</p>
                            <div id="selectedNames" class="selected-names-container mt-2">
                                <!-- Nama yang dipilih akan muncul di sini -->
                            </div>
                            <input type="hidden" name="peserta[]" id="pesertaHidden" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="font-weight-bold">Tempat / Alamat</label>
                            <textarea class="form-control" id="alamat" rows="2" name="alamat" placeholder="Masukkan Tempat / Alamat" required></textarea>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggalKegiatan" class="font-weight-bold">Tanggal Kegiatan</label>
                            <input type="date" class="form-control" id="tanggalKegiatan" name="tgl_start" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggalSelesai" class="font-weight-bold">Tanggal Kegiatan Selesai</label>
                            <input type="date" class="form-control" id="tanggalSelesai" name="tgl_end" required>
                        </div>
                        <div class="form-group">
                            <label for="sumberDana" class="font-weight-bold">Sumber Dana (Virtual Account)</label>
                            <input type="number" class="form-control" id="sumberDana" name="no_dana" placeholder="Masukkan Sumber Dana (Virtual Account)" required>
                        </div>
                        <div class="form-group">
                            <label for="kompetensi" class="font-weight-bold">Kompetensi</label>
                            <input type="text" class="form-control" id="kompetensi" name="kompetensi" placeholder="Masukkan Kompetensi" required>
                        </div>
                        <div class="form-group">
                            <label for="targetKegiatan" class="font-weight-bold">Target yang ingin dicapai kegiatan</label>
                            <textarea class="form-control" id="targetKegiatan" rows="2" name="target" placeholder="Target yang ingin dicapai kegiatan" required></textarea>
                        </div>
                    </div>
                </div>
                <hr>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between mt-4">
                    <a href='index.php' type="button" class="btn btn-danger">Kembali</a>
                    <button type="submit" name="create_pelatihan" class="btn btn-primary">Buat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let selectedNamesContainer = document.getElementById('selectedNames');
    let pesertaSelected = []; // Menyimpan ID peserta yang telah dipilih
    const searchInput = document.getElementById('searchInput');
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const pesertaHidden = document.getElementById('pesertaHidden');
    const form = document.getElementById('formPengajuan');
    const tanggalKegiatan = document.getElementById('tanggalKegiatan');
    const tanggalSelesai = document.getElementById('tanggalSelesai');

    // Fungsi untuk memperbarui atribut min pada tanggal selesai
    function updateMinTanggalSelesai() {
        if (tanggalKegiatan.value) {
            const tglMulai = new Date(tanggalKegiatan.value);
            const tglMulaiFormatted = tglMulai.toISOString().split('T')[0];
            tanggalSelesai.min = tglMulaiFormatted; // Set min attribute
            tanggalSelesai.disabled = false; // Aktifkan input tanggal selesai
        } else {
            tanggalSelesai.value = ''; // Kosongkan tanggal selesai jika tanggal kegiatan kosong
            tanggalSelesai.disabled = true; // Nonaktifkan input tanggal selesai
            tanggalSelesai.removeAttribute('min'); // Hapus atribut min
        }
    }

    // Event listener untuk memperbarui tanggal selesai ketika tanggal kegiatan berubah
    tanggalKegiatan.addEventListener('change', updateMinTanggalSelesai);

    // Awal: Nonaktifkan tanggal selesai jika tanggal kegiatan belum diisi
    if (!tanggalKegiatan.value) {
        tanggalSelesai.disabled = true;
    }

    // Input pencarian
    searchInput.addEventListener('input', function() {
        const filter = searchInput.value.toLowerCase();

        dropdownItems.forEach(item => {
            const itemName = item.textContent.toLowerCase();

            // Tampilkan atau sembunyikan item berdasarkan pencarian
            if (itemName.includes(filter)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Menangani pemilihan peserta
    dropdownItems.forEach(item => {
        item.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-value');

            // Validasi: Pastikan ID peserta belum ada di array pesertaSelected
            if (id && id !== "0" && !pesertaSelected.includes(id)) {
                pesertaSelected.push(id); // Tambahkan ID peserta ke array

                // Elemen nama peserta
                let selectedNameElement = document.createElement('div');
                selectedNameElement.classList.add('selected-name');
                selectedNameElement.setAttribute('data-id', id);

                let nameText = document.createElement('span');
                nameText.textContent = nama;
                selectedNameElement.appendChild(nameText);

                // Tombol remove
                let removeButton = document.createElement('button');
                removeButton.textContent = 'Hapus';
                removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ml-2', 'mt-2', 'mb-2');
                selectedNameElement.appendChild(removeButton);

                // Input hidden untuk setiap peserta
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'peserta[]';
                hiddenInput.value = id;
                selectedNameElement.appendChild(hiddenInput);

                // Tambahkan elemen ke container
                selectedNamesContainer.appendChild(selectedNameElement);

                // Update input hidden dengan ID peserta yang terpilih
                updatePesertaHiddenInput();
            }
        });
    });

    // Menangani penghapusan peserta
    selectedNamesContainer.addEventListener('click', function(e) {
        if (e.target && e.target.tagName === 'BUTTON') {
            let idToRemove = e.target.parentElement.getAttribute('data-id');
            // Hapus ID dari pesertaSelected
            pesertaSelected = pesertaSelected.filter(id => id !== idToRemove);
            // Hapus elemen dari DOM
            e.target.parentElement.remove();
            
            // Update input hidden dengan ID peserta yang terpilih
            updatePesertaHiddenInput();
        }
    });

    // Fungsi untuk memperbarui input tersembunyi dengan peserta yang dipilih
    function updatePesertaHiddenInput() {
        // Menghapus nilai lama di input hidden
        pesertaHidden.value = '';

        // Menambahkan ID peserta yang terpilih ke dalam input hidden
        if (pesertaSelected.length > 0) {
            pesertaHidden.value = pesertaSelected.join(','); // Gabungkan ID peserta menjadi satu string
        }
    }

    // Fungsi untuk mereset semua peserta yang dipilih ketika form dikosongkan
    function resetForm() {
        // Kosongkan peserta yang dipilih
        pesertaSelected = [];
        
        // Hapus semua elemen nama peserta dari container
        selectedNamesContainer.innerHTML = '';
        
        // Reset nilai input hidden
        pesertaHidden.value = '';
    }

    // Validasi form sebelum disubmit
    form.addEventListener('submit', function(e) {
        if (pesertaSelected.length === 0) {
            e.preventDefault(); // Cegah form disubmit jika tidak ada peserta yang dipilih
            alert('Peserta wajib dipilih!');
        } else {
            // Set nilai input tersembunyi dengan ID peserta yang dipilih
            updatePesertaHiddenInput();
        }
    });

    // Event listener untuk mereset form jika kosongkan form (misalnya tombol reset)
    document.getElementById('resetFormButton')?.addEventListener('click', resetForm);
});

</script>



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