<?php
namespace BusinessObjects;
include_once 'BusinessObjects/BaseResult.php';
class SendEmailResult extends BaseResult {
    public $email;
    
    public function __construct(){
        $this->isSuccess = false;
        $this->errorMessage = "";
    }
    
    public function setEmail($email){
        $this->isSuccess = true;
        $this->email = $email;
        return $this;
    }
}
