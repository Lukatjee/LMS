<?php

	require_once dirname(__FILE__) . "/../../includes/cmd.inc.php";

	# Fetch all data regarding subjects
	$res = fetch('SELECT * FROM subject;', []);

	# Store a new course in the database
	if (isset($_POST['courses'])) {
		create_subjects($_POST['courses']);
	}

	# Remove a course from the database
	if (isset($_POST['delete_subject'])) {
		delete_subjects($_POST['delete_subject']);
	}

	unset($_POST);

?>

<div class="container">

    <div class="row py-5 justify-content-center">

        <div class="col table-responsive">

            <table class="table">

                <thead class="bg-dark text-light">

                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Vaknaam</th>
                    <th class="text-center" scope="col"></th>

                </tr>

                </thead>

                <tbody>

				<?php foreach ($res as $subject) { ?>

                    <tr>

                        <td><?php echo $subject['id'] ?></td>
                        <td><?php echo $subject['name'] ?></td>

                        <td class="text-center">

                            <form method="post">

                                <button type="submit" name="delete_subject" class="bg-transparent border-0" value="<?php echo $subject['id'] ?>">
                                    <i class="bi text-danger bi-x-circle"></i>
                                </button>

                            </form>

                        </td>

                    </tr>


				<?php } ?>

                </tbody>

            </table>

        </div>

        <div class="col-sm-5">

            <div class="card rounded-0 mb-3">

                <div class="card-header rounded-0 bg-dark text-light">
                    Vakken
                    <p class="card-subtitle mb-2 text-light text-muted"><sub>Stel hier uw vak(ken) in, deze worden gebruikt voor de <b>schoolagenda</b>.</sub></p>
                </div>

                <div class="card-body">

                    <form id="addCourses">

                        <div class="input-group">

                            <table class="table table-borderless" id="courseFields">
                            </table>

                        </div>

                        <hr class="bg-dark border-bottom border-secondary m-0 mb-3">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                            <button id="addCourseField" class="btn btn-outline-primary btn-sm shadow-none rounded-0" type="button"><i class="bi bi-plus-lg"></i></button>
                            <button id="submitCourses" type="submit" class="btn btn-primary btn-sm shadow-none rounded-0">Opslaan</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    $(document).ready(function () { // Only run once the page has fully loaded

        let i = 1;

        // Add a field when the #addCourseField button has been pressed
        $('#addCourseField').click(function () {

            i++;
            $('#courseFields').append('<tr id="row' + i + '"><td><div class="input-group"><input type="text" class="form-control rounded-0 shadow-none" aria-label="course" name="courses[]"><button id="' + i + '" class="btn btn-remove btn-danger shadow-none rounded-0" type="button"><i class="bi bi-dash-lg"></i></button> </div> </td></tr>');

        })

        // Remove a field on clicking the .btn-remove button
        $(document).on('click', '.btn-remove', function () {

            const button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();

        })

        // Serialize data and create a post request
        $("#submitCourses").click(function () {

            $("#submitCourses").html('<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>');
            $("#addCourseField").remove();

            $.ajax({

                url: "_courses.php",
                method: "POST",
                data: $('#addCourses').serialize()

            })

        })

    })

</script>
