-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for stock_barang
DROP DATABASE IF EXISTS `stock_barang`;
CREATE DATABASE IF NOT EXISTS `stock_barang` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `stock_barang`;

-- Dumping structure for table stock_barang.keluar
DROP TABLE IF EXISTS `keluar`;
CREATE TABLE IF NOT EXISTS `keluar` (
  `idkeluar` int NOT NULL AUTO_INCREMENT,
  `idbarang` int NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `penerima` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `penyerah` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`idkeluar`),
  KEY `idbarang` (`idbarang`),
  CONSTRAINT `keluar_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `stock` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table stock_barang.keluar: ~0 rows (approximately)
REPLACE INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `penyerah`, `qty`) VALUES
	(23, 67, '2023-05-15 21:39:15', 'Kantor Cabang Kebumen', 'Bu Ning', 50),
	(24, 70, '2024-01-10 15:34:35', 'dsa;dsa', 'skdals', 1),
	(25, 70, '2024-01-10 15:53:52', 'syaukul', 'haekal', 91),
	(26, 70, '2024-01-10 16:02:53', 'asd', 'sda', 9),
	(27, 70, '2024-01-10 16:05:53', 'fsafas', 'fasfsa', 910),
	(28, 65, '2024-01-10 16:07:47', 'dsa', 'faffa', 94),
	(29, 69, '2024-01-10 16:57:07', 'dsadsa', 'k;jasf', 10),
	(30, 69, '2024-01-10 16:59:50', 'fsf', 'fgsfs', 5);

-- Dumping structure for table stock_barang.login
DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table stock_barang.login: ~26 rows (approximately)
REPLACE INTO `login` (`iduser`, `email`, `password`, `photo`) VALUES
	(1, 'virgofajar123@gmail.com', '123', 'IMG20171203172929.jpg'),
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

-- Dumping structure for table stock_barang.masuk
DROP TABLE IF EXISTS `masuk`;
CREATE TABLE IF NOT EXISTS `masuk` (
  `idmasuk` int NOT NULL AUTO_INCREMENT,
  `idbarang` int NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keterangan` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `penyerah` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`idmasuk`),
  KEY `idbarang` (`idbarang`),
  CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `stock` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table stock_barang.masuk: ~0 rows (approximately)
REPLACE INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `penyerah`, `qty`) VALUES
	(31, 67, '2023-05-15 21:38:01', 'Towud', 'Bu Ning', 50),
	(33, 69, '2023-08-12 06:09:51', 'Kantor Cabang Kebumen', 'Bu Ning', 10),
	(34, 70, '2024-01-10 15:50:52', 'dsa', 'dsa', 100),
	(35, 70, '2024-01-10 16:05:24', 'sdaf', 'k;fsjafkjsal', 1000);

-- Dumping structure for table stock_barang.stock
DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `idbarang` int NOT NULL AUTO_INCREMENT,
  `namabarang` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `stock` int NOT NULL,
  `image` varchar(99) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kategori` enum('Marketing Kit','Kendaraan','ATK','Lain - lain','Brosur') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table stock_barang.stock: ~5 rows (approximately)
REPLACE INTO `stock` (`idbarang`, `namabarang`, `deskripsi`, `stock`, `image`, `kategori`) VALUES
	(65, 'Brosur KUR', 'Marketing Kit', 6, 'b18affd703221cf977be17c0ceb9c55b.png', 'Marketing Kit'),
	(67, 'Payung', 'Marketing KIT', 100, '5a682186e49eb3c8677c45eb5c3e76e6.jpeg', 'Marketing Kit'),
	(68, 'Kaos', 'Marketing KIT', 60, 'e8046b27af2be091f8d72bdd4b73fd11.jpg', 'Marketing Kit'),
	(69, 'Banner', 'Marketing KIT', 0, 'e05a7e26d8ca3e920c7d16f0f99f05fd.jpg', 'Marketing Kit'),
	(70, 'Helm', 'marketing', 90, '7e6a01a850a9318c7dcf4eab3e957a93.png', 'Marketing Kit'),
	(71, 'Mobil', 'hjbjbjhbhbhhhhhhhhhh', 2, NULL, 'Kendaraan');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
