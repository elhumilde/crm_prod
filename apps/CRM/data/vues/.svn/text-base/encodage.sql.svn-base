delimiter //
DROP PROCEDURE IF EXISTS convert_database_to_utf8 //

CREATE PROCEDURE convert_database_to_utf8()
BEGIN
    DECLARE table_name VARCHAR(255);
    DECLARE done INT DEFAULT FALSE;

    DECLARE cur CURSOR FOR
        SELECT t.table_name FROM information_schema.tables t WHERE t.table_schema = DATABASE() AND t.table_type='BASE TABLE';
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;
        tables_loop: LOOP
            FETCH cur INTO table_name;

            IF done THEN
                LEAVE tables_loop;
            END IF;

            SET @sql = CONCAT("ALTER TABLE ", table_name, " CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
            PREPARE stmt FROM @sql;
            EXECUTE stmt;
            DROP PREPARE stmt;
            
            SET @sql = CONCAT("ALTER TABLE ", table_name, " DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
            PREPARE stmt FROM @sql;
            EXECUTE stmt;
            DROP PREPARE stmt;
            
        END LOOP;
    CLOSE cur;
END //

