# Basic syntax to create a function

DELIMITER //

CREATE FUNCTION Add_Tax (Price FLOAT) RETURNS FLOAT NO SQL
BEGIN 
DECLARE Tax FLOAT default 0.10;
RETURN Price * (1 + Tax);

END 
//

DELIMITER ;