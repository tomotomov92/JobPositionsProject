<?php

namespace DAL;
include 'DbConnection.php';

class Users {
    private $db = null;
    
    public function __construct(){
        $this->db = DbConnection::getInstance();
    }

    function getUserForLogin($email){
        $sql = "CALL GetUserForLoggingIn('$email')";
        $user = $this->db->get_result($sql);
        return $user;
    }
}

?>