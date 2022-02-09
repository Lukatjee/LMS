<?php

session_start();

require_once dirname(__FILE__) . "/../../includes/_header.php";

if (!isset($_SESSION['uid'])) {
    redirect('index.commander.php');
}

require_once dirname(__FILE__) . "/../../includes/_nav.php";

?>

<div class="container py-5">

    <div class="row">

        <div class="col">

            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link text-secondary">maandag 31/01</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-secondary">dinsdag 01/02</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-secondary">woensdag 02/02</a>
                </li>

            </ul>

        </div>

    </div>

</div>
