-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 01:07 PM
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
-- Table structure for table `studentregcourses`
--

CREATE TABLE `studentregcourses` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(255) NOT NULL,
  `courseId` varchar(255) NOT NULL,
  `lecturerId` varchar(255) NOT NULL,
  `semester` varchar(8) NOT NULL,
  `session` varchar(9) NOT NULL,
  `submit` tinyint(1) NOT NULL,
  `upload` tinyint(1) NOT NULL,
  `edit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentregcourses`
--

INSERT INTO `studentregcourses` (`id`, `matric_no`, `courseId`, `lecturerId`, `semester`, `session`, `submit`, `upload`, `edit`) VALUES
(125, '19/69/0061', '20', '20001212', 'first', '2019/2020', 0, 0, 1),
(126, '19/69/0061', '27', '20002111', 'first', '2019/2020', 0, 0, 1),
(134, '19/69/0001', '20', '20001212', 'first', '2019/2020', 0, 0, 1),
(135, '19/69/0001', '27', '20002111', 'first', '2019/2020', 0, 0, 1),
(145, '19/98/0057', '3', '20002111', 'first', '2019/2020', 0, 0, 1),
(146, '19/98/0057', '4', '20001212', 'first', '2019/2020', 0, 0, 1),
(157, '19/98/0057', '15', '20002111', 'second', '2019/2020', 1, 1, 0),
(159, '19/98/0057', '17', '20001212', 'second', '2019/2020', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `studentregcourses`
--
ALTER TABLE `studentregcourses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentregcourses`
--
ALTER TABLE `studentregcourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
