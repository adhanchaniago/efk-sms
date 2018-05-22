-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Bulan Mei 2018 pada 02.43
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u422738906_stock`
--
CREATE DATABASE IF NOT EXISTS `u422738906_stock` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `u422738906_stock`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota` (
  `id_anggota` varchar(25) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto` varchar(25) NOT NULL DEFAULT 'avatar_placeholder.jpg',
  `register_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `verifikasi` enum('1','0') NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `level` enum('Admin','Anggota') NOT NULL DEFAULT 'Anggota',
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `register_time` datetime DEFAULT NULL,
  `verifikasi_time` datetime DEFAULT NULL,
  `reset_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_barang`
--

DROP TABLE IF EXISTS `master_barang`;
CREATE TABLE `master_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `qty` varchar(5) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL,
  `deleted` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kategori`
--

DROP TABLE IF EXISTS `master_kategori`;
CREATE TABLE `master_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL,
  `deleted` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `smsgateway_callback`
--

DROP TABLE IF EXISTS `smsgateway_callback`;
CREATE TABLE `smsgateway_callback` (
  `id_callback` int(11) NOT NULL,
  `no_hp` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `callback` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `id_stock` char(8) NOT NULL,
  `id_barang` char(6) NOT NULL,
  `qty` int(11) NOT NULL,
  `sign` varchar(5) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_stock`
--

DROP TABLE IF EXISTS `transaksi_stock`;
CREATE TABLE `transaksi_stock` (
  `id_barang` int(11) NOT NULL,
  `in_stock` int(11) DEFAULT NULL,
  `out_stock` int(11) DEFAULT NULL,
  `on_stock` int(11) DEFAULT NULL,
  `stock_before` int(11) DEFAULT NULL,
  `sign` varchar(5) NOT NULL,
  `keterangan` varchar(25) DEFAULT NULL,
  `notes` varchar(250) NOT NULL DEFAULT '-',
  `created_time` datetime NOT NULL,
  `created_by` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `no_hp` (`no_hp`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`no_hp`);

--
-- Indeks untuk tabel `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `kategori` (`id_kategori`);

--
-- Indeks untuk tabel `master_kategori`
--
ALTER TABLE `master_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `smsgateway_callback`
--
ALTER TABLE `smsgateway_callback`
  ADD PRIMARY KEY (`id_callback`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `transaksi_stock`
--
ALTER TABLE `transaksi_stock`
  ADD KEY `id_barang` (`id_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `master_barang`
--
ALTER TABLE `master_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `master_kategori`
--
ALTER TABLE `master_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `smsgateway_callback`
--
ALTER TABLE `smsgateway_callback`
  MODIFY `id_callback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`no_hp`) REFERENCES `login` (`no_hp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `master_barang`
--
ALTER TABLE `master_barang`
  ADD CONSTRAINT `master_barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `master_kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `transaksi_stock`
--
ALTER TABLE `transaksi_stock`
  ADD CONSTRAINT `transaksi_stock_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `master_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
