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

    $_periods = empty(fetch("SELECT * FROM period", []));

    if (isset($_POST['blocks'])) {

        create_periods(array_chunk($_POST['blocks'], 2));
        unset($_POST);

    }

?>

<div class="container">

	<div class="row justify-content-center py-5">

        <div class="col-sm-4">

            <div class="card">

                <div class="card-header bg-dark text-light">
                    Lesblokken
                </div>

                <div class="card-body">

                    <div id="btn-periods" class="d-grid gap-2">

                        <button class="btn btn-sm btn-primary rounded-0 shadow-none" data-bs-toggle="modal" data-bs-target="<?php echo $_periods ? "#setupPeriods" : "#viewPeriods" ?>">
                            <?php echo $_periods ? "Instellen" : "Bekijken" ?>
                        </button>

                    </div>

                </div>

            </div>

        </div>

        <div class="modal fade" id="setupPeriods" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content rounded-0 border-0">

                    <form method="post" id="addPeriods">

                        <div class="modal-header">

                            <h5 class="modal-title">Lesblokken instellen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                        </div>

                        <div class="modal-body input-group">

                            <p>Klik op '+' om lesblokken aan te maken.</p>

                            <table class="table table-borderless" id="periodFields">
                            </table>

                        </div>

                        <div class="modal-footer">

                            <button id="addPeriodField" class="btn btn-outline-success btn-sm shadow-none rounded-0" type="button"><i class="bi bi-plus-lg"></i></button>
                            <button id="submitPeriods" type="submit" class="btn btn-success shadow-none rounded-0"><i class="bi bi-check-lg"></i></button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <div class="col-sm-4">

            <div class="card">

                <div class="card-header placeholder-glow bg-dark text-light">
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

                <div class="card-header placeholder-glow bg-dark text-light">
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

<script>

    $(document).ready(function() {

        let i = 1;
        $('#addPeriodField').click(function() {

            i++;

            $('#periodFields').append('<tr id="row'+i+'"><td><div class="input-group mb-3"><input type="time" class="form-control rounded-0" aria-label="start" name="blocks[]"><span class="input-group-text"><i class="bi bi-arrow-right"></i></span> <input type="time" class="form-control" aria-label="end" name="blocks[]"> <button id="'+i+'" class="btn btn-remove btn-danger shadow-none rounded-0" type="button"><i class="bi bi-dash-lg"></i></button> </div> </td></tr>');

        })

        $(document).on('click', '.btn-remove', function() {

            const button_id = $(this).attr("id");
            $("#row"+button_id+"").remove();

        })

        $("#submitPeriods").click(function() {

            $("#submitPeriods").html('<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>')

            $.ajax({

                url: "_controls.php",
                method: "POST",
                data: $('#setupPeriods').serialize(),

            })

        })

    })

</script>
