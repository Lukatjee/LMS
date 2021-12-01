<?php

session_start();

include_once dirname(__FILE__) . "/../Base/_header.php";
include_once dirname(__FILE__) . "/../../Controllers/Console.cont.php";

if (!is_active())
    redirect("index.php", true);

$uid = $_SESSION["user_id"];

$console_controller = new console_controller($uid);
$console_controller->display_console();

echo "Hi " . $_SESSION["user_uid"] . "<br><br>";
echo "<a href='../../Services/Signout.php'>Sign Out</a>";