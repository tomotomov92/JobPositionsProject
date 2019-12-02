DELIMITER $$
CREATE PROCEDURE GetUserForLoggingIn(IN email VARCHAR(100))
BEGIN
    SELECT Id, EmailAddress, Password, PasswordSalt, UserTypeId, IsActive FROM users WHERE EmailAddress = email;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE CreateUser(IN email VARCHAR(100), IN pass VARCHAR(200), IN passSalt VARCHAR(50), IN fName VARCHAR(50), IN lName VARCHAR(50), IN userTypeId INT, IN timeOfReg DATETIME)
BEGIN
    INSERT INTO users (EmailAddress, Password, PasswordSalt, FirstName, LastName, UserTypeId, TimeOfRegistration)
    VALUES (email,pass,passSalt,fName,lName,userTypeId,timeOfReg);

    SELECT Id, EmailAddress FROM users WHERE EmailAddress = email;
END$$
DELIMITER ;