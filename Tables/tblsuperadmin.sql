-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 01:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mapoly_result`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblsuperadmin`
--

CREATE TABLE `tblsuperadmin` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `level` varchar(255) NOT NULL,
  `pos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsuperadmin`
--

INSERT INTO `tblsuperadmin` (`id`, `unique_id`, `firstname`, `middlename`, `lastname`, `level`, `pos`, `email`, `password`, `img`) VALUES
(0, '20001221', 'Millie', 'Brown', 'Joseph', 'Superadmin', 'Head of Department (HOD)', 'superadmin@gmail.com', 'password', 'superadmin20001221.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblsuperadmin`
--
ALTER TABLE `tblsuperadmin`
  ADD PRIMARY KEY (`unique_id`),
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
