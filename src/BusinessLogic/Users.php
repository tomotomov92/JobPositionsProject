<?php

namespace BusinessLogic;

include 'BusinessObjects/LoginResult.php';
include 'BusinessObjects/RegistrationResult.php';
include 'BusinessObjects/UpdatePasswordResult.php';
include 'BusinessObjects/User.php';
include 'DAL/Users.php';

use BusinessObjects;
use BusinessObjects\Constants;
use DAL;

class Users {
    private $usersDAL;

    public function __construct(){
        $this->usersDAL = new DAL\Users();
    }

    function createUser($email, $password, $fName, $lName, $userType) {
        $registrationResult = new BusinessObjects\RegistrationResult();

        $rowResult = $this->usersDAL->getUser($email, $userType);
        if ($rowResult == null) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => PasswordHashCost]);
            $this->usersDAL->createUser($email, $hashedPassword, $fName, $lName, $userType, date('Y-m-d h:i:s', time()));
            $user = $this->usersDAL->getUser($email, $userType);
            if ($user) {
                $user = BusinessObjects\User::fromRow($user);
                $registrationResult->setUser($user);
            } else {
                $registrationResult->errorMessage = "The registration was not successful!";
            }
        } else {
            $registrationResult->errorMessage = "The user already exists!";
        }
        return $registrationResult;
    }

    function loginUser($email, $password, $userType) {
        $loginResult = new BusinessObjects\LoginResult();

        $rowResult = $this->usersDAL->getUser($email, $userType);
        if ($rowResult) {
            $user = BusinessObjects\User::fromRow($rowResult);
            if ($user->isActive === true) {
                if (password_verify($password, $user->password)) {
                    $user->passwordTriesLeft = DefaultPasswordTriesLeft;
                    $this->usersDAL->updatePasswordTriesAndIsActiveLeft($user->emailAddress, $user->passwordTriesLeft, $user->isActive, $user->userTypeId);
                    $loginResult->isSuccess = true;
                } else {
                    $user->passwordTriesLeft--;
                    if ($user->passwordTriesLeft > 0) {
                        $this->usersDAL->updatePasswordTriesAndIsActiveLeft($user->emailAddress, $user->passwordTriesLeft, $user->isActive, $user->userTypeId);
                        $loginResult->errorMessage = "Wrong password! You have $user->passwordTriesLeft tries left!";
                    } else {
                        $user->isActive = false;
                        $this->usersDAL->updatePasswordTriesAndIsActiveLeft($user->emailAddress, $user->passwordTriesLeft, $user->isActive, $user->userTypeId);
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

    function updateUserPassword($email, $oldPassword, $newPassword, $userType) {
        $updatePasswordResult = new BusinessObjects\UpdatePasswordResult();

        $rowResult = $this->usersDAL->getUser($email, $userType);
        if ($rowResult) {
            $user = BusinessObjects\User::fromRow($rowResult);
            if (password_verify($oldPassword, $user->password)) {
                $user->password = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => PasswordHashCost]);
                $user->passwordTriesLeft = DefaultPasswordTriesLeft;
                $user->isActive = true;
                $this->usersDAL->updateUserPassword($user->emailAddress, $user->password, $user->passwordTriesLeft, $user->isActive, $user->userTypeId);

                $rowResult = $this->usersDAL->getUser($email, $userType);
                $user = BusinessObjects\User::fromRow($rowResult);
                if (password_verify($newPassword, $user->password)) {
                    $updatePasswordResult->setUser($user);
                } else {
                    $updatePasswordResult->errorMessage = "The password was not updated!";
                }
            } else {
                $updatePasswordResult->errorMessage = "Wrong password!";
            }
        } else {
            $updatePasswordResult->errorMessage = "The user name or the password are not valid!";
        }
        return $updatePasswordResult;
    }
}

?>