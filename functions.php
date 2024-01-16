<?php

function addForecastToDb(string $requestedCity, object $forecast) {
    foreach ($forecast->time as $key => $currentForecast) {
        $insertResult = insertIntoForecast($requestedCity, $forecast->time[$key], $forecast->temperature_2m[$key], $forecast->precipitation_probability[$key]);

        if (!$insertResult) return false;//Does not continue if something goes wrong
    }
}