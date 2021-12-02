<?php

define("DIR", dirname(__FILE__));

include_once DIR . "/../Classes/dbh.class.php";

class commander extends dbh
{

    /**
     * Creates a user if the requirements have been met and the user does not exist yet.
     * @param $uid
     * @param $pwd
     * @param $cmd
     */

    public function create($uid, $pwd, $cmd)
    {

        $stmt = $this->connect()->prepare('SELECT user_pwd, user_id FROM users WHERE user_uid = ?;');

        $res = $this->exists($stmt, $uid);

        if ($res) {

            $_SESSION["error"] = "USER_EXISTS";
            header("location: ./index.php");

            exit();

        }

        $stmt = $this->connect()->prepare('INSERT INTO users (user_uid, user_pwd, is_admin) VALUES (?, ?, ?);');

        $this->add_user($stmt, $uid, $pwd, $cmd);

    }

}