<?php

session_start();

include __DIR__ . "/Templates/Base/_header.php";

if (isset($_SESSION['uid'])) {
    redirect('Templates/Console/index.php');
}

include __DIR__ . "/controllers/login.cont.php";

if (isset($_POST["smt"])) {
    log_in($_POST['uid'], $_POST['pwd']);
}

?>

<div class="container position-absolute top-50 start-50 translate-middle">

    <form method="post">

        <div class="mb-3">
            <label for="uid" class="form-label">Gebruikersnaam</label>
            <input type="text" id="uid" class="form-control" name="uid">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Paswoord</label>
            <input type="password" id="pwd" class="form-control" name="pwd">
        </div>

        <input type="submit" class="btn btn-success" value="Inloggen" name="smt">

    </form>

</div>