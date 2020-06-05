-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2020 at 08:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `id_creator` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `id_creator`, `name`, `description`, `code`, `status`) VALUES
(1, 1, 'Tekweb A', '2019/2020 - A', 'cdE12R', 1),
(2, 1, 'PPM B', '2019/2020 - B', 'wRs2tE', 1),
(9, 1, 'Sistem Operasi C', 'Sistem Operasi C 2019/2020', 'IFeFxEJG', 1),
(10, 2, 'ADSI C', 'ADSI C 2021/2022', 'mVc8g8bO', 1),
(11, 2, 'RPL A', 'RPL A - 2019', 'SEOakrcc', 1),
(12, 3, 'Matematika Diskrit E', 'Matdisk E Periode 2020/2021', 'r9aMi9Ly', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_details`
--

CREATE TABLE `class_details` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_details`
--

INSERT INTO `class_details` (`id`, `class_id`, `users_id`, `role`, `status`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 2, 3, 1),
(3, 2, 1, 1, 1),
(4, 9, 1, 1, 1),
(5, 9, 2, 3, 0),
(6, 2, 2, 3, 1),
(7, 10, 2, 1, 1),
(8, 11, 2, 1, 1),
(9, 9, 4, 3, 1),
(10, 10, 3, 3, 1),
(11, 2, 3, 3, 1),
(12, 12, 3, 1, 1),
(13, 1, 3, 3, 1),
(14, 11, 1, 3, 1),
(15, 1, 4, 3, 1),
(16, 10, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `message`, `timestamp`, `id_users`, `id_post`) VALUES
(1, 'Tak pernahkah kau sadari akulah yang kau sakiti', '2020-05-05 00:10:50', 1, 1),
(2, 'Terlalu hardcore pak', '2020-05-17 00:00:00', 2, 1),
(5, 'Maaf saya siapa ya?', '2020-05-22 04:21:34', 1, 1),
(6, 'Oh sudah ingat terima kasih', '2020-05-22 04:22:56', 1, 1),
(7, 'Permisi blabla itu maksudnya apa ya?', '2020-05-22 04:24:53', 3, 2),
(8, 'wkwkwkkwkw', '2020-05-22 04:25:05', 3, 1),
(9, 'Siap kakak!!', '2020-05-22 10:06:56', 1, 3),
(10, 'Waduh deadline nya besok ya', '2020-05-23 05:11:43', 1, 4),
(11, 'Ayoo daftar WGGP!!!', '2020-05-24 05:35:14', 2, 1),
(12, 'WKAKAKAKKAK', '2020-05-25 09:23:23', 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `files` varchar(255) NOT NULL,
  `id_posts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `files`, `id_posts`) VALUES
(1, 'tugas1.docx', 1),
(2, 'tugas1.jpg', 1),
(9, 'Wallpaper.jpg', 6),
(10, 'Wallpaper.jpg', 19),
(12, '02 - Rational Agents & DFS.pptx', 22),
(13, '03 - Uninformed Search.pptx', 22),
(14, '04 - Informed Search.pptx', 24),
(15, 'revisi web.txt', 24),
(16, 'Open Forum.pptx', 25),
(17, 'search.png', 27),
(18, 'Untitled Diagram.vpd', 27);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `timestamp` datetime NOT NULL,
  `type` varchar(15) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `id_classroom` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `timestamp`, `type`, `deadline`, `id_classroom`, `id_users`) VALUES
(1, 'Algoritma pemrograman', 'Kumpulkan dalam bentuk zip', '2020-05-01 23:52:50', 'assignment', '2020-05-30 23:52:50', 1, 1),
(2, 'Matdas', 'Kumpulkan dalam bentuk zip/rar', '2020-05-01 23:52:50', 'material', NULL, 1, 1),
(3, 'Announcement I : Belajar Menggambar', 'Ayo digambar!!!', '2020-05-22 10:00:42', 'announcement', NULL, 1, 1),
(4, 'Assignment 2 : Membuat Roti Kukus', 'Ya intinya ini ada roti kukus, tolong dibuat', '2020-05-22 10:36:26', 'assignment', '2020-05-24 17:11:22', 1, 1),
(5, 'Libur Lebaran', 'Berhubung lebaran, besok kelas diliburkan, ty.', '2020-05-23 07:46:48', 'announcement', NULL, 1, 1),
(6, 'Inheritance', 'Berikut materi bab 5', '2020-05-23 07:48:13', 'material', NULL, 1, 1),
(7, 'Announcement I : Waduh Besok Lusa Masuk', 'LIBURAN SUDAH BERAKHIR! HAHAHA!', '2020-05-25 18:47:44', 'announcement', NULL, 1, 1),
(19, 'Ini foto peliharaan saya', 'Warnanya hijau', '2020-05-25 21:29:14', 'announcement', NULL, 2, 1),
(21, 'Ini materi bab 6', 'Tapi boong', '2020-05-25 21:34:49', 'material', NULL, 2, 1),
(22, 'Materi Bab 2 - 3', 'Untuk tes hari senin', '2020-05-25 21:35:50', 'material', NULL, 2, 1),
(23, 'Tugas Restoran', 'Buatlah sesuai contoh', '2020-05-25 21:37:50', 'assignment', '2020-05-31 23:59:00', 2, 1),
(24, 'Tugas Libur Lebaran', 'Hiyahiyahiya', '2020-05-25 21:38:46', 'assignment', '2020-05-25 21:40:00', 2, 1),
(25, 'Hayoloh Tugas 1', 'Buat Rangkuman', '2020-05-25 21:58:37', 'assignment', '2020-05-31 22:00:00', 9, 1),
(26, 'Cerita Lebaran', 'Kumpulkan cerita lebaran kalian!', '2020-05-28 22:26:09', 'assignment', '2020-05-31 22:00:00', 10, 2),
(27, 'NFA DFA', 'Kumpulkan boleh tulis tangan boleh ketik', '2020-05-28 22:27:52', 'assignment', '2020-06-26 23:59:00', 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `score` int(11) DEFAULT NULL,
  `id_users` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `timestamp`, `score`, `id_users`, `id_post`) VALUES
(2, '2020-05-25 16:24:37', 86, 3, 1),
(3, '2020-05-25 21:54:12', NULL, 2, 23),
(8, '2020-05-27 19:21:26', NULL, 2, 1),
(10, '2020-05-28 22:47:20', NULL, 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `submissions_files`
--

CREATE TABLE `submissions_files` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `id_submissions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submissions_files`
--

INSERT INTO `submissions_files` (`id`, `link`, `id_submissions`) VALUES
(4, 'MK Konsentrasi.xlsx', 2),
(5, '02 - Rational Agents & DFS.pptx', 3),
(30, 'cobainsert.php', 8),
(36, 'SM 3 Mei.pptx', 10),
(39, 'SM 19 April.pptx', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `birthdate` date NOT NULL,
  `nickname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `birthdate`, `nickname`) VALUES
(1, 'henry12', '32250170a0dca92d53ec9624f336ca24', 'c14180014@john.petra.ac.id', '2000-05-12', 'Henry Wicaksono'),
(2, 'misaelrs', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'c14180001@john.petra.ac.id', '2000-04-12', 'Misael Setio'),
(3, 'gerstev', 'a141c47927929bc2d1fb6d336a256df4', 'c14180044@john.petra.ac.id', '1999-05-04', 'Gerry Steven'),
(4, 'green7', 'a097897098930ad07bf6db97a8d10b83', 'aaa@gmail.com', '1999-12-25', 'Green Hunter'),
(5, 'cr7', 'c5aa3124b1adad080927ce4d144c6b33', 'c14180013@gmail.com', '1985-02-05', 'Cristiano Ronaldo'),
(6, 'leomessi', '7189f7b76cb1610e499a1a5f046b7861', 'bbb@gmail.com', '1988-06-21', 'Lionel Messi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_details`
--
ALTER TABLE `class_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions_files`
--
ALTER TABLE `submissions_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `class_details`
--
ALTER TABLE `class_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `submissions_files`
--
ALTER TABLE `submissions_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
