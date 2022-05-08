<?php

	/**
	 * Creates a new account after checking if it doesn't exist yet.
	 * @param $dta
	 * credentials for the new account
	 * @return void
	 *
	 *
	 * function create_user($dta) : void
	 * {
	 *
	 * $qry = 'SELECT user_id FROM user WHERE user_uid = ? OR email = ?';
	 * $res = fetch($qry, [$dta[1], $dta[0]]);
	 *
	 * if (!(empty($res))) {
	 * return;
	 * }
	 *
	 * if (!password_is_valid($dta[2])) {
	 * return;
	 * }
	 *
	 * $qry = 'INSERT INTO user(email, user_uid, user_pwd, role_id, group_id) VALUES (?, ?, ?, ?, 1)';
	 *
	 * insert($qry, $dta);
	 * redirect('public/commander/_users.php');
	 *
	 * }*/

	/**
	 * Creates a new group after checking if it doesn't exist yet.
	 * @param $dta
	 * properties for the new group
	 * @return void
	 */

	function create_group($dta): void
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

	/**
	 * Generates an array of dates with a set of periods and stores them in the databse.
	 * @param $dta
	 * timestamps given by the user
	 * @param $limits
	 * two dates in which between all periods will be set
	 * @return void
	 */

	function create_periods($dta, $limits): void
	{

		$min = date_create($limits['start']);
		$max = date_create($limits['end']);

		foreach ($dta as $input) {

			$t = [$input[0], $input[1]];

			if (!is_empty($t)) {
				$timestamps[] = $t;
			}

		}

		if (empty($timestamps)) {
			return;
		}

		$periods = array();
		$dintval = new DateInterval("P1D");

		while ($min <= $max) {

			if (is_weekend(date_to_string($min))) {
				date_add($min, $dintval);
				continue;
			}

			foreach ($timestamps as $timestamp) {
				$periods[] = [date_to_string($min) . ' ' . $timestamp[0], date_to_string($min) . ' ' . $timestamp[1]];
			}

			date_add($min, $dintval);

		}

		$qry = 'INSERT INTO period(start, end) VALUES (?, ?)';

		foreach ($periods as $period) {
			edit($qry, $period);
		}

		redirect('public/commander/_settings.php');

	}

	/**
	 * Adds one or multiple users to a group.
	 * @param $dta
	 * group and an array of users
	 * @return void
	 */

	function add_user_to_group($dta): void
	{

		$qry = 'UPDATE student AS s SET s.classlist_id = ? WHERE s.user_id = ?;';

		foreach ($dta[1] as $user) {
			edit($qry, [$dta[0], $user]);
		}

		redirect('public/commander/group?id=' . $dta[0]);

	}

	/**
	 * Updates the settings table once the user clicks save
	 * @param array $dta
	 * new data submitted by the user
	 * @return void
	 */

	function update_options(array $dta): void
	{

		if (is_empty($dta)) {
			return;
		}

		$s = date_create($dta[0]);
		$e = date_create($dta[1]);

		if ($s >= $e) {
			return;
		}

		$qry = "UPDATE settings SET start = ?, end = ?;";
		edit($qry, $dta);

		redirect('public/commander/_settings.php');

	}

	function update_group($id, array $dta): void
	{

		if (is_empty($dta)) {
			return;
		}

		$qry = 'UPDATE classlist SET name = ?, grade = ? WHERE id = ?';
		edit($qry, [$dta[0], $dta[1], $id]);

		redirect('public/commander/group?id=' . $id);

	}

	/**
	 * Converts a DateTime object to a string object.
	 * @param DateTime $date
	 * the DateTime object
	 * @return string
	 */

	function date_to_string(DateTime $date): string
	{
		return date('Y-m-d', date_timestamp_get($date));
	}

	/**
	 * Checks if password is strong enough using a regex pattern.
	 * @param $pwd
	 * password (not hashed)
	 * @return bool
	 * boolean based on strength
	 *
	 *
	 * function password_is_valid($pwd): bool
	 * {
	 * return preg_match("^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$", $pwd);
	 * }
	 */