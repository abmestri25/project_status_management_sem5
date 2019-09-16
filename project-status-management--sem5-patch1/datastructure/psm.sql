-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 14, 2019 at 07:23 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psm`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `checked_status` tinyint(1) NOT NULL DEFAULT 0,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `report_id`, `to_user_id`, `from_user_id`, `message`, `checked_status`, `creation_date`) VALUES
(1, 1, 8, 1, 'You have a new Report', 0, '2019-09-13 16:47:09'),
(2, 2, 8, 2, 'You have new Report', 0, '2019-09-13 16:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` text NOT NULL,
  `leader_id` int(11) NOT NULL,
  `hod_id` int(11) NOT NULL,
  `guide_id` int(11) NOT NULL,
  `pc_id` int(11) NOT NULL,
  `project_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `leader_id`, `hod_id`, `guide_id`, `pc_id`, `project_status`) VALUES
(6, 'Project-1', 1, 7, 8, 9, 0),
(7, 'Project-2', 2, 7, 8, 9, 0),
(8, 'Project-3', 4, 7, 8, 9, 0),
(9, 'Project-4', 6, 7, 8, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(111) NOT NULL,
  `project_id` int(11) NOT NULL,
  `report_title` text NOT NULL,
  `report_content` text NOT NULL,
  `project_status` int(101) NOT NULL,
  `guide_status` varchar(11) NOT NULL DEFAULT 'pending',
  `hod_status` varchar(11) NOT NULL DEFAULT '---',
  `pc_status` varchar(11) NOT NULL DEFAULT '---',
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `project_id`, `report_title`, `report_content`, `project_status`, `guide_status`, `hod_status`, `pc_status`, `creation_date`) VALUES
(1, 6, 'Completed the backend.', 'The backend of the project has been completed. The the login page redirects to the homepage successfully after authentication. All the links on the homepage works as they are supposed to', 20, 'pending', '---', '---', '2019-09-13 14:34:16'),
(2, 7, 'FrontEnd completion', 'The Frontend of the project has been completed. The the login page redirects to the homepage successfully after authentication. All the links on the homepage works as they are supposed to', 10, 'pending', '---', '---', '2019-09-13 15:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `first_login` tinyint(1) NOT NULL DEFAULT 1,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `m_name`, `l_name`, `username`, `email`, `password_hash`, `dob`, `first_login`, `creation_date`, `position`) VALUES
(1, '', '', '', 'leader1', 'leader1@gmail.com', '000', '2019-09-13', 1, '2019-09-13 12:35:28', 'leader'),
(2, '', '', '', 'leader2', 'leader2@gmail.com', '000', '2019-09-13', 1, '2019-09-13 12:36:17', 'leader'),
(4, '', '', '', 'leader4', 'leader3@gmail.com', '000', '2019-09-13', 1, '2019-09-13 12:37:16', 'leader'),
(6, '', '', '', 'leader4', 'leader4@gmail.com', '000', '2019-09-13', 1, '2019-09-13 12:37:44', 'leader'),
(7, '', '', '', 'headoofdepartment', 'hod@gmail.com', '000', '2019-09-13', 1, '2019-09-13 12:38:01', 'hod'),
(8, '', '', '', 'imguide', 'guide@gmail.com', '000', '2019-09-13', 1, '2019-09-13 12:38:19', 'guide'),
(9, '', '', '', 'projectcoordinator', 'pc@gmail.com', '000', '2019-09-13', 1, '2019-09-13 12:39:08', 'pc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
