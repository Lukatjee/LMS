<?php


require __DIR__ . "/redirect.serv.php";

session_start();
session_destroy();

redirect("../index.php", false);
