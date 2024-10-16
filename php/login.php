<?php

// Include the database class file
include "./SessionManager.php";

// Start a session to store errors or user data
session_start();

$parameterList = [
    'mail' => isset($_POST['mail']) ? $_POST['mail'] : '',
    'password' => isset($_POST['psw']) ? $_POST['psw'] : ''
];



$sessionManager = new SessionManager();

try {
    $sessionManager->login($parameterList);

} catch (Exception $e) {
    // If an exception occurs, display the error message
    echo $e->getMessage() . "<br>";
}
