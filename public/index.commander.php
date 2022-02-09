<?php

session_start();

require_once dirname(__FILE__) . "/../includes/_header.php";

if (!isset($_SESSION['uid'])) {
    redirect('index.php');
}

require_once dirname(__FILE__) . "/../includes/_nav.cmd.php";

if (!is_cmd($_SESSION['uid'])) {
    redirect('public/index.console.php');
}
