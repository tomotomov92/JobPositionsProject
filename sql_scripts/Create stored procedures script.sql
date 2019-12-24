DELIMITER $$
CREATE PROCEDURE insert_email(
    IN sender VARCHAR(50),
    IN receiver VARCHAR(50),
    IN subject VARCHAR(250),
    IN emailText VARCHAR(250),
    IN IsReceived TINYINT(1),
    IN notSent TINYINT(1)
)
BEGIN
    INSERT INTO sent_emails(
        FromEmailAddress,
        ToEmailAddress,
        EmailSubject,
        EmailText,
        TimeOfSending,
        IsEmailReceived,
        ErrorOnSending
    )
    VALUES(sender,
           receiver,
           subject,
           emailText,
           NOW()
           IsReceived,
           notSent
    )
END$$

DELIMETER ;


DELIMITER $$
CREATE PROCEDURE update_email( 
	IN intId Int, 
	IN IsReceived TINYINT(1), 
	IN IsSent TINYINT(1) 
) 
BEGIN
    UPDATE sent_emails 
    	SET IsEmailReceived = IsReceived, 
    	    ErrorOnSending = IsSent, 
    	    TimeOfSending = NOW() 
    	Where Id = intId
END$$

DELIMETER ;
CREATE PROCEDURE GetUserForLoggingIn(IN email VARCHAR(100))
BEGIN
    SELECT Id, EmailAddress, Password, UserTypeId, IsActive FROM users WHERE EmailAddress = email;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE CreateUser(IN email VARCHAR(100), IN pass VARCHAR(200), IN fName VARCHAR(50), IN lName VARCHAR(50), IN userTypeId INT, IN timeOfReg DATETIME)
BEGIN
    INSERT INTO users (EmailAddress, Password, FirstName, LastName, UserTypeId, TimeOfRegistration)
    VALUES (email,pass,fName,lName,userTypeId,timeOfReg);

    SELECT Id, EmailAddress FROM users WHERE EmailAddress = email;
END$$
DELIMITER ;
