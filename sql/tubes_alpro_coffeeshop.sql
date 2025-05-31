-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2025 at 02:41 PM
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
-- Database: `tubes_alpro_coffeeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id_log` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `waktu` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id_log`, `username`, `aktivitas`, `waktu`) VALUES
(11, 'paymeoeo', 'Menambahkan \'Kapal Api\' ke keranjang', '2025-05-30 00:12:23'),
(12, 'paymeoeo', 'Checkout 1 x Kapal Api', '2025-05-30 00:12:27'),
(13, 'paymeoeo', 'Menambahkan \'Americano\' ke keranjang', '2025-05-30 00:12:51'),
(14, 'paymeoeo', 'Checkout 1 x Americano', '2025-05-30 00:12:56'),
(15, 'paymeoeo', 'Menambahkan \'Americano\' ke keranjang', '2025-05-30 00:24:52'),
(16, 'paymeoeo', 'Checkout 1 x Americano', '2025-05-30 00:33:11'),
(17, 'paymeoeo', 'Menambahkan \'Americano\' ke keranjang', '2025-05-30 00:36:54'),
(18, 'paymeoeo', 'Checkout 1 x Americano', '2025-05-30 00:37:12'),
(19, 'paymeoeo', 'Menambahkan \'Kapal Api\' ke keranjang', '2025-05-30 00:39:40'),
(20, 'paymeoeo', 'Menambahkan \'Kapal Api\' ke keranjang', '2025-05-30 00:44:36'),
(21, 'paymeoeo', 'Menambahkan \'Kapal Api\' ke keranjang', '2025-05-30 00:44:55'),
(22, 'paymeoeo', 'Menambahkan \'Kapal Api\' ke keranjang', '2025-05-30 00:46:19'),
(23, 'paymeoeo', 'Menambahkan \'Kapal Api\' ke keranjang', '2025-05-30 00:46:22'),
(24, 'paymeoeo', 'Menambahkan \'Kapal Api\' ke keranjang', '2025-05-30 00:53:11'),
(25, 'paymeoeo', 'Melakukan transaksi dengan total Rp 5.000', '2025-05-30 00:55:41'),
(26, 'paymeoeo', 'Menambahkan \'Americano\' ke keranjang', '2025-05-30 00:55:56'),
(27, 'paymeoeo', 'Melakukan transaksi dengan total Rp 20.000', '2025-05-30 00:56:06'),
(28, 'paymeoeo', 'Menambahkan \'Americano\' ke keranjang', '2025-05-30 01:00:19'),
(29, 'paymeoeo', 'Melakukan transaksi dengan total Rp 20.000', '2025-05-30 01:00:28'),
(30, 'kaleyo', 'Menambahkan \'Americano\' ke keranjang', '2025-05-30 22:03:31'),
(31, 'kaleyo', 'Melakukan transaksi dengan total Rp 20.000', '2025-05-30 22:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama`, `harga`, `gambar`, `stok`) VALUES
(4, 'Americano', 20000, '683861adc35d1.jpg', 9),
(6, 'Kapal Api', 5000, '6838871e458a8.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `username`, `total`, `bayar`, `kembalian`, `waktu`) VALUES
(1, 'paymeoeo', 5000, 10000, 5000, '2025-05-29 12:39:48'),
(6, 'paymeoeo', 5000, 5000, 0, '2025-05-29 12:55:41'),
(7, 'paymeoeo', 20000, 25000, 5000, '2025-05-29 12:56:06'),
(8, 'paymeoeo', 20000, 20000, 0, '2025-05-29 13:00:28'),
(9, 'kaleyo', 20000, 25000, 5000, '2025-05-30 10:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_detail`, `id_transaksi`, `id_menu`, `jumlah`, `subtotal`) VALUES
(1, 1, 6, 1, 5000),
(6, 6, 6, 1, 5000),
(7, 7, 4, 1, 20000),
(8, 8, 4, 1, 20000),
(9, 9, 4, 1, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('customer','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `role`) VALUES
(1, 'Payme Riski', 'paymeoeo', 'pay123', 'customer'),
(2, 'Lamine Yamal', 'yamaldecul', 'yamal123', 'admin'),
(3, 'Leoksana', 'kaleyo', 'leo123', 'customer'),
(4, 'Sulthan Hafizh', 'dyno', 'dyno123', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
