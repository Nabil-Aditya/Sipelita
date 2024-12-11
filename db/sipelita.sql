-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 08:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`) VALUES
(3, 'Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `komentar_pelaporan`
--

CREATE TABLE `komentar_pelaporan` (
  `id_komentar_pelaporan` int(11) NOT NULL,
  `id_pelaporan` int(11) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar_pelaporan`
--

INSERT INTO `komentar_pelaporan` (`id_komentar_pelaporan`, `id_pelaporan`, `komentar`) VALUES
(25, 47, 'ulang mas'),
(26, 47, '');

-- --------------------------------------------------------

--
-- Table structure for table `komentar_pelatihan`
--

CREATE TABLE `komentar_pelatihan` (
  `id_komentar_pelatihan` int(11) NOT NULL,
  `id_pelatihan` int(11) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar_pelatihan`
--

INSERT INTO `komentar_pelatihan` (`id_komentar_pelatihan`, `id_pelatihan`, `komentar`) VALUES
(72, 65, 'ulangi mas'),
(73, 65, 'lanju lpj mas'),
(74, 65, 'lanju lpj mas');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `pesan`, `type`, `id_user`, `tgl`, `is_read`) VALUES
(74, 'hardi melakukan pengajuan pelatihan kompetensi sertifikasi siber', 'pelatihan', 47, '2024-12-10 00:00:00', 0),
(75, 'Pengajuan pelatihan kompetensi sertifikasi siber anda Ditolak', 'pelatihan', 49, '2024-12-10 00:00:00', 1),
(77, 'Pengajuan pelatihan kompetensi sertifikasi siber anda Diterima', 'pelatihan', 49, '2024-12-10 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_supervisor` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto_profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_user`, `id_supervisor`, `nip`, `nama`, `alamat`, `telp`, `email`, `foto_profil`) VALUES
(26, 48, 8, 2147483647, 'nabil', 'bida asri 2', '0812700801235', 'mnabiladp@gmail.com', 'Group 143.jpg'),
(27, 49, 8, 1234567443, 'hardi', 'bida', '081270080123', 'numa@gmail.com', 'Group 144.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pelaporan`
--

CREATE TABLE `pelaporan` (
  `id_pelaporan` int(11) NOT NULL,
  `id_pelatihan` int(11) NOT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `sertifikat` varchar(255) DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelaporan`
--

INSERT INTO `pelaporan` (`id_pelaporan`, `id_pelatihan`, `berkas`, `sertifikat`, `status`, `tgl`) VALUES
(47, 65, 'PROGRESS BASIS DATA PBL PART 2 TIM PBL TRPL111 MALAM (4).pdf', 'laporan prototype 1.pdf', 'Ditolak', '2024-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan`
--

CREATE TABLE `pelatihan` (
  `id_pelatihan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `institusi` varchar(255) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_start` date NOT NULL,
  `tgl_end` date NOT NULL,
  `no_dana` varchar(25) NOT NULL,
  `kompetensi` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tgl_pengajuan` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelatihan`
--

INSERT INTO `pelatihan` (`id_pelatihan`, `id_pegawai`, `institusi`, `id_prodi`, `id_jurusan`, `alamat`, `tgl_start`, `tgl_end`, `no_dana`, `kompetensi`, `target`, `status`, `tgl_pengajuan`) VALUES
(65, 27, 'kominfo', 4, 3, 'poltek negeri batam', '2024-12-10', '2024-12-11', '123', 'sertifikasi siber', 'ceh', 'Diterima', '2024-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_pelatihan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `id_pelatihan`, `id_pegawai`) VALUES
(87, 65, 27);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `id_jurusan`, `prodi`) VALUES
(4, 3, 'TRPL'),
(5, 3, 'RKS'),
(6, 3, 'Animasi');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `id_supervisor` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto_profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id_supervisor`, `id_user`, `nip`, `nama`, `alamat`, `telp`, `email`, `foto_profil`) VALUES
(8, 47, 12345678, 'mr banu', 'tiban asri', '081270080123', 'mrbanu@gmail.com', 'banu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(41, 'admin', '$2y$10$khJT7fIFuM1.yH07FWmqGOkDk8K.rkB4VI7c2qwN05UO.BwOHWNoG', 'admin'),
(47, 'mr banu', '$2y$10$T42mp7.ZCv2/rCku38DrX.mD25Z6Ps4yki31aUaBvOu8xBYAqD1K2', 'supervisor'),
(48, 'nabil', '$2y$10$nwLqDneffknn2jN.BoWlkeEwI7MY9aWWmumA7Ht3YWppBu4OK3iqC', 'supervisor'),
(49, 'hardi', '$2y$10$5tHipgo7.2pazs8XKRdQN.tJrQggaQh6HzhcpAjks9ICLozKwXmH2', 'pegawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `komentar_pelaporan`
--
ALTER TABLE `komentar_pelaporan`
  ADD PRIMARY KEY (`id_komentar_pelaporan`),
  ADD KEY `id_pelaporan` (`id_pelaporan`);

--
-- Indexes for table `komentar_pelatihan`
--
ALTER TABLE `komentar_pelatihan`
  ADD PRIMARY KEY (`id_komentar_pelatihan`),
  ADD KEY `id_pelatihan` (`id_pelatihan`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_supervisor` (`id_supervisor`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `id_pelatihan` (`id_pelatihan`);

--
-- Indexes for table `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD PRIMARY KEY (`id_pelatihan`),
  ADD KEY `id_jurusan` (`id_jurusan`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_pelatihan` (`id_pelatihan`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id_supervisor`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `komentar_pelaporan`
--
ALTER TABLE `komentar_pelaporan`
  MODIFY `id_komentar_pelaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `komentar_pelatihan`
--
ALTER TABLE `komentar_pelatihan`
  MODIFY `id_komentar_pelatihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pelaporan`
--
ALTER TABLE `pelaporan`
  MODIFY `id_pelaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `pelatihan`
--
ALTER TABLE `pelatihan`
  MODIFY `id_pelatihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id_supervisor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar_pelaporan`
--
ALTER TABLE `komentar_pelaporan`
  ADD CONSTRAINT `komentar_pelaporan_ibfk_1` FOREIGN KEY (`id_pelaporan`) REFERENCES `pelaporan` (`id_pelaporan`) ON DELETE CASCADE;

--
-- Constraints for table `komentar_pelatihan`
--
ALTER TABLE `komentar_pelatihan`
  ADD CONSTRAINT `komentar_pelatihan_ibfk_1` FOREIGN KEY (`id_pelatihan`) REFERENCES `pelatihan` (`id_pelatihan`) ON DELETE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_supervisor`) REFERENCES `supervisor` (`id_supervisor`) ON DELETE CASCADE;

--
-- Constraints for table `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD CONSTRAINT `pelaporan_ibfk_1` FOREIGN KEY (`id_pelatihan`) REFERENCES `pelatihan` (`id_pelatihan`) ON DELETE CASCADE;

--
-- Constraints for table `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD CONSTRAINT `pelatihan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE,
  ADD CONSTRAINT `pelatihan_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE,
  ADD CONSTRAINT `pelatihan_ibfk_3` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_pelatihan`) REFERENCES `pelatihan` (`id_pelatihan`) ON DELETE CASCADE,
  ADD CONSTRAINT `peserta_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE;

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE;

--
-- Constraints for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
