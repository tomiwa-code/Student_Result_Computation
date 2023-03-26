-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 01:08 PM
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
-- Table structure for table `tblcourses`
--

CREATE TABLE `tblcourses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `course_unit` varchar(255) NOT NULL,
  `course_type` varchar(255) NOT NULL,
  `levelId` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `session` varchar(9) NOT NULL,
  `lecturerId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcourses`
--

INSERT INTO `tblcourses` (`id`, `course_code`, `course_title`, `course_unit`, `course_type`, `levelId`, `semester`, `session`, `lecturerId`) VALUES
(3, 'com 311', 'operating system 1', '3', 'core course', '3', 'first', '2019/2020', '20002111'),
(4, 'com 313', 'computer programming using c++', '2', 'core course', '3', 'first', '2019/2020', '20001212'),
(15, 'com 321', 'operating system ii', '3', 'core course', '3', 'second', '2019/2020', '20002111'),
(17, 'com 323', 'assembly language', '3', 'core course', '3', 'second', '2019/2020', '20001212'),
(20, 'com 113', 'Intro. to programming', '3', 'core course', '1', 'first', '2019/2020', '20001212'),
(27, 'Com 111', 'Intro. to computing', '3', 'core course', '1', 'first', '2019/2020', '20002111'),
(38, 'Com 211', 'Computer programming using oo basic', '3', 'core course', '2', 'first', '2019/2020', '20001212'),
(39, 'Com 218', 'Introduction to operating systems', '3', 'core course', '2', 'first', '2019/2020', '20002111'),
(45, 'Com 121', 'Scientific programming lang. using oo fortran', '3', 'core course', '2', 'second', '2019/2020', '20001212'),
(48, 'com 215', 'Computer packages II', '2', 'core course', '2', 'second', '2019/2020', '20002111'),
(50, 'com 422', 'Computer graphics & animation', '3', 'restricted elective', '4', 'second', '2019/2020', '20001212'),
(51, 'com 426', 'Small business start up', '2', 'restricted elective', '4', 'second', '2019/2020', '20002111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcourses`
--
ALTER TABLE `tblcourses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcourses`
--
ALTER TABLE `tblcourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
