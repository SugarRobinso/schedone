# login.php

This script handles the login process for users. It checks the provided email and password against the database and starts a session to store error messages if the login fails.

## Code Breakdown

### Includes and Session Start

```php
include "./database.php";

session_start();
```

* `include` : Includes the `database.php` file to use the `Database` class for database operations.
* `session_start()` : Starts the session to store and access session variables, used to store error messages if the login fails.

### Retrieve User Input

```php
$mail = isset($_POST['mail']) ? $_POST['mail'] : '';
$password = isset($_POST['psw']) ? $_POST['psw'] : '';
```

* `$_POST['mail'] and $_POST['psw']` : Retrieves the email and password entered by the user in the login form using the POST method.
* `If either field is not set, it defaults to an empty string.`

### Database Connection
```php
$database = new Database();
```
* Creates a new instance of the `Database` class.

### Query for Mail
```php
$query = "SELECT * FROM users WHERE mail='$mail'";
$result = $database->query($query);
```

* The email entered by the user is used in the query to search for a matching record in the `users` table.
* **Error Handling** : If the query fails, an error message is stored in the session:
```php
if(!$result){
        $_SESSION['mailError'] = 'Mail not found. Try again.';
        header('Location: ../index.php');
        exit();
    }
unset($_SESSION['mailError']);
```
* If no matching email is found, the user is redirected to the `index.php` page with an error message.

### Query for Password 

```php
$query = "SELECT * FROM users WHERE psw='$password'";
$result = $database->query($query);
```

* After the email is found, the entered password is checked against the `users` table.
* **Error Handling** : If the password doesn't match:

```php
if(!$result){
        $_SESSION['pswError'] = 'Incorrect password. Try again.';
        header('Location: ../index.php');
        exit();
    }
unset($_SESSION['pswError']);
```
* If the password is incorrect, an error message is stored in the session, and the user is redirected back to `index.php`.

### Finally Block: Disconnect from the Database
The database connection is always closed at the end of the script, whether the login was successful or not.

```php
finally{
    $database->disconnect();
}
```

### Error Messages
* `$_SESSION['mailError']`: Set if the email is not found in the database. Redirects the user to `index.php`.
* `$_SESSION['pswError']`: Set if the password is incorrect. Redirects the user to `index.php`.