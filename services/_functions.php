<?php

include __DIR__ . '/../classes/dbh.class.php';

function redirect($uri)
{

    define("ROOT_DIR", "/");

    header("location: " . ROOT_DIR . $uri);
    exit();

}

function is_cmd($uid): bool
{

    $qry = 'SELECT role_id FROM users WHERE user_id = ?';
    $res = fetch($qry, [$uid]);

    foreach ($res as $role) {
        if (in_array(0, $role, true)) {
            return true;
        }
    }

    return false;

}