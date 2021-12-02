<?php

require __DIR__ . "/Redirect.php";

session_start();
session_destroy();

redirect("../index.php", false);
