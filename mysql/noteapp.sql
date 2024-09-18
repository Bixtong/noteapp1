-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 11:05 AM
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
-- Database: `noteapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `n_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `is_favorite` tinyint(1) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_id` int(11) DEFAULT NULL,
  `archived_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`n_id`, `title`, `content`, `is_favorite`, `time`, `u_id`, `archived_at`) VALUES
(116, 'Note 2', 'My Journal', 1, '2024-04-17 08:02:56', 65, '2024-04-17 08:09:43'),
(119, 'Note 4', 'fsdfdsdsf fdfsd fdsfsd\r\nfdsfsdf\r\nfdsfds\r\nfsdfds\r\nfsdfds\r\nfsdfsdfsfsd fsdfdsf fsdfdsfsdf', 0, '2024-04-15 06:59:48', 65, '2024-04-17 07:54:09'),
(120, 'Note 5', 'sdfsd', 0, '2024-04-15 08:59:28', 65, '2024-04-17 07:54:11'),
(123, 'Gggdd', 'gdfgdffd', 0, '2024-04-17 02:45:20', 65, '2024-04-17 07:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `n_id` int(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `is_favorite` tinyint(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`n_id`, `title`, `content`, `is_favorite`, `time`, `u_id`) VALUES
(122, 'Bdsffdsfdsf', 'dsfdsfds', 1, '2024-04-17 06:44:50', 65),
(125, 'GDFGD', 'dfgdfgfdgdf', 1, '2024-04-17 06:44:54', 65),
(126, 'GFGDF', 'ggdfgdffd', 1, '2024-04-17 06:44:52', 65),
(127, 'GFGDFGd', 'fdsdsfdssd', 0, '2024-04-17 02:45:51', 65),
(128, 'DVXCXC', 'xcvxcvxcvxc', 1, '2024-04-17 08:00:08', 65),
(129, 'Dash', 'dgdfdsfsd', 0, '2024-04-17 03:17:12', 65),
(130, 'Ffdsfsdfds', 'dsfsdfsdfsdfds', 0, '2024-04-17 03:55:31', 65),
(131, 'Vvc', 'cccx', 0, '2024-04-17 04:47:46', 65),
(132, 'Lawas', 'fzxfdfdsfds', 0, '2024-04-17 04:52:31', 65),
(133, 'FDFDf', 'sdsadasa', 0, '2024-04-17 05:16:14', 65),
(134, 'FDSFDSfsdfdfds', 'dffdf', 0, '2024-04-17 05:16:39', 65),
(135, 'Gdsfsdfds', 'dsffdsfsf', 0, '2024-04-17 07:40:46', 65),
(136, 'GFgdfc', 'ggdfgdf', 0, '2024-04-17 07:50:47', 65),
(137, 'Fvbcvbcv', 'dfgfdgd', 0, '2024-04-17 07:58:19', 65),
(138, 'FDSgdfgd', 'fdsfsfsd', 0, '2024-04-17 07:59:11', 65),
(139, 'GFDGf', 'fdfsdfs', 0, '2024-04-17 08:01:16', 65),
(140, 'Bdfgdfgd', 'fdfsdfs', 0, '2024-04-17 08:02:10', 65);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'DEFUALT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `name`, `email`, `password`, `photo`) VALUES
(64, 'Ardon', 'ardon@gmail.com', '$2y$10$R6HlHqofhqzZFC2yNGVobOcGA1SjcT50l7bfGiIze09FnpBRSX6v.', 'DEFUALT'),
(65, 'Rodel Celis', 'rodel@gmail.com', '$2y$10$mtndrICss/LwSaINGps56uOlKYh9g3Rj9bBdEQzxUvJr3oacH7.NS', 'img/cringe.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `n_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
