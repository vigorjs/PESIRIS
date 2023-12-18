-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 03:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(25) NOT NULL,
  `penyerah` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `penyerah`, `qty`) VALUES
(23, 67, '2023-05-15 21:39:15', 'Kantor Cabang Kebumen', 'Bu Ning', 50);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`, `photo`) VALUES
(1, 'virgofajar123@gmail.com', '123', NULL),
(6, 'ifantowus@gmail.com', '123123', NULL),
(7, 'mayang', '123', NULL),
(8, 'pundy', '123', NULL),
(9, 'saya1@gmail.com', 'saya', 'profile.jpg'),
(10, 'saya2@gmail.com', 'saya2', NULL),
(11, 'coba@gmail.com', 'coba', NULL),
(12, 'ok@gmail.com', 'okee', NULL),
(13, 'saya3@gmail.com', 'saya3', NULL),
(14, 'saya4@gmail.com', 'saya4', NULL),
(15, 'saya5@gmail.com', 'saya5', NULL),
(16, 'saa@gmail.com', 'saaa', NULL),
(17, 'joni@gmail.com', 'joni', NULL),
(18, 'email@gmail.com', 'email', NULL),
(19, 'jon@gmail.com', 'joon', NULL),
(20, 'janc@gmail.com', 'janc', NULL),
(21, 'asw@gmail.com', 'asww', NULL),
(22, 'daft@gmail.com', 'daft', NULL),
(23, 'saaa@gmail.com', 'saaa', NULL),
(24, 'kont@gmail.com', 'kont', NULL),
(25, 'regis@gmail.com', 'regis', NULL),
(26, 'cekk@gmail.com', 'cekk', NULL),
(27, 'ass@gmail.com', 'ass', NULL),
(28, 'tes1@gmail.com', 'tes1', NULL),
(29, 'cokk@gmail.com', 'cokk', NULL),
(30, 'fukk@gmail.com', 'fukk', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(25) NOT NULL,
  `penyerah` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `penyerah`, `qty`) VALUES
(31, 67, '2023-05-15 21:38:01', 'Towud', 'Bu Ning', 50),
(33, 69, '2023-08-12 06:09:51', 'Kantor Cabang Kebumen', 'Bu Ning', 10);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(25) NOT NULL,
  `deskripsi` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `deskripsi`, `stock`, `image`) VALUES
(65, 'Brosur KUR', 'Marketing Kit', 100, 'b18affd703221cf977be17c0ceb9c55b.png'),
(67, 'Payung', 'Marketing KIT', 100, '5a682186e49eb3c8677c45eb5c3e76e6.jpeg'),
(68, 'Kaos', 'Marketing KIT', 60, 'e8046b27af2be091f8d72bdd4b73fd11.jpg'),
(69, 'Banner', 'Marketing KIT', 15, 'e05a7e26d8ca3e920c7d16f0f99f05fd.jpg'),
(70, 'Helm', 'marketing', 1, '7e6a01a850a9318c7dcf4eab3e957a93.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`),
  ADD KEY `idbarang` (`idbarang`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`),
  ADD KEY `idbarang` (`idbarang`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keluar`
--
ALTER TABLE `keluar`
  ADD CONSTRAINT `keluar_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `stock` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masuk`
--
ALTER TABLE `masuk`
  ADD CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `stock` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
