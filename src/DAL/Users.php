<?php

namespace DAL;

include_once 'DbConnection.php';

class Users {
    private $db = null;
    
    public function __construct(){
        $this->db = DbConnection::getInstance();
    }

    function createUser($email, $password, $fName, $lName, $userTypeId, $timeOfReg) {
        $stmt = $this->db->prepare("INSERT INTO users (EmailAddress, Password, FirstName, LastName, UserTypeId, TimeOfRegistration) VALUES (?,?,?,?,?,?);");

        $stmt->bind_param('ssssis', $email, $password, $fName, $lName, $userTypeId, $timeOfReg);
        $stmt->execute();
    }

    function getUserById($userId, $userTypeId) {
        $stmt = $this->db->prepare("SELECT Id, EmailAddress, Password, FirstName, LastName, UserTypeId, TimeOfRegistration, RequirePasswordChange, PasswordTriesLeft, IsVerified, IsActive FROM users WHERE Id = ? AND UserTypeId = ?;");
        
        $stmt->bind_param('ii', $userId, $userTypeId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function getUser($email, $userTypeId) {
        $stmt = $this->db->prepare("SELECT Id, EmailAddress, Password, FirstName, LastName, UserTypeId, TimeOfRegistration, RequirePasswordChange, PasswordTriesLeft, IsVerified, IsActive FROM users WHERE EmailAddress = ? AND UserTypeId = ?;");
        
        $stmt->bind_param('si', $email, $userTypeId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function updatePasswordTriesAndIsActiveLeft($emailAddress, $passwordTriesLeft, $isActive, $userTypeId) {
        $stmt = $this->db->prepare("UPDATE users SET PasswordTriesLeft = ?, IsActive = ? WHERE EmailAddress = ? AND UserTypeId = ?;");
        
        $stmt->bind_param('iisi', $passwordTriesLeft, $isActive, $emailAddress, $userTypeId);
        $stmt->execute();
    }

    function updateUserPassword($emailAddress ,$password , $passwordTriesLeft, $isActive, $userTypeId) {
        $stmt = $this->db->prepare("UPDATE users SET Password = ?, PasswordTriesLeft = ?, IsActive = ? WHERE EmailAddress = ? AND UserTypeId = ?;");
        
        $stmt->bind_param('siisi', $password , $passwordTriesLeft, $isActive, $emailAddress, $userTypeId);
        $stmt->execute();
    }

    function updateUserDetails($userId, $emailAddress, $firstName, $lastName, $isVerified) {
        $stmt = $this->db->prepare("UPDATE users SET EmailAddress = ?, FirstName = ?, LastName = ?, IsVerified = ? WHERE Id = ?;");
        
        $stmt->bind_param('siisi', $emailAddress, $firstName, $lastName, $isVerified, $userId);
        $stmt->execute();
    }

    function createVerificationCode($userId, $verificationCode, $timeOfExpiration) {
        $stmt = $this->db->prepare("INSERT INTO user_verification_codes (UserId, VerificationCode, TimeOfExpiration) VALUES (?,?,?);");
        
        $stmt->bind_param('iss', $userId, $verificationCode, $timeOfExpiration);
        $stmt->execute();
    }

    function getVerificationCode($userId) {
        $stmt = $this->db->prepare("SELECT Id, UserId, VerificationCode, TimeOfExpiration, IsUsed, IsValid FROM user_verification_codes WHERE UserId = ? AND IsValid = 1 AND TimeOfExpiration >= NOW();");
        
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function updateVerificationCode($id, $isUsed, $isValid) {
        $stmt = $this->db->prepare("UPDATE user_verification_codes SET IsUsed = ?, IsValid = ? WHERE Id = ?;");
        
        $stmt->bind_param('iii', $isUsed, $isValid, $id);
        $stmt->execute();
    }
}

?>