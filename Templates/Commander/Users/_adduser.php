<?php

session_start();

include __DIR__ . "/../../Base/_header.php";

if (!isset($_SESSION['uid'])) {
    redirect('index.php');
}

include __DIR__ . "/../../Base/_nav.cmd.php";

if (!is_cmd($_SESSION['uid'])) {
    redirect('Templates/Console/index.php');
}

include __DIR__ . '/../../../controllers/commander.cont.php';

if (isset($_POST["smt"])) {
    create_user([$_POST['eml'], $_POST['uid'], password_hash($_POST['pwd'], PASSWORD_DEFAULT), 1]);
}

?>

<main class="container py-5">

    <!-- Who the hell is Bucky -->

</main>