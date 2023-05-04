-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 01:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tresaikel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `nama`, `email`, `alamat`, `no_hp`, `password`, `foto`) VALUES
('admin', 'Admin Gans', 'admin@gmail.com', 'Jalan Ajaaliaskalik No. 9, Gerung', '087287328732', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `menjual`
--

CREATE TABLE `menjual` (
  `no_transaksi_jual` int(11) NOT NULL,
  `tanggal_jual` date NOT NULL,
  `username_masyarakat` varchar(20) NOT NULL,
  `id_sampah` int(11) NOT NULL,
  `cek_user` tinyint(1) NOT NULL DEFAULT 0,
  `cek_pengepul` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menjual`
--

INSERT INTO `menjual` (`no_transaksi_jual`, `tanggal_jual`, `username_masyarakat`, `id_sampah`, `cek_user`, `cek_pengepul`) VALUES
(5, '2022-06-23', 'dadi', 12, 1, 1),
(6, '2022-06-23', 'dadi', 13, 1, 1),
(7, '2022-06-23', 'dadi', 14, 1, 1),
(9, '2022-06-23', 'dadi', 16, 0, 1),
(10, '2022-06-24', 'dadi', 17, 1, 1),
(11, '2022-06-24', 'dadi', 18, 0, 1),
(12, '2022-06-24', 'nurul', 19, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengepul`
--

CREATE TABLE `pengepul` (
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `kab_kota` enum('Lombok Barat','Lombok Tengah','Lombok Timur','Mataram') NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengepul`
--

INSERT INTO `pengepul` (`username`, `nama`, `email`, `password`, `alamat`, `no_hp`, `kab_kota`, `foto`) VALUES
('ecan', 'Haechan', 'ecan@gmail.com', 'ecan', 'Bank Sampah Jl. Montong Ajan, Torok Aik Belek, Selong Belanak, Kec. Praya Barat', '087837818728', 'Lombok Tengah', '1556804356_haechan.jpg'),
('kiddo', 'Lalu Fitho', 'kiddo@gmail.com', 'kiddo', 'TPA Kebon Kongok, Desa, Suka Makmur, Gerung', '081287382828', 'Lombok Barat', ''),
('tonton', 'Tono Hartono', 'tonooo@gmail.com', 'tonton', 'JL. Leo no. 24 lingkungan banjar selaparang, Pejeruk, Kec. Ampenan', '083981827982', 'Mataram', '');

-- --------------------------------------------------------

--
-- Table structure for table `sampah`
--

CREATE TABLE `sampah` (
  `id_sampah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` float NOT NULL,
  `username_pengepul` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sampah`
--

INSERT INTO `sampah` (`id_sampah`, `harga`, `berat`, `username_pengepul`) VALUES
(12, 5000, 2, 'ecan'),
(13, 5000, 2, 'ecan'),
(14, 3250, 1.3, 'ecan'),
(15, 0, 0, 'tonton'),
(16, 12500, 5, 'ecan'),
(17, 12500, 5, 'kiddo'),
(18, 555000, 222, 'ecan'),
(19, 37500, 15, 'kiddo');

-- --------------------------------------------------------

--
-- Table structure for table `saran`
--

CREATE TABLE `saran` (
  `komentar` text NOT NULL,
  `username_pengepul` varchar(20) DEFAULT NULL,
  `username_user` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saran`
--

INSERT INTO `saran` (`komentar`, `username_pengepul`, `username_user`) VALUES
('klsklaks', NULL, 'nurulwa'),
('klsklaksa', NULL, 'nurulwa'),
('nurrr', NULL, 'nurulwa'),
('koeee', NULL, 'nurulwa'),
('asede', NULL, 'nurulwa'),
('j', NULL, 'dadi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `kab_kota` enum('Lombok Barat','Lombok Tengah','Lombok Timur','Mataram') NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `nama`, `email`, `password`, `alamat`, `no_hp`, `kab_kota`, `foto`) VALUES
('dadi', 'Dadi Suryadi', 'dadi@gmail.com', 'dadi', 'Jln. Makmum no. 10', '087087087087', 'Mataram', '421847448_alena-aenami-001.jpg'),
('haechan', 'lee haechan', 'leehaechan@gmail.com', 'ecan', 'jln baru soul utara no.2 blok b', '08708909865', 'Mataram', ''),
('nurul', 'Nurul Wahida', 'nurull@gmail.com', 'nurul', 'Sesela', '081081081081', 'Mataram', '377723277_e34b1abf63e3b26db07e6ee7a50e8849.jpg'),
('nurulwa', 'Nurul Wahida', 'nurul@gmail.com', 'nurul', 'Sesela', '081081081081', 'Mataram', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `menjual`
--
ALTER TABLE `menjual`
  ADD PRIMARY KEY (`no_transaksi_jual`),
  ADD KEY `fk_mas_jual` (`username_masyarakat`),
  ADD KEY `fk_sampah` (`id_sampah`);

--
-- Indexes for table `pengepul`
--
ALTER TABLE `pengepul`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id_sampah`),
  ADD KEY `fk_pengepulpul` (`username_pengepul`);

--
-- Indexes for table `saran`
--
ALTER TABLE `saran`
  ADD KEY `fk_pengepul` (`username_pengepul`),
  ADD KEY `fk_user` (`username_user`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menjual`
--
ALTER TABLE `menjual`
  MODIFY `no_transaksi_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id_sampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menjual`
--
ALTER TABLE `menjual`
  ADD CONSTRAINT `fk_mas_jual` FOREIGN KEY (`username_masyarakat`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sampah` FOREIGN KEY (`id_sampah`) REFERENCES `sampah` (`id_sampah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sampah`
--
ALTER TABLE `sampah`
  ADD CONSTRAINT `fk_pengepulpul` FOREIGN KEY (`username_pengepul`) REFERENCES `pengepul` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saran`
--
ALTER TABLE `saran`
  ADD CONSTRAINT `fk_pengepul` FOREIGN KEY (`username_pengepul`) REFERENCES `pengepul` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`username_user`) REFERENCES `user` (`username`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
