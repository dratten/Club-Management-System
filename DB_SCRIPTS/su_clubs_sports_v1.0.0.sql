-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2017 at 08:17 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `su_clubs_sports`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `staffID` int(10) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `suEmail` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `roleID` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(200) NOT NULL,
  `dateRegistered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adminroles`
--

CREATE TABLE `adminroles` (
  `roleID` int(5) NOT NULL,
  `roleName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clubmembers`
--

CREATE TABLE `clubmembers` (
  `pID` int(20) NOT NULL,
  `suID` int(10) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `suEmail` varchar(100) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `courseID` varchar(10) NOT NULL,
  `telNo` varchar(30) NOT NULL,
  `dateRegistered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `payment` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deletionStatus` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(200) NOT NULL,
  `leadership` tinyint(1) NOT NULL DEFAULT '0',
  `roleID` int(5) DEFAULT NULL,
  `nominated` tinyint(5) NOT NULL DEFAULT '0',
  `membership` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clubofficials`
--

CREATE TABLE `clubofficials` (
  `autoID` int(20) NOT NULL,
  `studentID` int(10) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clubroles`
--

CREATE TABLE `clubroles` (
  `roleID` int(5) NOT NULL,
  `roleName` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `clubID` varchar(150) NOT NULL,
  `clubName` varchar(100) NOT NULL,
  `yearStarted` int(10) DEFAULT NULL,
  `yearRebranded` int(10) DEFAULT NULL,
  `registrationFee` decimal(10,0) NOT NULL DEFAULT '0',
  `registrationBasis` varchar(20) NOT NULL DEFAULT 'Per Year',
  `dateRegistered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `club_constitutions`
--

CREATE TABLE `club_constitutions` (
  `autoID` int(10) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `full_path` varchar(150) NOT NULL,
  `file_ext` varchar(10) NOT NULL,
  `dateUploaded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `versionNo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `club_expenditures`
--

CREATE TABLE `club_expenditures` (
  `autoID` int(10) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `dateSpent` date NOT NULL,
  `unitName` varchar(100) NOT NULL,
  `amountEach` decimal(10,2) NOT NULL,
  `unitsCount` int(10) NOT NULL,
  `description` varchar(200) NOT NULL,
  `studentPID` int(10) NOT NULL,
  `dateRecorded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `club_histories`
--

CREATE TABLE `club_histories` (
  `autoID` int(10) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `full_path` varchar(150) NOT NULL,
  `file_ext` varchar(10) NOT NULL,
  `dateUploaded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `versionNo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `club_minutes`
--

CREATE TABLE `club_minutes` (
  `autoID` int(10) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `meetingID` int(10) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `full_path` varchar(150) NOT NULL,
  `file_ext` varchar(10) NOT NULL,
  `dateUploaded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseID` varchar(20) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventattendance`
--

CREATE TABLE `eventattendance` (
  `autoID` int(20) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `studentID` int(10) NOT NULL,
  `pID` int(10) NOT NULL,
  `eventID` int(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `inattendance` tinyint(1) NOT NULL DEFAULT '0',
  `dateRecorded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventinfo`
--

CREATE TABLE `eventinfo` (
  `autoID` int(10) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `eventDate` date NOT NULL,
  `eventVenue` varchar(100) NOT NULL,
  `startTime` time NOT NULL,
  `description` varchar(100) NOT NULL,
  `endTime` time NOT NULL,
  `dateRecorded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_reports`
--

CREATE TABLE `event_reports` (
  `autoID` int(10) NOT NULL,
  `eventID` int(10) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `full_path` varchar(150) NOT NULL,
  `dateUploaded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `clubID` varchar(100) NOT NULL,
  `file_ext` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


--
-- Table structure for table `meetingattendance`
--

CREATE TABLE `meetingattendance` (
  `autoID` int(20) NOT NULL,
  `pID` int(10) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `studentID` int(10) NOT NULL,
  `meetingID` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `dateRecorded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meetinginfo`
--

CREATE TABLE `meetinginfo` (
  `autoID` int(10) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `takingMinutes` int(10) NOT NULL,
  `meetingDate` date NOT NULL,
  `meetingVenue` varchar(100) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `dateRecorded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `officialsroles`
--

CREATE TABLE `officialsroles` (
  `autoID` int(10) NOT NULL,
  `clubID` varchar(100) NOT NULL,
  `pID` int(10) NOT NULL,
  `studentID` int(10) NOT NULL,
  `roleID` int(5) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `dateRegistered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`staffID`),
  ADD UNIQUE KEY `suEmail` (`suEmail`),
  ADD UNIQUE KEY `telNo` (`phone`),
  ADD KEY `roleID` (`roleID`);

--
-- Indexes for table `adminroles`
--
ALTER TABLE `adminroles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `clubmembers`
--
ALTER TABLE `clubmembers`
  ADD PRIMARY KEY (`pID`),
  ADD KEY `clubID` (`clubID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `clubofficials`
--
ALTER TABLE `clubofficials`
  ADD PRIMARY KEY (`autoID`),
  ADD UNIQUE KEY `studentID` (`studentID`);

--
-- Indexes for table `clubroles`
--
ALTER TABLE `clubroles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`clubID`);

--
-- Indexes for table `club_constitutions`
--
ALTER TABLE `club_constitutions`
  ADD PRIMARY KEY (`autoID`),
  ADD UNIQUE KEY `full_path` (`full_path`),
  ADD KEY `clubID` (`clubID`);

--
-- Indexes for table `club_expenditures`
--
ALTER TABLE `club_expenditures`
  ADD PRIMARY KEY (`autoID`),
  ADD KEY `studentPID` (`studentPID`),
  ADD KEY `clubID` (`clubID`);

--
-- Indexes for table `club_histories`
--
ALTER TABLE `club_histories`
  ADD PRIMARY KEY (`autoID`),
  ADD UNIQUE KEY `full_path` (`full_path`),
  ADD KEY `clubID` (`clubID`);

--
-- Indexes for table `club_minutes`
--
ALTER TABLE `club_minutes`
  ADD PRIMARY KEY (`autoID`),
  ADD UNIQUE KEY `full_path` (`full_path`),
  ADD KEY `clubID` (`clubID`),
  ADD KEY `meetingID` (`meetingID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseID`),
  ADD UNIQUE KEY `courseName` (`courseName`);

--
-- Indexes for table `eventattendance`
--
ALTER TABLE `eventattendance`
  ADD PRIMARY KEY (`autoID`),
  ADD KEY `eventID` (`eventID`),
  ADD KEY `clubID` (`clubID`),
  ADD KEY `pID` (`pID`);

--
-- Indexes for table `eventinfo`
--
ALTER TABLE `eventinfo`
  ADD PRIMARY KEY (`autoID`),
  ADD KEY `clubID` (`clubID`);

--
-- Indexes for table `event_reports`
--
ALTER TABLE `event_reports`
  ADD PRIMARY KEY (`autoID`),
  ADD UNIQUE KEY `eventID` (`eventID`),
  ADD UNIQUE KEY `full_path` (`full_path`),
  ADD KEY `clubID` (`clubID`);

--
-- Indexes for table `meetingattendance`
--
ALTER TABLE `meetingattendance`
  ADD PRIMARY KEY (`autoID`),
  ADD KEY `meetingID` (`meetingID`),
  ADD KEY `clubID` (`clubID`),
  ADD KEY `pID` (`pID`);

--
-- Indexes for table `meetinginfo`
--
ALTER TABLE `meetinginfo`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `officialsroles`
--
ALTER TABLE `officialsroles`
  ADD PRIMARY KEY (`autoID`),
  ADD KEY `roleID` (`roleID`),
  ADD KEY `pID` (`pID`),
  ADD KEY `studentID` (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clubmembers`
--
ALTER TABLE `clubmembers`
  MODIFY `pID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `clubofficials`
--
ALTER TABLE `clubofficials`
  MODIFY `autoID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clubroles`
--
ALTER TABLE `clubroles`
  MODIFY `roleID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `club_constitutions`
--
ALTER TABLE `club_constitutions`
  MODIFY `autoID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `club_expenditures`
--
ALTER TABLE `club_expenditures`
  MODIFY `autoID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `club_histories`
--
ALTER TABLE `club_histories`
  MODIFY `autoID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `club_minutes`
--
ALTER TABLE `club_minutes`
  MODIFY `autoID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `eventattendance`
--
ALTER TABLE `eventattendance`
  MODIFY `autoID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `eventinfo`
--
ALTER TABLE `eventinfo`
  MODIFY `autoID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `event_reports`
--
ALTER TABLE `event_reports`
  MODIFY `autoID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `meetingattendance`
--
ALTER TABLE `meetingattendance`
  MODIFY `autoID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `meetinginfo`
--
ALTER TABLE `meetinginfo`
  MODIFY `autoID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `officialsroles`
--
ALTER TABLE `officialsroles`
  MODIFY `autoID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `adminroles` (`roleID`);

--
-- Constraints for table `clubmembers`
--
ALTER TABLE `clubmembers`
  ADD CONSTRAINT `clubmembers_ibfk_1` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`),
  ADD CONSTRAINT `clubmembers_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`);

--
-- Constraints for table `club_constitutions`
--
ALTER TABLE `club_constitutions`
  ADD CONSTRAINT `club_constitutions_ibfk_1` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`);

--
-- Constraints for table `club_expenditures`
--
ALTER TABLE `club_expenditures`
  ADD CONSTRAINT `club_expenditures_ibfk_1` FOREIGN KEY (`studentPID`) REFERENCES `clubmembers` (`pID`),
  ADD CONSTRAINT `club_expenditures_ibfk_2` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`),
  ADD CONSTRAINT `club_expenditures_ibfk_3` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`);

--
-- Constraints for table `club_histories`
--
ALTER TABLE `club_histories`
  ADD CONSTRAINT `club_histories_ibfk_1` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`);

--
-- Constraints for table `club_minutes`
--
ALTER TABLE `club_minutes`
  ADD CONSTRAINT `club_minutes_ibfk_1` FOREIGN KEY (`meetingID`) REFERENCES `meetinginfo` (`autoID`),
  ADD CONSTRAINT `club_minutes_ibfk_2` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`),
  ADD CONSTRAINT `club_minutes_ibfk_3` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`),
  ADD CONSTRAINT `club_minutes_ibfk_4` FOREIGN KEY (`meetingID`) REFERENCES `meetinginfo` (`autoID`);

--
-- Constraints for table `eventattendance`
--
ALTER TABLE `eventattendance`
  ADD CONSTRAINT `eventattendance_ibfk_1` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`),
  ADD CONSTRAINT `eventattendance_ibfk_2` FOREIGN KEY (`eventID`) REFERENCES `eventinfo` (`autoID`),
  ADD CONSTRAINT `eventattendance_ibfk_3` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`),
  ADD CONSTRAINT `eventattendance_ibfk_4` FOREIGN KEY (`eventID`) REFERENCES `eventinfo` (`autoID`),
  ADD CONSTRAINT `eventattendance_ibfk_5` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`),
  ADD CONSTRAINT `eventattendance_ibfk_6` FOREIGN KEY (`pID`) REFERENCES `clubmembers` (`pID`);

--
-- Constraints for table `eventinfo`
--
ALTER TABLE `eventinfo`
  ADD CONSTRAINT `eventinfo_ibfk_1` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`);

--
-- Constraints for table `event_reports`
--
ALTER TABLE `event_reports`
  ADD CONSTRAINT `event_reports_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `eventinfo` (`autoID`),
  ADD CONSTRAINT `event_reports_ibfk_2` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`),
  ADD CONSTRAINT `event_reports_ibfk_3` FOREIGN KEY (`eventID`) REFERENCES `eventinfo` (`autoID`),
  ADD CONSTRAINT `event_reports_ibfk_4` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`);

--
-- Constraints for table `meetingattendance`
--
ALTER TABLE `meetingattendance`
  ADD CONSTRAINT `meetingattendance_ibfk_1` FOREIGN KEY (`meetingID`) REFERENCES `meetinginfo` (`autoID`),
  ADD CONSTRAINT `meetingattendance_ibfk_2` FOREIGN KEY (`meetingID`) REFERENCES `meetinginfo` (`autoID`),
  ADD CONSTRAINT `meetingattendance_ibfk_3` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`),
  ADD CONSTRAINT `meetingattendance_ibfk_4` FOREIGN KEY (`clubID`) REFERENCES `clubs` (`clubID`),
  ADD CONSTRAINT `meetingattendance_ibfk_5` FOREIGN KEY (`pID`) REFERENCES `clubmembers` (`pID`);

--
-- Constraints for table `officialsroles`
--
ALTER TABLE `officialsroles`
  ADD CONSTRAINT `officialsroles_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `clubroles` (`roleID`),
  ADD CONSTRAINT `officialsroles_ibfk_2` FOREIGN KEY (`pID`) REFERENCES `clubmembers` (`pID`),
  ADD CONSTRAINT `officialsroles_ibfk_3` FOREIGN KEY (`studentID`) REFERENCES `clubofficials` (`studentID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
