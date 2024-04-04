-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 05:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `folder_id` int(30) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` text NOT NULL,
  `is_public` tinyint(1) DEFAULT 0,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `organization` varchar(255) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `description`, `user_id`, `folder_id`, `file_type`, `file_path`, `is_public`, `date_updated`, `organization`, `year`) VALUES
(15, 'the life', 'LETTER', 1, 0, 'jpg', '1709875380_pict4.jpg', 1, '2024-03-12 09:23:27', 'OCD', 2019),
(22, 'Template-2024-Calendar-of-Activities', 'MEMORANDUM', 1, 0, 'docx', '1709883600_Template-2024-Calendar-of-Activities.docx', 1, '2024-03-12 09:23:16', 'RDRRMC', 2010),
(23, 'Issues and Concerns-COMMAND-CONFERENCE', 'RESOLUTION', 1, 0, 'pptx', '1710122700_Issues and Concerns-COMMAND-CONFERENCE.pptx', 1, '2024-03-12 09:23:03', 'RDRRMC', 2015),
(24, '2024', 'MEMORANDUM', 1, 0, 'htm', '1710138420_download.htm', 1, '2024-03-12 09:19:36', 'RDRRMC', 2025),
(25, 'home', 'Officer Order', 1, 0, 'php', '1710205440_home.php', 1, '2024-03-12 09:04:34', 'OCD', 2030),
(26, 'home ||1', 'PPBER', 1, 0, 'php', '1710219600_home.php', 1, '2024-03-12 13:00:47', 'OCD', 2017),
(27, 'Bagong_Pilipinas_logo', 'Officer Order', 1, 0, 'png', '1710228720_Bagong_Pilipinas_logo.png', 1, '2024-03-12 15:32:38', 'OCD', 2021),
(28, 'OPTIONS-000007', 'MAR', 1, 0, '', '1710228720_OPTIONS-000007', 1, '2024-03-12 15:32:57', 'OCD', 2027),
(29, 'homeback', 'MINUTES', 1, 0, 'jpeg', '1710228780_homeback.jpeg', 1, '2024-03-12 15:33:23', 'RDRRMC', 2024),
(30, 'loginback', 'LETTERS', 1, 0, 'jpeg', '1710228780_loginback.jpeg', 1, '2024-03-12 15:33:45', 'RDRRMC', 2025),
(31, 'UCS 2024', 'Officer Order', 1, 0, 'rar', '1710309540_UCS 2024.rar', 1, '2024-03-13 13:59:57', 'OCD', 2030),
(32, 'VOLC 2024', 'MEMORANDUM', 1, 0, 'rar', '1710309960_VOLC 2024.rar', 1, '2024-03-13 14:06:27', 'RDRRMC', 2027),
(34, 'april2024', 'Officer Order', 1, 8, 'docx', '1710315000_april2024.docx', 1, '2024-03-13 15:30:12', 'OCD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `focalpersons`
--

CREATE TABLE `focalpersons` (
  `id` int(11) NOT NULL,
  `drrm_focal_person` varchar(255) NOT NULL,
  `focal_person_position` varchar(255) NOT NULL,
  `focal_person_contact` varchar(20) NOT NULL,
  `focal_person_email` varchar(255) NOT NULL,
  `office_address_fp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `focalpersons`
--

INSERT INTO `focalpersons` (`id`, `drrm_focal_person`, `focal_person_position`, `focal_person_contact`, `focal_person_email`, `office_address_fp`) VALUES
(2, 'asd', 'asd', 'asd', 'asd@gmail.com', 'ijfiosr324'),
(3, 'asd', 'asd', 'asd', 'asd@gmail.com', 'ijfiosr324');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ldrrmos`
--

CREATE TABLE `ldrrmos` (
  `id` int(11) NOT NULL,
  `local_chief_executive` varchar(255) DEFAULT NULL,
  `local_drrm_officer` varchar(255) DEFAULT NULL,
  `position_l` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `contact_number_l` varchar(20) DEFAULT NULL,
  `email_l` varchar(255) DEFAULT NULL,
  `office_address_l` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ldrrmos`
--

INSERT INTO `ldrrmos` (`id`, `local_chief_executive`, `local_drrm_officer`, `position_l`, `designation`, `contact_number_l`, `email_l`, `office_address_l`, `image`) VALUES
(6, 'patrick', 'paos', 'apoksd', 'pokaf', 'poaj2341', 'joa@gmail.com', 'jpo2jr23', 'loginback.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `rdrrmc`
--

CREATE TABLE `rdrrmc` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `agency` varchar(255) DEFAULT NULL,
  `head_of_office` varchar(255) DEFAULT NULL,
  `position_r` varchar(255) DEFAULT NULL,
  `contact_number_r` varchar(20) DEFAULT NULL,
  `email_r` varchar(255) DEFAULT NULL,
  `office_address_r` varchar(255) DEFAULT NULL,
  `focal_person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rdrrmc`
--

INSERT INTO `rdrrmc` (`id`, `image`, `agency`, `head_of_office`, `position_r`, `contact_number_r`, `email_r`, `office_address_r`, `focal_person_id`) VALUES
(15, 'loginback.jpeg', 'fsuu', 'mhico', 'pres', '0394204', 'tuz@gmail.com', 'libertad', NULL),
(17, '660d842e47698_homeback.jpeg', 'asd', 'asd', 'asdwf', 'askfa23420', 'asd@gmail.com', 'asdas', NULL),
(18, '0-02-06-0c495870dbea56ebbab119c34c6900c192ab8652e2f36669f6ff2f0d25f00e42_b480fbfd816858ac.jpg', '', '', '', '', '', '', 2),
(19, '0-02-06-0c495870dbea56ebbab119c34c6900c192ab8652e2f36669f6ff2f0d25f00e42_b480fbfd816858ac.jpg', '', '', '', '', '', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1+admin , 2 = users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', 'admin123', 1),
(4, 'Jai', 'Jai', '4', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `focalpersons`
--
ALTER TABLE `focalpersons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ldrrmos`
--
ALTER TABLE `ldrrmos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rdrrmc`
--
ALTER TABLE `rdrrmc`
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
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `focalpersons`
--
ALTER TABLE `focalpersons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ldrrmos`
--
ALTER TABLE `ldrrmos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rdrrmc`
--
ALTER TABLE `rdrrmc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
