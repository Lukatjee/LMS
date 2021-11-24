<?php

class Login extends DBH
{

    /**
     * Retrieves the user from the database if they exist.
     * @param $uid
     * @param $pwd
     */

    public function get($uid, $pwd)
    {

        $stmt = $this->connect()->prepare('SELECT user_pwd, user_id FROM users WHERE user_uid = ?;');

        $res = $this->get_user($stmt, $uid);

        if (!password_verify($pwd,$res[0]["user_pwd"])) {

            unset($stmt);

            $_SESSION['error'] = "LOGIN_INVALID_PASSWORD";
            header("location: ../index.php");

            exit();

        }

        $_SESSION["logged_in"] = true;
        $_SESSION["user_id"] = $res[0]["user_id"];
        $_SESSION["user_uid"] = $uid;

        header("location: ../dashboard/index.php");

        unset($stmt);

    }

}