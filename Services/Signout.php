<?php

include_once dirname(__FILE__) . "/Redirect.php";

session_start();
session_destroy();

redirect("../index.php", false);
