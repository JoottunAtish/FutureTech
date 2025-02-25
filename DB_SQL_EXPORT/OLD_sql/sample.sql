DELIMITER $$

CREATE PROCEDURE `CreateOrder`(
    IN `in_CustomerID` INT,
    IN `in_OrderList` JSON,
    IN `in_PaymentMethod` VARCHAR(20),
    IN `in_TotalAmount` DECIMAL(10, 2)
)
BEGIN
    DECLARE `v_OrderID` INT;
    DECLARE `v_ProductID` INT;
    DECLARE `v_Qty` INT;
    DECLARE `v_Price` DECIMAL(10, 2);
    DECLARE `done` INT DEFAULT 0;
    
    -- Start transaction
    START TRANSACTION;

    -- Insert the order into the customerorder table
    INSERT INTO `customerorder` (`CustomerID`, `OrderList`)
    VALUES (in_CustomerID, in_OrderList);
    
    -- Get the last inserted OrderID
    SET `v_OrderID` = LAST_INSERT_ID();
    
    -- Insert the payment information into the orderpayment table
    INSERT INTO `orderpayment` (`OrderID`, `TotalAmount`, `PaymentMethod`)
    VALUES (v_OrderID, in_TotalAmount, in_PaymentMethod);

    -- Loop through the OrderList JSON to insert products into the orderproduct table
    DECLARE product_cursor CURSOR FOR 
        SELECT `ProductID`, `Qty`, `Price` FROM JSON_TABLE(in_OrderList, "$[*]" 
            COLUMNS ( 
                ProductID INT PATH "$.ProductID",
                Qty INT PATH "$.Qty",
                Price DECIMAL(10, 2) PATH "$.Price"
            )
        ) AS order_items;

    -- Open cursor
    OPEN product_cursor;

    -- Loop through products in the order
    read_loop: LOOP
        FETCH product_cursor INTO v_ProductID, v_Qty, v_Price;
        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Insert product into the orderproduct table
        INSERT INTO `orderproduct` (`OrderID`, `ProductID`, `qty`, `price`)
        VALUES (v_OrderID, v_ProductID, v_Qty, v_Price);

        -- Update the stock quantity
        UPDATE `products` 
        SET `QtyInStock` = `QtyInStock` - v_Qty 
        WHERE `ProductID` = v_ProductID;
    END LOOP;

    -- Close cursor
    CLOSE product_cursor;

    -- Commit the transaction
    COMMIT;

END$$

DELIMITER ;
