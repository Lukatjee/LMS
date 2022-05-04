<?php

require_once dirname(__FILE__) . "/storage.serv.php";

function redirect($uri)
{

    $ROOT = "/";
    header("location:" . $ROOT . $uri);
    exit();

}

function is_cmd($uid): bool
{

    $qry = 'SELECT admin FROM user WHERE id = ?';
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

function is_weekend($timestamp = null) : string
{

	return $timestamp === null ? in_array(date('N'), ['6', '7'])
		? strtotime('next monday') : time() : (in_array(date('N', $timestamp), ['6', '7'])
		? strtotime('next monday', $timestamp) : $timestamp);


}