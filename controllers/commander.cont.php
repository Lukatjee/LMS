<?php

/**
 * Creates a new account after checking if it doesn't exist yet.
 * @param $dta
 * credentials for the new account
 * @return void
 */

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

    $qry = 'INSERT INTO users(email, user_uid, user_pwd, role_id, group_id) VALUES (?, ?, ?, ?, 1)';

    insert($qry, $dta);
    redirect('public/commander/_users.php');

}

/**
 * Creates a new group after checking if it doesn't exist yet.
 * @param $dta
 * properties for the new group
 * @return void
 */

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

/**
 * Creates a new role after checking if it doesn't exist yet.
 * @param $dta
 * properties for the new role
 * @return void
 */

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

/**
 * Checks if password is strong enough using a regex pattern.
 * @param $pwd
 * password (not hashed)
 * @return bool
 * boolean based on strength
 */

function password_is_valid($pwd): bool {
	return preg_match("^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$", $pwd);
}