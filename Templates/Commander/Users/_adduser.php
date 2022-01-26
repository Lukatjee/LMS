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

<main class="container py-5 d-flex justify-content-center">

    <form class="col-8">

        <!-- Name -->

        <div class="input-group mb-3">

            <div class="input-group-text">
                <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
            </div>

            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" aria-label="fnm" class="form-control" placeholder="Thijs">
            <input type="text" aria-label="lnm" class="form-control" placeholder="Vroomen">

        </div>

        <!-- Adress -->

        <div class="input-group">

            <div class="input-group-text">
                <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
            </div>

            <span class="input-group-text"><i class="bi bi-house-fill"></i></span>
            <input type="text" aria-label="str" class="form-control col-3" placeholder="Atomiumplein">
            <input type="text" aria-label="num" class="form-control col-1" placeholder="1">
            <input type="text" aria-label="pst" class="form-control col-1" placeholder="1020">
            <input type="text" aria-label="stt" class="form-control col-1" placeholder="Brussel">
            <input type="text" aria-label="bus" class="form-control col-1" placeholder="0000">
            <input type="text" aria-label="cnt" class="form-control col-1" placeholder="België">

        </div>

    </form>

</main>