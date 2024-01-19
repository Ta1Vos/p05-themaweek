<?php
$hourlyForecasts = array();
$forecast = fetchFromDbUsingCity($_SESSION["city"]);
if ($forecast) {
    $todayDate = $lastRefresh = date("Y-m-d");//Get the current date;

//Only grab the DATE of TODAY
    foreach ($forecast as $key => $forecastItem) {
        if (str_contains($forecastItem["time"], $todayDate)) {
            $forecastItem["time"] = explode(' ', $forecastItem["time"]);
            $forecastItem["time"] = $forecastItem["time"][1];
            $hourlyForecasts[] = $forecastItem;
        }
    }
}