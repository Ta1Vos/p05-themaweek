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
    <title>Document</title>
</head>
<style>
    table, tr, td {
        border: 1px solid black;
    }

    td {
        padding: 5px;
    }
</style>
<body>
<form method="post">
    <input type="text" name="city-input" value="<?= $cityInput; ?>"><br>
    <input type="submit" name="submit-city" value="Submit city">
</form>
<div class="error-field">
    <?= $mainErrorField; ?>
</div>
</body>
</html>