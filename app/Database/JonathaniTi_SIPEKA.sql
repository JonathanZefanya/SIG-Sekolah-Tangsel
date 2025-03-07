-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: sql.tirtagt.xyz
-- Generation Time: Mar 07, 2025 at 01:21 PM
-- Server version: 8.0.40-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `JonathaniTi_SIPEKA`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_sekolah`
--

CREATE TABLE `detail_sekolah` (
  `det_id` int UNSIGNED NOT NULL,
  `sek_npsn` int UNSIGNED NOT NULL,
  `det_guru` int NOT NULL,
  `det_siswa_p` int NOT NULL,
  `det_siswa_l` int NOT NULL,
  `det_akreditasi` enum('a','b','c') NOT NULL,
  `det_kurikulum` varchar(50) NOT NULL,
  `det_website` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `detail_sekolah`
--

INSERT INTO `detail_sekolah` (`det_id`, `sek_npsn`, `det_guru`, `det_siswa_p`, `det_siswa_l`, `det_akreditasi`, `det_kurikulum`, `det_website`) VALUES
(1, 20604625, 40, 300, 250, 'a', 'Merdeka', ''),
(2, 20615910, 30, 200, 250, 'a', '2025', ''),
(3, 20613477, 200, 800, 922, 'a', 'Merdeka', ''),
(6, 20604438, 28, 100, 200, 'a', 'Merdeka', ''),
(7, 69957100, 24, 100, 198, 'a', 'Merdeka', ''),
(8, 20614481, 50, 100, 200, 'a', 'Merdeka', ''),
(9, 20623246, 50, 100, 198, 'a', 'Merdeka', ''),
(10, 20602948, 24, 100, 198, 'a', 'Merdeka', '-'),
(11, 20602935, 30, 100, 200, 'a', 'Merdeka', ''),
(12, 20614740, 26, 100, 200, 'a', 'Merdeka', ''),
(13, 20604578, 24, 100, 200, 'a', 'Merdeka', ''),
(14, 20604579, 27, 100, 200, 'a', 'Merdeka', ''),
(15, 20614231, 25, 123, 123, 'a', 'Merdeka', ''),
(16, 20603609, 21, 113, 130, 'a', 'Merdeka', ''),
(17, 20603481, 42, 234, 242, 'a', 'Merdeka', ''),
(18, 20603482, 32, 242, 423, 'a', 'Merdeka', ''),
(19, 20603483, 23, 123, 130, 'a', 'Merdeka', ''),
(20, 69882369, 21, 234, 242, 'a', 'Merdeka', ''),
(21, 20616493, 23, 233, 432, 'a', 'Merdeka', ''),
(22, 20614833, 15, 21, 89, 'b', 'MERDEKA', ''),
(23, 70010969, 18, 131, 142, 'a', '2013', ''),
(24, 20603219, 21, 161, 175, 'a', 'MERDEKA', ''),
(25, 20603557, 13, 44, 50, 'a', '2013', ''),
(26, 20603634, 4, 11, 20, 'c', 'MERDEKA', ''),
(27, 20603199, 7, 68, 104, 'a', '2013', ''),
(28, 20603526, 14, 152, 174, 'a', '2013', ''),
(29, 20603545, 9, 87, 85, 'a', '2013', ''),
(30, 20603559, 8, 100, 87, 'a', 'MERDEKA', ''),
(31, 20613829, 25, 148, 181, 'a', 'MERDEKA', ''),
(32, 20616298, 13, 60, 60, 'a', '2013', ''),
(33, 20603244, 10, 37, 40, 'a', '2013', ''),
(34, 20615896, 10, 69, 68, 'a', '2013', ''),
(35, 69953477, 17, 133, 144, 'a', '2013', ''),
(36, 69981896, 11, 26, 42, 'a', 'MERDEKA', ''),
(37, 69985320, 8, 54, 83, 'b', 'MERDEKA', ''),
(38, 20603385, 21, 244, 330, 'a', 'MERDEKA', '');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `kec_id` int UNSIGNED NOT NULL,
  `kec_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`kec_id`, `kec_name`) VALUES
(1, 'Ciputat'),
(2, 'Ciputat Timur'),
(3, 'Pamulang'),
(4, 'Pondok Aren'),
(5, 'Serpong'),
(6, 'Serpong Utara'),
(7, 'Setu');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `kel_id` int UNSIGNED NOT NULL,
  `kec_id` int UNSIGNED NOT NULL,
  `kel_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`kel_id`, `kec_id`, `kel_name`) VALUES
(1, 1, 'Cipayung'),
(2, 1, 'Ciputat'),
(3, 1, 'Jombang'),
(4, 1, 'Sawah'),
(5, 1, 'Sawah Baru'),
(6, 1, 'Serua'),
(7, 1, 'Serua Indah'),
(8, 2, 'Cempaka Putih'),
(9, 2, 'Cireundeu'),
(10, 2, 'Pisangan'),
(11, 2, 'Pondok Ranji'),
(12, 2, 'Rempoa'),
(13, 2, 'Rengas'),
(14, 3, 'Bambu Apus'),
(15, 3, 'Benda Baru'),
(16, 3, 'Kedaung'),
(17, 3, 'Pamulang Barat'),
(18, 3, 'Pamulang Timur'),
(19, 3, 'Pondok Benda'),
(20, 3, 'Pondok Cabe Ilir'),
(21, 3, 'Pondok Cabe Udik'),
(22, 4, 'Jurangmangu Barat'),
(23, 4, 'Jurangmangu Timur'),
(24, 4, 'Pondok Kacang Barat'),
(25, 4, 'Pondok Kacang Timur'),
(26, 4, 'Parigi Lama'),
(27, 4, 'Parigi Baru'),
(28, 4, 'Pondok Aren'),
(29, 4, 'Pondok Karya'),
(30, 4, 'Pondok Jaya'),
(31, 4, 'Pondok Betung'),
(32, 4, 'Pondok Pucung'),
(33, 5, 'Buaran'),
(34, 5, 'Ciater'),
(35, 5, 'Cilenggang'),
(36, 5, 'Lengkong Gudang'),
(37, 5, 'Lengkong Gudang Timur'),
(38, 5, 'Lengkong Wetan'),
(39, 5, 'Rawa Buntu'),
(40, 5, 'Rawa Mekar Jaya'),
(41, 5, 'Serpong'),
(42, 6, 'Jelupang'),
(43, 6, 'Lengkong Karya'),
(44, 6, 'Pakualam'),
(45, 6, 'Pakulonan'),
(46, 6, 'Paku Jaya'),
(47, 6, 'Pondok Jagung'),
(48, 6, 'Pondok Jagung Timur'),
(49, 7, 'Babakan'),
(50, 7, 'Bakti Jaya'),
(51, 7, 'Kademangan'),
(52, 7, 'Keranggan'),
(53, 7, 'Muncul'),
(54, 7, 'Setu');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-04-06-100842', 'App\\Database\\Migrations\\Adduser', 'default', 'App', 1739548462, 1),
(2, '2023-04-08-100924', 'App\\Database\\Migrations\\AddKecamatan', 'default', 'App', 1739548462, 1),
(3, '2023-04-08-201331', 'App\\Database\\Migrations\\AddKelurahan', 'default', 'App', 1739548462, 1),
(4, '2023-04-09-203530', 'App\\Database\\Migrations\\AddSekolah', 'default', 'App', 1739548462, 1),
(5, '2023-04-10-101303', 'App\\Database\\Migrations\\AddDetailSekolah', 'default', 'App', 1739548462, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `sek_npsn` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `sek_nama` varchar(50) NOT NULL,
  `sek_status` enum('negeri','swasta') NOT NULL,
  `sek_jenjang` enum('sd','smp','sma') NOT NULL,
  `sek_alamat` text NOT NULL,
  `kel_id` int UNSIGNED NOT NULL,
  `kec_id` int UNSIGNED NOT NULL,
  `sek_lokasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`sek_npsn`, `user_id`, `sek_nama`, `sek_status`, `sek_jenjang`, `sek_alamat`, `kel_id`, `kec_id`, `sek_lokasi`) VALUES
(20602935, NULL, 'sd negeri kademangan 02', 'negeri', 'sd', 'kp kademangan rt 005 / rw 003 kel. kademangan', 51, 7, '-6.332200000000,106.659900000000'),
(20602948, 9, 'sd negeri kademangan 01', 'negeri', 'sd', 'jl. raya puspiptek serpong', 51, 7, '-6.339500000000,106.672400000000'),
(20603199, NULL, 'smp puspita bangsa', 'swasta', 'smp', 'jl. aria putra no.9', 2, 1, '-6.2996,106.7445'),
(20603219, NULL, 'smp waskito', 'swasta', 'smp', 'jl. raya pamulang permai ii no. 75, sarua, kec. ciputat, kota tangerang selatan prov. banten', 6, 1, '-6.319844248323965, 106.70812966755967'),
(20603244, NULL, 'smp tirta buaran', 'swasta', 'smp', 'jl. serua raya bukit indah no. 12, rt: 3 rw: 2', 6, 1, '-6.3162,106.7167'),
(20603385, NULL, 'smp pgri 2 ciputat', 'swasta', 'smp', 'jl. cendrawasih km.4, rt: 1 rw: 1', 4, 1, '-6.2768,106.7275'),
(20603481, NULL, 'sd negeri muncul 01', 'negeri', 'sd', 'jl. raya puspiptek kelurahan muncul', 53, 7, '-6.348800000000,106.672600000000'),
(20603482, NULL, 'sd negeri muncul 02', 'negeri', 'sd', 'jl. lingkar selatan baru asih kel. muncul', 53, 7, '-6.348900000000,106.672500000000'),
(20603483, NULL, 'sd negeri muncul 03', 'negeri', 'sd', 'jl. lingkar selatan kp. sengkol kelurahan muncul', 53, 7, '-6.344000000000,106.662800000000'),
(20603526, NULL, 'smp islamiyah ciputat', 'swasta', 'smp', 'jl. kihajar dewantara no. 23 ciputat, rt: 1 rw: 2', 2, 1, '-6.3083,106.7474'),
(20603545, NULL, 'smp islam al syukro', 'swasta', 'smp', 'jl. otista raya gg. h.maung no.30, rt: 3 rw: 9', 2, 1, '-6.285,106.7481'),
(20603557, NULL, 'smp nusa indah', 'swasta', 'smp', 'jl vinca kav. 570 komplek bukit nusa indah, sarua, kec. ciputat, kota tangerang selatan prov. banten', 6, 1, '-6.309939616925069, 106.71137623872401'),
(20603559, NULL, 'smp paramarta', 'swasta', 'smp', 'jl. raya jombang, gg. taqwa no. 70 jombang kec. ciputat, rt: 1 rw: 8', 3, 1, '-6.3016,106.7168'),
(20603609, NULL, 'sd negeri keranggan', 'negeri', 'sd', 'jl. lingkar selatan kel keranggan', 52, 7, '-6.344100000000,106.655700000000'),
(20603634, NULL, 'smp islam al khasyiun', 'swasta', 'smp', 'jl.dewi sartika ciputat rt. 02/02, rt: 2 rw: 2', 1, 1, '-6.3127,106.7516'),
(20604438, NULL, 'sd al amanah', 'swasta', 'sd', 'jl.raya puspiptek babakan pocis', 50, 7, '-6.349700000000,106.702900000000'),
(20604578, NULL, 'sd negeri babakan 02', 'negeri', 'sd', 'jl. raya puspiptek kelapa dua', 49, 7, '-6.347100000000,106.699300000000'),
(20604579, NULL, 'sd negeri bakti jaya', 'negeri', 'sd', 'jl kavling pilihan permata pamulang', 50, 7, '-6.340900000000,106.680300000000'),
(20604625, 9, 'sd menara harapan', 'swasta', 'sd', 'jl. re martadinata no.35, ciputat, kec. ciputat, kota tangerang selatan, banten 15411', 2, 1, '-6.3255886,106.7158591'),
(20613477, NULL, 'sman 2 kota tangerang selatan', 'negeri', 'sma', 'jalan raya puspitek serpong, muncul, kec. setu, kota tangerang selatan, banten 15314', 53, 7, '-6.345919,106.672416'),
(20613829, NULL, 'smp islam terpadu auliya', 'swasta', 'smp', '	\r\njl. jombang raya no.49 rt.1 rw. 11, rt: 1 rw: 11', 3, 1, '-6.2906,106.7043'),
(20614231, NULL, 'sd negeri batan indah', 'negeri', 'sd', 'jl. raya puspiptek-serpong komp. batan indah', 51, 7, ' -6.330800000000,106.670900000000'),
(20614481, NULL, 'sd islam swasta mitra cendekia indonesia', 'swasta', 'sd', 'kampung sarimulya rt 02 rw 01', 54, 7, ' -6.354200000000,106.684700000000'),
(20614740, NULL, 'sd negeri babakan 01', 'negeri', 'sd', 'jl. pasarjengkol desa babakan kec. setu telp. (021) 32950711', 49, 7, '-6.357900000000,106.695400000000'),
(20614833, NULL, 'smp adzkia islamic school', 'swasta', 'smp', 'jl. sukamulya 5 no.1 rt 01/09 kp. dukuh', 7, 1, '-6.3196272770134785, 106.72405829882422'),
(20615896, NULL, 'smp erenos', 'swasta', 'smp', 'jl. palapa rt 03 rw 18 serua, ciputat, rt: 3 rw: 18', 6, 1, '-6.316,106.7079'),
(20615910, NULL, 'smp menara harapan', 'swasta', 'smp', 'jl. re martadinata no.35, ciputat, kec. ciputat, kota tangerang selatan, banten 15411', 2, 1, '-6.3255886,106.7158591'),
(20616298, NULL, 'smp budi mulia dua bintaro', 'swasta', 'smp', 'jl. raya jombang no. 89', 3, 1, '-6.2943,106.7086'),
(20616493, NULL, 'sd negeri setu', 'negeri', 'sd', 'jl. raya puspiptek km. 12 kel. setu', 54, 7, '-6.348000000000,106.679000000000'),
(20623246, NULL, 'sd swasta hikari', 'swasta', 'sd', 'kp. koceak kel. keranggan rt. 06/02 telp. 021-75674000', 52, 7, '-6.339000000000,106.658000000000'),
(69882369, NULL, 'sd negeri puspiptek', 'negeri', 'sd', 'jl. komplek perumahan puspitek kel. setu', 54, 7, '-6.355000000000,106.678400000000'),
(69953477, NULL, 'smp islam terpadu ash shiddiqiyyah', 'swasta', 'smp', 'perumahan bukit indah blok d4 no.17c, rt: 5 rw: 3', 6, 1, '-6.3196,106.7142'),
(69957100, NULL, 'sd islam arrasyid', 'swasta', 'sd', 'jl. baru kp. sarimulya rt/rw. 02/01', 54, 7, '-6.313826000000,106.677504000000'),
(69981896, NULL, 'smpit al-lauzah', 'swasta', 'smp', 'jl. palapa raya parung beunying rt.03 rw. 18, rt: 3 rw: 18', 6, 1, '-6.312156,106.707886'),
(69985320, NULL, 'smp bethesda indonesia', 'swasta', 'smp', 'jl. serua raya no.29 rt.003 rw.003, rt: 3 rw: 3', 6, 1, '-6.3171,106.7131'),
(70010969, NULL, 'smp paramarta ungggulan', 'swasta', 'smp', 'jalan merpati raya, gang sawo, sawah, kec. ciputat, kota tangerang selatan prov. banten', 4, 1, '-6.296897998755985, 106.73319426755934');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int UNSIGNED NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_akses` enum('sekolah','admin','dinas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_akses`) VALUES
(1, 'administrator', 'admin@sekolah.com', '$2y$10$Wzu3/DYkFd2hJ0sBezzhd.6Qyy5gtNC0CYw6zJS8niXMG0vfUBHHi', 'admin'),
(9, 'Sekolah', 'sekolah@sekolah.com', '$2y$10$PPhLDWFIi/icnSceMw120uHQgBB8dS9XpJqUz8CsHfxVvU9aRlOLC', 'sekolah'),
(10, 'Dinas', 'dinas@sekolah.com', '$2y$10$AIZGQLkyjKeEX5bO8lZ37enqmOI4NVOiE4qgNX4gW1DNEOWR6XkKi', 'dinas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_sekolah`
--
ALTER TABLE `detail_sekolah`
  ADD PRIMARY KEY (`det_id`),
  ADD KEY `detail_sekolah_sek_npsn_foreign` (`sek_npsn`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`kec_id`),
  ADD UNIQUE KEY `kec_name` (`kec_name`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`kel_id`),
  ADD UNIQUE KEY `kel_name` (`kel_name`),
  ADD KEY `kelurahan_kec_id_foreign` (`kec_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`sek_npsn`),
  ADD UNIQUE KEY `sek_npsn` (`sek_npsn`),
  ADD KEY `sekolah_user_id_foreign` (`user_id`),
  ADD KEY `sekolah_kel_id_foreign` (`kel_id`),
  ADD KEY `sekolah_kec_id_foreign` (`kec_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_sekolah`
--
ALTER TABLE `detail_sekolah`
  MODIFY `det_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `kec_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `kel_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_sekolah`
--
ALTER TABLE `detail_sekolah`
  ADD CONSTRAINT `detail_sekolah_sek_npsn_foreign` FOREIGN KEY (`sek_npsn`) REFERENCES `sekolah` (`sek_npsn`) ON DELETE CASCADE;

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `kelurahan_kec_id_foreign` FOREIGN KEY (`kec_id`) REFERENCES `kecamatan` (`kec_id`);

--
-- Constraints for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD CONSTRAINT `sekolah_kec_id_foreign` FOREIGN KEY (`kec_id`) REFERENCES `kecamatan` (`kec_id`),
  ADD CONSTRAINT `sekolah_kel_id_foreign` FOREIGN KEY (`kel_id`) REFERENCES `kelurahan` (`kel_id`),
  ADD CONSTRAINT `sekolah_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
