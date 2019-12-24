<?php

namespace DAL;

include_once 'DbConnection.php';

class JobPositions {
    private $db = null;
    
    public function __construct(){
        $this->db = DbConnection::getInstance();
    }

    function getJobPosition($id){

    }

    function getJobPositionsByCityId($cityId) {
        $stmt = $this->db->prepare("SELECT Id, ParentId, PositionName, PositionDesc, BusinessUserId, AdministratorUserId, CityId, TimeOfPosting, IsActual, IsDeleted FROM job_positions WHERE CityId = ? AND IsDeleted = false;");
        
        $stmt->bind_param('i', $cityId);
        $stmt->execute();

        return $stmt->get_result();
    }

    function getJobSectors() {
        $stmt = $this->db->prepare("SELECT Id, Name FROM job_sectors;");
        
        $stmt->execute();

        return $stmt->get_result();
    }

    function getJobSectorById($jobSectorId) {
        $stmt = $this->db->prepare("SELECT Id, Name FROM job_sectors WHERE Id = ?;");
        
        $stmt->bind_param('i', $cityId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function getCities() {
        $stmt = $this->db->prepare("SELECT Id, CityName, IsMainCity FROM cities;");
        
        $stmt->execute();

        return $stmt->get_result();
    }

    function getCityById($cityId) {
        $stmt = $this->db->prepare("SELECT Id, CityName, IsMainCity FROM cities WHERE Id = ?;");
        
        $stmt->bind_param('i', $cityId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}

?>