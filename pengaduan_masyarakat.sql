-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2020 pada 07.55
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_masyarakat`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detail_aduans_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detail_aduans_view` (
`id_pengaduan` varchar(100)
,`nik` varchar(50)
,`id_kategori` int(11)
,`tgl_pengaduan` date
,`isi_laporan` longtext
,`foto` varchar(255)
,`status` enum('0','proses','selesai')
,`tgl_tanggapan` date
,`tanggapan` longtext
,`id_petugas` int(11)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(2, 'Infrastruktur', '2020-11-22 06:12:23', '2020-11-22 06:12:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masyarakats`
--

CREATE TABLE `masyarakats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `masyarakats`
--

INSERT INTO `masyarakats` (`id`, `nik`, `avatar`, `nama_lengkap`, `username`, `password`, `telp`, `created_at`, `updated_at`) VALUES
(1, '1111111111112323213213', '20201123032247.png', 'Aditya Muhamad Putra', 'aditya', '$2y$10$rR5QqeUpZwmOSAWJgk6ETOjuO9ZpRW4eOBZmCkKH89PgydsHmWFyq', '081222534938', '2020-11-22 07:17:38', '2020-11-22 20:22:47'),
(2, '1213123123213132131232', 'user.png', 'Bang Temon', 'temon', '$2y$10$ol8uiKeKL2JFJp8HG7CWrOO3vBWuhw1HCJtZc/zIgaeFb3yVa3M4a', '081222534937', '2020-11-22 08:39:50', '2020-11-22 08:39:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(19, '2019_08_19_000000_create_failed_jobs_table', 1),
(20, '2020_11_21_131344_create_petugas_table', 1),
(21, '2020_11_21_131400_create_pengaduans_table', 1),
(22, '2020_11_21_131412_create_tanggapans_table', 1),
(23, '2020_11_21_131436_create_masyarakats_table', 1),
(24, '2020_11_21_132428_create_kategoris_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduans`
--

CREATE TABLE `pengaduans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pengaduan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `nik` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_laporan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','proses','selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengaduans`
--

INSERT INTO `pengaduans` (`id`, `id_pengaduan`, `id_kategori`, `tgl_pengaduan`, `nik`, `isi_laporan`, `foto`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'P0001', 2, '2020-11-22', '1213123123213132131232', '<p>Aya ucingg</p>', '[\"1606208579.png\",\"1606208579.JPG\"]', 'selesai', NULL, '2020-11-22 08:40:35', '2020-11-23 03:38:17'),
(2, 'P0002', 2, '2020-11-23', '1213123123213132131232', '<p>Aya ibu-ibu gais</p>', '[\"1606208579.png\",\"1606208579.JPG\"]', 'selesai', NULL, '2020-11-23 15:00:53', '2020-11-26 03:37:08'),
(3, 'P0003', 2, '2020-11-24', '1213123123213132131232', '<p>ASSALAMU\'ALAIKUM</p>', '[\"1606208579.png\",\"1606208579.JPG\"]', '0', NULL, '2020-11-24 07:13:24', '2020-11-24 07:13:24'),
(4, 'P0004', 2, '2020-11-24', '1213123123213132131232', '<p>TEST MANG!</p>', '[\"1606208579.png\",\"1606208579.JPG\"]', '0', NULL, '2020-11-24 09:01:22', '2020-11-24 09:01:22'),
(5, 'P0005', 2, '2020-11-24', '1213123123213132131232', '<p>ASDADSAS</p>', '[\"1606208579.png\",\"1606208579.JPG\"]', '0', NULL, '2020-11-24 09:02:59', '2020-11-24 09:02:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_petugas` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `username`, `password`, `avatar`, `telp`, `role`, `last_seen`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$6J2AihQSJCa.cJMCPhzX2ejmXALjKRt7lDI5Oi6GTA7LPf601/F3K', 'avatar.png', '081222534938', 'admin', '2020-11-26 06:47:25', '2020-11-22 05:53:34', '2020-11-26 06:47:25'),
(2, 'Okisa', 'okisa', '$2y$10$SEhmBw0Ps0tdcGPVTe5LO.eqWUNHsMMevi.uUFi4WRAoBERw3jC3W', 'avatar.png', '081222534937', 'petugas', '2020-11-26 03:06:38', '2020-11-26 02:42:53', '2020-11-26 03:06:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapans`
--

CREATE TABLE `tanggapans` (
  `id_tanggapan` bigint(20) UNSIGNED NOT NULL,
  `id_pengaduan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `tanggapan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tanggapans`
--

INSERT INTO `tanggapans` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`, `created_at`, `updated_at`) VALUES
(1, 'P0001', '2020-11-22', 'Maksudna naon mang?', 1, '2020-11-22 08:41:00', '2020-11-22 08:41:00'),
(3, 'P0002', '2020-11-26', '<ul><li>asdfasfasf</li><li>afadsfasdf</li><li>adfasfdsaf</li></ul>', 1, '2020-11-26 03:36:45', '2020-11-26 03:36:45');

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_aduans_view`
--
DROP TABLE IF EXISTS `detail_aduans_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_aduans_view`  AS  select `t`.`id_pengaduan` AS `id_pengaduan`,`p`.`nik` AS `nik`,`p`.`id_kategori` AS `id_kategori`,`p`.`tgl_pengaduan` AS `tgl_pengaduan`,`p`.`isi_laporan` AS `isi_laporan`,`p`.`foto` AS `foto`,`p`.`status` AS `status`,`t`.`tgl_tanggapan` AS `tgl_tanggapan`,`t`.`tanggapan` AS `tanggapan`,`t`.`id_petugas` AS `id_petugas` from (`pengaduans` `p` join `tanggapans` `t` on((`t`.`id_pengaduan` = `p`.`id_pengaduan`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `masyarakats`
--
ALTER TABLE `masyarakats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tanggapans`
--
ALTER TABLE `tanggapans`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id_kategori` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `masyarakats`
--
ALTER TABLE `masyarakats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pengaduans`
--
ALTER TABLE `pengaduans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tanggapans`
--
ALTER TABLE `tanggapans`
  MODIFY `id_tanggapan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
