-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2026 at 11:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `hari_tanggal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `id_penulis`, `id_kategori`, `judul`, `isi`, `gambar`, `hari_tanggal`) VALUES
(1, 1, 2, 'Suara Unik dan Jiwa Seni yang Menginspirasi Dunia', 'Kim Taehyung, yang dikenal sebagai V dari BTS, bukan hanya seorang penyanyi berbakat tetapi juga sosok yang penuh dengan keunikan artistik. Suaranya yang khas dan dalam mampu memberikan warna berbeda dalam setiap lagu yang dibawakan. Selain itu, gaya fashion-nya yang berani dan elegan sering menjadi inspirasi bagi para penggemarnya di seluruh dunia.\r\n\r\nDi balik popularitasnya, Taehyung dikenal sebagai pribadi yang hangat dan peduli terhadap orang-orang di sekitarnya. Ia sering menunjukkan sisi humanisnya melalui berbagai kegiatan sosial dan interaksi dengan fans. Hal ini menjadikannya bukan hanya seorang idola, tetapi juga sosok inspiratif yang mampu memotivasi banyak orang untuk mengekspresikan diri dengan percaya diri.', 'artikel_69edc652d625d5.53101533.jpg', 'Minggu, 26 April 2026 | 15:01'),
(2, 2, 3, 'Sosok pemimpin kuat di balik kesuksesan SEVENTEEN', 'Choi Seungcheol atau S.Coups adalah pemimpin dari grup SEVENTEEN yang dikenal dengan jiwa kepemimpinan yang kuat dan penuh tanggung jawab. Ia mampu mengatur tim dengan baik, menjaga kekompakan, serta memberikan motivasi kepada setiap anggota untuk berkembang bersama. Perannya sebagai leader menjadi salah satu kunci kesuksesan grup ini.\r\n\r\nSelain itu, Seungcheol juga dikenal memiliki kepribadian yang hangat dan protektif terhadap anggotanya. Ia tidak hanya fokus pada performa, tetapi juga kesejahteraan tim secara keseluruhan. Sikapnya ini membuatnya dihormati tidak hanya oleh anggota grup, tetapi juga oleh para penggemar yang melihatnya sebagai sosok pemimpin yang ideal.', 'artikel_69edcafacabf69.91502835.jpg', 'Minggu, 26 April 2026 | 15:21'),
(3, 3, 4, 'Perpaduan Visual, Kreativitas, dan Gaya Hidup Modern', 'Kim Mingyu adalah salah satu anggota SEVENTEEN yang dikenal dengan visualnya yang menawan dan bakat yang beragam. Selain kemampuan bernyanyi dan menari, ia juga memiliki keterampilan dalam fotografi dan seni visual. Kreativitasnya sering terlihat dalam berbagai proyek yang ia kerjakan, menjadikannya sosok yang inspiratif bagi generasi muda.\r\n\r\nDi sisi lain, Mingyu juga dikenal sebagai pribadi yang pekerja keras dan rendah hati. Ia selalu berusaha memberikan yang terbaik dalam setiap penampilannya, baik di atas panggung maupun di luar panggung. Hal ini membuatnya dicintai oleh banyak penggemar dan menjadi contoh bahwa kerja keras dan passion dapat membawa seseorang menuju kesuksesan.', 'artikel_69edcb8ea63743.76855317.jpg', 'Minggu, 26 April 2026 | 15:23'),
(4, 4, 5, 'Perjalanan Inspiratif dalam Meraih Impian dan Kesuksesan', 'Keng Harit dikenal sebagai sosok yang penuh semangat dan memiliki tekad kuat dalam mengejar impiannya. Dengan latar belakang yang sederhana, ia mampu membuktikan bahwa kerja keras dan konsistensi adalah kunci utama untuk meraih kesuksesan. Perjalanannya menjadi inspirasi bagi banyak orang yang sedang berjuang mencapai tujuan hidup mereka.\r\n\r\nSelain itu, Harit juga aktif membagikan pengalaman dan motivasi kepada orang lain. Ia percaya bahwa setiap individu memiliki potensi besar yang bisa dikembangkan jika diberi kesempatan dan usaha yang maksimal. Pesan-pesan positif yang ia sampaikan membuatnya menjadi figur yang memberikan dampak baik bagi lingkungan sekitarnya.', 'artikel_69edcc593948c8.98773775.jpg', 'Minggu, 26 April 2026 | 15:27');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_artikel`
--

CREATE TABLE `kategori_artikel` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_artikel`
--

INSERT INTO `kategori_artikel` (`id`, `nama_kategori`, `keterangan`) VALUES
(2, 'Inspirasi & Musik', 'Artikel tentang musik dan inspirasi idol'),
(3, 'Kepemimpinan & Karier', 'Leadership dan perjalanan karier'),
(4, 'Gaya Hidup & Kreativitas', 'Lifestyle dan kreativitas'),
(5, 'Motivasi & Pengembangan Diri', 'pengembangan diri dan motivasi');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id` int(11) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id`, `nama_depan`, `nama_belakang`, `user_name`, `password`, `foto`) VALUES
(1, 'Kim', 'Taehyung', 'kimtaev', '$2y$10$nI.nh52wuGg2pl/Kumgvw.lkwvdeSmZ/aBfIZk.G2.Jrem363auDS', 'penulis_69ed9d1b745d25.84649117.jpg'),
(2, 'Choi', 'Seungcheol', 'scoups', '$2y$10$40P2Xy4geeanpkP33gC4TuqoHVh8WFGPqyV0VMncm0NSX6Mpzy1oq', 'penulis_69edabfb695323.87464231.jpg'),
(3, 'Kim', 'Mingyu', 'mgyukim', '$2y$10$EbPH9T6HD/BJ0gGtcsyyxeUP.DXuq9B6Fxwd.ngHG/kxlfIv3Uvy.', 'penulis_69edb213af3754.78732788.jpg'),
(4, 'Keng', 'Harit', 'kenamping', '$2y$10$MKYR6j4i4qn2lDXVk2N6UuVa/rJnkyNQ.ru5dLFMhzQVOsGIKTs7e', 'penulis_69edb7283e1bd5.95776315.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_artikel_penulis` (`id_penulis`),
  ADD KEY `fk_artikel_kategori` (`id_kategori`);

--
-- Indexes for table `kategori_artikel`
--
ALTER TABLE `kategori_artikel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_nama_kategori` (`nama_kategori`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_artikel`
--
ALTER TABLE `kategori_artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `fk_artikel_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_artikel` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_artikel_penulis` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
