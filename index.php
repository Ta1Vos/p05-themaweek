<?php
include_once "home.php";
require "fetch-API.php";

$cityInput = null;

if (isset($_POST["submit-city"])) {
    if (isset($_POST["city-input"])) {
        $cityInput = $_POST["city-input"];
        var_dump(fetchWeatherForecast($cityInput));
    } else {
        $mainErrorField = "Fill in a city!";
    }
}