<?php

include 'BusinessLogic/Users.php';

class UsersController {
    private $users;

    public function __construct(){
        $this->users = new BusinessLogic\Users();
    }

    function createUser($email, $password, $passwordSalt, $passwordVersionId, $fName, $lName, $userTypeId) {
        $result = $this->users->createUser($email, $password, $passwordSalt, $passwordVersionId, $fName, $lName, $userTypeId);
        // TODO: Add logic
    }

    function getUserForLogin($email, $password, $userType) {
        $result = $this->users->getUserForLogin($email, $password, $userType);

        if ($result === true) {
            echo "logged in";
        } elseif ($result === false) {
            echo "not logged in";
        } else {
            echo "problems logging in"; 
        }
    }
}

?>