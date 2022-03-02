-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2022 at 12:34 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `child_wish`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_user_id` bigint(20) NOT NULL,
  `user_firstname` varchar(50) DEFAULT NULL,
  `user_lastname` varchar(50) DEFAULT NULL,
  `user_email_id` varchar(50) DEFAULT NULL COMMENT 'User email id',
  `user_email_password` varchar(50) DEFAULT NULL COMMENT 'User email id password encrypted',
  `user_password_salt` varchar(50) DEFAULT NULL COMMENT 'User email id password salt',
  `user_password_question` varchar(200) DEFAULT NULL COMMENT 'User email id password security question',
  `user_password_answer` varchar(20) DEFAULT NULL COMMENT 'User email id password security question answer',
  `user_email_verified_status` int(11) DEFAULT 0 COMMENT 'User email id verification 0,1',
  `user_locked_status` int(11) DEFAULT 0 COMMENT 'User id lock status 0,1',
  `user_attempt` int(10) NOT NULL DEFAULT 0,
  `user_status` varchar(20) NOT NULL DEFAULT 'REMOVED' COMMENT 'ACTIVE or REMOVED',
  `user_activation_dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` timestamp NULL DEFAULT current_timestamp(),
  `user_login_active` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_user_id`, `user_firstname`, `user_lastname`, `user_email_id`, `user_email_password`, `user_password_salt`, `user_password_question`, `user_password_answer`, `user_email_verified_status`, `user_locked_status`, `user_attempt`, `user_status`, `user_activation_dt`, `created_by`, `created_dt`, `modified_by`, `modified_dt`, `user_login_active`) VALUES
(9, 'Vishal', 'Patel', 'vishal@gmail.com', '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, 1, 0, 0, 'ACTIVE', '2022-03-03 00:05:14', NULL, '2022-03-03 00:05:14', NULL, '2022-03-03 00:05:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_token`
--

CREATE TABLE `admin_token` (
  `token_id` bigint(20) NOT NULL,
  `admin_user_id` bigint(20) NOT NULL,
  `token` varchar(80) NOT NULL,
  `timemodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `child_wish_customers`
--

CREATE TABLE `child_wish_customers` (
  `customers_id` int(11) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `child_wish_donation`
--

CREATE TABLE `child_wish_donation` (
  `donation_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `razer_orders_id` varchar(200) DEFAULT NULL,
  `razer_payment_id` varchar(200) DEFAULT NULL,
  `currency` varchar(10) NOT NULL,
  `amount` float(15,4) NOT NULL DEFAULT 0.0000,
  `status` varchar(10) NOT NULL,
  `captured` int(1) NOT NULL DEFAULT 0,
  `card_id` varchar(50) NOT NULL,
  `method` varchar(20) NOT NULL,
  `amount_refunded` float(15,4) DEFAULT 0.0000,
  `refund_status` varchar(10) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `wallet` varchar(100) NOT NULL,
  `vpa` varchar(100) NOT NULL,
  `international` varchar(50) NOT NULL,
  `fee` float(15,4) NOT NULL DEFAULT 0.0000,
  `tax` float(15,4) NOT NULL DEFAULT 0.0000,
  `entity` varchar(50) DEFAULT NULL,
  `payement_date` datetime NOT NULL,
  `order_creation_date` datetime NOT NULL,
  `projects_id` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donation_projects`
--

CREATE TABLE `donation_projects` (
  `projects_id` int(11) NOT NULL,
  `projects_title` varchar(100) DEFAULT NULL,
  `projects_description` text DEFAULT NULL,
  `projects_image` varchar(100) DEFAULT NULL,
  `target_amount` float(15,4) NOT NULL DEFAULT 0.0000,
  `received_amount` float(15,4) NOT NULL DEFAULT 0.0000,
  `amount_start_date` datetime NOT NULL,
  `amount_end_date` datetime NOT NULL,
  `urgent_need` int(1) NOT NULL DEFAULT 0 COMMENT '1= yes',
  `projects_status` int(1) NOT NULL COMMENT '1 = active , 0 = deactive',
  `projects_owner` int(11) NOT NULL COMMENT 'id of owner of project person',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'admin id of creater'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donation_projects_comments`
--

CREATE TABLE `donation_projects_comments` (
  `comment_id` int(11) NOT NULL,
  `projetcts_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_user_name` varchar(50) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_reply` int(1) NOT NULL DEFAULT 0,
  `reply_on` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donation_projects_images`
--

CREATE TABLE `donation_projects_images` (
  `image_id` int(11) NOT NULL,
  `projects_id` int(11) NOT NULL,
  `image_name` varchar(200) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donation_projects_medical_documents`
--

CREATE TABLE `donation_projects_medical_documents` (
  `document_id` int(11) NOT NULL,
  `document_title` varchar(50) NOT NULL,
  `document` varchar(100) DEFAULT NULL,
  `activate` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donor_testimonials`
--

CREATE TABLE `donor_testimonials` (
  `id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `author` varchar(20) DEFAULT NULL,
  `author_image` varchar(50) DEFAULT NULL,
  `author_address` varchar(100) DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_user_id`);

--
-- Indexes for table `admin_token`
--
ALTER TABLE `admin_token`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `child_wish_customers`
--
ALTER TABLE `child_wish_customers`
  ADD PRIMARY KEY (`customers_id`);

--
-- Indexes for table `child_wish_donation`
--
ALTER TABLE `child_wish_donation`
  ADD PRIMARY KEY (`donation_id`);

--
-- Indexes for table `donation_projects`
--
ALTER TABLE `donation_projects`
  ADD PRIMARY KEY (`projects_id`);

--
-- Indexes for table `donation_projects_comments`
--
ALTER TABLE `donation_projects_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `donation_projects_images`
--
ALTER TABLE `donation_projects_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `donation_projects_medical_documents`
--
ALTER TABLE `donation_projects_medical_documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `donor_testimonials`
--
ALTER TABLE `donor_testimonials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin_token`
--
ALTER TABLE `admin_token`
  MODIFY `token_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `child_wish_customers`
--
ALTER TABLE `child_wish_customers`
  MODIFY `customers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `child_wish_donation`
--
ALTER TABLE `child_wish_donation`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `donation_projects`
--
ALTER TABLE `donation_projects`
  MODIFY `projects_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donation_projects_comments`
--
ALTER TABLE `donation_projects_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donation_projects_images`
--
ALTER TABLE `donation_projects_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donation_projects_medical_documents`
--
ALTER TABLE `donation_projects_medical_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donor_testimonials`
--
ALTER TABLE `donor_testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
