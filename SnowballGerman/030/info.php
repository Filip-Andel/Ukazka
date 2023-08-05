<?php
require_once 'load.php';
$db = new trida();
$us = new user_repository($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SnowballGerman - Information</title>
    <?php include 'head.php'?>
</head>
<body>
<?php include "header.php"?>
<main class="transparent">
<div class="form about">
    <div>
        <h2 class="center">Information</h2>
        <p>Current version: <b>alfa.0.3.2</b></p><br>
        <p>The application is currently under development. This may be associated with the occasional unavailability of the service.</p>
    </div>
    <div>
        <h2 class="center">Contact</h2>
        <p>For information related to teaching, use the address: <a href = "mailto: haakok@hotmail.com" class="underline">haakok@hotmail.com</a></p><br>
        <p>For information related to the web application, use the address: <a href = "mailto: info@snowballgerman.co.uk" class="underline">info@snowballgerman.co.uk</a></p>
    </div>
</div>
</main>
</main>
<script type="text/javascript" src="script.js"></script>
</body>
</html>