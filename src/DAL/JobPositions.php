<?php

namespace DAL;

require_once('DbConnection.php');

class JobPositions {
    private $db = null;
    
    public function __construct(){
        $this->db = DbConnection::getInstance();
    }
}

?>