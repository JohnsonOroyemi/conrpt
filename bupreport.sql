-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2022 at 06:22 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bupreport`
--

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `materials` varchar(200) DEFAULT NULL,
  `PostedBy` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `material_inventory`
--

CREATE TABLE `material_inventory` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `stock` float NOT NULL,
  `used` float NOT NULL,
  `balance` float NOT NULL,
  `purpose` varchar(225) NOT NULL,
  `date` date NOT NULL,
  `PostedBy` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `material_received`
--

CREATE TABLE `material_received` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `source` varchar(225) NOT NULL,
  `file` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `PostedBy` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `other_report_details`
--

CREATE TABLE `other_report_details` (
  `id` int(11) NOT NULL,
  `weather` varchar(225) NOT NULL,
  `stageofwork` varchar(225) NOT NULL,
  `reportno` float NOT NULL,
  `week` float NOT NULL,
  `daynr` float NOT NULL,
  `date` date NOT NULL,
  `accident` varchar(225) NOT NULL,
  `visitors` varchar(225) NOT NULL,
  `attendance` varchar(225) NOT NULL,
  `matlsneeded` varchar(225) NOT NULL,
  `projectedact` varchar(225) NOT NULL,
  `PostedBy` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proj_info`
--

CREATE TABLE `proj_info` (
  `id` int(11) NOT NULL,
  `client` varchar(225) NOT NULL,
  `location` varchar(225) NOT NULL,
  `pm` varchar(225) NOT NULL,
  `arc` varchar(225) NOT NULL,
  `seng` varchar(225) NOT NULL,
  `mep` varchar(225) NOT NULL,
  `qs` varchar(225) NOT NULL,
  `PostedBy` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `projectName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `datecreated` varchar(10) NOT NULL,
  `code` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `work_accomplished`
--

CREATE TABLE `work_accomplished` (
  `id` int(11) NOT NULL,
  `work_activities_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `previous` varchar(255) NOT NULL,
  `actual` varchar(225) NOT NULL,
  `challenges` mediumtext NOT NULL,
  `date` date NOT NULL,
  `PostedBy` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `work_activities`
--

CREATE TABLE `work_activities` (
  `id` int(11) NOT NULL,
  `work_activities` varchar(255) NOT NULL,
  `PostedBy` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Indexes for dumped tables
--

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PostedBy` (`PostedBy`);

--
-- Indexes for table `material_inventory`
--
ALTER TABLE `material_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `PostedBy` (`PostedBy`);

--
-- Indexes for table `material_received`
--
ALTER TABLE `material_received`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `PostedBy` (`PostedBy`);

--
-- Indexes for table `other_report_details`
--
ALTER TABLE `other_report_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PostedBy` (`PostedBy`);

--
-- Indexes for table `proj_info`
--
ALTER TABLE `proj_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PostedBy` (`PostedBy`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `work_accomplished`
--
ALTER TABLE `work_accomplished`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_activities_id` (`work_activities_id`),
  ADD KEY `PostedBy` (`PostedBy`);

--
-- Indexes for table `work_activities`
--
ALTER TABLE `work_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PostedBy` (`PostedBy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `material_inventory`
--
ALTER TABLE `material_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `material_received`
--
ALTER TABLE `material_received`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `other_report_details`
--
ALTER TABLE `other_report_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `proj_info`
--
ALTER TABLE `proj_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `work_accomplished`
--
ALTER TABLE `work_accomplished`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `work_activities`
--
ALTER TABLE `work_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
