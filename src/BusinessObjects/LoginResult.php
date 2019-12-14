<?php

namespace BusinessObjects;

class LoginResult {
    public $isSuccess;
    public $errorMessage;
    
    public function __construct(){
        $this->isSuccess = false;
        $this->errorMessage = "";
    }
}

?>