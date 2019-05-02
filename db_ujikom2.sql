-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2019 at 09:03 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujikom2`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `barangruang`
-- (See below for the actual view)
--
CREATE TABLE `barangruang` (
`nama` varchar(225)
,`jumlah` int(15)
,`keterangan` longtext
,`nama_ruang` varchar(225)
);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id_detail_pinjam` int(11) NOT NULL,
  `id_inventaris` int(11) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `id_peminjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`id_detail_pinjam`, `id_inventaris`, `jumlah`, `id_peminjaman`) VALUES
(28, 12, 250, 913),
(30, 13, 20, 2737);

--
-- Triggers `detail_pinjam`
--
DELIMITER $$
CREATE TRIGGER `kembail` AFTER DELETE ON `detail_pinjam` FOR EACH ROW BEGIN
UPDATE inventaris SET jumlah = jumlah + old.jumlah WHERE
id_inventaris = old.id_inventaris;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pinjam` AFTER INSERT ON `detail_pinjam` FOR EACH ROW BEGIN
UPDATE inventaris SET jumlah = jumlah - new.jumlah WHERE
id_inventaris = new.id_inventaris;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id_inventaris` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `kondisi` varchar(32) NOT NULL,
  `keterangan` longtext NOT NULL,
  `jumlah` int(15) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `tanggal_register` datetime NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `kode_inventaris` varchar(11) DEFAULT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id_inventaris`, `nama`, `kondisi`, `keterangan`, `jumlah`, `id_jenis`, `tanggal_register`, `id_ruang`, `kode_inventaris`, `id_petugas`) VALUES
(1, 'Buku Gambar', 'Baik', 'Buku gambar A4', 1100, 4, '2019-04-07 19:21:59', 1, '', 2),
(12, 'Pensil', 'Baik', 'Pensil 2B', 250, 1, '2019-04-07 19:20:49', 1, '', 2),
(13, 'Printer', 'Baik', 'Printer HP', 30, 2, '2019-04-05 16:41:07', 2, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(225) NOT NULL,
  `kode_jenis` varchar(11) DEFAULT NULL,
  `keterangan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `kode_jenis`, `keterangan`) VALUES
(1, 'ATK', NULL, 'Alat alat tulis'),
(2, 'Elektronik', NULL, 'Barang-Barang Elektronik'),
(4, 'Buku', '', 'Buku Buku');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` enum('administrator','operator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'administrator'),
(2, 'operator');

-- --------------------------------------------------------

--
-- Stand-in structure for view `masuk`
-- (See below for the actual view)
--
CREATE TABLE `masuk` (
`id_supply` int(11)
,`jumlah` int(15)
,`tanggal` datetime
,`nama` varchar(225)
);

-- --------------------------------------------------------

--
-- Table structure for table `pasok`
--

CREATE TABLE `pasok` (
  `id_supply` int(11) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `id_inventaris` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasok`
--

INSERT INTO `pasok` (`id_supply`, `jumlah`, `tanggal`, `id_petugas`, `id_inventaris`) VALUES
(1, 10, '2019-04-05 13:00:00', 1, 2),
(2, 10, '2019-04-05 08:09:45', 10, 2),
(3, 100, '2019-04-05 09:09:29', 1, 2),
(4, 100, '2019-04-05 16:39:10', 1, 11);

--
-- Triggers `pasok`
--
DELIMITER $$
CREATE TRIGGER `tambah` AFTER INSERT ON `pasok` FOR EACH ROW BEGIN
UPDATE inventaris SET jumlah = jumlah + new.jumlah WHERE
id_inventaris = new.id_inventaris;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(225) NOT NULL,
  `nip` int(15) NOT NULL,
  `alamat` longtext NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip`, `alamat`, `status`) VALUES
(1, 'Arty', 11605426, 'Jalan batutulis gang mekarjaya ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_peminjaman` datetime NOT NULL,
  `tanggal_kembali` datetime DEFAULT NULL,
  `status_pengembalian` varchar(32) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `id_inventaris` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tanggal_peminjaman`, `tanggal_kembali`, `status_pengembalian`, `id_pegawai`, `id_petugas`, `id_inventaris`) VALUES
(139, '2019-04-05 17:07:00', '2019-04-05 17:08:48', 'Kembali', 1, NULL, 0),
(200, '2019-04-05 17:11:38', '2019-04-05 17:13:33', 'Kembali', 1, NULL, 0),
(694, '2019-04-05 16:55:36', '2019-04-05 17:08:43', 'Kembali', 1, NULL, 11),
(874, '2019-04-05 17:05:38', '2019-04-05 17:06:41', 'Kembali', 1, NULL, 0),
(913, '2019-04-05 17:06:34', '0000-00-00 00:00:00', 'Blom', 0, 1, 12),
(2737, '2019-04-05 17:07:12', '0000-00-00 00:00:00', 'Blom', 0, 1, 13),
(3405, '2019-04-05 17:09:36', '2019-04-05 17:09:48', 'Kembali', 0, 1, 11),
(8144, '2019-04-05 17:10:18', '2019-04-05 17:10:26', 'Kembali', 0, 1, 11),
(8145, '2019-04-05 16:58:42', '2019-04-05 17:09:28', 'Kembali', 0, 1, 11),
(9357, '2019-04-05 16:51:41', '2019-04-05 17:09:26', 'Kembali', 0, 1, 11);

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `kembalian` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN
DELETE FROM detail_pinjam WHERE id_peminjaman = new.id_peminjaman;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_petugas` varchar(225) NOT NULL,
  `id_level` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `id_level`, `status`) VALUES
(1, 'admin', 'admin', 'Denny', 1, 0),
(2, 'Operator', 'operator', 'Otso', 2, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pinjaman`
-- (See below for the actual view)
--
CREATE TABLE `pinjaman` (
`nama_pegawai` varchar(225)
,`nip` int(15)
,`tanggal_peminjaman` datetime
,`tanggal_kembali` datetime
,`status_pengembalian` varchar(32)
,`nama` varchar(225)
);

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) NOT NULL,
  `nama_ruang` varchar(225) NOT NULL,
  `kode_ruang` varchar(225) DEFAULT NULL,
  `keterangan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`, `kode_ruang`, `keterangan`) VALUES
(1, 'Ruang ATK', NULL, 'Untuk Menyimpan ATK'),
(2, 'Ruang Elektronik', NULL, 'Untuk Menyimpan alat elektronik'),
(3, 'Ruang Fasilitas', NULL, 'Menyimpan Fasilitas Lain'),
(4, 'Ruang Kosong', NULL, 'Kosong'),
(5, 'Ruang Fasilitas Buku', '', 'Menyimpan Buku-buku');

-- --------------------------------------------------------

--
-- Table structure for table `rusak`
--

CREATE TABLE `rusak` (
  `id_rusak` int(11) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `id_inventaris` int(11) NOT NULL,
  `tanggal_rusak` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rusak`
--

INSERT INTO `rusak` (`id_rusak`, `jumlah`, `id_inventaris`, `tanggal_rusak`) VALUES
(6, 1, 9, '2019-04-05 13:22:23');

--
-- Triggers `rusak`
--
DELIMITER $$
CREATE TRIGGER `perbaikan` AFTER DELETE ON `rusak` FOR EACH ROW BEGIN
UPDATE inventaris SET jumlah = jumlah + old.jumlah WHERE
id_inventaris = old.id_inventaris;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `rusak` AFTER INSERT ON `rusak` FOR EACH ROW BEGIN
UPDATE inventaris SET jumlah = jumlah - new.jumlah WHERE
id_inventaris = new.id_inventaris;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_return`
-- (See below for the actual view)
--
CREATE TABLE `view_return` (
`id_inventaris` int(11)
,`jumlah` int(15)
,`id_peminjaman` int(11)
,`status_pengembalian` varchar(32)
);

-- --------------------------------------------------------

--
-- Structure for view `barangruang`
--
DROP TABLE IF EXISTS `barangruang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `barangruang`  AS  select `inventaris`.`nama` AS `nama`,`inventaris`.`jumlah` AS `jumlah`,`inventaris`.`keterangan` AS `keterangan`,`ruang`.`nama_ruang` AS `nama_ruang` from (`ruang` join `inventaris` on((`ruang`.`id_ruang` = `inventaris`.`id_ruang`))) ;

-- --------------------------------------------------------

--
-- Structure for view `masuk`
--
DROP TABLE IF EXISTS `masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `masuk`  AS  select `pasok`.`id_supply` AS `id_supply`,`pasok`.`jumlah` AS `jumlah`,`pasok`.`tanggal` AS `tanggal`,`inventaris`.`nama` AS `nama` from (`pasok` join `inventaris` on((`pasok`.`id_inventaris` = `inventaris`.`id_inventaris`))) ;

-- --------------------------------------------------------

--
-- Structure for view `pinjaman`
--
DROP TABLE IF EXISTS `pinjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pinjaman`  AS  select `pegawai`.`nama_pegawai` AS `nama_pegawai`,`pegawai`.`nip` AS `nip`,`peminjaman`.`tanggal_peminjaman` AS `tanggal_peminjaman`,`peminjaman`.`tanggal_kembali` AS `tanggal_kembali`,`peminjaman`.`status_pengembalian` AS `status_pengembalian`,`inventaris`.`nama` AS `nama` from ((`pegawai` join `peminjaman` on((`pegawai`.`id_pegawai` = `peminjaman`.`id_pegawai`))) join `inventaris` on((`peminjaman`.`id_inventaris` = `inventaris`.`id_inventaris`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_return`
--
DROP TABLE IF EXISTS `view_return`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_return`  AS  select `detail_pinjam`.`id_inventaris` AS `id_inventaris`,`detail_pinjam`.`jumlah` AS `jumlah`,`detail_pinjam`.`id_peminjaman` AS `id_peminjaman`,`peminjaman`.`status_pengembalian` AS `status_pengembalian` from (`peminjaman` join `detail_pinjam`) where (`peminjaman`.`id_peminjaman` = `detail_pinjam`.`id_peminjaman`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD PRIMARY KEY (`id_detail_pinjam`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_inventaris`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_ruang` (`id_ruang`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `pasok`
--
ALTER TABLE `pasok`
  ADD PRIMARY KEY (`id_supply`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `rusak`
--
ALTER TABLE `rusak`
  ADD PRIMARY KEY (`id_rusak`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  MODIFY `id_detail_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_inventaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pasok`
--
ALTER TABLE `pasok`
  MODIFY `id_supply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rusak`
--
ALTER TABLE `rusak`
  MODIFY `id_rusak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
