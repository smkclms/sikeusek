-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20 Jun 2025 pada 16.53
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `keuangan_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggaran`
--

CREATE TABLE IF NOT EXISTS `anggaran` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `jumlah_anggaran` decimal(15,2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggaran`
--

INSERT INTO `anggaran` (`id`, `user_id`, `jumlah_anggaran`, `tahun`, `created_at`) VALUES
(2, 3, '500000.00', 2025, '2025-06-20 07:33:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_rekening`
--

CREATE TABLE IF NOT EXISTS `kode_rekening` (
`id` int(11) unsigned NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama_rekening` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kode_rekening`
--

INSERT INTO `kode_rekening` (`id`, `kode`, `nama_rekening`, `created_at`) VALUES
(1, '11124', 'ATK', '2025-06-20 03:22:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE IF NOT EXISTS `log_aktivitas` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `waktu_aktivitas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE IF NOT EXISTS `pengeluaran` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jumlah_pengeluaran` decimal(15,2) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `kode_rekening_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `user_id`, `tanggal_pengeluaran`, `jumlah_pengeluaran`, `keterangan`, `kode_rekening_id`, `created_at`) VALUES
(7, 3, '2025-06-20', '20000.00', 'pbeli penghapus', 1, '2025-06-20 07:52:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumber_anggaran`
--

CREATE TABLE IF NOT EXISTS `sumber_anggaran` (
`id` int(11) unsigned NOT NULL,
  `nama_sumber` varchar(255) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sumber_anggaran`
--

INSERT INTO `sumber_anggaran` (`id`, `nama_sumber`, `jumlah`, `created_at`) VALUES
(4, 'BOSP', '1000000.00', '2025-06-20 07:13:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('bendahara','operator','pengguna') NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nama_lengkap`, `foto`, `created_at`) VALUES
(1, 'bendahara', '$2y$10$yourhashedpassword', 'bendahara', 'Bendahara Sekolah', NULL, '2025-06-20 02:53:57'),
(2, 'admin', '$2y$10$RWto3ZgpJhpHZMsCfW4vB..egS3CEhjAIJ.2GoCeuouj1OifNzdSK', 'bendahara', 'Sukirman', '1750408780.jpg', '2025-06-20 03:11:05'),
(3, 'perkantoran', '$2y$10$6DJCXx73C/3naQ8LBZunk.nOyi5EicQoJTsIesh2.yRQS4cIgQiGC', 'pengguna', 'MPLB', NULL, '2025-06-20 03:51:57'),
(4, 'pemasaran', '$2y$10$T3IJjy.3LKYU6sSGIkxZ6Om//4PkLjJQ7BqybTHPvZbX7.Ui2FyC.', 'pengguna', 'Pemasaran', NULL, '2025-06-20 06:46:54'),
(5, 'kuliner', '$2y$10$QWAUbOXu4NWP2JRucy66iOQ1amKrEB1vZT5oramWJNNRBPLrnKSke', 'pengguna', 'Kuliner', NULL, '2025-06-20 06:47:15'),
(6, 'perhotelan', '$2y$10$CWDfOm41KDng.mru9Pa0U.Sq54O4G.WQqpf4.ZIFukm73WrF/pvZS', 'pengguna', 'Perhotelan', NULL, '2025-06-20 07:09:47'),
(7, 'ulp', '$2y$10$7e4v68n7EtrpAN3C.ghqquvQ6bsx850/KvXqG/taHt6p4O9PHFXm2', 'pengguna', 'ULP', NULL, '2025-06-20 07:10:06'),
(8, 'kurikulum', '$2y$10$dN7yJXTa7tjdcuvygK3NvOw7.eqt4lN3UFotUAxmcwakekgfzjDUy', 'pengguna', 'Kurikulum', NULL, '2025-06-20 07:11:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `kode_rekening`
--
ALTER TABLE `kode_rekening`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `kode_rekening_id` (`kode_rekening_id`);

--
-- Indexes for table `sumber_anggaran`
--
ALTER TABLE `sumber_anggaran`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggaran`
--
ALTER TABLE `anggaran`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kode_rekening`
--
ALTER TABLE `kode_rekening`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sumber_anggaran`
--
ALTER TABLE `sumber_anggaran`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
ADD CONSTRAINT `anggaran_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`kode_rekening_id`) REFERENCES `kode_rekening` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
