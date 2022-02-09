<?php

session_start();

require_once dirname(__FILE__) . "/../../includes/_header.php";

if (!isset($_SESSION['uid'])) {
    redirect('index.commander.php');
}

require_once dirname(__FILE__) . "/../../includes/_nav.php";

$qry = 'SELECT DISTINCT date FROM lms_events ORDER BY date;';
$dates = fetch($qry, []);

?>

<div class="container py-5">

    <table class="table">

    <?php

    foreach ($dates as $date) {

        foreach ($date as $d) {

            echo "<thead class='table-dark'><tr><th scope='col'>$d</th></tr></thead><tbody><tr>";

            $qry = 'SELECT * FROM lms_events WHERE date = ?';
            $events = fetch($qry, [$d])[0];

            foreach ($events as $event) {

                echo "<td>$event</td>";

            }

        }

    }

    ?>

    </table>

</div>
