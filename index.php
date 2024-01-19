<?php
session_start();
require "database-check.php";
require "db-functions.php";
require "fetch-API.php";
require "functions.php";

$cityInput = null;
if (isset($_SESSION["city"])) $cityInput = $_SESSION["city"];//If city is present in session, automatically fill it in

$tableContents = "";
$mainErrorField = "";
$forecastMessage = null;

if (!isset($_POST["weekly-page"]) || isset($_POST["daily-page"])) {
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
                    $mainErrorField = "Something went wrong. Did you spell the city name correct?";
                }
            }
            //Fetch city
            $_SESSION["city"] = $cityInput;
        } else {
            $mainErrorField = "Fill in a city!";
        }
    }

    $forecastMessage = "Today's forecast in {$_SESSION["city"]}";
    require "APIs/daily-forecast.php";
    include_once "pages/home.php";
} else {
    $forecastMessage = "Weekly forecast in {$_SESSION["city"]}";
    require "APIs/weekly-forecast.php";
    include_once "pages/weekly-forecast-page.php";
}
