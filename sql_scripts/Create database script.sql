CREATE DATABASE IF NOT EXISTS job_offers_db COLLATE cp1251_general_ci;

CREATE USER 'job_offers_user'@'%' IDENTIFIED BY 'pass1234';
GRANT EXECUTE ON `job\_offers\_db`.* TO 'job_offers_user'@'%';

CREATE TABLE IF NOT EXISTS user_types (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    CONSTRAINT user_types_unique UNIQUE (Name)
);

INSERT INTO user_types(Name)
VALUES ('Administrator'), ('Business'), ('User');

CREATE TABLE IF NOT EXISTS password_version (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    AlgorithmName VARCHAR(100) NOT NULL,
    CONSTRAINT password_version_unique UNIQUE (AlgorithmName)
);

INSERT INTO password_version(AlgorithmName)
VALUES ('PlainText');

CREATE TABLE IF NOT EXISTS users (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    EmailAddress VARCHAR(100) NOT NULL,
    Password VARCHAR(200) NOT NULL,
    PasswordSalt VARCHAR(50) NOT NULL,
    PasswordVersionId INT NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    UserTypeId INT NOT NULL,
    TimeOfRegistration DATETIME NOT NULL,
    RequirePasswordChange BIT NOT NULL DEFAULT 0,
    PasswordTriesLeft INT NOT NULL DEFAULT 3,
    IsVerified BIT NOT NULL DEFAULT 0,
    IsActive BIT NOT NULL DEFAULT 1,
    FOREIGN KEY (PasswordVersionId)
        REFERENCES password_version(Id),
    FOREIGN KEY (UserTypeId)
        REFERENCES user_types(Id)
);

CREATE TABLE IF NOT EXISTS user_verification_codes (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    UserId INT NOT NULL,
    VerificationCode VARCHAR(100) NOT NULL,
    TimeOfExpiration DATETIME NOT NULL,
    IsUsed BIT NOT NULL DEFAULT 0,
    FOREIGN KEY (UserId)
        REFERENCES users(Id)
);

INSERT INTO users (EmailAddress, Password, PasswordSalt, PasswordVersionId, FirstName, LastName, UserTypeId, TimeOfRegistration)
VALUES ('admin','admin','',1,'Admin','',1,'1900-01-01 00:00:00.000');

CREATE TABLE IF NOT EXISTS job_positions (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    ParentId INT NULL,
    PositionName VARCHAR(100) NOT NULL,
    PositionDesc VARCHAR(2000) NOT NULL,
    BusinessUserId INT NOT NULL,
    AdministratorUserId INT NOT NULL,
    TimeOfPosting DATETIME NOT NULL,
    IsActial BIT NOT NULL DEFAULT 1,
    IsDeleted BIT NOT NULL DEFAULT 0,
    FOREIGN KEY (ParentId)
        REFERENCES job_positions(Id),
    FOREIGN KEY (BusinessUserId)
        REFERENCES users(Id),
    FOREIGN KEY (AdministratorUserId)
        REFERENCES users(Id)
);

CREATE TABLE IF NOT EXISTS job_sectors (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    CONSTRAINT job_sector_unique UNIQUE (Name)
);

CREATE TABLE IF NOT EXISTS job_position_sectors (
    JobPositionId INT NOT NULL,
    JobSectorId INT NOT NULL,
    PRIMARY KEY (JobPositionId, JobSectorId),
    FOREIGN KEY (JobPositionId)
        REFERENCES job_positions(Id),
    FOREIGN KEY (JobSectorId)
        REFERENCES job_sectors(Id)
);

CREATE TABLE IF NOT EXISTS job_applications (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    JobPositionId INT NOT NULL,
    ApplicationUserId INT NOT NULL,
    ApplicantComment VARCHAR(1000) NULL,
    AttachedFileName VARCHAR(100) NULL,
    AttachedFile BLOB NULL,
    TimeOfApplication DATETIME NOT NULL,
    IsApplicationApproved BIT NOT NULL DEFAULT 0,
    FOREIGN KEY (JobPositionId)
        REFERENCES job_positions(Id),
    FOREIGN KEY (ApplicationUserId)
        REFERENCES users(Id)
);

CREATE TABLE IF NOT EXISTS sent_emails (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    FromEmailAddress VARCHAR(100) NOT NULL,
    ToEmailAddress VARCHAR(100) NOT NULL,
    EmailSubject VARCHAR(100) NOT NULL,
    EmailText VARCHAR(2000) NOT NULL,
    TimeOfSending DATETIME NOT NULL,
    IsEmailReceived BIT NOT NULL DEFAULT 0,
    ErrorOnSending VARCHAR(1000) NULL
);