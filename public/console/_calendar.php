<?php

session_start();

require_once dirname(__FILE__) . "/../../includes/header.inc.php";

if (!isset($_SESSION['uid'])) {
    redirect('_commander.php');
}

require_once dirname(__FILE__) . "/../../includes/nav.inc.php";

$qry = 'SELECT DISTINCT date FROM lms_events ORDER BY date;';
$dates = fetch($qry, []);


$rows = 9;

$verticalHeading = [

    '08:25<br>09:15',
    '09:15<br>10:05',
    '10:20<br>11:10',
	'11:10<br>12:00',
	'break' => '12:05<br>12:55',
	'13:00<br>13:50',
	'13:50<br>14:40',
	'15:55<br>15:45',
	'15:45<br>16:35',

];

$d = match(date('N')) {

    '6' => strtotime("+2 days"),
    '7' => strtotime("+1 days"),
    default => date(time())

};

$dates = [];

for ($i = 0; $i < 3; $i++) {
    $dates[] = date('d/m/Y', strtotime("+$i days", $d));
}

?>

<div class="container table-responsive py-5">

    <table class="table">

        <thead class="bg-dark text-white">

            <tr class="border-top">

                <th></th>
                <?php foreach ($dates as $date) { echo "<td>$date</td>"; } ?>

            </tr>

        </thead>

        <tbody>

            <?php

            foreach ($verticalHeading as $block) {

                $break = $verticalHeading['break'] === $block;

                echo "<tr><th class=\"align-middle text-center border-end\" style='font-size: 12px; width: 3.5vw'>$block</th>";

                if ($break) {

                    for ($i = 0; $i < 3; $i++){
                        echo '<td></td>';
                    }
                    echo '</tr>';

                    continue;

                }

                echo <<< EOL
                
                        <td colspan="1" class='border-end'>
                        
                            <div data-bs-toggle="modal" data-bs-target="#exampleSubject">
                                <u class="position-relative">TIb, F306</u>
                            </div>
                            
                        </td>
                        
                        <td colspan="1" class='border-end'>
                        
                            <div data-bs-toggle="modal" data-bs-target="#exampleSubject">
                                <u>TIb, F306</u>
                            </div>
                            
                        </td>
                        
                        <td colspan="1" class='border-end'>
                        
                            <div data-bs-toggle="modal" data-bs-target="#exampleSubject">
                                <u>TIb, F306</u>
                            </div>
                            
                        </td>
                
                EOL;

            }

            ?>

        </tbody>

    </table>

    <button data-bs-toggle="modal" data-bs-target="#addEvent" class="btn btn-disabled btn-primary rounded-0">Inplannen</button>

    <!-- Subject Modal -->

    <div class="modal fade" id="exampleSubject" tabindex="-1" aria-labelledby="exampleSubjectLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleSubjectLabel">TI Beheer, F306, Luka S.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>gip - verderwerken aan groot individueel project + bezoek van extern jurylid mr. Janssens</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluit</button>
                </div>

            </div>

        </div>

    </div>

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
