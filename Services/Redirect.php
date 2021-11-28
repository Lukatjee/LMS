<?php

use JetBrains\PhpStorm\NoReturn;

$ROOT_DIR = "/";

#[NoReturn] function redirect($uri) {

    GLOBAL $ROOT_DIR;

    header("location: $ROOT_DIR$uri");
    die();

}
