<?php

function redirect($uri)
{

    define("ROOT_DIR", "/");

    header("location: " . ROOT_DIR . $uri);
    exit();

}