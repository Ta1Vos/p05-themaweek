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
 * Create a database
 * @return bool Returns false if fails, returns true if creation successful.
 */
function createDatabase():bool {
    $conn = attemptConnection();

    $sql = "CREATE DATABASE yourweather";

    if ($conn->query($sql)) {
        $conn->close();
        return true;
    }

    $conn->close();

    return false;
}

/**
 * Create a table
 * @param string $dbname Required | The name of the database you're creating a table on.
 * @return bool Returns false if fails, returns true if creation successful.
 */
function createForecastTable(string $dbname):bool {
    $conn = attemptConnection($dbname);

    $sql = "CREATE TABLE forecast (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        city VARCHAR(255) NOT NULL,
        time DATETIME NOT NULL,
        temperature FLOAT(4,1) NOT NULL,
        precipitation_probability INT(3) NOT NULL,
        last_refresh DATETIME NOT NULL
    )";

    if ($conn->query($sql)) {
        $conn->close();
        return true;
    }

    $conn->close();

    return false;
}

/**
 * Statements which create a database or tables if they don't exist (this is listed in the exception message)
 * @param string $exception Required | The exception thrown in case an error occurs while checking the database.
 * @return bool Returns true/false depending on whether something has been created. True if something has been created.
 */
function checkToCreateDatabase(string $exception):bool {
    global $dbname;
    $createdSomething = false;

    if (str_contains($exception, "Unknown database 'yourweather'")) {//Check to see if error states there is no database
        $result = createDatabase();

        if ($result) $createdSomething = true;
    } else if (str_contains($exception, "Table 'yourweather.forecast' doesn't exist")) {//Check to see if error states there is no table
        $result = createForecastTable($dbname);

        if ($result) $createdSomething = true;
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
        //Check if connection can be established
        $connection = attemptConnection();
        $connection-> close();

        $pdo = new PDO("$host=$servername;dbname=$dbname", $user, $password);//Link the database

        $query = $pdo->prepare("DESCRIBE forecast");//Check if table exists
        if (!$query->execute()) {
            echo "Creating table";
        }
    } catch (PDOException $exception) {
        echo $exception;//Echo exception if present and not handled.

        $createdSomething = checkToCreateDatabase($exception);//Attempt to handle the exception

        if ($createdSomething) header("Refresh: 0");//Loop by refreshing if a database/table has been created to make sure everything will be/has been created.
    }

    return null;
}

checkForDatabase();