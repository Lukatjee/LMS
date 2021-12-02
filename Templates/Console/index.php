<?php

// Initialization

session_start();

require __DIR__ . "/../Base/_header.php";
require __DIR__ . "/../../Controllers/Console.cont.php";

if (!is_active())
    redirect("index.php", true);

$uid = $_SESSION["user_id"];

$console_controller = new console_controller($uid);
$console_controller->get_is_commander();

require __DIR__ . "/../Base/_nav.php";

