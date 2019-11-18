<?php

require_once('BusinessLogic/Users.php');

class UsersController {
    private $users;

    public function __construct(){
        $this->users = new BusinessLogic\Users();
    }

    function getUsers(){
        return $this->users->getUsers();
    }
}

?>