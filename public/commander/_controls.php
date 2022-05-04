<?php

	session_start();

	require_once dirname(__FILE__) . "/../../includes/header.inc.php";

	if (!isset($_SESSION['uid'])) {
		redirect('index.php');
	}

	require_once dirname(__FILE__) . "/../../includes/nav.cmd.inc.php";

	if (!is_cmd($_SESSION['uid'])) {
		redirect('public/_console.php');
	}

	require_once dirname(__FILE__) . "/../../controllers/commander.cont.php";

?>

<div class="container">

	<div class="row justify-content-center py-5">

        <div class="col-sm-4">

            <div class="card rounded-0">

                <div class="card-header">
                    Lesblokken
                </div>

                <div class="card-body">

                    <p class="card-text placeholder-glow">

                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>

                    </p>

                </div>

            </div>

        </div>

        <div class="col-sm-4">

            <div class="card rounded-0">

                <div class="card-header placeholder-glow">
                    <span class="placeholder col-6"></span>
                </div>

                <div class="card-body">

                    <p class="card-text placeholder-glow">

                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>

                    </p>

                </div>

            </div>

        </div>

        <div class="col-sm-4">

            <div class="card rounded-0">

                <div class="card-header placeholder-glow">
                    <span class="placeholder col-6"></span>
                </div>

                <div class="card-body">

                    <p class="card-text placeholder-glow">

                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>

                    </p>

                </div>

            </div>

        </div>

	</div>

</div>
