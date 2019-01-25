-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Jul 2018 pada 19.04
-- Versi Server: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_soa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE IF NOT EXISTS `detail_pesanan` (
  `id` int(11) NOT NULL,
  `pakaian` varchar(100) NOT NULL,
  `id_pesanan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `pakaian`, `id_pesanan`) VALUES
(1, 'Baju', 1),
(2, 'Celana', 1),
(8, 'Celana Panjang', 10),
(9, 'Celana Jeans', 10),
(10, 'Kaos Kaki', 10),
(11, 'Other', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laundry`
--

CREATE TABLE IF NOT EXISTS `laundry` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `short_url` varchar(100) NOT NULL,
  `gambar` text NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laundry`
--

INSERT INTO `laundry` (`id`, `nama`, `alamat`, `telp`, `kota`, `email`, `username`, `password`, `latitude`, `longitude`, `short_url`, `gambar`, `rating`) VALUES
(1, 'Laundry A', '801 S Hope St A, Los Angeles, CA 90017', '', 'Surabaya', '', 'a', 'a', 34.046438, -118.259653, 'https://goo.gl/maps/L8ETMBt7cRA2', 'img/laundry-logo.jpg', 5),
(2, 'Laundry B', '525 Santa Monica Blvd, Santa Monica, CA 90401', '', 'Surabaya', '', 'b', 'b', 34.017951, -118.493567, 'https://goo.gl/maps/PY1abQhuW9C2', 'img/laundry-logo.jpg', 2),
(3, 'Laundry C', '146 South Lake Avenue #106, At Shoppers Lane, Pasadena, CA 91101', '', 'Surabaya', '', 'c', 'c', 34.143073, -118.13204, 'https://goo.gl/maps/eUmyNuMyYNN2', 'img/laundry-logo.jpg', 1),
(4, 'Laundry D', '21016 Pacific Coast Hwy, Huntington Beach, CA 92648', '', 'Surabaya', '', '', '', 34.105199, -118.35864, 'https://goo.gl/maps/Cp2TZoeGCXw', 'img/laundry-logo.jpg', 3),
(5, 'Laundry E', '252 S Brand Blvd, Glendale, CA 91204', '', 'Surabaya', '', '', '', 34.142823, -118.254569, 'https://goo.gl/maps/WDr2ef3ccVz', 'img/laundry-logo.jpg', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE IF NOT EXISTS `pesanan` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `berat` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_laundry` int(11) NOT NULL,
  `harga` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `kode`, `berat`, `status`, `tgl_masuk`, `tgl_keluar`, `id_user`, `id_laundry`, `harga`) VALUES
(1, '1234', 23, 1, '2018-06-01', '2018-06-09', 1, 2, 25000),
(4, '8752', 44, 2, '2018-06-20', '2018-06-23', 2, 2, 70400),
(5, '2235', 15, 0, '2018-06-07', '2018-06-14', 2, 2, 0),
(8, '64883670', 0, 0, '0000-00-00', '0000-00-00', 1, 1, 0),
(10, '95129132', 0, 0, '0000-00-00', '0000-00-00', 1, 4, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `kota`, `alamat`, `telp`, `email`, `username`, `password`) VALUES
(1, 'Billy Jonathan', 'Surabaya', 'Nginden Intan Timur VIII/5 Blok E2-3', '081217841555', 'm26415058@john.petra.ac.id', 'Biljo', '12345'),
(2, 'Antonio Chandra', '087853174418', 'Lebak Indah Mas 2/12', 'Surabaya', 'antoniochandra12@gmail.com', 'anton', 'anton');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry`
--
ALTER TABLE `laundry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `laundry`
--
ALTER TABLE `laundry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
