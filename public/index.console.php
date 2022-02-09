<?php

session_start();

require_once dirname(__FILE__) . "/../includes/_header.php";

if (!isset($_SESSION['uid']))
    redirect('index.php');

require_once dirname(__FILE__) . "/../includes/_nav.php";
