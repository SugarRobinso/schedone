<?php

class User{

    private $photo;
    private $username;
    private $credits;

    private $friends;

    private $communities;

    private $games;

    public function __construct($username, $credits){
        $this->username = $username;
        $this->credits = $credits;
    }
    
    public function getUsername(){
        return $this->username;
    }

    
}