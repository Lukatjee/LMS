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

    <form method="post" class="col">

        <div class="row justify-content-center">

            <div class="col-10 col-md-8 col-lg-4 px-4 pt-4 pb-4 bg-success rounded-1 bg-gradient bg-opacity-75">

                <div class="my-2">

                    <div class="input-group mb-3">

                        <span class="input-group-text rounded-0 bg-dark border-0 text-white"><i class="bi bi-person-circle"></i></span>
                        <input type="text" id="uid" class="form-control rounded-0 bg-dark bg-opacity-50 text-white border-0 shadow-none" aria-label="Gebruikersnaam" name="uid">

                    </div>

                </div>

                <div class="mb-2">

                    <div class="input-group">

                        <span class="input-group-text rounded-0 bg-dark border-0 text-white"><i class="bi bi-asterisk"></i></span>
                        <input type="password" id="pwd" class="form-control rounded-0 bg-dark bg-opacity-50 text-white border-0 shadow-none" aria-label="Paswoord" name="pwd">
                        <button class="btn rounded-0 bg-dark border-dark text-white" type="submit" name="smt"><i class="bi bi-arrow-return-right"></i></button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>