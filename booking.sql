-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2020 at 07:21 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_name` varchar(100) NOT NULL,
  `booking_amount` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `booking_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_name`, `booking_amount`, `start_date`, `end_date`, `booking_email`) VALUES
(1, 'raj patel', 200, '2020-02-01', '2020-02-04', 'raj@gmail.com'),
(2, 'ram shah', 200, '2020-02-05', '2020-02-06', 'ram@gmail.com'),
(3, 'prince thakor', 200, '2020-02-06', '2020-02-10', 'prince@gmail.com'),
(4, 'pravin patel', 25, '2020-02-28', '2020-02-29', 'pravin@gmail.com'),
(5, 'pankaj thakor', 50, '2020-02-15', '2020-02-17', 'pankaj@gmail.com'),
(6, 'paresh shah', 50, '2020-02-25', '2020-02-27', 'paresh@gmail.com'),
(7, 'palkesh shah', 50, '2020-02-28', '2020-03-01', 'palkesh@gmail.com'),
(8, 'ravi patel', 25, '2020-03-03', '2020-03-04', 'ravi@gmail.com'),
(9, 'tej patel', 50, '2020-03-19', '2020-03-21', 'tej@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
