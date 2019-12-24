<?php

namespace BusinessObjects;

class JobPositionResult {
    public $id;
    public $parentId;
    public $positionName;
    public $positionDesc;
    public $jobSectorIds;//
    public $jobSectorNames;//
    public $businessUserId;
    public $businessUserName;
    public $administratorUserId;
    public $administratorUserName;
    public $cityId;
    public $cityName;//
    public $timeOfPosting;
    public $isActual;
    public $isDeleted;

    public function __construct() {
    }

    public function updateResultValues($jobSectorIds, $jobSectorNames, $businessUserName, $administratorUserName, $cityName) {
        $this->jobSectorIds = $jobSectorIds;
        $this->jobSectorNames = $jobSectorNames;
        $this->businessUserName = $businessUserName;
        $this->administratorUserName = $administratorUserName;
        $this->cityName = $cityName;
    }
    
    public static function fromRow($row) {
        $instance = new self();
        $instance->id = intval($row["Id"]);
        $instance->parentId = $row["ParentId"];
        $instance->positionName = $row["PositionName"];
        $instance->positionDesc = $row["PositionDesc"];
        $instance->businessUserId = $row["BusinessUserId"];
        $instance->administratorUserId = $row["AdministratorUserId"];
        $instance->cityId = $row["CityId"];
        $instance->timeOfPosting = $row["TimeOfPosting"];
        $instance->isActual = $row["IsActual"];
        $instance->isDeleted = $row["IsDeleted"];
        return $instance;
    }

    public static function fromRows($rows) {
        $jobPositionsArray = array();

        $i = 0;
        while($row = $rows->fetch_assoc()) {
            $jobPositionsArray[$i] = JobPositionResult::fromRow($row);
            $i++;
        }

        return $jobPositionsArray;
    }
}

?>