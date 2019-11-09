CREATE TABLE IF NOT EXISTS user_verification_codes (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    UserId INT NOT NULL,
    VerificationCode VARCHAR(100) NOT NULL,
    TimeOfExpiration DATETIME NOT NULL,
    IsUsed BIT NOT NULL DEFAULT 0,
    FOREIGN KEY (UserId)
        REFERENCES users(Id)
);