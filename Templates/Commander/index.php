<?php

session_start();
include dirname(__FILE__) . "/../Base/_header.php";
include dirname(__FILE__) . "/../../Controllers/Commander.cont.php";

$commander_controller = new commander_controller($_SESSION["user_id"]);
$commander_controller->display_commander();

echo "Hi 6IT";
