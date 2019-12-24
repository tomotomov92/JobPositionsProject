<?php

namespace BusinessLogic;
include 'BusinessObjects/GetEmails.php';
include 'BusinessObjects/SendEmailResult.php';
include 'DAL/EmailsDAL.php';

use BusinessObjects;
use DAL;
date_default_timezone_set('Europe/Sofia');

class EmailsBL{
    private $usersDAL;
    public function __construct(){
        $this->emailsDAL = new DAL\Emails();
    }

    private function sendEmail($sender,$receiver, $subject, $emailsText,$isReceived, $notSent) {
        $sendingResult =  new BusinessObjects\SendEmailResult();
        $sendingResult = $this->emailsDAL->sendEmail($sender, $receiver, $subject, $emailsText, $isReceived, $notSent);
        if($sendingResult){
            $email = BusinessObjects\SendEmailResult::fromRow($sendingResult);
            return $email;
        } else{
            $sendingResult->errorMessage = "Sending the email was not successful!";
        }
        return $sendingResult;
    }

    private function deleteEmail($intId, $isDeleted){
         $this->emailsDAL->deleteEmail($intId, $isDeleted);
     }
    
    public function getEmail() {
        $getEmailResult =  new BusinessObjects\GetEmails();
        $rowResult = $this->emailsDAL->getEmail();
        if ($rowResult) {
            $getEmailResult = BusinessObjects\GetEmails::fromRow($rowResult);
            return $getEmailResult;
        }
        return null;
    }
}

?>