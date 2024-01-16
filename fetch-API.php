<?php

/**
 * Fetch an API using cURL.
 * @param string $url Required | The URL of the API you wish to fetch
 * @return array|object|false returns an object/array or false if fetch fails.
 */
function fetchAPIUsingCurl(string $url):array|object|false {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    if ($error) {
        return false;
    }

    echo "<br><br>";
    var_dump($response);
    return json_decode($response);
}

/**
 * Fetch the information of a city using geocode.maps.co.
 * @param string $cityName Required | Name of the city
 * @return object|false returns an object or false if fetch fails.
 */
function fetchCity(string $cityName):array|false {
    return fetchAPIUsingCurl("https://geocode.maps.co/search?q=$cityName&api_key=65a67213e24dc193338739ahe7da75e");
}

/**
 * Fetch the weather of a location using latitude and longitude.
 * @param string $cityName Required | Name of the city
 * @return object|false returns an object or false if fetch fails.
 */
function fetchWeatherForecast(string $cityName):object|false {
    $city = fetchCity($cityName);
    $city = $city[0];

    if (!isset($city->lat) || !isset($city->lon)) return false;

    $lat = $city->lat;
    $lon = $city->lon;

    return fetchAPIUsingCurl("https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&hourly=temperature_2m,precipitation_probability");
}

var_dump(fetchWeatherForecast("Amsterdam"));