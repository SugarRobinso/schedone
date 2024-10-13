<?php

// Include the database class file
include "./database.php";

// Start a session to store errors or user data
session_start();

// Get the 'mail' and 'psw' (password) from the POST request if they exist, otherwise set them to empty strings
$mail = isset($_POST['mail']) ? $_POST['mail'] : '';
$password = isset($_POST['psw']) ? $_POST['psw'] : '';

// Create a new instance of the Database class
$database = new Database();

try {
    // Connect to the database
    $database->connect();

    // Query the database to check if a user with the provided email exists
    $query = "SELECT * FROM users WHERE mail='$mail'";
    $result = $database->query($query);

    // If no result is found for the email, set an error message and redirect to the index page
    if (!$result) {
        $_SESSION['mailError'] = 'Mail not found. Try again.';
        header('Location: ../index.php');  // Redirect to the login page
        exit();  // Exit the script to prevent further execution
    }
    // If the email is found, remove any existing email error message from the session
    unset($_SESSION['mailError']);

    // Query the database to check if the password matches
    $query = "SELECT * FROM users WHERE psw='$password'";
    $result = $database->query($query);

    // If the password is incorrect, set an error message and redirect to the index page
    if (!$result) {
        $_SESSION['pswError'] = 'Incorrect password. Try again.';
        header('Location: ../index.php');  // Redirect to the login page
        exit();  // Exit the script to prevent further execution
    }
    // If the password is correct, remove any existing password error message from the session
    unset($_SESSION['pswError']);

} catch (Exception $e) {
    // If an exception occurs, display the error message
    echo $e->getMessage() . "<br>";
} finally {
    // In any case (whether an error occurs or not), disconnect from the database
    $database->disconnect();
}

