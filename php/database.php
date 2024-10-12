<?php

class Database{

    private $host = 'localhost';
    private $dbname = 'salvatale';

    private $user = 'salvatale';

    private $password = 'salvatale';

    private $pdo;

    public function connect(){

        try{
            $dsn = "pgsql:host=$this->host;dbname=$this->dbname";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Set PDO to manage errors
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Set default fetch mode
            ];

            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
            
            echo "Connection Successful in PostgresSQL!" . "</br>";
        
        }
        catch(PDOException $e){
            echo "Connection Error: " . $e->getMessage();
        }    
    }

    public function disconnect(){
        try{
            $this->pdo = null;

        }
        catch(PDOException $e){
            echo "". $e->getMessage();
        }

    }

    public function query($sql){
        try{

            $request = $this->pdo->query( $sql );

            if($request && $request->fetch()){
                return true;
            }
            else{
                return false;
            }
        }
        catch(PDOException $e){

            echo "". $e->getMessage();
            return false;
        }
    }

    public function insertUser($username, $mail, $psw){
        try{

            $sql = "INSERT INTO users (username, mail, psw, credits) VALUES (:username, :mail, :psw, :credits)";

            $query = $this->pdo->prepare($sql);

            $query->bindParam(":username", $username);
            $query->bindParam(":mail", $mail);
            $query->bindParam(":psw", $psw);
            $query->bindValue(":credits",50);

            $query->execute();

        }
        catch(PDOException $e){
            echo "". $e->getMessage();
        }
    }

}


?>