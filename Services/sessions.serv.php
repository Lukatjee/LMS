<?php

use JetBrains\PhpStorm\NoReturn;

/**
 * Check if the user is logged in.
 * @return bool
 */

function is_active(): bool
{

    if (!isset($_SESSION["logged_in"]))
        return false;

    $logged_in = $_SESSION["logged_in"];

    if ($logged_in)
        return true;

    return false;

}