<?php

	require_once dirname(__FILE__) . "/../../includes/cmd.inc.php";

	# Set up default configuration options and store them in the database
	if (empty(fetch("SELECT * FROM settings;", []))) {
		edit("INSERT INTO settings VALUES ();", []);
	}

	# Fetch the start and end date which in between the periods should be created
	$limits = (fetch("SELECT * FROM settings;", []))[0];

	# Check if periods table is completly empty in case we need to show the card to create them
	$is_periods_table_empty = empty(fetch("SELECT * FROM period;", []));

	# Create periods once the user presses the button
	if (isset($_POST['periods'])) {

		create_periods(array_chunk($_POST['periods'], 2), $limits);
		unset($_POST);

	}

	# Update the settings
	if (isset($_POST['settings'])) {

		update_options([
			$_POST['settings_startDate'],
			$_POST['settings_endDate']
		]);
		unset($_POST);

	}

?>

<div class="container">

    <div class="row justify-content-center py-5">

        <div class="col">

            <div class="card rounded-0 mb-3">

                <div class="card-header rounded-0 bg-dark text-light">

                    Algemene instellingen
                    <p class="card-subtitle mb-2 text-light text-muted"><sub>Bekijk en/of bewerk de algemene instellingen van uw <strong>Learning Management System℠</strong>-applicatie.</sub></p>

                </div>

                <div class="card-body">

                    <form method="post">

                        <label for="start" class="form-label">Begin- en einddatum schooljaar:</label>

                        <div class="input-group" aria-describedby="dateHelp">

                            <input type="text" name="settings_startDate" onfocus="(this.type='date')" class="form-control rounded-0" value="<?php echo $limits['start'] ?>" aria-label="start">
                            <span class="input-group-text"><i class="bi bi-dash-lg"></i></span>
                            <input type="text" name="settings_endDate" onfocus="(this.type='date')" class="form-control rounded-0" value="<?php echo $limits['end'] ?>" aria-label="end">

                        </div>

                        <div id="dateHelp" class="form-text mb-1">Lesblokken worden gegenereerd aan de hand van deze 2 datums. Zorg er dus voor dat u deze op voorhand instelt.</div>

                        <hr class="bg-dark border-secondary border-bottom">

                        <div class="d-grid gap-2 justify-content-md-end">
                            <button type="submit" name="settings" class="btn btn-sm btn-primary rounded-0 shadow-none">Opslaan</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

		<?php if ($is_periods_table_empty) { ?>

            <div class="col-sm-5">

                <div class="card rounded-0 mb-3">

                    <div class="card-header rounded-0 bg-dark text-light">

                        Lesblokken
                        <p class="card-subtitle mb-2 text-light text-muted"><sub>Stel hier uw lesblok(ken) in, deze worden gebruikt voor de <b>schoolagenda</b> & <b>groepen</b>.</sub></p>

                    </div>

                    <div class="card-body">

                        <form id="addPeriods">

                            <div class="input-group">

                                <table class="table table-borderless" id="periodFields">
                                </table>

                            </div>

                            <hr class="bg-dark border-bottom border-secondary m-0 mb-3">

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                <button id="addPeriodField" class="btn btn-outline-primary btn-sm shadow-none rounded-0" type="button"><i class="bi bi-plus-lg"></i></button>
                                <button id="submitPeriods" type="submit" class="btn btn-primary btn-sm shadow-none rounded-0">Opslaan</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

		<?php } ?>

    </div>

</div>

<script>

    $(document).ready(function () { // Only run once the page has fully loaded

        let i = 1;

        // Add a field when the #addPeriodField button has been pressed
        $('#addPeriodField').click(function () {

            i++;
            $('#periodFields').append('<tr id="row' + i + '"><td><div class="input-group"><input type="time" class="form-control rounded-0" aria-label="start" name="periods[]"><span class="input-group-text"><i class="bi bi-arrow-right"></i></span> <input type="time" class="form-control" aria-label="end" name="periods[]"> <button id="' + i + '" class="btn btn-remove btn-danger shadow-none rounded-0" type="button"><i class="bi bi-dash-lg"></i></button> </div> </td></tr>');

        })

        // Remove a field on clicking the .btn-remove button
        $(document).on('click', '.btn-remove', function () {

            const button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();

        })

        // Serialize data and create a post request
        $("#submitPeriods").click(function () {

            $("#submitPeriods").html('<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>');
            $("#addPeriodField").remove();

            $.ajax({

                url: "_settings.php",
                method: "POST",
                data: $('#addPeriods').serialize()

            })

        })

    })

</script>
