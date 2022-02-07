<?php

session_start();

include __DIR__ . "/../../Base/_header.php";

if (!isset($_SESSION['uid'])) {
    redirect('index.php');
}

include __DIR__ . "/../../Base/_nav.php";

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
