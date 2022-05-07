<?php

	session_start();

	require_once dirname(__FILE__) . "/includes/header.inc.php";

	if (isset($_SESSION['uid']))
		redirect('public/_console.php');

	require_once dirname(__FILE__) . "/services/login.serv.php";

	if (isset($_POST["smt"])) {
		log_in($_POST['uid'], $_POST['pwd']);
	}
?>

<div class="container position-absolute top-50 start-50 translate-middle">

    <form method="post" class="col mb-1">

        <div class="row justify-content-center">

            <div class="col-10 col-md-8 col-lg-4 p-4 bg-dark bg-gradient">

                <div class="my-2">

                    <div class="input-group mb-3">

                        <span class="input-group-text rounded-0 border-0 bg-success bg-gradient text-light">
                            <i class="bi bi-person-circle"></i>
                        </span>

                        <input type="text" id="uid" class="form-control rounded-0 border-0 shadow-none" aria-label="Gebruikersnaam" name="uid">

                    </div>

                </div>

                <div class="mb-2">

                    <div class="input-group">

                        <span class="input-group-text rounded-0 border-0 bg-success bg-gradient text-light">
                            <i class="bi bi-asterisk"></i>
                        </span>

                        <input type="password" id="pwd" class="form-control rounded-0 border-0 shadow-none bg-opacity-50" aria-label="Paswoord" name="pwd">

                        <button class="btn rounded-0 border-0 bg-success bg-gradient text-light" type="submit" name="smt">
                            <i class="bi bi-arrow-return-right"></i>
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

    <p class="text-center fs-6">LMS © 2021-2022</p>

</div>