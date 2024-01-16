<?php
include_once "home.php";
require "database-check.php";
require "db-functions.php";
require "fetch-API.php";
require "functions.php";

$cityInput = null;

if (isset($_POST["submit-city"])) {
    if (isset($_POST["city-input"])) {
        $cityInput = $_POST["city-input"];

        $isCityPresent = checkIfCityPresentInDb($cityInput);

        if (!$isCityPresent) {
            $weatherForecasts = fetchWeatherForecast($cityInput);//Fetch the weather object

            if ($weatherForecasts) {
                $forecast = $weatherForecasts->hourly;//Pick the necessary data from object
                addForecastToDb($cityInput, $forecast);//Add the data to the database
            } else {
                echo "Something went wrong. Did you spell the city name correct?";
            }
        } else {
            fetchFromDbUsingCity($cityInput);
        }
    } else {
        $mainErrorField = "Fill in a city!";
    }
}