-- Stored Procedures

-- 1. Add New Customer
DELIMITER //
CREATE PROCEDURE `add_customer`(
    IN p_UserName VARCHAR(50),
    IN p_Email VARCHAR(40),
    IN p_Password VARCHAR(256),
    IN p_Country VARCHAR(50),
    IN p_City VARCHAR(50),
    IN p_PostalCode VARCHAR(10),
    IN p_PhoneNum VARCHAR(20)
)
BEGIN
    INSERT INTO `customer` (`UserName`, `Email`, `Password`, `Country`, `City`, `PostalCode`, `PhoneNum`)
    VALUES (p_UserName, p_Email, p_Password, p_Country, p_City, p_PostalCode, p_PhoneNum);
END //
DELIMITER ;

-- 2. Add New Product
DELIMITER //
CREATE PROCEDURE `add_product`(
    IN p_ProductName TEXT,
    IN p_Discount DECIMAL(5, 2),
    IN p_ProductPrice DECIMAL(10, 2),
    IN p_QtyInStock INT(11),
    IN p_Description TEXT,
    IN p_imgPath VARCHAR(100),
    IN p_Category INT(11)
)
BEGIN
    INSERT INTO `products` (`ProductName`, `Discount`, `ProductPrice`, `QtyInStock`, `Description`, `imgPath`, `Category`)
    VALUES (p_ProductName, p_Discount, p_ProductPrice, p_QtyInStock, p_Description, p_imgPath, p_Category);
END //
DELIMITER ;

-- 3. Update Product Quantity
DELIMITER //
CREATE PROCEDURE `update_product_quantity`(
    IN p_ProductID INT(11),
    IN p_QuantityChange INT(11) -- Positive for adding, negative for subtracting
)
BEGIN
    UPDATE `products`
    SET `QtyInStock` = `QtyInStock` + p_QuantityChange
    WHERE `ProductID` = p_ProductID;
END //
DELIMITER ;

-- 4. Get Product Details
DELIMITER //
CREATE PROCEDURE `get_product_details`(
    IN p_ProductID INT(11)
)
BEGIN
    SELECT * FROM `products` WHERE `ProductID` = p_ProductID;
END //
DELIMITER ;

-- 5. Place Order (Simplified -  Handles order creation and order items)
DELIMITER //
CREATE PROCEDURE `place_order`(
    IN p_CustomerID INT(11),
    IN p_OrderItems JSON  -- JSON array of product IDs and quantities
)
BEGIN
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

        -- Update product quantity (you might want to handle stock issues here)
        CALL update_product_quantity(productID, -quantity);

        SET i = i + 1;
    END WHILE;

    SELECT orderID AS 'OrderID'; -- Return the new order ID
END //
DELIMITER ;


-- 6. Get Customer Orders
DELIMITER //
CREATE PROCEDURE `get_customer_orders`(
    IN p_CustomerID INT(11)
)
BEGIN
    SELECT * FROM `customerorder` WHERE `CustomerID` = p_CustomerID;
END //
DELIMITER ;

-- 7. Get Order Details (including items)
DELIMITER //
CREATE PROCEDURE `get_order_details`(
    IN p_OrderID INT(11)
)
BEGIN
    SELECT co.*, oi.*, p.ProductName, p.ProductPrice
    FROM `customerorder` co
    JOIN `order_items` oi ON co.OrderID = oi.OrderID
    JOIN `products` p ON oi.ProductID = p.ProductID
    WHERE co.OrderID = p_OrderID;
END //
DELIMITER ;


-- 8. Add Review
DELIMITER //
CREATE PROCEDURE `add_review`(
    IN p_CustomerID INT(11),
    IN p_ProductID INT(11),
    IN p_Rating INT(1),
    IN p_ReviewTitle VARCHAR(255),
    IN p_ReviewText TEXT
)
BEGIN
    INSERT INTO `reviews` (`CustomerID`, `ProductID`, `Rating`, `ReviewTitle`, `ReviewText`)
    VALUES (p_CustomerID, p_ProductID, p_Rating, p_ReviewTitle, p_ReviewText);
END //
DELIMITER ;

-- 9. Get Product Reviews
DELIMITER //
CREATE PROCEDURE `get_product_reviews`(
    IN p_ProductID INT(11)
)
BEGIN
    SELECT * FROM `reviews` WHERE `ProductID` = p_ProductID;
END //
DELIMITER ;

-- 10. Get all products with category name
DELIMITER //
CREATE PROCEDURE `get_all_products_with_category`()
BEGIN
    SELECT p.*, c.CategoryName
    FROM products p
    JOIN categories c ON p.Category = c.CategoryID;
END //
DELIMITER ;

-- 11. Add new admin
DELIMITER //
CREATE PROCEDURE `add_admin`(
    IN p_AdminName VARCHAR(50),
    IN p_Email VARCHAR(40),
    IN p_Password VARCHAR(256),
    IN p_AdminRole INT(11)
)
BEGIN
    INSERT INTO `admin` (`AdminName`, `Email`, `Password`, `AdminRole`)
    VALUES (p_AdminName, p_Email, p_Password, p_AdminRole);
END //
DELIMITER ;

-- 12. Update Admin Role
DELIMITER //
CREATE PROCEDURE `update_admin_role`(
    IN p_AdminID INT(11),
    IN p_AdminRole INT(11)
)
BEGIN
    UPDATE `admin`
    SET `AdminRole` = p_AdminRole
    WHERE `AdminID` = p_AdminID;
END //
DELIMITER ;

-- 13. Delete Admin
DELIMITER //
CREATE PROCEDURE `delete_admin`(
    IN p_AdminID INT(11)
)
BEGIN
    DELETE FROM `admin`
    WHERE `AdminID` = p_AdminID;
END //
DELIMITER ;