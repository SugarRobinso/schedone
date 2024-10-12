<?php

session_start();
include "./database.php";


$username = isset($_POST['username']) ? $_POST['username'] : '';
$mail = isset($_POST['mail']) ? $_POST['mail'] : '';
$password = isset($_POST['password']) ? $_POST['password'] :'';


try {

    $database = new Database();

    $database->connect();

    $query = "SELECT * FROM users WHERE mail='$mail'";
    $result = $database->query($query);

    if($result) {
        $_SESSION['registerMailError'] = 'Mail already exists';
        header('Location: ../index.php');
        exit();
    }

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $database->query($query);

    if($result) {
        $_SESSION['registerUsernameError'] = 'Username already exists';
        header('Location: ../index.php');
        exit();
    }

    $database->insertUser($username,$mail,$password);

    echo "User created successfully.";



} catch (Exception $e) {
    echo $e->getMessage();
}finally{
    $database->disconnect();
}