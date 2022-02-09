<?php

function create_user($dta)
{

    $qry = 'SELECT user_id FROM users WHERE user_uid = ? OR email = ?';
    $res = fetch($qry, [$dta[1], $dta[0]]);

    if (!(empty($res))) {
        return;
    }

    if (!password_is_valid($dta[2])) {
        return;
    }

    $qry = 'INSERT INTO users(email, user_uid, user_pwd, role_id) VALUES (?, ?, ?, ?)';

    insert($qry, $dta);
    redirect('public/commander/_users.php');

}

function create_group($dta)
{

    if (empty(trim($dta[0]))) {
        return;
    }

    $qry = 'SELECT name FROM lms_groups WHERE name = ?';
    $res = fetch($qry, $dta);

    if (!(empty($res))) {
        return;
    }

    $qry = 'INSERT INTO lms_groups(name) VALUES (?)';

    insert($qry, $dta);
    redirect('public/commander/_groups.php');

}

function create_role($dta)
{

    if (is_empty($dta)) {
        return;
    }

    $qry = 'SELECT role_name FROM lms_roles WHERE role_name = ?';
    $res = fetch($qry, $dta);

    if (!(empty($res))) {
        return;
    }

    $qry = 'INSERT INTO lms_roles(role_name) VALUES (?)';

    insert($qry, $dta);
    redirect('public/commander/_roles.php');

}

function password_is_valid($pwd): bool
{

    $upc = preg_match('/[A-Z]/', $pwd);
    $lwc = preg_match('/[a-z]/', $pwd);
    $dcl = preg_match('/\d/', $pwd);
    $spc = preg_match('/[^\W]/', $pwd);

    $len = strlen($pwd) >= 8;

    return !(!$upc || !$lwc || !$dcl || !$spc || !$len);

}