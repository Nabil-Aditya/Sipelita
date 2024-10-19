-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 12:03 PM
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
-- Table structure for table `tb_pelaporan_lpj`
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
-- Table structure for table `tb_pengajuan_lpj`
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
-- Dumping data for table `tb_pengajuan_lpj`
--

INSERT INTO `tb_pengajuan_lpj` (`no_pengajuan`, `nama_pemohon`, `nip`, `no_telp`, `email`, `tgl_kegiatan`, `tgl_kegiatan_selesai`, `kegiatan`, `uraian_kegiatan`, `status`, `waktu_pengajuan`) VALUES
(87, 'abdul ghani', 2147483647, 2147483647, 'mnabiladp2005@gmail.com', '2024-09-25', '2024-09-25', 'aaa', 't', 'Rejected', '2024-09-24 17:43:10'),
(88, 'shinta', 43234, 2147483647, 'mnabiladp2005@gmail.com', '2024-09-25', '2024-09-26', 'hatnua', 'adaas', 'Pending', '2024-09-24 17:50:30'),
(89, 'asra', 121, 81221, 'nabiladitya737@gmail.com', '2024-09-25', '2024-09-25', 'lomba', '999', 'Pending', '2024-09-24 17:54:20'),
(90, 'comel', 121, 81221, 'nabiladitya737@gmail.com', '2024-09-25', '2024-09-27', 'ytyytt', 'pp', 'Approved', '2024-09-24 17:59:29'),
(91, 'ibrahim', 3232, 81221, 'nabiladitya737@gmail.com', '2024-09-25', '2024-10-04', 'lomba', 'hhhhhrrr', 'Pending', '2024-09-24 18:00:48'),
(92, 'abdul ghani', 456776, 2147483647, 'mnabiladp2005@gmail.com', '2024-09-25', '2024-10-03', 'aaa', 'kjds', 'Pending', '2024-09-25 03:32:27'),
(93, 'nabil', 2222, 2322, 'mnabiladp@gmail.com', '2024-09-25', '2024-09-27', 'ga', 'gaaaa', 'Approved', '2024-09-25 09:02:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_pelaporan_lpj`
--
ALTER TABLE `tb_pelaporan_lpj`
  ADD PRIMARY KEY (`no_pelaporan`);

--
-- Indexes for table `tb_pengajuan_lpj`
--
ALTER TABLE `tb_pengajuan_lpj`
  ADD PRIMARY KEY (`no_pengajuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pengajuan_lpj`
--
ALTER TABLE `tb_pengajuan_lpj`
  MODIFY `no_pengajuan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pelaporan_lpj`
--
ALTER TABLE `tb_pelaporan_lpj`
  ADD CONSTRAINT `tb_pelaporan_lpj_ibfk_1` FOREIGN KEY (`no_pengajuan`) REFERENCES `tb_pengajuan_lpj` (`no_pengajuan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
