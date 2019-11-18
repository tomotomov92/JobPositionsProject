<?php

namespace DAL;

require_once('DbConnection.php');

class Users {
    private $db = null;
    
    public function __construct(){
        $this->db = DbConnection::getInstance();
    }

    function getUsers(){
        return "getUsers from DAL";
    }
}

?>