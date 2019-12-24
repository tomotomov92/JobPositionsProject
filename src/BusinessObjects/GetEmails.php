<?php
namespace BusinessObjects;
 
 class GetEmails{

 public $IsReceived;
 public $notSent;
 public $id;
 public $fromEmailAddress;
 public $toEmailAddress;
 public $emailSubject;
 public $emailText;
 public $timeOfSending;
 public $isEmailReceived;
 public $errorOnSending;
 
 public function __construct(){
    }
	
	 public static function fromRow($row){
	 $instance = new self();
	 $instance->id = intval($row["Id"]);
	 $instance->fromEmailAddress = $row["FromEmailAddress"];
	 $instance->toEmailAddress = $row["ToEmailAddress"];
	 $instance->emailSubject = $row["EmailSubject"];
     $instance->emailText = $row["EmailText"];
     $instance->timeOfSending = date_parse($row["TimeOfSending"]);
	 $instance->isEmailReceived = boolval($row["IsEmailReceived"]);
	 $instance->errorOnSending = $row["ErrorOnSending"];
	 return $instance;
    }
}
?>