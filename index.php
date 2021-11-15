<?php

session_start();

if (isset($_SESSION["logged_in"])) {

    if ($_SESSION["logged_in"])
        header("location: ./dashboard/index.php");
    else
        session_destroy();

}

include "custom/locale/en_UK.php"

?>

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

<form action="includes/login.inc.php" method="post">

    <label>

        Username:
        <br>
        <input type="text" name="uid">

    </label>

    <br>
    <br>

    <label>

        Password:
        <br>
        <input type="password" name="pwd">

    </label>

    <br>
    <br>

    <input type="submit" value="Sign In" name="smt">

    <br>
    <br>

    <?php

    if (isset($_SESSION['error'])) {

        echo "<span>" . $lang[$_SESSION['error']] . "<span>";

    }

    ?>

</form>

</body>

</html>