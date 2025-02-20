CREATE TABLE `admin_roles` (
    `RoleID` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `RoleName` VARCHAR(50) NOT NULL
);

CREATE TABLE `categories` (
    `CategoryID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CategoryName` VARCHAR(50) NOT NULL
);

CREATE TABLE `customer` (
    `CustomerID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `UserName` VARCHAR(50) NOT NULL,
    `Email` VARCHAR(40) NOT NULL,
    `Password` VARCHAR(256) NOT NULL,
    `Country` VARCHAR(50) NOT NULL,
    `City` VARCHAR(50) NOT NULL,
    `PostalCode` VARCHAR(10) NOT NULL,
    `PhoneNum` VARCHAR(20) NOT NULL
);

CREATE TABLE `customerorder` (
    `OrderID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CustomerID` INT(11) UNSIGNED NOT NULL,
    `OrderDate` DATETIME NOT NULL DEFAULT current_timestamp(),
    FOREIGN KEY (`CustomerID`) REFERENCES `customer`(`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `order_items` (
    `OrderItemID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `OrderID` INT(11) UNSIGNED NOT NULL,
    `ProductID` INT(11) UNSIGNED NOT NULL,
    `Quantity` INT(11) NOT NULL,
    `PriceAtOrder` DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (`OrderID`) REFERENCES `customerorder`(`OrderID`) ON DELETE CASCADE,
    FOREIGN KEY (`ProductID`) REFERENCES `products`(`ProductID`) ON DELETE CASCADE
);


CREATE TABLE `products` (
    `ProductID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ProductName` TEXT NOT NULL,
    `Discount` DECIMAL(5, 2) DEFAULT NULL,
    `ProductPrice` DECIMAL(10, 2) NOT NULL,
    `QtyInStock` INT(11) NOT NULL,
    `Description` TEXT NOT NULL,
    `imgPath` VARCHAR(100) NOT NULL,
    `Category` INT(11) NOT NULL,
    FOREIGN KEY (`Category`) REFERENCES `categories`(`CategoryID`)
);

CREATE TABLE `orderpayment` (
    `PayID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `OrderID` INT(11) UNSIGNED NOT NULL,
    `TotalAmount` DECIMAL(10, 2) NOT NULL,
    `PaymentMethod` VARCHAR(20) NOT NULL,
    UNIQUE KEY (`PayID`, `OrderID`),
    FOREIGN KEY (`OrderID`) REFERENCES `customerorder`(`OrderID`) ON DELETE CASCADE
);

CREATE TABLE `admin` (
    `AdminID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `AdminName` VARCHAR(50) NOT NULL,
    `Email` VARCHAR(40) NOT NULL,
    `Password` VARCHAR(256) NOT NULL,
    `AdminRole` INT(11) UNSIGNED NOT NULL,
    `LastLogin` DATETIME NOT NULL DEFAULT current_timestamp(),
    FOREIGN KEY (`AdminRole`) REFERENCES `admin_roles`(`RoleID`)
);

CREATE TABLE `reviews` (
    `ReviewID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CustomerID` INT(11) UNSIGNED NOT NULL,
    `ProductID` INT(11) UNSIGNED NOT NULL,
    `Rating` INT(1) UNSIGNED NOT NULL CHECK (`Rating` >= 1 and `Rating` <= 5),
    `ReviewTitle` VARCHAR(255),  -- Added review title
    `ReviewText` TEXT NOT NULL,
    `ReviewDate` DATETIME NOT NULL DEFAULT current_timestamp(),
    FOREIGN KEY (`CustomerID`) REFERENCES `customer`(`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`ProductID`) REFERENCES `products`(`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `cart` (
    `CartID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CustomerID` INT(11) UNSIGNED NOT NULL,
    `ProductID` INT(11) UNSIGNED NOT NULL,
    `Quantity` INT(11) NOT NULL,
    `PriceAtCart` DECIMAL(10, 2) NOT NULL,
    `AddedDate` DATETIME NOT NULL DEFAULT current_timestamp(),
    FOREIGN KEY (`CustomerID`) REFERENCES `customer`(`CustomerID`) ON DELETE CASCADE,
    FOREIGN KEY (`ProductID`) REFERENCES `products`(`ProductID`) ON DELETE CASCADE
);



-- Sample Data (You would insert your actual data here)

INSERT INTO `admin_roles` (`RoleName`) VALUES ('admin'), ('sales rep'), ('manager');
INSERT INTO `categories` (`CategoryName`) VALUES ('Components'), ('Pre-built PCs'), ('Peripherals');

-- ... (Insert other data as needed)




--- Stored Procedures

