-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 06:32 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockbarang`
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
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `qty`) VALUES
(8, 15, '2022-10-27 16:39:08', 'Andy', 20),
(13, 11, '2022-10-28 09:55:33', 'Virgo', 2),
(14, 26, '2022-11-09 06:48:58', 'test', 1),
(15, 15, '2022-11-12 02:25:47', 'Bu Ning', 3),
(16, 61, '2022-11-16 08:34:04', 'Virgo', 3931),
(17, 62, '2022-11-16 08:34:18', 'Andy', 20),
(18, 62, '2022-11-16 08:34:28', 'Cabang Purwokerto', 1),
(19, 63, '2022-11-16 08:34:49', 'Virgo', 2),
(20, 61, '2022-11-20 16:43:22', 'Andy', 7),
(21, 65, '2022-11-20 17:23:40', 'Cabang Purwokerto', 50),
(22, 66, '2022-11-20 17:31:05', 'Cabang Purwokerto', 2);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(1, 'virgofajar123@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`) VALUES
(13, 15, '2022-10-27 15:57:44', 'Bu Ning', 10),
(14, 11, '2022-10-28 09:55:55', 'test', 2),
(15, 14, '2022-10-28 14:51:12', 'Andy', 300),
(16, 26, '2022-11-09 06:10:00', 'Virgo', 2),
(18, 28, '2022-11-10 07:35:25', 'Habib', 1),
(22, 61, '2022-11-16 08:05:26', 'Virgo', 8321),
(23, 61, '2022-11-16 08:32:46', 'Andy', 12),
(24, 62, '2022-11-16 08:33:02', 'mwah', 150),
(25, 63, '2022-11-16 08:33:22', 'Bu Ning', 3291),
(26, 61, '2022-11-16 08:41:00', 'Bu Ning', 2),
(27, 64, '2022-11-17 17:10:54', 'Cabang Purwokerto', 2),
(28, 61, '2022-11-20 16:41:52', 'Cabang Purwokerto', 3),
(29, 65, '2022-11-20 16:55:01', 'Cabang Purwokerto', 300),
(30, 66, '2022-11-20 17:04:12', 'Cabang Purwokerto', 5);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `deskripsi`, `stock`, `image`) VALUES
(65, 'Brosur KUR', 'Marketing Kit', 350, 'b18affd703221cf977be17c0ceb9c55b.png'),
(66, 'Payung', 'Marketing Kit', 13, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

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
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
