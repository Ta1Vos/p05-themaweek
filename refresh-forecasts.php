<?php
session_start();
require "database-check.php";
require "db-functions.php";
require "fetch-API.php";
require "functions.php";

$forecasts = fetchAllForecast();

$cities = findDistinctCities();
$cities = $cities[0];

if ($cities) {
    $forecast = $forecasts[0];
//Fetch current day
    $lastRefreshDay = $forecast["last_refresh"];

    //Put days in date format
    $lastRefreshDay = date_create($lastRefreshDay);
    $currentDay = date_create('now');

    //Check if refresh date is older than a day
    if (date_diff($lastRefreshDay, $currentDay)->d > 0) {
        $success = false;
        wipeForecast();

        if (wipeForecast() && resetAutoIncrementForecast()) {
            //Fetch every city back in
            foreach ($cities as $city) {
                $success = refreshCityForecast($city);
            }
        }
    }
}

header("Location: index.php");