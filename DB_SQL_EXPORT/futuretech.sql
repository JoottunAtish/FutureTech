-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 01:26 PM
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
-- Database: `futuretech`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertProduct` (IN `productname` TEXT, IN `discount` INT, IN `price` DECIMAL(10,2), IN `qty` INT, IN `description` TEXT, IN `imgpath` VARCHAR(100), IN `cat` INT)   BEGIN
    DECLARE pid INT;

    -- Insert into the products table
    INSERT INTO products (productname, discount, price, qty, description, imgpath)
    VALUES (productname, discount, price, qty, description, imgpath);

    -- Get the last inserted productID
    SET pid = LAST_INSERT_ID();

    -- Insert into the productcategory table
    INSERT INTO productcategory (productID, categoryID)
    VALUES (pid, cat);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) UNSIGNED NOT NULL,
  `AdminName` varchar(50) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `AdminRole` varchar(30) NOT NULL,
  `LastLogin` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminName`, `Email`, `Password`, `AdminRole`, `LastLogin`) VALUES
(1, 'admin', 'admin@futuretech.com', 'admin', 'Manager', '2024-09-19');

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
(1, 'Atish', 'atish@gmail.com', '1234', 'Mauritius', 'Riviere du rempart', 12343, '12345678'),
(4, 'Atish', 'atish@test.io', '$2y$10$BqnHCGQGWWkBUHX0u.crG.234PKc2QDFRchGRoYEmbh8a/wC14cKK', 'Mauritius', 'Riviere du Rempart', 31902, '1234567'),
(6, 'poshan', 'poshan@test.io', '$2y$10$wVQ9/JoJNQc9TxgDm5gtOeCzMxNPo45rFI53KD0yVsNOxU0bDD6KG', 'Mauritius', 'Riviere du Rempart', 1234, '12345678'),
(7, 'elipson', 'kevin@test.io', '$2y$10$edz4ci.0K.mSUFUMl.d/RurBjf4MuP8EskrMpSGt7.yHR5LZR8nPW', 'Mauritius', 'Riviere du Rempart', 1234, '12345678'),
(8, 'KY20', 'kisto@test.io', '$2y$10$dr8/HJY.nXFlHOLBS5jf4.avCb48Eerq6FoMopwsWB/rXCUkAzRBy', 'Mauritius', 'Petite Rafery', 12345, '57858747');

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

CREATE TABLE `customerorder` (
  `orderID` int(10) UNSIGNED NOT NULL,
  `CustomerID` int(10) UNSIGNED NOT NULL,
  `OrderList` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`OrderList`))
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
-- Table structure for table `productcategory`
--

CREATE TABLE `productcategory` (
  `ProductID` int(11) NOT NULL,
  `Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`ProductID`, `Category`) VALUES
(1, 2),
(2, 1),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` text NOT NULL,
  `Discount` int(11) DEFAULT NULL,
  `ProductPrice` decimal(10,0) NOT NULL,
  `QtyInStock` int(11) NOT NULL,
  `Description` text NOT NULL,
  `imgPath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Discount`, `ProductPrice`, `QtyInStock`, `Description`, `imgPath`) VALUES
(1, 'Ryzen 5 7600X, 32 GB DDR5 RAM, NVIDIA RTX4060Ti, 1 TB NVME storage. Minimalist, Simple, Clean & Quite But Powerful Gaming PC.', 30, 80000, 1, '* Motherboard : Gigabyte B650i AX\r\n* CPU : AMD Ryzen 5 7600X\r\n* CPU Cooler : Thermalright Peerless Assassin 120 SE\r\n* Case : DeepCool CH170 Digital Black or White\r\n* GPU : Gigabyte RTX 4060Ti \r\n* RAM : 32GB DDR5 (16GB*2)\r\n* Storage : 1TB Kingston NV2 NVMe Gen4\r\n* PSU : Thermaltake BM3 650W PCIE 5.0\r\n* OS : Windows 11 Pro Activated\r\nRs 80,000 (vat incl)\r\n- CASH PRICE -\r\nPlease inbox us for credit price', 'Uploads\\IMG\\deepcool.jpg'),
(2, 'G.Skill Trident Z RGB Series 16GB RAM(2x8GB DDR4)', 20, 7400, 4, 'Trident Z RGB Series, compatible for AMD Ryzen Series; Intel Z170 and newer.\r\n\r\nRecommended Use: High Performance or Gaming Memory\r\n\r\nThe Ultimate DDR4 RAM Just Got Better!\r\n\r\nFeaturing a completely exposed light bar with vibrant RGB LEDs, merged with the award-winning Trident Z heatspreader design, and constructed with the highest quality components, the Trident Z RGB DDR4 memory kit combines the most vivid RGB lighting with uncompromised performance.\r\n\r\nExceptionally Engineered\r\n\r\nTrident Z RGB retains the iconic design element of the traditional Trident Z lineup, featuring luxurious hair-line finished aluminum heatspreaders, an aggressive fin design for highly efficient heat dissipation, and a wide light diffuser on top for extravagant lighting effects. Look no further for a memory that combines performance and beauty for building a stylish, modern PC!', 'Uploads\\IMG\\gskill-trident-z-rgb-series.jpg'),
(3, 'Logitech K100 Classic Keyboard', 0, 575, 5, 'The K100 Classic Keyboard from Logitech is a reliable, full-size wired keyboard that plugs into the PS/2 port of your Windows-based PC. The full-size keyboard features a standard layout and number pad to allow you to achieve maximum productivity. In the case of an accident, strategically placed drainage channels under the keys allow any liquid to flow.', 'Uploads\\IMG\\logitech-k100-classic-keyboard.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cat_1`
-- (See below for the actual view)
--
CREATE TABLE `vw_cat_1` (
`ProductID` int(11)
,`ProductName` text
,`Discount` int(11)
,`ProductPrice` decimal(10,0)
,`QtyInStock` int(11)
,`Description` text
,`imgPath` varchar(100)
,`Category` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cat_2`
-- (See below for the actual view)
--
CREATE TABLE `vw_cat_2` (
`ProductID` int(11)
,`ProductName` text
,`Discount` int(11)
,`ProductPrice` decimal(10,0)
,`QtyInStock` int(11)
,`Description` text
,`imgPath` varchar(100)
,`Category` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cat_3`
-- (See below for the actual view)
--
CREATE TABLE `vw_cat_3` (
`ProductID` int(11)
,`ProductName` text
,`Discount` int(11)
,`ProductPrice` decimal(10,0)
,`QtyInStock` int(11)
,`Description` text
,`imgPath` varchar(100)
,`Category` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_cat_1`
--
DROP TABLE IF EXISTS `vw_cat_1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_cat_1`  AS SELECT `products`.`ProductID` AS `ProductID`, `products`.`ProductName` AS `ProductName`, `products`.`Discount` AS `Discount`, `products`.`ProductPrice` AS `ProductPrice`, `products`.`QtyInStock` AS `QtyInStock`, `products`.`Description` AS `Description`, `products`.`imgPath` AS `imgPath`, `productcategory`.`Category` AS `Category` FROM (`products` join `productcategory` on(`products`.`ProductID` = `productcategory`.`ProductID`)) WHERE `productcategory`.`Category` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `vw_cat_2`
--
DROP TABLE IF EXISTS `vw_cat_2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_cat_2`  AS SELECT `products`.`ProductID` AS `ProductID`, `products`.`ProductName` AS `ProductName`, `products`.`Discount` AS `Discount`, `products`.`ProductPrice` AS `ProductPrice`, `products`.`QtyInStock` AS `QtyInStock`, `products`.`Description` AS `Description`, `products`.`imgPath` AS `imgPath`, `productcategory`.`Category` AS `Category` FROM (`products` join `productcategory` on(`products`.`ProductID` = `productcategory`.`ProductID`)) WHERE `productcategory`.`Category` = 2 ;

-- --------------------------------------------------------

--
-- Structure for view `vw_cat_3`
--
DROP TABLE IF EXISTS `vw_cat_3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_cat_3`  AS SELECT `products`.`ProductID` AS `ProductID`, `products`.`ProductName` AS `ProductName`, `products`.`Discount` AS `Discount`, `products`.`ProductPrice` AS `ProductPrice`, `products`.`QtyInStock` AS `QtyInStock`, `products`.`Description` AS `Description`, `products`.`imgPath` AS `imgPath`, `productcategory`.`Category` AS `Category` FROM (`products` join `productcategory` on(`products`.`ProductID` = `productcategory`.`ProductID`)) WHERE `productcategory`.`Category` = 3 ;

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
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `CustomerOrder_ibfk_1` (`CustomerID`);

--
-- Indexes for table `orderpayment`
--
ALTER TABLE `orderpayment`
  ADD PRIMARY KEY (`PayID`,`OrderID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customerorder`
--
ALTER TABLE `customerorder`
  MODIFY `orderID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderpayment`
--
ALTER TABLE `orderpayment`
  MODIFY `PayID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `OrderPayment_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `customerorder` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD CONSTRAINT `productcategory_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
