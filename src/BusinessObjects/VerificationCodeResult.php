<?php

namespace BusinessObjects;

include_once 'BusinessObjects/BaseResult.php';

class VerificationCodeResult extends BaseResult {
    public $id;
    public $userId;
    public $verificationCode;
    public $timeOfExpiration;
    public $isUsed;
    public $isValid;
    
    public function __construct(){
        $this->isSuccess = false;
        $this->errorMessage = "";
    }
    
    public static function fromRow($row){
        $instance = new self();
        if ($row) {
            $instance->isSuccess = true;
            $instance->id = intval($row["Id"]);
            $instance->userId = intval($row["UserId"]);
            $instance->verificationCode = $row["VerificationCode"];
            $instance->timeOfExpiration = date_parse($row["TimeOfExpiration"]);
            $instance->isUsed = boolval($row["IsUsed"]);
            $instance->isValid = boolval($row["IsValid"]);
        } else {
            $instance->errorMessage = "There was a problem accessing the verification code";
        }
        return $instance;
    }
}

?>