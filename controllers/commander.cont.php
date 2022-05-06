<?php

/**
 * Creates a new account after checking if it doesn't exist yet.
 * @param $dta
 * credentials for the new account
 * @return void


function create_user($dta) : void
{

    $qry = 'SELECT user_id FROM user WHERE user_uid = ? OR email = ?';
    $res = fetch($qry, [$dta[1], $dta[0]]);

    if (!(empty($res))) {
        return;
    }

    if (!password_is_valid($dta[2])) {
        return;
    }

    $qry = 'INSERT INTO user(email, user_uid, user_pwd, role_id, group_id) VALUES (?, ?, ?, ?, 1)';

    insert($qry, $dta);
    redirect('public/commander/_users.php');

}*/

/**
 * Creates a new group after checking if it doesn't exist yet.
 * @param $dta
 * properties for the new group
 * @return void
 */

function create_group($dta) : void
{

    if (empty(trim($dta[0]))) {
        return;
    }

    $qry = 'SELECT name FROM classlist WHERE name = ?';
    $res = fetch($qry, [$dta[0]]);

    if (!(empty($res))) {
        return;
    }

    $qry = 'INSERT INTO classlist(name, grade) VALUES (?, ?)';

    edit($qry, $dta);
    redirect('public/commander/_groups.php');

}

function create_periods($dta) : void
{

    $periods = array();
    $limits = ['2022-01-01', '2022-12-30'];

    foreach ($dta as $period) {

        $timestamps = [$period[0], $period[1]];

        if (!is_empty($timestamps)) {
            $periods[] = $timestamps;
        }

    }

    if (empty($periods)) {
        return;
    }

    while ($limits[0] <= $limits[1]) {

        if (!is_weekend($limits[0])) {

            $blocks = array();

            foreach ($periods as $period) {
                $blocks[] = [$limits[0] . ' ' . $period[0], $limits[0] . ' ' . $period[1]];
            }

            print_r($blocks);

            $qry = 'INSERT INTO period(start, end) VALUES (?, ?)';
            edit($qry, [$blocks[0][0], $blocks[0][1]]);

        }

        $limits[0] = date('Y-m-d',
            strtotime('+1 day', strtotime($limits[0]))
        );

    }

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