<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>My website</title>

    <style>
        * {
            font-family: Arial, serif;
        }
    </style>

</head>

<body>

<?php

session_start();

echo "Hallo, " . $_SESSION["user_uid"];

?>

<br>
<br>

<a href="../controllers/logout.cont.php">Logout</a>

</body>

</html>
