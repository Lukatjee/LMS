<?php

session_start();

include "../classes/dbh.classes.php";
include "../classes/dashboard.classes.php";

include "../controllers/dashboard.cont.php";

$dashboard = new DashboardController($_SESSION["user_id"]);
$dashboard->display_admin();
