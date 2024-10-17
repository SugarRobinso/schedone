<?php


require_once "./database.php";
require_once "./User.php";

class SessionManager{

    private $DB;
    private $currentUser;

    public function __construct(){
        $this->DB = new Database();
        session_start();
    }

    public function login($parameterList){

        try{

            $this->DB->connect();

            $result = $this->DB->querySelect("LOGIN", $parameterList);

            // If the password is incorrect, set an error message and redirect to the index page
            if (empty($result)) {
                $_SESSION['credentialError'] = 'Invalid Credentials. Try again.';
                header('Location: ../index.php');  // Redirect to the login page
                $this->DB->disconnect();
                exit();  // Exit the script to prevent further execution
            }

            $this->DB->disconnect();

            $this->createUser($result[0]);

        }
        catch(Exception $e){
            $this->DB->disconnect();
        }
    }

    public function register($parameterList){
        try{

            $this->DB->connect();

            $result = $this->DB->querySelect('REGISTER',$parameterList);

            if(!empty($result)) {
                $_SESSION['registerError'] = 'User already exists';
                header('Location: ../index.php');
                exit();
            }

            $this->DB->queryInsert('REGISTER', $parameterList);
        }
        catch(Exception $e){
            $this->DB->disconnect();
        }
    }

    public function createUser($usernameDetails){
        try{
            $username = $usernameDetails['username'];
            $credits = $usernameDetails['credits'];

            $this->currentUser = new User($username, $credits);
        }
        catch(Exception $e){

        }
    }

    public function getUsername(){
        return $this->currentUser->username;
    }


}