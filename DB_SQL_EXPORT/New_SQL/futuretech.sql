-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2025 at 06:25 AM
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
CREATE DATABASE IF NOT EXISTS `futuretech` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `futuretech`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_admin` (IN `p_AdminName` VARCHAR(50), IN `p_Email` VARCHAR(40), IN `p_Password` VARCHAR(256), IN `p_AdminRole` INT(11))   BEGIN
    INSERT INTO `admin` (`AdminName`, `Email`, `Password`, `AdminRole`)
    VALUES (p_AdminName, p_Email, p_Password, p_AdminRole);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_customer` (IN `p_UserName` VARCHAR(50), IN `p_Email` VARCHAR(40), IN `p_Password` VARCHAR(256), IN `p_Country` VARCHAR(50), IN `p_City` VARCHAR(50), IN `p_PostalCode` VARCHAR(10), IN `p_PhoneNum` VARCHAR(20))   BEGIN
    INSERT INTO `customer` (`UserName`, `Email`, `Password`, `Country`, `City`, `PostalCode`, `PhoneNum`)
    VALUES (p_UserName, p_Email, p_Password, p_Country, p_City, p_PostalCode, p_PhoneNum);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_product` (IN `p_ProductName` TEXT, IN `p_Discount` DECIMAL(5,2), IN `p_ProductPrice` DECIMAL(10,2), IN `p_QtyInStock` INT(11), IN `p_Description` TEXT, IN `p_imgPath` VARCHAR(100), IN `p_Category` INT(11))   BEGIN
    INSERT INTO `products` (`ProductName`, `Discount`, `ProductPrice`, `QtyInStock`, `Description`, `imgPath`, `Category`)
    VALUES (p_ProductName, p_Discount, p_ProductPrice, p_QtyInStock, p_Description, p_imgPath, p_Category);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_review` (IN `p_CustomerID` INT(11), IN `p_ProductID` INT(11), IN `p_Rating` INT(1), IN `p_ReviewTitle` VARCHAR(255), IN `p_ReviewText` TEXT)   BEGIN
    INSERT INTO `reviews` (`CustomerID`, `ProductID`, `Rating`, `ReviewTitle`, `ReviewText`)
    VALUES (p_CustomerID, p_ProductID, p_Rating, p_ReviewTitle, p_ReviewText);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_admin` (IN `p_AdminID` INT(11))   BEGIN
    DELETE FROM `admin`
    WHERE `AdminID` = p_AdminID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_products_with_category` ()   BEGIN
    SELECT p.*, c.CategoryName
    FROM products p
    JOIN categories c ON p.Category = c.CategoryID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_customer_orders` (IN `p_CustomerID` INT(11))   BEGIN
    SELECT * FROM `customerorder` WHERE `CustomerID` = p_CustomerID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_order_details` (IN `p_OrderID` INT(11))   BEGIN
    SELECT co.*, oi.*, p.ProductName, p.ProductPrice
    FROM `customerorder` co
    JOIN `order_items` oi ON co.OrderID = oi.OrderID
    JOIN `products` p ON oi.ProductID = p.ProductID
    WHERE co.OrderID = p_OrderID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_product_details` (IN `p_ProductID` INT(11))   BEGIN
    SELECT * FROM `products` WHERE `ProductID` = p_ProductID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_product_reviews` (IN `p_ProductID` INT(11))   BEGIN
    SELECT * FROM `reviews` WHERE `ProductID` = p_ProductID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_or_update_cart` (IN `in_customer_id` INT, IN `in_product_id` INT, IN `in_quantity` INT, IN `in_price` DECIMAL(10,2))   BEGIN
    DECLARE `cart_item_count` INT;

    -- Check if the product already exists in the cart for the given customer
    SELECT COUNT(*) INTO `cart_item_count`
    FROM `cart`
    WHERE `CustomerID` = in_customer_id AND `ProductID` = in_product_id;

    IF `cart_item_count` > 0 THEN
        -- If the item exists, update the quantity and price
        UPDATE `cart`
        SET 
            `Quantity` = `Quantity` + in_quantity,
            `PriceAtCart` = in_price
        WHERE 
            `CustomerID` = in_customer_id AND `ProductID` = in_product_id;
    ELSE
        -- If the item does not exist, insert a new record
        INSERT INTO `cart` (`CustomerID`, `ProductID`, `Quantity`, `PriceAtCart`, `AddedDate`)
        VALUES (in_customer_id, in_product_id, in_quantity, in_price, current_timestamp());
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `place_order` (IN `p_CustomerID` INT(11), IN `p_OrderItems` JSON)   BEGIN
    DECLARE orderID INT;
    DECLARE i INT DEFAULT 0;
    DECLARE productID INT;
    DECLARE quantity INT;
    DECLARE priceAtOrder DECIMAL(10,2);


    -- Create the order
    INSERT INTO `customerorder` (`CustomerID`) VALUES (p_CustomerID);
    SET orderID = LAST_INSERT_ID();

    -- Loop through the order items in the JSON
    WHILE i < JSON_LENGTH(p_OrderItems) DO
        SET productID = JSON_EXTRACT_SCALAR(p_OrderItems, CONCAT('$.[', i, '].productID'));
        SET quantity = JSON_EXTRACT_SCALAR(p_OrderItems, CONCAT('$.[', i, '].quantity'));

        -- Get the current price of the product
        SELECT ProductPrice INTO priceAtOrder FROM products WHERE ProductID = productID;

        -- Insert the order items
        INSERT INTO `order_items` (`OrderID`, `ProductID`, `Quantity`, `PriceAtOrder`)
        VALUES (orderID, productID, quantity, priceAtOrder);

        -- Update product quantity
        CALL update_product_quantity(productID, -quantity);

        SET i = i + 1;
    END WHILE;

    SELECT orderID AS 'OrderID'; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `purchase_cart` (IN `in_customer_id` INT)   BEGIN
    -- Start a transaction
    START TRANSACTION;

    -- Insert cart items into bought_items table for the given customer
    INSERT INTO `bought_items` (`CustomerID`, `ProductID`, `Quantity`, `PriceAtCart`, `AddedDate`)
    SELECT `CustomerID`, `ProductID`, `Quantity`, `PriceAtCart`, `AddedDate`
    FROM `cart`
    WHERE `CustomerID` = in_customer_id;

    -- Update product stock quantities
    UPDATE `products` p
    JOIN `cart` c ON p.ProductID = c.ProductID
    SET p.QtyInStock = p.QtyInStock - c.Quantity
    WHERE c.CustomerID = in_customer_id;

    -- Delete the items from the cart after they have been bought
    DELETE FROM `cart`
    WHERE `CustomerID` = in_customer_id;

    -- Commit the transaction
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_admin_role` (IN `p_AdminID` INT(11), IN `p_AdminRole` INT(11))   BEGIN
    UPDATE `admin`
    SET `AdminRole` = p_AdminRole
    WHERE `AdminID` = p_AdminID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_product_quantity` (IN `p_ProductID` INT(11), IN `p_QuantityChange` INT(11))   BEGIN
    UPDATE `products`
    SET `QtyInStock` = `QtyInStock` + p_QuantityChange
    WHERE `ProductID` = p_ProductID;
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
-- Table structure for table `bought_items`
--

CREATE TABLE `bought_items` (
  `boughtID` int(11) UNSIGNED NOT NULL,
  `CustomerID` int(11) UNSIGNED NOT NULL,
  `ProductID` int(11) UNSIGNED NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PriceAtCart` decimal(10,2) NOT NULL,
  `AddedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` enum('Pending','Processing','Closed') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bought_items`
--

INSERT INTO `bought_items` (`boughtID`, `CustomerID`, `ProductID`, `Quantity`, `PriceAtCart`, `AddedDate`, `Status`) VALUES
(1, 6, 5, 3, 2900.00, '2025-02-20 12:39:02', 'Processing'),
(2, 6, 2, 3, 7400.00, '2025-02-20 12:39:52', 'Pending'),
(3, 6, 1, 1, 80000.00, '2025-02-20 13:43:06', 'Pending'),
(4, 9, 5, 1, 2900.00, '2025-02-21 09:36:20', 'Closed');

-- --------------------------------------------------------

--
-- Stand-in structure for view `bought_items_details_view`
-- (See below for the actual view)
--
CREATE TABLE `bought_items_details_view` (
`boughtID` int(11) unsigned
,`CustomerID` int(11) unsigned
,`CustomerName` varchar(50)
,`CustomerEmail` varchar(40)
,`CustomerCountry` varchar(50)
,`CustomerCity` varchar(50)
,`CustomerPostalCode` int(5)
,`CustomerPhoneNum` varchar(8)
,`ProductID` int(11) unsigned
,`ProductName` text
,`Discount` int(11)
,`ProductPrice` decimal(10,0)
,`QtyInStock` int(11)
,`ProductDescription` text
,`ProductImage` varchar(100)
,`ProductCategory` int(11)
,`Quantity` int(11)
,`PriceAtCart` decimal(10,2)
,`AddedDate` datetime
,`Status` enum('Pending','Processing','Closed')
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) UNSIGNED NOT NULL,
  `CustomerID` int(11) UNSIGNED NOT NULL,
  `ProductID` int(11) UNSIGNED NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PriceAtCart` decimal(10,2) NOT NULL,
  `AddedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `CustomerID`, `ProductID`, `Quantity`, `PriceAtCart`, `AddedDate`) VALUES
(5, 4, 1, 3, 80000.00, '2025-02-20 10:18:08'),
(8, 4, 3, 4, 575.00, '2025-02-20 10:31:17');

--
-- Triggers `cart`
--
DELIMITER $$
CREATE TRIGGER `before_cart_insert` BEFORE INSERT ON `cart` FOR EACH ROW BEGIN
    IF EXISTS (SELECT 1 FROM cart WHERE CustomerID = NEW.CustomerID AND ProductID = NEW.ProductID) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Product already in cart!';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `cart_details_view`
-- (See below for the actual view)
--
CREATE TABLE `cart_details_view` (
`CartID` int(11) unsigned
,`CustomerID` int(11) unsigned
,`CustomerName` varchar(50)
,`CustomerEmail` varchar(40)
,`CustomerCountry` varchar(50)
,`CustomerCity` varchar(50)
,`CustomerPostalCode` int(5)
,`CustomerPhoneNum` varchar(8)
,`ProductID` int(11) unsigned
,`ProductName` text
,`Discount` int(11)
,`ProductPrice` decimal(10,0)
,`QtyInStock` int(11)
,`ProductDescription` text
,`ProductImage` varchar(100)
,`ProductCategory` int(11)
,`Quantity` int(11)
,`PriceAtCart` decimal(10,2)
,`AddedDate` datetime
);

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
(8, 'KY20', 'kisto@test.io', '$2y$10$dr8/HJY.nXFlHOLBS5jf4.avCb48Eerq6FoMopwsWB/rXCUkAzRBy', 'Mauritius', 'Petite Rafery', 12345, '57858747'),
(9, 'Atish Joottun', 'atish2@test.io', '$2y$10$w1xzOO/R0KiXguAZRTj0eeF5dc02AIDV8QZPSqhRsv/1nbyarDrYq', 'Mauritius', 'Belle-Mare', 44444, '66655555');

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
(5, 'Crucial BX500 1TB 3D NAND SATA 2.5-Inch Internal SSD', 0, 2900, 4, 'Boot up faster. Load files quicker...', 'Uploads/IMG/Crucial-BX500-1TB.jpg', 1),
(6, 'Laptop and tablet stands', 0, 820, 20, 'Awei laptop and tablet stand. For productivity and ergonomics. aluminium material, highly durable.', 'Uploads/IMG/laptop-stand.jpg', 3),
(7, 'Gigabyte Gaming Monitor 27 inch 144Hz 4K', 10, 23000, 10, 'great for 4k Gaming. Great resolution.', 'Uploads/IMG/Monitor-gaming.jpg', 3);

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `after_product_insert` AFTER INSERT ON `products` FOR EACH ROW BEGIN
    INSERT INTO `product_audit` (ProductID, ProductName, Action, Timestamp)
    VALUES (NEW.ProductID, NEW.ProductName, 'INSERT', NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_product_update` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
    INSERT INTO `product_audit` (ProductID, ProductName, Action, Timestamp)
    VALUES (NEW.ProductID, NEW.ProductName, 'UPDATE', NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_product_delete` BEFORE DELETE ON `products` FOR EACH ROW BEGIN
    INSERT INTO `product_audit` (ProductID, ProductName, Action, Timestamp)
    VALUES (OLD.ProductID, OLD.ProductName, 'DELETE', NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_product_update_stock_check` BEFORE UPDATE ON `products` FOR EACH ROW BEGIN
    IF NEW.QtyInStock < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Not enough stock available!';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_audit`
--

CREATE TABLE `product_audit` (
  `AuditID` int(11) UNSIGNED NOT NULL,
  `ProductID` int(11) UNSIGNED NOT NULL,
  `ProductName` text NOT NULL,
  `Action` varchar(20) NOT NULL,
  `Timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ReviewID`, `CustomerID`, `ProductID`, `Rating`, `ReviewText`, `ReviewDate`) VALUES
(1, 6, 5, 1, 'Great product, highly recommended.', '2025-02-20 18:48:02'),
(2, 9, 5, 4, 'good product, based on the number of reviews.', '2025-02-21 09:36:47'),
(3, 6, 2, 1, 'good product', '2025-02-21 14:14:36');

--
-- Triggers `reviews`
--
DELIMITER $$
CREATE TRIGGER `after_review_insert` AFTER INSERT ON `reviews` FOR EACH ROW BEGIN
    -- This is an example; you'd need to adapt it to your specific needs
    -- UPDATE products SET AverageRating = (SELECT AVG(Rating) FROM reviews WHERE ProductID = NEW.ProductID) WHERE ProductID = NEW.ProductID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `reviews_with_customer_name`
-- (See below for the actual view)
--
CREATE TABLE `reviews_with_customer_name` (
`CustomerName` varchar(50)
,`ReviewID` int(11) unsigned
,`CustomerID` int(11) unsigned
,`ProductID` int(11) unsigned
,`Rating` int(1) unsigned
,`ReviewText` text
,`ReviewDate` datetime
);

-- --------------------------------------------------------

--
-- Structure for view `bought_items_details_view`
--
DROP TABLE IF EXISTS `bought_items_details_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bought_items_details_view`  AS SELECT `bi`.`boughtID` AS `boughtID`, `bi`.`CustomerID` AS `CustomerID`, `cu`.`UserName` AS `CustomerName`, `cu`.`Email` AS `CustomerEmail`, `cu`.`Country` AS `CustomerCountry`, `cu`.`City` AS `CustomerCity`, `cu`.`PostalCode` AS `CustomerPostalCode`, `cu`.`PhoneNum` AS `CustomerPhoneNum`, `bi`.`ProductID` AS `ProductID`, `p`.`ProductName` AS `ProductName`, `p`.`Discount` AS `Discount`, `p`.`ProductPrice` AS `ProductPrice`, `p`.`QtyInStock` AS `QtyInStock`, `p`.`Description` AS `ProductDescription`, `p`.`imgPath` AS `ProductImage`, `p`.`Category` AS `ProductCategory`, `bi`.`Quantity` AS `Quantity`, `bi`.`PriceAtCart` AS `PriceAtCart`, `bi`.`AddedDate` AS `AddedDate`, `bi`.`Status` AS `Status` FROM ((`bought_items` `bi` join `customer` `cu` on(`bi`.`CustomerID` = `cu`.`CustomerID`)) join `products` `p` on(`bi`.`ProductID` = `p`.`ProductID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `cart_details_view`
--
DROP TABLE IF EXISTS `cart_details_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cart_details_view`  AS SELECT `c`.`CartID` AS `CartID`, `c`.`CustomerID` AS `CustomerID`, `cu`.`UserName` AS `CustomerName`, `cu`.`Email` AS `CustomerEmail`, `cu`.`Country` AS `CustomerCountry`, `cu`.`City` AS `CustomerCity`, `cu`.`PostalCode` AS `CustomerPostalCode`, `cu`.`PhoneNum` AS `CustomerPhoneNum`, `c`.`ProductID` AS `ProductID`, `p`.`ProductName` AS `ProductName`, `p`.`Discount` AS `Discount`, `p`.`ProductPrice` AS `ProductPrice`, `p`.`QtyInStock` AS `QtyInStock`, `p`.`Description` AS `ProductDescription`, `p`.`imgPath` AS `ProductImage`, `p`.`Category` AS `ProductCategory`, `c`.`Quantity` AS `Quantity`, `c`.`PriceAtCart` AS `PriceAtCart`, `c`.`AddedDate` AS `AddedDate` FROM ((`cart` `c` join `customer` `cu` on(`c`.`CustomerID` = `cu`.`CustomerID`)) join `products` `p` on(`c`.`ProductID` = `p`.`ProductID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `reviews_with_customer_name`
--
DROP TABLE IF EXISTS `reviews_with_customer_name`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reviews_with_customer_name`  AS SELECT `cu`.`UserName` AS `CustomerName`, `r`.`ReviewID` AS `ReviewID`, `r`.`CustomerID` AS `CustomerID`, `r`.`ProductID` AS `ProductID`, `r`.`Rating` AS `Rating`, `r`.`ReviewText` AS `ReviewText`, `r`.`ReviewDate` AS `ReviewDate` FROM (`reviews` `r` join `customer` `cu` on(`r`.`CustomerID` = `cu`.`CustomerID`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `bought_items`
--
ALTER TABLE `bought_items`
  ADD PRIMARY KEY (`boughtID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD UNIQUE KEY `unique_customer_product` (`CustomerID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `product_audit`
--
ALTER TABLE `product_audit`
  ADD PRIMARY KEY (`AuditID`);

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
-- AUTO_INCREMENT for table `bought_items`
--
ALTER TABLE `bought_items`
  MODIFY `boughtID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_audit`
--
ALTER TABLE `product_audit`
  MODIFY `AuditID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bought_items`
--
ALTER TABLE `bought_items`
  ADD CONSTRAINT `bought_items_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `bought_items_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

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
