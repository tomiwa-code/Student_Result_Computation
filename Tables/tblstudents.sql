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
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `studentid` int(11) NOT NULL,
  `matric_no` varchar(100) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `levelId` int(11) NOT NULL,
  `session` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`studentid`, `matric_no`, `firstname`, `middlename`, `lastname`, `program`, `email`, `password`, `img_name`, `levelId`, `session`) VALUES
(2, '15/69/0096', 'Olalekan', 'Quadri', 'Saheeb', 'Full Time', 'saheebolalekan@gmail.com', 'password', 'student15690096.jpg', 3, '2019/2020'),
(3, '19/69/0061', 'Tolulope', 'Solomon', 'Akinrimisi', 'Full Time', 'akinrimisitolulope@gmail.com', 'password', 'student15690261.jpg', 1, '2019/2020'),
(4, '18/69/0054', 'Micheal', 'John', 'Jimoh', 'Full Time', 'jimohmicheal@gmail.com', 'password', 'student15690054.jpg', 2, '2019/2020'),
(5, '19/98/0089', 'Sam', 'Smith', 'Doe', 'Full Time', 'smithsam@gmail.com', 'password', 'student15690096.jpg', 4, '2018/2019'),
(6, '19/98/0057', 'Ayotunde', 'Samuel', 'Oni', 'Full Time', 'oniayotunde@gmail.com', 'password', 'student15690089.jpg', 3, '2019/2020'),
(7, '19/69/0009', 'Rukayat', 'Alimat', 'Olanite', 'Full Time', 'olaniterukayat@gmail.com', 'password', 'student15690009.jpg', 1, '2019/2020'),
(8, '18/69/0040', 'Adeola', 'Oluwasegun', 'Ogunbase', 'Full Time', 'ogunbaseadeola@gmail.com', 'password', 'student15690440.jpg', 2, '2019/2020'),
(9, '19/69/0075', 'Moana', 'Adura', 'Bella', 'Full Time', 'bellamoana@gmail.com', 'password', 'student19690075.jpg', 1, '2019/2020'),
(10, '18/69/0075', 'Olayinka', 'Momo', 'Bella', 'Full Time', 'bellaolayinka@gmail.com', 'password', 'student18690075.jpg', 2, '2018/2019'),
(11, '15/69/0005', 'Nike', 'Bukola', 'Adeniyi', 'Full Time', 'adeniyinike@gmail.com', 'password', 'student15690005.png', 4, '2018/2019'),
(12, '18/69/0057', 'Gift', 'Precious', 'Adaeze', 'Full Time', 'adaezegift@gmail.com', 'password', 'student18690057.jpg', 2, '2018/2019'),
(13, '15/69/0010', 'Aiden', 'James', 'McQueen', 'Full Time', 'mcqueenaiden@gmail.com', 'password', 'student15690010.jpg', 4, '2018/2019'),
(14, '19/69/0001', 'Emmy ', 'Rebekka', 'Watson', 'Full Time', 'watsonemmy@gmail.com', 'password', 'student19690001.jpg', 1, '2019/2020'),
(15, '15/69/0006', 'Ayoola', 'Adetomiwa', 'Ogunbase', 'Full Time', 'ogunbaseayoola@gmail.com', 'password', 'student15690096.jpg', 3, '2019/2020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`studentid`),
  ADD UNIQUE KEY `matric_no` (`matric_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
