<?php
$host = "mysql:host";
$servername = "localhost";
$dbname = "yourweather";
$user = "root";
$password = "";

/**
 * Attempt to create a connection with the given host
 * @param string|null $dbname Optional | The name of the database you wish to create a connection to.
 * @return mysqli returns the connection if a connection has been established
 */
function attemptConnection(string $dbname = null):mysqli
{
    global $servername;
    global $user;
    global $password;

    //Create a connection with the localhost
    $connection = new mysqli($servername, $user, $password, $dbname);

    //Checks if a connection can be created
    if ($connection->connect_error) {
        echo "Something went wrong! A connection cannot be established with the host. Error message: $connection->connect_error";
        die();
    }

    return $connection;
}

/**
 * Statements which create a database or tables if they don't exist (this is listed in the exception message)
 * @param string $exception Required | The exception thrown in case an error occurs while checking the database.
 * @return bool Returns true/false depending on whether something has been created. True if something has been created.
 */
function checkToCreateDatabase(string $exception):bool {
    $createdSomething = false;
    if (str_contains($exception, "eeeee")) {//Check to see if error states there is no database
        $createdSomething = true;
    } else if (str_contains($exception, "aaaaa")) {//Check to see if error states there is no table
        $createdSomething = true;
    }

    return $createdSomething;
}

/**
 * Check if a database and its tables are present in the current host.
 * @return null
 */
function checkForDatabase() {
    global $host;
    global $servername;
    global $dbname;
    global $user;
    global $password;

    try {
        $connection = attemptConnection();
        $connection-> close();

        $pdo = new PDO("$host=$servername;$dbname", $user, $password);

        $query = $pdo->prepare("DESCRIBE forecast");
        if (!$query->execute()) {
            echo "Creating table";
        }
    } catch (PDOException $exception) {
        echo $exception;
        $createdSomething = checkToCreateDatabase($exception);

        if ($createdSomething) checkForDatabase();//Loop if a database/table has been created to make sure everything will be/has been created.
    }

    return null;
}

checkForDatabase();