<?php
global $mainErrorField;
global $cityInput;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <title>YourWeather | Weather</title>
</head>
<style>
    table, tr, td {
        border: 1px solid black;
    }

    td {
        padding: 5px;
    }

    .fs-0 {
        font-size: 50pt;
    }

    .py-6 {
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .px-6 {
        padding-left: 50px;
        padding-right: 50px;
    }

    .py-7 {
        padding-top: 75px;
        padding-bottom: 75px;
    }
</style>
<body class="text-center">
<div class="row">
    <div class="col-12 py-6 bg-primary text-light">
        <h1 class="fs-0">Your Weather - Weather Forecast</h1>
    </div>
    <div class="col-12 py-7 bg-warning">
        <form method="post">
            <div class="mb-3 row">
                <div class="col-3"></div>
                <div class="col-6">
                    <label for="cityInput" class="form-label bg-secondary rounded-3 px-6 py-2 fs-1 text-light">Input City Name</label>
                    <hr>
                    <input type="text" name="city-input" value="<?= $cityInput; ?>"
                           class="form-control-lg bg-info-subtle"
                           id="cityInput">
                </div>
                <div class="col-3"></div>
            </div>

            <input type="submit" name="submit-city" value="Submit city" class="btn btn-primary">
        </form>
    </div>
</div>
<div class="error-field">
    <?= $mainErrorField; ?>
</div>
</body>
</html>