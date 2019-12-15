<?php

namespace DAL;

include 'DbConnection.php';

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
}

?>