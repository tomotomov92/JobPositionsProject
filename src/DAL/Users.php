<?php

namespace DAL;
include 'DbConnection.php';

class Users {
    private $db = null;
    
    public function __construct(){
        $this->db = DbConnection::getInstance();
    }

    function createUser($email, $password, $passwordSalt, $fName, $lName, $userTypeId, $timeOfReg) {
        $stmt = $this->db->prepare("CALL CreateUser(?,?,?,?,?,?,?)");
        var_dump($stmt);
        $stmt->bind_param('sssssis', $email, $password, $passwordSalt, $fName, $lName, $userTypeId, $timeOfReg);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function getUserForLogin($email) {
        $stmt = $this->db->prepare("CALL GetUserForLoggingIn(?)");
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}

?>