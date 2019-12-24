<?php

namespace DAL;

include 'DbConnection.php';

class Emails {
    private $db = null;
    
    public function __construct(){
        $this->db = DbConnection::getInstance();
    }
}

?>