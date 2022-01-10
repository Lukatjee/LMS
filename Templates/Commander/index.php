<?php

// Initialization

session_start();

require __DIR__ . "/../Base/_header.php";
require __DIR__ . "/../Base/_navcmd.php";
require __DIR__ . "/../../Controllers/user.cont.php";

if (!is_active())
    redirect("index", true);

$uid = $_SESSION["user_id"];

$commander_controller = new commander_controller($uid);

if (!$commander_controller->get_is_admin())
    redirect("Templates/Console/index.php", false);

