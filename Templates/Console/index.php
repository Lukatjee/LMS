<?php

session_start();

include __DIR__ . "/../Base/_header.php";
include __DIR__ . "/../Base/_nav.php";

if (!isset($_SESSION['uid'])) {
    redirect('index.php');
}

include __DIR__ . '/../../controllers/console_cont.php';


