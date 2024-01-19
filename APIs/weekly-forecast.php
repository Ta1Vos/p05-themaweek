<?php
$hourlyForecasts = array();
$forecast = fetchFromDbUsingCity($_SESSION["city"]);
if ($forecast) {
    $hourlyForecasts = $forecast;
    $todayDate = $lastRefresh = date("Y-m-d");//Get the current date;

//Only grab the DATE of TODAY
    foreach ($forecast as $key => $forecastItem) {
        $hourlyForecasts[] = $forecastItem;
    }
}