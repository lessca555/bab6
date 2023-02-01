-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2023 at 03:22 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perkuliahan`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `RankingPerJur` (IN `JURUSAN` VARCHAR(2))   SELECT krs.NIM, mahasiswa.Nama, krs.kodeMK,  ( CASE WHEN
krs.NilaiUTS*0.4 + krs.NilaiUAS * 0.6 >= 76 THEN (('4'*matkul.SKS)/
matkul.SKS) WHEN krs.NilaiUTS*0.4 + krs.NilaiUAS * 0.6 >= 66 &&
krs.NilaiUTS*0.4 + krs.NilaiUAS * 0.6 <=76 THEN (('3'*matkul.SKS)/
matkul.SKS) WHEN krs.NilaiUTS*0.4 + krs.NilaiUAS * 0.6 >=56 &&
krs.NilaiUTS*0.4 + krs.NilaiUAS * 0.6 <=66 THEN (('2'*matkul.SKS)/
matkul.SKS) WHEN krs.NilaiUTS*0.4 + krs.NilaiUAS * 0.6 >=36 &&
krs.NilaiUTS*0.4 + krs.NilaiUAS * 0.6 <=56 THEN(('1'*matkul.SKS)/
matkul.SKS) ELSE 0 END ) as IP FROM mahasiswa, matkul, krs$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `auditnilai`
--

CREATE TABLE `auditnilai` (
  `NIM` varchar(10) NOT NULL,
  `kodeMK` varchar(6) NOT NULL,
  `NilaiUTSAsal` decimal(5,0) NOT NULL,
  `NilaiUASAsal` decimal(5,0) NOT NULL,
  `NilaiUTSUpd` decimal(5,0) NOT NULL,
  `NilaiUASUpd` decimal(5,0) NOT NULL,
  `TanggalUpd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auditnilai`
--

INSERT INTO `auditnilai` (`NIM`, `kodeMK`, `NilaiUTSAsal`, `NilaiUASAsal`, `NilaiUTSUpd`, `NilaiUASUpd`, `TanggalUpd`) VALUES
('112021005', 'JK', '95', '95', '85', '90', '2023-01-30 11:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `KodeFakultas` varchar(2) NOT NULL,
  `NamaFakultas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`KodeFakultas`, `NamaFakultas`) VALUES
('FH', 'Fakultas Hukum'),
('FT', 'Teknik');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `KodeJurusan` varchar(2) NOT NULL,
  `NamaJurusan` varchar(30) NOT NULL,
  `KodeFK` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`KodeJurusan`, `NamaJurusan`, `KodeFK`) VALUES
('TK', 'Teknologi Komputer', 'FT');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `no` int(11) NOT NULL,
  `NIM` varchar(10) NOT NULL,
  `kodeMK` varchar(6) NOT NULL,
  `NilaiUTS` decimal(9,0) NOT NULL,
  `NilaiUAS` decimal(9,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`no`, `NIM`, `kodeMK`, `NilaiUTS`, `NilaiUAS`) VALUES
(1, '112021003', 'JK', '100', '100'),
(2, '112021005', 'JK', '85', '90'),
(3, '112021003', 'PBO', '100', '75'),
(4, '112021005', 'PBO', '95', '85'),
(5, '112021003', 'JK', '80', '90');

--
-- Triggers `krs`
--
DELIMITER $$
CREATE TRIGGER `auditnilai` AFTER UPDATE ON `krs` FOR EACH ROW BEGIN
INSERT INTO auditnilai
SET NIM=old.NIM,
kodeMK=old.kodeMK,
nilaiUTSAsal=old.NilaiUTS,
nilaiUASAsal=old.NilaiUAS,
NilaiUTSUpd=new.NilaiUTS,
nilaiUASUpd=new.NilaiUAS,
TanggalUpd=now();
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` varchar(10) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `TempatLahir` varchar(30) NOT NULL,
  `TanggalLahir` datetime NOT NULL,
  `Alamat` varchar(40) NOT NULL,
  `KodeJurusan` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `Nama`, `TempatLahir`, `TanggalLahir`, `Alamat`, `KodeJurusan`) VALUES
('112021003', 'Christian', 'surabaya', '2022-11-18 10:45:02', 'mulyosari', 'TK'),
('112021005', 'Zaki', 'Surabaya', '2022-11-18 10:45:02', 'Manukan', 'TK');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `kodeMK` varchar(6) NOT NULL,
  `namaMK` varchar(40) NOT NULL,
  `SKS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`kodeMK`, `namaMK`, `SKS`) VALUES
('JK', 'Jaringan Komputer', 3),
('PBO', 'Pemrograman Berbasis Object', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`KodeFakultas`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`KodeJurusan`),
  ADD UNIQUE KEY `KodeFK` (`KodeFK`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`no`),
  ADD KEY `kodeMK` (`kodeMK`),
  ADD KEY `NIM` (`NIM`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`),
  ADD KEY `KodeJur` (`KodeJurusan`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`kodeMK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`KodeFK`) REFERENCES `fakultas` (`KodeFakultas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`NIM`) REFERENCES `mahasiswa` (`NIM`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krs_ibfk_2` FOREIGN KEY (`kodeMK`) REFERENCES `matkul` (`kodeMK`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`KodeJurusan`) REFERENCES `jurusan` (`KodeJurusan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
