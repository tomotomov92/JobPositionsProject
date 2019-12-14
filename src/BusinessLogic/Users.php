<?php

namespace BusinessLogic;
include 'BusinessObjects/LoginResult.php';
include 'DAL/Users.php';
use BusinessObjects;
use DAL;

class Users {
    private $usersDAL;

    public function __construct(){
        $this->usersDAL = new DAL\Users();
    }

    function createUser($email, $password, $fName, $lName, $userTypeId) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $user = $this->usersDAL->createUser($email, $hashedPassword, $fName, $lName, $userTypeId, date('Y-m-d h:i:s', time()));
        return $user;
    }

    function updateUserPassword($email, $oldPassword, $newPassword) {

    }

    function loginUser($email, $password, $userType) {
        $loginResult = new BusinessObjects\LoginResult();
        $user = $this->usersDAL->getUser($email);

        if ($user) {
            if ($user->isActive === true) {
                if ($user->userTypeId === $userType &&
                    $user->password === $password) {
                    $user->passwordTriesLeft = 3;
                    $this->usersDAL->updatePasswordTriesLeft($user);
                    $loginResult->isSuccess = true;
                } else {
                    $user->passwordTriesLeft--;
                    if ($user->passwordTriesLeft > 0) {
                        $this->usersDAL->updatePasswordTriesLeft($user);
                        $loginResult->errorMessage = "Wrong password! You have $user->passwordTriesLeft tries left!";
                    } else {
                        $user->isActive = false;
                        $this->usersDAL->deactivateUser($user);
                        $loginResult->errorMessage = "The user is deactivated!";
                    }
                }
            } else {
                $loginResult->errorMessage = "The user is not active!";
            }
        } else {
            $loginResult->errorMessage = "The user name or the password are not valid!";
        }

        return $loginResult;
    }
}

?>