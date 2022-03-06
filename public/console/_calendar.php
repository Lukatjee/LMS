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

    '08:25 - 09:15',
    '09:15 - 10:05',
    '10:20 - 11:10',
	'11:10 - 12:00',
	'break' => '12:05 - 12:55',
	'13:00 - 13:50',
	'13:50 - 14:40',
	'15:55 - 15:45',
	'15:45 - 16:35',

];

$currentDate = match (date('N')) {

    '6' => date('D d/m', strtotime('+2 days')),
    '7' => date('D d/m', strtotime('+1 days'))

};

$dates = [

    $currentDate,
    date('D d/m', strtotime($currentDate . '+1 days')),
    date('D d/m', strtotime($currentDate . '+2 days'))

]

?>

<div class="container table-responsive py-5">

    <table class="table border-top">

        <tr>

            <th></th>

	        <?php

            foreach ($dates as $date) {

                echo "<td>{$date}</td>";

            }

            ?>

        </tr>

        <?php

        foreach ($verticalHeading as $block) {

            $break = $verticalHeading['break'] === $block;

            echo "<tr><td class=\"align-middle border-end\" style='font-size: 12px; width: 3.5vw'>{$block}</td>";

            if ($break) {
	            echo '<td></td><td></td><td></td></tr>';
                continue;
            }

            echo <<< EOL

                    <td class="border-end"><b><u>TIb, Luka S., F306</u></b><br><span style="font-size: 14px">gip - verderwerken aan groot individueel project + bezoek van extern jurylid mr. Janssens</span></td>
                    <td class="border-end"><b><u>TIb, Luka S., F306</u></b><br><span style="font-size: 14px">gip - verderwerken aan groot individueel project + bezoek van extern jurylid mr. Janssens</span></td>
                    <td><b><u>TIb, Luka S., F306</u></b><br><span style="font-size: 14px">gip - verderwerken aan groot individueel project + bezoek van extern jurylid mr. Janssens</span></td>
              
                </tr>

            EOL;

        }

        ?>

    </table>

</div>
