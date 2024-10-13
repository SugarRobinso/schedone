# Database Class

## Class Properties

- **`$host`**: The database host (default: `localhost`).
- **`$dbname`**: The name of the database (default: `salvatale`).
- **`$user`**: The database user (default: `salvatale`).
- **`$password`**: The database password (default: `salvatale`).
- **`$pdo`**: PDO object instance used to execute database operations.

## Methods

### 1. `connect()`

Creates a connection to the PostgreSQL database.

```php
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

```

**Error Handling**: If the connection fails, an error message is displayed.

### 2. `disconnect()`

Closes the connection to the database.

```php
public function disconnect(){
    try{
        $this->pdo = null;

    }
    catch(PDOException $e){
        echo "". $e->getMessage();
    }

}
```

### 3. `query($sql)`
Executes a generic SQL query. Returns true if the query returns results, false otherwise.

```php
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
        $this->disconnect();
        return false;
    }
}
```

**Error Handling**: If the query fails, an exception is caught, and false is returned.

### 4. `insertUser($username, $mail, $psw)`
Inserts a new user into the database with a username, email, and password, assigning a default value of 50 credits.

```php
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
        $this->disconnect();
    }
}
```

## Usage of the Class

Here’s how you can use the Database class to connect to the database, execute queries, and insert new users:

```php
// Instantiate the class
$db = new Database();

// Connect to the database
$db->connect();

// Execute a query
$result = $db->query("SELECT * FROM users");

// Insert a new user
$db->insertUser("testuser", "testuser@example.com", "password123");

// Disconnect from the database
$db->disconnect();
```


