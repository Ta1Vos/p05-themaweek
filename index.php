<?php
include_once "home.php";
require "database-check.php";
require "db-functions.php";
require "fetch-API.php";

$cityInput = null;

if (isset($_POST["submit-city"])) {
    if (isset($_POST["city-input"])) {
        $cityInput = $_POST["city-input"];

        $isCityPresent = checkIfCityPresentInDb($cityInput);

        if (!$isCityPresent) {

        } else {

        }
    } else {
        $mainErrorField = "Fill in a city!";
    }
}