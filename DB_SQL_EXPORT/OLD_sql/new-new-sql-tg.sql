-- Triggers

-- 1. After Product Insert (Log the new product)
DELIMITER //
CREATE TRIGGER `after_product_insert`
AFTER INSERT ON `products`
FOR EACH ROW
BEGIN
    INSERT INTO `product_audit` (ProductID, ProductName, Action, Timestamp)
    VALUES (NEW.ProductID, NEW.ProductName, 'INSERT', NOW());
END //
DELIMITER ;

-- 2. After Product Update (Log the updated product)
DELIMITER //
CREATE TRIGGER `after_product_update`
AFTER UPDATE ON `products`
FOR EACH ROW
BEGIN
    INSERT INTO `product_audit` (ProductID, ProductName, Action, Timestamp)
    VALUES (NEW.ProductID, NEW.ProductName, 'UPDATE', NOW());
END //
DELIMITER ;

-- 3. Before Product Delete (Log the deleted product)
DELIMITER //
CREATE TRIGGER `before_product_delete`
BEFORE DELETE ON `products`
FOR EACH ROW
BEGIN
    INSERT INTO `product_audit` (ProductID, ProductName, Action, Timestamp)
    VALUES (OLD.ProductID, OLD.ProductName, 'DELETE', NOW());
END //
DELIMITER ;

-- 4. After Order Insert (Update total amount in orderpayment)
DELIMITER //
CREATE TRIGGER `after_order_insert`
AFTER INSERT ON `customerorder`
FOR EACH ROW
BEGIN
    DECLARE total DECIMAL(10,2) DEFAULT 0;
    SELECT SUM(PriceAtOrder * Quantity) INTO total FROM order_items WHERE OrderID = NEW.OrderID;
    INSERT INTO orderpayment (OrderID, TotalAmount, PaymentMethod) VALUES (NEW.OrderID, total, 'To be defined'); -- You'll need to define how you get the payment method
END //
DELIMITER ;

-- 5. Before Product Update (Check stock before update)
DELIMITER //
CREATE TRIGGER `before_product_update_stock_check`
BEFORE UPDATE ON `products`
FOR EACH ROW
BEGIN
    IF NEW.QtyInStock < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Not enough stock available!';
    END IF;
END //
DELIMITER ;

-- 6. After Review Insert (You could potentially use this to update product rating if you track average rating in the products table)
DELIMITER //
CREATE TRIGGER `after_review_insert`
AFTER INSERT ON `reviews`
FOR EACH ROW
BEGIN
    -- This is an example; you'd need to adapt it to your specific needs
    -- UPDATE products SET AverageRating = (SELECT AVG(Rating) FROM reviews WHERE ProductID = NEW.ProductID) WHERE ProductID = NEW.ProductID;
END //
DELIMITER ;

-- Audit Table (for product changes)
CREATE TABLE `product_audit` (
    `AuditID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ProductID` INT(11) UNSIGNED NOT NULL,
    `ProductName` TEXT NOT NULL,
    `Action` VARCHAR(20) NOT NULL,  -- 'INSERT', 'UPDATE', 'DELETE'
    `Timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Example: Trigger to prevent adding same product to cart/wishlist twice
DELIMITER //
CREATE TRIGGER `before_cart_insert`
BEFORE INSERT ON `cart`
FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM cart WHERE CustomerID = NEW.CustomerID AND ProductID = NEW.ProductID) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Product already in cart!';
    END IF;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER `before_wishlist_insert`
BEFORE INSERT ON `wishlist`
FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM wishlist WHERE CustomerID = NEW.CustomerID AND ProductID = NEW.ProductID) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Product already in wishlist!';
    END IF;
END //
DELIMITER ;