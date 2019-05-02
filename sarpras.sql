-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2019 at 02:43 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarpras`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailbarang`
-- (See below for the actual view)
--
CREATE TABLE `detailbarang` (
`kd_barang` varchar(7)
,`nama_barang` varchar(40)
,`kd_merek` varchar(7)
,`kd_distributor` varchar(7)
,`tanggal_masuk` date
,`harga_barang` int(7)
,`stok_barang` int(4)
,`gambar` varchar(255)
,`keterangan` varchar(40)
,`merek` varchar(30)
,`nama_distributor` varchar(40)
,`no_telp` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailtransaksi`
-- (See below for the actual view)
--
CREATE TABLE `detailtransaksi` (
`kd_transaksi` varchar(7)
,`kd_barang` varchar(7)
,`kd_user` varchar(7)
,`jumlah_beli` int(4)
,`total_harga` int(8)
,`tanggal_beli` timestamp
,`nama_user` varchar(20)
,`nama_barang` varchar(40)
);

-- --------------------------------------------------------

--
-- Table structure for table `table_barang`
--

CREATE TABLE `table_barang` (
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `kd_merek` varchar(7) NOT NULL,
  `kd_distributor` varchar(7) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga_barang` int(7) NOT NULL,
  `stok_barang` int(4) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_barang`
--

INSERT INTO `table_barang` (`kd_barang`, `nama_barang`, `kd_merek`, `kd_distributor`, `tanggal_masuk`, `harga_barang`, `stok_barang`, `gambar`, `keterangan`) VALUES
('BR001', 'Generator', 'ME002', 'DS003', '2018-05-05', 1000000, 100, '152552748028.jpg', 'BagusMen'),
('BR002', 'Raditor Keren', 'ME001', 'DS001', '2018-05-08', 4, 1, '1525767487299.png', 'Bagus');

-- --------------------------------------------------------

--
-- Table structure for table `table_distributor`
--

CREATE TABLE `table_distributor` (
  `kd_distributor` varchar(7) NOT NULL,
  `nama_distributor` varchar(40) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_distributor`
--

INSERT INTO `table_distributor` (`kd_distributor`, `nama_distributor`, `alamat`, `no_telp`) VALUES
('DS001', 'Mic', '', ''),
('DS002', 'Speaker', '', ''),
('DS003', 'Proyektor', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `table_merek`
--

CREATE TABLE `table_merek` (
  `kd_merek` varchar(7) NOT NULL,
  `merek` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_merek`
--

INSERT INTO `table_merek` (`kd_merek`, `merek`) VALUES
('ME001', 'Philips'),
('ME002', 'Raditor');

-- --------------------------------------------------------

--
-- Table structure for table `table_pinjam`
--

CREATE TABLE `table_pinjam` (
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_antrian` varchar(7) NOT NULL,
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `nama_peminjam` varchar(30) NOT NULL,
  `tgl_pinjam` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `table_pinjam`
--
DELIMITER $$
CREATE TRIGGER `kembali_barang` AFTER DELETE ON `table_pinjam` FOR EACH ROW BEGIN
UPDATE table_barang SET
stok_barang = stok_barang + old.jumlah
WHERE kd_barang = old.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurang_stok` AFTER INSERT ON `table_pinjam` FOR EACH ROW BEGIN
UPDATE table_barang SET
stok_barang = stok_barang - new.jumlah
WHERE kd_barang = new.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `table_pretransaksi`
--

CREATE TABLE `table_pretransaksi` (
  `kd_pretransaksi` varchar(7) NOT NULL,
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `sub_total` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `table_pretransaksi`
--
DELIMITER $$
CREATE TRIGGER `transaksi` AFTER INSERT ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang - new.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `table_transaksi`
--

CREATE TABLE `table_transaksi` (
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_barang` varchar(7) NOT NULL,
  `kd_user` varchar(7) NOT NULL,
  `jumlah_beli` int(4) NOT NULL,
  `total_harga` int(8) NOT NULL,
  `tanggal_beli` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `kd_user` varchar(7) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` enum('Admin','Kasir','Manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`kd_user`, `nama_user`, `username`, `password`, `level`) VALUES
('US001', 'admin', 'admins', 'YWRtaW4=', 'Admin');

-- --------------------------------------------------------

--
-- Structure for view `detailbarang`
--
DROP TABLE IF EXISTS `detailbarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailbarang`  AS  select `table_barang`.`kd_barang` AS `kd_barang`,`table_barang`.`nama_barang` AS `nama_barang`,`table_barang`.`kd_merek` AS `kd_merek`,`table_barang`.`kd_distributor` AS `kd_distributor`,`table_barang`.`tanggal_masuk` AS `tanggal_masuk`,`table_barang`.`harga_barang` AS `harga_barang`,`table_barang`.`stok_barang` AS `stok_barang`,`table_barang`.`gambar` AS `gambar`,`table_barang`.`keterangan` AS `keterangan`,`table_merek`.`merek` AS `merek`,`table_distributor`.`nama_distributor` AS `nama_distributor`,`table_distributor`.`no_telp` AS `no_telp` from ((`table_barang` join `table_merek` on((`table_barang`.`kd_merek` = `table_merek`.`kd_merek`))) join `table_distributor` on((`table_barang`.`kd_distributor` = `table_distributor`.`kd_distributor`))) ;

-- --------------------------------------------------------

--
-- Structure for view `detailtransaksi`
--
DROP TABLE IF EXISTS `detailtransaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailtransaksi`  AS  select `table_transaksi`.`kd_transaksi` AS `kd_transaksi`,`table_transaksi`.`kd_barang` AS `kd_barang`,`table_transaksi`.`kd_user` AS `kd_user`,`table_transaksi`.`jumlah_beli` AS `jumlah_beli`,`table_transaksi`.`total_harga` AS `total_harga`,`table_transaksi`.`tanggal_beli` AS `tanggal_beli`,`table_user`.`nama_user` AS `nama_user`,`table_barang`.`nama_barang` AS `nama_barang` from ((`table_transaksi` join `table_user` on((`table_user`.`kd_user` = `table_transaksi`.`kd_user`))) join `table_barang` on((`table_barang`.`kd_barang` = `table_transaksi`.`kd_barang`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_barang`
--
ALTER TABLE `table_barang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `kd_distributor` (`kd_distributor`),
  ADD KEY `kd_merek` (`kd_merek`);

--
-- Indexes for table `table_distributor`
--
ALTER TABLE `table_distributor`
  ADD PRIMARY KEY (`kd_distributor`);

--
-- Indexes for table `table_merek`
--
ALTER TABLE `table_merek`
  ADD PRIMARY KEY (`kd_merek`);

--
-- Indexes for table `table_pinjam`
--
ALTER TABLE `table_pinjam`
  ADD PRIMARY KEY (`kd_transaksi`,`kd_barang`,`kd_antrian`);

--
-- Indexes for table `table_pretransaksi`
--
ALTER TABLE `table_pretransaksi`
  ADD PRIMARY KEY (`kd_pretransaksi`);

--
-- Indexes for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD PRIMARY KEY (`kd_transaksi`),
  ADD KEY `kd_barang` (`kd_barang`),
  ADD KEY `kd_user` (`kd_user`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`kd_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_barang`
--
ALTER TABLE `table_barang`
  ADD CONSTRAINT `table_barang_ibfk_1` FOREIGN KEY (`kd_distributor`) REFERENCES `table_distributor` (`kd_distributor`),
  ADD CONSTRAINT `table_barang_ibfk_2` FOREIGN KEY (`kd_merek`) REFERENCES `table_merek` (`kd_merek`);

--
-- Constraints for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD CONSTRAINT `table_transaksi_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `table_barang` (`kd_barang`),
  ADD CONSTRAINT `table_transaksi_ibfk_2` FOREIGN KEY (`kd_user`) REFERENCES `table_user` (`kd_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
