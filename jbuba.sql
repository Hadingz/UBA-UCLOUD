-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 07:42 PM
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
-- Database: `jbuba`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `Sol_ID` int(11) NOT NULL,
  `Account_No` int(99) NOT NULL,
  `Account_Name` varchar(255) NOT NULL,
  `Doc_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `uploaded_Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `Sol_ID`, `Account_No`, `Account_Name`, `Doc_name`, `url`, `uploaded_Time`) VALUES
(1, 0, 1111111111, 'jakak', 'ususj', 'uploads/doc_678fdcf24ba82.JPG', '2025-01-21 17:52:49'),
(2, 0, 1111111111, 'jakak', 'Waec document', 'uploads/doc_678fe6b7730ab.docx', '2025-01-21 18:25:59'),
(3, 0, 1111111111, 'jakak', 'Waec document', 'uploads/doc_678fe7f9b3c39.docx', '2025-01-21 18:31:21'),
(4, 0, 1111111111, 'jakak', 'Waec document', 'uploads/doc_678fe850143b3.docx', '2025-01-21 18:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Sol_ID` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Sol_ID`, `Password`, `RegTime`) VALUES
(1, 'tibson', '$2y$10$W.vn7nvWxsarHR8ZaeAe.ONYJaIpuQS3MKJ3Sp4zhgqnDZ.ZG7PJi', '2025-01-21 19:35:32'),
(2, 'Manager', '$2y$10$2heiJ8UeB6zf4JIDeP7Y1.eLaiOc52YIpZljaiiekG8TjVTbCiapS', '0000-00-00 00:00:00'),
(3, 'tibs', '$2y$10$aD7liUl5DTVj.6qT36sALeWAHKpWYhqDGWrQGKYouMhOQiVFRuq9S', '2025-01-21 19:36:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
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
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
