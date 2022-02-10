-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2022 at 07:15 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charity`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `customer_id` bigint(20) NOT NULL,
  `customer_first_name` varchar(50) NOT NULL COMMENT 'User first name',
  `customer_last_name` varchar(50) DEFAULT NULL COMMENT 'User last name',
  `customer_gender` varchar(2) NOT NULL COMMENT 'Gender of the user - M, F, O',
  `customer_mobile_no` bigint(20) DEFAULT NULL COMMENT 'User subject id',
  `customer_email_id` varchar(50) DEFAULT NULL COMMENT 'User email id',
  `customer_email_password` varchar(50) DEFAULT NULL COMMENT 'User email id password encrypted',
  `customer_email_verified_status` int(11) DEFAULT 0 COMMENT 'User email id verification 0,1',
  `customer_locked_status` int(11) DEFAULT 0 COMMENT 'User id lock status 0,1',
  `customer_attempt` int(11) NOT NULL DEFAULT 0,
  `customer_status` varchar(20) NOT NULL DEFAULT 'REMOVED' COMMENT 'ACTIVE or REMOVED',
  `created_by` varchar(20) NOT NULL DEFAULT '0',
  `created_dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(20) DEFAULT NULL,
  `modified_dt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`customer_id`, `customer_first_name`, `customer_last_name`, `customer_gender`, `customer_mobile_no`, `customer_email_id`, `customer_email_password`, `customer_email_verified_status`, `customer_locked_status`, `customer_attempt`, `customer_status`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'aaradhya', 'traders', 'M', 7016025333, 'aaradhyatraders@gmail.com', '123', 1, 0, 0, 'ACTIVE', '0', '2020-10-19 07:21:06', NULL, '2020-11-22 06:10:13'),
(2, 'Sssssd', 'Fffff', 'M', 7016025333, 'ajaydubey7967@gmail.com', 'A123456789a', 0, 0, 0, 'ACTIVE', '0', '2020-10-19 09:44:30', NULL, '2020-11-20 06:08:45'),
(3, 'Fffff', 'Fffffff', 'M', 7016025333, 'ajaydubey7967@gmail.com', 'HJy2?q7H', 0, 0, 0, 'ACTIVE', '0', '2020-10-19 09:46:44', NULL, '2020-11-20 06:08:49'),
(4, 'Fffff', 'Ffff', 'M', 7016025333, 'ajaydubey7967@gmail.com', '5u3QnM&Q', 0, 0, 0, 'ACTIVE', '0', '2020-10-19 09:47:43', NULL, '2020-11-20 06:08:51'),
(5, 'Dddddfff', 'Fffff', 'M', 7016025333, 'ajaydubey7967@gmail.com', 'ep%c8Qre', 0, 0, 0, 'ACTIVE', '0', '2020-10-25 14:21:16', NULL, '2020-11-20 06:09:58'),
(6, 'Fffffg', 'Fffffg', 'M', 0, 'ajaydubey7967@gmail.com', 'kf4?**ZS', 0, 0, 0, 'ACTIVE', '0', '2020-10-25 14:21:40', NULL, '2020-11-20 06:09:59'),
(7, 'Ggggggg', 'Ffffff', 'M', 0, 'ajaydubey7967@gmail.com', 'KFBqd?B7', 0, 0, 0, 'ACTIVE', '0', '2020-10-25 14:21:58', NULL, '2020-11-20 06:10:01'),
(8, 'Suraj', 'Cfff', 'M', 0, 'ajaydubey7967@gmail.com', 'rPa2@Cj5', 0, 0, 0, 'ACTIVE', '0', '2020-10-25 14:30:34', NULL, '2020-11-20 06:10:03'),
(9, 'Ffffggg', 'Fffff', 'F', 0, 'ajaydubey7967@gmail.com', 'b6FdA*6M', 0, 0, 0, 'ACTIVE', '0', '2020-10-25 14:31:04', NULL, '2020-11-20 06:10:04'),
(10, 'Ambuj ', 'Tiwari', 'M', 0, 'ajaydubey7967@gmail.com', '5K$nER5R', 0, 0, 0, 'ACTIVE', '0', '2020-11-05 05:21:15', NULL, '2020-11-05 05:25:38'),
(11, 'Suraj', 'Fffff', 'M', 0, 'ajaydubey7967@gmail.com', 'z2H7dN@z', 0, 0, 0, 'ACTIVE', '0', '2020-11-05 05:26:22', NULL, '2020-11-20 06:04:42'),
(12, 'Ggggg', 'Gggg', 'M', 0, 'ajaydubey7967@gmail.com', 'PX2&6nUv', 0, 0, 0, 'ACTIVE', '0', '2020-11-05 05:26:47', NULL, '2020-11-20 06:04:40'),
(13, 'Vgggg', 'Ffffg', 'M', 0, 'ajaydubey7967@gmail.com', 'JNv5!#t@', 0, 0, 0, 'ACTIVE', '0', '2020-11-05 05:27:07', NULL, '2020-11-20 06:04:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `customer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
