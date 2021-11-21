-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2021 at 05:44 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forumapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comments` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` char(20) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comments`, `id_post`, `id_user`, `comments`) VALUES
(34, 30, 'ID002', 'Hallo Bro'),
(35, 30, 'ID001', 'Hallo Juga'),
(36, 32, 'ID002', 'Hallo Guys'),
(38, 31, 'ID001', 'test'),
(39, 31, 'ID0007', 'TEst'),
(40, 32, 'ID0007', 'Hello'),
(41, 31, 'ID0007', 'Test'),
(42, 31, 'ID0007', 'Test Test'),
(43, 32, 'ID0007', 'Hiii');

-- --------------------------------------------------------

--
-- Table structure for table `postingan`
--

CREATE TABLE `postingan` (
  `id_post` int(11) NOT NULL,
  `id_user` char(20) NOT NULL,
  `post` text NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postingan`
--

INSERT INTO `postingan` (`id_post`, `id_user`, `post`, `gambar`) VALUES
(30, 'ID001', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make', ''),
(31, 'ID001', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia', ''),
(32, 'ID002', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_user` char(20) NOT NULL,
  `username` char(20) NOT NULL,
  `password` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_user`, `username`, `password`) VALUES
(6, 'ID001', 'Fadhlu Ibnu', '12345'),
(7, 'ID002', 'Ibnu', '12345'),
(9, 'ID0007', 'inu', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comments`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `postingan`
--
ALTER TABLE `postingan`
  ADD UNIQUE KEY `id_post` (`id_post`),
  ADD KEY `postingan_ibfk_1` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `postingan`
--
ALTER TABLE `postingan`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`id_post`) REFERENCES `postingan` (`id_post`) ON UPDATE CASCADE;

--
-- Constraints for table `postingan`
--
ALTER TABLE `postingan`
  ADD CONSTRAINT `postingan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
