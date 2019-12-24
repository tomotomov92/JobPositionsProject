<?php

namespace BusinessLogic;

include 'BusinessObjects/CityResult.php';
include 'BusinessObjects/JobPositionResult.php';
include 'BusinessObjects/User.php';
include 'DAL/JobPositions.php';
include 'DAL/Users.php';

use BusinessObjects;
use BusinessObjects\Constants;
use DAL;

date_default_timezone_set('Europe/Sofia');

class JobPositions {
    private $jobPositionsDAL;
    private $usersDAL;

    public function __construct(){
        $this->jobPositionsDAL = new DAL\JobPositions();
        $this->usersDAL = new DAL\Users();
    }

    function getJobPositionsByCityId($cityId) {
        $rowResults = $this->jobPositionsDAL->getJobPositionsByCityId($cityId);

        if ($rowResults) {
            $jobPositionResults = BusinessObjects\JobPositionResult::fromRows($rowResults);
            foreach($jobPositionResults as $jobPosition) {
                $businessUserRow = $this->usersDAL->getUserById($jobPosition->businessUserId, UserType_Business);
                $businessUser = BusinessObjects\User::fromRow($businessUserRow);

                $administratorUserRow = $this->usersDAL->getUserById($jobPosition->administratorUserId, UserType_Administrator);
                $administratorUser = BusinessObjects\User::fromRow($administratorUserRow);

                $cityRow = $this->jobPositionsDAL->getCityById($jobPosition->cityId);
                $city = BusinessObjects\CityResult::fromRow($cityRow);

                $jobPosition->updateResultValues(0, 0, $businessUser->emailAddress, $administratorUser->emailAddress, $city->cityName);
            }
            return $jobPositionResults;
        }

        return null;
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