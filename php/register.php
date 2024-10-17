<?php

session_start();
require_once "./SessionManager.php";


$parameterList = [
    'mail' => isset($_POST['mail']) ? $_POST['mail'] : '',
    'password' => isset($_POST['password']) ? $_POST['password'] : '',
    'username' => isset($_POST['username']) ? $_POST['username'] : '',
];

try {

    $sessionManager = new SessionManager();

    $sessionManager->register($parameterList);

    echo "User created successfully.";



} catch (Exception $e) {
    echo $e->getMessage();
}finally{
    $database->disconnect();
}