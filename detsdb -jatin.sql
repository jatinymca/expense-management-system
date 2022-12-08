-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 28, 2022 at 12:41 PM
-- Server version: 10.2.3-MariaDB
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `detsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_money`
--

CREATE TABLE `add_money` (
  `id` int(11) NOT NULL,
  `Money` varchar(250) NOT NULL,
  `UserId` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_money`
--

INSERT INTO `add_money` (`id`, `Money`, `UserId`) VALUES
(2, '1071', '7'),
(3, ' 9500', '17');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(250) NOT NULL,
  `FullName` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `MobileNumber` bigint(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `FullName`, `Email`, `MobileNumber`, `Password`, `RegDate`) VALUES
(1, 'Admin', 'admin@gmail.com', 9810619701, '25d55ad283aa400af464c76d713c07ad', '2022-08-25 06:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblexpense`
--

CREATE TABLE `tblexpense` (
  `ID` int(10) NOT NULL,
  `UserId` int(10) NOT NULL,
  `ExpenseDate` date DEFAULT NULL,
  `ExpenseItem` varchar(200) DEFAULT NULL,
  `Opening_balance` varchar(250) NOT NULL,
  `ExpenseCost` int(250) DEFAULT NULL,
  `Closing_balance` varchar(250) NOT NULL,
  `Quantity` varchar(250) NOT NULL,
  `NoteDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblexpense`
--

INSERT INTO `tblexpense` (`ID`, `UserId`, `ExpenseDate`, `ExpenseItem`, `Opening_balance`, `ExpenseCost`, `Closing_balance`, `Quantity`, `NoteDate`) VALUES
(34, 17, '2022-09-26', 'pen', '10000', 500, '9500', '2', '2022-09-26 11:17:29'),
(38, 7, '2022-09-28', 'pen', '2000', 400, '1600', '1', '2022-09-28 05:36:04'),
(39, 7, '2022-09-28', 'mouse', ' 1600', 250, '1350', '1', '2022-09-28 05:43:49'),
(40, 7, '2022-09-27', 'notebook', '1350', 55, '1295', '1', '2022-09-28 05:44:39'),
(41, 7, '2022-09-24', 'pen', '1295', 44, '1251', '1', '2022-09-28 05:47:48'),
(42, 7, '2022-09-28', 'notebook', '1251', 60, '1191', '1', '2022-09-28 05:51:05'),
(43, 7, '2022-09-28', 'notebook', '1191', 120, '1071', '1', '2022-09-28 06:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(150) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FullName`, `Email`, `MobileNumber`, `Password`, `RegDate`) VALUES
(7, 'Jatin Sharma', 'jatin@gmail.com', 9810619701, 'e10adc3949ba59abbe56e057f20f883e', '2022-08-18 13:16:01'),
(17, 'Vikas Jha', 'accounts@vert-age.com', 8010123546, 'b84862d690dfe8e71d9129b65213fd99', '2022-09-19 06:58:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_money`
--
ALTER TABLE `add_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblexpense`
--
ALTER TABLE `tblexpense`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_money`
--
ALTER TABLE `add_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblexpense`
--
ALTER TABLE `tblexpense`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
