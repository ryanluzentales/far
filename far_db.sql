-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 11:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `far_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2022-10-23 16:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `room_id` int(60) DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `room_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(1, 2, 'real time', 3, 'dwasdwa', 1668636383),
(2, 3, 'real time', 5, 'tertsetqwq', 1668636409),
(3, 2, 'real time', 5, 'jginovjnjvewdawd', 1668637009),
(4, 2, 'real time', 4, 'dw13124', 1668637110);

-- --------------------------------------------------------

--
-- Table structure for table `tblapartments`
--

CREATE TABLE `tblapartments` (
  `id` int(11) NOT NULL,
  `BookingNumber` bigint(12) DEFAULT NULL,
  `OwnerName` varchar(150) NOT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `VehicleId` int(11) DEFAULT NULL,
  `FromDate` varchar(255) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `ContactNumber` bigint(150) DEFAULT NULL,
  `HousingType` varchar(150) NOT NULL,
  `ApartmentImage` varchar(150) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `Payment` varchar(110) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblapartments`
--

INSERT INTO `tblapartments` (`id`, `BookingNumber`, `OwnerName`, `userEmail`, `VehicleId`, `FromDate`, `ToDate`, `message`, `ContactNumber`, `HousingType`, `ApartmentImage`, `gender`, `Payment`, `Status`, `PostingDate`, `LastUpdationDate`) VALUES
(1, 989918954, 'ryan luzentales', 'ryanluzentales@gmail.com', 989918954, 'RYAN APARTMENT', 'MANDAUE CITY CEBU', 'CEBU DOC', 2147483647, '', '', 'Female', 'id.jpg', 0, '2022-11-03 10:15:10', '2022-11-16 15:07:39'),
(11, 904555573, 'bogart home', 'bogart@gmail.com', 904555573, 'BOGART APARTMENT', 'MANDAUE VCITY', 'SWU', 616513123, 'Apartment', '', 'Female', '', 1, '2022-11-16 18:32:07', '2022-11-16 18:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL,
  `BookingNumber` bigint(12) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `VehicleId` int(11) DEFAULT NULL,
  `FromDate` varchar(20) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblowner`
--

CREATE TABLE `tblowner` (
  `userID` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblowner`
--

INSERT INTO `tblowner` (`userID`, `FullName`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`, `City`, `Country`, `RegDate`, `UpdationDate`) VALUES
(1, 'ryan luzentales', 'ryanluzentales@gmail.com', '935e57d181ef47e64318a161aabfa9d8', '0303030303', NULL, NULL, NULL, NULL, '2022-11-03 10:00:45', NULL),
(2, 'bogart home', 'bogart@gmail.com', '3e50cae9be9be5c27943469cf1151723', '05164560231', NULL, NULL, NULL, NULL, '2022-11-16 18:29:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblrooms`
--

CREATE TABLE `tblrooms` (
  `id` int(11) NOT NULL,
  `RoomName` varchar(99) DEFAULT NULL,
  `VehiclesTitle` varchar(150) DEFAULT NULL,
  `VehiclesBrand` int(11) DEFAULT NULL,
  `VehiclesOverview` longtext DEFAULT NULL,
  `Address` varchar(255) NOT NULL,
  `PricePerDay` int(11) DEFAULT NULL,
  `FuelType` varchar(100) DEFAULT NULL,
  `ModelYear` int(6) DEFAULT NULL,
  `SeatingCapacity` int(11) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `AirConditioner` int(11) DEFAULT NULL,
  `PowerDoorLocks` int(11) DEFAULT NULL,
  `AntiLockBrakingSystem` int(11) DEFAULT NULL,
  `BrakeAssist` int(11) DEFAULT NULL,
  `PowerSteering` int(11) DEFAULT NULL,
  `DriverAirbag` int(11) DEFAULT NULL,
  `PassengerAirbag` int(11) DEFAULT NULL,
  `PowerWindows` int(11) DEFAULT NULL,
  `CDPlayer` int(11) DEFAULT NULL,
  `CentralLocking` int(11) DEFAULT NULL,
  `CrashSensor` int(11) DEFAULT NULL,
  `LeatherSeats` int(11) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrooms`
--

INSERT INTO `tblrooms` (`id`, `RoomName`, `VehiclesTitle`, `VehiclesBrand`, `VehiclesOverview`, `Address`, `PricePerDay`, `FuelType`, `ModelYear`, `SeatingCapacity`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `AirConditioner`, `PowerDoorLocks`, `AntiLockBrakingSystem`, `BrakeAssist`, `PowerSteering`, `DriverAirbag`, `PassengerAirbag`, `PowerWindows`, `CDPlayer`, `CentralLocking`, `CrashSensor`, `LeatherSeats`, `RegDate`, `UpdationDate`) VALUES
(2, 'ROOM 5', 'UC', 1, 'SHDIBAWIHDFBAHSFAWFS', 'MANDAUE CITY CEBU', 5000, 'Shared Bath', 0, 7, 'florian-schmidinger-b_79nOqf95I-unsplash.jpg', 'florian-schmidinger-b_79nOqf95I-unsplash.jpg', 'florian-schmidinger-b_79nOqf95I-unsplash.jpg', 'florian-schmidinger-b_79nOqf95I-unsplash.jpg', 'florian-schmidinger-b_79nOqf95I-unsplash.jpg', NULL, 1, NULL, NULL, NULL, 1, 1, NULL, NULL, 1, 1, NULL, '2022-11-10 04:38:27', '2022-11-13 16:05:45'),
(3, 'ROOM 2', 'swu', 1, 'JHBCIUAWHBUIDHIA', 'MANDAUE CITY CEBU', 8000, 'Shared Bath', 0, 9, 'digital-marketing-agency-ntwrk-g39p1kDjvSY-unsplash.jpg', 'digital-marketing-agency-ntwrk-g39p1kDjvSY-unsplash.jpg', 'digital-marketing-agency-ntwrk-g39p1kDjvSY-unsplash.jpg', 'digital-marketing-agency-ntwrk-g39p1kDjvSY-unsplash.jpg', 'digital-marketing-agency-ntwrk-g39p1kDjvSY-unsplash.jpg', NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, '2022-11-10 04:54:01', '2022-11-10 14:24:03'),
(5, 'ROOM 10', 'SWU', 11, 'KNIUNDVINIVBNI', 'MANDAUE VCITY', 6000, 'Private Bath', 0, 4, 'Untitled.png', 'Untitled.png', 'Untitled.png', 'Untitled.png', '', NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2022-11-16 18:34:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`, `City`, `Country`, `RegDate`, `UpdationDate`) VALUES
(1, 'real time', 'realtimenumber1@gmail.com', '45658196f18a49f63efd96abca23ebe7', '3059512230', NULL, NULL, NULL, NULL, '2022-11-03 10:29:32', NULL),
(2, 'usethishost', 'usethishost@gmail.com', '51a596f7ba0b702f951a94504213bcc1', '09456456412', NULL, NULL, NULL, NULL, '2022-11-11 05:46:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `comment_sender_name` varchar(200) NOT NULL,
  `comment_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `id` int(11) NOT NULL,
  `BookingNumber` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`id`, `BookingNumber`) VALUES
(1, 555469947),
(2, 809752294),
(3, 176108717),
(4, 454451244),
(5, 224877904),
(6, 628640532),
(7, 818155208),
(8, 742059073),
(9, 831051146),
(10, 726699796),
(11, 989963335),
(12, 272080903),
(13, 577094669),
(14, 474884080),
(15, 864295283),
(16, 253175115),
(17, 981084921),
(18, 256483199),
(19, 481540815),
(20, 394949893),
(21, 147577056),
(22, 943799368),
(23, 985019770),
(24, 564063667),
(25, 719377867),
(26, 439877995),
(27, 602978784),
(28, 214103434),
(29, 905088948),
(30, 887573013),
(31, 972074145),
(32, 341176102),
(33, 224176068),
(34, 975551779),
(35, 593479731),
(36, 989918954),
(37, 836938931),
(38, 617248693),
(39, 824484441),
(40, 681201600),
(41, 435526418),
(42, 546053424),
(43, 482997666),
(44, 943640132),
(45, 604053055),
(46, 904555573);

-- --------------------------------------------------------

--
-- Table structure for table `verify_comment`
--

CREATE TABLE `verify_comment` (
  `verify_comment_id` int(11) NOT NULL,
  `room_id` int(50) NOT NULL,
  `vhid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verify_comment`
--

INSERT INTO `verify_comment` (`verify_comment_id`, `room_id`, `vhid`) VALUES
(1, 2, 2),
(2, 3, 3),
(3, 2, 2),
(4, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tblapartments`
--
ALTER TABLE `tblapartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblowner`
--
ALTER TABLE `tblowner`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `EmailId` (`EmailId`);

--
-- Indexes for table `tblrooms`
--
ALTER TABLE `tblrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_comment`
--
ALTER TABLE `verify_comment`
  ADD PRIMARY KEY (`verify_comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblapartments`
--
ALTER TABLE `tblapartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblowner`
--
ALTER TABLE `tblowner`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblrooms`
--
ALTER TABLE `tblrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `verify_comment`
--
ALTER TABLE `verify_comment`
  MODIFY `verify_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
