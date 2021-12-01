<?php

use JetBrains\PhpStorm\NoReturn;

/**
 * Redirect the user to another page.
 * @param $uri
 * @param $unset
 */

#[NoReturn] function redirect($uri, $unset)
{

    global $ROOT_DIR;

    header("location: $ROOT_DIR$uri");

    if ($unset) {
        session_unset();
    }

    exit();

}