-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2022 at 04:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bus`
--

CREATE TABLE `tbl_bus` (
  `bus_id` int(11) NOT NULL,
  `plate_no` varchar(30) NOT NULL,
  `capacity` int(11) NOT NULL,
  `route` int(11) NOT NULL,
  `taken` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bus`
--

INSERT INTO `tbl_bus` (`bus_id`, `plate_no`, `capacity`, `route`, `taken`) VALUES
(1, '1234', 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user` int(11) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `comment`, `user`, `comment_date`) VALUES
(1, 'Hellow system is good', 15, '2022-03-23 09:03:41'),
(2, 'Your service is so far good', 15, '2022-03-25 17:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver`
--

CREATE TABLE `tbl_driver` (
  `driver_id` int(11) NOT NULL,
  `licence_no` varchar(50) NOT NULL,
  `bus` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_driver`
--

INSERT INTO `tbl_driver` (`driver_id`, `licence_no`, `bus`, `user`) VALUES
(1, '123432345j8', NULL, 17),
(3, 'hf64738hfj7r8', 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route`
--

CREATE TABLE `tbl_route` (
  `route_id` int(11) NOT NULL,
  `origin` varchar(60) NOT NULL,
  `destination` varchar(60) NOT NULL,
  `price` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_route`
--

INSERT INTO `tbl_route` (`route_id`, `origin`, `destination`, `price`, `active`) VALUES
(1, 'ubungo', 'kivukoni', 650, 1),
(2, 'kimara', 'mlimani', 650, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_station`
--

CREATE TABLE `tbl_station` (
  `station_id` int(11) NOT NULL,
  `station_name` varchar(70) NOT NULL,
  `route` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_station`
--

INSERT INTO `tbl_station` (`station_id`, `station_name`, `route`) VALUES
(1, 'manzese', 1),
(2, 'kibaha', 1),
(3, 'didi', 2),
(4, 'hihi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket`
--

CREATE TABLE `tbl_ticket` (
  `ticket_id` int(11) NOT NULL,
  `ticket_number` varchar(40) NOT NULL,
  `starting_station` varchar(60) NOT NULL,
  `ending_station` varchar(60) NOT NULL,
  `route` int(11) NOT NULL,
  `passanger` int(11) NOT NULL,
  `trip_date` date NOT NULL,
  `trip_time` time NOT NULL,
  `expire_time` time NOT NULL,
  `qrcode` varchar(200) NOT NULL DEFAULT 'saved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ticket`
--

INSERT INTO `tbl_ticket` (`ticket_id`, `ticket_number`, `starting_station`, `ending_station`, `route`, `passanger`, `trip_date`, `trip_time`, `expire_time`, `qrcode`) VALUES
(11, '8324829', 'manzese', 'kibaha', 1, 15, '2022-03-23', '17:43:00', '20:21:00', '005_file_e2c177fba000092c03893fc7d471129a.png'),
(12, '3741147', 'manzese', 'kibaha', 1, 15, '2022-03-23', '20:49:00', '22:49:00', '005_file_87c86f021a2f3667be1395b2827dbf66.png'),
(13, '3270156', 'manzese', 'kibaha', 1, 15, '2022-03-24', '08:59:00', '09:05:00', '005_file_a41fcc8fdba24aec59d3b0cbc864e0f4.png'),
(14, '4493020', 'manzese', 'kibaha', 1, 15, '2022-03-25', '08:59:00', '10:59:00', '005_file_0b828c63999af4fef5c537b988e55f07.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `sex` char(1) NOT NULL,
  `region` varchar(40) NOT NULL,
  `district` varchar(40) NOT NULL,
  `address` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `username` varchar(45) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `fname`, `lname`, `phone`, `sex`, `region`, `district`, `address`, `type`, `username`, `is_active`, `password`, `created_at`) VALUES
(1, 'mwakarundwa', 'GEORGE', 762506012, 'F', 'Mbeya', 'Mbeyaad', 'P.O.Box 972', 'manager', 'test', 1, '$2y$10$Hdf448zmL3MRBfqVixCrEe9qcH80pCKh7ItJ5Rhw5NtpDBlhO14SC', '2022-03-03 16:11:23'),
(15, 'mwakarundwa', 'GEORGE', 932506012, 'F', 'Mbeya', 'Mbeyaad', 'P.O.Box 972', 'passenger', 'gets', 1, '$2y$10$lo/jRGgSgpR7W9IbCeZUROw1xjn2KRqFf.lPYdzsJ07o9ofghOAmm', '2022-03-22 15:18:22'),
(17, 'mwakarundwa', 'GEORGE', 982506012, 'F', 'Mbeya', 'Mbeyaad', 'P.O.Box 972', 'driver', 'brigh', 1, '$2y$10$cGO9/UafTQjiRcGeSi/icejX3Z0420/vzXH6bBIysqImgsZ5smwWq', '2022-03-22 15:22:41'),
(18, 'mwakarundwa', 'GEORGE', 760506012, 'F', 'Mbeya', 'Mbeyaad', 'P.O.Box 972', 'passenger', 'luggie', 1, '$2y$10$Iou./Qoq6up2bPTvR6QTfuu3DxXNc03Ajkl3AVQBwMOIo2EKCK9/G', '2022-03-24 08:37:49'),
(20, 'mwakarundwa', 'GEORGE', 761546013, 'F', 'Mbeya', 'Mbeyaad', 'P.O.Box 972', 'manager', 'mwakapukuDSD', 1, '$2y$10$YzjnIl.pVCo31TmdjpxdFOoRcQspfJLyM9lmHouS6ghI9U91DVhpq', '2022-03-24 08:42:45'),
(21, 'mwakarundwa', 'GEORGE', 432506012, 'F', 'Mbeya', 'Mbeyaad', 'P.O.Box 972', 'manager', 'driver', 1, '$2y$10$hjKFjeqHokkIEHhxhFc1DOmcGJehKdUD.1z1A9XWo3fPTVZcxUeBm', '2022-03-24 09:19:00'),
(26, 'mwakarundwa', 'GEORGE', 742706013, 'F', 'Mbeya', 'Mbeyaad', 'P.O.Box 972', 'driver', 'gets2', 1, '$2y$10$dIoLAVN.mbc30gHp4ki/iu7t.Fsq4H/MdjYHqbSUnL7dMxLeVRPQe', '2022-03-24 10:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallet`
--

CREATE TABLE `tbl_wallet` (
  `wallet_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT 0,
  `wallet_number` int(11) NOT NULL,
  `passenger` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_wallet`
--

INSERT INTO `tbl_wallet` (`wallet_id`, `balance`, `wallet_number`, `passenger`, `last_update`) VALUES
(5, 0, 667139, 15, '2022-03-24 07:04:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bus`
--
ALTER TABLE `tbl_bus`
  ADD PRIMARY KEY (`bus_id`),
  ADD UNIQUE KEY `plate_no` (`plate_no`),
  ADD KEY `bus_route_FK` (`route`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_user_FK` (`user`);

--
-- Indexes for table `tbl_driver`
--
ALTER TABLE `tbl_driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `driver_bus_FK` (`bus`),
  ADD KEY `driver_user_FK` (`user`);

--
-- Indexes for table `tbl_route`
--
ALTER TABLE `tbl_route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `tbl_station`
--
ALTER TABLE `tbl_station`
  ADD PRIMARY KEY (`station_id`),
  ADD KEY `route_station_FK` (`route`);

--
-- Indexes for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD UNIQUE KEY `ticket_number` (`ticket_number`),
  ADD KEY `ticket_route_FK` (`route`),
  ADD KEY `passenger_ticket_FK` (`passanger`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  ADD PRIMARY KEY (`wallet_id`),
  ADD UNIQUE KEY `passenger` (`passenger`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bus`
--
ALTER TABLE `tbl_bus`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_driver`
--
ALTER TABLE `tbl_driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_route`
--
ALTER TABLE `tbl_route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_station`
--
ALTER TABLE `tbl_station`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bus`
--
ALTER TABLE `tbl_bus`
  ADD CONSTRAINT `bus_route_FK` FOREIGN KEY (`route`) REFERENCES `tbl_route` (`route_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `comment_user_FK` FOREIGN KEY (`user`) REFERENCES `tbl_user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_driver`
--
ALTER TABLE `tbl_driver`
  ADD CONSTRAINT `driver_bus_FK` FOREIGN KEY (`bus`) REFERENCES `tbl_bus` (`bus_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `driver_user_FK` FOREIGN KEY (`user`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_station`
--
ALTER TABLE `tbl_station`
  ADD CONSTRAINT `route_station_FK` FOREIGN KEY (`route`) REFERENCES `tbl_route` (`route_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD CONSTRAINT `passenger_ticket_FK` FOREIGN KEY (`passanger`) REFERENCES `tbl_user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_route_FK` FOREIGN KEY (`route`) REFERENCES `tbl_route` (`route_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  ADD CONSTRAINT `passenger_wallet_FK` FOREIGN KEY (`passenger`) REFERENCES `tbl_user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
