# Trigger example

DELIMITER //

#delete order_items before order to avoid referential integrity error
CREATE TRIGGER Delete_Order_Items
BEFORE DELETE ON Orders
for each row
BEGIN 
 DELETE FROM order_items where old.orderid = orderid;
END 
//