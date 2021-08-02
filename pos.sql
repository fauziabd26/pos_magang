-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Agu 2021 pada 09.30
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_trans_produk`
--

CREATE TABLE `detail_trans_produk` (
  `id_detail_trans_produk` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_produk`
--

CREATE TABLE `foto_produk` (
  `id_foto_produk` int(11) NOT NULL,
  `nama_foto_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(11) NOT NULL,
  `nama_harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_toko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_toko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_kategori`
--

CREATE TABLE `produk_kategori` (
  `id_produk_kategori` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `nama_cust` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bayar` int(11) NOT NULL,
  `jenis_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tggl_transaksi` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `id_user` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_trans_produk`
--
ALTER TABLE `detail_trans_produk`
  ADD PRIMARY KEY (`id_detail_trans_produk`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`id_foto_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD PRIMARY KEY (`id_produk_kategori`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_trans_produk`
--
ALTER TABLE `detail_trans_produk`
  MODIFY `id_detail_trans_produk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto_produk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk_kategori`
--
ALTER TABLE `produk_kategori`
  MODIFY `id_produk_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_trans_produk`
--
ALTER TABLE `detail_trans_produk`
  ADD CONSTRAINT `detail_trans_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `detail_trans_produk_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `detail_trans_produk_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD CONSTRAINT `foto_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD CONSTRAINT `harga_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Ketidakleluasaan untuk tabel `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD CONSTRAINT `produk_kategori_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `produk_kategori_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD CONSTRAINT `satuan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `toko_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
