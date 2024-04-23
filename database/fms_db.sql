-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 08:55 PM
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
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `user_id`, `name`, `parent_id`) VALUES
(10, 1, 'IDOL', 0);

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
(7, 'asdasdpoj', 'asjdna', 'POOP', 'POOP', 'poppoad10231231', 'POOP@gmail.com', 'POOSAPDAPSDOASO', '66216ae2b2ab7_Father_Saturnino_Urios_University_logo.png'),
(8, 'asdasdpoj', 'asjdna', 'POOP', 'POOP', 'poppoad10231231', 'POOP@gmail.com', 'POOSAPDAPSDOASO', '66216aeaef5da_Father_Saturnino_Urios_University_logo.png'),
(9, 'asdasdpoj', 'asjdna', 'POOP', 'POOP', 'poppoad10231231', 'POOP@gmail.com', 'POOSAPDAPSDOASO', '66216aed8a231_Father_Saturnino_Urios_University_logo.png'),
(10, 'asdasdpoj', 'asjdna', 'POOP', 'POOP', 'poppoad10231231', 'POOP@gmail.com', 'POOSAPDAPSDOASO', '66216af078702_Father_Saturnino_Urios_University_logo.png'),
(11, 'asdasdpoj', 'asjdna', 'POOP', 'POOP', 'poppoad10231231', 'POOP@gmail.com', 'POOSAPDAPSDOASO', '66216af624c1e_Father_Saturnino_Urios_University_logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `rdrrmc`
--

CREATE TABLE `rdrrmc` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `agency` varchar(255) DEFAULT NULL,
  `head_of_office` varchar(255) DEFAULT NULL,
  `position_re` varchar(255) DEFAULT NULL,
  `contact_number_re` varchar(20) DEFAULT NULL,
  `email_re` varchar(255) DEFAULT NULL,
  `office_address_re` varchar(255) DEFAULT NULL,
  `agency_r` varchar(255) DEFAULT NULL,
  `position_r` varchar(255) DEFAULT NULL,
  `contact_number_r` varchar(20) DEFAULT NULL,
  `email_r` varchar(255) DEFAULT NULL,
  `office_address_r` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rdrrmc`
--

INSERT INTO `rdrrmc` (`id`, `image`, `agency`, `head_of_office`, `position_re`, `contact_number_re`, `email_re`, `office_address_re`, `agency_r`, `position_r`, `contact_number_r`, `email_r`, `office_address_r`) VALUES
(24, '66216a6eefcd7_Bagong_Pilipinas_logo.png', 'ANGCOOL', 'l;m', 'fzxcsa', '23421231', 'asd@gmail.com', 'asczxcz@gmail.com', 'asdasd', 'sad', 'asd123123', 'sad@gmail.com', 'asdnj'),
(25, '66216a9873a63_Bagong_Pilipinas_logo.png', 'ANGCOOL', 'l;m', 'fzxcsa', '23421231', 'asd@gmail.com', 'asczxcz@gmail.com', 'asdasd', 'sad', 'asd123123', 'sad@gmail.com', 'asdnj'),
(26, '66216a9fd02c5_Bagong_Pilipinas_logo.png', 'ANGCOOL', 'l;m', 'fzxcsa', '23421231', 'asd@gmail.com', 'asczxcz@gmail.com', 'asdasd', 'sad', 'asd123123', 'sad@gmail.com', 'asdnj'),
(27, '66216aa9bbf1a_Bagong_Pilipinas_logo.png', 'ANGCOOL', 'l;m', 'fzxcsa', '23421231', 'asd@gmail.com', 'asczxcz@gmail.com', 'asdasd', 'sad', 'asd123123', 'sad@gmail.com', 'asdnj');

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
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ldrrmos`
--
ALTER TABLE `ldrrmos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rdrrmc`
--
ALTER TABLE `rdrrmc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
