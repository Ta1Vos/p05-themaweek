<?php

/**
 * Fetch an API using cURL.
 * @param string $url Required | The URL of the API you wish to fetch
 * @return object|false returns an object or false if fetch fails.
 */
function fetchAPIUsingCurl(string $url):object|false {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_HEADER => $url,
        CURLOPT_TIMEOUT => 30
    ]);

    $response = curl_exec();
    $error = curl_error();

    if ($error) return false;

    curl_close($curl);
    return json_decode($response);
}

/**
 * Fetch the information of a city using geocode.maps.co.
 * @param string $cityName Required | Name of the city
 * @return object|false returns an object or false if fetch fails.
 */
function fetchCity(string $cityName):object|false {
    return fetchAPIUsingCurl("https://geocode.maps.co/search?q=$cityName");
}

/**
 * Fetch the weather of a location using latitude and longitude.
 * @param string $lat Required | The latitude of the location
 * @param string $lon Required | The longitude of the location
 * @return object|false returns an object or false if fetch fails.
 */
function fetchWeatherForecast(string $lat, string $lon):object|false {
    return fetchAPIUsingCurl("https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&hourly=temperature_2m,precipitation_probability");
}