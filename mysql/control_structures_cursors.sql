# procedure to find the orderid with the largest amount
# could be done with max, but just to illustrate stored procedure principles

DELIMITER //

CREATE PROCEDURE Largest_Order (OUT Largest_ID INT)
BEGIN 
    DECLARE This_ID INT;
    DECLARE This_Amount FLOAT;
    DECLARE L_Amount FLOAT default 0.0;
    DECLARE L_ID INT;

    DECLARE Done INT default 0;
    DECLARE C1 CURSOR for SELECT OrderID, Amount From Orders;
    DECLARE continue handler for sqlstate '02000' SET Done = 1;

    open C1;
    repeat
        fetch C1 into This_ID, This_Amount;
        if not Done then
            if This_Amount > L_Amount then
                set L_Amount = This_Amount;
                set L_ID = This_ID;
            end if;
        end if;
    until Done end repeat;
    close C1;

    set Largest_ID = L_ID;

END
//

DELIMITER ;
