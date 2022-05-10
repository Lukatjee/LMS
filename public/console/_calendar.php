<?php

	session_start();

	require_once dirname(__FILE__) . "/../../includes/header.inc.php";

	if (!isset($_SESSION['uid'])) {
		redirect('_commander.php');
	}

	require_once dirname(__FILE__) . "/../../includes/nav.inc.php";

	$dates = fetch("SELECT DISTINCT DATE_FORMAT(CAST(start AS DATE), '%a %d/%c') AS date, CAST(start AS DATE) AS date_raw FROM period WHERE CURRENT_DATE <= CAST(start AS DATE) LIMIT 5;", []);

	$blocks = fetch("SELECT id, CONCAT(TIME_FORMAT(start, '%H:%i'), '<br>', TIME_FORMAT(end, '%H:%i')) AS block, TIME_FORMAT(start, '%H:%i') AS block_raw_start FROM period WHERE CAST(start AS DATE) = CURRENT_DATE;", []);

	$classes = array();

	foreach ($dates as $date) {

		foreach ($blocks as $block) {
			$classes[] = fetch("SELECT * FROM class WHERE period_id = (SELECT id FROM period WHERE TIME_FORMAT(CAST(start AS TIME), '%H:%i') = ? AND CAST(start AS DATE) = ?);", [$block['block_raw_start'], $date['date_raw']])[0];
		}

	}

	$classes = array_chunk($classes, 5);

?>

<div class="container-fluid table-responsive py-5">

    <table class="table">

        <thead class="bg-dark text-white">

        <tr class="border-top">

            <th></th>
			<?php foreach ($dates as $date) {
				echo "<th>" . $date['date'] . "</th>";
			} ?>

        </tr>

        </thead>

        <tbody>

		<?php

			$i = 0;
			foreach ($blocks as $block) {

				echo '<tr><th class="align-middle text-center border-end" style="font-size: 12px; width: 3.5vw">' . $block['block'] . '</th>';

				foreach ($classes[$i] as $class) {
					echo '<td colspan="1" class="border-end">' . fetch('SELECT name FROM subject WHERE id = ?', [$class['subject_id']])[0]['name'] . '</td>';
				}

				$i++;

			}

		?>

        </tbody>

    </table>

    <button data-bs-toggle="modal" data-bs-target="#addEvent" class="btn btn-disabled btn-primary rounded-0">Inplannen</button>

    <!-- Add Event Modal -->

    <div class="modal fade" id="addEvent" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addEventLabel">Event inplannen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form>

                        <div class="mb-3">
                            <label for="eventCourse" class="form-label">Leervak</label>
                            <input type="email" class="form-control" id="eventCourse">
                        </div>

                        <div class="mb-3">
                            <label for="eventDeadline" class="form-label">Inleverdatum</label>
                            <input type="date" class="form-control" id="eventDeadline">
                        </div>

                        <div class="mb-3">

                            <label for="eventType" class="form-label">Type</label>

                            <select class="form-select" id="eventType">
                                <option selected value="task">Taak</option>
                                <option value="test">Toets</option>
                            </select>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Opslaan</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Sluit</button>
                </div>

            </div>

        </div>

    </div>

</div>
