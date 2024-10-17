<?php

// Include the database class file
require_once "./SessionManager.php";

// Start a session to store errors or user data
session_start();

$parameterList = [
    'mail' => isset($_POST['mail']) ? $_POST['mail'] : '',
    'password' => isset($_POST['psw']) ? $_POST['psw'] : ''
];




try {
    $sessionManager = new SessionManager();
    $sessionManager->login($parameterList);

    $_SESSION['sessionManager'] = serialize($sessionManager);
    header('location: home.php');

} catch (Exception $e) {
    // If an exception occurs, display the error message
    echo $e->getMessage() . "<br>";
}
