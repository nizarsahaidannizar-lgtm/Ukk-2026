-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Sep 2026 pada 07.26
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ukk_2026`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_guru`
--

CREATE TABLE `t_guru` (
  `id` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_guru`
--

INSERT INTO `t_guru` (`id`, `nip`, `nama`, `email`, `status_aktif`, `created_at`, `updated_at`, `user_id`) VALUES
(16, '198501152010011001', 'Ahmad Dahlan, S.Pd.', 'ahmad.dahlan@sekolah.sch.id', 1, '2026-09-23 04:09:39', '2026-09-23 04:09:39', 1),
(17, '198803222012022002', 'Siti Rahmawati, M.Pd.', 'siti.rahmawati@sekolah.sch.id', 1, '2026-09-23 04:09:39', '2026-09-23 04:09:39', 2),
(18, '199007102015031003', 'Budi Santoso, S.Kom.', 'budi.santoso@sekolah.sch.id', 1, '2026-09-23 04:09:39', '2026-09-23 04:09:39', 3),
(19, '199211052018012004', 'Dewi Lestari, S.Si.', 'dewi.lestari@sekolah.sch.id', 1, '2026-09-23 04:09:39', '2026-09-23 04:09:39', 4),
(20, '198704122011011005', 'Eko Prasetyo, S.T.', 'eko.prasetyo@sekolah.sch.id', 0, '2026-09-23 04:09:39', '2026-09-23 04:09:39', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kelas`
--

CREATE TABLE `t_kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tingkat` varchar(20) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_kelas`
--

INSERT INTO `t_kelas` (`id`, `nama`, `tingkat`, `jurusan`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'X RPL 1', 'X', 'Rekayasa Perangkat Lunak', 1, '2026-09-23 02:51:43', '2026-09-23 02:51:43'),
(2, 'X TKJ 2', 'X', 'Teknik Komputer dan Jaringan', 1, '2026-09-23 02:51:43', '2026-09-23 02:51:43'),
(3, 'XI TSM 1', 'XI', 'Akuntansi dan Keuangan Lembaga', 1, '2026-09-23 02:51:43', '2026-09-23 02:51:43'),
(4, 'XI TBSM 3', 'XI', 'Otomatisasi dan Tata Kelola Perkantoran', 1, '2026-09-23 02:51:43', '2026-09-23 02:51:43'),
(5, 'XII BD 1', 'XII', 'Desain Komunikasi Visual', 1, '2026-09-23 02:51:43', '2026-09-23 02:51:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kelas_siswa`
--

CREATE TABLE `t_kelas_siswa` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pelanggaran`
--

CREATE TABLE `t_pelanggaran` (
  `id` int(11) NOT NULL,
  `pelanggaran_kategori_id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `poin` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pelanggaran`
--

INSERT INTO `t_pelanggaran` (`id`, `pelanggaran_kategori_id`, `kode`, `nama`, `poin`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 1, 'DIS-001', 'Terlambat Masuk Sekolah', 5, 'Datang ke sekolah lebih dari 15 menit setelah bel masuk', 1, '2026-09-23 03:36:40', '2026-09-23 03:36:40'),
(2, 2, 'RAP-001', 'Tidak Menggunakan Seragam Sesuai Jadwal', 10, 'Menggunakan pakaian seragam yang tidak sesuai ketentuan hari', 1, '2026-09-23 03:36:40', '2026-09-23 03:36:40'),
(3, 3, 'SOP-001', 'Bersikap Tidak Sopan Kepada Guru', 25, 'Mengeluarkan kata-kata kasar atau tidak sopan kepada tenaga pendidik', 1, '2026-09-23 03:36:40', '2026-09-23 03:36:40'),
(4, 4, 'KET-001', 'Bermain HP Saat Jam Pelajaran', 15, 'Menggunakan ponsel saat KBM berlangsung tanpa izin guru', 1, '2026-09-23 03:36:40', '2026-09-23 03:36:40'),
(5, 5, 'BRT-001', 'Mewarnai Rambut / Tato', 50, 'Mengecat rambut dengan warna menyolok atau memiliki tato', 1, '2026-09-23 03:36:40', '2026-09-23 03:36:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pelanggaran_kategori`
--

CREATE TABLE `t_pelanggaran_kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pelanggaran_kategori`
--

INSERT INTO `t_pelanggaran_kategori` (`id`, `nama`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Kedisiplinan', 'Pelanggaran yang berkaitan dengan tata tertib waktu dan kehadiran', 1, '2026-09-23 03:00:51', '2026-09-23 03:00:51'),
(2, 'Kerapihan', 'Pelanggaran terkait aturan berpakaian, atribut, dan penampilan', 1, '2026-09-23 03:00:51', '2026-09-23 03:00:51'),
(3, 'Sopan Santun', 'Pelanggaran sikap dan perilaku terhadap guru, staf, atau sesama siswa', 1, '2026-09-23 03:00:51', '2026-09-23 03:00:51'),
(4, 'Ketertiban', 'Pelanggaran yang mengganggu suasana belajar mengajar dan lingkungan', 1, '2026-09-23 03:00:51', '2026-09-23 03:00:51'),
(5, 'Pelanggaran Berat', 'Pelanggaran yang berpotensi merusak nama baik sekolah atau ranah hukum', 1, '2026-09-23 03:00:51', '2026-09-23 03:00:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pelanggaran_siswa`
--

CREATE TABLE `t_pelanggaran_siswa` (
  `id` int(11) NOT NULL,
  `thn_ajaran_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `nama_siswa` varchar(150) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `pelanggran_id` int(11) NOT NULL,
  `nama_pelanggan` varchar(150) NOT NULL,
  `pelanggaran_kategori_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `nama_guru` varchar(150) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `poin` int(11) NOT NULL,
  `tindakan` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pelanggaran_siswa`
--

INSERT INTO `t_pelanggaran_siswa` (`id`, `thn_ajaran_id`, `siswa_id`, `nama_siswa`, `kelas_id`, `nama_kelas`, `pelanggran_id`, `nama_pelanggan`, `pelanggaran_kategori_id`, `guru_id`, `nama_guru`, `tanggal`, `keterangan`, `poin`, `tindakan`, `status`, `created_at`, `updated_at`) VALUES
(21, 4, 1, 'Ahmad Rizky Pratama', 1, 'X RPL 1', 1, 'Terlambat Masuk Sekolah', 1, 16, 'Ahmad Dahlan, S.Pd.', '2024-02-10', 'Terlambat 20 menit karena ban bocor', 5, 'Peringatan Lisan', 'Disetujui', '2026-09-23 04:25:33', '2026-09-23 04:25:33'),
(22, 4, 2, 'Siti Nurhaliza', 2, 'X TKJ 2', 2, 'Tidak Menggunakan Seragam Sesuai Jadwal', 2, 17, 'Siti Rahmawati, M.Pd.', '2024-02-12', 'Menggunakan seragam pramuka di hari Senin', 10, 'Teguran Tertulis', 'Disetujui', '2026-09-23 04:25:33', '2026-09-23 04:25:33'),
(23, 4, 3, 'Bagus Setiawan', 3, 'XI AKL 1', 3, 'Bersikap Tidak Sopan Kepada Guru', 3, 18, 'Budi Santoso, S.Kom.', '2024-02-15', 'Menjawab tidak sopan saat ditegur', 25, 'Pemanggilan Orang Tua', 'Proses', '2026-09-23 04:25:33', '2026-09-23 04:25:33'),
(24, 4, 4, 'Dewi Anggraini', 4, 'XI OTKP 3', 4, 'Bermain HP Saat Jam Pelajaran', 4, 19, 'Dewi Lestari, S.Si.', '2024-02-18', 'Bermain game online saat KBM', 15, 'Sita HP selama 3 hari', 'Disetujui', '2026-09-23 04:25:33', '2026-09-23 04:25:33'),
(25, 3, 5, 'Fajar Ramadhan', 5, 'XII DKV 1', 5, 'Mewarnai Rambut / Tato', 5, 20, 'Eko Prasetyo, S.T.', '2023-10-05', 'Mengecat rambut warna menyolok', 50, 'Skorsing 3 Hari', 'Selesai', '2026-09-23 04:25:33', '2026-09-23 04:25:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_siswa`
--

CREATE TABLE `t_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_siswa`
--

INSERT INTO `t_siswa` (`id`, `nis`, `nisn`, `nama`, `jenis_kelamin`, `tgl_lahir`, `alamat`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, '21221001', '0051234567', 'Ahmad Rizky Pratama', 'L', '2006-05-14', 'Jl. Merdeka No. 12, Bandung', 1, '2026-09-23 03:03:39', '2026-09-23 03:03:39'),
(2, '21221002', '0051234568', 'Siti Nurhaliza', 'P', '2006-08-20', 'Jl. Mawar No. 5, Cimahi', 1, '2026-09-23 03:03:39', '2026-09-23 03:03:39'),
(3, '21221003', '0051234569', 'Bagus Setiawan', 'L', '2006-01-10', 'Jl. Sudirman No. 88, Bandung', 1, '2026-09-23 03:03:39', '2026-09-23 03:03:39'),
(4, '21221004', '0051234570', 'Dewi Anggraini', 'P', '2007-03-25', 'Jl. Anggrek No. 15, Kabupaten Bandung', 1, '2026-09-23 03:03:39', '2026-09-23 03:03:39'),
(5, '21221005', '0051234571', 'Fajar Ramadhan', 'L', '2006-11-02', 'Jl. Gatot Subroto No. 42, Bandung', 0, '2026-09-23 03:03:39', '2026-09-23 03:03:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_tahun_ajaran`
--

CREATE TABLE `t_tahun_ajaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_tahun_ajaran`
--

INSERT INTO `t_tahun_ajaran` (`id`, `nama`, `tgl_mulai`, `tgl_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, '2022/2023 Ganjil', '2022-07-11', '2022-12-23', 0, '2026-09-23 02:55:09', '2026-09-23 02:55:09'),
(2, '2022/2023 Genap', '2023-01-09', '2023-06-23', 0, '2026-09-23 02:55:09', '2026-09-23 02:55:09'),
(3, '2023/2024 Ganjil', '2023-07-17', '2023-12-22', 0, '2026-09-23 02:55:09', '2026-09-23 02:55:09'),
(4, '2023/2024 Genap', '2024-01-08', '2024-06-21', 1, '2026-09-23 02:55:09', '2026-09-23 02:55:09'),
(5, '2024/2025 Ganjil', '2024-07-15', '2024-12-20', 0, '2026-09-23 02:55:09', '2026-09-23 02:55:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_users`
--

CREATE TABLE `t_users` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(225) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `role` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_users`
--

INSERT INTO `t_users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin Utama', 'admin@sekolah.sch.id', '2026-09-23 02:58:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tok_abc123', 'admin', '2026-09-23 02:58:08', '2026-09-23 02:58:08'),
(2, 'Ahmad Dahlan', 'ahmad.dahlan@sekolah.sch.id', '2026-09-23 02:58:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tok_def456', 'guru', '2026-09-23 02:58:08', '2026-09-23 02:58:08'),
(3, 'Siti Rahmawati', 'siti.rahmawati@sekolah.sch.id', '2026-09-23 02:58:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tok_ghi789', 'guru', '2026-09-23 02:58:08', '2026-09-23 02:58:08'),
(4, 'Budi Santoso', 'budi.santoso@sekolah.sch.id', '2026-09-23 02:58:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 'guru', '2026-09-23 02:58:08', '2026-09-23 02:58:08'),
(5, 'Petugas Kesiswaan', 'kesiswaan@sekolah.sch.id', '2026-09-23 02:58:08', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tok_jkl012', 'staf', '2026-09-23 02:58:08', '2026-09-23 02:58:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_wali_kelas`
--

CREATE TABLE `t_wali_kelas` (
  `id` int(11) NOT NULL,
  `thn_ajaran_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_wali_kelas`
--

INSERT INTO `t_wali_kelas` (`id`, `thn_ajaran_id`, `kelas_id`, `guru_id`, `tgl_mulai`, `tgl_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, '2024-01-08', '2024-06-21', 1, '2026-09-23 03:33:08', '2026-09-23 03:33:08'),
(2, 4, 2, 2, '2024-01-08', '2024-06-21', 1, '2026-09-23 03:33:08', '2026-09-23 03:33:08'),
(3, 4, 3, 3, '2024-01-08', '2024-06-21', 1, '2026-09-23 03:33:08', '2026-09-23 03:33:08'),
(4, 4, 4, 4, '2024-01-08', '2024-06-21', 1, '2026-09-23 03:33:08', '2026-09-23 03:33:08'),
(5, 3, 5, 5, '2023-07-17', '2023-12-22', 0, '2026-09-23 03:33:08', '2026-09-23 03:33:08');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_guru`
--
ALTER TABLE `t_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `t_kelas`
--
ALTER TABLE `t_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indeks untuk tabel `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggaran_kategori_id` (`pelanggaran_kategori_id`);

--
-- Indeks untuk tabel `t_pelanggaran_kategori`
--
ALTER TABLE `t_pelanggaran_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thn_ajaran_id` (`thn_ajaran_id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `pelanggran_id` (`pelanggran_id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `pelanggaran_kategori_id` (`pelanggaran_kategori_id`);

--
-- Indeks untuk tabel `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_tahun_ajaran`
--
ALTER TABLE `t_tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thn_ajaran_id` (`thn_ajaran_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_guru`
--
ALTER TABLE `t_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_pelanggaran_kategori`
--
ALTER TABLE `t_pelanggaran_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `t_siswa`
--
ALTER TABLE `t_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_tahun_ajaran`
--
ALTER TABLE `t_tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_guru`
--
ALTER TABLE `t_guru`
  ADD CONSTRAINT `t_guru_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`);

--
-- Ketidakleluasaan untuk tabel `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  ADD CONSTRAINT `t_kelas_siswa_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `t_siswa` (`id`),
  ADD CONSTRAINT `t_kelas_siswa_ibfk_2` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `t_tahun_ajaran` (`id`),
  ADD CONSTRAINT `t_kelas_siswa_ibfk_3` FOREIGN KEY (`kelas_id`) REFERENCES `t_kelas` (`id`);

--
-- Ketidakleluasaan untuk tabel `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  ADD CONSTRAINT `t_pelanggaran_ibfk_1` FOREIGN KEY (`pelanggaran_kategori_id`) REFERENCES `t_pelanggaran_kategori` (`id`);

--
-- Ketidakleluasaan untuk tabel `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_1` FOREIGN KEY (`thn_ajaran_id`) REFERENCES `t_tahun_ajaran` (`id`),
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `t_siswa` (`id`),
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_3` FOREIGN KEY (`kelas_id`) REFERENCES `t_kelas` (`id`),
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_4` FOREIGN KEY (`pelanggran_id`) REFERENCES `t_pelanggaran` (`id`),
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_5` FOREIGN KEY (`guru_id`) REFERENCES `t_guru` (`id`),
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_6` FOREIGN KEY (`pelanggaran_kategori_id`) REFERENCES `t_pelanggaran_kategori` (`id`);

--
-- Ketidakleluasaan untuk tabel `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  ADD CONSTRAINT `t_wali_kelas_ibfk_1` FOREIGN KEY (`thn_ajaran_id`) REFERENCES `t_tahun_ajaran` (`id`),
  ADD CONSTRAINT `t_wali_kelas_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `t_kelas` (`id`),
  ADD CONSTRAINT `t_wali_kelas_ibfk_3` FOREIGN KEY (`guru_id`) REFERENCES `t_guru` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
