<?php

namespace BusinessObjects;

class CityResult {
    public $id;
    public $cityName;
    public $isMainCity;

    public function __construct() {
    }
    
    public static function fromRow($row) {
        $instance = new self();
        $instance->id = intval($row["Id"]);
        $instance->cityName = $row["CityName"];
        $instance->isMainCity = $row["IsMainCity"];
        return $instance;
    }

    public static function fromRows($rows) {
        $citiesArray = array();

        $i = 0;
        while($row = $rows->fetch_assoc()) {
            $citiesArray[$i] = CityResult::fromRow($row);
            $i++;
        }

        return $citiesArray;
    }
}

?>