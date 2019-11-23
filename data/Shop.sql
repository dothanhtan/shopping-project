-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 23, 2019 at 05:13 AM
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
-- Database: `shop`
--
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `shop`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Name`) VALUES
(1, 'Đồng hồ'),
(2, 'Thời trang'),
(3, 'Điện thoại'),
(4, 'PC/Laptop'),
(5, 'Đồ chơi'),
(6, 'Gia dụng'),
(7, 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `SellPrice` bigint(20) NOT NULL,
  `Price` bigint(20) NOT NULL,
  `Star` int(11) NOT NULL DEFAULT '0',
  `MainImages` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `OtherImages` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Branch` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CategoryID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `CategoryID` (`CategoryID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `Name`, `Description`, `SellPrice`, `Price`, `Star`, `MainImages`, `OtherImages`, `Branch`, `CategoryID`) VALUES
(1, 'Đồng Hồ Nam Fourron', 'Kiểu máy: Quartz\r\nKích thước mặt: 41mm\r\nĐộ dày mặt:10 mm\r\nKích thước dây: 220mm x 20mm (dài x Rộng)\r\nSố kim: 3 kim chạy, Có lịch ngày\r\nKhoá cài: Khóa bấm\r\nChất liệu dây và vỏ: Thép không gỉ cao cấp\r\nKhả năng chịu nước: 3 ATM (rửa tay, đi mưa )', 158000, 162000, 4, 'Đồng Hồ Nam Fourron.jpg', 'Đồng Hồ Nam Fourron_2.jpg;Đồng Hồ Nam Fourron_3.jpg', 'Fourron', 1),
(3, 'Đồng Hồ Nam SHAARMS S6112', 'Kiểu máy: Quartz\r\nChất liệu vỏ: Thép không gỉ\r\nChất liệu dây: Dây DA PU\r\nChất liệu mặt trước: Kính cứng pha khoáng,\r\nKích thước mặt: 40 x 9.5 mm (Rộng x dày)\r\nKích thước dây: 20 x 230mm (Rộng x dài)\r\nSố Kim: Chạy 3 kim (LỊCH XEM NGÀY)\r\nKhả năng chịu nước: (rửa tay, đi mưa, ok... Nên tránh tiếp xúc với hóa chất như xà phòng, nước tẩy rửa, không mang khi bơi lội... Của bền tại người nâng niu giữ gìn)\r\nPhù hợp đeo đi làm, đi học, dạo phố, xem phim, dự tiệc', 99000, 801000, 2, 'Đồng Hồ Nam SHAARMS S6112.jpg', 'Đồng Hồ Nam SHAARMS S6112_2.jpg;Đồng Hồ Nam SHAARMS S6112_3.jpg;Đồng Hồ Nam SHAARMS S6112_4.jpg', 'SHAARMS', 1),
(4, 'Đồng hồ thể thao OEM', 'Loại máy: Máy Digital chạy pin\r\nChất liệu mặt: Kính nhựa (Plastic Mirror).\r\nĐộ dày mặt đồng hồ: 1.2 cm\r\nĐường kính mặt đồng hồ: 3.6 cm (luôn viên ngoài là 4.2cm), đây là size Unisex, phù hợp cho cả nam lẫn nữ.\r\nChất liệu dây đeo: Dây silicon\r\nKích thước dây: 27cm x 2.5 cm\r\nChống nước: Rửa tay, rửa mặt, đi mưa.\r\nTránh để đồng hồ bị va đập, rơi vỡ hoặc va chạm mạnh.', 98000, 1392000, 4, 'Đồng hồ thể thao OEM.jpg', '', 'OEM', 1),
(5, 'Samsung Galaxy M10 (16GB/2GB)', 'Điện thoại chính hãng, Nguyên seal, Mới 100%, Chưa Active\r\nThiết kế: Nguyên khối, mặt kính cong 2.5D\r\nMàn hình: Super AMOLED 6.22” HD+ Infinity V Display\r\nCamera Sau: 13 MP và 5 MP (2 camera)\r\nCamera Trước: 5 MP\r\nCPU: Samsung Exynos 7870, 8 nhân Cortex A53 @1.6 GHz\r\nBộ Nhớ: 16GB\r\nRAM: 2GB\r\nTính năng: Mở khóa bằng vân tay, Đèn pin, Chặn cuộc gọi, Chặn tin nhắn', 2399000, 3490000, 5, 'Samsung Galaxy M10-16GB-2GB.jpg', 'Samsung Galaxy M10-16GB-2GB_2.jpg;Samsung Galaxy M10-16GB-2GB_3.jpg;Samsung Galaxy M10-16GB-2GB_4.jpg', 'Samsung', 3),
(6, 'iPhone 11 64GB', 'Nguyên seal, Mới 100%, Chưa Active\r\nCông nghệ màn hình: IPS LCD\r\nĐộ phân giải: 828 x 1792 pixels\r\nMàn hình rộng: 6.1 inches\r\nCamera sau: 12 MP + 12 MP\r\nQuay phim: 2160p@24/30/60fps, 1080p@30/60/120/240fps, HDR, stereo sound rec.\r\nCamera trước: 12 MP, f/2.2\r\nHệ điều hành: iOS 13\r\nChipset (CPU): Apple A13 Bionic 6 nhân\r\nRAM: 4 GB\r\nBộ nhớ trong: 64GB\r\nDung lượng pin: 3110 mAh\r\nSIM: 1 Nano SIM , 1 esim\r\nMã Part: VN/A', 21490000, 21990000, 4, 'iPhone 11 64GB.jpg', '', 'Apple', 3),
(7, 'Xiaomi Mi 9 Lite', 'Mới, Chính hãng, Nguyên seal, Chưa active\r\nMiễn phí giao hàng toàn quốc\r\nMàn hình: Super AMOLED, 6.39\", Full HD+\r\nHệ điều hành: Android 9.0 (Pie)\r\nCamera sau: Chính 48 MP & Phụ 8 MP, 2 MP\r\nCamera trước: 32 MP\r\nCPU: Snapdragon 710 8 nhân 64-bit\r\nRAM: 6 GB\r\nBộ nhớ trong: 64GB\r\nThẻ nhớ: MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM: 2 SIM Nano (SIM 2 chung khe thẻ nhớ)\r\nDung lượng pin: 4030 mAh', 5990000, 7490000, 5, 'Xiaomi Mi 9 Lite.jpg', 'Xiaomi Mi 9 Lite_2.jpg;Xiaomi Mi 9 Lite_3.jpg;Xiaomi Mi 9 Lite_4.jpg;Xiaomi Mi 9 Lite_5.jpg', 'Xiaomi', 3),
(8, 'Áo khoác hoddie', 'Chất Nỉ 2 lớp cực kì bền , không rách\r\nBên trong thoáng khí giúp áo không bị nóng\r\nĐường may cực kì sắc sảo , tinh tế', 79000, 140000, 4, 'Áo khoác hoddie.jpg', 'Áo khoác hoddie_2.jpg;Áo khoác hoddie_3.jpg;Áo khoác hoddie_4.jpg', 'Bảo Đăng', 2),
(9, 'Balo LAZA BL432', 'Kích thước: Cao 45cm - Rộng 15cm - Ngang 31cm\r\nKhối lượng sản phẩm: 0.7kg\r\nChất liệu vải chuyên dụng cao cấp\r\nThiết kế hiện đại và thời trang\r\nKiểu dáng phong cách\r\nĐường may tỉ mỉ chắc chắn\r\nDễ dàng phối đồ\r\nBảo quản đơn giản\r\nThương hiệu Việt: LAZA', 109000, 190000, 4, 'Balo LAZA BL432.jpg', 'Balo LAZA BL432_2.jpg;Balo LAZA BL432_3.jpg;Balo LAZA BL432_4.jpg', 'LaZa', 2),
(10, 'Asus Vivobook 14', 'Chip: Intel Core i5-8265U (1.60GHz Up to 3.90 GHz, 4Cores, 8Threads, 6MB Cache, FSB 4GT/s)\r\nRAM: 8GB DDR4 2400MHz + 1 slot RAM\r\nỔ cứng: 512GB SSD M.2 PCIe\r\nChipset đồ họa: Intel UHD Graphics 620\r\nMàn hình: 14-inch FHD (1920x1080) 60Hz Anti-Glare Panel with 45% NTSC, NanoEdge\r\nHệ điều hành: Windows 10 bản quyền\r\nPin: 3 Cells 42 Whrs', 15399000, 17490000, 4, 'Asus Vivobook 14.jpg', 'Asus Vivobook 14_2.jpg;Asus Vivobook 14_3.jpg;Asus Vivobook 14_4.jpg;Asus Vivobook 14_5.jpg', 'Asus', 4),
(11, 'Apple Macbook Air 2019', 'Chip: Intel Core i5 8th 1.6GHz dual-core (Turbo Boost up to 3.6GHz)\r\nRAM: 8GB 2133MHz LPDDR3\r\nỔ Cứng: 128GB SSD\r\nChipset đồ họa: Intel UHD Graphics 617\r\nMàn hình: 13.3 inch (2560 x 1600), LED-backlit display with IPS technology, True Tone technology\r\nVân tay: Touch ID\r\nCổng kết nối: 2 x Thunderbolt 3, 3.5 mm headphone jack', 25490000, 32990000, 4, 'Apple Macbook Air 2019.jpg', 'Apple Macbook Air 2019_2.jpg;Apple Macbook Air 2019_3.jpg;Apple Macbook Air 2019_4.jpg', 'Apple', 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
