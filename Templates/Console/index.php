<?php

// Initialization

session_start();

define("DIR", dirname(__FILE__));

include_once DIR . "/../Base/_header.php";
include_once DIR . "/../../Controllers/Console.cont.php";

if (!is_active())
    redirect("index.php", true);

$uid = $_SESSION["user_id"];

$console_controller = new console_controller($uid);
$console_controller->get_is_commander();

include_once DIR . "/../Base/_nav.php";

