<?php

include "./database.php" ;

session_start();

$mail = isset($_POST['mail']) ? $_POST['mail'] : '';
$password = isset($_POST['psw']) ? $_POST['psw'] : '';




$database = new Database();

try{
    $database->connect();

    $query = "SELECT * FROM users WHERE mail='$mail'";

    $result = $database->query($query);

    if(!$result){
        $_SESSION['mailError'] = 'Mail not found. Try again.';
        header('Location: ../index.php');
        exit();
    }
    unset($_SESSION['mailError']);

    $query = "SELECT * FROM users WHERE psw='$password'";
    $result = $database->query($query);

    if(!$result){
        $_SESSION['pswError'] = 'Incorrect password. Try again.';
        header('Location: ../index.php');
        exit();
    }
    unset($_SESSION['pswError']);


        
    
}catch(Exception $e){
    echo "". $e->getMessage() ."<br>";
}finally{
    $database->disconnect();
}

