<?php

	/**
	 * Creates a new account after checking if it doesn't exist yet.
	 * @param $dta
	 * credentials for the new account
	 * @param $is_teacher
	 * decides whether the user is a teacher or a student
	 * @return void
	 */

	function create_user($dta, $is_teacher): void
	{

		$res = fetch('SELECT id FROM user WHERE username = ?;', [$dta[0]]);

		if (!(empty($res))) {
			return;
		}

		if (!password_is_valid($dta[1])) {
			return;
		}

		$dta[1] = password_hash($dta[1], PASSWORD_DEFAULT);

		edit('INSERT INTO user(username, password) VALUES (?, ?);', $dta);

		$user_id = fetch('SELECT id FROM user WHERE username=?', [$dta[0]])[0]['id'];

		$qry = $is_teacher ? 'INSERT INTO teacher(user_id) VALUES (?);' : 'INSERT INTO student(user_id) VALUES (?);';
		edit($qry, [$user_id]);

		redirect('public/commander/_users.php');

	}

	/**
	 * Updates the users credentials
	 * @param $id
	 * id of the user
	 * @param $dta
	 * new credentials
	 * @return void
	 */

	function update_user($id, $dta): void
	{

		$name = trim($dta[0]);

		if (empty($name)) {
			return;
		}

		$input[] = $name;

		$password = trim($dta[1]);
		$qry = password_is_valid($password) ? ('UPDATE user SET username = ?, password = ? WHERE id = ?;' and $input[] = password_hash($password, PASSWORD_DEFAULT)) : 'UPDATE user SET username = ? WHERE id = ?;';

		$input[] = $id;
		edit($qry, $input);

		redirect('public/commander/user?id=' . $id);

	}

	/**
	 * Deletes a user account from the user and student table.
	 * @param $id
	 * id of the account that needs to be deleted
	 * @return void
	 */

	function delete_user($id): void
	{
		$qry = is_teacher($id) ? 'DELETE FROM teacher WHERE user_id = ?;' : 'DELETE FROM student WHERE user_id = ?;';
		edit($qry, [$id]);

		edit('DELETE FROM user WHERE id = ?;', [$id]);
		redirect('public/commander/_users.php');
	}

	/**
	 * Creates a new group after checking if it doesn't exist yet.
	 * @param $dta
	 * properties for the new group
	 * @return void
	 */

	function create_group($dta): void
	{

		# Make sure the entered data isn't empty, otherwise cancel
		if (empty($dta[0])) {
			return;
		}

		$res = fetch('SELECT name FROM classlist WHERE name = ?;', [$dta[0]]);

		# Cancel if the group already exists in the database
		if (!(empty($res))) {
			return;
		}

		# Cancel if grade is 0 (most often when an invalid grade has been entered)
		if (intval($dta[1]) === 0) {
			return;
		}

		# Insert the new group into database
		edit('INSERT INTO classlist(name, grade) VALUES (?, ?);', [$dta[0], $dta[1]]);

		# Populate the group with users if these have been specified
		if (!empty($dta[2])) {

			$group_id = fetch('SELECT id FROM classlist WHERE name = ?', [$dta[0]])[0]['id'];
			add_users_to_group([$group_id, $dta[2]]);

		}

		redirect('public/commander/_groups.php');

	}

	/**
	 * Updates the properties of a given group
	 * @param $id
	 * id of the group
	 * @param array $dta
	 * new properties
	 * @return void
	 */

	function update_group($id, array $dta): void
	{

		# Cancel if some data is missing
		if (is_empty($dta)) {
			return;
		}

		# Stores the name as one of the input values
		$input[] = $dta[0];

		# Creates query based on what changes are made, if the grade is valid we will change it as well
		$qry = is_int($dta[1]) ? ('UPDATE classlist SET name = ?, grade = ? WHERE id = ?;' and $input[] = $dta[1]) : 'UPDATE classlist SET name = ? WHERE id = ?;';

		# Append the group id to the input array
		$input[] = $id;

		# Update values and refresh the page
		edit($qry, $input);
		redirect('public/commander/group?id=' . $id);

	}

	/**
	 * Deletes a group, removes its members and classes
	 * @param $id
	 * id of the group
	 * @return void
	 */

	function delete_group($id): void
	{
		edit('UPDATE student SET classlist_id = null WHERE classlist_id = ?;', [$id]);
		edit('DELETE FROM class WHERE classlist_id = ?;', [$id]);
		edit('DELETE FROM classlist WHERE id = ?;', [$id]);

		redirect('public/commander/_groups.php');
	}

	/**
	 * Adds one or multiple users to a group.
	 * @param $dta
	 * group and an array of users
	 * @return void
	 */

	function add_users_to_group($dta): void
	{

		$qry = 'UPDATE student AS s SET s.classlist_id = ? WHERE s.user_id = ?;';

		foreach ($dta[1] as $user) {
			edit($qry, [$dta[0], $user]);
		}

		redirect('public/commander/group?id=' . $dta[0]);

	}

	/**
	 * Removes a user from a group
	 * @param $group_id
	 * id of the group
	 * @param $id
	 * id of the user
	 * @return void
	 */

	function remove_user_from_group($group_id, $id): void
	{
		edit("UPDATE student AS s SET s.classlist_id = null WHERE s.user_id = ?;", [$id]);
		redirect('public/commander/group?id=' . $group_id);
	}

	/**
	 * Create subjects and store them in the database.
	 * @param $dta
	 * contains the names for the new subjects
	 * @return void
	 */

	function create_subjects($dta): void
	{

		$qry = 'INSERT INTO subject(name) VALUES (?);';

		foreach ($dta as $course) {

			if (empty($course)) {
				continue;
			}

			if (empty(fetch('SELECT * FROM subject WHERE name = ?', [$course]))) {
				edit($qry, [$course]);
			}

		}

		redirect('public/commander/_courses.php');

	}

	/**
	 * Removes a subject from the database and removes references from other tables.
	 * @param $id
	 * id of the subject that will be deleted
	 * @return void
	 */

	function delete_subjects($id): void
	{

		$qry = 'DELETE FROM subject WHERE id = ?;';
		edit($qry, [$id]);

		redirect('public/commander/_courses.php');

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

		$qry = 'INSERT INTO period(start, end) VALUES (?, ?);';

		foreach ($periods as $period) {
			edit($qry, $period);
		}

		redirect('public/commander/_settings.php');

	}

	/**
	 * Updates the settings table once the user clicks save
	 * @param array $dta
	 * new data submitted by the user
	 * @return void
	 */

	function add_class(array $dta): void {

		$periods = fetch("SELECT id FROM period WHERE TIME_FORMAT(start, '%H:%i') = ? AND WEEKDAY(start) = ?", [$dta[1], $dta[0]]);

		foreach ($periods as $period) {
			edit('INSERT INTO class(subject_id, period_id, classlist_id) VALUE (?, ?, ?);', [$dta[2], $period['id'], $dta[3]]);
		}

	}

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
	 */

	function password_is_valid($pwd): bool
	{
		return preg_match("/^S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*\d)(?=\S*\W)\S*$/", $pwd);
	}