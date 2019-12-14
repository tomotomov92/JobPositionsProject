<?php

namespace DAL;
include 'DbConnection.php';
include 'BusinessObjects/UserResult.php';

use BusinessObjects;

class Users {
    private $db = null;
    
    public function __construct(){
        $this->db = DbConnection::getInstance();
    }

    function createUser($email, $password, $fName, $lName, $userTypeId, $timeOfReg) {
        $stmt = $this->db->prepare("INSERT INTO users (EmailAddress, Password, FirstName, LastName, UserTypeId, TimeOfRegistration) VALUES (?,?,?,?,?,?);SELECT Id, EmailAddress FROM users WHERE EmailAddress = ?;");

        $stmt->bind_param('ssssiss', $email, $password, $fName, $lName, $userTypeId, $timeOfReg, $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function getUser($email) {
        $stmt = $this->db->prepare("SELECT Id, EmailAddress, Password, FirstName, LastName, UserTypeId, TimeOfRegistration, RequirePasswordChange, PasswordTriesLeft, IsVerified, IsActive FROM users WHERE EmailAddress = ?;");
        
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return BusinessObjects\UserResult::fromRow($row);
        } else {
            return null;
        }
    }

    function updatePasswordTriesLeft($user) {
        $stmt = $this->db->prepare("UPDATE users SET PasswordTriesLeft = ?, IsActive = ? WHERE EmailAddress = ?;");
        
        $stmt->bind_param('iis', $user->passwordTriesLeft, $user->isActive, $user->emailAddress);
        $stmt->execute();
    }

    function deactivateUser($user) {
        $stmt = $this->db->prepare("UPDATE users SET PasswordTriesLeft = ?, IsActive = ? WHERE EmailAddress = ?;");
        
        $passwordTriesLeft = 0;
        $isUserActive = intval(false);
        $stmt->bind_param('iis', $user->passwordTriesLeft, $user->isActive, $user->emailAddress);
        $stmt->execute();
    }

    function activateUser($user) {
        $stmt = $this->db->prepare("UPDATE users SET PasswordTriesLeft = ?, IsActive = ? WHERE EmailAddress = ?;");
        
        $passwordTriesLeft = 3;
        $isUserActive = intval(true);
        $stmt->bind_param('iis', $user->passwordTriesLeft, $user->isActive, $user->emailAddress);
        $stmt->execute();
    }

    function updateUserPassword($user) {
        $stmt = $this->db->prepare("UPDATE users SET Password = ? PasswordTriesLeft = ?, IsActive = ? WHERE EmailAddress = ?;");
        
        $passwordTriesLeft = 3;
        $isUserActive = intval(true);
        $stmt->bind_param('siis', $user->password, $user->passwordTriesLeft, $user->isActive, $user->emailAddress);
        $stmt->execute();
    }
}

?>