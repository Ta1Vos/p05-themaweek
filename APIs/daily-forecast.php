<?php
$hourlyForecasts = array();

$cityInput = "No city has been selected";
if (isset($_SESSION["city"])) $cityInput = $_SESSION["city"];//If city is present in session, automatically fill it in

$forecast = fetchFromDbUsingCity($cityInput);
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