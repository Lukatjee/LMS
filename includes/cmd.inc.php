<?php

	session_start();

	/**
	 * Include the headers for the webpage (includes libraries)
	 */

	require_once dirname(__FILE__) . "/header.inc.php";

	/**
	 * Check if there's an active session going on
	 */

	if (!isset($_SESSION['uid'])) {
		redirect('index.php');
	}

	/**
	 * Include the navigation menu for the commander view
	 */

	require_once dirname(__FILE__) . "/nav.cmd.inc.php";

	/**
	 * Check if the user is an administrator
	 */

	if (!is_cmd($_SESSION['uid'])) {
		redirect('public/_console.php');
	}

	/**
	 * Load the commander functions
	 */

	require_once dirname(__FILE__) . "/../controllers/commander.cont.php";