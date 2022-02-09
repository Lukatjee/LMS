<?php

require_once dirname(__FILE__) . "/_storage.php";

function redirect($uri)
{

    $ROOT = "/";
    header("location:" . $ROOT . $uri);
    exit();

}

function is_cmd($uid): bool
{

    $qry = 'SELECT role_id FROM users WHERE user_id = ?';
    $res = fetch($qry, [$uid]);

    foreach ($res as $role) {
        if (in_array(0, $role)) {
            return true;
        }
    }

    return false;

}

function is_empty($dta): bool
{

    foreach ($dta as $str) {

        if (empty(trim($str))) {
            return true;
        }

    }

    return false;

}