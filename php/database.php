<?php

class Database {

    // Define the database connection parameters
    private $host = 'localhost';
    private $dbname = 'salvatale';
    private $user = 'salvatale';
    private $password = 'salvatale';
    private $pdo;  // Property to hold the PDO instance

    // Method to establish a connection to the PostgreSQL database
    public function connect() {
        try {
            // Define the Data Source Name (DSN) for PostgreSQL
            $dsn = "pgsql:host=$this->host;dbname=$this->dbname";

            // PDO options for error handling and fetch mode
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Set PDO to throw exceptions on errors
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Set default fetch mode to associative array
            ];

            // Create a new PDO instance and store it in the $pdo property
            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
            
            echo "Connection Successful in PostgresSQL!" . "</br>";  // Display success message
        
        }
        // Catch any PDO-related exceptions
        catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();  // Display error message
            $this->disconnect();  // Disconnect from the database
        }    
    }

    // Method to close the connection to the database
    public function disconnect() {
        try {
            $this->pdo = null;  // Set the PDO instance to null, closing the connection
        }
        catch(PDOException $e) {
            echo "". $e->getMessage();  // Display error message if there's an issue
        }
    }

    // Method to execute a query and check if any rows are returned
    public function query($sql) {
        try {
            $request = $this->pdo->query($sql);  // Execute the query

            // If query returns rows, return true, otherwise return false
            if($request && $request->fetch()) {
                return true;
            }
            else {
                return false;
            }
        }
        // Catch any exceptions during the query execution
        catch(PDOException $e) {
            echo "". $e->getMessage();  // Display error message
            $this->disconnect();  // Disconnect from the database
            return false;  // Return false if an error occurs
        }
    }

    // Method to insert a new user into the 'users' table
    public function insertUser($username, $mail, $psw) {
        try {
            // SQL query to insert a new user with the specified parameters
            $sql = "INSERT INTO users (username, mail, psw, credits) VALUES (:username, :mail, :psw, :credits)";

            // Prepare the SQL query
            $query = $this->pdo->prepare($sql);

            // Bind parameters to the query
            $query->bindParam(":username", $username);
            $query->bindParam(":mail", $mail);
            $query->bindParam(":psw", $psw);
            $query->bindValue(":credits", 50);  // Set a default value of 50 credits

            // Execute the query
            $query->execute();
        }
        // Catch any exceptions during the insert operation
        catch(PDOException $e) {
            echo "". $e->getMessage();  // Display error message
            $this->disconnect();  // Disconnect from the database
        }
    }
}



?>