<?php

class User{

    public $photo;
    public $username;
    public $credits;

    public $friends;

    public $communities;

    public $games;

    public function __construct($username, $credits){
        $this->username = $username;
        $this->credits = $credits;
    }
    

    
}