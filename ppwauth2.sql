-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2023 at 08:11 PM
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
-- Database: `ppwauth2`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(128) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `email`) VALUES
(7, 'risalahqolbu859@gmail.com'),
(8, 'risal@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(64) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `email`, `password`) VALUES
(0, 'risal@gmail.com', 'risal');

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `noreg` int(11) NOT NULL,
  `ttl` text NOT NULL,
  `email` text NOT NULL,
  `telepon` text NOT NULL,
  `ibu` text NOT NULL,
  `ayah` text NOT NULL,
  `alamatlengkap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `nama`, `noreg`, `ttl`, `email`, `telepon`, `ibu`, `ayah`, `alamatlengkap`) VALUES
(7, 'werwerwer', 1313622016, 'jember', 'risalahqolbu859@gmail.com', '79879879', 'ibu', 'ayah', 'bekasi'),
(8, '', 0, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `matkulkhs`
--

CREATE TABLE `matkulkhs` (
  `id` int(11) NOT NULL,
  `matkulkhs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkulkhs`
--

INSERT INTO `matkulkhs` (`id`, `matkulkhs`) VALUES
(7, '{\"2021\":[[\"Kalkulus Diferensial\",12001,95],[\"Perancangan Program\",12002,86],[\"Pemrograman Dasar\",12003,87],[\"Statistika Dasar\",12004,81],[\"Komputasi Dasar\",12005,82],[\"Matematika 2\",12006,92],[\"Etika Profesi\",12007,95]],\"2022\":[[\"Kalkulus Integral\",13001,76],[\"Perancangan Software\",13002,75],[\"Pemrograman Objek\",13003,96],[\"Aljabar Linear\",13004,97],[\"Data Raya\",13005,73],[\"Kecerdasan buatan\",13006,90],[\"Etika Profesi\",13007,95],[\"Komputer Masyarakat\",13008,92]]}'),
(8, '{\"2021\":[[\"Kalkulus Diferensial\",12001,92],[\"Perancangan Program\",12002,91],[\"Pemrograman Dasar\",12003,89],[\"Statistika Dasar\",12004,83],[\"Komputasi Dasar\",12005,89],[\"Matematika 2\",12006,95],[\"Etika Profesi\",12007,83]],\"2022\":[[\"Kalkulus Integral\",13001,75],[\"Perancangan Software\",13002,96],[\"Pemrograman Objek\",13003,71],[\"Aljabar Linear\",13004,68],[\"Data Raya\",13005,71],[\"Kecerdasan buatan\",13006,77],[\"Etika Profesi\",13007,92],[\"Komputer Masyarakat\",13008,85]]}');

-- --------------------------------------------------------

--
-- Table structure for table `matkulkrs`
--

CREATE TABLE `matkulkrs` (
  `id` int(11) NOT NULL,
  `krs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkulkrs`
--

INSERT INTO `matkulkrs` (`id`, `krs`) VALUES
(7, '[[\"Kalkulus Integral 2\",14001],[\"Maha Data\",14002],[\"Automata\",14003],[\"Penelitian Ilmiah\",14004],[\"Metode Numerik\",14005],[\"Manajemen Proyek\",14006]]'),
(8, '[[\"Kalkulus Integral 2\",14001],[\"Maha Data\",14002],[\"Automata\",14003],[\"Penelitian Ilmiah\",14004],[\"Metode Numerik\",14005],[\"Manajemen Proyek\",14006]]');

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

CREATE TABLE `tes` (
  `id` int(11) NOT NULL,
  `json` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes`
--

INSERT INTO `tes` (`id`, `json`) VALUES
(2, '{\"2021\":[[\"Kalkulus Diferensial\",12001,76],[\"Perancangan Program\",12002,89],[\"Pemrograman Dasar\",12003,83],[\"Statistika Dasar\",12004,89],[\"Komputasi Dasar\",12005,70],[\"Matematika 2\",12006,78],[\"Etika Profesi\",12007,67]],\"2022\":[[\"Kalkulus Integral\",13001,97],[\"Perancangan Software\",13002,74],[\"Pemrograman Objek\",13003,79],[\"Aljabar Linear\",13004,91],[\"Data Raya\",13005,94],[\"Kecerdasan buatan\",13006,83],[\"Etika Profesi\",13007,75],[\"Komputer Masyarakat\",13008,74]]}'),
(23, '{\"2021\":[[\"Kalkulus Diferensial\",12001,85],[\"Perancangan Program\",12002,96],[\"Pemrograman Dasar\",12003,80],[\"Statistika Dasar\",12004,74],[\"Komputasi Dasar\",12005,97],[\"Matematika 2\",12006,87],[\"Etika Profesi\",12007,89]],\"2022\":[[\"Kalkulus Integral\",13001,92],[\"Perancangan Software\",13002,92],[\"Pemrograman Objek\",13003,78],[\"Aljabar Linear\",13004,93],[\"Data Raya\",13005,88],[\"Kecerdasan buatan\",13006,70],[\"Etika Profesi\",13007,97],[\"Komputer Masyarakat\",13008,78]]}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matkulkhs`
--
ALTER TABLE `matkulkhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matkulkrs`
--
ALTER TABLE `matkulkrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tes`
--
ALTER TABLE `tes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
