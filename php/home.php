<?php

require_once "./SessionManager.php";

session_start();


if(isset($_SESSION['sessionManager'])){

    $sessionManager = unserialize($_SESSION['sessionManager']);

    echo'I have an object <br>';

    echo htmlspecialchars($sessionManager->getUsername());

    unset($_SESSION['sessionManager']);

}

