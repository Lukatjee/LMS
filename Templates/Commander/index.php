<?php

session_start();

$dir = dirname(__FILE__);

include_once "$dir/../../Controllers/Commander.cont.php";
include_once "$dir/../Base/_header.php";

if (!is_active())
    redirect("index.php", true);

$uid = $_SESSION["user_id"];

$commander_controller = new commander_controller($uid);

if (!$commander_controller->get_admin())
    redirect("Templates/Console/index.php", false);

?>

    <h1>This means you're in charge...</h1>

<?php include_once "$dir/../Base/_footer.php"; ?>