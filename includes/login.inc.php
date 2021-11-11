<?php

    if (isset($_POST['smt'])) {

        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];

        include "../classes/dbh.class.php";
        include "../classes/login.class.php";

        include "../controllers/login.cont.php";

        $login = new LoginController($uid, $pwd);
        $login->auth();

    }