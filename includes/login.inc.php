<?php

if (isset($_POST['smt'])) {

    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";

    include "../controllers/login.cont.php";

    $sign_in = new LoginController($uid, $pwd);
    $sign_in->authenticate();

}