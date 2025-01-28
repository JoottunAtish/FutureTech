-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2025 at 04:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futuretech_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) UNSIGNED NOT NULL,
  `AdminName` varchar(50) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `AdminRole` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminName`, `Email`, `Password`, `AdminRole`, `LastLogin`) VALUES
(2, 'admin', 'admin@futuretech.com', '$2y$10$dcjllEUW.VgJPGlsFRJBve2g2zM5C1EV86BfIGvGGNMn8xOSu0.GS', 0, '2024-10-12 00:00:00'),
(4, 'kisto', 'kisto@futuretech.com', '$2y$10$icrBRA2FaKWz0/wu17QYK.fHIYa4ml049A1LiiyTLdoNNdBymsKtS', 0, '2024-10-12 00:00:00'),
(7, 'Atish', 'atishj3@test.io', '$2y$10$nhIhd1m8cqDD5LgNW/zc.e1q/jFMIvCK4LERfW8pZg8UuB20ExstO', 1, '2025-01-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) UNSIGNED NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `PostalCode` int(5) NOT NULL,
  `PhoneNum` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `UserName`, `Email`, `Password`, `Country`, `City`, `PostalCode`, `PhoneNum`) VALUES
(4, 'Atish', 'atish@test.io', '$2y$10$BqnHCGQGWWkBUHX0u.crG.234PKc2QDFRchGRoYEmbh8a/wC14cKK', 'Mauritius', 'Riviere du Rempart', 31902, '1234567'),
(6, 'poshan', 'poshan@test.io', '$2y$10$wVQ9/JoJNQc9TxgDm5gtOeCzMxNPo45rFI53KD0yVsNOxU0bDD6KG', 'Mauritius', 'Riviere du Rempart', 1234, '12345678'),
(7, 'elipson', 'kevin@test.io', '$2y$10$edz4ci.0K.mSUFUMl.d/RurBjf4MuP8EskrMpSGt7.yHR5LZR8nPW', 'Mauritius', 'Riviere du Rempart', 1234, '12345678'),
(8, 'KY20', 'kisto@test.io', '$2y$10$dr8/HJY.nXFlHOLBS5jf4.avCb48Eerq6FoMopwsWB/rXCUkAzRBy', 'Mauritius', 'Petite Rafery', 12345, '57858747');

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

CREATE TABLE `customerorder` (
  `OrderID` int(11) UNSIGNED NOT NULL,
  `CustomerID` int(11) UNSIGNED NOT NULL,
  `OrderList` longtext NOT NULL CHECK (json_valid(`OrderList`)),
  `OrderDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderpayment`
--

CREATE TABLE `orderpayment` (
  `PayID` int(11) UNSIGNED NOT NULL,
  `OrderID` int(11) UNSIGNED NOT NULL,
  `TotalAmount` float NOT NULL,
  `PaymentMethod` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE `orderproduct` (
  `OrderProductID` int(11) UNSIGNED NOT NULL,
  `OrderID` int(11) UNSIGNED NOT NULL,
  `ProductID` int(11) UNSIGNED NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PriceAtOrder` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) UNSIGNED NOT NULL,
  `ProductName` text NOT NULL,
  `Discount` int(11) DEFAULT NULL,
  `ProductPrice` decimal(10,0) NOT NULL,
  `QtyInStock` int(11) NOT NULL,
  `Description` text NOT NULL,
  `imgPath` varchar(100) NOT NULL,
  `Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Discount`, `ProductPrice`, `QtyInStock`, `Description`, `imgPath`, `Category`) VALUES
(1, 'Ryzen 5 7600X, 32 GB DDR5 RAM, NVIDIA RTX4060Ti, 1 TB NVME storage. Minimalist, Simple, Clean & Quite But Powerful Gaming PC.', 30, 80000, 1, 'Become part of the gamers community with this powerful yet budget-friendly beast...', 'Uploads/IMG/Compact-PC.jpg', 2),
(2, 'G.Skill Trident Z RGB Series 16GB RAM(2x8GB DDR4)', 20, 7400, 4, 'Trident Z RGB Series, compatible for AMD Ryzen Series; Intel Z170 and newer.', 'Uploads/IMG/gskill-trident-z-rgb-series.jpg', 1),
(3, 'Logitech K100 Classic Keyboard', 0, 575, 5, 'The K100 Classic Keyboard from Logitech...', 'Uploads/IMG/logitech-k100.jpg', 3),
(4, 'Dell Optiplex Workstation, Core i5, 16GB RAM, 256GB NVME Storage', 40, 55000, 4, 'Commercial desktop with DDR5 memory...', 'Uploads/IMG/dell-optiplex.png', 2),
(5, 'Crucial BX500 1TB 3D NAND SATA 2.5-Inch Internal SSD', 0, 2900, 4, 'Boot up faster. Load files quicker...', 'Uploads/IMG/Crucial-BX500-1TB.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) UNSIGNED NOT NULL,
  `CustomerID` int(11) UNSIGNED NOT NULL,
  `ProductID` int(11) UNSIGNED NOT NULL,
  `Rating` int(1) UNSIGNED NOT NULL CHECK (`Rating` >= 1 and `Rating` <= 5),
  `ReviewText` text NOT NULL,
  `ReviewDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerOrder_ibfk_1` (`CustomerID`);

--
-- Indexes for table `orderpayment`
--
ALTER TABLE `orderpayment`
  ADD PRIMARY KEY (`PayID`,`OrderID`),
  ADD KEY `OrderPayment_ibfk_1` (`OrderID`);

--
-- Indexes for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`OrderProductID`),
  ADD KEY `fk_orderproduct_order` (`OrderID`),
  ADD KEY `fk_orderproduct_product` (`ProductID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customerorder`
--
ALTER TABLE `customerorder`
  MODIFY `OrderID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderpayment`
--
ALTER TABLE `orderpayment`
  MODIFY `PayID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `OrderProductID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD CONSTRAINT `CustomerOrder_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderpayment`
--
ALTER TABLE `orderpayment`
  ADD CONSTRAINT `OrderPayment_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `customerorder` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `fk_orderproduct_order` FOREIGN KEY (`OrderID`) REFERENCES `customerorder` (`OrderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_orderproduct_product` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
