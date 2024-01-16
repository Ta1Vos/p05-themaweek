<?php
global $host;
global $servername;
global $dbname;
global $user;
global $password;

$pdo = new PDO("$host=$servername;dbname=$dbname", $user, $password);//Link the database

/**
 * Insert information into the forecast table.
 * @param string $city Required | The name of the city
 * @param string $time Required | The time of the current forecast
 * @param float $temperature Required | The temperature of current time
 * @param int $precipitationProbability Required | The chance when it's going to rain
 * @return bool returns true/false depending on success of operation. True = success.
 */
function insertIntoForecast(string $city, string $time, float $temperature, int $precipitationProbability):bool {
    try {
        global $pdo;

        $lastRefresh = date("Y-m-d H:i:s");//Get the current date

        $query = $pdo->prepare("INSERT INTO forecast SET city=:city, time=:time, temperature=:temperature, precipitation_probability=:precipitation_probability, last_refresh=:last_refresh");
        $query->bindParam("city", $city);
        $query->bindParam("time", $time);
        $query->bindParam("temperature", $temperature);
        $query->bindParam("precipitation_probability", $precipitationProbability);
        $query->bindParam("last_refresh", $lastRefresh);

        if ($query->execute()) return true;
    } catch (PDOException $exception) {
        echo $exception;
    }

    return false;
}

function checkIfCityPresentInDb(string $city):bool {
    try {
        global $pdo;

        $query = $pdo->prepare("SELECT city FROM forecast WHERE city=:city");
        $query->bindParam("city", $city);

        if ($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);//Fetch all cols
            if (count($result) > 0) return true;//If there are cols, then city is present.
        }
    } catch (PDOException $exception) {}

    return false;
}

function fetchFromDbUsingCity(string $city):array|false {
    try {
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM forecast WHERE city=:city limit 1");
        $query->bindParam("city", $city);

        if ($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);//Fetch all cols
            if (count($result) > 0) return $result;//If there are cols, then city is present.
        }
    } catch (PDOException $exception) {}

    return false;
}