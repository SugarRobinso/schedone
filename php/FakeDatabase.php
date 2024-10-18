<?php

class Database {

    // Define the database connection parameters
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $handle;  // Property to hold the PDO instance

    public function __construct($host='localhost', $dbname='dbname', $user='user', $password='password'){
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

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

            // Create a new PDO instance and store it in the $handle property
            $this->handle = new PDO($dsn, $this->user, $this->password, $options);
        
        }
        // Catch any PDO-related exceptions
        catch(PDOException $e) {
            return false;
        }
        
        return true;
    }

    // Method to close the connection to the database
    public function disconnect() {
        try {
            $this->handle = null;  // Set the PDO instance to null, closing the connection
        }
        catch(PDOException $e) {
            return false;  // return false if there's an issue
        }
        return true;
    }

    public function queryInsert($mode, $parameterList): bool{

        try {
            switch($mode) {
                //Case to insert a new user into the 'users' table
                case "REGISTER":
                    // SQL query to insert a new user with the specified parameters
                    $sql = "INSERT INTO users (username, mail, psw, credits) VALUES (:username, :mail, :password, :credits)";

                    // Prepare the SQL query
                    $query = $this->handle->prepare($sql);

                    // Bind parameters to the query
                    $query->bindParam(":username", $parameterList["username"]);
                    $query->bindParam(":mail", $parameterList["mail"]);
                    $query->bindParam(":password", $parameterList["password"]);
                    $query->bindValue(":credits", 50);  // Set a default value of 50 credits

                    // Execute the query
                    $query->execute();

                    break;
                default:
                    return false;
            }
        }
        catch(PDOException $e) {
            return false;
        }
        return true;
    }


    public function querySelect($mode,$parameterList): array|null{

        $result = [];

        try{

            switch($mode){
                case "USERNAME":
                    # SQL query to check if the username exists
                    $sql = "SELECT * FROM users WHERE username=:username";

                    // Prepare the SQL query
                    $query = $this->handle->prepare($sql);

                    // Bind parameters to the query
                    $query->bindParam(":username",$parameterList["username"]);

                    // Execute the query
                    $query->execute();
                    $result = $query->fetchAll();
                    break;
                case "REGISTER":
                    # SQL query to check if the mail exists
                    $sql = "SELECT * FROM users WHERE mail=:mail OR username=:username";

                    // Prepare the SQL query
                    $query = $this->handle->prepare($sql);

                    // Bind parameters to the query
                    $query->bindParam(":mail",$parameterList["mail"]);
                    $query->bindParam(":username",$parameterList["username"]);


                    // Execute the query
                    $query->execute();
                    $result = $query->fetchAll();
                    break;

                case "LOGIN":

                    $user = $parameterList['mail'];

                    # SQL query to check if the username or mail match with password
                    $sql = "SELECT * FROM users WHERE (mail = :mail OR username=:username) AND psw = :password ";

                    // Prepare the SQL query
                    $query = $this->handle->prepare($sql);

                    // Bind parameters to the query
                    $query->bindParam(":mail",$user);
                    $query->bindParam(":username",$user);
                    $query->bindParam(":password",$parameterList["password"]);

                    // Execute the query
                    $query->execute();
                    $result = $query->fetchAll();
                    break;
                default:
                    $result = null;
                    break;
                
            }

        }
        // Catch any exceptions during the insert operation
        catch(PDOException $e) {
            echo "". $e->getMessage();  // Display error message
            $this->disconnect();  // Disconnect from the database
        }

        return $result;
    }
}
