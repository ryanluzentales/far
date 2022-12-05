-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 04:51 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
  `Fullname` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Contactnumber` varchar(255) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Fullname`, `Address`, `Contactnumber`, `Password`, `updationDate`) VALUES
(19, 'admin', 'ryan luzentales', 'tabok mandaue city', '09750987323', '21232f297a57a5a743894a0e4a801fc3', '2022-12-05 03:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `changepayment`
--

CREATE TABLE `changepayment` (
  `id` int(11) NOT NULL,
  `qr` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `changepayment`
--

INSERT INTO `changepayment` (`id`, `qr`) VALUES
(1, 'qrcode.jpg');

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

-- --------------------------------------------------------

--
-- Table structure for table `tblapartments`
--

CREATE TABLE `tblapartments` (
  `id` int(11) NOT NULL,
  `BookingNumber` bigint(12) DEFAULT NULL,
  `OwnerName` varchar(150) NOT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `Apartmentname` varchar(255) DEFAULT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `Landmark` varchar(255) DEFAULT NULL,
  `Governmentid` varchar(255) NOT NULL,
  `Businesspermit` varchar(150) NOT NULL,
  `Referencenumber` varchar(150) NOT NULL,
  `Termsofpayment` varchar(150) NOT NULL,
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

INSERT INTO `tblapartments` (`id`, `BookingNumber`, `OwnerName`, `userEmail`, `Apartmentname`, `Address`, `Landmark`, `Governmentid`, `Businesspermit`, `Referencenumber`, `Termsofpayment`, `ContactNumber`, `HousingType`, `ApartmentImage`, `gender`, `Payment`, `Status`, `PostingDate`, `LastUpdationDate`) VALUES
(1, 304134621, 'roberto sy', 'jrobertosy@gmail.com', 'ROBERTO\'s APARTMENT', '7XVM+MQP, Fuentes Rd, Lapu-Lapu City, Cebu, Philippines', 'Abuno ', 'receipt.jpg', 'receipt.jpg', '03230222300', '1 month deposit 1 month advance', 9009090909, 'Dormitory', '1.jpg', 'Female', 'receipt.jpg', 1, '2022-12-05 03:10:34', '2022-12-05 03:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL,
  `BookingNumber` bigint(12) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `Referencenumber` varchar(150) NOT NULL,
  `Commissionimage` varchar(150) NOT NULL,
  `Commissionstatus` int(11) NOT NULL,
  `VehicleId` int(11) DEFAULT NULL,
  `Preferreddate` varchar(30) DEFAULT NULL,
  `FromDate` varchar(20) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `BookingNumber`, `userEmail`, `Referencenumber`, `Commissionimage`, `Commissionstatus`, `VehicleId`, `Preferreddate`, `FromDate`, `ToDate`, `message`, `Status`, `PostingDate`, `LastUpdationDate`) VALUES
(1, 416835857, 'donreyes@gmail.com', '', '', 1, 1, '2022-12-05', '2022-12-05', NULL, 'I want this room', 1, '2022-12-05 03:22:07', '2022-12-05 03:28:10');

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
(1, 'roberto sy', 'jrobertosy@gmail.com', '4297f44b13955235245b2497399d7a93', '09009090909', '', 'Cordova Lapu Lapu City', 'Lapu Lapu City', 'Philippines', '2022-12-05 03:06:15', '2022-12-05 03:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `tblrooms`
--

CREATE TABLE `tblrooms` (
  `id` int(11) NOT NULL,
  `RoomName` varchar(99) DEFAULT NULL,
  `Landmark` varchar(150) DEFAULT NULL,
  `Apartmentname` varchar(255) DEFAULT NULL,
  `Overview` longtext DEFAULT NULL,
  `Address` varchar(255) NOT NULL,
  `Roomstatus` varchar(11) DEFAULT '0',
  `PricePerDay` int(11) DEFAULT NULL,
  `BathType` varchar(100) DEFAULT NULL,
  `Housingtype` varchar(150) DEFAULT NULL,
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

INSERT INTO `tblrooms` (`id`, `RoomName`, `Landmark`, `Apartmentname`, `Overview`, `Address`, `Roomstatus`, `PricePerDay`, `BathType`, `Housingtype`, `SeatingCapacity`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `AirConditioner`, `PowerDoorLocks`, `AntiLockBrakingSystem`, `BrakeAssist`, `PowerSteering`, `DriverAirbag`, `PassengerAirbag`, `PowerWindows`, `CDPlayer`, `CentralLocking`, `CrashSensor`, `LeatherSeats`, `RegDate`, `UpdationDate`) VALUES
(1, 'ROOM 1', 'Abuno ', ' 1', 'Best room for students', '7XVM+MQP, Fuentes Rd, Lapu-Lapu City, Cebu, Philippines', '1', 2000, 'Private Bath', 'Dormitory', 2, '2.jpg', '1.jpg', '2.jpg', '2.jpg', '2.jpg', 1, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, '2022-12-05 03:13:14', '2022-12-05 03:35:50'),
(2, 'ROOM 2', 'Abuno ', ' 1', 'Best room for teachers.', '7XVM+MQP, Fuentes Rd, Lapu-Lapu City, Cebu, Philippines', '0', 4000, 'Shared Bath', 'Dormitory', 3, '3.jpg', '2.jpg', '1.jpg', '1.jpg', '2.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2022-12-05 03:25:17', '2022-12-05 03:35:19');

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
(1, 'Don Reyes', 'donreyes@gmail.com', '4297f44b13955235245b2497399d7a93', '90909090909', '', 'Tisa Cebu ', 'Cebu City', 'Philippines', '2022-12-05 03:06:47', '2022-12-05 03:29:24');

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
(1, 304134621);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `changepayment`
--
ALTER TABLE `changepayment`
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
ALTER TABLE `tblrooms` ADD FULLTEXT KEY `FULLTEXT INDEX` (`Address`,`RoomName`,`Landmark`,`Overview`,`Housingtype`,`Roomstatus`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `changepayment`
--
ALTER TABLE `changepayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblapartments`
--
ALTER TABLE `tblapartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblowner`
--
ALTER TABLE `tblowner`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblrooms`
--
ALTER TABLE `tblrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
