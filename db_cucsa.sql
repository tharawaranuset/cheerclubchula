-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 
-- Generation Time: Dec 23, 2024 at 10:28 AM
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
-- Database: `db_cucsa`
--

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
(1, 'admin', 'pass1'),
(2, 'editor', 'pass2'),
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
(2, '2024-12-21 17:30:08', 'tharawaranuset2@gmail.com', 'BestForTest #2 ENG', 2),
(3, '2024-12-21 18:10:25', 'XXX', 'XXX XXX XXX', 1);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `draft`
--
ALTER TABLE `draft`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
