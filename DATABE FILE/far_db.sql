-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 01:26 AM
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
(18, 'admin', 'Roberto', 'Urgello', '09208264854', 'f5bb0c8de146c67b44babbf4e6584cc0', '2022-12-01 08:59:09');

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
(2, 'qrcode.jpg');

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
(1, 961629175, 'Roberto Sy Jr', 'jrobertosy@gmail.com', 'Don\'s Apartment', '8V2V+R76, J. Urgello St, Cebu City, Cebu, Philippines', 'SWU', 'd2.JPG', 'd2.JPG', '123123123', '1 month deposit 1 month advance', 9208264854, 'Apartment', 'd1.JPG', 'Mixed', 'receipt.png', 1, '2022-12-01 09:09:29', '2022-12-01 09:10:25'),
(2, 807610884, 'Roberto Sy Jr', 'jrobertosy@gmail.com', 'Sofia\'s Apartment', '8WHJ+F65, Tipolo, Mandaue City, Cebu, Philippines', 'SWU', 'r2.JPG', 'r1.JPG', '123456', '1 month deposit 1 month advance', 9208264854, 'Dormitory', 'r2.JPG', 'Female', 'receipt.png', 2, '2022-12-01 09:21:25', '2022-12-01 09:22:01');

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
(3, 958177990, 'donreyes@gmail.com', '123123', '', 1, 4, '2022-12-09', '2022-12-01', NULL, 'I wanna know more about this room', 1, '2022-12-01 09:12:44', '2022-12-01 09:17:01');

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
(2, 'Roberto Sy Jr', 'jrobertosy@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '09208264854', NULL, NULL, NULL, NULL, '2022-12-01 09:00:12', NULL);

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
  `Roomstatus` varchar(11) DEFAULT NULL,
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
(3, 'Deluxe 1', 'SWU', ' 1', 'This room is great', '8V2V+R76, J. Urgello St, Cebu City, Cebu, Philippines', NULL, 3000, 'Private Bath', 'Apartment', 3, 'd1.JPG', 'd2.JPG', 'd3.JPG', 'd1.JPG', '', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-12-01 09:11:15', NULL),
(4, 'Deluxe 2', 'SWU', '1', 'Great room', '8V2V+R76, J. Urgello St, Cebu City, Cebu, Philippines', NULL, 5000, '0', 'Apartment', 2, 'r2.JPG', 'r1.JPG', 'r2.JPG', 'r1.JPG', '', NULL, 1, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-01 09:12:18', '2022-12-01 09:18:30');

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
(1, 'Don Reyes', 'donreyes@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '09208264854', NULL, NULL, NULL, NULL, '2022-12-01 09:00:39', NULL);

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
(1, 961629175),
(2, 807610884);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblowner`
--
ALTER TABLE `tblowner`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblrooms`
--
ALTER TABLE `tblrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
