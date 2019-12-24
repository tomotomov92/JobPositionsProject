<?php

namespace BusinessObjects;

include_once 'BusinessObjects/BaseResult.php';

class UserVerificationResult extends BaseResult {    
    public function __construct(){
        $this->isSuccess = false;
        $this->errorMessage = "";
    }
}

?>