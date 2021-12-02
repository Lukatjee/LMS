<?php

use JetBrains\PhpStorm\NoReturn;

require __DIR__ . "/dbh.class.php";

class sign_in extends dbh
{

    /**
     * Fetch user data if a record with the given ID exists.
     * @param $uid
     * @param $pwd
     */

    #[NoReturn] public function auth($uid, $pwd)
    {

        $stmt = $this->connect()->prepare('SELECT user_pwd, user_id FROM users WHERE user_uid = ?;');

        $res = $this->get_user($stmt, $uid);

        if (!password_verify($pwd, $res[0]["user_pwd"])) {

            unset($stmt);

            $_SESSION['error'] = "LOGIN_INVALID_PASSWORD";
            redirect("index.php", true);

        }

        $_SESSION["logged_in"] = true;
        $_SESSION["user_id"] = $res[0]["user_id"];
        $_SESSION["user_uid"] = $uid;

        redirect("Templates/Console/index.php", false);

    }

}