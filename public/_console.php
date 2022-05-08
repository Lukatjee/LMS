<?php

	session_start();

	require_once dirname(__FILE__) . "/../includes/header.inc.php";

	if (!isset($_SESSION['uid']))
		redirect('index.php');

	require_once dirname(__FILE__) . "/../includes/nav.inc.php";
