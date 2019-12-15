<?php

namespace BusinessLogic;

include 'BusinessObjects/LoginResult.php';
include 'BusinessObjects/RegistrationResult.php';
include 'BusinessObjects/UpdatePasswordResult.php';
include 'BusinessObjects/User.php';
include 'BusinessObjects/UserVerificationResult.php';
include 'BusinessObjects/VerificationCodeResult.php';
include 'DAL/Users.php';

use BusinessObjects;
use BusinessObjects\Constants;
use DAL;

date_default_timezone_set('Europe/Sofia');

class Users {
    private $usersDAL;

    public function __construct(){
        $this->usersDAL = new DAL\Users();
    }


    // Public functions

    function registerUser($email, $password, $fName, $lName, $userType) {
        // Create user record
        $registrationResult = $this->createUser($email, $password, $fName, $lName, $userType);
        
        // If the user creation is successful generate verification code and send email
        if ($registrationResult->isSuccess) {
            $this->generateAndSendVerificationEmail($email, $userType);
        }

        return $registrationResult;
    }

    function loginUser($email, $password, $userType) {
        $loginResult = new BusinessObjects\LoginResult();

        $user = $this->getUser($email, $userType);
        if ($user) {
            if ($user->isActive) {
                if (password_verify($password, $user->password)) {
                    if ($user->isVerified) {
                        $user->passwordTriesLeft = DefaultPasswordTriesLeft;
                        $this->usersDAL->updatePasswordTriesAndIsActiveLeft($user->emailAddress, $user->passwordTriesLeft, $user->isActive, $user->userTypeId);
                        $loginResult->isSuccess = true;
                    } else {
                        //TODO: Add logic for getting verification address
                        $verificationAddress = "";
                        $loginResult->errorMessage = "You are not verified! Please check your email or <a href='$verificationAddress'>send activation email again</a>.";
                    }
                } else {
                    $user->passwordTriesLeft--;
                    if ($user->passwordTriesLeft > 0) {
                        $loginResult->errorMessage = "Wrong password! You have $user->passwordTriesLeft tries left!";
                    } else {
                        $user->isActive = false;
                        $loginResult->errorMessage = "The user has been deactivated!";
                    }
                    $this->usersDAL->updatePasswordTriesAndIsActiveLeft($user->emailAddress, $user->passwordTriesLeft, $user->isActive, $user->userTypeId);
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

        $user = $this->getUser($email, $userType);
        if ($user) {
            if (password_verify($oldPassword, $user->password)) {
                $user->password = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => PasswordHashCost]);
                $user->passwordTriesLeft = DefaultPasswordTriesLeft;
                $user->isActive = true;
                $this->usersDAL->updateUserPassword($user->emailAddress, $user->password, $user->passwordTriesLeft, $user->isActive, $user->userTypeId);

                $user = $this->getUser($email, $userType);
                if ($user) {
                    if (password_verify($newPassword, $user->password)) {
                        $updatePasswordResult->setUser($user);
                    } else {
                        $updatePasswordResult->errorMessage = "The password was not updated!";
                    }
                } else {
                    $updatePasswordResult->errorMessage = "Something went wrong. Please try again!";
                }
            } else {
                $updatePasswordResult->errorMessage = "Wrong password!";
            }
        } else {
            $updatePasswordResult->errorMessage = "The user name or the password are not valid!";
        }
        return $updatePasswordResult;
    }

    function generateAndSendVerificationEmail($email, $userType) {
        $verificationCode = new BusinessObjects\VerificationCodeResult();

        $user = $this->getUser($email, $userType);
        if ($user) {
            $verificationCode = $this->getVerificationCode($user->emailAddress, $user->userTypeId);
            if ($verificationCode) {
                $verificationCode->isValid = false;
                $this->updateVerificationCode($verificationCode);
            }

            $this->generateVerificationCode($user->id);
            $verificationCode = $this->getVerificationCode($user->emailAddress, $user->userTypeId);
            if ($verificationCode) {
                //TODO: Send email
                $sentEmail = null;
                if ($sentEmail) {

                } else {
                    $verificationCode->errorMessage = "There was a problem sending the email";
                }
            } else {
                $verificationCode->errorMessage = "There was a problem generating the verification code";
            }
        } else {
            $verificationCode->errorMessage = "There was a problem accessing the user";
        }

        return $verificationCode;
    }

    function verifyUser($email, $verificationCode, $userType) {
        $userVerificationResult = new BusinessObjects\UserVerificationResult();

        $user = $this->getUser($email, $userType);
        if ($user) {
            $verificationCodeResult = $this->getVerificationCode($user->emailAddress, $user->userTypeId);
            if ($verificationCode) {
                if ($verificationCodeResult->verificationCode === $verificationCode) {
                    $user->isVerified = true;
                    $this->updateUser($user);

                    $verificationCodeResult->isUsed = true;
                    $verificationCodeResult->isValid = false;
                    $this->updateVerificationCode($verificationCodeResult);

                    $userVerificationResult->isSuccess = true;
                } else {
                    $userVerificationResult->errorMessage = "The verification code is not valid";
                }
            } else {
                $userVerificationResult->errorMessage = "There was a problem accessing the verification code";
            }
        } else {
            $userVerificationResult->errorMessage = "There was a problem accessing the user";
        }
        
        return $userVerificationResult;
    }


    // Private functions

    private function createUser($email, $password, $fName, $lName, $userType) {
        $registrationResult = new BusinessObjects\RegistrationResult();

        $user = $this->getUser($email, $userType);
        if ($user == null) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => PasswordHashCost]);
            $this->usersDAL->createUser($email, $hashedPassword, $fName, $lName, $userType, date('Y-m-d H:i:s'));
            $user = $this->getUser($email, $userType);
            if ($user) {
                $registrationResult->setUser($user);
            } else {
                $registrationResult->errorMessage = "The registration was not successful!";
            }
        } else {
            $registrationResult->errorMessage = "The user already exists!";
        }
        return $registrationResult;
    }

    private function getUser($email, $userType) {
        $rowResult = $this->usersDAL->getUser($email, $userType);
        if ($rowResult) {
            $user = BusinessObjects\User::fromRow($rowResult);
            return $user;
        }

        return null;
    }

    private function updateUser($user) {
        $this->usersDAL->updateUserDetails($user->id, $user->emailAddress, $user->firstName, $user->lastName, $user->isVerified);
    }

    private function generateVerificationCode($userId) {
        $verificationCode = bin2hex(random_bytes(32));
        $this->usersDAL->createVerificationCode($userId, $verificationCode, date('Y-m-d H:i:s', strtotime('+1 day')));
    }

    private function getVerificationCode($email, $userType) {
        $verificationCode = new BusinessObjects\VerificationCodeResult();

        $user = $this->getUser($email, $userType);
        $rowResult = $this->usersDAL->getVerificationCode($user->id);
        if ($rowResult) {
            $verificationCode = BusinessObjects\VerificationCodeResult::fromRow($rowResult);
            return $verificationCode;
        }

        return null;
    }

    private function updateVerificationCode($verificationCode) {
        $this->usersDAL->updateVerificationCode($verificationCode->id, $verificationCode->isUsed, $verificationCode->isValid);
    }
}

?>