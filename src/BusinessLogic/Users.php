<?php

namespace BusinessLogic;

use DAL;

require_once($_SERVER['DOCUMENT_ROOT'].'/DAL/Users.php');

class Users {
    private $users;

    public function __construct(){
        $this->users = new DAL\Users();
    }

    function getUsers(){
        return $this->users->getUsers();
    }
}

?>