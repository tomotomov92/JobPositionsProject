<?php

namespace BusinessObjects;

class User {
    public $id;
    public $emailAddress;
    public $password;
    public $firstName;
    public $lastName;
    public $userTypeId;
    public $timeOfRegistration;
    public $requirePasswordChange;
    public $passwordTriesLeft;
    public $isVerified;
    public $isActive;
    
    public function __construct(){
    }
    
    public static function fromRow($row){
        $instance = new self();
        $instance->id = intval($row["Id"]);
        $instance->emailAddress = $row["EmailAddress"];
        $instance->password = $row["Password"];
        $instance->firstName = $row["FirstName"];
        $instance->lastName = $row["LastName"];
        $instance->userTypeId = intval($row["UserTypeId"]);
        $instance->timeOfRegistration = date_parse($row["TimeOfRegistration"]);
        $instance->requirePasswordChange = boolval($row["RequirePasswordChange"]);
        $instance->passwordTriesLeft = intval($row["PasswordTriesLeft"]);
        $instance->isVerified = boolval($row["IsVerified"]);
        $instance->isActive = boolval($row["IsActive"]);
        return $instance;
    }
}

?>