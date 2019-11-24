DELIMITER $$
CREATE PROCEDURE GetUserForLoggingIn(IN email VARCHAR(100)) READS SQL DATA
BEGIN
    SELECT Id, EmailAddress, Password, PasswordSalt, PasswordVersionId, UserTypeId, IsActive FROM users WHERE EmailAddress = email;
END$$
DELIMITER ;