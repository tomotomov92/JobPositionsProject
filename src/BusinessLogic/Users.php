<?php

namespace BusinessLogic;
include 'DAL/Users.php';
use DAL;

class Users {
    private $users;

    public function __construct(){
        $this->users = new DAL\Users();
    }

    function getUserForLogin($email, $password, $userType){
        $user = $this->users->getUserForLogin($email);

        if ($user) {
            $isUserActive = boolval($user['IsActive']);
            $userTypeId = intval($user['UserTypeId']);
            $userPassword = $user['Password'];

            if ($isUserActive === true &&
                $userTypeId === $userType &&
                $userPassword === $password){
                return true;
            } else {
                return false;
            }
        }

        return null;
    }
}

?>