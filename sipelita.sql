-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2024 pada 14.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipelita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`) VALUES
(2, 'Informatika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto_profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_user`, `nip`, `nama`, `alamat`, `telp`, `email`, `foto_profil`) VALUES
(5, 7, 1001, 'muhammad nasyith aditya putera', 'Batam, Kepulauan Riau', '+62 852 6590 00', 'mnasyith2006@gmail.com', 'IMG-20220802-WA0007.jpg'),
(6, 8, 1002, 'muhammad brandy', 'Bata,, Kepulauan Riau', '086745632254', 'brandy@gmail.com', 'contoh.jpg'),
(7, 9, 0, 'Admin', 'Batam', '0000', 'admin@gmail.com', 'Default_pfp.svg.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelaporan`
--

CREATE TABLE `pelaporan` (
  `id_pelaporan` int(11) NOT NULL,
  `id_pelatihan` int(11) NOT NULL,
  `berkas` varchar(255) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelatihan`
--

CREATE TABLE `pelatihan` (
  `id_pelatihan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `institusi` varchar(255) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_peserta` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_start` date NOT NULL,
  `tgl_end` date NOT NULL,
  `no_dana` varchar(25) NOT NULL,
  `kompetensi` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelatihan`
--

INSERT INTO `pelatihan` (`id_pelatihan`, `id_pegawai`, `institusi`, `id_prodi`, `id_jurusan`, `nama_peserta`, `alamat`, `tgl_start`, `tgl_end`, `no_dana`, `kompetensi`, `target`, `status`) VALUES
(2, 7, 'KEMENAG', 3, 2, 'Nabil', 'Bida Center', '2024-11-04', '2024-11-08', '123112', 'Sertifikasi Masak Nasi ', 'Pandai Masak Nasi', 'Diproses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `id_jurusan`, `prodi`) VALUES
(3, 2, 'MM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelaporan_lpj`
--

CREATE TABLE `tb_pelaporan_lpj` (
  `no_pelaporan` int(255) NOT NULL,
  `no_pengajuan` int(255) NOT NULL,
  `nama_pemohon` varchar(20) NOT NULL,
  `nip` int(20) NOT NULL,
  `no_telp` int(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `tgl_kegiatan_selesai` date NOT NULL,
  `kegiatan` varchar(30) NOT NULL,
  `uraian_kegiatan` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '''Pending'', ''Approved'', ''Rejected''	',
  `waktu_pengajuan` datetime NOT NULL,
  `waktu_pelaporan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bukti_fisik` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelatihan`
--

CREATE TABLE `tb_pelatihan` (
  `id_pelatihan` int(255) NOT NULL,
  `lembaga` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `nama_peserta` text NOT NULL,
  `tempat_pelatihan` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `sumber_dana` int(255) NOT NULL,
  `kompetensi` varchar(255) NOT NULL,
  `capain_target` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajuan_lpj`
--

CREATE TABLE `tb_pengajuan_lpj` (
  `no_pengajuan` int(255) NOT NULL,
  `nama_pemohon` varchar(20) NOT NULL,
  `nip` int(20) NOT NULL,
  `no_telp` int(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `tgl_kegiatan_selesai` date NOT NULL,
  `kegiatan` varchar(30) NOT NULL,
  `uraian_kegiatan` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '''Pending'', ''Approved'', ''Rejected''	',
  `waktu_pengajuan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengajuan_lpj`
--

INSERT INTO `tb_pengajuan_lpj` (`no_pengajuan`, `nama_pemohon`, `nip`, `no_telp`, `email`, `tgl_kegiatan`, `tgl_kegiatan_selesai`, `kegiatan`, `uraian_kegiatan`, `status`, `waktu_pengajuan`) VALUES
(87, 'abdul ghani', 2147483647, 2147483647, 'mnabiladp2005@gmail.com', '2024-09-25', '2024-09-25', 'aaa', 't', 'Rejected', '2024-09-24 17:43:10'),
(88, 'shinta', 43234, 2147483647, 'mnabiladp2005@gmail.com', '2024-09-25', '2024-09-26', 'hatnua', 'adaas', 'Pending', '2024-09-24 17:50:30'),
(89, 'asra', 121, 81221, 'nabiladitya737@gmail.com', '2024-09-25', '2024-09-25', 'lomba', '999', 'Pending', '2024-09-24 17:54:20'),
(90, 'comel', 121, 81221, 'nabiladitya737@gmail.com', '2024-09-25', '2024-09-27', 'ytyytt', 'pp', 'Approved', '2024-09-24 17:59:29'),
(91, 'ibrahim', 3232, 81221, 'nabiladitya737@gmail.com', '2024-09-25', '2024-10-04', 'lomba', 'hhhhhrrr', 'Pending', '2024-09-24 18:00:48'),
(92, 'abdul ghani', 456776, 2147483647, 'mnabiladp2005@gmail.com', '2024-09-25', '2024-10-03', 'aaa', 'kjds', 'Pending', '2024-09-25 03:32:27'),
(93, 'nabil', 2222, 2322, 'mnabiladp@gmail.com', '2024-09-25', '2024-09-27', 'ga', 'gaaaa', 'Approved', '2024-09-25 09:02:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supervisi`
--

CREATE TABLE `tb_supervisi` (
  `nip_supervisor` int(255) NOT NULL,
  `nip_pegawai` int(255) NOT NULL,
  `start_work` date NOT NULL,
  `end_work` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(7, 'nasyith', '$2y$10$XiMuWD9R0uA9PhnzYP66keNp9wFQuAXzW1Ckig1WVJzfvKA9OgvR.', 'pegawai'),
(8, 'brandy', '$2y$10$1S6CsnJd8IzptzFemJlmwu6f4kBaPzz1Fq0HVkSHdUw3Uelrq5HVm', 'supervisor'),
(9, 'admin', '$2y$10$weZ1sfeIyLw.gGvEjF6oJOdQ0w8hrG77xK3w3pC7b3peKNwwHIvcS', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD PRIMARY KEY (`id_pelaporan`);

--
-- Indeks untuk tabel `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD PRIMARY KEY (`id_pelatihan`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indeks untuk tabel `tb_pelaporan_lpj`
--
ALTER TABLE `tb_pelaporan_lpj`
  ADD PRIMARY KEY (`no_pelaporan`),
  ADD KEY `tb_pelaporan_lpj_ibfk_1` (`no_pengajuan`);

--
-- Indeks untuk tabel `tb_pelatihan`
--
ALTER TABLE `tb_pelatihan`
  ADD PRIMARY KEY (`id_pelatihan`);

--
-- Indeks untuk tabel `tb_pengajuan_lpj`
--
ALTER TABLE `tb_pengajuan_lpj`
  ADD PRIMARY KEY (`no_pengajuan`);

--
-- Indeks untuk tabel `tb_supervisi`
--
ALTER TABLE `tb_supervisi`
  ADD PRIMARY KEY (`nip_supervisor`,`nip_pegawai`,`start_work`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pelaporan`
--
ALTER TABLE `pelaporan`
  MODIFY `id_pelaporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelatihan`
--
ALTER TABLE `pelatihan`
  MODIFY `id_pelatihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pengajuan_lpj`
--
ALTER TABLE `tb_pengajuan_lpj`
  MODIFY `no_pengajuan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pelaporan_lpj`
--
ALTER TABLE `tb_pelaporan_lpj`
  ADD CONSTRAINT `tb_pelaporan_lpj_ibfk_1` FOREIGN KEY (`no_pengajuan`) REFERENCES `tb_pengajuan_lpj` (`no_pengajuan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
