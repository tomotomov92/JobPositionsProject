<?php

namespace BusinessObjects;

include_once 'BusinessObjects/BaseResult.php';

class RegistrationResult extends BaseResult {
    public $user;
    
    public function __construct() {
        $this->isSuccess = false;
        $this->errorMessage = "";
    }
    
    public function setUser($user) {
        $this->isSuccess = true;
        $this->user = $user;
        return $this;
    }
}

?>