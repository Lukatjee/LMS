<?php

// Initialization

session_start();

define("DIR", dirname(__FILE__));

include_once DIR . "/../Base/_header.php";
include_once DIR . "/../Base/_nav.php";
include_once DIR . "/../../Controllers/Commander.cont.php";

if (!is_active())
    redirect("index.php", true);

$uid = $_SESSION["user_id"];

$commander_controller = new commander_controller($uid);

if (!$commander_controller->get_is_admin())
    redirect("Templates/Console/index.php", false);

// Handle form posts

if (isset($_POST["smt"])) {

    unset($_SESSION['error']);

    if (!isset($_POST['cmd']))
        $_POST['cmd'] = "off";

    $commander_controller->create_user($_POST['uid'], $_POST['pwd'], $_POST['cmd']);

}

?>

<div class="container jumbotron position-absolute top-50 start-50 translate-middle">

    <h1>Gebruiker toevoegen</h1>

    <form method="post">

        <div class="mb-3">
            <label for="uid" class="form-label">Gebruikersnaam:</label>
            <input type="text" class="form-control" name="uid" id="uid">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Paswoord:</label>
            <input type="password" class="form-control" name="pwd" id="pwd">
        </div>

        <div class="mb-3">
            <input type="checkbox" class="form-check-input" name="cmd" id="cmd">
            <label for="cmd" class="form-check-label">Beheerder</label>
        </div>

        <input type="submit" class="btn btn-success" value="Opslaan" name="smt">

    </form>

</div>