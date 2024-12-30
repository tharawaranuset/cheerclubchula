-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: fdb1027.runhosting.com
-- Generation Time: Dec 30, 2024 at 06:35 AM
-- Server version: 8.0.32
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4563686_cucsa`
--
CREATE DATABASE IF NOT EXISTS `4563686_cucsa` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `4563686_cucsa`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'none'),
(2, 'attack'),
(3, 'counter'),
(4, 'required'),
(5, 'ball'),
(6, 'flirt'),
(7, 'general');

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

CREATE TABLE `code` (
  `id` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` tinyint NOT NULL,
  `id_owner` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `category` tinyint NOT NULL DEFAULT '1',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `filename` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `n_primary` tinyint NOT NULL DEFAULT '0',
  `op` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sequence` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `code`
--

INSERT INTO `code` (`id`, `timestamp`, `type`, `id_owner`, `status`, `title`, `category`, `description`, `filename`, `n_primary`, `op`, `sequence`) VALUES
(1, '2024-12-28 08:04:53', 1, 1, 0, 'test1', 1, '', '0001_1735137325_01', 1, '', 4),
(2, '2024-12-28 08:04:01', 1, 1, 0, 'test2', 1, '', '0001_1735137334_01', 1, '', 0),
(3, '2024-12-28 08:04:44', 1, 1, 0, 'test3', 1, '', '0001_1735137344_01', 1, '', 2),
(4, '2024-12-28 08:04:11', 1, 1, 0, 'test4', 1, '', '0001_1735137430_01', 1, '', 7),
(5, '2024-12-28 08:04:21', 1, 1, 0, 'test5', 1, '', '0001_1735137440_01', 1, '', 1),
(6, '2024-12-28 08:04:35', 1, 1, 0, '2', 1, '', '0001_1735141399_01', 1, '', 0),
(7, '2024-12-28 08:03:53', 1, 1, 0, '2', 1, '', '0001_1735141408_01', 1, '', 6),
(8, '2024-12-27 17:20:38', 1, 1, 0, '1', 1, '', '0001_1735141416_01', 1, '', 5),
(9, '2024-12-27 17:20:30', 1, 1, 0, '1', 2, '', '0001_1735141425_01', 1, '', 3),
(10, '2024-12-27 17:20:22', 1, 1, 0, '1', 1, '', '0001_1735141434_01', 1, '', 7),
(11, '2024-12-27 17:06:17', 1, 6, 0, '1', 6, '', '0006_1735187586_01', 1, '', 10),
(12, '2024-12-29 14:56:17', 2, 6, 0, '1', 1, '', '0006_1735187759_01_01', 1, '', 0),
(13, '2024-12-29 14:56:17', 2, 6, 0, '2', 1, '', '0006_1735187774_01_01', 1, '', 3),
(14, '2024-12-29 14:56:17', 2, 6, 0, '3', 1, '', '0006_1735187785_01_01', 1, '', 2),
(15, '2024-12-29 14:56:17', 2, 6, 0, '4', 1, '', '0006_1735187801_01_01', 1, '', 1),
(16, '2024-12-29 16:57:19', 3, 1, 0, '21', 1, '', '0001_1735188648_01', 1, '', 3),
(17, '2024-12-28 08:05:45', 3, 1, 0, '2', 1, '', '0001_1735188670_01', 1, '', 2),
(18, '2024-12-29 17:12:58', 3, 1, 0, '3', 1, '', '0001_1735188681_01', 1, '', 1),
(19, '2024-12-29 16:56:30', 3, 1, 0, '4', 1, '', '0001_1735188692_01', 1, '', 0),
(20, '2024-12-29 14:56:17', 2, 1, 0, 'd', 1, '', '0001_1735191471_01_01,0001_1735191471_01_02,0001_1735191471_01_03,0001_1735191471_01_04,0001_1735191471_01_05,0001_1735191471_01_06,0001_1735191471_01_07,0001_1735191471_01_08,0001_1735191471_01_09,0001_1735191471_01_10,0001_1735191471_01_11', 1, '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `type` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `number` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `r_value` tinyint UNSIGNED NOT NULL,
  `g_value` tinyint UNSIGNED NOT NULL,
  `b_value` tinyint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`type`, `number`, `name`, `r_value`, `g_value`, `b_value`) VALUES
('11', '1', 'ดำ', 0, 0, 0),
('11', '2', 'ขาว', 255, 255, 255),
('11', '3', 'ชมพู', 255, 0, 255),
('11', '4', 'เหลือง', 255, 255, 0),
('11', '5', 'แดง', 255, 0, 0),
('11', '6', 'ฟ้า', 95, 194, 240),
('11', '7', 'น้ำเงิน', 0, 0, 255),
('11', '8', 'เขียว', 33, 187, 54),
('11', '9', 'ส้ม', 255, 160, 24),
('11', '10', 'น้ำตาล', 77, 48, 10),
('11', '11', 'พู่', 103, 8, 123),
('11', '12', 'คันฉ่อง', 149, 147, 142),
('11', '13', 'X', 0, 255, 0),
('125', '1', '1', 255, 255, 255),
('125', '2', '2', 238, 233, 196),
('125', '3', '3', 182, 179, 156),
('125', '4', '4', 119, 118, 97),
('125', '5', '5', 84, 83, 69),
('125', '6', '6', 0, 0, 0),
('125', '7', '7', 117, 59, 19),
('125', '8', '8', 136, 72, 33),
('125', '9', '9', 214, 92, 25),
('125', '10', '10', 255, 170, 86),
('125', '11', '11', 226, 180, 114),
('125', '12', '12', 250, 205, 146),
('125', '13', '13', 242, 250, 110),
('125', '14', '14', 255, 240, 0),
('125', '15', '15', 255, 204, 0),
('125', '16', '16', 238, 66, 6),
('125', '17', '17', 120, 39, 48),
('125', '18', '18', 172, 43, 26),
('125', '19', '19', 218, 8, 37),
('125', '20', '20', 237, 58, 121),
('125', '21', '21', 235, 90, 158),
('125', '22', '22', 242, 128, 152),
('125', '23', '23', 247, 201, 223),
('125', '24', '24', 220, 171, 230),
('125', '25', '25', 152, 54, 149),
('125', '26', '26', 162, 88, 165),
('125', '27', '27', 80, 19, 51),
('125', '28', '28', 12, 17, 73),
('125', '29', '29', 10, 46, 100),
('125', '30', '30', 0, 159, 211),
('125', '31', '31', 56, 168, 215),
('125', '32', '32', 116, 204, 217),
('125', '33', '33', 213, 246, 147),
('125', '34', '34', 225, 237, 34),
('125', '35', '35', 81, 196, 61),
('125', '36', '36', 41, 147, 22),
('125', '37', '37', 57, 102, 69),
('125', '38', '38', 102, 85, 37),
('125', '39', '39', 162, 109, 39),
('125', '40', '40', 231, 208, 136),
('125', '41', 'X', 0, 255, 0),
('op', '1', '1', 0, 255, 222),
('op', '2', '2', 255, 144, 0),
('op', '3', '3', 42, 0, 255),
('op', '4', '4', 255, 0, 192),
('op', '5', '5', 123, 128, 0),
('op', '6', 'X', 0, 255, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `id_draft` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_mentor` int NOT NULL DEFAULT '-1',
  `cmt_mentor` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_draft`, `timestamp`, `id_mentor`, `cmt_mentor`) VALUES
(1, 9, '2024-12-27 12:00:15', 1, 'HELLO');

-- --------------------------------------------------------

--
-- Table structure for table `dimension`
--

CREATE TABLE `dimension` (
  `id` int NOT NULL DEFAULT '1',
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `s-width` int NOT NULL,
  `s-height` int NOT NULL,
  `p-width` int NOT NULL,
  `p-height` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `dimension`
--

INSERT INTO `dimension` (`id`, `name`, `s-width`, `s-height`, `p-width`, `p-height`) VALUES
(1, 'TUCUBall75', 90, 23, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `draft`
--

CREATE TABLE `draft` (
  `id` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_code` int NOT NULL,
  `num_draft` tinyint NOT NULL,
  `cmt_editor` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `filename` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `op` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_comment` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `draft`
--

INSERT INTO `draft` (`id`, `timestamp`, `id_code`, `num_draft`, `cmt_editor`, `filename`, `op`, `last_comment`) VALUES
(1, '2024-12-25 14:35:25', 1, 1, '', '0001_1735137325_01', '', '0000-00-00 00:00:00'),
(2, '2024-12-25 14:35:34', 2, 1, '', '0001_1735137334_01', '', '0000-00-00 00:00:00'),
(3, '2024-12-25 14:35:44', 3, 1, '', '0001_1735137344_01', '', '0000-00-00 00:00:00'),
(4, '2024-12-25 14:37:10', 4, 1, '', '0001_1735137430_01', '', '0000-00-00 00:00:00'),
(5, '2024-12-25 14:37:20', 5, 1, '', '0001_1735137440_01', '', '0000-00-00 00:00:00'),
(6, '2024-12-25 15:43:19', 6, 1, '', '0001_1735141399_01', '', '0000-00-00 00:00:00'),
(7, '2024-12-25 15:43:28', 7, 1, '', '0001_1735141408_01', '', '0000-00-00 00:00:00'),
(8, '2024-12-25 15:43:36', 8, 1, '', '0001_1735141416_01', '', '0000-00-00 00:00:00'),
(9, '2024-12-25 15:43:45', 9, 1, '', '0001_1735141425_01', '', '2024-12-27 12:00:15'),
(10, '2024-12-25 15:43:54', 10, 1, '', '0001_1735141434_01', '', '0000-00-00 00:00:00'),
(11, '2024-12-26 04:33:06', 11, 1, '', '0006_1735187586_01', '', '0000-00-00 00:00:00'),
(12, '2024-12-26 04:35:59', 12, 1, '', '0006_1735187759_01_01', '', '0000-00-00 00:00:00'),
(13, '2024-12-26 04:36:14', 13, 1, '', '0006_1735187774_01_01', '', '0000-00-00 00:00:00'),
(14, '2024-12-26 04:36:25', 14, 1, '', '0006_1735187785_01_01', '', '0000-00-00 00:00:00'),
(15, '2024-12-26 04:36:41', 15, 1, '', '0006_1735187801_01_01', '', '0000-00-00 00:00:00'),
(16, '2024-12-26 04:50:48', 16, 1, '', '0001_1735188648_01', '', '0000-00-00 00:00:00'),
(17, '2024-12-26 04:51:10', 17, 1, '', '0001_1735188670_01', '', '0000-00-00 00:00:00'),
(18, '2024-12-26 04:51:21', 18, 1, '', '0001_1735188681_01', '', '0000-00-00 00:00:00'),
(19, '2024-12-26 04:51:32', 19, 1, '', '0001_1735188692_01', '', '0000-00-00 00:00:00'),
(20, '2024-12-26 05:37:51', 20, 1, '', '0001_1735191471_01_01,0001_1735191471_01_02,0001_1735191471_01_03,0001_1735191471_01_04,0001_1735191471_01_05,0001_1735191471_01_06,0001_1735191471_01_07,0001_1735191471_01_08,0001_1735191471_01_09,0001_1735191471_01_10,0001_1735191471_01_11', '', '0000-00-00 00:00:00'),
(21, '2024-12-27 12:33:33', 6, 2, '', '0001_1735302813_02', '', '0000-00-00 00:00:00'),
(22, '2024-12-27 12:33:42', 6, 3, '', '0001_1735302822_03', '', '0000-00-00 00:00:00'),
(23, '2024-12-27 13:12:40', 6, 4, '', '0001_1735305160_04', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mpc`
--

CREATE TABLE `mpc` (
  `id` int NOT NULL,
  `id_primary` int NOT NULL,
  `n_primary` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mpc`
--

INSERT INTO `mpc` (`id`, `id_primary`, `n_primary`, `user_id`) VALUES
(16, 19, 1, 3),
(18, 11, 1, 3),
(19, 19, 1, 2),
(21, 11, 1, 2),
(23, 11, 1, 1),
(25, 19, 1, 1),
(26, 1, 1, 2),
(27, 2, 1, 2),
(28, 3, 1, 2),
(29, 4, 1, 2),
(30, 5, 1, 2),
(31, 6, 1, 2),
(32, 7, 1, 2),
(33, 8, 1, 2),
(34, 9, 1, 2),
(35, 10, 1, 2),
(36, 12, 1, 2),
(37, 13, 1, 2),
(38, 14, 1, 2),
(39, 15, 1, 2),
(40, 16, 1, 2),
(41, 17, 1, 2),
(42, 18, 1, 2),
(43, 20, 1, 2),
(44, 1, 1, 3),
(45, 2, 1, 3),
(46, 3, 1, 3),
(47, 4, 1, 3),
(48, 5, 1, 3),
(49, 6, 1, 3),
(50, 7, 1, 3),
(51, 8, 1, 3),
(52, 9, 1, 3),
(53, 10, 1, 3),
(54, 12, 1, 3),
(55, 13, 1, 3),
(56, 14, 1, 3),
(57, 15, 1, 3),
(58, 16, 1, 3),
(59, 17, 1, 3),
(60, 18, 1, 3),
(61, 20, 1, 3),
(62, 20, 1, 1),
(63, 15, 1, 1),
(64, 10, 1, 1),
(65, 9, 1, 1),
(66, 8, 1, 1),
(68, 18, 1, 1),
(69, 7, 1, 1),
(70, 2, 1, 1),
(71, 4, 1, 1),
(72, 5, 1, 1),
(73, 6, 1, 1),
(74, 3, 1, 1),
(75, 1, 1, 1),
(76, 14, 1, 1),
(77, 13, 1, 1),
(78, 17, 1, 1),
(79, 16, 1, 1),
(80, 12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `msg` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `msg`) VALUES
(1, 'If you encounter \'This site can’t be reached,\' please reload the page calmly. We apologize for the inconvenience.'),
(2, '\"Add Code\" might not work properly sometimes due to web issues.'),
(3, 'For CODE on the list if it\'s YELLOW you need to update CODE by following mentor\'s comment');

-- --------------------------------------------------------

--
-- Table structure for table `secret`
--

CREATE TABLE `secret` (
  `role` tinyint NOT NULL,
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `verif` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `secret`
--

INSERT INTO `secret` (`role`, `name`, `verif`) VALUES
(1, 'admin', '75!cuchamp'),
(2, 'editor', 'soosoonakub'),
(3, 'viewer', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `nickname` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `role` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `timestamp`, `email`, `nickname`, `role`) VALUES
(1, '2024-12-21 07:04:58', 'tharawaranuset@gmail.com', 'Best #2 ENG', 1),
(3, '2024-12-21 18:10:25', '6541247827@student.chula.ac.th', 'Ball #3 EDU', 1),
(5, '2024-12-23 13:14:55', '6430056825@student.chula.ac.th', 'Safe #4 ARCH', 1),
(8, '2024-12-25 14:48:43', '6430110025@student.chul.ac.th', 'thuktong #4 ARCH', 2),
(9, '2024-12-25 16:14:09', '6430116825@student.chula.ac.th', 'Bow #4 ARCH', 2),
(11, '2024-12-27 10:57:24', 'tharawaranusetmember@gmail.com', 'BestMember #2 ENG', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft`
--
ALTER TABLE `draft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mpc`
--
ALTER TABLE `mpc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `code`
--
ALTER TABLE `code`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `draft`
--
ALTER TABLE `draft`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mpc`
--
ALTER TABLE `mpc`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
