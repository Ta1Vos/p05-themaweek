<?php

function addForecastToDb(string $requestedCity, object $forecast) {
    foreach ($forecast->time as $key => $currentForecast) {
        $insertResult = insertIntoForecast($requestedCity, $forecast->time[$key], $forecast->temperature_2m[$key], $forecast->precipitation_probability[$key]);

        if (!$insertResult) return false;//Does not continue if something goes wrong
    }
}

function refreshCityForecast(string $cityInput) {
    global $mainErrorField;
    global $forecast;

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

    return null;
}