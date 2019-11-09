-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 09, 2019 at 07:09 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact`
--
CREATE DATABASE IF NOT EXISTS `contact` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `contact`;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `IsChecked` tinyint(1) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ID`, `Name`, `Email`, `Phone`, `IsChecked`, `UserID`) VALUES
(1, 'Văn Toàn', 'vantoan@gmail.com', '0362537364', 0, 1),
(2, 'Công Phượng', 'congphuong@gmail.com', '0973625121', 0, 1),
(3, 'Việt Hoàng', 'viethoang@gmail.com', '0111222764', 0, 2),
(4, 'Thành Chung', 'thanhchung@gmail.com', '0983524372', 0, 2),
(5, 'Tiến Dũng', '', '0362537090', 1, 1),
(6, 'Huy Hùng', '', '0922537090', 0, 1),
(7, 'Văn Công', 'vancong@gmail.com', '0835337165', 1, 1),
(8, 'Nguyen Duc Nghia', 'ducnghia69@gmail.com', '1111111111', 0, 1),
(9, 'Thầy Khoa', 'khoa@gmail.com', '0123456789', 0, 1),
(10, 'Thầy Dũng', '', '0635472634', 0, 1),
(11, 'sdfsfs', '', '5343535353', 0, 1),
(12, 'rêtrt', '', '4354846363', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_label`
--

DROP TABLE IF EXISTS `contact_label`;
CREATE TABLE IF NOT EXISTS `contact_label` (
  `ContactID` int(11) NOT NULL,
  `LabelID` int(11) NOT NULL,
  PRIMARY KEY (`ContactID`,`LabelID`),
  KEY `LabelID` (`LabelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_label`
--

INSERT INTO `contact_label` (`ContactID`, `LabelID`) VALUES
(1, 1),
(2, 1),
(8, 1),
(9, 1),
(1, 2),
(12, 2),
(3, 3),
(4, 3),
(4, 4),
(5, 17),
(6, 17),
(7, 17),
(10, 17),
(11, 17);

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

DROP TABLE IF EXISTS `label`;
CREATE TABLE IF NOT EXISTS `label` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`ID`, `Name`, `UserID`) VALUES
(1, 'Người thân', 1),
(2, 'Bạn bè', 1),
(3, 'Công việc', 2),
(4, 'Học tập', 2),
(17, 'Trường học', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PassWord` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FullName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UserName` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `PassWord`, `FullName`) VALUES
(1, 'ducphuc', '123', 'Ngô Hoàng Đức Phúc'),
(2, 'user2', '123', 'Nguyễn Văn Hoàng');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `contact_label`
--
ALTER TABLE `contact_label`
  ADD CONSTRAINT `contact_label_ibfk_1` FOREIGN KEY (`ContactID`) REFERENCES `contact` (`ID`),
  ADD CONSTRAINT `contact_label_ibfk_2` FOREIGN KEY (`LabelID`) REFERENCES `label` (`ID`);

--
-- Constraints for table `label`
--
ALTER TABLE `label`
  ADD CONSTRAINT `label_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
