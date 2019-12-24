<?php

namespace BusinessLogic;

include 'BusinessObjects/CityResult.php';
include 'DAL/JobPositions.php';

use BusinessObjects;
use BusinessObjects\Constants;
use DAL;

date_default_timezone_set('Europe/Sofia');

class JobPositions {
    private $jobPositionsDAL;

    public function __construct(){
        $this->jobPositionsDAL = new DAL\JobPositions();
    }


    // Public functions

    function getAllCities() {
        $rowResults = $this->jobPositionsDAL->getCities();

        if ($rowResults) {
            $cityResults = BusinessObjects\CityResult::fromRows($rowResults);
            return $cityResults;
        }

        return null;
    }
}
?>