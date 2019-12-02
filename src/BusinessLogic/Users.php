<?php

namespace BusinessLogic;
include 'DAL/Users.php';
use DAL;

class Users {
    private $users;

    public function __construct(){
        $this->users = new DAL\Users();
    }

    function createUser($email, $password, $passwordSalt, $fName, $lName, $userTypeId) {
        $user = $this->users->createUser($email, $password, $passwordSalt, $fName, $lName, $userTypeId, date('Y-m-d h:i:s', time()));
        // TODO: Add logic
    }

    function getUserForLogin($email, $password, $userType) {
        $user = $this->users->getUserForLogin($email);

        if ($user) {
            $isUserActive = boolval($user['IsActive']);
            $userTypeId = intval($user['UserTypeId']);
            $userPassword = $user['Password'];

            if ($isUserActive === true &&
                $userTypeId === $userType &&
                $userPassword === $password){
                echo "logged in";
                return true;
            } else {
                echo "not logged in";
                return false;
            }
        }

        echo "problems logging in"; 
        return null;
    }
}

?>