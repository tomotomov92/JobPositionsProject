<?php

namespace DAL;

include 'DbConnection.php';

class JobPositions {
    private $db = null;
    
    public function __construct(){
        $this->db = DbConnection::getInstance();
    }

    function getJobPosition($id){

    }

    function getCities() {
        $stmt = $this->db->prepare("SELECT Id, CityName, IsMainCity FROM cities;");
        
        $stmt->execute();

        return $stmt->get_result();
    }
}

?>